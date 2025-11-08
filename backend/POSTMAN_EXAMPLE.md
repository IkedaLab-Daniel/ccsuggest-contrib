# Flask API - Postman Testing Guide

## `/predict` Endpoint

### Request Details
- **Method**: POST
- **URL**: `http://127.0.0.1:5001/predict` (local) or `https://your-flask-app.onrender.com/predict` (production)
- **Headers**:
  ```
  Content-Type: application/json
  ```

### Request Body Format

The `/predict` endpoint expects a JSON object with a `features` array containing **exactly 70 numeric values** (representing answers to questions Q1-Q70).

Each value should be a number between 0-5 (based on your questionnaire scale).

```json
{
  "features": [
    3, 2, 2, 3, 3, 4, 1, 0, 5, 2,
    3, 3, 5, 0, 5, 1, 3, 0, 5, 1,
    1, 0, 3, 2, 2, 0, 2, 0, 3, 5,
    0, 1, 5, 3, 3, 4, 1, 2, 4, 0,
    0, 4, 0, 0, 5, 1, 1, 1, 0, 0,
    3, 1, 0, 2, 1, 3, 3, 1, 2, 2,
    0, 2, 2, 3, 1, 1, 1, 3, 2, 3
  ]
}
```

### Example Response

The response will be a JSON object with `tech_field_id` as keys and probability scores as values:

```json
{
  "1": 0.05,
  "2": 0.12,
  "3": 0.08,
  "4": 0.03,
  "5": 0.15,
  "6": 0.09,
  "7": 0.35,
  "8": 0.07,
  "9": 0.04,
  "10": 0.02
}
```

The highest probability indicates the recommended tech field. In this example, field `7` has 35% confidence.

---

## `/retrain` Endpoint

### Request Details
- **Method**: POST
- **URL**: `http://127.0.0.1:5001/retrain`
- **Headers**: None required (or `Content-Type: application/json`)
- **Body**: Empty or `{}`

### Example Success Response
```json
{
  "status": "retrained",
  "classes": [1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
  "message": "Model retrained successfully"
}
```

### Example Error Response
```json
{
  "status": "error",
  "error": "Insufficient training data: only 5 records found. Need at least 10 records.",
  "suggestion": "Ensure you have completed questionnaires in the database before retraining"
}
```

---

## `/health` Endpoint

### Request Details
- **Method**: GET
- **URL**: `http://127.0.0.1:5001/health`

### Response
```json
{
  "status": "ok"
}
```

---

## Quick Test Samples

### Sample 1: AI/ML Focused User
```json
{
  "features": [
    5, 3, 4, 5, 4, 5, 2, 1, 5, 3,
    4, 5, 5, 1, 5, 2, 4, 1, 5, 2,
    2, 1, 4, 3, 3, 1, 3, 1, 4, 5,
    1, 2, 5, 4, 4, 5, 2, 3, 5, 1,
    1, 5, 1, 1, 5, 2, 2, 2, 1, 1,
    4, 2, 1, 3, 2, 4, 4, 2, 3, 3,
    1, 3, 3, 4, 2, 2, 2, 4, 3, 4
  ]
}
```

### Sample 2: Web Development Focused User
```json
{
  "features": [
    2, 4, 3, 2, 3, 3, 4, 3, 2, 4,
    3, 2, 3, 3, 3, 4, 3, 3, 3, 4,
    4, 3, 3, 3, 4, 4, 3, 3, 2, 2,
     3, 4, 2, 3, 3, 2, 4, 4, 2, 3,
    3, 2, 3, 3, 2, 4, 4, 4, 3, 3,
    2, 3, 3, 3, 4, 2, 2, 4, 4, 3,
    3, 3, 4, 2, 4, 4, 3, 2, 4, 3
  ]
}
```

### Sample 3: Cybersecurity Focused User
```json
{
  "features": [
    1, 2, 1, 2, 2, 2, 3, 4, 1, 2,
    2, 1, 2, 4, 2, 3, 2, 4, 2, 3,
    3, 4, 2, 2, 2, 3, 2, 4, 1, 1,
    4, 3, 1, 2, 2, 1, 3, 2, 1, 4,
    4, 1, 4, 4, 1, 3, 3, 3, 4, 4,
    1, 3, 4, 2, 3, 1, 1, 3, 2, 2,
    4, 2, 2, 1, 3, 3, 4, 1, 2, 2
  ]
}
```

---

## How to Test in Postman

1. **Create a new request**
2. **Set method to POST**
3. **Enter URL**: `http://127.0.0.1:5001/predict`
4. **Go to Headers tab**:
   - Add `Content-Type` with value `application/json`
5. **Go to Body tab**:
   - Select `raw`
   - Select `JSON` from dropdown
   - Paste one of the sample payloads above
6. **Click Send**
7. **View response** - You'll see probability scores for each tech field

---

## Tech Field IDs Reference

Based on typical questionnaire structure:
- 1: Artificial Intelligence
- 2: Data Science
- 3: Web Development
- 4: Mobile Development
- 5: Game Development
- 6: Cybersecurity
- 7: Cloud Computing
- 8: DevOps
- 9: IoT/Embedded Systems
- 10: Blockchain

(Verify actual IDs from your `tech_fields` database table)

---

## Troubleshooting

### Error: "Model not found"
- The model.pkl file doesn't exist
- Run `/retrain` endpoint first to build the model

### Error: 500 Internal Server Error
- Check Flask console for error details
- Ensure features array has exactly 70 values
- Ensure all values are numeric

### Error: CORS blocked
- Already resolved! CORS is now open to all origins with `CORS(app)`
