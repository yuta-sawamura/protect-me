@foreach ($blogs as $blog)
<div class="divide-y divide-gray-200 mb-3">
    <div class="bg-white shadow-md rounded-md p-4 hover:cursor-pointer transition">
        <div class="flex items-start">
            <div>
                <div class="text-gray-700 text-sm">
                    <a href="/users/{{ $blog->user->id }}">
                        <a href="{{ route('users.show', ['user' => $blog->user->id]) }}">
                            <span>{!! '@' !!}{{ $blog->user->name }}</span>
                        </a>
                </div>
                <div class="text-gray-700 text-sm mb-2">
                    <span>
                        {{ $blog->created_at->format('Y-m-d') }}
                    </span>
                </div>
                <a href="{{ route('blogs.show', ['blog' => $blog->id]) }}">
                    <h2 class="text-xl font-semibold mb-2">
                        <?php echo $blog->title ?>
                    </h2>
                </a>
            </div>
        </div>
    </div>
</div>
@endforeach