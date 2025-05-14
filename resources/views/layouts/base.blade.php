<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
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