@extends('layouts.app')

@section('content')
    {{-- Full-viewport gradient background --}}
    <!-- Loader Modal -->
    <div id="loader-modal" class="fixed inset-0 z-50 flex items-center justify-center bg-white/80 backdrop-blur-sm transition-opacity duration-300 hidden">
        <div class="flex flex-col items-center">
            <div class="animate-spin rounded-full h-16 w-16 border-t-4 border-red-500 border-b-4 border-pink-400 mb-6"></div>
            <p class="text-lg font-semibold text-red-600">Sending reset link...</p>
        </div>
    </div>
    <div class="fixed inset-0 w-screen h-screen bg-gradient-to-br from-red-50 via-rose-50 to-pink-50 -z-10">
        <div class="absolute top-20 left-20 w-72 h-72 bg-red-200 rounded-full mix-blend-multiply filter blur-xl opacity-30 animate-pulse"></div>
        <div class="absolute top-40 right-20 w-96 h-96 bg-rose-200 rounded-full mix-blend-multiply filter blur-xl opacity-30 animate-pulse delay-1000"></div>
        <div class="absolute -bottom-32 left-40 w-80 h-80 bg-pink-200 rounded-full mix-blend-multiply filter blur-xl opacity-30 animate-pulse delay-2000"></div>
    </div>

    <div x-data="{ loading: false }" class="relative z-10 min-h-[80vh] flex items-center justify-center px-1">
    <div class="max-w-md w-full space-y-8">
        <!-- Header -->
        <div class="text-center">
            <div class="mx-auto h-16 w-16 bg-gradient-to-r from-red-500 to-pink-600 rounded-full flex items-center justify-center shadow-lg animate-pulse" style="background: linear-gradient(135deg, #e01e45, #c91a40);">
                <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                </svg>
            </div>
            <h2 class="mt-6 text-3xl font-bold text-gray-900">{{ __('Reset Password') }}</h2>
            <p class="mt-2 text-sm text-gray-600">Enter your email address and we'll send you a password reset link</p>
        </div>

        <!-- Success Message -->
        @if (session('status'))
            <div class="bg-green-50 border-l-4 border-green-400 p-4 rounded-r-lg shadow-sm animate-fade-in">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-green-700 font-medium">
                            {{ session('status') }}
                        </p>
                    </div>
                </div>
            </div>
        @endif

        <!-- Form Card -->
        <div class="bg-white/80 backdrop-blur-sm shadow-xl rounded-2xl border border-gray-100 p-8 space-y-6">
            <form method="POST" action="{{ route('password.email') }}" class="space-y-6" @submit="loading = true">
                @csrf

                <!-- Email Field -->
                <div class="space-y-2">
                    <label for="email" class="block text-sm font-semibold text-gray-700">
                        {{ __('Email Address') }}
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                            </svg>
                        </div>
                        <input id="email" 
                               type="email" 
                               name="email" 
                               value="{{ old('email') }}" 
                               required 
                               autocomplete="email" 
                               autofocus
                               class="block w-full pl-10 pr-3 py-4 border @error('email') border-red-300 ring-2 ring-red-200 @else border-gray-300 @enderror rounded-xl shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:border-red-500 transition-all duration-200 bg-gray-50 focus:bg-white text-sm"
                               style="--tw-ring-color: #e01e45; --tw-border-opacity: 1; border-color: @error('email') rgb(252 165 165) @else rgb(209 213 219) @enderror;"
                               onfocus="this.style.borderColor='#e01e45'; this.style.boxShadow='0 0 0 2px rgba(224, 30, 69, 0.2)';"
                               placeholder="Enter your email address">
                    </div>
                    @error('email')
                        <div class="bg-red-50 border-l-4 border-red-400 p-3 rounded-r-lg">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-4 w-4 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <div class="ml-2">
                                    <p class="text-sm text-red-700">{{ $message }}</p>
                                </div>
                            </div>
                        </div>
                    @enderror
                </div>

                <!-- Submit Button -->
                <button type="submit" 
                        class="group relative w-full flex justify-center py-4 px-4 border border-transparent text-sm font-semibold rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-offset-2 transform transition-all duration-200 hover:scale-[1.02] shadow-lg hover:shadow-xl disabled:opacity-50 disabled:cursor-not-allowed"
                        style="background: linear-gradient(135deg, #e01e45, #c91a40); --tw-ring-color: #e01e45;"
                        onmouseover="this.style.background='linear-gradient(135deg, #c91a40, #b01838)';"
                        onmouseout="this.style.background='linear-gradient(135deg, #e01e45, #c91a40)';"
                        onfocus="this.style.boxShadow='0 0 0 2px rgba(224, 30, 69, 0.5)';">
                    <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                        <svg class="h-5 w-5 text-red-200 group-hover:text-red-100 transition-colors group-disabled:text-red-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                        </svg>
                    </span>
                    {{ __('Send Password Reset Link') }}
                </button>

                <!-- Helper Text -->
                <div class="border rounded-lg p-4" style="background-color: rgba(224, 30, 69, 0.05); border-color: rgba(224, 30, 69, 0.2);">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5" style="color: #e01e45;" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium" style="color: #c91a40;">What happens next?</h3>
                            <div class="mt-1 text-sm" style="color: #e01e45;">
                                <p>We'll email you a secure link to reset your password. The link expires in 60 minutes for security.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <!-- Additional Links -->
            <div class="text-center pt-4 border-t border-gray-100">
                <div class="space-y-2">
                    <p class="text-sm text-gray-600">
                        Remember your password? 
                        <a href="{{ route('login') }}" class="font-medium transition-colors" style="color: #e01e45;" onmouseover="this.style.color='#c91a40';" onmouseout="this.style.color='#e01e45';">
                            Sign in here
                        </a>
                    </p>
                    <p class="text-sm text-gray-600">
                        Don't have an account? 
                        <a href="{{ route('register') }}" class="font-medium transition-colors" style="color: #e01e45;" onmouseover="this.style.color='#c91a40';" onmouseout="this.style.color='#e01e45';">
                            Create one now
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <!-- Loading Modal -->
    <div x-show="loading" x-cloak style="background: rgba(0,0,0,0.5);" class="fixed inset-0 flex items-center justify-center z-50">
      <div class="bg-white p-8 rounded shadow text-center">
        <svg class="animate-spin h-8 w-8 mx-auto mb-4 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
          <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
          <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path>
        </svg>
        <p class="text-lg font-semibold">Sending reset link...</p>
      </div>
    </div>
</div>

<style>
@keyframes fade-in {
    from { opacity: 0; transform: translateY(-10px); }
    to { opacity: 1; transform: translateY(0); }
}
.animate-fade-in {
    animation: fade-in 0.5s ease-out;
}
.hidden { display: none !important; }
</style>

<script>
function showLoaderModal() {
    document.getElementById('loader-modal').classList.remove('hidden');
}
</script>
</style>
@endsection