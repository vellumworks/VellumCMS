<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Page Not Found</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white text-gray-800 font-sans flex items-center justify-center min-h-screen">
    <div class="text-center px-6">
        <p class="text-6xl font-extrabold text-gray-200 mb-4">404</p>
        <h1 class="text-2xl font-bold text-gray-900 mb-2">Page not found</h1>
        <p class="text-gray-500 mb-8">{{ $message ?? 'The page you\'re looking for doesn\'t exist.' }}</p>
        @isset($org)
            <a href="/sites/{{ $org->slug }}" class="text-[#4361EE] hover:underline text-sm">← Back to homepage</a>
        @endisset
    </div>
</body>
</html>
