{{-- resources/views/student/profile.blade.php --}}
@extends('layouts.student')

@section('title', 'Complete Your Profile')

@section('content')
  @if(session('warning'))
    <div class="mb-4 bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 rounded">
      {{ session('warning') }}
    </div>
  @endif

  <div class="max-w-lg mx-auto mt-8 bg-white p-6 shadow rounded" x-data="profileForm()">
    <!-- Loader Modal -->
    <div
      x-show="loading"
      x-cloak
      style="background: rgba(0,0,0,0.5);"
      class="fixed inset-0 flex items-center justify-center z-50"
    >
      <div class="bg-white p-8 rounded shadow text-center">
        <svg class="animate-spin h-8 w-8 mx-auto mb-4 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
          <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
          <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path>
        </svg>
        <p class="text-lg font-semibold">Saving your profile...</p>
      </div>
    </div>
    <h2 class="text-2xl font-bold mb-4">Complete Your Profile</h2>

    <form method="POST" action="{{ route('student.profile.update') }}" @submit.prevent="submitForm" x-ref="form">
      @csrf

      {{-- Full Name --}}
      <div class="mb-4">
        <label for="full_name" class="block text-gray-700">Full Name</label>
        <input
          type="text"
          id="full_name"
          name="full_name"
          value="{{ old('full_name', $profile->full_name) }}"
          class="mt-1 block w-full border-gray-300 rounded"
          required
        >
        @error('full_name')
          <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      {{-- Date of Birth --}}
      <div class="mb-4">
        <label for="date_of_birth" class="block text-gray-700">Date of Birth</label>
        <input
          type="date"
          id="date_of_birth"
          name="date_of_birth"
          value="{{ old('date_of_birth', optional($profile->date_of_birth)->format('Y-m-d')) }}"
          class="mt-1 block w-full border-gray-300 rounded"
          required
        >
        @error('date_of_birth')
          <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      {{-- Gender --}}
      <div class="mb-4">
        <label class="block text-gray-700">Gender</label>
        <select name="gender" class="mt-1 block w-full border-gray-300 rounded">
          <option value="">Select…</option>
          @foreach(['male' => 'Male', 'female' => 'Female', 'other' => 'Other'] as $key => $label)
            <option value="{{ $key }}"
              {{ old('gender', $profile->gender) === $key ? 'selected' : '' }}>
              {{ $label }}
            </option>
          @endforeach
        </select>
        @error('gender')
          <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      {{-- GPA --}}
      <div class="mb-4">
        <label for="gpa" class="block text-gray-700">GPA (0.00 – 4.00)</label>
        <input
          type="number"
          step="0.01"
          min="0" max="4"
          id="gpa"
          name="gpa"
          value="{{ old('gpa', $profile->gpa) }}"
          class="mt-1 block w-full border-gray-300 rounded"
        >
        @error('gpa')
          <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      {{-- Senior High School Grade --}}
      <div class="mb-4">
        <label for="senior_high_grade" class="block text-gray-700">
          Senior High School Final Grade (0 – 100)
        </label>
        <input
          type="number"
          step="0.01"
          min="0" max="100"
          id="senior_high_grade"
          name="senior_high_grade"
          value="{{ old('senior_high_grade', $profile->senior_high_grade) }}"
          class="mt-1 block w-full border-gray-300 rounded"
        >
        @error('senior_high_grade')
          <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      @php
        // Prepare initial tags: old input or existing interests or defaults
        $defaults = ['Programming','Web Development','Mobile Apps','Data Science','Cybersecurity','Networking'];
        $initialTags = old('interests', $profile->interests ?? $defaults);
      @endphp

      {{-- Interests --}}
      <div class="mb-6" x-data="interestTags()">
        <label class="block text-gray-700">Your Interests</label>
        <div class="mt-1 border border-gray-300 rounded p-2 flex flex-wrap">
          <template x-for="(tag, i) in tags" :key="i">
            <span class="flex items-center bg-blue-100 text-blue-800 rounded-full px-2 py-1 mr-2 mb-2">
              <span x-text="tag"></span>
              <button type="button" @click="removeTag(i)" class="ml-1 text-lg leading-none">&times;</button>
            </span>
          </template>
          <input
            type="text"
            x-model="newTag"
            @keydown.enter.prevent="addTag()"
            placeholder="Type and press Enter"
            class="flex-1 outline-none"
          >
        </div>
        <template x-for="tag in tags" :key="tag">
          <input type="hidden" name="interests[]" :value="tag">
        </template>
        @error('interests')
          <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      <button
        type="submit"
        class="w-full bg-green-600 text-white py-2 rounded hover:bg-green-700 transition"
        :disabled="loading"
        :class="{ 'opacity-50 cursor-not-allowed': loading }"
      >
        Save Profile
      </button>
    </form>
  </div>

  <style>
    [x-cloak] { display: none; }
  </style>
  <script>
    function interestTags() {
      return {
        tags: @json($initialTags),
        newTag: '',
        addTag() {
          const t = this.newTag.trim();
          if (t && !this.tags.includes(t)) {
            this.tags.push(t);
          }
          this.newTag = '';
        },
        removeTag(i) {
          this.tags.splice(i, 1);
        }
      }
    }
    function profileForm() {
      return {
        loading: false,
        submitForm() {
          this.loading = true;
          this.$refs.form.submit();
        }
      }
    }
  </script>
@endsection
