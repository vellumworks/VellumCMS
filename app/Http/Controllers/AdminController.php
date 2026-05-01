<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use App\Models\Organisation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function index(Request $request): View
    {
        $filter = $request->get('status', 'pending');

        $orgs = Organisation::with(['users' => fn ($q) => $q->where('role', 'owner')])
            ->when($filter !== 'all', fn ($q) => $q->where('status', $filter))
            ->latest()
            ->get();

        $counts = [
            'pending'  => Organisation::where('status', 'pending')->count(),
            'verified' => Organisation::where('status', 'verified')->count(),
            'rejected' => Organisation::where('status', 'rejected')->count(),
            'suspended'=> Organisation::where('status', 'suspended')->count(),
        ];

        return view('admin.index', compact('orgs', 'counts', 'filter'));
    }

    public function approve(Organisation $org): RedirectResponse
    {
        $org->update(['status' => 'verified']);

        AuditLog::record('admin.org_approved', $org->id, auth()->id(), [
            'org_name' => $org->name,
        ]);

        return back()->with('status', "{$org->name} approved.");
    }

    public function reject(Organisation $org): RedirectResponse
    {
        $org->update(['status' => 'rejected']);

        AuditLog::record('admin.org_rejected', $org->id, auth()->id(), [
            'org_name' => $org->name,
        ]);

        return back()->with('status', "{$org->name} rejected.");
    }

    public function suspend(Organisation $org): RedirectResponse
    {
        $org->update(['status' => 'suspended']);

        AuditLog::record('admin.org_suspended', $org->id, auth()->id(), [
            'org_name' => $org->name,
        ]);

        return back()->with('status', "{$org->name} suspended.");
    }

    public function reinstate(Organisation $org): RedirectResponse
    {
        $org->update(['status' => 'verified']);

        AuditLog::record('admin.org_reinstated', $org->id, auth()->id(), [
            'org_name' => $org->name,
        ]);

        return back()->with('status', "{$org->name} reinstated.");
    }
}
