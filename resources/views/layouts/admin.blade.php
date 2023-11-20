<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @if (isset($title))
            {{ $title }} : Admin |
        @endif {{ config('app.name', 'Laravel') }}
    </title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js@9.0.1/public/assets/styles/choices.min.css" />

    <script src="https://cdn.jsdelivr.net/npm/choices.js@9.0.1/public/assets/scripts/choices.min.js" defer></script>

    <!-- Include TRIX CSS & JS -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js"></script>


    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <x-tailwind-indicator />
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        @include('layouts.navigation')

        @if (isset($header))
            <header class="bg-white dark:bg-gray-800 shadow">


                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center">
                    {{ $header }}
                    <div class="flex justify-between h-16">
                        <div class="flex">
                            <!-- Navigation Links -->
                            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                                <x-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.*')">
                                    {{ __('Manage Users') }}
                                </x-nav-link>

                                <x-nav-link :href="route('admin.events.index')" :active="request()->routeIs('admin.events.*')">
                                    {{ __('Manage Events') }}
                                </x-nav-link>

                                <x-nav-link :href="route('admin.reservations.index')" :active="request()->routeIs('admin.reservations.*')">
                                    {{ __('Manage Reservations') }}
                                </x-nav-link>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="block sm:hidden px-6 py-4">
                    <x-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.*')">
                        {{ __('Manage Users') }}
                    </x-nav-link>

                    <x-nav-link :href="route('admin.events.index')" :active="request()->routeIs('admin.events.*')">
                        {{ __('Manage Events') }}
                    </x-nav-link>

                    <x-nav-link :href="route('admin.reservations.index')" :active="request()->routeIs('admin.reservations.*')">
                        {{ __('Manage Tickets') }}
                    </x-nav-link>
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main>
            <x-notification />

            {{ $slot }}
        </main>
    </div>
</body>

</html>
