{{-- resources/views/questionnaire/start.blade.php --}}
@extends('layouts.app')

@section('title','Questionnaire')

@section('content')
  <div class="bg-white p-6 rounded-lg shadow mb-6">
    <h1 class="text-2xl font-semibold">Your Profile Questionnaire</h1>
    <p class="text-gray-600 mt-2">Complete our simplified 30-question assessment to discover your ideal tech career path.</p>
  </div>

  {{-- Use the new simplified Livewire component --}}
  <livewire:simplified-questionnaire-wizard />
@endsection
