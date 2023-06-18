@foreach ($blogs as $blog)
<div class="divide-y divide-gray-200 mb-3">
  <div class="bg-white shadow-md rounded-md p-4 hover:cursor-pointer transition">
    <div class="flex items-start">
      <a href="/users/{{ $blog->user->id }}">
        <img src="{{ $blog->user->img }}" alt="User Image" class="rounded-full w-10 h-10 mr-4" />
      </a>
      <div>
        <div class="text-gray-700 text-sm">
          <a href="/users/1">
            <span>{!! '@' !!}{{ $blog->user->name }}</span>
          </a>
        </div>
        <div class="text-gray-700 text-sm mb-2">
          <span>
            {{ $blog->created_at->format('Y-m-d') }}
          </span>
        </div>
        <a href="/blogs/{{ $blog->id }}">
          <h2 class="text-xl font-semibold mb-2">
            {{ $blog->title }}
          </h2>
        </a>
      </div>
    </div>
  </div>
</div>
@endforeach