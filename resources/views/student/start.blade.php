{{--resources/views/student/start.blade.php--}}
@extends('layouts.student')

@section('title','Questionnaire')

@section('content')
  <h1 class="text-2xl font-semibold mb-6">Your Profile Questionnaire</h1>
  <livewire:questionnaire-wizard />
@endsection
