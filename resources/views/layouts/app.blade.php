<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'LaraRole Blog')</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    
    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-pink-50 text-purple-800 font-sans antialiased">
    <div class="min-h-screen">
        @include('layouts.navigation')

        <!-- Header -->
        <header class="bg-pink-100 shadow mb-4">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <h1 class="text-2xl font-bold">@yield('header')</h1>
            </div>
        </header>

        <!-- Main Content -->
        <main class="max-w-7xl mx-auto p-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
