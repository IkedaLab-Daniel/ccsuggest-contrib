@extends('layouts.admin')

@section('title','Edit Question')

@section('content')
@if ($errors->any())
  <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
    <ul class="list-disc pl-5">
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif

  <h1 class="text-2xl font-semibold mb-6">Edit Question</h1>

  <div x-data="{ loading: false }" x-ref="loaderModal">
    <div
      x-show="loading"
      style="background: rgba(0,0,0,0.5);"
      class="fixed inset-0 flex items-center justify-center z-50"
    >
      <div class="bg-white p-8 rounded shadow text-center">
        <svg class="animate-spin h-8 w-8 mx-auto mb-4 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
          <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
          <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path>
        </svg>
        <p class="text-lg font-semibold">Processing...</p>
      </div>
    </div>
    <form action="{{ route('admin.questions.update', $question) }}" method="POST"
          class="bg-white p-6 rounded-lg shadow space-y-4"
          @submit="loading = true">
    @csrf
    @method('PUT')

    {{-- Question Text --}}
    <div>
      <label class="block mb-1 font-medium">Question Text</label>
      <textarea name="text" rows="3" required
                class="w-full border px-3 py-2 rounded @error('text') border-red-500 @enderror">{{ old('text', $question->text) }}</textarea>
      @error('text') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
    </div>

    {{-- Type --}}
    <div>
      <label class="block mb-1 font-medium">Type</label>
      <select name="type" id="type-select" required
              class="w-full border px-3 py-2 rounded @error('type') border-red-500 @enderror">
        @foreach(['single','multiple','scale'] as $t)
          <option value="{{ $t }}" {{ old('type', $question->type)==$t ? 'selected' : '' }}>
            {{ ucfirst($t) }}
          </option>
        @endforeach
      </select>
      @error('type') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
    </div>

    {{-- Tech Field --}}
    <div>
      <label class="block mb-1 font-medium">Tech Field</label>
      <select name="tech_field_id"
              class="w-full border px-3 py-2 rounded @error('tech_field_id') border-red-500 @enderror">
        <option value="">— None —</option>
        @foreach($fields as $f)
          <option value="{{ $f->id }}"
            {{ old('tech_field_id', $question->tech_field_id)==$f->id ? 'selected' : '' }}>
            {{ $f->name }}
          </option>
        @endforeach
      </select>
      @error('tech_field_id') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
    </div>

    {{-- Options (shown only for single/multiple) --}}
    <div id="options-field" class="{{ old('type', $question->type) === 'scale' ? 'hidden' : '' }}">
      <label class="block mb-1 font-medium">Options (one per line)</label>
      <textarea name="options_text" rows="4"
                class="w-full border px-3 py-2 rounded @error('options_text') border-red-500 @enderror"
                placeholder="Leave blank for scale questions">{{ old('options_text', $options_text) }}</textarea>
      @error('options_text') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
    </div>

      <button type="submit"
              class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        Update Question
      </button>
    </form>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const typeSelect   = document.getElementById('type-select');
      const optionsField = document.getElementById('options-field');

      function toggleOptions() {
        if (['single', 'multiple'].includes(typeSelect.value)) {
          optionsField.classList.remove('hidden');
        } else {
          optionsField.classList.add('hidden');
        }
      }

      typeSelect.addEventListener('change', toggleOptions);
      toggleOptions(); // initial call
    });
  </script>
@endsection
