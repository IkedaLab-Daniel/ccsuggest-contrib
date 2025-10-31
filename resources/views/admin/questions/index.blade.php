@extends('layouts.admin')

@section('title','Manage Questions')

@section('content')
  <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4 mb-8">
    <div>
      <h1 class="text-3xl font-bold text-gray-900">Questions</h1>
      <p class="text-gray-600 mt-1">Manage questionnaire items and configurations</p>
    </div>
    <a href="{{ route('admin.questions.create') }}"
       class="inline-flex items-center justify-center bg-gradient-to-r from-[#e01d44] to-[#ff4466] text-white px-6 py-3 rounded-lg hover:from-[#c91841] hover:to-[#e91e63] transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 font-medium">
      <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
      </svg>
      New Question
    </a>
  </div>

  <!-- Desktop Table -->
  <div class="hidden xl:block">
    <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden">
      <div class="overflow-x-auto">
        <table class="w-full">
          <thead>
            <tr class="bg-gradient-to-r from-gray-50 to-gray-100 border-b border-gray-200">
              <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">ID</th>
              <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Question Text</th>
              <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Type</th>
              <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Tech Field</th>
              <th class="px-6 py-4 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-200">
            @foreach($questions as $q)
            <tr class="hover:bg-gray-50 transition-colors duration-200">
              <td class="px-6 py-4 whitespace-nowrap">
                <span class="inline-flex items-center justify-center w-8 h-8 bg-[#e01d44]/10 text-[#e01d44] text-sm font-medium rounded-full">
                  {{ $q->id }}
                </span>
              </td>
              <td class="px-6 py-4">
                <div class="max-w-xs">
                  <p class="text-sm font-medium text-gray-900 truncate" title="{{ $q->text }}">
                    {{ Str::limit($q->text, 60) }}
                  </p>
                  @if(strlen($q->text) > 60)
                    <p class="text-xs text-gray-500 mt-1">Click to view full text</p>
                  @endif
                </div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                  @if($q->type === 'multiple_choice')
                    bg-blue-100 text-blue-800
                  @elseif($q->type === 'single_choice')
                    bg-green-100 text-green-800
                  @elseif($q->type === 'boolean')
                    bg-purple-100 text-purple-800
                  @else
                    bg-gray-100 text-gray-800
                  @endif
                ">
                  {{ ucfirst(str_replace('_', ' ', $q->type)) }}
                </span>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                @if($q->techField)
                  <div class="flex items-center">
                    <div class="flex-shrink-0 h-8 w-8">
                      <div class="h-8 w-8 rounded-full bg-gradient-to-r from-indigo-400 to-purple-400 flex items-center justify-center text-white font-semibold text-xs">
                        {{ strtoupper(substr($q->techField->name, 0, 2)) }}
                      </div>
                    </div>
                    <div class="ml-3">
                      <p class="text-sm font-medium text-gray-900">{{ $q->techField->name }}</p>
                    </div>
                  </div>
                @else
                  <span class="text-gray-400 text-sm">No field assigned</span>
                @endif
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-center">
                <div class="flex items-center justify-center space-x-3">
                  <a href="{{ route('admin.questions.edit', $q) }}"
                     class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-[#e01d44] bg-pink-50 hover:bg-pink-100 transition-colors duration-200">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Edit
                  </a>
                  <form action="{{ route('admin.questions.destroy', $q) }}" method="POST" class="inline">
                    @csrf @method('DELETE')
                    <button type="submit"
                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-red-700 bg-red-100 hover:bg-red-200 transition-colors duration-200"
                            onclick="return confirm('Delete this question?')">
                      <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                      </svg>
                      Delete
                    </button>
                  </form>
                </div>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- Mobile & Tablet Cards -->
  <div class="xl:hidden space-y-6">
    @foreach($questions as $q)
    <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
      <div class="p-6">
        <div class="flex items-start justify-between mb-4">
          <div class="flex items-center space-x-3">
            <span class="inline-flex items-center justify-center w-10 h-10 bg-[#e01d44]/10 text-[#e01d44] text-sm font-bold rounded-full">
              {{ $q->id }}
            </span>
            <div class="flex flex-col space-y-1">
              <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                @if($q->type === 'multiple_choice')
                  bg-blue-100 text-blue-800
                @elseif($q->type === 'single_choice')
                  bg-green-100 text-green-800
                @elseif($q->type === 'boolean')
                  bg-purple-100 text-purple-800
                @else
                  bg-gray-100 text-gray-800
                @endif
              ">
                {{ ucfirst(str_replace('_', ' ', $q->type)) }}
              </span>
            </div>
          </div>
        </div>
        
        <div class="space-y-4">
          <div>
            <h3 class="text-lg font-semibold text-gray-900 leading-tight mb-2">
              {{ $q->text }}
            </h3>
          </div>
          
          <div class="flex items-center space-x-2">
            <svg class="w-4 h-4 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
            </svg>
            <div class="min-w-0 flex-1">
              @if($q->techField)
                <div class="flex items-center">
                  <div class="flex-shrink-0 h-6 w-6">
                    <div class="h-6 w-6 rounded-full bg-gradient-to-r from-indigo-400 to-purple-400 flex items-center justify-center text-white font-semibold text-xs">
                      {{ strtoupper(substr($q->techField->name, 0, 2)) }}
                    </div>
                  </div>
                  <span class="ml-2 text-sm text-gray-700 font-medium">{{ $q->techField->name }}</span>
                </div>
              @else
                <span class="text-gray-400 text-sm">No tech field assigned</span>
              @endif
            </div>
          </div>
        </div>
        
        <div class="border-t border-gray-200 mt-6 pt-4">
          <div class="flex flex-col sm:flex-row gap-3">
            <a href="{{ route('admin.questions.edit', $q) }}"
               class="flex-1 inline-flex items-center justify-center px-4 py-2.5 border border-transparent text-sm font-medium rounded-lg text-[#e01d44] bg-pink-50 hover:bg-pink-100 transition-colors duration-200">
              <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
              </svg>
              Edit Question
            </a>
            <form action="{{ route('admin.questions.destroy', $q) }}" method="POST" class="flex-1">
              @csrf @method('DELETE')
              <button type="submit"
                      class="w-full inline-flex items-center justify-center px-4 py-2.5 border border-transparent text-sm font-medium rounded-lg text-red-700 bg-red-100 hover:bg-red-200 transition-colors duration-200"
                      onclick="return confirm('Delete this question?')">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                </svg>
                Delete Question
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
    @endforeach
  </div>

  <div class="mt-8 flex justify-center">
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-1">
      {{ $questions->links() }}
    </div>
  </div>
@endsection