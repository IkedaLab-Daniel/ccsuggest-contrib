{{--resources/views/admin/dashboard.blade.php--}}
@extends('layouts.admin')

@section('title','Dashboard')

@section('content')
<div class="relative">
  <!-- Background Elements -->
  <div class="absolute inset-0 overflow-hidden pointer-events-none">
    <div class="absolute -top-40 -right-40 w-80 h-80 bg-gradient-to-br from-pink-200 to-red-200 rounded-full opacity-20 blur-3xl"></div>
    <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-gradient-to-tr from-red-100 to-pink-100 rounded-full opacity-20 blur-3xl"></div>
  </div>

  <!-- Welcome Header -->
  <div class="relative mb-12">
    <div class="bg-gradient-to-r from-[#e01d44] to-[#ff4466] rounded-2xl p-8 text-white shadow-2xl">
      <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
        <div class="mb-6 lg:mb-0">
          <h1 class="text-4xl lg:text-5xl font-bold mb-2">
            Welcome back, 
            <span class="bg-gradient-to-r from-white to-pink-100 bg-clip-text text-transparent">
              {{ Auth::user()->name }}
            </span>
          </h1>
          <p class="text-pink-100 text-lg">Ready to manage your platform today?</p>
        </div>
        <div class="flex items-center space-x-4">
          <div class="bg-white/20 backdrop-blur-sm rounded-xl p-4">
            <div class="text-2xl font-bold">{{ now()->format('H:i') }}</div>
            <div class="text-pink-100 text-sm">{{ now()->format('M d, Y') }}</div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Quick Stats -->
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
    <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl p-6 text-white shadow-xl transform hover:scale-105 transition-all duration-300">
      <div class="flex items-center justify-between">
        <div>
          <p class="text-blue-100 text-sm font-medium uppercase tracking-wider">Total Users</p>
          <p class="text-3xl font-bold">{{ \App\Models\User::count() }}</p>
        </div>
        <div class="bg-white/20 rounded-full p-3">
          <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <circle cx="12" cy="8" r="4" stroke="currentColor" stroke-width="2" fill="none"/>
            <path d="M4 20c0-4 8-4 8-4s8 0 8 4" stroke="currentColor" stroke-width="2" fill="none"/>
          </svg>
        </div>
      </div>
    </div>

    <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-2xl p-6 text-white shadow-xl transform hover:scale-105 transition-all duration-300">
      <div class="flex items-center justify-between">
        <div>
          <p class="text-green-100 text-sm font-medium uppercase tracking-wider">Questions</p>
          <p class="text-3xl font-bold">{{ \App\Models\Question::count() ?? 0 }}</p>
        </div>
        <div class="bg-white/20 rounded-full p-3">
          <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
          </svg>
        </div>
      </div>
    </div>

    <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl p-6 text-white shadow-xl transform hover:scale-105 transition-all duration-300">
      <div class="flex items-center justify-between">
        <div>
          <p class="text-purple-100 text-sm font-medium uppercase tracking-wider">Survey Responses</p>
          <p class="text-3xl font-bold">{{ \App\Models\UserSurveyResponse::count() ?? 0 }}</p>
        </div>
        <div class="bg-white/20 rounded-full p-3">
          <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
          </svg>
        </div>
      </div>
    </div>
  </div>

  <!-- Action Cards -->
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
    <!-- Users Card -->
    <a href="{{ route('admin.users.index') }}" class="group relative">
      <div class="absolute inset-0 bg-gradient-to-r from-blue-500 to-blue-600 rounded-2xl opacity-0 group-hover:opacity-10 transition-opacity duration-300"></div>
      <div class="lg:min-h-[330px] relative bg-white rounded-2xl p-8 shadow-xl border border-gray-100 group-hover:shadow-2xl group-hover:-translate-y-2 transition-all duration-300">
        <div class="flex items-center justify-between mb-6">
          <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl p-4 group-hover:scale-110 transition-transform duration-300">
            <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <circle cx="12" cy="8" r="4" stroke="currentColor" stroke-width="2" fill="none"/>
              <path d="M4 20c0-4 8-4 8-4s8 0 8 4" stroke="currentColor" stroke-width="2" fill="none"/>
            </svg>
          </div>
          <div class="bg-blue-50 rounded-full p-2 group-hover:bg-blue-100 transition-colors duration-300">
            <svg class="h-5 w-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
            </svg>
          </div>
        </div>
        <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-blue-600 transition-colors duration-300">
          Manage Users
        </h3>
        <p class="text-gray-600 leading-relaxed group-hover:text-gray-700 transition-colors duration-300">
          Create, edit, and delete student and admin accounts with full control over permissions.
        </p>
        <div class="mt-6 flex items-center text-blue-500 font-semibold group-hover:text-blue-600 transition-colors duration-300">
          <span>Get Started</span>
          <svg class="ml-2 h-4 w-4 group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
          </svg>
        </div>
      </div>
    </a>

    <!-- Questions Card -->
    <a href="{{ route('admin.questions.index') }}" class="group relative">
      <div class="absolute inset-0 bg-gradient-to-r from-green-500 to-green-600 rounded-2xl opacity-0 group-hover:opacity-10 transition-opacity duration-300"></div>
      <div class="lg:min-h-[330px] relative bg-white rounded-2xl p-8 shadow-xl border border-gray-100 group-hover:shadow-2xl group-hover:-translate-y-2 transition-all duration-300">
        <div class="flex items-center justify-between mb-6">
          <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-2xl p-4 group-hover:scale-110 transition-transform duration-300">
            <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
          </div>
          <div class="bg-green-50 rounded-full p-2 group-hover:bg-green-100 transition-colors duration-300">
            <svg class="h-5 w-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
            </svg>
          </div>
        </div>
        <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-green-600 transition-colors duration-300">
          Manage Questions
        </h3>
        <p class="text-gray-600 leading-relaxed group-hover:text-gray-700 transition-colors duration-300">
          Add, update, or remove questionnaire items and options to improve recommendation accuracy.
        </p>
        <div class="mt-6 flex items-center text-green-500 font-semibold group-hover:text-green-600 transition-colors duration-300">
          <span>Configure</span>
          <svg class="ml-2 h-4 w-4 group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
          </svg>
        </div>
      </div>
    </a>

    <!-- Survey Results Card -->
    <a href="{{ route('admin.surveys.index') }}" class="group relative">
      <div class="absolute inset-0 bg-gradient-to-r from-purple-500 to-purple-600 rounded-2xl opacity-0 group-hover:opacity-10 transition-opacity duration-300"></div>
      <div class="lg:min-h-[330px] relative bg-white rounded-2xl p-8 shadow-xl border border-gray-100 group-hover:shadow-2xl group-hover:-translate-y-2 transition-all duration-300">
        <div class="flex items-center justify-between mb-6">
          <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl p-4 group-hover:scale-110 transition-transform duration-300">
            <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
          </div>
          <div class="bg-purple-50 rounded-full p-2 group-hover:bg-purple-100 transition-colors duration-300">
            <svg class="h-5 w-5 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
            </svg>
          </div>
        </div>
        <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-purple-600 transition-colors duration-300">
          Survey Results
        </h3>
        <p class="text-gray-600 leading-relaxed group-hover:text-gray-700 transition-colors duration-300">
          View user feedback, satisfaction ratings, and analytics to improve the recommendation system.
        </p>
        <div class="mt-6 flex items-center text-purple-500 font-semibold group-hover:text-purple-600 transition-colors duration-300">
          <span>View Analytics</span>
          <svg class="ml-2 h-4 w-4 group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
          </svg>
        </div>
      </div>
    </a>

  <!-- System Retrain Card -->
   <div class="group relative" x-data="systemRetrain()">
      <div class="absolute inset-0 bg-gradient-to-r from-[#e01d44] to-[#ff4466] rounded-2xl opacity-0 group-hover:opacity-10 transition-opacity duration-300"></div>
      <div class="lg:min-h-[330px] relative bg-white rounded-2xl p-8 shadow-xl border border-gray-100 group-hover:shadow-2xl group-hover:-translate-y-2 transition-all duration-300">
        <div class="h-full flex flex-col">
          <div class="flex items-center justify-between mb-6">
            <div class="bg-gradient-to-br from-[#e01d44] to-[#ff4466] rounded-2xl p-4 group-hover:scale-110 transition-transform duration-300">
              <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
              </svg>
            </div>
            <div class="bg-pink-50 rounded-full p-2 group-hover:bg-pink-100 transition-colors duration-300">
              <div class="h-3 w-3 bg-[#e01d44] rounded-full animate-pulse"></div>
            </div>
          </div>
          <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-[#e01d44] transition-colors duration-300">
            Retrain Model
          </h3>
          <p class="text-gray-600 leading-relaxed group-hover:text-gray-700 transition-colors duration-300 flex-1">
            Rebuild the decision tree with the latest data to improve recommendation accuracy.
          </p>
          <button @click="submitRetrain" 
                  class="mt-6 w-full bg-gradient-to-r from-[#e01d44] to-[#ff4466] text-white font-semibold py-4 px-6 rounded-xl hover:from-[#c91841] hover:to-[#e91e63] transform hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-xl">
            <div class="flex items-center justify-center">
              <svg class="mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
              </svg>
              Retrain Now
            </div>
          </button>
        </div>
      </div>

      <!-- Modal -->
  <div x-show="showModal" 
       x-cloak
       class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 flex items-center justify-center p-4"
       @click="closeModal">
        <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full transform transition-all duration-300"
             @click.stop>
          
          <!-- Loading State -->
          <div x-show="isLoading" class="p-8 text-center">
            <div class="mb-6">
              <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-r from-[#e01d44] to-[#ff4466] rounded-full mb-4">
                <svg class="w-8 h-8 text-white animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                </svg>
              </div>
              <h3 class="text-2xl font-bold text-gray-900 mb-2">Retraining Model</h3>
              <p class="text-gray-600">Please wait while we rebuild the decision tree...</p>
            </div>
            <div class="flex justify-center">
              <div class="flex space-x-1">
                <div class="w-2 h-2 bg-[#e01d44] rounded-full animate-bounce" style="animation-delay: 0s;"></div>
                <div class="w-2 h-2 bg-[#e01d44] rounded-full animate-bounce" style="animation-delay: 0.1s;"></div>
                <div class="w-2 h-2 bg-[#e01d44] rounded-full animate-bounce" style="animation-delay: 0.2s;"></div>
              </div>
            </div>
          </div>

          <!-- Success/Error State -->
          <div x-show="!isLoading && result" class="p-8">
            <!-- Success -->
            <div x-show="result && result.status === 'success'" class="text-center">
              <div class="mb-6">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-green-100 rounded-full mb-4">
                  <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                  </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-2">Model Retrained Successfully!</h3>
                <!-- <p class="text-gray-600 mb-4" x-text="result?.message"></p> -->
                
                <!-- Duration Badge -->
                <div x-show="result?.duration" class="inline-flex items-center px-4 py-2 bg-green-50 border border-green-200 rounded-full">
                  <svg class="w-4 h-4 text-green-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                  </svg>
                  <span class="text-green-700 font-medium text-sm">
                    Completed in <span x-text="result?.duration"></span>s
                  </span>
                </div>
              </div>
            </div>

            <!-- Error -->
            <div x-show="result && result.status === 'error'" class="text-center">
              <div class="mb-6">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-red-100 rounded-full mb-4">
                  <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.732-.833-2.5 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                  </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-2">Retrain Failed</h3>
                <p class="text-gray-600 mb-4" x-text="result?.message"></p>
              </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-3 mt-8">
              <button @click="closeModal" 
                      class="flex-1 bg-gray-100 text-gray-700 py-3 px-6 rounded-xl font-semibold hover:bg-gray-200 transition-colors duration-200">
                Close
              </button>
              <button x-show="result && result.status === 'error'" 
                      @click="submitRetrain" 
                      class="flex-1 bg-gradient-to-r from-[#e01d44] to-[#ff4466] text-white py-3 px-6 rounded-xl font-semibold hover:from-[#c91841] hover:to-[#e91e63] transition-all duration-200">
                Try Again
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script>
      function systemRetrain() {
        return {
          showModal: false,
          isLoading: false,
          result: null,
          submitRetrain() {
            this.isLoading = true;
            this.showModal = true;
            this.result = null;
            fetch('{{ route("admin.system.retrain") }}', {
              method: 'POST',
              headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
              },
            })
            .then(async response => {
              let data;
              try {
                data = await response.json();
              } catch (e) {
                data = { status: 'error', message: 'Invalid response', duration: null };
              }
              this.result = data;
            })
            .catch(() => {
              this.result = { status: 'error', message: 'Failed to retrain model. Please try again.', duration: null };
            })
            .finally(() => {
              this.isLoading = false;
            });
          },
          closeModal() {
            this.showModal = false;
          }
        }
      }
    </script>
    <style>
      [x-cloak] { display: none !important; }
    </style>
    <!-- Analytics & Logs Card -->
    <!-- <a href="#" class="group relative">
      <div class="absolute inset-0 bg-gradient-to-r from-purple-500 to-purple-600 rounded-2xl opacity-0 group-hover:opacity-10 transition-opacity duration-300"></div>
      <div class="relative bg-white rounded-2xl p-8 shadow-xl border border-gray-100 group-hover:shadow-2xl group-hover:-translate-y-2 transition-all duration-300">
        <div class="flex items-center justify-between mb-6">
          <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl p-4 group-hover:scale-110 transition-transform duration-300">
            <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
            </svg>
          </div>
          <div class="bg-purple-50 rounded-full p-2 group-hover:bg-purple-100 transition-colors duration-300">
            <svg class="h-5 w-5 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
            </svg>
          </div>
        </div>
        <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-purple-600 transition-colors duration-300">
          Analytics & Logs
        </h3>
        <p class="text-gray-600 leading-relaxed group-hover:text-gray-700 transition-colors duration-300">
          View comprehensive usage statistics, user activity logs, and system performance metrics.
        </p>
        <div class="mt-6 flex items-center text-purple-500 font-semibold group-hover:text-purple-600 transition-colors duration-300">
          <span>View Reports</span>
          <svg class="ml-2 h-4 w-4 group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
          </svg>
        </div>
      </div>
    </a> -->
  </div>

  <!-- Recent Activity Section -->
  <!-- <div class="mt-16">
    <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
      <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-8 py-6 border-b border-gray-200">
        <h2 class="text-2xl font-bold text-gray-900">Recent Activity</h2>
        <p class="text-gray-600 mt-1">Latest system events and user interactions</p>
      </div>
      <div class="p-8">
        <div class="space-y-6">
          <div class="flex items-center space-x-4">
            <div class="bg-blue-100 rounded-full p-2">
              <svg class="h-5 w-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
              </svg>
            </div>
            <div class="flex-1">
              <p class="text-gray-900 font-medium">New user registered</p>
              <p class="text-gray-500 text-sm">2 minutes ago</p>
            </div>
          </div>
          <div class="flex items-center space-x-4">
            <div class="bg-green-100 rounded-full p-2">
              <svg class="h-5 w-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
              </svg>
            </div>
            <div class="flex-1">
              <p class="text-gray-900 font-medium">Questionnaire completed</p>
              <p class="text-gray-500 text-sm">15 minutes ago</p>
            </div>
          </div>
          <div class="flex items-center space-x-4">
            <div class="bg-purple-100 rounded-full p-2">
              <svg class="h-5 w-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
              </svg>
            </div>
            <div class="flex-1">
              <p class="text-gray-900 font-medium">Question bank updated</p>
              <p class="text-gray-500 text-sm">1 hour ago</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div> -->
</div>
@endsection