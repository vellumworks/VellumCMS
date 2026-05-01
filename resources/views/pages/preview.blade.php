<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Preview: {{ $page->title }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Typography for Trix-rendered content */
        .page-content h1 { font-size: 2rem; font-weight: 800; margin: 1.5rem 0 1rem; line-height: 1.2; }
        .page-content h2 { font-size: 1.5rem; font-weight: 700; margin: 1.5rem 0 0.75rem; }
        .page-content h3 { font-size: 1.25rem; font-weight: 600; margin: 1.25rem 0 0.5rem; }
        .page-content p  { margin: 0 0 1rem; line-height: 1.75; }
        .page-content ul { list-style: disc; padding-left: 1.5rem; margin: 0 0 1rem; }
        .page-content ol { list-style: decimal; padding-left: 1.5rem; margin: 0 0 1rem; }
        .page-content li { margin-bottom: 0.35rem; line-height: 1.75; }
        .page-content a  { color: #4361EE; text-decoration: underline; }
        .page-content blockquote {
            border-left: 4px solid #4361EE;
            padding: 0.5rem 0 0.5rem 1rem;
            margin: 1rem 0;
            color: #6b7280;
            font-style: italic;
        }
        .page-content strong { font-weight: 700; }
        .page-content em     { font-style: italic; }
        .page-content pre    { background: #f3f4f6; padding: 1rem; border-radius: 0.5rem; overflow-x: auto; margin: 1rem 0; font-size: 0.875rem; }
        .page-content figure { margin: 1.5rem 0; }
        .page-content figure img { max-width: 100%; border-radius: 0.5rem; }
        .page-content figcaption { text-align: center; font-size: 0.8rem; color: #9ca3af; margin-top: 0.5rem; }
    </style>
</head>
<body class="bg-[#F9FAFB] text-gray-800 font-sans">

    {{-- Preview bar --}}
    <div class="sticky top-0 z-50 bg-[#0f172a] text-white px-6 py-3 flex items-center justify-between gap-4 text-sm">
        <div class="flex items-center gap-3">
            <span class="inline-block bg-[#4361EE] text-white text-xs font-bold px-2.5 py-1 rounded-full uppercase tracking-wide">
                Preview
            </span>
            @if ($page->isPublished())
                <span class="text-[#10B981] text-xs font-semibold">Published</span>
            @else
                <span class="text-[#F59E0B] text-xs font-semibold">Draft — not visible to visitors</span>
            @endif
        </div>
        <div class="flex items-center gap-4">
            <span class="text-gray-500 text-xs font-mono hidden md:inline">
                {{ $page->is_homepage ? '/' : '/' . $page->slug }}
            </span>
            <a href="{{ route('pages.edit', $page) }}"
                class="bg-white text-[#0f172a] font-semibold px-4 py-1.5 rounded-lg hover:bg-gray-100 transition text-xs">
                ← Back to editor
            </a>
        </div>
    </div>

    @php $sections = $page->sections; @endphp

    @if ($sections->isNotEmpty())
        @foreach ($sections as $section)
            @php $s = $section->content; @endphp
            @php $org = $page->organisation; @endphp
            @includeIf('site.sections.' . $section->type, ['s' => $s])
        @endforeach
    @else
        <main class="max-w-3xl mx-auto px-6 py-16">
            <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-10 leading-tight">
                {{ $page->title }}
            </h1>
            @if ($page->content)
                <div class="page-content text-gray-700 leading-relaxed">{!! $page->content !!}</div>
            @else
                <p class="text-gray-400 italic">No sections yet. Go back to the editor and add some.</p>
            @endif
        </main>
    @endif

</body>
</html>
