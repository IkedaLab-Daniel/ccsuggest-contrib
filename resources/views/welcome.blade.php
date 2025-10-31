{{-- resources/views/welcome.blade.php --}}
@extends('layouts.app')

@section('hide-nav')@endsection   {{-- optional – removes the top bar --}}
@section('fullscreen')@endsection {{-- optional – stops the <main> wrapper from appearing --}}

@section('content')
  @auth
    <script>window.location.href = '/dashboard';</script>
  @endauth
  <div class="absolute inset-0 bg-gradient-to-br from-red-900 via-rose-800 to-pink-700">
    <!-- Animated background shapes -->
    <div class="absolute top-0 left-0 w-full h-full">
      <div class="absolute top-20 left-10 w-96 h-96 bg-red-400/20 rounded-full blur-3xl animate-pulse"></div>
      <div class="absolute top-40 right-20 w-80 h-80 bg-rose-400/20 rounded-full blur-3xl animate-pulse delay-1000"></div>
      <div class="absolute bottom-20 left-1/3 w-72 h-72 bg-pink-400/20 rounded-full blur-3xl animate-pulse delay-2000"></div>
      <div class="absolute bottom-40 right-10 w-64 h-64 bg-red-300/20 rounded-full blur-3xl animate-pulse delay-3000"></div>
    </div>
    
    <!-- Grid pattern overlay -->
    <div class="absolute inset-0 bg-grid-pattern opacity-10"></div>
  </div>


   <div class="relative z-10 min-h-screen flex flex-col items-center justify-center px-4 py-16">
    <div class="text-center max-w-6xl mx-auto">


      <!-- Main heading with gradient text -->
      <h1 class="text-5xl md:text-7xl lg:text-8xl font-black mb-6 leading-tight">
        <span class="bg-gradient-to-r from-white via-red-100 to-rose-200 bg-clip-text text-transparent 
                     drop-shadow-2xl animate-text-shimmer bg-size-200 bg-pos-0 hover:bg-pos-100 transition-all duration-1000">
          Tech Field
        </span>
        <br>
        <span class="bg-gradient-to-r from-red-200 via-rose-200 to-pink-200 bg-clip-text text-transparent 
                     drop-shadow-2xl animate-text-shimmer bg-size-200 bg-pos-0 hover:bg-pos-100 transition-all duration-1000 delay-300">
          Recommender
        </span>
      </h1>

      <!-- Subtitle with enhanced styling -->
      <div class="mb-12 max-w-4xl mx-auto">
        <p class="text-lg md:text-2xl text-white/90 leading-relaxed font-light mb-6">
          Discover which <span class="font-semibold text-red-200">technology-based academic program</span> 
          best matches your interests, skills, and career goals.
        </p>
        <p class="text-lg md:text-2xl text-white/80 leading-relaxed">
          Take our dynamic, adaptive questionnaire and get personalized recommendations across 
          <span class="font-semibold text-rose-200">11 cutting-edge tech fields</span>.
        </p>
      </div>

      <!-- Feature highlights -->
      <div class="grid md:grid-cols-3 gap-6 mb-12 max-w-4xl mx-auto">
        <div class="bg-white/10 backdrop-blur-md rounded-2xl p-6 border border-white/20 transform hover:scale-105 transition-all duration-300 hover:bg-white/15">
          <div class="w-12 h-12 bg-gradient-to-r from-red-400 to-rose-400 rounded-xl flex items-center justify-center mb-4 mx-auto">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
            </svg>
          </div>
          <h3 class="text-white font-semibold mb-2">AI-Powered</h3>
          <p class="text-white/80 text-sm">Advanced algorithms analyze your responses for precise recommendations</p>
        </div>
        
        <div class="bg-white/10 backdrop-blur-md rounded-2xl p-6 border border-white/20 transform hover:scale-105 transition-all duration-300 hover:bg-white/15">
          <div class="w-12 h-12 bg-gradient-to-r from-rose-400 to-pink-400 rounded-xl flex items-center justify-center mb-4 mx-auto">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
            </svg>
          </div>
          <h3 class="text-white font-semibold mb-2">Adaptive</h3>
          <p class="text-white/80 text-sm">Dynamic questions that evolve based on your unique profile</p>
        </div>
        
        <div class="bg-white/10 backdrop-blur-md rounded-2xl p-6 border border-white/20 transform hover:scale-105 transition-all duration-300 hover:bg-white/15">
          <div class="w-12 h-12 bg-gradient-to-r from-pink-400 to-red-400 rounded-xl flex items-center justify-center mb-4 mx-auto">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
            </svg>
          </div>
          <h3 class="text-white font-semibold mb-2">Comprehensive</h3>
          <p class="text-white/80 text-sm">Coverage of 11 major technology fields and specializations</p>
        </div>
      </div>

      <!-- CTA Button with enhanced design -->
      <div class="space-y-4">
        <a href="{{ route('login') }}"
           class="group relative inline-flex items-center justify-center px-12 py-5 text-xl font-bold text-red-900 
                  bg-white rounded-2xl shadow-2xl hover:shadow-3xl transform hover:scale-105 active:scale-95
                  transition-all duration-300 hover:bg-red-50 min-w-72">
          <span class="relative z-10 flex items-center">
            Get Started Now
            <svg class="w-6 h-6 ml-3 transform group-hover:translate-x-1 transition-transform duration-300" 
                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
            </svg>
          </span>
          <div class="absolute inset-0 bg-gradient-to-r from-red-50 to-rose-50 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
        </a>
        
    
      </div>

      <!-- Tech field preview -->
      <div class="mt-16 max-w-5xl mx-auto">
        <h2 class="text-2xl font-bold text-white mb-8">Explore Technology Fields</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
          @php
            $techFields = [
              'AI & ML', 'Web Dev', 'Mobile', 'Data Science', 
              'Cybersecurity', 'Cloud', 'DevOps', 'Blockchain',
              'IoT', 'Game Dev', 'UI/UX'
            ];
          @endphp
          
          @foreach($techFields as $index => $field)
            <div class="bg-white/5 backdrop-blur-sm rounded-xl p-4 border border-white/10 hover:bg-white/10 transition-all duration-300 transform hover:scale-105"
                 style="animation-delay: {{ $index * 100 }}ms">
              <div class="text-white/90 text-sm font-medium text-center">{{ $field }}</div>
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>

  {{-- floating particles, still positioned relative to the page root --}}
  <div class="fixed inset-0 pointer-events-none -z-20">
    <div class="particle particle-1"></div>
    <div class="particle particle-2"></div>
    <div class="particle particle-3"></div>
    <div class="particle particle-4"></div>
    <div class="particle particle-5"></div>
  </div>


<style>
/* Background grid pattern */
.bg-grid-pattern {
  background-image: 
    linear-gradient(rgba(255,255,255,0.1) 1px, transparent 1px),
    linear-gradient(90deg, rgba(255,255,255,0.1) 1px, transparent 1px);
  background-size: 50px 50px;
}

/* Text shimmer animation */
@keyframes text-shimmer {
  0% { background-position: 0% 50%; }
  50% { background-position: 100% 50%; }
  100% { background-position: 0% 50%; }
}

.animate-text-shimmer {
  animation: text-shimmer 3s ease-in-out infinite;
}

.bg-size-200 { background-size: 200% 200%; }
.bg-pos-0 { background-position: 0% 50%; }
.bg-pos-100 { background-position: 100% 50%; }

/* Floating particles */
.particle {
  position: absolute;
  background: rgba(255, 255, 255, 0.1);
  border-radius: 50%;
  animation: float 20s infinite linear;
}

.particle-1 {
  width: 8px;
  height: 8px;
  left: 10%;
  animation-delay: 0s;
}

.particle-2 {
  width: 12px;
  height: 12px;
  left: 20%;
  animation-delay: -5s;
}

.particle-3 {
  width: 6px;
  height: 6px;
  left: 60%;
  animation-delay: -10s;
}

.particle-4 {
  width: 10px;
  height: 10px;
  left: 80%;
  animation-delay: -15s;
}

.particle-5 {
  width: 14px;
  height: 14px;
  left: 90%;
  animation-delay: -7s;
}

@keyframes float {
  0% {
    transform: translateY(100vh) rotate(0deg);
    opacity: 0;
  }
  10% {
    opacity: 1;
  }
  90% {
    opacity: 1;
  }
  100% {
    transform: translateY(-100px) rotate(360deg);
    opacity: 0;
  }
}

/* Enhanced shadows */
.shadow-3xl {
  box-shadow: 0 35px 60px -12px rgba(0, 0, 0, 0.25);
}
@endsection
