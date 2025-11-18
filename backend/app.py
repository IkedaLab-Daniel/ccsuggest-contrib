"""
Flask microservice exposing /predict and /retrain,
auto-building the CSV if missing.
Uses C4.5-style Decision Tree Ensemble with entropy (Information Gain).
Multiple C4.5 trees with soft voting for better probability distributions.
"""

import os
import pandas as pd
import numpy as np
from flask import Flask, request, jsonify, send_file, render_template
from sklearn.tree import DecisionTreeClassifier, export_text, plot_tree
from sklearn.ensemble import BaggingClassifier
from joblib import load, dump
from build_training_dataset import build_dataset
from dotenv import load_dotenv
from flask_cors import CORS
import matplotlib
matplotlib.use('Agg')  # Use non-GUI backend
import matplotlib.pyplot as plt
load_dotenv()

app        = Flask(__name__)
CORS(app) 
MODEL_PATH = "model.pkl"
DATA_PATH  = "data/training_data.csv"
PDF_PATH   = "decision_tree.pdf"

REDIRECT_URL = os.environ.get("REDIRECT_URL", "http://127.0.0.1:8000")
@app.get("/")
def index():
    return render_template("index.html", redirect_url=REDIRECT_URL)

@app.get("/export_tree")
def export_tree():
    if os.path.exists(PDF_PATH):
        return send_file(PDF_PATH, as_attachment=True)
    return ("PDF not found", 404)

@app.get("/health")
def health():
    return {"status": "ok"}, 200

def ensure_csv():
    if not os.path.isfile(DATA_PATH):
        print("Training data CSV not found, building from database...")
        try:
            build_dataset(DATA_PATH)
            print(f"Training data built successfully: {DATA_PATH}")
        except Exception as e:
            print(f"Failed to build training dataset: {str(e)}")
            raise

def train_and_save():
    try:
        ensure_csv()
        df = pd.read_csv(DATA_PATH)
        
        # Check if we have sufficient data
        if df.empty:
            raise ValueError("Training dataset is empty. No responses found in database.")
        
        if len(df) < 10:
            raise ValueError(f"Insufficient training data: only {len(df)} records found. Need at least 10 records.")
        
        if "tech_field_id" not in df.columns:
            raise ValueError("Missing 'tech_field_id' column in training data")
        
        X = df.drop("tech_field_id", axis=1)
        y = df["tech_field_id"]
        
        # Check if we have feature columns
        if X.empty or len(X.columns) == 0:
            raise ValueError("No feature columns found in training data")
        
        print(f"Training with {len(df)} records and {len(X.columns)} features")
        
        # C4.5-style Decision Tree as base estimator
        base_c45_tree = DecisionTreeClassifier(
            criterion='entropy',        # Information Gain (C4.5's method)
            max_depth=15,               # Prevent overfitting
            min_samples_split=5,        # Minimum samples to split a node
            min_samples_leaf=2,         # Minimum samples in leaf node
            random_state=42
        )
        
        # Ensemble of 10 C4.5 trees with soft voting
        # This provides better probability distributions for Top 3 recommendations
        clf = BaggingClassifier(
            estimator=base_c45_tree,
            n_estimators=10,            # 10 C4.5 trees voting
            max_samples=0.8,            # Each tree sees 80% of data
            max_features=0.8,           # Each tree sees 80% of features
            bootstrap=True,             # Sample with replacement
            random_state=42,
            n_jobs=-1                   # Use all CPU cores
        )
        
        print("Training ensemble of 10 C4.5 decision trees...")
        clf.fit(X, y)
        dump(clf, MODEL_PATH)
        print("C4.5 Ensemble model trained successfully!")
        
        # Export tree visualization (optional but useful for C4.5)
        try:
            # Export first tree from the ensemble as representative
            first_tree = clf.estimators_[0]
            
            # Export text representation
            tree_rules = export_text(first_tree, feature_names=list(X.columns))
            with open('decision_tree_rules.txt', 'w') as f:
                f.write("=== Representative C4.5 Tree (1 of 10 in ensemble) ===\n\n")
                f.write(tree_rules)
            print("Decision tree rules exported to decision_tree_rules.txt")
            
            # Export visual tree (PNG) - first tree only
            plt.figure(figsize=(20, 10))
            plot_tree(first_tree, filled=True, feature_names=list(X.columns), 
                     class_names=[str(c) for c in first_tree.classes_], 
                     rounded=True, fontsize=10)
            plt.title('Representative C4.5 Tree (1 of 10 in ensemble)', fontsize=16, pad=20)
            plt.savefig('decision_tree.png', dpi=100, bbox_inches='tight')
            plt.close()
            print("Decision tree visualization exported to decision_tree.png")
        except Exception as e:
            print(f"Warning: Could not export tree visualization: {e}")
        
        return clf
        
    except Exception as e:
        print(f"Training failed: {str(e)}")
        raise

def get_model():
    return load(MODEL_PATH) if os.path.exists(MODEL_PATH) else train_and_save()

clf = get_model()

@app.post("/predict")
def predict():
    print("/predict payload:", request.json)
    feats = request.json.get("features", [])
    
    if not feats or len(feats) != 70:
        return jsonify({"error": "Must provide exactly 70 features"}), 400
    
    # Use DataFrame with feature names to avoid warning
    df_feats = pd.DataFrame([feats], columns=clf.feature_names_in_)
    
    # Get probability distribution from ensemble of 10 C4.5 trees
    probs = clf.predict_proba(df_feats)[0]
    labels = clf.classes_.tolist()
    
    # Build predictions dictionary in client's expected format
    # Convert all tech_field_ids to strings, ensure all 11 fields present
    predictions_dict = {}
    for field_id in range(1, 12):  # Fields 1-11
        str_id = str(field_id)
        if field_id in labels:
            idx = labels.index(field_id)
            predictions_dict[str_id] = float(probs[idx])
        else:
            predictions_dict[str_id] = 0.0
    
    print("\n\n/predict response:", predictions_dict)
    return jsonify(predictions_dict)

@app.post("/retrain")
def retrain():
    try:
        global clf
        clf = train_and_save()
        return jsonify({
            "status": "retrained", 
            "classes": clf.classes_.tolist(),
            "n_estimators": len(clf.estimators_),
            "algorithm": "C4.5 Ensemble with Soft Voting",
            "message": "Model retrained successfully with 10 C4.5 trees"
        })
    except ValueError as e:
        return jsonify({
            "status": "error",
            "error": str(e),
            "suggestion": "Ensure you have completed questionnaires in the database before retraining"
        }), 400
    except Exception as e:
        return jsonify({
            "status": "error", 
            "error": f"Unexpected error during retraining: {str(e)}"
        }), 500

if __name__ == "__main__":
    app.run(
        host="0.0.0.0",
        port=int(os.environ.get("PORT", 5001)),
        debug=True
    )
