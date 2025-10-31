<div class="bg-white p-6 rounded-lg shadow animate-slide-down">

  {{-- Progress bar --}}
  <div class="w-full bg-gray-200 h-2 mb-4 rounded">
    <div class="bg-blue-600 h-2 rounded" style="width: {{ $progress }}%"></div>
  </div>

  {{-- Question --}}
  <h2 class="text-lg font-medium mb-4">{{ $current->text }}</h2>

  {{-- Single choice --}}
  @if($current->type === 'single')
    <div class="space-y-2">
      @foreach($current->options as $opt)
        <button
          wire:click="submitAnswer({{ $opt->id }}, null)"
          class="w-full text-left px-4 py-2 border rounded hover:bg-gray-100 transition"
        >
          {{ $opt->text }}
        </button>
      @endforeach
    </div>

  {{-- Multiple choice --}}
  @elseif($current->type === 'multiple')
    <form wire:submit.prevent="submitAnswer(null, selectedOptions)">
      <div class="space-y-2">
        @foreach($current->options as $opt)
          <label class="flex items-center">
            <input type="checkbox"
                   wire:model="selectedOptions"
                   value="{{ $opt->id }}"
                   class="mr-2">
            {{ $opt->text }}
          </label>
        @endforeach
      </div>
      <button type="submit"
              class="mt-4 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        Next
      </button>
    </form>

{{-- Scale 1–5 --}}
@elseif($current->type === 'scale')
  <div class="mb-4">
    <input type="range" min="1" max="5" wire:model="value" class="w-full">
    <div class="flex justify-between text-sm text-gray-600">
      <span>1</span><span>5</span>
    </div>
  </div>
  <button
    {{-- inject the fresh $value property into the call --}}
    wire:click="submitAnswer(null, {{ $value ?? 1 }})"
    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
    Next
  </button>
@endif

</div>
