@php $dark = ($s['style'] ?? 'dark') === 'dark'; @endphp
<section class="{{ $dark ? 'bg-[#0f172a] text-white' : 'bg-white text-gray-900' }} py-24 px-6 text-center relative overflow-hidden">
    <div class="max-w-4xl mx-auto relative z-10">
        <h1 class="text-5xl md:text-6xl font-extrabold tracking-tight mb-6 leading-tight">
            {{ $s['headline'] ?? '' }}
        </h1>
        @if (!empty($s['subtext']))
        <p class="{{ $dark ? 'text-gray-300' : 'text-gray-600' }} text-lg md:text-xl max-w-2xl mx-auto mb-10 leading-relaxed">
            {{ $s['subtext'] }}
        </p>
        @endif
        @if (!empty($s['button_label']))
        <a href="{{ $s['button_url'] ?? '#' }}"
            class="{{ $dark ? 'bg-white text-[#0f172a] hover:bg-gray-100' : 'bg-[#4361EE] text-white hover:bg-[#364FC7]' }} px-8 py-3 rounded-full font-bold transition inline-block text-sm">
            {{ $s['button_label'] }}
        </a>
        @endif
    </div>
    @if ($dark)
    <div class="absolute inset-0 z-0 bg-gradient-to-r from-[#4361EE] via-[#4895EF] to-[#4CC9F0] opacity-10 blur-3xl pointer-events-none"></div>
    @endif
</section>
