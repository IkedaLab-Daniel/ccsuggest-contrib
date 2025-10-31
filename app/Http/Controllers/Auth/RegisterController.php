<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => [
                'required', 
                'string', 
                'min:8', 
                'confirmed',
                // Custom password validation rule
                function ($attribute, $value, $fail) {
                    // Check for at least one uppercase letter
                    if (!preg_match('/[A-Z]/', $value)) {
                        $fail('The password must contain at least one uppercase letter.');
                    }
                    
                    // Check for at least one lowercase letter
                    if (!preg_match('/[a-z]/', $value)) {
                        $fail('The password must contain at least one lowercase letter.');
                    }
                    
                    // Check for at least one digit
                    if (!preg_match('/\d/', $value)) {
                        $fail('The password must contain at least one number.');
                    }
                    
                    // Check for at least one special character
                    if (!preg_match('/[!@#$%^&*()_+\-=\[\]{}|;\':".,\/<>?~`]/', $value)) {
                        $fail('The password must contain at least one special character.');
                    }
                },
            ],
        ], [
            'password.min' => 'The password must be at least 8 characters long.',
            'password.confirmed' => 'The password confirmation does not match.',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}