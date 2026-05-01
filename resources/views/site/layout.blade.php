<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>@yield('title') — {{ $org->name }}</title>
    <meta name="description" content="@yield('description', $org->name)">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .page-content h1 { font-size: 2rem; font-weight: 800; margin: 1.5rem 0 1rem; line-height: 1.2; }
        .page-content h2 { font-size: 1.5rem; font-weight: 700; margin: 1.5rem 0 0.75rem; }
        .page-content h3 { font-size: 1.25rem; font-weight: 600; margin: 1.25rem 0 0.5rem; }
        .page-content p  { margin: 0 0 1rem; line-height: 1.75; }
        .page-content ul { list-style: disc; padding-left: 1.5rem; margin: 0 0 1rem; }
        .page-content ol { list-style: decimal; padding-left: 1.5rem; margin: 0 0 1rem; }
        .page-content li { margin-bottom: 0.35rem; line-height: 1.75; }
        .page-content a  { color: #4361EE; text-decoration: underline; }
        .page-content blockquote { border-left: 4px solid #4361EE; padding: 0.5rem 0 0.5rem 1rem; margin: 1rem 0; color: #6b7280; font-style: italic; }
        .page-content strong { font-weight: 700; }
        .page-content em { font-style: italic; }
        .page-content img { max-width: 100%; border-radius: 0.5rem; margin: 1rem 0; }
        .page-content figure { margin: 1.5rem 0; }
        .page-content figcaption { text-align: center; font-size: 0.8rem; color: #9ca3af; margin-top: 0.5rem; }
    </style>
    @yield('head')
</head>
<body class="bg-white text-gray-800 font-sans leading-relaxed">

    {{-- Nav --}}
    <header class="border-b border-gray-100 px-6 py-4">
        <div class="max-w-5xl mx-auto flex items-center justify-between gap-6">
            <a href="{{ $homeUrl ?? '/' }}" class="text-xl font-extrabold text-gray-900">
                {{ $org->name }}
            </a>
            @if ($nav->count() > 1)
            <nav class="flex items-center gap-6 text-sm">
                @foreach ($nav as $navPage)
                    @if (! $navPage->is_homepage)
                    <a href="{{ $baseUrl ?? '' }}/{{ $navPage->slug }}"
                        class="text-gray-600 hover:text-gray-900 transition {{ isset($page) && $page->id === $navPage->id ? 'font-semibold text-gray-900' : '' }}">
                        {{ $navPage->title }}
                    </a>
                    @endif
                @endforeach
            </nav>
            @endif
        </div>
    </header>

    {{-- Content --}}
    @yield('content')

    {{-- Footer --}}
    <footer class="border-t border-gray-100 mt-16 py-8 px-6 text-center text-xs text-gray-400">
        <p>{{ $org->name }} &middot; Powered by <a href="https://vellumcms.com" target="_blank" class="hover:underline">VellumCMS</a></p>
    </footer>

</body>
</html>
