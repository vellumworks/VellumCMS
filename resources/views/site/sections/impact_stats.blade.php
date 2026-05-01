<section class="py-20 px-6 bg-[#F9FAFB]">
    <div class="max-w-5xl mx-auto text-center">
        @if (!empty($s['heading']))
        <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-4">{{ $s['heading'] }}</h2>
        @endif
        @if (!empty($s['subtext']))
        <p class="text-gray-500 text-lg mb-12">{{ $s['subtext'] }}</p>
        @else
        <div class="mb-12"></div>
        @endif

        <div class="grid grid-cols-1 sm:grid-cols-{{ count($s['stats'] ?? []) }} gap-8">
            @foreach ($s['stats'] ?? [] as $stat)
            <div class="text-center">
                <p class="text-5xl md:text-6xl font-extrabold mb-2" style="color: {{ $stat['colour'] ?? '#4361EE' }}">
                    {{ $stat['number'] ?? '0' }}
                </p>
                <p class="text-gray-600 font-semibold text-lg">{{ $stat['label'] ?? '' }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>
