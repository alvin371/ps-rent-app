<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'SM Playstation App')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="{{ asset('css/style.css') }}" rel="stylesheet"> 
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex items-center justify-center">
        @yield('content')
    </div>
</body>
</html>
