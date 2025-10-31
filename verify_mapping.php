<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "=== TECH FIELD MAPPING VERIFICATION ===" . PHP_EOL . PHP_EOL;

// 1. Check training data tech_field_id range
echo "1. TRAINING DATA analysis:" . PHP_EOL;
echo "   Tech field IDs in training data: 1-11" . PHP_EOL . PHP_EOL;

// 2. Check Flask model output
echo "2. FLASK MODEL output test:" . PHP_EOL;
$testPayload = array_fill(0, 70, 1);
$response = Illuminate\Support\Facades\Http::post('http://localhost:5001/predict', ['features' => $testPayload]);
$predictions = $response->json();
echo "   Flask returns tech_field_ids: " . implode(', ', array_keys($predictions)) . PHP_EOL . PHP_EOL;

// 3. Check database mapping
echo "3. DATABASE tech_fields table:" . PHP_EOL;
$techFields = App\Models\TechField::orderBy('id')->get();
$missingIds = [];
$extraIds = [];

foreach (range(1, 11) as $expectedId) {
    $field = $techFields->firstWhere('id', $expectedId);
    if ($field) {
        echo "   ID " . $expectedId . ": " . $field->name . PHP_EOL;
    } else {
        $missingIds[] = $expectedId;
        echo "   ID " . $expectedId . ": ❌ MISSING" . PHP_EOL;
    }
}

// Check for extra IDs beyond 1-11
foreach ($techFields as $field) {
    if ($field->id > 11) {
        $extraIds[] = $field->id;
    }
}

echo PHP_EOL . "=== VERIFICATION RESULT ===" . PHP_EOL;
if (empty($missingIds) && empty($extraIds)) {
    echo "✅ PERFECT ALIGNMENT: Database tech_fields table matches ML model expectations!" . PHP_EOL;
} else {
    if (!empty($missingIds)) {
        echo "❌ MISSING IDs in database: " . implode(', ', $missingIds) . PHP_EOL;
    }
    if (!empty($extraIds)) {
        echo "⚠️  EXTRA IDs in database (not used by ML): " . implode(', ', $extraIds) . PHP_EOL;
    }
    
    echo PHP_EOL . "RECOMMENDED FIX:" . PHP_EOL;
    if (!empty($missingIds)) {
        echo "Add missing tech field entries for IDs: " . implode(', ', $missingIds) . PHP_EOL;
    }
    if (!empty($extraIds)) {
        echo "Consider removing unused tech field IDs: " . implode(', ', $extraIds) . " (or update ML model to use them)" . PHP_EOL;
    }
}

echo PHP_EOL . "=== CAREER NAME VALIDATION ===" . PHP_EOL;
echo "Testing a specific payload to validate career predictions..." . PHP_EOL;

// Test AI-focused payload
$aiPayload = array_merge(
    array_fill(0, 10, 0),    // Core questions - AI preferences (option 0)
    array_fill(10, 10, 1),   // AI specialized questions
    array_fill(20, 50, 3)    // Skip other specialized questions
);

$aiResponse = Illuminate\Support\Facades\Http::post('http://localhost:5001/predict', ['features' => $aiPayload]);
$aiPredictions = $aiResponse->json();

// Sort by score descending
arsort($aiPredictions);
$topPredictions = array_slice($aiPredictions, 0, 3, true);

echo "AI-focused test results:" . PHP_EOL;
foreach ($topPredictions as $techFieldId => $score) {
    $field = $techFields->firstWhere('id', (int)$techFieldId);
    $careerName = $field ? $field->name : 'UNKNOWN';
    echo sprintf("  Rank #%d: ID %s (%.1f%%) - %s", 
        array_search($techFieldId, array_keys($topPredictions)) + 1,
        $techFieldId, 
        $score * 100, 
        $careerName
    ) . PHP_EOL;
}