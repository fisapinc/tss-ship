<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link rel="icon" href="/favicon.ico">
    <style>
        body { font-family: ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Helvetica, Arial, "Apple Color Emoji", "Segoe UI Emoji"; margin:0; display:grid; place-items:center; min-height:100vh; background:#0f172a; color:#e2e8f0; }
        .card { text-align:center; padding:2.5rem 2rem; border-radius:0.75rem; background:#111827; box-shadow:0 10px 25px rgba(0,0,0,0.35); width:min(90vw, 720px); }
        h1 { font-size:1.75rem; margin:0 0 0.75rem; }
        p { margin:0.25rem 0 1.25rem; color:#cbd5e1; }
        .actions { display:flex; gap:0.75rem; justify-content:center; flex-wrap:wrap; }
        a { text-decoration:none; padding:0.625rem 0.9rem; border-radius:0.5rem; background:#2563eb; color:#fff; font-weight:600; }
        a.secondary { background:#334155; }
    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <main class="card">
        <h1>Welcome</h1>
        <p>Your Laravel app is running.</p>
        <div class="actions">
            <a class="secondary" href="/">Home</a>
            <a href="/admin">Open Admin Panel</a>
        </div>
    </main>
</body>
</html>


