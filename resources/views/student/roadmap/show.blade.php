@extends('layouts.student')

@section('title', $field->name . ' Roadmap')

@section('content')
  <div class="max-w-4xl mx-auto space-y-8 py-12">
    <header class="flex items-center justify-between">
      <div>
        <h1 class="text-3xl font-bold text-gray-800">{{ $field->name }} Roadmap</h1>
        <p class="text-gray-600 mt-2">Follow these steps to master {{ $field->name }}.</p>
      </div>
      <a href="{{ url()->previous() }}"
         class="text-indigo-600 hover:underline">← Back</a>
    </header>

    @if(count($steps))
      <ul class="space-y-6">
        @foreach($steps as $i => $step)
          <li class="flex items-start">
            <div class="flex-shrink-0 mr-6">
              <div class="h-10 w-10 rounded-full bg-indigo-500 text-white flex items-center justify-center font-bold">
                {{ $i + 1 }}
              </div>
            </div>
            <div class="flex-1">
              <h2 class="text-xl font-semibold text-gray-800">{{ is_array($step) ? $step['title'] : $step }}</h2>
              @if(is_array($step) && !empty($step['desc']))
                <p class="mt-2 text-gray-600">{{ $step['desc'] }}</p>
              @endif
              @if(is_array($step) && !empty($step['resources']))
                <ul class="mt-4 space-y-2">
                  @foreach($step['resources'] as $res)
                    <li>
                      <a href="{{ $res['url'] }}"
                         target="_blank"
                         class="text-indigo-600 hover:underline">
                        • {{ $res['label'] ?? $res['url'] }}
                      </a>
                    </li>
                  @endforeach
                </ul>
              @endif
            </div>
          </li>
        @endforeach
      </ul>
    @else
      <div class="text-center py-16 text-gray-500">
        <p class="text-lg">We’re still building this roadmap. Please check back later.</p>
      </div>
    @endif

    <div class="pt-12 text-right">
      <a href="{{ route('student.roadmap.download', $field->id) }}"
         class="inline-block px-6 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
        Download as PDF
      </a>
    </div>
  </div>
@endsection
