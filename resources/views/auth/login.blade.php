{{-- resources/views/auth/login.blade.php --}}
@extends('layouts.app')

{{-- Remove the default nav bar --}}
@section('hide-nav')@endsection

{{-- Don’t wrap in the max-width <main> container --}}
@section('fullscreen')@endsection

@section('content')
  {{-- Full-viewport gradient background --}}
  <div class="fixed inset-0 w-screen h-screen bg-gradient-to-br from-red-50 via-rose-50 to-pink-50 -z-10">
    <div class="absolute top-20 left-20 w-72 h-72 bg-red-200 rounded-full mix-blend-multiply filter blur-xl opacity-30 animate-pulse"></div>
    <div class="absolute top-40 right-20 w-96 h-96 bg-rose-200 rounded-full mix-blend-multiply filter blur-xl opacity-30 animate-pulse delay-1000"></div>
    <div class="absolute -bottom-32 left-40 w-80 h-80 bg-pink-200 rounded-full mix-blend-multiply filter blur-xl opacity-30 animate-pulse delay-2000"></div>
  </div>

  {{-- Page content on top --}}
<div class="relative z-10 min-h-screen flex overflow-hidden lg:space-x-16">
    
    {{-- Left illustration (hidden on small) --}}
    <div class="hidden lg:flex w-1/2 items-center justify-center p-35">
      <div class="relative z-10 max-w-md">
        <div class="bg-white/20 backdrop-blur-sm rounded-3xl p-8 shadow-2xl border border-white/30">
          <img src="{{ asset('images/login-illustration.jpg') }}"
               alt="Illustration" class="w-full h-80 object-cover rounded-2xl shadow-lg">
          <div class="mt-6 text-center">
            <h3 class="text-2xl font-bold text-red-900 mb-2">Welcome to Your Future</h3>
            <p class="text-red-700">Discover the perfect tech field that matches your passion and skills</p>
          </div>
        </div>
      </div>
    </div>

    {{-- Right side form --}}
    <div class="w-full lg:w-1/2 flex flex-col justify-center px-8 py-12" x-data="loginForm()">
      <!-- Loading Modal -->
      <div
        x-show="loading"
        x-cloak
        style="background: rgba(0,0,0,0.5);"
        class="fixed inset-0 flex items-center justify-center z-50"
      >
        <div class="bg-white p-8 rounded shadow text-center">
          <svg class="animate-spin h-8 w-8 mx-auto mb-4 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path>
          </svg>
          <p class="text-lg font-semibold">Signing you in...</p>
        </div>
      </div>

      <div class="max-w-md mx-auto w-full">
        {{-- Logo & Header --}}
        <div class="mb-8 text-center lg:text-left">
          <a href="/" class="inline-block mb-6 transform hover:scale-105 transition-transform duration-300">
            <div class="rounded-2xl ">
              <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-30 rounded-md">
            </div>
          </a>
          <h1 class="text-4xl font-bold bg-gradient-to-r from-red-600 to-rose-600 bg-clip-text text-transparent mb-2">
            Welcome Back
          </h1>
          <p class="text-red-700/80">Continue your journey to find your perfect tech field</p>
        </div>

        {{-- Login Form --}}
  <form method="POST" action="{{ route('login') }}" class="space-y-6" @submit.prevent="submitForm" x-ref="form">
          @csrf

          {{-- Email --}}
          <div class="group">
            <label for="email" class="block mb-2 text-red-900 font-medium text-sm uppercase tracking-wide">
              Email Address
            </label>
            <div class="relative">
              <input id="email" name="email" type="email" required autofocus
                     class="w-full px-4 py-4 bg-white/80 backdrop-blur-sm border-2 border-red-200 rounded-xl 
                            focus:outline-none focus:border-red-500 focus:ring-4 focus:ring-red-500/20 
                            transition-all duration-300 placeholder-red-400/60 text-red-900
                            group-hover:border-red-300"
                     placeholder="Enter your email">
              <div class="absolute inset-0 bg-gradient-to-r from-red-500/5 to-rose-500/5 rounded-xl opacity-0 
                          group-hover:opacity-100 transition-opacity duration-300 pointer-events-none"></div>
            </div>
            @error('email')
              <div class="flex items-center mt-2 text-red-600 text-sm animate-slide-down">
                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd"
                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                        clip-rule="evenodd"></path>
                </svg>
                {{ $message }}
              </div>
            @enderror
          </div>

          {{-- Password --}}
          <div class="group">
            <label for="password" class="block mb-2 text-red-900 font-medium text-sm uppercase tracking-wide">
              Password
            </label>
            <div class="relative">
              <input id="password" name="password" type="password" required
                     class="w-full px-4 py-4 bg-white/80 backdrop-blur-sm border-2 border-red-200 rounded-xl 
                            focus:outline-none focus:border-red-500 focus:ring-4 focus:ring-red-500/20 
                            transition-all duration-300 placeholder-red-400/60 text-red-900
                            group-hover:border-red-300"
                     placeholder="Enter your password">
              <div class="absolute inset-0 bg-gradient-to-r from-red-500/5 to-rose-500/5 rounded-xl opacity-0 
                          group-hover:opacity-100 transition-opacity duration-300 pointer-events-none"></div>
            </div>
            @error('password')
              <div class="flex items-center mt-2 text-red-600 text-sm animate-slide-down">
                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd"
                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                        clip-rule="evenodd"></path>
                </svg>
                {{ $message }}
              </div>
            @enderror
          </div>

          {{-- Remember & Forgot --}}
          <div class="flex items-center justify-between pt-2">
            <label class="inline-flex items-center group cursor-pointer">
              <input type="checkbox" name="remember"
                     class="w-5 h-5 text-red-600 bg-white border-2 border-red-300 rounded focus:ring-red-500 focus:ring-2">
              <span class="ml-3 text-red-800 group-hover:text-red-900 transition-colors duration-200">
                Remember me
              </span>
            </label>
            <a href="{{ route('password.request') }}" class="text-red-600 hover:text-red-800 text-sm font-medium hover:underline transition-all duration-200">
              Forgot password?
            </a>
          </div>

          {{-- Submit --}}
          <button type="submit"
            :disabled="disabled"
            class="w-full py-4 px-6 bg-gradient-to-r from-red-600 to-rose-600 text-white font-semibold rounded-xl
                  hover:from-red-700 hover:to-rose-700 focus:outline-none focus:ring-4 focus:ring-red-500/30
                  transform hover:scale-[1.02] active:scale-[0.98] transition-all duration-200
                  shadow-lg hover:shadow-xl relative overflow-hidden group"
            :class="{ 'opacity-50 cursor-not-allowed': disabled }"
          >
            <span class="relative z-10">Sign In</span>
          </button>

          {{-- Sign up link --}}
          <div class="text-center pt-4">
            <p class="text-red-700">
              Don’t have an account?
              <a href="register" class="text-red-600 font-semibold hover:text-red-800 hover:underline transition-all duration-200">
                Create one now
              </a>
            </p>
          </div>
        </form>
      </div>
    </div>
  </div>

  {{-- Slide-down error animation --}}
  <style>
    [x-cloak] { display: none; }
    @keyframes slide-down {
      from {
        opacity: 0;
        transform: translateY(-10px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
    .animate-slide-down {
      animation: slide-down 0.3s ease-out;
    }
  </style>
  <script>
    document.addEventListener('alpine:init', () => {
      Alpine.data('loginForm', () => ({
        disabled: false,
        loading: false,
        submitForm() {
          this.disabled = true;
          this.loading = true;
          this.$refs.form.submit();
        }
      }))
    })
  </script>
@endsection