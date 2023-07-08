@extends('layouts.app')

@section('content')

<div class="flex justify-between items-center mb-4">
    <div class="flex items-center">
        <img src="http://flat-icon-design.com/f/f_object_174/s512_f_object_174_0bg.png" alt="User Image"
            class="rounded-full w-20 h-20 mr-4" />
        <div>
            <div class="text-gray-700 text-lg">
                <span>{!! '@' !!}{{ $user->name }}</span>
            </div>
        </div>
    </div>
    @if(Auth::user() && Auth::user()->id === $user->id)
    <div class="flex items-center space-x-4">
        <a href="/users/{{ $user->id }}/edit" class="bg-blue-600 text-white rounded-md px-4 py-2 inline-block">Edit
            Account</a>
        <form action="/users/{{ $user->id }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-600 text-white rounded-md px-4 py-2">Delete Account</button>
        </form>
    </div>
    @endif
</div>

@include('components.blogs.post', ['blogs' => $blogs])

@endsection