<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Jumpstart | @yield('title_web_page')</title>
    <link rel="icon" href="{!! asset('build/assets/favicon.ico') !!}" />
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

{{-- bydefault livewire will chose app layout --}}
<body class="font-sans antialiased text-foreground bg-background">
    <x-jet-banner />

    <div class="min-h-screen">
        <header>
            @if(!auth()->check())
            <x-navbar/>
            @elseif (auth()->user()->role == 'member')
            <x-navigation-menu/>
            @elseif (auth()->user()->role == 'admin')
            <x-navbar-admin />
            @endif
        </header>

        <!-- Page Content -->
        <main class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            {{ $slot }}
        </main>
        
        <x-footer />
    </div>

    @stack('modals')
    @livewireScripts
    <script src="https://unpkg.com/flowbite@1.5.1/dist/flowbite.js"></script>
</body>

</html>