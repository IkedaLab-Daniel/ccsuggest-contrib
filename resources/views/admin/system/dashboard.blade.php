{{-- resources/views/admin/system/dashboard.blade.php --}}
@extends('layouts.admin')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6">System Dashboard</h1>

    @if(session('status'))
        <div class="bg-green-100 border border-green-200 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('status') }}
        </div>
    @endif

    @if($errors->any())
        <div class="bg-red-100 border border-red-200 text-red-700 px-4 py-3 rounded mb-4">
            {{ $errors->first() }}
        </div>
    @endif

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white p-6 rounded-lg shadow text-center">
            <div class="text-gray-500 uppercase text-xs font-medium">Users</div>
            <div class="mt-2 text-3xl font-semibold">{{ $userCount }}</div>
        </div>
        <div class="bg-white p-6 rounded-lg shadow text-center">
            <div class="text-gray-500 uppercase text-xs font-medium">Questions</div>
            <div class="mt-2 text-3xl font-semibold">{{ $questionCount }}</div>
        </div>
        <!-- <div class="bg-white p-6 rounded-lg shadow text-center">
            <div class="text-gray-500 uppercase text-xs font-medium">Responses</div>
            <div class="mt-2 text-3xl font-semibold">{{ $responseCount }}</div>
        </div> -->
        <div class="bg-white p-6 rounded-lg shadow text-center">
            <div class="text-gray-500 uppercase text-xs font-medium">Recommendations</div>
            <div class="mt-2 text-3xl font-semibold">{{ $recommendationCount }}</div>
        </div>
        <div class="bg-white p-6 rounded-lg shadow text-center">
            <div class="text-gray-500 uppercase text-xs font-medium">Tech Fields</div>
            <div class="mt-2 text-3xl font-semibold">{{ $techFieldCount }}</div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @include('admin.partials.retrain-card')
        {{-- you can add more system cards here --}}
    </div>
</div>
@endsection
