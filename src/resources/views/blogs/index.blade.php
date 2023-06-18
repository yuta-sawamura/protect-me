@extends('layouts.app')

@section('content')

<div class="mb-6 text-right">
  <a href="/blogs/create" class="bg-blue-600 text-white rounded-md px-4 py-2">Add New Post</a>
</div>
<div class="mb-6">
  <form action="/" method="GET">
    <div class="relative">
      <input type="text" name="q" class="border-2 border-gray-300 rounded-md w-full pl-10 p-2"
        placeholder="Search posts..." value="{{ request('q') }}" />
      <svg class="absolute top-1/2 left-3 transform -translate-y-1/2 h-4 w-4 text-gray-400"
        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
        stroke-linecap="round" stroke-linejoin="round">
        <circle cx="11" cy="11" r="8"></circle>
        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
      </svg>
    </div>
  </form>
</div>

@include('components.blogs.post', ['blogs' => $blogs])
@endsection