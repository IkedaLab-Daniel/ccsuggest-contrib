{{-- resources/views/auth/verify-otp.blade.php --}}
@extends('layouts.app')

@section('hide-nav')@endsection
@section('fullscreen')@endsection

@section('content')
  {{-- Full-viewport gradient background --}}
  <div class="fixed inset-0 w-screen h-screen bg-gradient-to-br from-red-50 via-rose-50 to-pink-50 -z-10">
    <div class="absolute top-20 left-20 w-72 h-72 bg-red-200 rounded-full mix-blend-multiply filter blur-xl opacity-30 animate-pulse"></div>
    <div class="absolute top-40 right-20 w-96 h-96 bg-rose-200 rounded-full mix-blend-multiply filter blur-xl opacity-30 animate-pulse delay-1000"></div>
    <div class="absolute -bottom-32 left-40 w-80 h-80 bg-pink-200 rounded-full mix-blend-multiply filter blur-xl opacity-30 animate-pulse delay-2000"></div>
  </div>

  <div class="relative z-10 min-h-screen flex overflow-hidden lg:space-x-16">
    {{-- Left illustration (hidden on small) --}}
    <div class="hidden lg:flex w-1/2 items-center justify-center p-35">
      <div class="relative z-10 max-w-md">
        <div class="bg-white/20 backdrop-blur-sm rounded-3xl p-8 shadow-2xl border border-white/30">
          <img src="{{ asset('images/login-illustration.jpg') }}"
               alt="Illustration" class="w-full h-80 object-cover rounded-2xl shadow-lg">
          <div class="mt-6 text-center">
            <h3 class="text-2xl font-bold text-red-900 mb-2">Almost There!</h3>
            <p class="text-red-700">Just one more step to start your tech journey</p>
          </div>
        </div>
      </div>
    </div>

    {{-- Right side content --}}
    <div class="w-full lg:w-1/2 flex flex-col justify-center px-8 py-12" x-data="{ resending: false }">
      <div class="max-w-md mx-auto w-full">
        {{-- Logo & Header --}}
        <div class="mb-8 text-center lg:text-left">
          <a href="/" class="inline-block mb-6 transform hover:scale-105 transition-transform duration-300">
            <div class="rounded-2xl">
              <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-30 rounded-md">
            </div>
          </a>
          <h1 class="text-4xl font-bold bg-gradient-to-r from-red-600 to-rose-600 bg-clip-text text-transparent mb-2">
            Verify Your Email
          </h1>
          <p class="text-red-700/80">Enter the 6-digit code we sent to your email</p>
        </div>

        {{-- Success Alert --}}
        @if (session('resent'))
          <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 rounded-lg animate-slide-down">
            <div class="flex items-center">
              <svg class="w-6 h-6 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
              </svg>
              <p class="text-green-700 font-medium">
                A new verification code has been sent to your email!
              </p>
            </div>
          </div>
        @endif

        {{-- Main Content Card --}}
        <div class="bg-white/80 backdrop-blur-sm rounded-2xl p-8 shadow-xl border-2 border-red-100">
          {{-- Email Icon --}}
          <div class="flex justify-center mb-6">
            <div class="w-20 h-20 bg-gradient-to-br from-red-100 to-rose-100 rounded-full flex items-center justify-center">
              <svg class="w-10 h-10 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
              </svg>
            </div>
          </div>

          {{-- Instructions --}}
          <div class="text-center mb-6">
            <h2 class="text-xl font-semibold text-red-900 mb-3">Check Your Inbox</h2>
            <p class="text-red-700 leading-relaxed">
              We've sent a 6-digit verification code to your email address. 
              Please enter it below to verify your account.
            </p>
          </div>

          {{-- Email Address Display --}}
          <div class="bg-red-50 rounded-xl p-4 mb-6 text-center">
            <p class="text-sm text-red-600 mb-1">Verification code sent to:</p>
            <p class="font-semibold text-red-900">{{ Auth::user()->email }}</p>
          </div>

          {{-- OTP Form --}}
          <form method="POST" action="{{ route('verification.verify') }}" class="space-y-6">
            @csrf

            <div class="group">
              <label for="code" class="block mb-2 text-red-900 font-medium text-sm uppercase tracking-wide text-center">
                Enter Verification Code
              </label>
              <div class="relative">
                <input 
                  id="code" 
                  name="code" 
                  type="text" 
                  maxlength="6" 
                  pattern="[0-9]{6}"
                  required 
                  autofocus
                  class="w-full px-4 py-4 text-center text-2xl font-bold tracking-widest bg-white/80 backdrop-blur-sm border-2 border-red-200 rounded-xl 
                         focus:outline-none focus:border-red-500 focus:ring-4 focus:ring-red-500/20 
                         transition-all duration-300 placeholder-red-400/60 text-red-900
                         group-hover:border-red-300"
                  placeholder="000000"
                  oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                >
              </div>
              @error('code')
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

            <button type="submit"
                    class="w-full py-4 px-6 bg-gradient-to-r from-red-600 to-rose-600 text-white font-semibold rounded-xl
                           hover:from-red-700 hover:to-rose-700 focus:outline-none focus:ring-4 focus:ring-red-500/30
                           transform hover:scale-[1.02] active:scale-[0.98] transition-all duration-200
                           shadow-lg hover:shadow-xl relative overflow-hidden group">
              <span class="relative z-10">Verify Email</span>
              <div class="absolute inset-0 bg-gradient-to-r from-red-700 to-rose-700 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            </button>
          </form>

          {{-- Divider --}}
          <div class="flex items-center my-6">
            <div class="flex-1 border-t border-red-200"></div>
            <span class="px-4 text-red-600 text-sm font-medium">Didn't receive it?</span>
            <div class="flex-1 border-t border-red-200"></div>
          </div>

          {{-- Resend Form --}}
          <form method="POST" action="{{ route('verification.resend') }}" @submit="resending = true">
            @csrf
            <button type="submit"
                    :disabled="resending"
                    class="w-full py-3 px-6 bg-white border-2 border-red-200 text-red-600 font-semibold rounded-xl
                           hover:bg-red-50 hover:border-red-300 focus:outline-none focus:ring-4 focus:ring-red-500/20
                           transform hover:scale-[1.02] active:scale-[0.98] transition-all duration-200
                           disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none">
              <span class="flex items-center justify-center" x-show="!resending">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                </svg>
                Resend Code
              </span>
              <span class="flex items-center justify-center" x-show="resending" x-cloak>
                <svg class="animate-spin h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24">
                  <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                  <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path>
                </svg>
                Sending...
              </span>
            </button>
          </form>

          {{-- Help Text --}}
          <div class="mt-6 text-center text-sm text-red-600">
            <p class="flex items-center justify-center mb-2">
              <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
              </svg>
              Code expires in 15 minutes
            </p>
            <p class="text-xs">Check your spam folder if you don't see the email</p>
          </div>
        </div>

        {{-- Logout Link --}}
        <div class="text-center pt-6">
          <p class="text-red-700">
            Wrong email address?
            <form method="POST" action="{{ route('logout') }}" class="inline">
              @csrf
              <button type="submit" class="text-red-600 font-semibold hover:text-red-800 hover:underline transition-all duration-200">
                Logout and try again
              </button>
            </form>
          </p>
        </div>
      </div>
    </div>
  </div>

  {{-- Styles --}}
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
@endsection
