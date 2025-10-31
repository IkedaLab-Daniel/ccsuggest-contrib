{{-- resources/views/auth/register.blade.php --}}
@extends('layouts.app')

@section('hide-nav')@endsection
@section('fullscreen')@endsection

@section('content')
  <div class="fixed inset-0 w-screen h-screen bg-gradient-to-br from-red-50 via-rose-50 to-pink-50 -z-10">
    <div class="absolute top-20 left-20 w-72 h-72 bg-red-200 rounded-full mix-blend-multiply filter blur-xl opacity-30 animate-pulse"></div>
    <div class="absolute top-40 right-20 w-96 h-96 bg-rose-200 rounded-full mix-blend-multiply filter blur-xl opacity-30 animate-pulse delay-1000"></div>
    <div class="absolute -bottom-32 left-40 w-80 h-80 bg-pink-200 rounded-full mix-blend-multiply filter blur-xl opacity-30 animate-pulse delay-2000"></div>
  </div>

  <div class="relative z-10 min-h-screen flex overflow-hidden lg:space-x-16">
    <div class="hidden lg:flex w-1/2 items-center justify-center p-35">
      <div class="relative z-10 max-w-md">
        <div class="bg-white/20 backdrop-blur-sm rounded-3xl p-8 shadow-2xl border border-white/30">
          <img src="{{ asset('images/login-illustration.jpg') }}"
               alt="Illustration" class="w-full h-80 object-cover rounded-2xl shadow-lg">
          <div class="mt-6 text-center">
            <h3 class="text-2xl font-bold text-red-900 mb-2">Join the Community</h3>
            <p class="text-red-700">Create your account to start your tech journey</p>
          </div>
        </div>
      </div>
    </div>

    <div class="w-full lg:w-1/2 flex flex-col justify-center px-8 py-12" x-data="registerForm()">
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
          <p class="text-lg font-semibold">Creating your account...</p>
        </div>
      </div>
      <div class="max-w-md mx-auto w-full">
        <div class="mb-8 text-center lg:text-left">
          <a href="/" class="inline-block mb-6 transform hover:scale-105 transition-transform duration-300">
            <div class="rounded-2xl ">
              <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-30 rounded-md">
            </div>
          </a>
          <h1 class="text-4xl font-bold bg-gradient-to-r from-red-600 to-rose-600 bg-clip-text text-transparent mb-2">
            Create Account
          </h1>
          <p class="text-red-700/80">Sign up to discover your perfect tech field</p>
        </div>

  <form method="POST" action="{{ route('register') }}" class="space-y-6" @submit.prevent="submitForm" x-ref="form">
          @csrf
            <div class="group">
              <label for="name" class="block mb-2 text-red-900 font-medium text-sm uppercase tracking-wide">
                Name
              </label>
              <div class="relative">
                <input id="name" name="name" type="text" required autofocus
                       class="w-full px-4 py-4 bg-white/80 backdrop-blur-sm border-2 border-red-200 rounded-xl 
                              focus:outline-none focus:border-red-500 focus:ring-4 focus:ring-red-500/20 
                              transition-all duration-300 placeholder-red-400/60 text-red-900
                              group-hover:border-red-300"
                       placeholder="Enter your name" value="{{ old('name') }}">
                <div class="absolute inset-0 bg-gradient-to-r from-red-500/5 to-rose-500/5 rounded-xl opacity-0 
                            group-hover:opacity-100 transition-opacity duration-300 pointer-events-none"></div>
              </div>
              @error('name')
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
          <div class="group">
            <label for="email" class="block mb-2 text-red-900 font-medium text-sm uppercase tracking-wide">
              Email Address
            </label>
            <div class="relative">
              <input id="email" name="email" type="email" required
                     class="w-full px-4 py-4 bg-white/80 backdrop-blur-sm border-2 border-red-200 rounded-xl 
                            focus:outline-none focus:border-red-500 focus:ring-4 focus:ring-red-500/20 
                            transition-all duration-300 placeholder-red-400/60 text-red-900
                            group-hover:border-red-300"
                     placeholder="Enter your email" value="{{ old('email') }}">
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

          <div class="group">
            <label for="password" class="block mb-2 text-red-900 font-medium text-sm uppercase tracking-wide">
              Password
            </label>
            <div class="relative">
              <input id="password" name="password" type="password" required
                     x-model="password"
                     @input="validatePassword()"
                     minlength="8"
                     class="w-full px-4 py-4 bg-white/80 backdrop-blur-sm border-2 border-red-200 rounded-xl 
                            focus:outline-none focus:border-red-500 focus:ring-4 focus:ring-red-500/20 
                            transition-all duration-300 placeholder-red-400/60 text-red-900
                            group-hover:border-red-300"
                     :class="passwordErrors.length > 0 ? 'border-red-400' : ''"
                     placeholder="Enter your password">
              <div class="absolute inset-0 bg-gradient-to-r from-red-500/5 to-rose-500/5 rounded-xl opacity-0 
                          group-hover:opacity-100 transition-opacity duration-300 pointer-events-none"></div>
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
            
            <!-- @error('password')
              <div class="flex items-center mt-2 text-red-600 text-sm animate-slide-down">
                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd"
                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                        clip-rule="evenodd"></path>
                </svg>
                {{ $message }}
              </div>
            @enderror -->
            
            <!-- Client-side validation errors -->
            <template x-for="error in passwordErrors" :key="error">
              <div class="flex items-center mt-2 text-red-600 text-sm animate-slide-down">
                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd"
                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                        clip-rule="evenodd"></path>
                </svg>
                <span x-text="error"></span>
              </div>
            </template>
          </div>

          <div class="group">
            <label for="password_confirmation" class="block mb-2 text-red-900 font-medium text-sm uppercase tracking-wide">
              Confirm Password
            </label>
            <div class="relative">
              <input id="password_confirmation" name="password_confirmation" type="password" required
                     x-model="passwordConfirmation"
                     @input="validatePasswordConfirmation()"
                     class="w-full px-4 py-4 bg-white/80 backdrop-blur-sm border-2 border-red-200 rounded-xl 
                            focus:outline-none focus:border-red-500 focus:ring-4 focus:ring-red-500/20 
                            transition-all duration-300 placeholder-red-400/60 text-red-900
                            group-hover:border-red-300"
                     :class="passwordConfirmationError ? 'border-red-400' : ''"
                     placeholder="Confirm your password">
              <div class="absolute inset-0 bg-gradient-to-r from-red-500/5 to-rose-500/5 rounded-xl opacity-0 
                          group-hover:opacity-100 transition-opacity duration-300 pointer-events-none"></div>
            </div>
            
            <div x-show="passwordConfirmationError" class="flex items-center mt-2 text-red-600 text-sm animate-slide-down">
              <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                      d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                      clip-rule="evenodd"></path>
              </svg>
              <span x-text="passwordConfirmationError"></span>
            </div>
            
            @error('password_confirmation')
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
                  :disabled="!isFormValid"
                  class="w-full py-4 px-6 bg-gradient-to-r from-red-600 to-rose-600 text-white font-semibold rounded-xl
                         hover:from-red-700 hover:to-rose-700 focus:outline-none focus:ring-4 focus:ring-red-500/30
                         transform hover:scale-[1.02] active:scale-[0.98] transition-all duration-200
                         shadow-lg hover:shadow-xl relative overflow-hidden group
                         disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none"
                  :class="isFormValid ? '' : 'opacity-50 cursor-not-allowed'">
            <span class="relative z-10">Sign Up</span>
            <div class="absolute inset-0 bg-gradient-to-r from-red-700 to-rose-700 opacity-0 group-hover:opacity-100 transition-opacity duration-300"
                 x-show="isFormValid"></div>
          </button>

          <div class="text-center pt-4">
            <p class="text-red-700">
              Already have an account?
              <a href="{{ route('login') }}" class="text-red-600 font-semibold hover:text-red-800 hover:underline transition-all duration-200">
                Sign in
              </a>
            </p>
          </div>
        </form>
      </div>
    </div>
  </div>

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
      Alpine.data('registerForm', () => ({
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
          
          // Check length
          this.passwordChecks.length = this.password.length >= 8;
          
          // Check for uppercase letter
          this.passwordChecks.uppercase = /[A-Z]/.test(this.password);
          
          // Check for lowercase letter
          this.passwordChecks.lowercase = /[a-z]/.test(this.password);
          
          // Check for number
          this.passwordChecks.number = /\d/.test(this.password);
          
          // Check for special character
          this.passwordChecks.special = /[!@#$%^&*()_+\-=\[\]{}|;':".,/<>?~`]/.test(this.password);
          
          // Add errors for failed checks
          // if (!this.passwordChecks.length) {
          //   this.passwordErrors.push('Password must be at least 8 characters long');
          // }
          // if (!this.passwordChecks.uppercase) {
          //   this.passwordErrors.push('Password must contain at least one uppercase letter');
          // }
          // if (!this.passwordChecks.lowercase) {
          //   this.passwordErrors.push('Password must contain at least one lowercase letter');
          // }
          // if (!this.passwordChecks.number) {
          //   this.passwordErrors.push('Password must contain at least one number');
          // }
          // if (!this.passwordChecks.special) {
          //   this.passwordErrors.push('Password must contain at least one special character');
          // }
          
          // Revalidate confirmation if it exists
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
          // Final validation before submit
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
@endsection