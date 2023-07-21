@extends('layouts.app')

@section('content')

<div class="divide-y divide-gray-200 mb-3">
    <div class="bg-white shadow-md rounded-md p-4 mb-4">
        <div class="flex items-start">
            <div>
                <div class="text-gray-700 text-sm">
                    <a href="{{ route('users.show', ['user' => $blog->user->id]) }}">
                        <span>{!! '@' !!}{{ $blog->user->name }}</span>
                    </a>
                </div>
                <div class="text-gray-700 text-sm mb-2">
                    <span>
                        {{ $blog->created_at->format('Y-m-d') }}
                    </span>
                </div>
                <h2 class="text-xl font-semibold mb-2">
                    {{ $blog->title }}
                </h2>
                <div class="text-gray-600 text-base mb-4">
                    {{ $blog->content }}
                </div>
            </div>
        </div>
    </div>
</div>
@if(Auth::user() && Auth::user()->id === $blog->user->id)
<div class="flex justify-end space-x-4">
    <a href="{{ route('blogs.edit', $blog) }}">
        <button class="bg-blue-600 text-white rounded-md px-4 py-2">Edit</button>
    </a>
    <form method="POST" action="{{ route('blogs.destroy', $blog) }}">
        @csrf
        @method('DELETE')
        <button type="submit" class="bg-red-600 text-white rounded-md px-4 py-2">Delete</button>
    </form>
</div>
@endif
@endsection