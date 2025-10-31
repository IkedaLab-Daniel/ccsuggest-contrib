<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <link rel="icon" type="image/png" href="{{ asset('images/fav.png') }}">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>CCSuggest – @yield('title','Dashboard')</title>

  <!-- Tailwind via CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/alpinejs" defer></script>
</head>
<body class="bg-gray-100 text-gray-800 font-sans">

  {{-- Navbar --}}
  <nav class="bg-white shadow relative z-50" x-data="{ mobileNavOpen: false }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center h-16">
      <div class="flex items-center">
        <a href="{{ route('admin.dashboard') }}" class="flex-shrink-0 flex items-center text-xl font-bold">
          Admin Panel
        </a>
      </div>
      <!-- Hamburger button for mobile -->
      <button @click="mobileNavOpen = !mobileNavOpen" class="lg:hidden block ml-2 p-2 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500" aria-label="Open navigation">
        <svg class="h-7 w-7 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
      </button>
      <!-- Desktop nav -->
      <div class="hidden lg:flex items-center space-x-4">
        <a href="{{ route('admin.dashboard') }}"
           class="px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-200 flex items-center {{ request()->routeIs('admin.dashboard') ? 'bg-gray-200' : '' }}">
          Dashboard
        </a>
        <a href="{{ route('admin.users.index') }}"
           class="px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-200 flex items-center {{ request()->routeIs('admin.users.*') ? 'bg-gray-200' : '' }}">
          Users
        </a>
        <a href="{{ route('admin.questions.index') }}"
           class="px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-200 flex items-center {{ request()->routeIs('admin.questions.*') ? 'bg-gray-200' : '' }}">
          Questions
        </a>
        <a href="{{ route('admin.surveys.index') }}"
           class="px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-200 flex items-center {{ request()->routeIs('admin.surveys.*') ? 'bg-gray-200' : '' }}">
          Surveys
        </a>
        <a href="{{ route('admin.system.dashboard') }}"
           class="px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-200 flex items-center {{ request()->routeIs('admin.system.*') ? 'bg-gray-200' : '' }}">
          System
        </a>
        <span class="ml-4">{{ Auth::user()->name }}</span>
        <form method="POST" action="{{ route('logout') }}" class="inline" id="logoutFormAdmin">
          @csrf
          <button type="submit"
                  class="px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-200">
            Logout
          </button>
        </form>
      </div>
      <!-- Mobile nav -->
      <div x-show="mobileNavOpen" x-cloak class="fixed inset-0 bg-black/40 z-50 lg:hidden">
        <div class="absolute right-0 top-0 bg-white w-64 h-full shadow-xl p-6 flex flex-col space-y-4">
          <button @click="mobileNavOpen = false" class="self-end mb-4 p-2 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500" aria-label="Close navigation">
            <svg class="h-6 w-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
          <a href="{{ route('admin.dashboard') }}"
             class="block px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-200 flex items-center {{ request()->routeIs('admin.dashboard') ? 'bg-gray-200' : '' }}">
            Dashboard
          </a>
          <a href="{{ route('admin.users.index') }}"
             class="block px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-200 flex items-center {{ request()->routeIs('admin.users.*') ? 'bg-gray-200' : '' }}">
            Users
          </a>
          <a href="{{ route('admin.questions.index') }}"
             class="block px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-200 flex items-center {{ request()->routeIs('admin.questions.*') ? 'bg-gray-200' : '' }}">
            Questions
          </a>
          <a href="{{ route('admin.surveys.index') }}"
             class="block px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-200 flex items-center {{ request()->routeIs('admin.surveys.*') ? 'bg-gray-200' : '' }}">
            Surveys
          </a>
          <a href="{{ route('admin.system.dashboard') }}"
             class="block px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-200 flex items-center {{ request()->routeIs('admin.system.*') ? 'bg-gray-200' : '' }}">
            System
          </a>
          <span class="text-gray-700 text-sm mt-4">{{ Auth::user()->name }}</span>
          <form method="POST" action="{{ route('logout') }}" class="inline mt-2" id="logoutFormAdminMobile">
            @csrf
            <button type="submit"
                    class="block w-full px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-200">
              Logout
            </button>
          </form>
        </div>
        <div class="flex-1" @click="mobileNavOpen = false"></div>
      </div>
    </div>
    <style>
      [x-cloak] { display: none; }
    </style>
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        var logoutFormAdmin = document.getElementById('logoutFormAdmin');
        if (logoutFormAdmin) {
          logoutFormAdmin.addEventListener('submit', function() {
            // Optionally add a loader/modal here
          });
        }
        var logoutFormAdminMobile = document.getElementById('logoutFormAdminMobile');
        if (logoutFormAdminMobile) {
          logoutFormAdminMobile.addEventListener('submit', function() {
            // Optionally add a loader/modal here
          });
        }
      });
    </script>
  </nav>

  {{-- Main Content --}}
  <main class="py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      @yield('content')
    </div>
  </main>

</body>
</html>
