<div class="max-w-xl mx-auto bg-white p-6 rounded-lg shadow">

  {{-- Progress bar --}}
  <div class="w-full bg-gray-200 h-2 mb-4 rounded">
    <div class="bg-blue-600 h-2 rounded" style="width: {{ $progress }}%"></div>
  </div>

  {{-- Question text --}}
  <h2 class="text-lg font-medium mb-4">{{ $current->text }}</h2>

  {{-- Single Choice --}}
  @if($current->type === 'single')
    @foreach($current->options as $opt)
      <button
        wire:click="submitAnswer({{ $opt->id }}, null)"
        class="block w-full text-left px-4 py-2 mb-2 border rounded hover:bg-gray-100"
      >
        {{ $opt->text }}
      </button>
    @endforeach

  {{-- Multiple Choice --}}
  @elseif($current->type === 'multiple')
    @foreach($current->options as $opt)
      <label class="flex items-center mb-2">
        <input type="checkbox" wire:model="selectedOptions" value="{{ $opt->id }}" class="mr-2">
        {{ $opt->text }}
      </label>
    @endforeach
    <button
      wire:click="submitAnswer(null, selectedOptions)"
      class="mt-4 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700"
    >
      Next
    </button>

  {{-- Scale (1–5) --}}
  @elseif($current->type === 'scale')
    <input
      type="range"
      min="1" max="5"
      wire:model="value"
      class="w-full"
    />
    <div class="flex justify-between text-sm text-gray-600 mb-4">
      <span>1</span><span>5</span>
    </div>
    <button
      wire:click="submitAnswer(null, value)"
      class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700"
    >
      Next
    </button>
  @endif

</div>
