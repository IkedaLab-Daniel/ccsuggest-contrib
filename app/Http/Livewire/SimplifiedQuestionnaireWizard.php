<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Question;
use App\Services\SimplifiedQuestionnaireService;
use App\Services\DecisionTreeService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class SimplifiedQuestionnaireWizard extends Component
{
    /** @var SimplifiedQuestionnaireService */
    protected $simplifiedService;
    
    /** @var DecisionTreeService */
    protected $decisionTreeService;
    
    /** @var string Current phase: core, specialized, completed */
    public string $currentPhase = 'core';
    
    /** @var int Current question index within the phase */
    public int $currentQuestionIndex = 0;
    
    /** @var array All user answers (questionId => answerValue) */
    public array $allAnswers = [];
    
    /** @var array Core answers (first 10 questions) */
    public array $coreAnswers = [];
    
    /** @var array Specialized answers */
    public array $specializedAnswers = [];
    
    /** @var array Current phase questions */
    public array $currentPhaseQuestions = [];
    
    /** @var Question|null Current question being displayed */
    public ?Question $currentQuestion = null;
    
    /** @var float Progress percentage */
    public float $progress = 0;
    
    /** @var array Top 4 career names */
    public array $topCareers = [];
    
    /** @var string|null Final recommendation */
    public ?string $recommendation = null;
    
    /** @var mixed Current answer value */
    public $currentAnswer = null;
    
    /** @var array For multiple choice questions */
    public array $selectedOptions = [];

    public function mount()
    {
        $this->ensureServicesInitialized();
        $this->initializeQuestionnaire();
    }
    
    /**
     * Ensure services are initialized (Livewire doesn't persist injected services)
     */
    protected function ensureServicesInitialized(): void
    {
        if (!$this->simplifiedService) {
            $this->simplifiedService = app(SimplifiedQuestionnaireService::class);
        }
        if (!$this->decisionTreeService) {
            $this->decisionTreeService = app(DecisionTreeService::class);
        }
    }
    
    protected function initializeQuestionnaire(): void
    {
        $this->ensureServicesInitialized();
        $structure = $this->simplifiedService->getQuestionnaireStructure();
        
        $this->currentPhase = $structure['phase'];
        $this->currentPhaseQuestions = $structure['questions']->toArray();
        
        $this->loadCurrentQuestion();
        $this->updateProgress();
    }
    
    protected function loadCurrentQuestion(): void
    {
        if (isset($this->currentPhaseQuestions[$this->currentQuestionIndex])) {
            $questionData = $this->currentPhaseQuestions[$this->currentQuestionIndex];
            $this->currentQuestion = Question::with('options')->find($questionData['id']);
        } else {
            $this->currentQuestion = null;
        }
        
        // Reset answer values
        $this->currentAnswer = null;
        $this->selectedOptions = [];
    }
    
    public function submitAnswer($answerValue = null)
    {
        if (!$this->currentQuestion) {
            return;
        }
        
        // Use provided answer or current form values
        $finalAnswer = $answerValue ?? $this->currentAnswer ?? 1;
        
        // Handle multiple choice answers
        if ($this->currentQuestion->type === 'multiple' && !empty($this->selectedOptions)) {
            $finalAnswer = $this->selectedOptions;
        }
        
        // Store the answer
        $this->allAnswers[$this->currentQuestion->id] = $finalAnswer;
        
        if ($this->currentPhase === 'core') {
            $this->coreAnswers[$this->currentQuestion->id] = $finalAnswer;
        } else {
            $this->specializedAnswers[$this->currentQuestion->id] = $finalAnswer;
        }
        
        Log::info('Answer submitted', [
            'question_id' => $this->currentQuestion->id,
            'answer' => $finalAnswer,
            'phase' => $this->currentPhase,
            'question_index' => $this->currentQuestionIndex
        ]);
        
        // Move to next question or phase
        $this->nextQuestion();
    }
    
    protected function nextQuestion(): void
    {
        $this->currentQuestionIndex++;
        
        // Check if current phase is complete
        if ($this->currentQuestionIndex >= count($this->currentPhaseQuestions)) {
            $this->completeCurrentPhase();
        } else {
            $this->loadCurrentQuestion();
            $this->updateProgress();
        }
    }
    
    protected function completeCurrentPhase(): void
    {
        if ($this->currentPhase === 'core') {
            // Core phase completed - move to specialized phase
            $this->startSpecializedPhase();
        } else {
            // Specialized phase completed - finish questionnaire
            $this->completeQuestionnaire();
        }
    }
    
    protected function startSpecializedPhase(): void
    {
        $this->currentPhase = 'specialized';
        $this->currentQuestionIndex = 0;
        
        // Get top careers and specialized questions
        $this->ensureServicesInitialized();
        $this->topCareers = $this->simplifiedService->analyzeTechCareerPreferences($this->coreAnswers);
        
        $specializedQuestions = $this->simplifiedService->getSpecializedQuestions($this->topCareers);
        
        $this->currentPhaseQuestions = $specializedQuestions->toArray();
        
        $this->loadCurrentQuestion();
        $this->updateProgress();
        
        Log::info('Started specialized phase', [
            'top_careers' => $this->topCareers,
            'specialized_questions_count' => count($this->currentPhaseQuestions)
        ]);
    }
    
    protected function completeQuestionnaire(): void
    {
        $this->currentPhase = 'completed';
        $this->currentQuestion = null;
        $this->progress = 100;
        
        // Generate complete answer payload
        $this->ensureServicesInitialized();
        $completeAnswers = $this->simplifiedService->generateCompleteAnswerPayload($this->allAnswers);
        
        // Generate recommendations
        $this->generateRecommendations($completeAnswers);
        
        Log::info('Questionnaire completed', [
            'total_answers' => count($this->allAnswers),
            'complete_payload_size' => count($completeAnswers),
            'recommendation' => $this->recommendation
        ]);
        
        // Redirect to results page immediately
        $this->redirect(route('student.results'));
    }
    
    protected function generateRecommendations(array $completeAnswers): void
    {
        if (auth()->check()) {
            try {
                $this->ensureServicesInitialized();
                $userId = auth()->id();
                
                // Save recommendations to database (no return value)
                $this->decisionTreeService->predictForUserWithFeatures(
                    $userId, 
                    $completeAnswers
                );
                
                // Set a simple recommendation based on top career from our analysis
                $this->recommendation = !empty($this->topCareers) ? $this->topCareers[0] : $this->getFallbackRecommendation();
                
                Log::info('ML recommendations saved successfully', [
                    'user_id' => $userId,
                    'simple_recommendation' => $this->recommendation
                ]);
                
            } catch (\Exception $e) {
                Log::warning('ML recommendation failed, using fallback', [
                    'error' => $e->getMessage()
                ]);
                $this->recommendation = $this->getFallbackRecommendation();
            }
        } else {
            $this->recommendation = $this->getFallbackRecommendation();
        }
    }
    
    protected function getFallbackRecommendation(): string
    {
        // Use the highest-scoring career from core answers as fallback
        if (!empty($this->topCareers)) {
            return $this->topCareers[0];
        }
        
        return 'Software Development';
    }
    
    protected function updateProgress(): void
    {
        $this->ensureServicesInitialized();
        $totalAnswered = count($this->allAnswers);
        $this->progress = $this->simplifiedService->calculateProgress($totalAnswered, $this->currentPhase);
    }
    
    public function getCareerName($careerName): string
    {
        return $careerName;
    }
    
    public function getCurrentPhaseInfo(): array
    {
        return [
            'phase' => $this->currentPhase,
            'question_number' => $this->currentQuestionIndex + 1,
            'total_in_phase' => count($this->currentPhaseQuestions),
            'overall_progress' => $this->progress
        ];
    }

    public function render()
    {
        return view('livewire.simplified-questionnaire-wizard');
    }
}