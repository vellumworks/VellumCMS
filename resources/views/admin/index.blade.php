@extends('layouts.app')
@section('title', 'Platform Admin')

@section('body')
<div class="min-h-screen bg-[#0f172a] text-white">

    {{-- Top bar --}}
    <header class="border-b border-white/10 px-8 py-4 flex items-center justify-between">
        <div class="flex items-center gap-4">
            <a href="{{ route('dashboard') }}" class="text-xl font-extrabold text-white">
                Vellum<em><span class="text-[#4361EE]">CMS</span></em>
            </a>
            <span class="text-xs font-semibold bg-[#4361EE] text-white px-2.5 py-0.5 rounded-full uppercase tracking-wide">Platform Admin</span>
        </div>
        <div class="flex items-center gap-6">
            <a href="{{ route('dashboard') }}" class="text-sm text-gray-400 hover:text-white transition">← Back to Dashboard</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-sm text-gray-500 hover:text-gray-300 transition">Log out</button>
            </form>
        </div>
    </header>

    <div class="max-w-6xl mx-auto px-8 py-10">

        {{-- Flash --}}
        @if (session('status'))
            <div class="mb-6 bg-[#10B981]/20 border border-[#10B981]/40 text-[#6EE7B7] text-sm px-4 py-3 rounded-xl">
                {{ session('status') }}
            </div>
        @endif

        {{-- Heading + counts --}}
        <div class="mb-8 flex flex-wrap items-start justify-between gap-6">
            <div>
                <h1 class="text-2xl font-extrabold">Organisations</h1>
                <p class="text-gray-500 text-sm mt-1">Review and manage all registered organisations.</p>
            </div>
            <div class="flex gap-3 flex-wrap">
                @foreach (['pending' => '[#F59E0B]', 'verified' => '[#10B981]', 'rejected' => '[#EF4444]', 'suspended' => '[#6B7280]'] as $s => $colour)
                <a href="{{ route('admin.index', ['status' => $s]) }}"
                    class="flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-semibold border transition
                    {{ $filter === $s ? 'bg-white/10 border-white/20 text-white' : 'border-white/10 text-gray-400 hover:text-white hover:border-white/20' }}">
                    <span class="w-2 h-2 rounded-full bg-{{ $colour }}"></span>
                    {{ ucfirst($s) }}
                    <span class="text-xs opacity-60">({{ $counts[$s] }})</span>
                </a>
                @endforeach
                <a href="{{ route('admin.index', ['status' => 'all']) }}"
                    class="px-4 py-2 rounded-xl text-sm font-semibold border transition
                    {{ $filter === 'all' ? 'bg-white/10 border-white/20 text-white' : 'border-white/10 text-gray-400 hover:text-white hover:border-white/20' }}">
                    All
                </a>
            </div>
        </div>

        {{-- Table --}}
        @if ($orgs->isEmpty())
            <div class="text-center py-20 text-gray-600">
                <p class="text-lg">No {{ $filter === 'all' ? '' : $filter }} organisations.</p>
            </div>
        @else
        <div class="bg-[#1e293b] rounded-2xl border border-white/10 overflow-hidden">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-white/10 text-xs font-semibold text-gray-500 uppercase tracking-wide">
                        <th class="text-left px-6 py-4">Organisation</th>
                        <th class="text-left px-6 py-4">Owner</th>
                        <th class="text-left px-6 py-4">Type</th>
                        <th class="text-left px-6 py-4">Registered</th>
                        <th class="text-left px-6 py-4">Status</th>
                        <th class="px-6 py-4"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @foreach ($orgs as $org)
                    @php $owner = $org->users->first(); @endphp
                    <tr class="hover:bg-white/5 transition">
                        <td class="px-6 py-4">
                            <p class="font-semibold text-white">{{ $org->name }}</p>
                            @if ($org->charity_number)
                                <p class="text-xs text-gray-500">Charity #{{ $org->charity_number }}</p>
                            @endif
                            <p class="text-xs text-gray-600">{{ $org->slug }}.vellumcms.com</p>
                        </td>
                        <td class="px-6 py-4">
                            @if ($owner)
                                <p class="text-white">{{ $owner->fullName() }}</p>
                                <p class="text-xs text-gray-500">{{ $owner->email }}</p>
                            @else
                                <span class="text-gray-600">—</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-gray-400 capitalize">
                            {{ str_replace('-', ' ', $org->org_type) }}
                        </td>
                        <td class="px-6 py-4 text-gray-500 text-xs">
                            {{ $org->created_at->format('d M Y') }}
                        </td>
                        <td class="px-6 py-4">
                            @php
                            $badge = match($org->status) {
                                'verified'  => 'bg-[#10B981]/20 text-[#6EE7B7]',
                                'pending'   => 'bg-[#F59E0B]/20 text-[#FCD34D]',
                                'rejected'  => 'bg-red-500/20 text-red-300',
                                'suspended' => 'bg-gray-500/20 text-gray-400',
                                default     => '',
                            };
                            @endphp
                            <span class="inline-block text-xs font-semibold px-2.5 py-1 rounded-full {{ $badge }} capitalize">
                                {{ $org->status }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex gap-2 justify-end flex-wrap">
                                @if ($org->status === 'pending')
                                    <form method="POST" action="{{ route('admin.approve', $org) }}">
                                        @csrf @method('PATCH')
                                        <button class="text-xs bg-[#10B981] text-white font-semibold px-3 py-1.5 rounded-lg hover:bg-green-500 transition">
                                            Approve
                                        </button>
                                    </form>
                                    <form method="POST" action="{{ route('admin.reject', $org) }}">
                                        @csrf @method('PATCH')
                                        <button class="text-xs bg-red-500/20 text-red-300 font-semibold px-3 py-1.5 rounded-lg hover:bg-red-500/40 transition">
                                            Reject
                                        </button>
                                    </form>
                                @elseif ($org->status === 'verified')
                                    <form method="POST" action="{{ route('admin.suspend', $org) }}">
                                        @csrf @method('PATCH')
                                        <button class="text-xs bg-gray-500/20 text-gray-400 font-semibold px-3 py-1.5 rounded-lg hover:bg-gray-500/40 transition">
                                            Suspend
                                        </button>
                                    </form>
                                @elseif (in_array($org->status, ['rejected', 'suspended']))
                                    <form method="POST" action="{{ route('admin.reinstate', $org) }}">
                                        @csrf @method('PATCH')
                                        <button class="text-xs bg-[#4361EE]/20 text-[#93A5F7] font-semibold px-3 py-1.5 rounded-lg hover:bg-[#4361EE]/40 transition">
                                            Reinstate
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif

    </div>
</div>
@endsection
