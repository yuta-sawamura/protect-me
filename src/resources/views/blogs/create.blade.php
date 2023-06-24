@extends('layouts.app')

@section('content')

<form action="/blog" method="POST">
    <div class="mb-4">
        <label for="title" class="block text-lg font-medium text-gray-700">Title</label>
        <input type="text" name="title" id="title" class="border-2 border-gray-300 rounded-md w-full p-2" required />
    </div>
    <div class="mb-4">
        <label for="content" class="block text-lg font-medium text-gray-700">Content</label>
        <textarea name="content" id="content" rows="10" class="border-2 border-gray-300 rounded-md w-full p-2"
            required></textarea>
    </div>
    <div class="mb-4 text-right">
        <button type="submit" class="bg-blue-600 text-white rounded-md px-4 py-2">
            Submit
        </button>
    </div>
</form>

@endsection