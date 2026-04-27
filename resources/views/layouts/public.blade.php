<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>@yield('title', 'VellumCMS') | VellumCMS</title>
    <link rel="stylesheet" href="/assets/styles.css">
    <meta name="description" content="@yield('description', 'VellumCMS — free, ethical website tools for UK charities and nonprofits.')">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="VellumCMS">
    <meta property="og:title" content="@yield('title', 'VellumCMS')">
    <meta property="og:description" content="@yield('description', 'VellumCMS — free, ethical website tools for UK charities and nonprofits.')">
    <meta property="og:url" content="https://vellumcms.com{{ request()->getPathInfo() }}">
    <link rel="canonical" href="https://vellumcms.com{{ request()->getPathInfo() }}">
    @yield('head')
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#fefefe] text-gray-800 font-sans leading-relaxed">

@include('partials.public-header')

@yield('content')

@include('partials.public-footer')

</body>
</html>
