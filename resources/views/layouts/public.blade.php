{{-- resources/views/layouts/public.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Public VHF Entry</title>
    @vite(['resources/css/app.css', 'resources/js/app.js']) {{-- or your asset pipeline --}}
</head>
<body class="bg-gray-100">
    <main class="py-10">
        {{ $slot }}
    </main>
</body>
</html>
