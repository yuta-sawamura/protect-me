@extends('layouts.app')

@section('content')

<div class="flex justify-between items-center mb-4">
    <div class="flex items-center">
        <div>
            <div class="text-gray-700 text-lg">
                <span>{!! '@' !!}{{ $user->name }}</span>
            </div>
        </div>
    </div>
    @if(Auth::user() && Auth::user()->id === $user->id)
    <div class="flex items-center space-x-4">
        <a href="{{ route('users.edit', $user) }}" class="bg-blue-600 text-white rounded-md px-4 py-2
            inline-block">Edit
            Account</a>
        <form method="POST" action="{{ route('users.destroy', $user) }}">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-600 text-white rounded-md px-4 py-2">Delete Account</button>
        </form>
    </div>
    @endif
</div>

@include('components.blogs.post', ['blogs' => $blogs])

@endsection