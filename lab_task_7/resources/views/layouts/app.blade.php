<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Blog</title>
    <style>
        :root {
            --primary: #6366f1;
            --primary-hover: #4f46e5;
            --bg: #0f172a;
            --card-bg: #1e293b;
            --text: #f8fafc;
            --text-muted: #94a3b8;
            --border: #334155;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--bg);
            color: var(--text);
            margin: 0;
            padding: 0;
            line-height: 1.6;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        header {
            background-color: var(--card-bg);
            padding: 1rem 0;
            border-bottom: 1px solid var(--border);
            margin-bottom: 2rem;
        }
        header .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        h1, h2, h3 {
            margin: 0;
            font-weight: 600;
        }
        a {
            color: var(--primary);
            text-decoration: none;
            transition: color 0.2s;
        }
        a:hover {
            color: var(--primary-hover);
        }
        .btn {
            display: inline-block;
            background-color: var(--primary);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            border: none;
            cursor: pointer;
            font-size: 0.9rem;
            text-decoration: none;
        }
        .btn:hover {
            background-color: var(--primary-hover);
            color: white;
        }
        .btn-danger {
            background-color: #ef4444;
        }
        .btn-danger:hover {
            background-color: #dc2626;
        }
        .card {
            background-color: var(--card-bg);
            border: 1px solid var(--border);
            border-radius: 0.5rem;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }
        .form-group {
            margin-bottom: 1rem;
        }
        label {
            display: block;
            margin-bottom: 0.5rem;
            color: var(--text-muted);
        }
        input, textarea, select {
            width: 100%;
            padding: 0.5rem;
            background-color: var(--bg);
            border: 1px solid var(--border);
            border-radius: 0.375rem;
            color: var(--text);
            font-family: inherit;
        }
        input:focus, textarea:focus, select:focus {
            outline: 2px solid var(--primary);
            border-color: transparent;
        }
        .badge {
            display: inline-block;
            padding: 0.25rem 0.5rem;
            font-size: 0.75rem;
            background-color: rgba(99, 102, 241, 0.2);
            color: var(--primary);
            border-radius: 9999px;
            margin-right: 0.5rem;
        }
        .meta {
            font-size: 0.875rem;
            color: var(--text-muted);
            margin-bottom: 0.5rem;
        }
        .alert {
            padding: 1rem;
            background-color: rgba(34, 197, 94, 0.2);
            color: #4ade80;
            border-radius: 0.375rem;
            margin-bottom: 1rem;
        }
        .actions {
            display: flex;
            gap: 0.5rem;
        }
        /* Grid for categories checkbox */
        .checkbox-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 0.5rem;
        }
        .checkbox-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .checkbox-item input {
            width: auto;
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <h1><a href="{{ route('posts.index') }}" style="color: white;">Laravel Blog</a></h1>
            <a href="{{ route('posts.create') }}" class="btn">Create Post</a>
        </div>
    </header>

    <div class="container">
        @if(session('success'))
            <div class="alert">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </div>
</body>
</html>
