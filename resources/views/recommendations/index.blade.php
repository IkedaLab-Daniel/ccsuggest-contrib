@extends('layouts.app')

@section('title','Recommendations')

@section('content')
  <h1 class="text-2xl font-semibold mb-6">Your Top Tech Fields</h1>

  <div class="bg-white p-6 rounded-lg shadow mb-6">
    <h2 class="text-xl mb-2">Top 3 Suggestions</h2>
    <ol class="list-decimal list-inside space-y-1">
      @foreach($recommendations->take(3) as $rec)
        <li class="flex justify-between">
          <span>{{ $rec->techField->name }}</span>
          <span class="font-medium">{{ round($rec->score * 100) }}%</span>
        </li>
      @endforeach
    </ol>
  </div>

  <div class="flex space-x-4">
    <a href="{{ route('recommendations.download') }}"
       class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
      Download PDF
    </a>
    <a href="{{ route('student.dashboard') }}"
       class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">
      Back to Dashboard
    </a>
  </div>
@endsection
