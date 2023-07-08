<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet" />
</head>

<body class="bg-gray-100">
    <header class="bg-white shadow-md">
        <div class="container mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                <div class="text-blue-600 font-bold text-3xl">
                    <a href="/">ProtectMe</a>
                </div>
                <div class="flex space-x-4 items-center">
                    <a href="/score-board" class="bg-green-500 text-white rounded-md px-4 py-2">
                        Score board
                    </a>
                    @guest
                    <div class="flex space-x-4 items-center">
                        <a href="/login" class="bg-white border border-blue-600 text-blue-600 rounded-md px-4 py-2">
                            Login
                        </a>
                    </div>
                    <div class="flex space-x-4 items-center">
                        <a href="/register" class="bg-blue-600 text-white rounded-md px-4 py-2">
                            Sign up
                        </a>
                    </div>
                    @endguest
                    @auth
                    <div id="user-info" class="relative text-gray-700 cursor-pointer">
                        <div id="username">
                            <span>{!! '@' !!}{{ Auth::user()->name }}</span>
                        </div>
                        <div id="modal"
                            class="absolute top-full right-0 mt-2 bg-white border border-gray-300 text-black shadow-lg rounded-lg p-4 hidden">
                            <a href="/users/{{ Auth::user()->id }}" class="block text-blue-500">Mypage</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block text-blue-500 bg-transparent cursor-pointer">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                    @endauth
                </div>
            </div>
        </div>
    </header>

    @if (session('status'))
    <div id="flash-message" class="bg-blue-100 border border-blue-500 text-blue-700 px-4 py-3 rounded text-center">
        {{ session('status') }}
    </div>
    @endif

    <main class="container mx-auto px-4 py-16">
        @yield('content')
    </main>

    <script>
        window.onload = function () {
            setTimeout(function () {
                let element = document.getElementById('flash-message');
                if (element) {
                    element.style.display = "none";
                }
            }, 3000);
        };
    </script>

    <script>
        window.addEventListener('DOMContentLoaded', (event) => {
            const userInfoDiv = document.getElementById('user-info');
            const modalDiv = document.getElementById('modal');

            if (userInfoDiv) {
                userInfoDiv.addEventListener('click', (e) => {
                    modalDiv.classList.toggle('hidden');
                    e.stopPropagation();
                });
            }

            if (modalDiv) {
                modalDiv.addEventListener('click', (e) => {
                    e.stopPropagation();
                });
            }

            window.addEventListener('click', (event) => {
                modalDiv.classList.add('hidden');
            });
        });
    </script>
</body>

</html>