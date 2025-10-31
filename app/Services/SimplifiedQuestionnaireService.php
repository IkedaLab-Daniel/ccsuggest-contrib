<?php

namespace App\Services;

use App\Models\Question;
use App\Models\TechField;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class SimplifiedQuestionnaireService
{
    /**
     * Core questions count - these are questions 1-10
     */
    const CORE_QUESTIONS_COUNT = 10;
    
    /**
     * Questions per tech field in specialization phase
     */
    const QUESTIONS_PER_TECH_FIELD = 5;
    
        /**
     * Value used for skipped questions in the payload
     */
    const SKIP_ANSWER_VALUE = 5;
    
    /**
     * Core question to career mappings based on option selection
     * Each question maps option values (0-3) to specific tech careers
     */
    const CORE_QUESTION_CAREER_MAPPINGS = [
        1 => [  // Q1: Which activity excites you the most?
            0 => 'Artificial Intelligence',
            1 => 'Cybersecurity', 
            2 => 'Data Science & Analytics',
            3 => 'Software Development'
        ],
        2 => [  // Q2: How would you like to contribute to a project?
            0 => 'UI/UX Design',
            1 => 'Game Development',
            2 => 'Cloud Computing',
            3 => 'Internet of Things (IoT)'
        ],
        3 => [  // Q3: Which type of problems interest you the most?
            0 => 'Artificial Intelligence',
            1 => 'Cybersecurity',
            2 => 'Blockchain',
            3 => 'Robotics'
        ],
        4 => [  // Q4: Which environment do you see yourself in?
            0 => 'Cloud Computing',
            1 => 'Game Development',
            2 => 'UI/UX Design',
            3 => 'Robotics'
        ],
        5 => [  // Q5: What motivates you the most in tech?
            0 => 'Cybersecurity',
            1 => 'Data Science & Analytics',
            2 => 'Artificial Intelligence',
            3 => 'Game Development'
        ],
        6 => [  // Q6: How do you prefer to apply your skills?
            0 => 'Blockchain',
            1 => 'Internet of Things (IoT)',
            2 => 'Software Development',
            3 => 'Cloud Computing'
        ],
        7 => [  // Q7: Which tools would you enjoy mastering?
            0 => 'Artificial Intelligence',
            1 => 'Cybersecurity',
            2 => 'Game Development',
            3 => 'UI/UX Design'
        ],
        8 => [  // Q8: Which project would you rather work on?
            0 => 'Internet of Things (IoT)',
            1 => 'Data Science & Analytics',
            2 => 'Game Development',
            3 => 'Cloud Computing'
        ],
        9 => [  // Q9: What innovation excites you most?
            0 => 'Artificial Intelligence',
            1 => 'Blockchain',
            2 => 'Robotics',
            3 => 'Cybersecurity'
        ],
        10 => [ // Q10: How do you approach problem-solving?
            0 => 'Artificial Intelligence', // AI / Data Science
            1 => 'Cybersecurity',
            2 => 'UI/UX Design',
            3 => 'Software Development'
        ]
    ];
    
    /**
     * Specialized question sets mapped to specific question IDs
     */
    const SPECIALIZED_QUESTION_SETS = [
        'Artificial Intelligence' => [11, 12, 13, 14, 15],
        'Cybersecurity' => [17, 18, 19, 20, 21],
        'Cloud Computing' => [24, 25, 26, 27, 28],
        'Data Science & Analytics' => [29, 30, 31, 32, 33],
        'Game Development' => [35, 36, 37, 38, 39],
        'UI/UX Design' => [41, 42, 43, 44, 45],
        'Internet of Things (IoT)' => [47, 48, 49, 50, 51],
        'Blockchain' => [53, 54, 55, 56, 57],
        'Robotics' => [59, 60, 61, 62, 63],
        'Software Development' => [65, 66, 67, 68, 69]
    ];
    
    /**
     * Get the first 10 core questions (Q1-Q10)
     */
    public function getCoreQuestions(): Collection
    {
        return Question::with(['options'])
            ->whereIn('id', [1, 2, 3, 4, 5, 6, 7, 8, 9, 10])
            ->where('is_active', true)
            ->orderBy('id')
            ->get();
    }
    
    /**
     * Analyze core answers to determine top 4 tech career preferences
     * 
     * @param array $coreAnswers - Array of questionId => answerValue pairs
     * @return array - Array of career names sorted by preference score
     */
    public function analyzeTechCareerPreferences(array $coreAnswers): array
    {
        $careerScores = [];
        
        // Initialize scores for all careers
        $allCareers = array_unique(array_merge(...array_values(self::CORE_QUESTION_CAREER_MAPPINGS)));
        foreach ($allCareers as $career) {
            $careerScores[$career] = 0;
        }
        
        // Calculate scores based on core answers
        foreach ($coreAnswers as $questionId => $answerValue) {
            if (isset(self::CORE_QUESTION_CAREER_MAPPINGS[$questionId])) {
                $mapping = self::CORE_QUESTION_CAREER_MAPPINGS[$questionId];
                
                // Find which career this answer points to
                if (isset($mapping[$answerValue])) {
                    $selectedCareer = $mapping[$answerValue];
                    $careerScores[$selectedCareer]++;
                }
            }
        }
        
        // Sort careers by score (descending) and return top 4
        arsort($careerScores);
        $topCareers = array_slice(array_keys($careerScores), 0, 4, true);
        
        Log::info('Career preferences calculated', [
            'scores' => $careerScores,
            'top_4' => $topCareers
        ]);
        
        return $topCareers;
    }
    
    /**
     * Get specialized questions for the top 4 careers
     * 
     * @param array $topCareers - Array of 4 career names
     * @return Collection - Collection of questions grouped by career
     */
    public function getSpecializedQuestions(array $topCareers): Collection
    {
        $specializedQuestions = collect();
        
        foreach ($topCareers as $index => $careerName) {
            if (isset(self::SPECIALIZED_QUESTION_SETS[$careerName])) {
                $questionIds = self::SPECIALIZED_QUESTION_SETS[$careerName];
                
                $careerQuestions = Question::with(['options'])
                    ->whereIn('id', $questionIds)
                    ->where('is_active', true)
                    ->orderBy('id')
                    ->get();
                
                // Add metadata for frontend display
                foreach ($careerQuestions as $question) {
                    $question->setAttribute('specialization_phase', $index + 1);
                    $question->setAttribute('career_name', $careerName);
                    $question->setAttribute('career_rank', $index + 1);
                }
                
                $specializedQuestions = $specializedQuestions->merge($careerQuestions);
            }
        }
        
        Log::info('Specialized questions loaded', [
            'careers' => $topCareers,
            'total_questions' => $specializedQuestions->count()
        ]);
        
        return $specializedQuestions;
    }
    
    /**
     * Generate complete answer payload with skipped questions set to default value
     * 
     * @param array $userAnswers - Actual user answers (questionId => answerValue)
     * @return array - Complete answer payload as indexed array (not associative)
     */
    public function generateCompleteAnswerPayload(array $userAnswers): array
    {
        $completeAnswers = [];
        
        // Get all active questions ordered by ID (ML model expects specific order)
        $allQuestions = Question::where('is_active', true)->orderBy('id')->pluck('id');
        
        foreach ($allQuestions as $questionId) {
            if (isset($userAnswers[$questionId])) {
                // Use actual user answer
                $completeAnswers[] = $userAnswers[$questionId];
            } else {
                // Use default skip value
                $completeAnswers[] = self::SKIP_ANSWER_VALUE;
            }
        }
        
        Log::info('Complete answer payload generated', [
            'total_questions' => count($allQuestions),
            'answered_questions' => count($userAnswers),
            'skipped_questions' => count($allQuestions) - count($userAnswers),
            'payload_sample' => array_slice($completeAnswers, 0, 10) // First 10 values for debugging
        ]);
        
        return $completeAnswers;
    }
    
    /**
     * Get questionnaire structure for the simplified algorithm
     * 
     * @param array $coreAnswers - Optional core answers if already completed
     * @return array - Questionnaire structure with phases
     */
    public function getQuestionnaireStructure(array $coreAnswers = []): array
    {
        $structure = [
            'phase' => 'core',
            'total_questions' => 30, // 10 core + 20 specialized
            'current_phase_questions' => 0,
            'completed_phases' => [],
            'questions' => []
        ];
        
        if (empty($coreAnswers)) {
            // Phase 1: Core questions
            $structure['phase'] = 'core';
            $structure['questions'] = $this->getCoreQuestions();
            $structure['current_phase_questions'] = count($structure['questions']);
        } else {
            // Phase 2: Specialized questions
            $topCareers = $this->analyzeTechCareerPreferences($coreAnswers);
            
            $structure['phase'] = 'specialized';
            $structure['questions'] = $this->getSpecializedQuestions($topCareers);
            $structure['current_phase_questions'] = count($structure['questions']);
            $structure['completed_phases'] = ['core'];
            $structure['top_careers'] = $topCareers;
        }
        
        return $structure;
    }
    
    /**
     * Calculate progress percentage
     * 
     * @param int $answeredQuestions - Number of questions answered
     * @param string $currentPhase - Current phase (core/specialized/completed)
     * @return float - Progress percentage
     */
    public function calculateProgress(int $answeredQuestions, string $currentPhase = 'core'): float
    {
        $totalQuestions = 30; // 10 core + 20 specialized
        
        switch ($currentPhase) {
            case 'core':
                return min(($answeredQuestions / self::CORE_QUESTIONS_COUNT) * 33.33, 33.33);
            case 'specialized':
                $coreProgress = 33.33;
                $specializedProgress = (($answeredQuestions - self::CORE_QUESTIONS_COUNT) / 20) * 66.67;
                return min($coreProgress + $specializedProgress, 100);
            case 'completed':
                return 100;
            default:
                return ($answeredQuestions / $totalQuestions) * 100;
        }
    }
}