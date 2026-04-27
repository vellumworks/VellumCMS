<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use App\Models\Organisation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class OrgSettingsController extends Controller
{
    public function show(): View
    {
        return view('settings.organisation', [
            'org' => auth()->user()->organisation,
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $org = auth()->user()->organisation;

        $validated = $request->validate([
            'name'          => ['required', 'string', 'max:255'],
            'slug'          => ['required', 'string', 'max:100', 'alpha_dash',
                                Rule::unique('organisations', 'slug')->ignore($org->id)],
            'custom_domain' => ['nullable', 'string', 'max:255',
                                Rule::unique('organisations', 'custom_domain')->ignore($org->id)],
        ]);

        $old = $org->only(['name', 'slug', 'custom_domain']);
        $org->update($validated);

        AuditLog::record('org.settings_updated', $org->id, auth()->id(), [
            'before' => $old,
            'after'  => $validated,
        ]);

        return back()->with('status', 'Organisation settings saved.');
    }
}
