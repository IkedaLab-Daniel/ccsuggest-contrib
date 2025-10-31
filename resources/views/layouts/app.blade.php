<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>CCSuggest – @yield('title')</title>

  {{-- Tailwind via CDN for rapid prototyping --}}
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          animation: {
            'pulse': 'pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite',
            'text-shimmer': 'text-shimmer 3s ease-in-out infinite',
          },
        }
      }
    }
  </script>
  <script src="https://unpkg.com/alpinejs" defer></script>

  {{-- Custom styles for enhanced pages --}}
  <style>
    @keyframes text-shimmer {
      0% { background-position: 0% 50%; }
      50% { background-position: 100% 50%; }
      100% { background-position: 0% 50%; }
    }

 
    .animate-text-shimmer { animation: text-shimmer 3s ease-in-out infinite; }
    .bg-size-200 { background-size: 200% 200%; }
    .bg-pos-0 { background-position: 0% 50%; }
    .bg-pos-100 { background-position: 100% 50%; }

    /* Background grid pattern */
    .bg-grid-pattern {
      background-image:
        linear-gradient(rgba(255,255,255,0.1) 1px, transparent 1px),
        linear-gradient(90deg, rgba(255,255,255,0.1) 1px, transparent 1px);
      background-size: 50px 50px;
    }

    /* Floating particles */
    .particle {
      position: absolute;
      background: rgba(255, 255, 255, 0.1);
      border-radius: 50%;
      animation: float 20s infinite linear;
    }
    .particle-1 { width: 8px;  height: 8px;  left: 10%; animation-delay: 0s; }
    .particle-2 { width:12px;  height:12px;  left: 20%; animation-delay:-5s; }
    .particle-3 { width: 6px;  height: 6px;  left: 60%; animation-delay:-10s; }
    .particle-4 { width:10px;  height:10px;  left: 80%; animation-delay:-15s; }
    .particle-5 { width:14px;  height:14px;  left: 90%; animation-delay:-7s; }

    @keyframes float {
      0%   { transform: translateY(100vh) rotate(0deg); opacity:0; }
      10%  { opacity:1; }
      90%  { opacity:1; }
      100% { transform: translateY(-100px) rotate(360deg); opacity:0; }
    }

    @keyframes slide-down {
      from { opacity:0; transform: translateY(-10px); }
      to   { opacity:1; transform: translateY(0); }
    }
    .animate-slide-down { animation: slide-down 0.3s ease-out; }

    /* Enhanced shadows */
    .shadow-3xl {
      box-shadow: 0 35px 60px -12px rgba(0,0,0,0.25);
    }
  </style>

  {{-- Livewire styles --}}
  @livewireStyles

  {{-- Optionally your compiled CSS --}}
  {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
  <link rel="icon" type="image/png" href="{{ asset('images/fav.png') }}">
</head>
<body class="font-sans antialiased bg-gray-100 text-gray-900 relative overflow-x-hidden">

  {{-- Floating particles --}}
  <div class="particle particle-1"></div>
  <div class="particle particle-2"></div>
  <div class="particle particle-3"></div>
  <div class="particle particle-4"></div>
  <div class="particle particle-5"></div>

  @hasSection('hide-nav')
    {{-- No nav --}}
  @else
    @hasSection('custom-nav')
      @yield('custom-nav')
    @else
  <nav class="bg-white shadow relative z-50" x-data="{ loggingOut: false, mobileNavOpen: false }">
        <!-- Loader Modal -->
        <div
          x-show="loggingOut"
          x-cloak
          style="background: rgba(0,0,0,0.5);"
          class="fixed inset-0 flex items-center justify-center z-50"
        >
          <div class="bg-white p-8 rounded shadow text-center">
            <svg class="animate-spin h-8 w-8 mx-auto mb-4 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
              <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
              <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path>
            </svg>
            <p class="text-lg font-semibold">Logging out...</p>
          </div>
        </div>
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
          <a href="{{ url('/') }}">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-10 w-auto">
          </a>
          <!-- Hamburger button for mobile -->
          <button @click="mobileNavOpen = !mobileNavOpen" class="lg:hidden block ml-2 p-2 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500" aria-label="Open navigation">
            <svg class="h-7 w-7 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
          </button>
          <!-- Desktop nav -->
          <div class="hidden lg:flex items-center space-x-4">
            @guest
              <a href="{{ route('login') }}"
                class="px-4 py-2 rounded-lg hover:bg-gray-100 transition-colors duration-300 font-medium">
                Log in
              </a>
              <a href="{{ route('register') }}"
                class="px-4 py-2 rounded-lg hover:bg-gray-100 transition-colors duration-300 font-medium">
                Sign Up
              </a>
            @else
              {{-- Student nav links --}}
              <a href="{{ route('dashboard') }}"
                 class="px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-200 {{ request()->routeIs('dashboard') ? 'bg-gray-200' : '' }}">
                Dashboard
              </a>
              <a href="{{ route('student.questionnaire.start') }}"
                 class="px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-200 {{ request()->routeIs('student.questionnaire.*') ? 'bg-gray-200' : '' }}">
                Questionnaire
              </a>
              <a href="{{ route('student.results') }}"
                 class="px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-200 {{ request()->routeIs('student.results') ? 'bg-gray-200' : '' }}">
                Results
              </a>
              <span class="text-gray-700">Hello, {{ Auth::user()->name }}</span>
              <form method="POST" action="{{ route('logout') }}" class="inline" id="logoutForm">
                @csrf
                <button type="submit"
                        class="px-4 py-2 rounded-lg hover:bg-gray-100 transition-colors duration-300 font-medium" id="logoutBtn">
                  Log out
                </button>
              </form>
            @endguest
          </div>
      <!-- Mobile nav -->
      <div x-show="mobileNavOpen" x-cloak class="fixed inset-0 bg-black/40 z-50 lg:hidden">
        <div class="absolute right-0 top-0 bg-white w-64 h-full shadow-xl p-6 flex flex-col space-y-4">
          <button @click="mobileNavOpen = false" class="self-end mb-4 p-2 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500" aria-label="Close navigation">
            <svg class="h-6 w-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
          @auth
            <a href="{{ route('dashboard') }}"
               class="block px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-200 flex items-center justify-between">
              <span>Dashboard</span>
              @if(request()->routeIs('dashboard'))
                <span class="ml-2 w-2 h-2 rounded-full bg-red-500"></span>
              @endif
            </a>
            <a href="{{ route('student.questionnaire.start') }}"
               class="block px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-200 flex items-center justify-between">
              <span>Questionnaire</span>
              @if(request()->routeIs('student.questionnaire.*'))
                <span class="ml-2 w-2 h-2 rounded-full bg-red-500"></span>
              @endif
            </a>
            <a href="{{ route('student.results') }}"
               class="block px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-200 flex items-center justify-between">
              <span>Results</span>
              @if(request()->routeIs('student.results'))
                <span class="ml-2 w-2 h-2 rounded-full bg-red-500"></span>
              @endif
            </a>
            <span class="text-gray-700 text-sm">Hello, {{ Auth::user()->name }}</span>
            <form method="POST" action="{{ route('logout') }}" class="inline" id="logoutFormMobile">
              @csrf
              <button type="submit"
                      class="block w-full px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-200" id="logoutBtnMobile">
                Log Out
              </button>
            </form>
          @else
            <a href="{{ route('login') }}"
               class="block px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-200">
              Log In
            </a>
            <a href="{{ route('register') }}"
               class="block px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-200">
              Sign Up
            </a>
          @endauth
        </div>
        <div class="flex-1" @click="mobileNavOpen = false"></div>
      </div>
    </div>
    <style>
      [x-cloak] { display: none; }
    </style>
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        var logoutForm = document.getElementById('logoutForm');
        if (logoutForm) {
          logoutForm.addEventListener('submit', function() {
            document.querySelector('nav[x-data]').__x.$data.loggingOut = true;
          });
        }
        var logoutFormMobile = document.getElementById('logoutFormMobile');
        if (logoutFormMobile) {
          logoutFormMobile.addEventListener('submit', function() {
            document.querySelector('nav[x-data]').__x.$data.loggingOut = true;
          });
        }
      });
    </script>
  </nav>
    @endif
  @endif

  @hasSection('fullscreen')
    {{-- Full-screen content --}}
    @yield('content')
  @else
    {{-- Main container --}}
<main class="max-w-4xl mx-auto px-4 py-8 ">
      @yield('content')
    </main>
  @endif

  {{-- Livewire scripts --}}
  @livewireScripts
</body>
</html>
