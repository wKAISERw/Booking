<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket Booking System</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="/">Ticket Booking</a>
    <div class="navbar-nav">
        <a class="nav-item nav-link" href="{{ route('venues.index') }}">Venues</a>
        <a class="nav-item nav-link" href="{{ route('events.index') }}">Events</a>
        <a class="nav-item nav-link" href="{{ route('tickets.index') }}">Tickets</a>
        <a class="nav-item nav-link" href="{{ route('bookings.index') }}">Bookings</a>
    </div>
</nav>

<div class="container mt-4">
    @yield('content')
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
