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

@foreach ($blogs as $blog)
<div class="divide-y divide-gray-200 mb-3">
    <div class="bg-white shadow-md rounded-md p-4 hover:cursor-pointer transition">
        <div class="flex items-start">
            <div>
                <div class="text-gray-700 text-sm">
                    <a href="/users/{{ $blog->user->id }}">
                        <a href="{{ route('users.show', ['id' => $blog->user->id]) }}">
                            <span>{!! '@' !!}{{ $blog->user->name }}</span>
                        </a>
                </div>
                <div class="text-gray-700 text-sm mb-2">
                    <span>
                        {{ $blog->created_at->format('Y-m-d') }}
                    </span>
                </div>
                <a href="{{ route('blogs.show', ['id' => $blog->id]) }}">
                    <h2 class="text-xl font-semibold mb-2">
                        <?php echo $blog->title ?>
                    </h2>
                </a>
            </div>
        </div>
    </div>
</div>
@endforeach

@endsection