{{-- resources/views/student/dashboard.blade.php --}}
@extends('layouts.student')

@section('title', 'Dashboard')

@section('content')
<div class="space-y-8">

  {{-- ╭─────────────────────── Hero Greeting ───────────────────────╮ --}}
  <section class="relative bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-600 rounded-2xl shadow-2xl p-8 text-white overflow-hidden">
    {{-- Animated background elements --}}
    <div class="absolute inset-0 pointer-events-none">
      <div class="absolute w-64 h-64 bg-white/10 rounded-full blur-3xl animate-pulse" style="top:-10%; right:-10%"></div>
      <div class="absolute w-48 h-48 bg-white/5 rounded-full blur-2xl animate-pulse" style="bottom:-20%; left:-10%"></div>
      <div class="absolute w-32 h-32 bg-white/20 rounded-full animate-bounce" style="top:15%; left:10%"></div>
      <div class="absolute w-24 h-24 bg-white/15 rounded-full animate-bounce" style="bottom:20%; right:20%; animation-delay: 1s"></div>
    </div>

    <div class="relative z-10 flex flex-col lg:flex-row lg:items-center lg:justify-between">
      <div class="flex-1 mb-6 lg:mb-0">
        <div class="flex items-center mb-4">
          <div class="h-12 w-12 bg-white/20 backdrop-blur rounded-full flex items-center justify-center mr-4">
            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
              <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
            </svg>
          </div>
          <h1 class="text-4xl font-bold">Welcome back, {{ Auth::user()->name }}!</h1>
        </div>
        <p class="text-xl text-white/90 leading-relaxed max-w-2xl">
          {{ $complete
              ? 'Your profile is complete and ready! Explore your personalized tech recommendations and roadmaps.'
              : 'Complete your profile to unlock personalized tech field recommendations tailored just for you.' }}
        </p>
      </div>

      <div class="flex flex-col sm:flex-row gap-4">
        <a href="{{ route('student.profile.edit') }}"
           class="group relative bg-white/20 backdrop-blur-sm border border-white/30 px-8 py-4 rounded-xl hover:bg-white/30 transition-all duration-300 transform hover:scale-105 shadow-lg">
          <div class="flex items-center justify-center">
            <svg class="h-5 w-5 mr-2 group-hover:rotate-12 transition-transform" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
            </svg>
            {{ $complete ? 'Update Profile' : 'Complete Profile' }}
          </div>
        </a>
      </div>
    </div>
  </section>
  {{-- ╰────────────────────────────────────────────────────────────╯ --}}

  {{-- ╭─────────────────── Profile Overview Card ──────────────────╮ --}}
  <section class="bg-white/80 backdrop-blur-sm border border-gray-200/50 shadow-xl rounded-2xl p-8 hover:shadow-2xl transition-all duration-300">
    <div class="flex items-center mb-6">
      <div class="h-10 w-10 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center mr-4">
        <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
        </svg>
      </div>
      <h2 class="text-2xl font-bold text-gray-800">Your Profile</h2>
    </div>

    @unless($profile)
      <div class="text-center py-12">
        <div class="h-16 w-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
          <svg class="h-8 w-8 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
          </svg>
        </div>
        <p class="text-gray-600 text-lg">No profile data found. Please complete your profile first.</p>
      </div>
    @else
      <dl class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">
        <div class="group">
          <dt class="text-sm font-semibold text-gray-500 uppercase tracking-wide mb-2">Full Name</dt>
          <dd class="text-lg font-medium text-gray-900 group-hover:text-indigo-600 transition-colors">{{ $profile->full_name }}</dd>
        </div>

        <div class="group">
          <dt class="text-sm font-semibold text-gray-500 uppercase tracking-wide mb-2">Date of Birth</dt>
          <dd class="text-lg font-medium text-gray-900 group-hover:text-indigo-600 transition-colors">{{ $profile->date_of_birth->format('F d, Y') }}</dd>
        </div>

        <div class="group">
          <dt class="text-sm font-semibold text-gray-500 uppercase tracking-wide mb-2">Gender</dt>
          <dd class="text-lg font-medium text-gray-900 capitalize group-hover:text-indigo-600 transition-colors">{{ $profile->gender ?? '—' }}</dd>
        </div>

        <div class="group">
          <dt class="text-sm font-semibold text-gray-500 uppercase tracking-wide mb-2">GPA</dt>
          <dd class="text-lg font-medium text-gray-900 group-hover:text-indigo-600 transition-colors">
            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-indigo-100 text-indigo-800">
              {{ $profile->gpa ?? '—' }}
            </span>
          </dd>
        </div>

        <div class="group">
          <dt class="text-sm font-semibold text-gray-500 uppercase tracking-wide mb-2">Senior HS Grade</dt>
          <dd class="text-lg font-medium text-gray-900 group-hover:text-indigo-600 transition-colors">
            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
              {{ $profile->senior_high_grade ?? '—' }}
            </span>
          </dd>
        </div>

        <div class="md:col-span-2 xl:col-span-1">
          <dt class="text-sm font-semibold text-gray-500 uppercase tracking-wide mb-2">Interests</dt>
          <dd class="flex flex-wrap gap-2">
            @forelse($profile->interests ?? [] as $tag)
              <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gradient-to-r from-purple-100 to-pink-100 text-purple-800 hover:from-purple-200 hover:to-pink-200 transition-all duration-200">
                {{ $tag }}
              </span>
            @empty
              <span class="text-gray-600">—</span>
            @endforelse
          </dd>
        </div>
      </dl>
    @endunless
  </section>
  {{-- ╰────────────────────────────────────────────────────────────╯ --}}

  {{-- ╭─────────────────────── Quick Actions ───────────────────────╮ --}}
  <section class="grid grid-cols-1 lg:grid-cols-2 gap-8">
    <!-- Questionnaire Card -->
    <div class="group relative bg-gradient-to-br from-blue-500 via-indigo-600 to-purple-700 text-white rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:scale-105 overflow-hidden">
      <div class="absolute inset-0 bg-gradient-to-br from-blue-400/20 to-purple-600/20"></div>
      <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full -translate-y-16 translate-x-16"></div>
      <div class="absolute bottom-0 left-0 w-24 h-24 bg-white/5 rounded-full translate-y-12 -translate-x-12"></div>
      
      <div class="relative z-10 p-8 h-full flex flex-col justify-between">
        <div>
          <div class="flex items-center mb-4">
            <div class="h-12 w-12 bg-white/20 backdrop-blur rounded-xl flex items-center justify-center mr-4">
              <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
              </svg>
            </div>
            <h3 class="text-2xl font-bold">Take Questionnaire</h3>
          </div>
          <p class="text-blue-100 leading-relaxed text-lg">
            Answer our comprehensive assessment to discover tech fields that align perfectly with your interests and skills.
          </p>
        </div>
        
        <a href="{{ route('student.questionnaire.start') }}"
           class="group/btn mt-6 inline-flex items-center justify-center bg-white/20 backdrop-blur-sm border border-white/30 px-8 py-4 rounded-xl hover:bg-white/30 transition-all duration-300 transform hover:scale-105">
          <span class="mr-2 text-lg font-semibold">Start Assessment</span>
          <svg class="h-5 w-5 group-hover/btn:translate-x-1 transition-transform" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
          </svg>
        </a>
      </div>
    </div>

    <!-- Results Card -->
    <div class="group relative bg-gradient-to-br from-emerald-500 via-teal-600 to-cyan-700 text-white rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:scale-105 overflow-hidden">
      <div class="absolute inset-0 bg-gradient-to-br from-emerald-400/20 to-cyan-600/20"></div>
      <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full -translate-y-16 translate-x-16"></div>
      <div class="absolute bottom-0 left-0 w-24 h-24 bg-white/5 rounded-full translate-y-12 -translate-x-12"></div>
      
      <div class="relative z-10 p-8 h-full flex flex-col justify-between">
        <div>
          <div class="flex items-center mb-4">
            <div class="h-12 w-12 bg-white/20 backdrop-blur rounded-xl flex items-center justify-center mr-4">
              <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
              </svg>
            </div>
            <h3 class="text-2xl font-bold">View Results</h3>
          </div>
          <p class="text-emerald-100 leading-relaxed text-lg">
            Explore your personalized tech field recommendations and download comprehensive career guidance as PDF.
          </p>
        </div>
        
        <a href="{{ route('student.results') }}"
           class="group/btn mt-6 inline-flex items-center justify-center bg-white/20 backdrop-blur-sm border border-white/30 px-8 py-4 rounded-xl hover:bg-white/30 transition-all duration-300 transform hover:scale-105">
          <span class="mr-2 text-lg font-semibold">View Recommendations</span>
          <svg class="h-5 w-5 group-hover/btn:translate-x-1 transition-transform" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
          </svg>
        </a>
      </div>
    </div>
  </section>
  {{-- ╰────────────────────────────────────────────────────────────╯ --}}

  {{-- ╭─────────────────────── Tech Field Roadmaps ─────────────────────╮ --}}
  <section class="bg-white/80 backdrop-blur-sm border border-gray-200/50 shadow-xl rounded-2xl p-8">
    <div class="flex items-center mb-8">
      <div class="h-10 w-10 bg-gradient-to-br from-purple-500 to-pink-600 rounded-xl flex items-center justify-center mr-4">
        <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
        </svg>
      </div>
      <h2 class="text-2xl font-bold text-gray-800">Learning Roadmaps</h2>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-6">
@foreach($techFields as $field)
  <div x-data="{
         modalOpen: false,
         fieldData: @js([
           'name' => $field->name,
           'steps' => $roadmaps[$field->name] ?? [],
           'hasRoadmap' => isset($roadmaps[$field->name])
         ])
       }"
       class="group bg-white border border-gray-200 rounded-xl shadow-md hover:shadow-xl transition-all
              duration-300 overflow-hidden cursor-pointer transform hover:scale-105"
       @click="modalOpen = true">

    {{-- Field Card Content --}}
    <div class="p-6">
      <div class="flex items-center justify-between mb-4">
        <div class="flex items-center flex-1">
          <div class="h-12 w-12 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-lg flex items-center justify-center mr-4 group-hover:scale-110 transition-transform">
            <svg class="h-6 w-6 text-white" fill="currentColor" viewBox="0 0 24 24">
              <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
            </svg>
          </div>
          <span class="font-bold text-lg text-gray-800 group-hover:text-indigo-600 transition-colors">
            {{ $field->name }}
          </span>
        </div>
        <div class="flex items-center text-gray-400 group-hover:text-indigo-600 transition-colors">
          <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
          </svg>
        </div>
      </div>

      @if(isset($roadmaps[$field->name]))
        <div class="space-y-2">
          <div class="flex items-center text-sm text-gray-600 mb-3">
            <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
            {{ count($roadmaps[$field->name]) }} Learning Steps
          </div>

          {{-- Preview of first 3 steps --}}
          <div class="space-y-2">
            @foreach(array_slice($roadmaps[$field->name], 0, 3) as $index => $step)
              <div class="flex items-center text-sm text-gray-700">
                <div class="h-6 w-6 bg-gradient-to-br from-indigo-400 to-purple-500 rounded-full flex items-center justify-center text-white text-xs font-bold mr-3 flex-shrink-0">
                  {{ $index + 1 }}
                </div>
                <span class="truncate">{{ $step }}</span>
              </div>
            @endforeach

            @if(count($roadmaps[$field->name]) > 3)
              <div class="flex items-center text-sm text-gray-500 pl-9">
                <span>+ {{ count($roadmaps[$field->name]) - 3 }} more steps...</span>
              </div>
            @endif
          </div>
        </div>
      @else
        <div class="text-center py-4">
          <div class="h-8 w-8 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-2">
            <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
            </svg>
          </div>
          <p class="text-sm text-gray-500 font-medium">Roadmap Coming Soon</p>
        </div>
      @endif

      <div class="mt-4 pt-3 border-t border-gray-100">
        <span class="inline-flex items-center text-sm text-indigo-600 font-medium group-hover:text-indigo-800 transition-colors">
          Click to explore roadmap
          <svg class="ml-1 h-4 w-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
          </svg>
        </span>
      </div>
    </div>
    {{-- /Field Card Content --}}

    {{--  <–– TELEPORTED MODAL MARKUP ––>  --}}
    <template x-teleport="body">
      <div x-show="modalOpen"
           x-cloak
           x-transition:enter="transition ease-out duration-300"
           x-transition:enter-start="opacity-0"
           x-transition:enter-end="opacity-100"
           x-transition:leave="transition ease-in duration-200"
           x-transition:leave-start="opacity-100"
           x-transition:leave-end="opacity-0"
           @click.away="modalOpen = false"
           @keydown.escape.window="modalOpen = false"
           class="fixed inset-0 z-50 overflow-y-auto">

        <!-- Backdrop -->
        <div class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm"></div>

        <!-- Modal Content -->
        <div class="flex min-h-screen items-center justify-center p-4">
          <div x-show="modalOpen"
               x-transition:enter="transition ease-out duration-300"
               x-transition:enter-start="opacity-0 transform scale-90"
               x-transition:enter-end="opacity-100 transform scale-100"
               x-transition:leave="transition ease-in duration-200"
               x-transition:leave-start="opacity-100 transform scale-100"
               x-transition:leave-end="opacity-0 transform scale-90"
               @click.stop
               class="relative bg-white rounded-2xl shadow-2xl max-w-4xl w-full max-h-[90vh] overflow-hidden">

            {{-- Modal Header --}}
            <div class="bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 px-8 py-6 text-white flex items-center justify-between">
              <div class="flex items-center space-x-4">
                <div class="h-12 w-12 bg-white/20 backdrop-blur rounded-xl flex items-center justify-center">
                  <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                  </svg>
                </div>
                <div>
                  <h3 class="text-2xl font-bold" x-text="fieldData.name"></h3>
                  <p class="text-white/80 mt-1">Complete Learning Roadmap</p>
                </div>
              </div>
              <button @click="modalOpen = false"
                      class="h-10 w-10 bg-white/20 backdrop-blur rounded-lg flex items-center justify-center hover:bg-white/30 transition-colors">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                </svg>
              </button>
            </div>

            {{-- Modal Body --}}
            <div class="p-8 max-h-[60vh] overflow-y-auto">
              <template x-if="fieldData.hasRoadmap && fieldData.steps.length > 0">
                <div>
                  {{-- Roadmap Stats --}}
                  <div class="bg-gradient-to-r from-indigo-50 to-purple-50 rounded-xl p-6 mb-8">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-center">
                      <div>
                        <div class="h-12 w-12 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center mx-auto mb-2">
                          <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                          </svg>
                        </div>
                        <p class="text-2xl font-bold text-gray-800" x-text="fieldData.steps.length"></p>
                        <p class="text-sm text-gray-600">Learning Steps</p>
                      </div>
                      <div>
                        <div class="h-12 w-12 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-xl flex items-center justify-center mx-auto mb-2">
                          <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                          </svg>
                        </div>
                        <p class="text-2xl font-bold text-gray-800"
                           x-text="Math.ceil(fieldData.steps.length * 2) + '-' + Math.ceil(fieldData.steps.length * 4)"></p>
                        <p class="text-sm text-gray-600">Weeks to Complete</p>
                      </div>
                      <div>
                        <div class="h-12 w-12 bg-gradient-to-br from-orange-500 to-red-600 rounded-xl flex items-center justify-center mx-auto mb-2">
                          <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                          </svg>
                        </div>
                        <p class="text-2xl font-bold text-gray-800">Beginner</p>
                        <p class="text-sm text-gray-600">Difficulty Level</p>
                      </div>
                    </div>
                  </div>

                  {{-- Roadmap Steps --}}
                  <div class="space-y-6">
                    <h4 class="text-xl font-bold text-gray-800 mb-4">Learning Path</h4>
                    <template x-for="(step, index) in fieldData.steps" :key="index">
                      <div class="flex items-start group/step">
                        <div class="flex-shrink-0 mr-6 text-center">
                          <div class="h-10 w-10 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-full flex items-center justify-center text-white font-bold shadow-lg group-hover/step:scale-110 transition-all duration-300"
                               x-text="index + 1"></div>
                          <template x-if="index < fieldData.steps.length - 1">
                            <div class="w-0.5 h-8 bg-gradient-to-b from-indigo-300 to-purple-300 mx-auto mt-3"></div>
                          </template>
                        </div>
                        <div class="flex-1">
                          <h5 class="text-lg font-semibold text-gray-800 group-hover/step:text-indigo-600 transition-colors"
                              x-text="typeof step === 'object' && step.title ? step.title : step"></h5>
                          <template x-if="typeof step === 'object' && step.desc">
                            <p class="mt-2 text-gray-600 leading-relaxed" x-text="step.desc"></p>
                          </template>
                          <template x-if="typeof step === 'object' && Array.isArray(step.resources) && step.resources.length">
                            <ul class="mt-3 space-y-2">
                              <template x-for="(res, rIdx) in step.resources" :key="'res-' + rIdx">
                                <li class="flex items-start">
                                  <svg class="h-4 w-4 text-indigo-500 mt-1 mr-2 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                                  </svg>
                                  <a :href="res.url" target="_blank" rel="noopener"
                                     class="text-sm font-medium text-indigo-600 hover:text-indigo-800 underline"
                                     x-text="res.label || res.url"></a>
                                </li>
                              </template>
                            </ul>
                          </template>
                        </div>
                      </div>
                    </template>
                  </div>
                </div>
              </template>

              {{-- No Roadmap State --}}
              <template x-if="!fieldData.hasRoadmap || fieldData.steps.length === 0">
                <div class="text-center py-16">
                  <div class="h-20 w-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="h-10 w-10 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                  </div>
                  <h4 class="text-xl font-bold text-gray-700 mb-2">Roadmap Coming Soon</h4>
                  <p class="text-gray-600 max-w-md mx-auto">
                    We’re still building this learning path. Check back later or let us know what topics you’d like to see.
                  </p>
                </div>
              </template>
            </div>

            {{-- Modal Footer --}}
            <div class="px-8 py-6 bg-gray-50 border-t border-gray-200 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
              <div class="text-sm text-gray-600">
                <span x-text="fieldData.steps.length + ' total step' + (fieldData.steps.length === 1 ? '' : 's')"></span>
              </div>
         
            </div>
          </div>
        </div>
      </div>
    </template>
    {{--  </–– TELEPORTED MODAL MARKUP ––>  --}}


  </div>
@endforeach

    </div>
  </section>
  {{-- ╰────────────────────────────────────────────────────────────╯ --}}
</div>
@endsection
