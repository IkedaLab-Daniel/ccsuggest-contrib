<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Question;
use App\Models\QuestionFlow;
use App\Models\Response;
use Illuminate\Support\Facades\Auth;

class QuestionnaireWizard extends Component
{
 
    public Question $current;


    public float $progress = 0;

    public array $steps = [];

    public $value;

    /** @var array For multiple-choice questions */
    public array $selectedOptions = [];

    /** @var int Maximum number of questions to ask */
    protected int $maxSteps = 20;

    public function mount()
    {
        $first = Question::doesntHave('flows')->inRandomOrder()->first();
        $this->loadQuestion($first->id);
    }

    protected function loadQuestion(int $id): void
    {
        $this->current = Question::with('options','flows')->findOrFail($id);
        $this->steps[] = $id;
        $this->updateProgress();
    }

    public function submitAnswer($optionId = null, $value = null)
    {
        // 1) Save the response
        Response::updateOrCreate(
            ['user_id' => Auth::id(), 'question_id' => $this->current->id],
            ['option_id' => $optionId, 'value' => $value]
        );

        // 2) If we've already shown maxQuestions, finish
        if (count($this->steps) >= $this->maxSteps) {
            return redirect()->route('recommendations.index');
        }

        // 3) Determine next question via flow or random unasked
        $flow = QuestionFlow::where('question_id', $this->current->id)
            ->when($optionId, fn($q) => $q->where('option_id', $optionId))
            ->first();

        if ($flow) {
            $next = $flow->next_question_id;
        } else {
            $unasked = Question::whereNotIn('id', $this->steps)
                ->inRandomOrder()
                ->first();
            $next = $unasked?->id;
        }

        // 4) Either load next or finish if none left
        if ($next) {
            $this->value = null;
            $this->selectedOptions = [];
            $this->loadQuestion($next);
        } else {
            return redirect()->route('recommendations.index');
            if (count($this->steps) >= $this->maxSteps) {
    app(\App\Services\DecisionTreeService::class)
        ->predictForUser(Auth::id());

    return redirect()->route('recommendations.index');
}

        }
    }

    protected function updateProgress(): void
    {
        $this->progress = min(100, count($this->steps) * (100 / $this->maxSteps));
    }

    public function render()
    {
        return view('livewire.questionnaire-wizard');
    }
}
