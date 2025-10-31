@extends('layouts.app')

@section('content')
    {{-- Full-viewport gradient background --}}
    <div class="fixed inset-0 w-screen h-screen bg-gradient-to-br from-red-50 via-rose-50 to-pink-50 -z-10">
        <div class="absolute top-20 left-20 w-72 h-72 bg-red-200 rounded-full mix-blend-multiply filter blur-xl opacity-30 animate-pulse"></div>
        <div class="absolute top-40 right-20 w-96 h-96 bg-rose-200 rounded-full mix-blend-multiply filter blur-xl opacity-30 animate-pulse delay-1000"></div>
        <div class="absolute -bottom-32 left-40 w-80 h-80 bg-pink-200 rounded-full mix-blend-multiply filter blur-xl opacity-30 animate-pulse delay-2000"></div>
    </div>

<div x-data="resetForm()" class="relative z-10 min-h-[80vh] flex items-center justify-center px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <!-- Header -->
        <div class="text-center">
            <div class="mx-auto h-16 w-16 bg-gradient-to-r from-red-500 to-pink-600 rounded-full flex items-center justify-center shadow-lg" style="background: linear-gradient(135deg, #e01e45, #c91a40);">
                <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m0 0a2 2 0 012 2m-2-2v6m0 0V9a2 2 0 00-2-2M9 7a2 2 0 00-2 2v6a2 2 0 002 2h6a2 2 0 002-2V9a2 2 0 00-2-2"></path>
                </svg>
            </div>
            <h2 class="mt-6 text-3xl font-bold text-gray-900">{{ __('Reset Password') }}</h2>
            <p class="mt-2 text-sm text-gray-600">Create a new password for your account</p>
        </div>

        <!-- Form Card -->
        <div class="bg-white/80 backdrop-blur-sm shadow-xl rounded-2xl border border-gray-100 p-8 space-y-6">
            <form method="POST" action="{{ route('password.update') }}" class="space-y-6" @submit.prevent="submitForm" x-ref="form">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">

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
                               value="{{ $email ?? old('email') }}" 
                               required 
                               autocomplete="email" 
                               autofocus
                               class="block w-full pl-10 pr-3 py-3 border @error('email') border-red-300 @else border-gray-300 @enderror rounded-xl shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:border-red-500 transition-all duration-200 bg-gray-50 focus:bg-white"
                               style="--tw-ring-color: #e01e45;"
                               onfocus="this.style.borderColor='#e01e45'; this.style.boxShadow='0 0 0 2px rgba(224, 30, 69, 0.2)';"
                               placeholder="Enter your email address">
                    </div>
                    @error('email')
                        <p class="text-sm text-red-600 flex items-center">
                            <svg class="h-4 w-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                        </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Password Field -->
                <div class="space-y-2">
                    <label for="password" class="block text-sm font-semibold text-gray-700">
                        {{ __('New Password') }}
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                        </div>
                        <input id="password" 
                               type="password" 
                               name="password" 
                               required 
                               autocomplete="new-password"
                               x-model="password"
                               @input="validatePassword()"
                               class="block w-full pl-10 pr-3 py-3 border rounded-xl shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:border-red-500 transition-all duration-200 bg-gray-50 focus:bg-white"
                               :class="passwordErrors.length > 0 ? 'border-red-400' : 'border-gray-300'"
                               style="--tw-ring-color: #e01e45;"
                               onfocus="this.style.borderColor='#e01e45'; this.style.boxShadow='0 0 0 2px rgba(224, 30, 69, 0.2)';"
                               placeholder="Enter new password">
                    </div>
                    <!-- Password Requirements -->
                    <div class="mt-3 space-y-2">
                      <div class="flex items-center text-xs" :class="passwordChecks.length ? 'text-green-600' : 'text-red-600'">
                        <svg class="w-3 h-3 mr-1" :class="passwordChecks.length ? 'text-green-600' : 'text-red-600'" fill="currentColor" viewBox="0 0 20 20">
                          <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" x-show="passwordChecks.length"></path>
                          <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" x-show="!passwordChecks.length"></path>
                        </svg>
                        <span>At least 8 characters</span>
                      </div>
                      <div class="flex items-center text-xs" :class="passwordChecks.uppercase ? 'text-green-600' : 'text-red-600'">
                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                          <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" x-show="passwordChecks.uppercase"></path>
                          <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" x-show="!passwordChecks.uppercase"></path>
                        </svg>
                        <span>One uppercase letter</span>
                      </div>
                      <div class="flex items-center text-xs" :class="passwordChecks.lowercase ? 'text-green-600' : 'text-red-600'">
                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                          <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" x-show="passwordChecks.lowercase"></path>
                          <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" x-show="!passwordChecks.lowercase"></path>
                        </svg>
                        <span>One lowercase letter</span>
                      </div>
                      <div class="flex items-center text-xs" :class="passwordChecks.number ? 'text-green-600' : 'text-red-600'">
                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                          <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" x-show="passwordChecks.number"></path>
                          <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" x-show="!passwordChecks.number"></path>
                        </svg>
                        <span>One number</span>
                      </div>
                      <div class="flex items-center text-xs" :class="passwordChecks.special ? 'text-green-600' : 'text-red-600'">
                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                          <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" x-show="passwordChecks.special"></path>
                          <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" x-show="!passwordChecks.special"></path>
                        </svg>
                        <span>One special character</span>
                      </div>
                    </div>
                    <!-- Client-side validation errors -->
                    <template x-for="error in passwordErrors" :key="error">
                      <div class="flex items-center mt-2 text-red-600 text-sm animate-slide-down">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                          <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                        </svg>
                        <span x-text="error"></span>
                      </div>
                    </template>
                </div>

                <!-- Confirm Password Field -->
                <div class="space-y-2">
                    <label for="password-confirm" class="block text-sm font-semibold text-gray-700">
                        {{ __('Confirm New Password') }}
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <input id="password-confirm" 
                               type="password" 
                               name="password_confirmation" 
                               required 
                               autocomplete="new-password"
                               x-model="passwordConfirmation"
                               @input="validatePasswordConfirmation()"
                               class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-xl shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:border-red-500 transition-all duration-200 bg-gray-50 focus:bg-white"
                               :class="passwordConfirmationError ? 'border-red-400' : ''"
                               style="--tw-ring-color: #e01e45;"
                               onfocus="this.style.borderColor='#e01e45'; this.style.boxShadow='0 0 0 2px rgba(224, 30, 69, 0.2)';"
                               placeholder="Confirm new password">
                    </div>
                    <div x-show="passwordConfirmationError" class="flex items-center mt-2 text-red-600 text-sm animate-slide-down">
                      <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                      </svg>
                      <span x-text="passwordConfirmationError"></span>
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit"
                        :disabled="!isFormValid"
                        class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-semibold rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-offset-2 transform transition-all duration-200 hover:scale-105 shadow-lg hover:shadow-xl disabled:opacity-50 disabled:cursor-not-allowed"
                        style="background: linear-gradient(135deg, #e01e45, #c91a40); --tw-ring-color: #e01e45;"
                        :class="isFormValid ? '' : 'opacity-50 cursor-not-allowed'"
                        onmouseover="this.style.background='linear-gradient(135deg, #c91a40, #b01838)';"
                        onmouseout="this.style.background='linear-gradient(135deg, #e01e45, #c91a40)';"
                        onfocus="this.style.boxShadow='0 0 0 2px rgba(224, 30, 69, 0.5)';">
                    <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                        <svg class="h-5 w-5 text-red-200 group-hover:text-red-100 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m0 0a2 2 0 012 2m-2-2v6m0 0V9a2 2 0 00-2-2M9 7a2 2 0 00-2 2v6a2 2 0 002 2h6a2 2 0 002-2V9a2 2 0 00-2-2"></path>
                        </svg>
                    </span>
                    {{ __('Reset Password') }}
                </button>
            </form>

            <!-- Additional Links -->
            <div class="text-center pt-4 border-t border-gray-100">
                <p class="text-sm text-gray-600">
                    Remember your password? 
                    <a href="{{ route('login') }}" class="font-medium transition-colors" style="color: #e01e45;" onmouseover="this.style.color='#c91a40';" onmouseout="this.style.color='#e01e45';">
                        Sign in here
                    </a>
                </p>
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
        <p class="text-lg font-semibold">Resetting password...</p>
      </div>
    </div>
</div>
@endsection

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
  Alpine.data('resetForm', () => ({
    loading: false,
    password: '',
    passwordConfirmation: '',
    passwordErrors: [],
    passwordConfirmationError: '',
    passwordChecks: {
      length: false,
      uppercase: false,
      lowercase: false,
      number: false,
      special: false
    },
    get isFormValid() {
      return this.passwordErrors.length === 0 && 
             !this.passwordConfirmationError && 
             this.password.length > 0 &&
             this.passwordConfirmation.length > 0 &&
             Object.values(this.passwordChecks).every(check => check);
    },
    validatePassword() {
      this.passwordErrors = [];
      this.passwordChecks.length = this.password.length >= 8;
      this.passwordChecks.uppercase = /[A-Z]/.test(this.password);
      this.passwordChecks.lowercase = /[a-z]/.test(this.password);
      this.passwordChecks.number = /\d/.test(this.password);
      this.passwordChecks.special = /[!@#$%^&*()_+\-=\[\]{}|;':".,\/<>?~`]/.test(this.password);
      if (this.passwordConfirmation) {
        this.validatePasswordConfirmation();
      }
    },
    validatePasswordConfirmation() {
      if (this.password !== this.passwordConfirmation) {
        this.passwordConfirmationError = 'Passwords do not match';
      } else {
        this.passwordConfirmationError = '';
      }
    },
    submitForm() {
      this.validatePassword();
      this.validatePasswordConfirmation();
      if (this.isFormValid) {
        this.loading = true;
        this.$refs.form.submit();
      }
    }
  }))
})
</script>