{{-- resources/views/home.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container mx-auto">
  <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
    @if (session('status'))
      <div class="alert alert-success mb-4">{{ session('status') }}</div>
    @endif

    <h1 class="text-2xl mb-4">Dashboard</h1>
    <p>You are logged in!</p>
  </div>
</div>
@endsection
