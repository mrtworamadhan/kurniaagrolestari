<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Login - PT KAL' }}</title>
    
    <link rel="icon" type="image/png" href="{{ asset('images/logoKAL.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/logoKAL.png') }}">
    <meta name="theme-color" content="#22c55e">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased text-gray-900 bg-gray-50 dark:bg-gray-900 dark:text-gray-100 h-full flex items-center justify-center">
    
    <div class="w-full max-w-md p-6">
        {{ $slot }}
    </div>

</body>
</html>