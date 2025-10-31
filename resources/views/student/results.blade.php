{{-- resources/views/student/results.blade.php --}}
@extends('layouts.student')

@section('content')
@if(isset($error) && $error)
  <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4 max-w-4xl mx-auto">
    {{ $error }}
  </div>
@endif

<!-- Main Container -->
<div class="max-w-4xl mx-auto mt-10 px-4">
  @if($recommendations->isEmpty())
    <!-- No Recommendations State -->
    <div class="bg-white p-8 rounded-lg shadow text-center">
      <h2 class="text-2xl font-semibold mb-4">Your Top Recommendations</h2>
      <p class="text-gray-600 mb-6">No recommendations found. Please complete the questionnaire first.</p>
      <a href="{{ route('student.questionnaire.start') }}"
         class="inline-block bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 font-medium">
        Take Questionnaire
      </a>
    </div>
  @else
    <!-- Results Card -->
    <div class="bg-white p-8 rounded-lg shadow mb-6">
      <h2 class="text-2xl font-semibold mb-6">Your Top Recommendations</h2>
      
      <div class="space-y-4">
        @foreach($recommendations->take(3) as $index => $rec)
          <div class="border border-gray-200 p-4 rounded-lg">
            <div class="flex items-start justify-between">
              <div class="flex-1">
                <div class="flex items-center mb-2">
                  <span class="bg-blue-600 text-white text-sm font-semibold px-3 py-1 rounded-full mr-3">
                    #{{ $index + 1 }}
                  </span>
                  <h3 class="font-semibold text-lg">{{ $rec->techField->name }}</h3>
                </div>
                <p class="text-gray-600 text-sm leading-relaxed">{{ $rec->techField->description }}</p>
              </div>
              <div class="ml-4 text-right">
                <div class="bg-gray-100 text-gray-800 px-3 py-1 rounded text-sm font-semibold">
                  {{ round($rec->score * 100) }}%
                </div>
                <div class="text-xs text-gray-500 mt-1">Match</div>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>

    <!-- Universities Recommendations Card -->
    @if(!empty($universities))
    <div class="bg-white p-8 rounded-lg shadow mb-6">
      <h2 class="text-2xl font-semibold mb-6">Universities & Colleges</h2>
      <p class="text-gray-600 mb-6">Based on your top 3 tech career recommendations, here are the best universities and colleges in Region III:</p>
      
      <div class="space-y-4">
        @foreach($universities as $index => $university)
          <div class="border border-gray-200 p-4 rounded-lg hover:border-gray-300 transition-colors">
            <div class="flex items-start justify-between">
              <div class="flex-1">
                <div class="flex items-center mb-2">
                  <span class="bg-green-600 text-white text-sm font-semibold px-3 py-1 rounded-full mr-3">
                    #{{ $index + 1 }}
                  </span>
                  <h3 class="font-semibold text-lg">{{ $university['university']->name }}</h3>
                  <span class="ml-2 px-2 py-1 text-xs rounded-full {{ $university['university']->type === 'public' ? 'bg-blue-100 text-blue-800' : 'bg-purple-100 text-purple-800' }}">
                    {{ ucfirst($university['university']->type) }}
                  </span>
                </div>
                
                @if($university['university']->location)
                <p class="text-gray-500 text-sm mb-2">
                  📍 {{ $university['university']->location }}
                </p>
                @endif
                
                @if($university['university']->programs)
                <p class="text-gray-600 text-sm mb-3">
                  <strong>Programs:</strong> {{ $university['university']->programs }}
                </p>
                @endif
                
                <!-- Tech Fields Matching -->
                <div class="flex flex-wrap gap-2">
                  @foreach($university['university']->tech_fields as $techField => $strength)
                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs 
                      {{ strpos($strength, 'Direct') !== false ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                      {{ $techField }}
                      @if(strpos($strength, 'Direct') !== false)
                        ✓
                      @else
                        ~
                      @endif
                    </span>
                  @endforeach
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>
      
      <div class="mt-6 p-4 bg-blue-50 rounded-lg">
        <h4 class="font-semibold text-blue-900 mb-2">Legend:</h4>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-2 text-sm text-blue-800">
          <div class="flex items-center">
            <span class="w-3 h-3 bg-green-100 rounded-full mr-2"></span>
            <span class="text-green-800">✓ Direct match</span> - Strong program alignment
          </div>
          <div class="flex items-center">
            <span class="w-3 h-3 bg-yellow-100 rounded-full mr-2"></span>
            <span class="text-yellow-800">~ Partial match</span> - Related courses/electives
          </div>
          <div class="flex items-center">
            <span class="w-3 h-3 bg-blue-100 rounded-full mr-2"></span>
            <span class="text-blue-800">Public</span> - State universities/colleges
          </div>
          <div class="flex items-center">
            <span class="w-3 h-3 bg-purple-100 rounded-full mr-2"></span>
            <span class="text-purple-800">Private</span> - Private institutions
          </div>
        </div>
      </div>
    </div>
    @endif

    <!-- Desktop: Two Column Layout, Mobile: Stacked Layout -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
      <!-- Download Card -->
      <div x-data="{ loading: false }" class="bg-white p-8 rounded-lg shadow">
        <h3 class="text-xl font-semibold mb-4">📄 Download Your Results</h3>
        <p class="text-gray-600 mb-6">Get a detailed PDF report of your technology field recommendations.</p>
        
        <!-- Loading Modal -->
        <div
          x-show="loading"
          x-cloak
          style="background: rgba(0,0,0,0.5);"
          class="fixed inset-0 flex items-center justify-center z-50"
        >
          <div class="bg-white p-8 rounded shadow text-center">
            <svg class="animate-spin h-8 w-8 mx-auto mb-4 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
              <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
              <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path>
            </svg>
            <p class="text-lg font-semibold">Preparing your PDF...</p>
          </div>
        </div>

        <form method="GET" action="{{ route('student.results.download') }}" id="pdfForm">
          <button
            type="submit"
            class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 font-semibold"
            id="pdfBtn"
            :disabled="loading"
            :class="{ 'opacity-50 cursor-not-allowed': loading }"
          >
            <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
            Download PDF Report
          </button>
        </form>
      </div>

      <!-- Survey Card (Only show if survey not completed) -->
      @if(!$hasSurvey)
      <div x-data="surveyForm()" class="bg-white p-8 rounded-lg shadow">
        <h3 class="text-xl font-semibold mb-4">💬 Quick Feedback</h3>
        <p class="text-gray-600 mb-6">Help us improve our recommendations!</p>
        
        <form @submit.prevent="submitSurvey()" x-ref="surveyForm">
          @csrf
          
          <!-- Satisfaction Rating -->
          <div class="mb-4">
            <label class="block text-sm font-semibold text-gray-700 mb-2">
              How satisfied are you?
            </label>
            <div class="flex justify-center space-x-1">
              <template x-for="i in 5" :key="i">
                <label class="cursor-pointer">
                  <input
                    type="radio"
                    name="satisfaction_rating"
                    :value="i"
                    x-model="formData.satisfaction_rating"
                    class="sr-only"
                    required
                  >
                  <div 
                    :class="formData.satisfaction_rating == i ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-600 hover:bg-gray-300'"
                    class="w-8 h-8 rounded-full flex items-center justify-center text-sm font-semibold transition-all duration-200"
                  >
                    <span x-text="i"></span>
                  </div>
                </label>
              </template>
            </div>
          </div>

          <!-- Would Recommend -->
          <div class="mb-4">
            <label class="block text-sm font-semibold text-gray-700 mb-2">
              Would you recommend this tool?
            </label>
            <div class="flex space-x-2">
              <label class="flex-1 cursor-pointer">
                <input
                  type="radio"
                  name="would_recommend"
                  value="1"
                  x-model="formData.would_recommend"
                  class="sr-only"
                  required
                >
                <div 
                  :class="formData.would_recommend === '1' ? 'bg-green-600 text-white border-green-600' : 'bg-white text-gray-700 border-gray-300 hover:bg-gray-50'"
                  class="text-center py-2 rounded border font-medium transition-all duration-200 text-sm"
                >
                  👍 Yes
                </div>
              </label>
              <label class="flex-1 cursor-pointer">
                <input
                  type="radio"
                  name="would_recommend"
                  value="0"
                  x-model="formData.would_recommend"
                  class="sr-only"
                  required
                >
                <div 
                  :class="formData.would_recommend === '0' ? 'bg-red-600 text-white border-red-600' : 'bg-white text-gray-700 border-gray-300 hover:bg-gray-50'"
                  class="text-center py-2 rounded border font-medium transition-all duration-200 text-sm"
                >
                  👎 No
                </div>
              </label>
            </div>
          </div>

          <!-- Optional Feedback -->
          <div class="mb-4">
            <button 
              type="button"
              @click="showOptional = !showOptional"
              class="text-xs text-blue-600 hover:text-blue-800 font-medium"
            >
              <span x-text="showOptional ? 'Hide' : 'Add'"></span> optional feedback
            </button>
            
            <div x-show="showOptional" x-transition class="mt-2">
              <textarea
                x-model="formData.feedback"
                name="feedback"
                class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none text-sm"
                rows="3"
                placeholder="Your thoughts..."
              ></textarea>
            </div>
          </div>

          <!-- Submit Button -->
          <button
            type="submit"
            :disabled="isSubmitting || !formData.satisfaction_rating || formData.would_recommend === null"
            :class="{ 'opacity-50 cursor-not-allowed': isSubmitting || !formData.satisfaction_rating || formData.would_recommend === null }"
            class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded font-semibold transition-all duration-200"
          >
            <span x-show="!isSubmitting">Submit Feedback</span>
            <span x-show="isSubmitting" class="flex items-center justify-center">
              <svg class="animate-spin h-4 w-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path>
              </svg>
              Submitting...
            </span>
          </button>
        </form>
      </div>
      @else
      <!-- Thank You Card (Only show if survey completed) -->
      <div class="bg-white p-8 rounded-lg shadow">
        <h3 class="text-xl font-semibold mb-4">✅ Survey Completed</h3>
        <div class="bg-green-50 border border-green-200 p-6 rounded-lg text-center">
          <div class="flex items-center justify-center mb-3">
            <svg class="w-6 h-6 text-green-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
            </svg>
            <span class="text-green-800 font-semibold">Thank you for your feedback!</span>
          </div>
          <p class="text-green-700 text-sm">We appreciate you taking the time to help us improve our recommendation system.</p>
        </div>
      </div>
      @endif
    </div>
  @endif
</div>

<style>
  [x-cloak] { display: none; }
</style>
  
<script>
  function surveyForm() {
    return {
      showOptional: false,
      isSubmitting: false,
      formData: {
        satisfaction_rating: null,
        would_recommend: null,
        feedback: '',
        improvements: ''
      },
      
      async submitSurvey() {
        if (!this.formData.satisfaction_rating || this.formData.would_recommend === null) {
          return;
        }
        
        this.isSubmitting = true;
        
        try {
          const response = await fetch('{{ route("student.survey.submit") }}', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
              satisfaction_rating: parseInt(this.formData.satisfaction_rating),
              would_recommend: this.formData.would_recommend === '1',
              feedback: this.formData.feedback,
              improvements: this.formData.improvements
            })
          });
          
          if (response.ok) {
            window.location.reload();
          } else {
            throw new Error('Survey submission failed');
          }
        } catch (error) {
          console.error('Error submitting survey:', error);
          alert('Failed to submit survey. Please try again.');
        } finally {
          this.isSubmitting = false;
        }
      }
    }
  }

  document.addEventListener('DOMContentLoaded', function() {
    const btn = document.getElementById('pdfBtn');
    const form = document.getElementById('pdfForm');
    if (btn && form) {
      form.addEventListener('submit', function(e) {
        btn.disabled = true;
        btn.classList.add('opacity-50', 'cursor-not-allowed');
        document.querySelector('[x-data*="loading"]').__x.$data.loading = true;
      });
      window.addEventListener('focus', function() {
        const loadingElement = document.querySelector('[x-data*="loading"]');
        if (loadingElement) {
          loadingElement.__x.$data.loading = false;
        }
        btn.disabled = false;
        btn.classList.remove('opacity-50', 'cursor-not-allowed');
      });
    }
  });
</script>
@endsection
