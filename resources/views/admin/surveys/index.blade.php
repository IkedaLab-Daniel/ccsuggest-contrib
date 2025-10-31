{{-- resources/views/admin/surveys/index.blade.php --}}
@extends('layouts.admin')

@section('title', 'Survey Results')

@section('content')
@php
use Illuminate\Support\Str;
@endphp
<div class="relative">
  <!-- Background Elements -->
  <div class="absolute inset-0 overflow-hidden pointer-events-none">
    <div class="absolute -top-40 -right-40 w-80 h-80 bg-gradient-to-br from-purple-200 to-indigo-200 rounded-full opacity-20 blur-3xl"></div>
    <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-gradient-to-tr from-indigo-100 to-purple-100 rounded-full opacity-20 blur-3xl"></div>
  </div>

  <!-- Header -->
  <div class="relative mb-8">
    <div class="bg-gradient-to-r from-purple-600 to-indigo-600 rounded-2xl p-8 text-white shadow-2xl">
      <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
        <div class="mb-6 lg:mb-0">
          <h1 class="text-4xl lg:text-5xl font-bold mb-2">
            Survey Analytics
          </h1>
          <p class="text-purple-100 text-lg">User feedback and satisfaction insights</p>
        </div>
        <div class="flex items-center space-x-4">
          <a href="{{ route('admin.surveys.export') }}" 
             class="bg-white/20 backdrop-blur-sm rounded-xl px-6 py-3 font-semibold hover:bg-white/30 transition-all duration-200 flex items-center space-x-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
            <span>Export CSV</span>
          </a>
        </div>
      </div>
    </div>
  </div>

  <!-- Quick Stats -->
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
    <!-- Total Responses -->
    <div class="bg-white rounded-2xl p-6 shadow-xl border border-gray-100">
      <div class="flex items-center justify-between">
        <div>
          <p class="text-gray-500 text-sm font-medium uppercase tracking-wider">Total Responses</p>
          <p class="text-3xl font-bold text-gray-900">{{ $totalResponses }}</p>
          <p class="text-sm text-gray-600 mt-1">of {{ $totalUsers }} users</p>
        </div>
        <div class="bg-purple-100 rounded-full p-3">
          <svg class="h-8 w-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
          </svg>
        </div>
      </div>
    </div>

    <!-- Response Rate -->
    <div class="bg-white rounded-2xl p-6 shadow-xl border border-gray-100">
      <div class="flex items-center justify-between">
        <div>
          <p class="text-gray-500 text-sm font-medium uppercase tracking-wider">Response Rate</p>
          <p class="text-3xl font-bold text-gray-900">{{ $responseRate }}%</p>
        </div>
        <div class="bg-blue-100 rounded-full p-3">
          <svg class="h-8 w-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
          </svg>
        </div>
      </div>
    </div>

    <!-- Average Satisfaction -->
    <div class="bg-white rounded-2xl p-6 shadow-xl border border-gray-100">
      <div class="flex items-center justify-between">
        <div>
          <p class="text-gray-500 text-sm font-medium uppercase tracking-wider">Avg Satisfaction</p>
          <p class="text-3xl font-bold text-gray-900">{{ number_format($avgSatisfaction, 1) }}/5</p>
          <div class="flex items-center mt-1">
            @for($i = 1; $i <= 5; $i++)
              <svg class="w-4 h-4 {{ $i <= round($avgSatisfaction) ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
              </svg>
            @endfor
          </div>
        </div>
        <div class="bg-yellow-100 rounded-full p-3">
          <svg class="h-8 w-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
          </svg>
        </div>
      </div>
    </div>

    <!-- Recommendation Rate -->
    <div class="bg-white rounded-2xl p-6 shadow-xl border border-gray-100">
      <div class="flex items-center justify-between">
        <div>
          <p class="text-gray-500 text-sm font-medium uppercase tracking-wider">Would Recommend</p>
          <p class="text-3xl font-bold text-gray-900">{{ $recommendRate }}%</p>
          <p class="text-sm text-gray-600 mt-1">{{ $recommendYes }} of {{ $totalResponses }}</p>
        </div>
        <div class="bg-green-100 rounded-full p-3">
          <svg class="h-8 w-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5"/>
          </svg>
        </div>
      </div>
    </div>
  </div>

  <!-- Charts Row -->
  <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-10">
    <!-- Satisfaction Breakdown -->
    <div class="bg-white rounded-2xl p-8 shadow-xl border border-gray-100">
      <h3 class="text-xl font-bold text-gray-900 mb-6">Satisfaction Rating Distribution</h3>
      <div class="space-y-4">
        @foreach($satisfactionBreakdown as $rating => $count)
          @php
            $percentage = $totalResponses > 0 ? round(($count / $totalResponses) * 100, 1) : 0;
          @endphp
          <div class="flex items-center justify-between">
            <div class="flex items-center space-x-3">
              <span class="text-sm font-medium text-gray-700 w-8">{{ $rating }}★</span>
              <div class="w-48 bg-gray-200 rounded-full h-3">
                <div class="bg-gradient-to-r from-yellow-400 to-yellow-500 h-3 rounded-full transition-all duration-300" 
                     style="width: {{ $percentage }}%"></div>
              </div>
            </div>
            <div class="text-right">
              <span class="text-sm font-semibold text-gray-900">{{ $count }}</span>
              <span class="text-xs text-gray-500">({{ $percentage }}%)</span>
            </div>
          </div>
        @endforeach
      </div>
    </div>

    <!-- Recommendation Split -->
    <div class="bg-white rounded-2xl p-8 shadow-xl border border-gray-100">
      <h3 class="text-xl font-bold text-gray-900 mb-6">Recommendation Split</h3>
      <div class="flex items-center justify-center">
        <div class="relative w-48 h-48">
          @if($totalResponses > 0)
            <!-- Simple pie chart using conic-gradient -->
            @php
              $yesAngle = ($recommendYes / $totalResponses) * 360;
            @endphp
            <div class="w-full h-full rounded-full" 
                 style="background: conic-gradient(from 0deg, #10b981 0deg {{ $yesAngle }}deg, #ef4444 {{ $yesAngle }}deg 360deg);">
            </div>
            <div class="absolute inset-6 bg-white rounded-full flex items-center justify-center">
              <div class="text-center">
                <div class="text-2xl font-bold text-gray-900">{{ $recommendRate }}%</div>
                <div class="text-sm text-gray-500">Would Recommend</div>
              </div>
            </div>
          @else
            <div class="w-full h-full rounded-full bg-gray-200 flex items-center justify-center">
              <span class="text-gray-500">No data</span>
            </div>
          @endif
        </div>
      </div>
      <div class="mt-6 flex justify-center space-x-6">
        <div class="flex items-center space-x-2">
          <div class="w-4 h-4 bg-green-500 rounded-full"></div>
          <span class="text-sm text-gray-700">Yes ({{ $recommendYes }})</span>
        </div>
        <div class="flex items-center space-x-2">
          <div class="w-4 h-4 bg-red-500 rounded-full"></div>
          <span class="text-sm text-gray-700">No ({{ $recommendNo }})</span>
        </div>
      </div>
    </div>
  </div>

  <!-- Recent Feedback -->
  @if($recentFeedback->count() > 0)
  <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden mb-10">
    <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-8 py-6 border-b border-gray-200">
      <h2 class="text-2xl font-bold text-gray-900">Recent Feedback</h2>
      <p class="text-gray-600 mt-1">Latest user comments and suggestions</p>
    </div>
    <div class="p-8">
      <div class="space-y-6">
        @foreach($recentFeedback as $feedback)
          <div class="border border-gray-200 rounded-lg p-6">
            <div class="flex items-start justify-between mb-4">
              <div class="flex items-center space-x-3">
                <div class="bg-purple-100 rounded-full p-2">
                  <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                  </svg>
                </div>
                <div>
                  <h4 class="font-semibold text-gray-900">{{ $feedback->user->name ?? 'Anonymous' }}</h4>
                  <div class="flex items-center space-x-2">
                    <div class="flex">
                      @for($i = 1; $i <= 5; $i++)
                        <svg class="w-4 h-4 {{ $i <= $feedback->satisfaction_rating ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                          <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                      @endfor
                    </div>
                    <span class="text-sm text-gray-500">• {{ $feedback->created_at->diffForHumans() }}</span>
                  </div>
                </div>
              </div>
              <div class="flex items-center space-x-2">
                @if($feedback->would_recommend)
                  <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                    👍 Recommends
                  </span>
                @else
                  <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                    👎 Does not recommend
                  </span>
                @endif
              </div>
            </div>
            <blockquote class="text-gray-700 italic border-l-4 border-purple-200 pl-4">
              "{{ $feedback->feedback }}"
            </blockquote>
          </div>
        @endforeach
      </div>
    </div>
  </div>
  @endif

  <!-- Monthly Trend -->
  @if($monthlyTrend->count() > 0)
  <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
    <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-8 py-6 border-b border-gray-200">
      <h2 class="text-2xl font-bold text-gray-900">Monthly Trend</h2>
      <p class="text-gray-600 mt-1">Survey responses and satisfaction over time</p>
    </div>
    <div class="p-8">
      <div class="overflow-x-auto">
        <table class="min-w-full">
          <thead>
            <tr class="border-b border-gray-200">
              <th class="text-left py-3 px-4 font-semibold text-gray-900">Month</th>
              <th class="text-center py-3 px-4 font-semibold text-gray-900">Responses</th>
              <th class="text-center py-3 px-4 font-semibold text-gray-900">Avg Rating</th>
              <th class="text-right py-3 px-4 font-semibold text-gray-900">Trend</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-200">
            @foreach($monthlyTrend as $month)
              <tr class="hover:bg-gray-50">
                <td class="py-3 px-4 font-medium text-gray-900">
                  {{ \Carbon\Carbon::parse($month->month . '-01')->format('F Y') }}
                </td>
                <td class="py-3 px-4 text-center text-gray-700">{{ $month->count }}</td>
                <td class="py-3 px-4 text-center">
                  <div class="flex items-center justify-center space-x-1">
                    <span class="font-semibold text-gray-900">{{ number_format($month->avg_rating, 1) }}</span>
                    <div class="flex">
                      @for($i = 1; $i <= 5; $i++)
                        <svg class="w-3 h-3 {{ $i <= round($month->avg_rating) ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                          <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                      @endfor
                    </div>
                  </div>
                </td>
                <td class="py-3 px-4 text-right">
                  <div class="w-20 bg-gray-200 rounded-full h-2 ml-auto">
                    <div class="bg-gradient-to-r from-purple-500 to-indigo-500 h-2 rounded-full" 
                         style="width: {{ ($month->avg_rating / 5) * 100 }}%"></div>
                  </div>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
  @endif

  <!-- All Survey Responses Table -->
  <div class="mt-6 bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
    <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-8 py-6 border-b border-gray-200">
      <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
        <div>
          <h2 class="text-2xl font-bold text-gray-900">All Survey Responses</h2>
          <p class="text-gray-600 mt-1">Complete survey data with user details and responses</p>
        </div>
        <div class="mt-4 sm:mt-0">
          <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
            {{ $allSurveys->total() }} Total Responses
          </span>
        </div>
      </div>
    </div>
    
    @if($allSurveys->count() > 0)
    <div class="overflow-x-auto">
      <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
          <tr>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
              User
            </th>
            <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
              Rating
            </th>
            <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
              Recommend
            </th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
              Feedback
            </th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
              Improvements
            </th>
            <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
              Date
            </th>
            <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
              Actions
            </th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          @foreach($allSurveys as $survey)
            <tr class="hover:bg-gray-50 transition-colors duration-150">
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex items-center">
                  <div class="bg-gradient-to-br from-purple-500 to-indigo-500 rounded-full p-2 mr-3">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                  </div>
                  <div>
                    <div class="text-sm font-medium text-gray-900">
                      {{ $survey->user->name ?? 'Anonymous' }}
                    </div>
                    <div class="text-sm text-gray-500">
                      {{ $survey->user->email ?? 'No email' }}
                    </div>
                  </div>
                </div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-center">
                <div class="flex items-center justify-center space-x-1">
                  <span class="text-sm font-semibold text-gray-900">{{ $survey->satisfaction_rating }}/5</span>
                  <div class="flex">
                    @for($i = 1; $i <= 5; $i++)
                      <svg class="w-3 h-3 {{ $i <= $survey->satisfaction_rating ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                      </svg>
                    @endfor
                  </div>
                </div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-center">
                @if($survey->would_recommend)
                  <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    Yes
                  </span>
                @else
                  <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                    </svg>
                    No
                  </span>
                @endif
              </td>
              <td class="px-6 py-4">
                <div class="text-sm text-gray-900 max-w-xs">
                  @if($survey->feedback)
                    <div class="truncate" title="{{ $survey->feedback }}">
                      {{ Str::limit($survey->feedback, 60) }}
                    </div>
                  @else
                    <span class="text-gray-400 italic">No feedback provided</span>
                  @endif
                </div>
              </td>
              <td class="px-6 py-4">
                <div class="text-sm text-gray-900 max-w-xs">
                  @if($survey->improvements)
                    <div class="truncate" title="{{ $survey->improvements }}">
                      {{ Str::limit($survey->improvements, 60) }}
                    </div>
                  @else
                    <span class="text-gray-400 italic">No suggestions provided</span>
                  @endif
                </div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">
                <div>{{ $survey->created_at->format('M d, Y') }}</div>
                <div class="text-xs text-gray-400">{{ $survey->created_at->format('h:i A') }}</div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                <div class="flex items-center justify-center space-x-2">
                  <!-- View Details Button -->
                  <button onclick="viewSurveyDetails({{ $survey->id }})" 
                          class="text-indigo-600 hover:text-indigo-900 transition-colors duration-150"
                          title="View full details">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                  </button>
                  
                  <!-- Delete Button -->
                  <form action="{{ route('admin.surveys.destroy', $survey) }}" method="POST" class="inline"
                        onsubmit="return confirm('Are you sure you want to delete this survey response?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="text-red-600 hover:text-red-900 transition-colors duration-150"
                            title="Delete response">
                      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                      </svg>
                    </button>
                  </form>
                </div>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    
    <!-- Pagination -->
    @if($allSurveys->hasPages())
      <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
        <div class="flex items-center justify-between">
          <div class="flex-1 flex justify-between sm:hidden">
            @if($allSurveys->onFirstPage())
              <span class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-500 bg-white cursor-not-allowed">
                Previous
              </span>
            @else
              <a href="{{ $allSurveys->previousPageUrl() }}" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                Previous
              </a>
            @endif
            
            @if($allSurveys->hasMorePages())
              <a href="{{ $allSurveys->nextPageUrl() }}" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                Next
              </a>
            @else
              <span class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-500 bg-white cursor-not-allowed">
                Next
              </span>
            @endif
          </div>
          
          <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
            <div>
              <p class="text-sm text-gray-700">
                Showing
                <span class="font-medium">{{ $allSurveys->firstItem() ?? 0 }}</span>
                to
                <span class="font-medium">{{ $allSurveys->lastItem() ?? 0 }}</span>
                of
                <span class="font-medium">{{ $allSurveys->total() }}</span>
                results
              </p>
            </div>
            <div>
              {{ $allSurveys->links() }}
            </div>
          </div>
        </div>
      </div>
    @endif
    
    @else
    <div class="p-12 text-center">
      <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
      </svg>
      <h3 class="mt-2 text-sm font-medium text-gray-900">No survey responses</h3>
      <p class="mt-1 text-sm text-gray-500">No users have submitted surveys yet.</p>
    </div>
    @endif
  </div>

  <!-- Survey Details Modal -->
  <div id="surveyModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-md bg-white">
      <div class="mt-3">
        <div class="flex items-center justify-between mb-4">
          <h3 class="text-lg font-medium text-gray-900">Survey Response Details</h3>
          <button onclick="closeSurveyModal()" class="text-gray-400 hover:text-gray-600">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
          </button>
        </div>
        <div id="surveyModalContent">
          <!-- Content will be loaded here -->
        </div>
      </div>
    </div>
  </div>

  <script>
    function viewSurveyDetails(surveyId) {
      // Find the survey data from the current page
      const surveys = @json($allSurveys->items());
      const survey = surveys.find(s => s.id === surveyId);
      
      if (survey) {
        const modalContent = document.getElementById('surveyModalContent');
        const stars = '★'.repeat(survey.satisfaction_rating) + '☆'.repeat(5 - survey.satisfaction_rating);
        
        modalContent.innerHTML = `
          <div class="space-y-4">
            <div class="bg-gray-50 p-4 rounded-lg">
              <h4 class="font-semibold text-gray-900 mb-2">User Information</h4>
              <p><strong>Name:</strong> ${survey.user?.name || 'Anonymous'}</p>
              <p><strong>Email:</strong> ${survey.user?.email || 'No email'}</p>
              <p><strong>Submitted:</strong> ${new Date(survey.created_at).toLocaleString()}</p>
            </div>
            
            <div class="bg-gray-50 p-4 rounded-lg">
              <h4 class="font-semibold text-gray-900 mb-2">Rating & Recommendation</h4>
              <p><strong>Satisfaction Rating:</strong> ${survey.satisfaction_rating}/5 ${stars}</p>
              <p><strong>Would Recommend:</strong> ${survey.would_recommend ? 'Yes ✅' : 'No ❌'}</p>
            </div>
            
            <div class="bg-gray-50 p-4 rounded-lg">
              <h4 class="font-semibold text-gray-900 mb-2">Feedback</h4>
              <p class="text-gray-700">${survey.feedback || 'No feedback provided'}</p>
            </div>
            
            <div class="bg-gray-50 p-4 rounded-lg">
              <h4 class="font-semibold text-gray-900 mb-2">Improvement Suggestions</h4>
              <p class="text-gray-700">${survey.improvements || 'No suggestions provided'}</p>
            </div>
          </div>
        `;
        
        document.getElementById('surveyModal').classList.remove('hidden');
      }
    }
    
    function closeSurveyModal() {
      document.getElementById('surveyModal').classList.add('hidden');
    }
    
    // Close modal when clicking outside
    document.getElementById('surveyModal').addEventListener('click', function(e) {
      if (e.target === this) {
        closeSurveyModal();
      }
    });
  </script>
</div>
@endsection
