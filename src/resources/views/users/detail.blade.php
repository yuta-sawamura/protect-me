@extends('layouts.app')

@section('content')

<div class="flex justify-between items-center mb-4">
    <div class="flex items-center">
        <img src="http://flat-icon-design.com/f/f_object_174/s512_f_object_174_0bg.png" alt="User Image"
            class="rounded-full w-20 h-20 mr-4" />
        <div>
            <div class="text-gray-700 text-lg">
                <span>Posts by @yuta</span>
            </div>
        </div>
    </div>
    <a href="/your-logout-endpoint-here" class="bg-red-600 text-white rounded-md px-4 py-2">Delete Account</a>
</div>

@include('components.blogs.post')

@endsection