@extends('layouts.app')

@section('content')

<div class="divide-y divide-gray-200 mb-3">
    <div class="bg-white shadow-md rounded-md p-4">
        <div class="flex items-start">
            <img src="http://flat-icon-design.com/f/f_object_174/s512_f_object_174_0bg.png" alt="User Image"
                class="rounded-full w-10 h-10 mr-4" />
            <div>
                <div class="text-gray-700 text-sm">
                    <a href="/users/{{ $blog->user->id }}">
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
        <div class="text-right">
            <a href="/blog/{{ $blog->id }}/edit" class="text-blue-600 hover:underline">Edit</a>
        </div>
    </div>
</div>

@endsection