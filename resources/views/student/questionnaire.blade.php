{{-- resources/views/student/questionnaire.blade.php --}}
@extends('layouts.student')

@section('title', 'Questionnaire')

@section('content')
<div
  x-data="questionnaire()"
  x-init="init()"
  class="max-w-2xl mx-auto mt-10 bg-white p-8 rounded-lg shadow overflow-hidden"
>
  <!-- Loading Modal -->
  <div
    x-show="loading || loadingQuestions"
    style="background: rgba(0,0,0,0.5);"
    class="fixed inset-0 flex items-center justify-center z-50"
  >
    <div class="bg-white p-8 rounded shadow text-center">
      <svg class="animate-spin h-8 w-8 mx-auto mb-4 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path>
      </svg>
      <p class="text-lg font-semibold" x-text="loadingQuestions ? 'Loading questions...' : 'Submitting your answers...'"></p>
    </div>
  </div>
  {{-- progress bar --}}
  <div class="w-full h-3 bg-gray-200 rounded mb-8">
    <div
      class="h-3 bg-blue-600 rounded transition-all duration-300"
      :style="`width: ${percent}%`"
    ></div>
  </div>

  {{-- question cards --}}
  <template x-for="(q, idx) in questions" :key="q.id">
    <div x-show="step === idx" x-transition.opacity>
      <h2 class="text-xl font-semibold mb-4">
        <span x-text="idx + 1"></span>. <span x-text="q.text"></span>
      </h2>

      <template x-if="q.type === 'scale'">
        <div class="flex space-x-4 mt-2">
          <template x-for="i in 5" :key="i">
            <label class="flex flex-col items-center">
              <input
                type="radio"
                :name="`answers[${q.id}]`"
                :value="i"
                x-model="answers[q.id]"
                class="form-radio h-5 w-5 text-blue-600"
              >
              <span x-text="i" class="text-sm"></span>
            </label>
          </template>
        </div>
      </template>

      <template x-if="q.type === 'single'">
        <div class="space-y-2 mt-2">
          <template x-for="opt in q.options" :key="opt.id">
            <label class="flex items-center space-x-2">
              <input
                type="radio"
                :name="`answers[${q.id}]`"
                :value="opt.value"
                x-model="answers[q.id]"
                class="form-radio h-4 w-4 text-blue-600"
              >
              <span x-text="opt.text"></span>
            </label>
          </template>
        </div>
      </template>

      <template x-if="q.type === 'multiple'">
        <div class="space-y-2 mt-2">
          <template x-for="opt in q.options" :key="opt.id">
            <label class="flex items-center space-x-2">
              <input
                type="checkbox"
                :value="opt.value"
                x-model="answers[q.id]"
                class="form-checkbox h-4 w-4 text-blue-600"
              >
              <span x-text="opt.text"></span>
            </label>
          </template>
        </div>
      </template>

      <p
        x-show="errors[q.id]"
        x-text="errors[q.id]"
        class="text-red-600 text-sm mt-2"
      ></p>
    </div>
  </template>

  {{-- nav buttons --}}
  <div class="flex justify-between mt-10">
    <button
      type="button"
      @click="prev()"
      x-show="step > 0"
      class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300"
    >
      ‹ Back
    </button>

    <button
      type="button"
      @click="next()"
      x-show="!isLast"
      :disabled="!answers[questions[step]?.id] || (Array.isArray(answers[questions[step]?.id]) && answers[questions[step]?.id].length === 0)"
      :class="{ 'opacity-50 cursor-not-allowed': !answers[questions[step]?.id] || (Array.isArray(answers[questions[step]?.id]) && answers[questions[step]?.id].length === 0) }"
      class="ml-auto px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700"
    >
      Next ›
    </button>

    <form
      method="POST"
      action="{{ route('student.questionnaire.submit') }}"
      x-ref="form"
      x-show="isLast"
      class="ml-auto"
      @submit.prevent="submitForm"
    >
      @csrf
      <input type="hidden" name="answers" :value="JSON.stringify(answers)">
      <button
        type="submit"
        class="px-6 py-2 bg-green-600 text-white rounded hover:bg-green-700"
      >
        Submit
      </button>
    </form>
  </div>
</div>

@endsection

<script>
function questionnaire() {
  return {
    step: 0,
    percent: 0,
    isLast: false,
    questions: [],
    answers: {},
    errors: {},
    loading: false,
    loadingQuestions: true,
    async init() {
      // Fetch questions from backend
      this.loadingQuestions = true;
      try {
        const res = await fetch('/api/questions');
        this.questions = await res.json();
      } catch (e) {
        console.error('Failed to load questions', e);
        this.questions = [];
      }
      this.percent = Math.round((this.step + 1) / (this.questions.length || 1) * 100);
      this.isLast = this.step === (this.questions.length - 1);
      this.loadingQuestions = false;
    },
    next() {
      if (this.step < this.questions.length - 1) {
        this.step++;
        this.percent = Math.round((this.step + 1) / (this.questions.length || 1) * 100);
        this.isLast = this.step === (this.questions.length - 1);
      }
    },
    prev() {
      if (this.step > 0) {
        this.step--;
        this.percent = Math.round((this.step + 1) / (this.questions.length || 1) * 100);
        this.isLast = this.step === (this.questions.length - 1);
      }
    },
    submitForm() {
      this.loading = true;
      this.$refs.form.submit();
    }
  }
}
</script>
