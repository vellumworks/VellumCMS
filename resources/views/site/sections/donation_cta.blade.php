<section class="py-20 px-6 bg-[#0f172a] text-white text-center">
    <div class="max-w-2xl mx-auto">
        @if (!empty($s['heading']))
        <h2 class="text-3xl md:text-4xl font-extrabold mb-4">{{ $s['heading'] }}</h2>
        @endif
        @if (!empty($s['subtext']))
        <p class="text-gray-300 text-lg mb-10">{{ $s['subtext'] }}</p>
        @endif

        {{-- Amount picker --}}
        @if (!empty($s['amounts']))
        <div class="flex flex-wrap justify-center gap-3 mb-8">
            @foreach ($s['amounts'] as $amount)
            <a href="{{ ($s['donation_url'] ?? '#') . '?amount=' . $amount }}"
                class="bg-white/10 hover:bg-white/20 border border-white/20 text-white font-bold px-6 py-3 rounded-full transition text-sm">
                £{{ $amount }}
            </a>
            @endforeach
        </div>
        @endif

        @if (!empty($s['donation_url']))
        <a href="{{ $s['donation_url'] }}"
            class="inline-block bg-[#4361EE] text-white px-10 py-4 rounded-full font-bold hover:bg-[#364FC7] transition text-base mb-6">
            {{ $s['button_label'] ?? 'Donate Now' }}
        </a>
        @endif

        @if (!empty($s['gift_aid']))
        <p class="text-gray-500 text-xs mt-4">
            UK taxpayers can increase the value of their gift by 25% at no extra cost through Gift Aid.
        </p>
        @endif
    </div>
</section>
