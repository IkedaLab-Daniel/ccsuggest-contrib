@extends('layouts.admin')

@section('title','Manage Users')

@section('content')
  <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4 mb-8">
    <div>
      <h1 class="text-3xl font-bold text-gray-900">Users</h1>
      <p class="text-gray-600 mt-1">Manage your application users</p>
    </div>
    <a href="{{ route('admin.users.create') }}"
       class="inline-flex items-center justify-center bg-gradient-to-r from-blue-600 to-blue-700 text-white px-6 py-3 rounded-lg hover:from-blue-700 hover:to-blue-800 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 font-medium">
      <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
      </svg>
      New User
    </a>
  </div>

  <!-- Desktop Table -->
  <div class="hidden md:block">
    <div class="overflow-x-auto">
      <table class="w-full bg-white shadow rounded">
        <thead class="bg-gray-200">
          <tr>
            <th class="p-3 text-left">ID</th>
            <th class="p-3 text-left">Name</th>
            <th class="p-3 text-left">Email</th>
            <th class="p-3 text-center">Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach($users as $user)
          <tr class="border-t">
            <td class="p-3">{{ $user->id }}</td>
            <td class="p-3">{{ $user->name }}</td>
            <td class="p-3">{{ $user->email }}</td>
            <td class="p-3 text-center space-x-2">
              <a href="{{ route('admin.users.edit', $user) }}"
                 class="text-blue-600 hover:underline">Edit</a>
              <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline">
                @csrf @method('DELETE')
                <button type="submit"
                        class="text-red-600 hover:underline"
                        onclick="return confirm('Archive this user?')">
                  Archive
                </button>
              </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

  <!-- Mobile Cards -->
  <div class="md:hidden space-y-4">
    @foreach($users as $user)
    <div class="bg-white shadow rounded-lg p-4">
      <div class="flex justify-between items-start mb-3">
        <div class="flex-1">
          <h3 class="font-semibold text-lg">{{ $user->name }}</h3>
          <p class="text-gray-600 text-sm">ID: {{ $user->id }}</p>
        </div>
        <div class="flex space-x-2">
          <a href="{{ route('admin.users.edit', $user) }}"
             class="bg-blue-600 text-white px-3 py-1 rounded text-sm hover:bg-blue-700">
            Edit
          </a>
          <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline">
            @csrf @method('DELETE')
            <button type="submit"
                    class="bg-red-600 text-white px-3 py-1 rounded text-sm hover:bg-red-700"
                    onclick="return confirm('Archive this user?')">
              Archive
            </button>
          </form>
        </div>
      </div>
      <div class="border-t pt-3">
        <p class="text-gray-700">
          <span class="font-medium">Email:</span> {{ $user->email }}
        </p>
      </div>
    </div>
    @endforeach
  </div>

  <div class="mt-4">
    {{ $users->links() }}
  </div>
@endsection