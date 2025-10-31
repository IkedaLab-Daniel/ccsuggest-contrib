@extends('layouts.admin')

@section('title','Create Question')

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

  <h1 class="text-2xl font-semibold mb-6">New Question</h1>

  <div x-data="{ loading: false }" x-ref="loaderModal">
    <div
      x-show="loading"
      style="background: rgba(0,0,0,0.5);"
      class="fixed inset-0 flex items-center justify-center z-50"
    >
      <div class="bg-white p-8 rounded shadow text-center">
        <svg class="animate-spin h-8 w-8 mx-auto mb-4 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
          <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
          <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path>
        </svg>
        <p class="text-lg font-semibold">Processing...</p>
      </div>
    </div>
    <form action="{{ route('admin.questions.store') }}" method="POST"
          class="bg-white p-6 rounded-lg shadow space-y-4"
          @submit="loading = true">
    @csrf

    {{-- Question Text --}}
    <div>
      <label class="block mb-1 font-medium">Question Text</label>
      <textarea name="text" rows="3" required
                class="w-full border px-3 py-2 rounded @error('text') border-red-500 @enderror">{{ old('text') }}</textarea>
      @error('text') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
    </div>

    {{-- Type --}}
    <div>
      <label class="block mb-1 font-medium">Type</label>
      <select name="type" id="type-select" required
              class="w-full border px-3 py-2 rounded @error('type') border-red-500 @enderror">
        <option value="single" {{ old('type')=='single'?'selected':'' }}>Single choice</option>
        <option value="multiple" {{ old('type')=='multiple'?'selected':'' }}>Multiple choice</option>
        <option value="scale" {{ old('type')=='scale'?'selected':'' }}>Scale (1–5)</option>
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
          <option value="{{ $f->id }}" {{ old('tech_field_id')==$f->id?'selected':'' }}>
            {{ $f->name }}
          </option>
        @endforeach
      </select>
      @error('tech_field_id') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
    </div>

    {{-- Options (shown only for single/multiple) --}}
    <div id="options-group" class="{{ old('type')==='scale' ? 'hidden' : '' }}">
      <label class="block mb-1 font-medium">Options</label>
      <div id="option-list">
        @if(old('options'))
          @foreach(old('options') as $opt)
            <div class="flex items-center mb-2 option-row">
              <input type="text" name="options[]" value="{{ $opt }}"
                     class="flex-grow border px-3 py-2 rounded" placeholder="Option text">
              <button type="button" class="ml-2 text-red-600 remove-option">×</button>
            </div>
          @endforeach
        @else
          <div class="flex items-center mb-2 option-row">
            <input type="text" name="options[]"
                   class="flex-grow border px-3 py-2 rounded" placeholder="Option text">
            <button type="button" class="ml-2 text-red-600 remove-option">×</button>
          </div>
        @endif
      </div>
      <button type="button" id="add-option"
              class="mt-2 bg-gray-200 px-3 py-1 rounded hover:bg-gray-300">
        + Add Option
      </button>
      @error('options') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
    </div>

      <button type="submit"
              class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
        Create Question
      </button>
    </form>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const typeSelect   = document.getElementById('type-select');
      const optionsGroup = document.getElementById('options-group');
      const optionList   = document.getElementById('option-list');
      const addBtn       = document.getElementById('add-option');

      function toggleOptions() {
        if (['single', 'multiple'].includes(typeSelect.value)) {
          optionsGroup.classList.remove('hidden');
        } else {
          optionsGroup.classList.add('hidden');
        }
      }

      function addOption(value = '') {
        const row = document.createElement('div');
        row.className = 'flex items-center mb-2 option-row';
        row.innerHTML = `
          <input type="text" name="options[]" value="${value.replace(/"/g,'&quot;')}"
                 class="flex-grow border px-3 py-2 rounded" placeholder="Option text">
          <button type="button" class="ml-2 text-red-600 remove-option">×</button>
        `;
        optionList.appendChild(row);
      }

      // initial toggle
      toggleOptions();
      typeSelect.addEventListener('change', toggleOptions);

      // add new option
      addBtn.addEventListener('click', () => addOption());

      // remove option on click
      optionList.addEventListener('click', e => {
        if (e.target.classList.contains('remove-option')) {
          e.target.closest('.option-row').remove();
        }
      });
    });
  </script>
@endsection
