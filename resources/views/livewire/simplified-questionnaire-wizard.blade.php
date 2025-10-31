<div class="bg-white p-6 rounded-lg shadow animate-slide-down">

  {{-- Progress bar --}}
  <div class="w-full bg-gray-200 h-2 mb-4 rounded">
    <div class="bg-blue-600 h-2 rounded transition-all duration-300" style="width: {{ $progress }}%"></div>
  </div>

  {{-- Phase indicator --}}
  <div class="mb-4">
    @if($currentPhase === 'core')
      <div class="text-sm text-blue-600 font-semibold">
        Phase 1: Core Assessment ({{ $currentQuestionIndex + 1 }}/10)
      </div>
      <p class="text-xs text-gray-600">Determining your tech field preferences</p>
    @elseif($currentPhase === 'specialized')
      <div class="text-sm text-purple-600 font-semibold">
        Phase 2: Specialized Questions ({{ $currentQuestionIndex + 1 }}/20)
      </div>
      <p class="text-xs text-gray-600">Deep dive into your top tech interests</p>
    @endif
  </div>

  @if($currentPhase === 'completed')
    {{-- Completion screen --}}
    <div class="text-center">
      <div class="mb-6">
        <div class="mx-auto w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mb-4">
          <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
          </svg>
        </div>
        <h2 class="text-2xl font-bold text-green-600 mb-2">Questionnaire Complete!</h2>
        <p class="text-gray-600">Thank you for completing our comprehensive tech career assessment.</p>
      </div>
      
      @if($recommendation)
        <div class="bg-blue-50 border border-blue-200 p-6 rounded-lg mb-6">
          <h3 class="text-lg font-semibold text-blue-900 mb-2">Your Recommended Tech Field:</h3>
          <p class="text-2xl font-bold text-blue-600">{{ $recommendation }}</p>
        </div>
      @endif
      
      @if(!empty($topCareers))
        <div class="bg-gray-50 border border-gray-200 p-6 rounded-lg mb-6">
          <h3 class="text-lg font-semibold text-gray-900 mb-3">Your Top Career Interests:</h3>
          <div class="grid grid-cols-2 gap-3">
            @foreach($topCareers as $index => $careerName)
              <div class="flex items-center justify-between bg-white p-3 rounded border">
                <span class="font-medium">#{{ $index + 1 }}</span>
                <span class="text-sm">{{ $careerName }}</span>
              </div>
            @endforeach
          </div>
        </div>
      @endif
      
      <div class="bg-blue-50 border border-blue-200 p-4 rounded-lg mb-6">
        <p class="text-blue-800 text-sm">
          <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
          </svg>
          Your detailed recommendations have been saved and you'll be redirected shortly to view them.
        </p>
      </div>
      
      <div class="space-y-3">
        <a href="{{ route('student.results') }}" 
           class="inline-block bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition">
          View Detailed Results
        </a>
        <div>
          <button onclick="window.print()" 
                  class="text-gray-600 hover:text-gray-800 text-sm underline">
            Print Results
          </button>
        </div>
      </div>
    </div>

  @elseif($currentQuestion)
    {{-- Question display --}}
    <div class="mb-6">
      <h2 class="text-lg font-semibold mb-2">{{ $currentQuestion->text }}</h2>
      
      @if($currentPhase === 'specialized' && isset($currentQuestion->career_name))
        <div class="text-sm text-purple-600 mb-3">
          <span class="bg-purple-100 px-2 py-1 rounded">
            {{ $currentQuestion->career_name }} Question
          </span>
        </div>
      @endif
    </div>

    {{-- Question input based on type --}}
    @if($currentQuestion->type === 'single')
      {{-- Single choice questions --}}
      <div class="space-y-3">
        @foreach($currentQuestion->options as $option)
          <button
            wire:click="submitAnswer({{ $option->value }})"
            class="w-full text-left px-4 py-3 border border-gray-200 rounded-lg hover:bg-blue-50 hover:border-blue-300 transition-all duration-200 group"
          >
            <div class="flex items-start">
              <span class="inline-block w-6 h-6 rounded-full border-2 border-gray-300 mr-3 mt-0.5 group-hover:border-blue-500"></span>
              <span class="group-hover:text-blue-700">{{ $option->text }}</span>
            </div>
          </button>
        @endforeach
      </div>

    @elseif($currentQuestion->type === 'multiple')
      {{-- Multiple choice questions --}}
      <div class="space-y-3 mb-6">
        @foreach($currentQuestion->options as $option)
          <label class="flex items-start cursor-pointer px-4 py-3 border border-gray-200 rounded-lg hover:bg-blue-50 hover:border-blue-300 transition-all duration-200">
            <input type="checkbox"
                   wire:model="selectedOptions"
                   value="{{ $option->value }}"
                   class="mt-1 mr-3 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
            <span>{{ $option->text }}</span>
          </label>
        @endforeach
      </div>
      <button wire:click="submitAnswer()"
              class="w-full bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition-colors duration-200 font-semibold">
        Continue
      </button>

    @elseif($currentQuestion->type === 'scale')
      {{-- Scale questions (1-5) --}}
      <div class="mb-6">
        <div class="px-4">
          <input type="range" 
                 min="1" 
                 max="5" 
                 wire:model="currentAnswer" 
                 class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer slider">
          <div class="flex justify-between text-sm text-gray-600 mt-2 px-1">
            <span>Strongly Disagree</span>
            <span>Neutral</span>
            <span>Strongly Agree</span>
          </div>
          <div class="text-center mt-3">
            <span class="text-2xl font-bold text-blue-600">{{ $currentAnswer ?? 3 }}</span>
          </div>
        </div>
      </div>
      <button wire:click="submitAnswer({{ $currentAnswer ?? 3 }})"
              class="w-full bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition-colors duration-200 font-semibold">
        Continue
      </button>
    @endif

  @else
    {{-- Loading state --}}
    <div class="text-center py-8">
      <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-600 mx-auto mb-4"></div>
      <p class="text-gray-600">Loading next question...</p>
    </div>
  @endif

</div>

<style>
.slider::-webkit-slider-thumb {
  appearance: none;
  height: 20px;
  width: 20px;
  border-radius: 50%;
  background: #2563eb;
  cursor: pointer;
}

.slider::-moz-range-thumb {
  height: 20px;
  width: 20px;
  border-radius: 50%;
  background: #2563eb;
  cursor: pointer;
  border: none;
}

.animate-slide-down {
  animation: slideDown 0.3s ease-out;
}

@keyframes slideDown {
  from {
    opacity: 0;
    transform: translateY(-10px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}
</style>