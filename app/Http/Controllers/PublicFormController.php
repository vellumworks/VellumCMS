<?php

namespace App\Http\Controllers;

use App\Http\Controllers\SiteController;
use App\Models\Form;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PublicFormController extends Controller
{
    public function show(Request $request, string $orgSlug, string $formSlug): View
    {
        $org  = SiteController::resolveOrg($request, $orgSlug);
        abort_if(! $org, 404);

        $form = $org->forms()
            ->where('slug', $formSlug)
            ->where('status', 'active')
            ->with('fields')
            ->firstOrFail();

        return view('site.form', compact('org', 'form'));
    }

    public function submit(Request $request, string $orgSlug, string $formSlug): RedirectResponse
    {
        $org  = SiteController::resolveOrg($request, $orgSlug);
        abort_if(! $org, 404);

        $form = $org->forms()
            ->where('slug', $formSlug)
            ->where('status', 'active')
            ->with('fields')
            ->firstOrFail();

        // Build validation rules from form fields
        $rules = [];
        foreach ($form->fields as $field) {
            if ($field->type === 'checkbox') {
                $rules[$field->name] = $field->required ? ['accepted'] : ['nullable', 'boolean'];
            } elseif ($field->type === 'email') {
                $rules[$field->name] = $field->required ? ['required', 'email'] : ['nullable', 'email'];
            } else {
                $rules[$field->name] = $field->required ? ['required', 'string', 'max:5000'] : ['nullable', 'string', 'max:5000'];
            }
        }

        $validated = $request->validate($rules);

        // Store submission with field labels as keys (more readable in the inbox)
        $data = [];
        foreach ($form->fields as $field) {
            $value = $validated[$field->name] ?? null;
            if (is_array($value)) $value = implode(', ', $value);
            $data[$field->label] = $value;
        }

        $form->submissions()->create([
            'data'       => $data,
            'ip_address' => $request->ip(),
        ]);

        \Illuminate\Support\Facades\Log::info('Form submission', [
            'form'  => $form->title,
            'org'   => $org->name,
            'email' => $data['Email Address'] ?? $data['Email'] ?? 'unknown',
        ]);

        return back()->with('submitted', true);
    }
}
