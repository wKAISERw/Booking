<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Ticket Booking') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Bootstrap 5 CSS & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Figtree', sans-serif; background-color: #f8f9fa; color: #333; }
        .card { border-radius: 16px; transition: transform 0.2s ease, box-shadow 0.2s ease; }
        .card-hover:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.08) !important; }
        .btn { border-radius: 8px; font-weight: 500; padding: 0.5rem 1.25rem; }
        .btn-primary { background-color: #4f46e5; border-color: #4f46e5; }
        .btn-primary:hover { background-color: #4338ca; border-color: #4338ca; }
        .form-control, .form-select { border-radius: 8px; padding: 0.75rem 1rem; border-color: #e5e7eb; }
        .form-control:focus, .form-select:focus { border-color: #4f46e5; box-shadow: 0 0 0 0.25rem rgba(79, 70, 229, 0.25); }
        .object-fit-cover { object-fit: cover; }
        .collapse { visibility: visible !important; }
    </style>
</head>
<body class="antialiased d-flex flex-column min-vh-100">

<!-- Navigation -->
@include('layouts.navigation')

@isset($header)
    <header class="bg-white shadow-sm mb-4">
        <div class="container py-3">
            <h4 class="mb-0 fw-bold text-dark">{{ $header }}</h4>
        </div>
    </header>
@endisset

<main class="container my-5 flex-grow-1">
    @yield('content')
</main>

<footer class="bg-white border-top py-4 mt-auto">
    <div class="container text-center text-muted">
        <small>&copy; {{ date('Y') }} {{ config('app.name', 'Ticket Booking') }}. All rights reserved.</small>
    </div>
</footer>

<!-- Bootstrap 5 JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
