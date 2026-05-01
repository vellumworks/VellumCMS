<section class="py-20 px-6 bg-[#F9FAFB]">
    <div class="max-w-6xl mx-auto">
        <div class="text-center mb-14">
            @if (!empty($s['heading']))
            <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-4">{{ $s['heading'] }}</h2>
            @endif
            @if (!empty($s['subtext']))
            <p class="text-gray-500 text-lg max-w-2xl mx-auto">{{ $s['subtext'] }}</p>
            @endif
        </div>

        <div class="grid md:grid-cols-{{ count($s['options'] ?? []) }} gap-8">
            @foreach ($s['options'] ?? [] as $opt)
            @php
            $icons = [
                'volunteer' => '<path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/>',
                'donate'    => '<path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z"/>',
                'fundraise' => '<path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18L9 11.25l4.306 4.307a11.95 11.95 0 015.814-5.519l2.74-1.22m0 0l-5.94-2.28m5.94 2.28l-2.28 5.941"/>',
            ];
            $colour = $opt['colour'] ?? '#4361EE';
            $bg = match($colour) {
                '#4361EE' => 'bg-[#F1F5FF]',
                '#10B981' => 'bg-[#ECFDF5]',
                '#EA580C' => 'bg-[#FFF7ED]',
                default   => 'bg-gray-50',
            };
            @endphp
            <div class="{{ $bg }} rounded-2xl p-8 text-center">
                <div class="inline-flex h-14 w-14 items-center justify-center rounded-full bg-white shadow mb-5">
                    <svg class="h-7 w-7" style="color: {{ $colour }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        {!! $icons[$opt['type'] ?? 'volunteer'] ?? $icons['volunteer'] !!}
                    </svg>
                </div>
                @if (!empty($opt['title']))
                <h3 class="text-xl font-bold text-gray-900 mb-3">{{ $opt['title'] }}</h3>
                @endif
                @if (!empty($opt['text']))
                <p class="text-gray-600 text-sm leading-relaxed mb-6">{{ $opt['text'] }}</p>
                @endif
                @if (!empty($opt['button_label']))
                <a href="{{ $opt['button_url'] ?? '#' }}"
                    class="inline-block font-bold text-sm px-6 py-2.5 rounded-full transition text-white"
                    style="background-color: {{ $colour }}">
                    {{ $opt['button_label'] }}
                </a>
                @endif
            </div>
            @endforeach
        </div>
    </div>
</section>
