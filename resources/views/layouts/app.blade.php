<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">


    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
<div class="container-fluid bg-light min-vh-100 d-flex flex-column">
    <!-- Navigation -->
    @include('layouts.navigation')

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <!-- Навігаційні посилання -->
            @auth
                @if(auth()->user()->hasRole('admin'))
                    <a class="nav-link" href="{{ route('venues.index') }}">Manage Venues</a>
                    <a class="nav-link" href="{{ route('events.index') }}">Manage Events</a>
                    <a class="nav-link" href="{{ route('tickets.index') }}">Manage Tickets</a>
                @endif
                <a class="nav-link" href="{{ route('bookings.index') }}">My Bookings</a>
                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-link">Logout</button>
                </form>
            @else
                <a class="nav-link" href="{{ route('login') }}">Login</a>
                <a class="nav-link" href="{{ route('register') }}">Register</a>
            @endauth
        </div>
    </nav>

    <!-- Page Heading -->
    @isset($header)
        <header class="bg-white shadow my-4">
            <div class="container">
                <div class="py-3">
                    {{ $header }}
                </div>
            </div>
        </header>
    @endisset

    <!-- Page Content -->
    <main class="container my-4">
        @yield('content')
    </main>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
