<!DOCTYPE html>
<html>
<head>
    <title>Contact - Gaming Website</title>
    <style>
        body { font-family: Arial; background-color: #0f0f0f; color: #fff; text-align: center; }
        nav { background-color: #1a1a1a; padding: 15px; }
        nav a { color: #00ffff; margin: 0 15px; text-decoration: none; font-weight: bold; }
        nav a:hover { color: #ff6600; }
        .content { margin-top: 50px; }
        input, textarea { padding: 10px; width: 300px; border-radius: 5px; border: none; margin: 5px; }
        button { background-color: #00ffff; color: #000; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; }
        button:hover { background-color: #ff6600; color: #fff; }
    </style>
</head>
<body>
    <nav>
        <a href="{{ route('home') }}">Home</a>
        <a href="{{ route('about') }}">About</a>
        <a href="{{ route('contact') }}">Contact</a>
    </nav>
    <div class="content">
        <h1>Contact Us</h1>
        <form>
            <input type="text" placeholder="Your Name"><br>
            <input type="email" placeholder="Your Email"><br>
            <textarea placeholder="Your Message"></textarea><br>
            <button type="submit">Send Message</button>
        </form>
    </div>
</body>
</html>
