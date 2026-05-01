@php $imgLeft = ($s['image_side'] ?? 'left') === 'left'; @endphp
<section class="py-20 px-6 bg-white">
    <div class="max-w-6xl mx-auto grid md:grid-cols-2 gap-12 items-center {{ !$imgLeft ? 'direction-rtl' : '' }}">

        @if (!empty($s['image_url']))
        <div class="{{ !$imgLeft ? 'md:order-2' : '' }}">
            <img src="{{ $s['image_url'] }}" alt="{{ $s['alt_text'] ?? '' }}"
                class="w-full rounded-2xl shadow-lg object-cover aspect-[4/3]">
        </div>
        @endif

        <div class="{{ !$imgLeft ? 'md:order-1' : '' }}">
            @if (!empty($s['heading']))
            <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-6 leading-tight">
                {{ $s['heading'] }}
            </h2>
            @endif
            @if (!empty($s['text']))
            <p class="text-gray-600 text-lg leading-relaxed mb-6">{{ $s['text'] }}</p>
            @endif
            @if (!empty($s['button_label']))
            <a href="{{ $s['button_url'] ?? '#' }}"
                class="inline-block bg-[#4361EE] text-white px-6 py-3 rounded-full font-bold hover:bg-[#364FC7] transition text-sm">
                {{ $s['button_label'] }}
            </a>
            @endif
        </div>

    </div>
</section>
