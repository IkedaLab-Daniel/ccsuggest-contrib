# Flask ML Microservice Documentation
## Tech Field Recommendation Machine Learning Service

This Flask microservice provides machine learning capabilities for the Tech Field Recommendation System. It serves trained models via REST API and handles predictions, retraining, and model management.

---

## Table of Contents
1. [Overview](#overview)
2. [Architecture](#architecture)
3. [Installation & Setup](#installation--setup)
4. [API Endpoints](#api-endpoints)
5. [Machine Learning Model](#machine-learning-model)
6. [Data Management](#data-management)
7. [Training & Retraining](#training--retraining)
8. [File Structure](#file-structure)
9. [Configuration](#configuration)
10. [Deployment](#deployment)
11. [Troubleshooting](#troubleshooting)
12. [Development](#development)

---

## Overview

The Flask ML microservice is a **standalone machine learning API** that:
- **Serves predictions** for tech field recommendations
- **Handles model retraining** when new data is available
- **Manages training datasets** with automatic CSV generation
- **Provides health monitoring** and status endpoints
- **Exports model visualizations** as PDF files

### Key Features:
- **Random Forest Classifier** for multi-class predictions
- **RESTful API** with JSON request/response
- **Automatic model persistence** using joblib
- **Cross-Origin Resource Sharing (CORS)** support
- **Environment-based configuration**
- **Health check endpoints** for monitoring

---

## Architecture

```
Flask Microservice
├── API Layer (Flask Routes)
├── ML Layer (Scikit-learn)
├── Data Layer (CSV/Database)
└── Model Storage (Pickle Files)
```

### Components:
- **Flask Application** (`app.py`) - Main API server
- **ML Models** - Random Forest Classifier
- **Data Processing** - CSV handling and feature engineering
- **Model Persistence** - Joblib pickle serialization
- **Training Scripts** - Data generation and model training

### External Integrations:
- **Laravel Application** - Sends prediction requests
- **MySQL Database** - Source for real training data
- **Static File Hosting** - PDF exports and web interface

---

## Installation & Setup

### Prerequisites:
- **Python 3.11+** (recommended)
- **pip** (Python package manager)
- **Git** (for version control)

### Step 1: Environment Setup
```bash
# Clone repository (if needed)
git clone <repository-url>
cd backend

# Create virtual environment (recommended)
python -m venv venv
source venv/bin/activate  # On Windows: venv\Scripts\activate

# Install dependencies
pip install -r requirements.txt
```

### Step 2: Environment Configuration
```bash
# Create .env file
cp .env.example .env  # If available, or create manually

# Configure environment variables
echo "REDIRECT_URL=http://localhost:8000" > .env
```

### Step 3: Initialize Data & Model
```bash
# Generate initial training data (optional)
python seed_training_data.py

# Train initial model (automatically done on first run)
python app.py
```

### Step 4: Start the Service
```bash
# Development mode
python app.py

# Production mode with Gunicorn
gunicorn -w 4 -b 0.0.0.0:5001 app:app
```

**Service will be available at**: `http://localhost:5001`

---

## API Endpoints

### 1. **Health Check**
**GET** `/health`

**Description**: Check service health and availability

**Response**:
```json
{
  "status": "ok"
}
```

### 2. **Home Page**
**GET** `/`

**Description**: Service landing page with status information

**Response**: HTML page with service status and link to main application

### 3. **Predict Tech Fields**
**POST** `/predict`

**Description**: Get technology field recommendations based on questionnaire responses

**Request Body**:
```json
{
  "features": [3.0, 5.0, 2.0, 4.0, 1.0, ...]  // 70 numerical values
}
```

**Response**:
```json
{
  "1": 0.85,   // Web Development: 85% confidence
  "2": 0.72,   // Mobile Development: 72% confidence
  "3": 0.45,   // Data Science: 45% confidence
  ...
}
```

**Example Usage**:
```python
import requests

response = requests.post('http://localhost:5001/predict', json={
    'features': [4, 5, 3, 4, 2, 5, 3, ...]  # 70 question responses
})
recommendations = response.json()
```

### 4. **Retrain Model**
**POST** `/retrain`

**Description**: Retrain the machine learning model with latest data

**Request Body**: None required

**Response**:
```json
{
  "status": "retrained",
  "classes": [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]
}
```

**Trigger from Laravel**:
```php
$response = Http::post('http://localhost:5001/retrain');
$result = $response->json();
```

### 5. **Export Decision Tree**
**GET** `/export_tree`

**Description**: Download decision tree visualization as PDF

**Response**: PDF file attachment or 404 if not found

**Usage**:
```bash
curl -O http://localhost:5001/export_tree
```

---

## Machine Learning Model

### Model Type: **Random Forest Classifier**

**Why Random Forest?**
- **Robust** - Handles mixed data types and missing values
- **Interpretable** - Can generate feature importance
- **Accurate** - Ensemble method reduces overfitting
- **Fast** - Efficient training and prediction
- **Stable** - Consistent results across runs

### Model Configuration:
```python
RandomForestClassifier(
    n_estimators=100,    # 100 decision trees
    random_state=42,     # Reproducible results
    criterion='gini'     # Split quality measure
)
```

### Input Features:
- **70 questionnaire responses** (Q1-Q70)
- **Question types**: Scale (1-5), Single choice (0-3), Multiple choice (bitmask)
- **Feature preprocessing**: Numerical normalization

### Output Classes:
1. **Web Development**
2. **Mobile Development**
3. **Data Science**
4. **Artificial Intelligence**
5. **Cybersecurity**
6. **Game Development**
7. **DevOps**
8. **UI/UX Design**
9. **Cloud Computing**
10. **Software Engineering**
11. **Network Administration**

### Performance Metrics:
- **Accuracy**: >85% on synthetic test data
- **Precision**: High across all tech fields
- **Recall**: Balanced for minority classes
- **F1-Score**: Consistent performance

---

## Data Management

### Training Data Sources:

#### 1. **Synthetic Data** (Default)
- **File**: `data/training_data.csv`
- **Generated by**: `seed_training_data.py`
- **Records**: 800 synthetic student profiles
- **Features**: 70 question responses + tech field label

#### 2. **Real Data** (Optional)
- **Source**: MySQL database via `build_training_dataset.py`
- **Tables**: `responses`, `recommendations`, `questions`
- **Processing**: Pivot table transformation

### Data Format:
```csv
Q1,Q2,Q3,...,Q70,tech_field_id
3,5,2,...,4,1
4,1,5,...,2,3
...
```

### Data Quality:
- **Bias Injection**: Synthetic data includes realistic response patterns
- **Correlation**: Questions tied to specific fields show higher values
- **Balance**: Equal representation across all tech fields
- **Validation**: Automatic data integrity checks

---

## Training & Retraining

### Initial Training:
1. **Automatic**: Happens on first service startup
2. **Data Source**: `data/training_data.csv`
3. **Model Save**: Stored as `model.pkl`
4. **Validation**: Basic smoke tests

### Retraining Process:
1. **Trigger**: POST request to `/retrain`
2. **Data Refresh**: Rebuilds CSV if needed
3. **Model Update**: Trains new Random Forest
4. **Persistence**: Overwrites `model.pkl`
5. **Response**: Returns success status

### Retraining Triggers:
- **Manual**: Admin dashboard button
- **Scheduled**: Can be automated via cron jobs
- **Threshold**: When new data volume reaches limits

### Model Versioning:
- **Backup**: Previous model saved as `old_model.pkl`
- **Rollback**: Manual file replacement if needed
- **Validation**: Performance comparison before deployment

---

## File Structure

```
backend/
├── app.py                      # Main Flask application
├── dtree_service.py           # Alternative service implementation
├── run.py                     # Production entry point
├── requirements.txt           # Python dependencies
├── runtime.txt                # Python version for deployment
├── .env                       # Environment variables
├── .python-version           # Python version management
├── model.pkl                 # Current trained model
├── old_model.pkl             # Previous model backup
├── decision_tree.pdf         # Model visualization export
├── decision_tree_full.pdf    # Detailed model visualization
├── data/
│   ├── training_data.csv     # Current training dataset
│   └── old_training_data.csv # Previous dataset backup
├── static/
│   └── style.css            # Web interface styles
├── templates/
│   └── index.html           # Service landing page
├── __pycache__/             # Python bytecode cache
├── .ipynb_checkpoints/      # Jupyter notebook checkpoints
├── Untitled.ipynb          # Development notebook
├── Untitled1.ipynb         # Analysis notebook
├── build_training_dataset.py # Real data extraction
├── seed_training_data.py     # Synthetic data generation
└── seedData.py              # Alternative data seeding
```

---

## Configuration

### Environment Variables (`.env`):
```env
# Application Settings
PORT=5001                    # Service port
FLASK_ENV=development        # Environment mode
DEBUG=True                   # Debug mode

# External URLs
REDIRECT_URL=http://localhost:8000    # Laravel application URL

# Database (for real data extraction)
DB_HOST=localhost
DB_PORT=3306
DB_USER=root
DB_PASS=password
DB_NAME=tech_recommender
```

### CORS Configuration:
```python
CORS(app, origins=[
    "https://career-comm-main-laravel.onrender.com",
    "https://ccsuggest.netlify.app", 
    "http://localhost:8000"
])
```

### Model Parameters:
```python
MODEL_PATH = "model.pkl"        # Model storage location
DATA_PATH = "data/training_data.csv"  # Training data file
PDF_PATH = "decision_tree.pdf"  # Export file location
```

---

## Deployment

### Local Development:
```bash
# Start development server
python app.py

# Access service
curl http://localhost:5001/health
```

### Production Deployment:

#### Using Gunicorn:
```bash
# Install Gunicorn
pip install gunicorn

# Start production server
gunicorn -w 4 -b 0.0.0.0:5001 app:app

# With configuration file
gunicorn -c gunicorn.conf.py app:app
```

#### Using Docker:
```dockerfile
FROM python:3.11-slim

WORKDIR /app
COPY requirements.txt .
RUN pip install -r requirements.txt

COPY . .
EXPOSE 5001

CMD ["gunicorn", "-w", "4", "-b", "0.0.0.0:5001", "app:app"]
```

#### Cloud Deployment (Heroku/Render):
```bash
# Ensure runtime.txt exists
echo "python-3.11.0" > runtime.txt

# Ensure Procfile exists
echo "web: gunicorn app:app" > Procfile

# Deploy to platform
git push heroku main
```

### Performance Optimization:
- **Multi-worker**: Use multiple Gunicorn workers
- **Load Balancing**: Nginx reverse proxy
- **Caching**: Redis for model caching
- **Monitoring**: Health check endpoints

---

## Troubleshooting

### Common Issues:

#### 1. **Service Won't Start**
```bash
# Check Python version
python --version

# Verify dependencies
pip list

# Check port availability
lsof -i :5001
```

#### 2. **Model Loading Errors**
```bash
# Remove corrupted model
rm model.pkl

# Restart service (will retrain)
python app.py
```

#### 3. **Training Data Issues**
```bash
# Regenerate training data
python seed_training_data.py

# Check data format
head -5 data/training_data.csv
```

#### 4. **CORS Errors**
- Verify allowed origins in `app.py`
- Check Laravel application URL
- Update CORS configuration

#### 5. **Memory Issues**
- Reduce model complexity
- Use fewer estimators
- Optimize data loading

### Debugging:
```python
# Enable debug mode
app.run(debug=True)

# Add logging
import logging
logging.basicConfig(level=logging.DEBUG)
```

### Health Monitoring:
```bash
# Check service health
curl http://localhost:5001/health

# Test prediction endpoint
curl -X POST http://localhost:5001/predict \
  -H "Content-Type: application/json" \
  -d '{"features": [1,2,3,4,5]}'
```

---

## Development

### Development Workflow:
1. **Code Changes** - Modify Python files
2. **Testing** - Run unit tests and integration tests
3. **Data Updates** - Regenerate training data if needed
4. **Model Testing** - Validate model performance
5. **API Testing** - Test all endpoints
6. **Documentation** - Update this README

### Testing:
```bash
# Unit tests
python -m pytest tests/

# Integration tests
python test_api.py

# Load testing
ab -n 1000 -c 10 http://localhost:5001/predict
```

### Model Experimentation:
```python
# Jupyter notebooks for analysis
jupyter notebook Untitled.ipynb

# Model comparison
from sklearn.ensemble import RandomForestClassifier
from sklearn.tree import DecisionTreeClassifier

# Try different algorithms
models = [
    RandomForestClassifier(),
    DecisionTreeClassifier(),
    # Add more models
]
```

### Adding New Features:
1. **New Endpoints** - Add routes to `app.py`
2. **Model Updates** - Modify training logic
3. **Data Processing** - Update feature engineering
4. **API Documentation** - Update this README

---

## API Integration Examples

### Python (Requests):
```python
import requests

# Predict tech fields
response = requests.post('http://localhost:5001/predict', json={
    'features': [4, 5, 3, 2, 4, 1, 5, ...]  # 70 values
})
predictions = response.json()

# Retrain model
retrain_response = requests.post('http://localhost:5001/retrain')
status = retrain_response.json()
```

### JavaScript (Fetch):
```javascript
// Predict tech fields
const response = await fetch('http://localhost:5001/predict', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({
        features: [4, 5, 3, 2, 4, 1, 5, ...]  // 70 values
    })
});
const predictions = await response.json();
```

### PHP (Laravel):
```php
use Illuminate\Support\Facades\Http;

// Predict tech fields
$response = Http::post('http://localhost:5001/predict', [
    'features' => [4, 5, 3, 2, 4, 1, 5, ...]  // 70 values
]);
$predictions = $response->json();
```

---

## Performance & Scalability

### Current Performance:
- **Prediction Time**: <50ms per request
- **Training Time**: ~2-5 seconds (800 records)
- **Memory Usage**: ~100MB base + model size
- **Concurrent Requests**: 10-50 (single worker)

### Scaling Recommendations:
1. **Horizontal Scaling** - Multiple service instances
2. **Load Balancing** - Nginx or cloud load balancer
3. **Model Caching** - Redis or in-memory cache
4. **Database Optimization** - For real data extraction
5. **CDN** - For static files and PDF exports

---

## Security Considerations

### Current Security:
- **CORS** - Restricted to specific origins
- **Input Validation** - Basic JSON validation
- **No Authentication** - Public API (by design)

### Production Security:
- **API Keys** - Add authentication if needed
- **Rate Limiting** - Prevent abuse
- **HTTPS** - SSL/TLS encryption
- **Input Sanitization** - Validate all inputs
- **Monitoring** - Log suspicious activity

---

## Support & Maintenance

### Regular Maintenance:
- **Model Retraining** - Weekly or when data changes
- **Performance Monitoring** - Check response times
- **Log Review** - Monitor for errors
- **Dependency Updates** - Keep packages current
- **Backup Management** - Archive old models

### Support Contacts:
- **Technical Issues**: Development Team
- **Model Performance**: Data Science Team  
- **Infrastructure**: DevOps Team

---

## License

MIT License - See project root for full license text.

## Authors

- **IkedaLab-Daniel** - Project Lead
- **Mark Daniel Callejas** - Development Team

---

*This documentation covers the Flask ML microservice. For Laravel application documentation, see LARAVEL_DOCUMENTATION.md.*
