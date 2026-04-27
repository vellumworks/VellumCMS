@extends('layouts.dashboard')
@section('title', 'Team')

@section('page-header')
<div class="flex items-center justify-between">
    <div>
        <h1 class="text-2xl font-extrabold text-gray-900">Team</h1>
        <p class="text-sm text-gray-500 mt-0.5">{{ $members->count() }} {{ Str::plural('member', $members->count()) }}</p>
    </div>
    @if (auth()->user()->isAdmin())
    <button onclick="document.getElementById('invite-form').classList.toggle('hidden')"
        class="bg-[#4361EE] text-white font-semibold px-5 py-2.5 rounded-xl hover:bg-[#364FC7] transition text-sm">
        Invite teammate
    </button>
    @endif
</div>
@endsection

@section('content')

{{-- Invite form --}}
@if (auth()->user()->isAdmin())
<div id="invite-form" class="hidden mb-8">
    <form method="POST" action="{{ route('team.invite') }}" class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
        @csrf
        <h2 class="text-base font-bold text-gray-900 mb-4">Invite a teammate</h2>
        <div class="flex gap-3 items-end flex-wrap">
            <div class="flex-1 min-w-48">
                <label class="block text-xs font-semibold text-gray-700 mb-1" for="invite-email">Email Address</label>
                <input type="email" id="invite-email" name="email" value="{{ old('email') }}" required placeholder="colleague@yourcharity.org"
                    class="w-full border @error('email') border-red-400 @else border-gray-200 @enderror rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#4361EE] transition" />
                @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-700 mb-1" for="invite-role">Role</label>
                <select id="invite-role" name="role" required
                    class="border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#4361EE] transition bg-white">
                    <option value="editor"    {{ old('role') === 'editor'    ? 'selected' : '' }}>Editor</option>
                    <option value="publisher" {{ old('role') === 'publisher' ? 'selected' : '' }}>Publisher</option>
                    <option value="reviewer"  {{ old('role') === 'reviewer'  ? 'selected' : '' }}>Reviewer</option>
                    <option value="admin"     {{ old('role') === 'admin'     ? 'selected' : '' }}>Admin</option>
                </select>
            </div>
            <button type="submit" class="bg-[#4361EE] text-white font-semibold px-5 py-2.5 rounded-xl hover:bg-[#364FC7] transition text-sm whitespace-nowrap">
                Send Invite
            </button>
        </div>
        <p class="text-xs text-gray-400 mt-3">They'll receive an email with a link to set up their account. The link expires in 7 days.</p>
    </form>
</div>
@endif

{{-- Members list --}}
<div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
    <table class="w-full text-sm">
        <thead>
            <tr class="border-b border-gray-100 text-xs font-semibold text-gray-500 uppercase tracking-wide">
                <th class="text-left px-6 py-4">Member</th>
                <th class="text-left px-6 py-4">Role</th>
                <th class="text-left px-6 py-4">Status</th>
                @if (auth()->user()->isAdmin())
                <th class="px-6 py-4"></th>
                @endif
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-50">
            @foreach ($members as $member)
            <tr>
                <td class="px-6 py-4">
                    <div class="flex items-center gap-3">
                        <div class="h-8 w-8 rounded-full bg-[#4361EE] flex items-center justify-center text-white text-xs font-bold flex-shrink-0">
                            {{ strtoupper(substr($member->first_name ?? $member->email, 0, 1)) }}
                        </div>
                        <div>
                            <p class="font-semibold text-gray-900">
                                {{ $member->first_name ? $member->fullName() : '—' }}
                                @if ($member->id === auth()->id())
                                    <span class="text-xs text-gray-400 font-normal ml-1">(you)</span>
                                @endif
                            </p>
                            <p class="text-xs text-gray-400">{{ $member->email }}</p>
                        </div>
                    </div>
                </td>
                <td class="px-6 py-4">
                    @if (auth()->user()->isAdmin() && ! $member->isOwner() && $member->id !== auth()->id())
                    <form method="POST" action="{{ route('team.role', $member) }}">
                        @csrf @method('PATCH')
                        <select name="role" onchange="this.form.submit()"
                            class="text-xs border border-gray-200 rounded-lg px-2 py-1.5 focus:outline-none focus:ring-1 focus:ring-[#4361EE] bg-white capitalize">
                            @foreach (['admin','editor','publisher','reviewer'] as $r)
                            <option value="{{ $r }}" {{ $member->role === $r ? 'selected' : '' }}>{{ ucfirst($r) }}</option>
                            @endforeach
                        </select>
                    </form>
                    @else
                    <span class="text-xs capitalize text-gray-600">{{ $member->role }}</span>
                    @endif
                </td>
                <td class="px-6 py-4">
                    @php $colours = ['active'=>'text-[#10B981] bg-[#ECFDF5]','invited'=>'text-[#F59E0B] bg-[#FFFBEB]','suspended'=>'text-red-500 bg-red-50']; @endphp
                    <span class="inline-block text-xs font-semibold px-2 py-0.5 rounded-full {{ $colours[$member->status] ?? '' }} capitalize">
                        {{ $member->status }}
                    </span>
                </td>
                @if (auth()->user()->isAdmin())
                <td class="px-6 py-4 text-right">
                    @if (! $member->isOwner() && $member->id !== auth()->id())
                    <form method="POST" action="{{ route('team.remove', $member) }}" onsubmit="return confirm('Remove {{ $member->first_name ?? $member->email }} from the team?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-xs text-gray-400 hover:text-red-500 transition">Remove</button>
                    </form>
                    @endif
                </td>
                @endif
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
