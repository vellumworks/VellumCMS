@php
$events = $org->events()
    ->where('status', 'published')
    ->where('start_date', '>=', today())
    ->orderBy('start_date')
    ->limit($s['limit'] ?? 3)
    ->get();

$baseUrl = request()->segment(1) === 'sites' ? '/sites/' . $org->slug : '';
@endphp

<section class="py-20 px-6 bg-white">
    <div class="max-w-5xl mx-auto">
        @if (!empty($s['heading']))
        <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-10">{{ $s['heading'] }}</h2>
        @endif

        @if ($events->isEmpty())
            <div class="text-center py-12 bg-[#F9FAFB] rounded-2xl">
                <p class="text-gray-400">No upcoming events at the moment — check back soon.</p>
            </div>
        @else
            <div class="grid md:grid-cols-{{ min(3, $events->count()) }} gap-6">
                @foreach ($events as $event)
                <a href="{{ $baseUrl }}/events/{{ $event->slug }}"
                    class="bg-[#F9FAFB] rounded-2xl p-6 hover:shadow-md hover:scale-[1.01] transition-all block">
                    <p class="text-xs font-semibold text-[#4361EE] mb-2 uppercase tracking-wide">
                        {{ $event->dateRange() }}
                        @if ($event->timeRange()) · {{ $event->timeRange() }} @endif
                    </p>
                    <h3 class="font-bold text-gray-900 mb-2">{{ $event->title }}</h3>
                    @if ($event->is_online)
                        <p class="text-sm text-gray-500">Online</p>
                    @elseif ($event->location)
                        <p class="text-sm text-gray-500">{{ Str::limit($event->location, 40) }}</p>
                    @endif
                    @if ($event->capacity)
                        <p class="text-xs text-gray-400 mt-2">
                            {{ $event->spotsLeft() }} {{ Str::plural('space', $event->spotsLeft()) }} left
                        </p>
                    @endif
                </a>
                @endforeach
            </div>

            @if (!empty($s['show_all_link']))
            <div class="text-center mt-8">
                <a href="{{ $baseUrl }}/events" class="text-[#4361EE] font-semibold hover:underline text-sm">
                    View all events →
                </a>
            </div>
            @endif
        @endif
    </div>
</section>
