@extends('layouts.admin')

@section('title','Edit User')

@section('content')
  <h1 class="text-2xl font-semibold mb-6">Edit User</h1>

  <div x-data="userEditForm()">
    <!-- Loader Modal -->
    <div x-show="loading" style="background: rgba(0,0,0,0.5);" class="fixed inset-0 flex items-center justify-center z-50">
      <div class="bg-white p-8 rounded shadow text-center">
        <svg class="animate-spin h-8 w-8 mx-auto mb-4 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
          <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
          <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path>
        </svg>
        <p class="text-lg font-semibold">Processing...</p>
      </div>
    </div>
  <form action="{{ route('admin.users.update', $user) }}" method="POST"
      class="bg-white p-6 rounded-lg shadow space-y-4"
      @submit.prevent="submitForm" x-ref="form">
    @csrf @method('PUT')

    <div>
      <label class="block mb-1 font-medium">Name</label>
      <input type="text" name="name" value="{{ old('name', $user->name) }}" required
             class="w-full border px-3 py-2 rounded @error('name') border-red-500 @enderror">
      @error('name') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
    </div>

    <div>
      <label class="block mb-1 font-medium">Email</label>
      <input type="email" name="email" value="{{ old('email', $user->email) }}" required
             class="w-full border px-3 py-2 rounded @error('email') border-red-500 @enderror">
      @error('email') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
    </div>

    <div>
      <label class="block mb-1 font-medium">Password (leave blank to keep current)</label>
      <input type="password" name="password"
             x-model="password"
             @input="validatePassword()"
             minlength="8"
             class="w-full border px-3 py-2 rounded @error('password') border-red-500 @enderror"
             :class="passwordErrors.length > 0 ? 'border-red-400' : ''">
      @error('password') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
      <!-- Password Requirements (only show if password is filled) -->
      <div class="mt-3 space-y-2" x-show="password.length">
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
      <!-- <template x-for="error in passwordErrors" :key="error">
        <div class="flex items-center mt-2 text-red-600 text-sm">
          <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd"
                  d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                  clip-rule="evenodd"></path>
          </svg>
          <span x-text="error"></span>
        </div>
      </template> -->
    </div>

    <div>
      <label class="block mb-1 font-medium">Confirm Password</label>
      <input type="password" name="password_confirmation"
             x-model="passwordConfirmation"
             @input="validatePasswordConfirmation()"
             class="w-full border px-3 py-2 rounded"
             :class="passwordConfirmationError ? 'border-red-400' : ''">
      <div x-show="passwordConfirmationError" class="flex items-center mt-2 text-red-600 text-sm">
        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd"
                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                clip-rule="evenodd"></path>
        </svg>
        <span x-text="passwordConfirmationError"></span>
      </div>
    </div>

  <button type="submit"
      :disabled="password.length > 0 && (!isFormValid)"
      class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700"
      :class="password.length > 0 && (!isFormValid) ? 'opacity-50 cursor-not-allowed' : ''">
    Update User
  </button>
    </form>
  </div>
<script>
  document.addEventListener('alpine:init', () => {
    Alpine.data('userEditForm', () => ({
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
        if (!this.passwordChecks.length) {
          this.passwordErrors.push('Password must be at least 8 characters long');
        }
        if (!this.passwordChecks.uppercase) {
          this.passwordErrors.push('Password must contain at least one uppercase letter');
        }
        if (!this.passwordChecks.lowercase) {
          this.passwordErrors.push('Password must contain at least one lowercase letter');
        }
        if (!this.passwordChecks.number) {
          this.passwordErrors.push('Password must contain at least one number');
        }
        if (!this.passwordChecks.special) {
          this.passwordErrors.push('Password must contain at least one special character');
        }
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
        if (this.password.length > 0) {
          this.validatePassword();
          this.validatePasswordConfirmation();
          if (!this.isFormValid) return;
        }
        this.loading = true;
        this.$refs.form.submit();
      }
    }))
  })
</script>
@endsection
