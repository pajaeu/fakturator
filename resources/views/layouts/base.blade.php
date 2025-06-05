<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('favicon/favicon.ico') }}" type="image/x-icon">
    <link rel="apple-touch-icon" href="{{ asset('favicon/apple-touch-icon.png') }}">
    <link rel="icon" sizes="192x192" href="{{ asset('favicon/android-chrome-192x192.png') }}">
    <link rel="icon" sizes="512x512" href="{{ asset('favicon/android-chrome-512x512.png') }}">
    <title>@yield('title') | Fakturátor</title>
    @vite('resources/js/app.js')
    @livewireStyles
    @stack('head')
</head>
<body class="text-gray-800">
@yield('body')
@livewireScripts
@stack('scripts')
</body>
</html>