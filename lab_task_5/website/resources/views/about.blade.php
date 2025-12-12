<!DOCTYPE html>
<html>
<head>
    <title>About - Gaming Website</title>
    <style>
        body { font-family: Arial; background-color: #0f0f0f; color: #fff; text-align: center; }
        nav { background-color: #1a1a1a; padding: 15px; }
        nav a { color: #00ffff; margin: 0 15px; text-decoration: none; font-weight: bold; }
        nav a:hover { color: #ff6600; }
        .content { margin-top: 50px; }
    </style>
</head>
<body>
    <nav>
        <a href="{{ route('home') }}">Home</a>
        <a href="{{ route('about') }}">About</a>
        <a href="{{ route('contact') }}">Contact</a>
    </nav>
    <div class="content">
        <h1>About Us</h1>
        <p>We are passionate gamers bringing you the latest trends, guides, and reviews from the gaming world.</p>
    </div>
</body>
</html>
