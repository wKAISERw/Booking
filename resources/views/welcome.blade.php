<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Ticket Booking') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        .hero { background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%); color: white; min-height: 100vh; display: flex; align-items: center; }
    </style>
</head>
<body>
<div class="hero text-center">
    <div class="container">
        <i class="bi bi-ticket-detailed display-1 mb-4 opacity-75"></i>
        <h1 class="display-3 fw-bold mb-4">Welcome to Booking System</h1>
        <p class="lead mb-5 opacity-75">Discover and book tickets for the best events, concerts, and venues.</p>
        <div class="d-flex justify-content-center gap-3">
            <a href="{{ route('tickets.index') }}" class="btn btn-light btn-lg px-5 rounded-pill fw-bold text-primary">Browse Tickets</a>
            @auth
                <a href="{{ route('dashboard') }}" class="btn btn-outline-light btn-lg px-5 rounded-pill fw-bold">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="btn btn-outline-light btn-lg px-5 rounded-pill fw-bold">Log In</a>
            @endauth
        </div>
    </div>
</div>
</body>
</html>
