<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet" />
</head>

<body class="font-sans text-gray-900 antialiased">
    <header class="bg-white shadow-md">
        <div class="container mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                <div class="text-blue-600 font-bold text-3xl">
                    <a href="/">ProtectMe</a>
                </div>
            </div>
        </div>
    </header>
    <div class="container mx-auto px-4 py-16">
        <div class="w-full sm:max-w-md mx-auto mt-6 px-6 py-4 bg-white shadow-md rounded-md">
            {{ $slot }}
        </div>
    </div>
</body>

</html>