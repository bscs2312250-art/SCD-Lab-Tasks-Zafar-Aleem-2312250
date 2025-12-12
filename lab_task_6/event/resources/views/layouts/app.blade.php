<!DOCTYPE html>
<html>
<head>
    <title>@yield('title', 'Event Planner System')</title>
    <style>
        body { font-family: Arial; background-color: #f5f5f5; color: #333; margin: 0; padding: 0; }
        header { background-color: #222; color: #fff; padding: 10px; text-align: center; }
        nav a { color: #00ffff; margin: 0 15px; text-decoration: none; font-weight: bold; }
        nav a:hover { color: #ff6600; }
        .container { padding: 20px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: center; }
        .status-upcoming { color: green; font-weight: bold; }
        .status-ongoing { color: orange; font-weight: bold; }
        .status-completed { color: red; font-weight: bold; }
        .error { color: red; font-weight: bold; }
    </style>
    @stack('styles')
</head>
<body>
    <header>
        <h1>Event Planner System</h1>
        <nav>
            <a href="{{ route('events.index') }}">Home</a>
            <a href="{{ route('events.details') }}">Event Details</a>
            <a href="{{ route('events.create') }}">Add Event</a>
        </nav>
    </header>
    <div class="container">
        @yield('content')
    </div>
</body>
</html>
