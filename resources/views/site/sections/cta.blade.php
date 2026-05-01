@php
$styles = [
    'primary' => 'bg-[#4361EE] text-white',
    'urgent'  => 'bg-[#EA580C] text-white',
    'minimal' => 'bg-[#F9FAFB] text-gray-900 border-t border-b border-gray-200',
];
$btnStyles = [
    'primary' => 'bg-white text-[#4361EE] hover:bg-gray-100',
    'urgent'  => 'bg-white text-[#EA580C] hover:bg-gray-100',
    'minimal' => 'bg-[#4361EE] text-white hover:bg-[#364FC7]',
];
$style = $s['style'] ?? 'primary';
@endphp
<section class="{{ $styles[$style] ?? $styles['primary'] }} py-20 px-6 text-center">
    <div class="max-w-3xl mx-auto">
        @if (!empty($s['heading']))
        <h2 class="text-3xl md:text-4xl font-extrabold mb-4 leading-tight">{{ $s['heading'] }}</h2>
        @endif
        @if (!empty($s['subtext']))
        <p class="{{ $style === 'minimal' ? 'text-gray-600' : 'opacity-80' }} text-lg mb-8">{{ $s['subtext'] }}</p>
        @endif
        @if (!empty($s['button_label']))
        <a href="{{ $s['button_url'] ?? '#' }}"
            class="{{ $btnStyles[$style] ?? $btnStyles['primary'] }} px-8 py-3 rounded-full font-bold transition inline-block text-sm">
            {{ $s['button_label'] }}
        </a>
        @endif
    </div>
</section>
