@extends('layouts.app')

@section('content')

<div class="w-full max-w-md mx-auto mt-6 bg-white p-6 rounded-md shadow-md">
    <h2 class="text-2xl text-center font-bold mb-5">Edit Account</h2>
    <form method="POST" action="{{ route('users.update', $user) }}">
        @csrf
        @method('PUT')

        <!-- Name -->
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">{{ __('Name') }}</label>
            <input id="name" class="block w-full p-2 border-2 border-gray-300 rounded-md" type="text" name="name"
                value="{{ old('name', $user->name) }}" required autofocus />
            @error('name')
            <span class="text-red-500 text-sm mt-2">{{ $message }}</span>
            @enderror
        </div>

        <!-- Email Address -->
        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700">{{ __('Email') }}</label>
            <input id="email" class="block w-full p-2 border-2 border-gray-300 rounded-md" type="email" name="email"
                value="{{ old('email', $user->email) }}" required />
            @error('email')
            <span class="text-red-500 text-sm mt-2">{{ $message }}</span>
            @enderror
        </div>

        <div class="flex items-center justify-between">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                href="{{ route('users.show', $user) }}">
                {{ __('Cancel') }}
            </a>

            <button type="submit" class="bg-blue-600 text-white rounded-md px-4 py-2">
                {{ __('Update') }}
            </button>
        </div>
    </form>
</div>

@endsection