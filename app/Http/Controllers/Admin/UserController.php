<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * GET /admin/users
     */
    public function index()
    {
        $users = User::paginate(15);
        return view('admin.users.index', compact('users'));
    }

    /**
     * GET /admin/users/create
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * POST /admin/users
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'  => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        return redirect()->route('admin.users.index')
                         ->with('success','User created successfully.');
    }

    /**
     * GET /admin/users/{user}/edit
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * PUT /admin/users/{user}
     */
    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name'  => 'required|string|max:100',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $user->name  = $data['name'];
        $user->email = $data['email'];
        if (!empty($data['password'])) {
            $user->password = Hash::make($data['password']);
        }
        $user->save();

        return redirect()->route('admin.users.index')
                         ->with('success','User updated successfully.');
    }

    /**
     * DELETE /admin/users/{user}
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')
                         ->with('success','User archived successfully.');
    }
}
