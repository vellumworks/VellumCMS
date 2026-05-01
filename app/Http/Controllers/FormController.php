<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use App\Models\Form;
use App\Models\FormField;
use App\Models\FormSubmission;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class FormController extends Controller
{
    public function index(): View
    {
        $forms = auth()->user()->organisation->forms()->latest()->get();
        return view('forms.index', compact('forms'));
    }

    public function create(): View
    {
        return view('forms.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $org = auth()->user()->organisation;

        $request->validate([
            'title'    => ['required', 'string', 'max:255'],
            'slug'     => ['required', 'string', 'max:255', 'alpha_dash',
                           Rule::unique('forms')->where('organisation_id', $org->id)],
            'template' => ['nullable', 'string'],
        ]);

        $form = Form::create([
            'organisation_id'    => $org->id,
            'created_by'         => auth()->id(),
            'title'              => $request->title,
            'slug'               => $request->slug,
            'submit_button_label'=> 'Send Message',
            'success_message'    => 'Thank you for getting in touch. We\'ll be in touch soon.',
            'status'             => 'active',
        ]);

        // Pre-fill fields based on template
        $this->applyTemplate($form, $request->input('template', 'blank'));

        AuditLog::record('form.created', $org->id, auth()->id(), ['form' => $form->title]);

        return redirect()->route('forms.edit', $form)->with('status', 'Form created.');
    }

    public function edit(Form $form): View
    {
        $this->authorise($form);
        $fields = $form->fields;
        return view('forms.edit', compact('form', 'fields'));
    }

    public function update(Request $request, Form $form): RedirectResponse
    {
        $this->authorise($form);

        $request->validate([
            'title'               => ['required', 'string', 'max:255'],
            'slug'                => ['required', 'string', 'max:255', 'alpha_dash',
                                      Rule::unique('forms')->where('organisation_id', $form->organisation_id)->ignore($form->id)],
            'description'         => ['nullable', 'string'],
            'submit_button_label' => ['required', 'string', 'max:100'],
            'success_message'     => ['nullable', 'string'],
            'notify_email'        => ['nullable', 'email', 'max:255'],
        ]);

        $form->update($request->only(
            'title', 'slug', 'description',
            'submit_button_label', 'success_message', 'notify_email'
        ));

        return back()->with('status', 'Form settings saved.');
    }

    public function toggleStatus(Form $form): RedirectResponse
    {
        $this->authorise($form);
        $form->update(['status' => $form->isActive() ? 'inactive' : 'active']);
        return back()->with('status', 'Form ' . ($form->isActive() ? 'deactivated' : 'activated') . '.');
    }

    public function destroy(Form $form): RedirectResponse
    {
        $this->authorise($form);
        abort_unless(auth()->user()->isAdmin(), 403);

        $title = $form->title;
        $form->delete();

        return redirect()->route('forms.index')
            ->with('status', '"' . $title . '" deleted.');
    }

    // ── Fields (AJAX) ─────────────────────────────────────────────────

    public function storeField(Request $request, Form $form): JsonResponse
    {
        $this->authorise($form);

        $request->validate(['type' => ['required', 'in:text,email,phone,textarea,select,checkbox,checkboxes,radio']]);

        $field = $form->fields()->create([
            'type'       => $request->type,
            'label'      => $this->defaultLabel($request->type),
            'name'       => Str::slug($this->defaultLabel($request->type), '_') . '_' . Str::random(4),
            'required'   => false,
            'sort_order' => $form->fields()->max('sort_order') + 1,
        ]);

        return response()->json(['id' => $field->id, 'label' => $field->label, 'type' => $field->typeLabel()]);
    }

    public function updateField(Request $request, Form $form, FormField $field): JsonResponse
    {
        $this->authorise($form);
        abort_if($field->form_id !== $form->id, 403);

        $request->validate([
            'label'       => ['required', 'string', 'max:255'],
            'placeholder' => ['nullable', 'string', 'max:255'],
            'required'    => ['boolean'],
            'options_str' => ['nullable', 'string'],
        ]);

        $options = null;
        if ($field->hasOptions() && $request->filled('options_str')) {
            $options = array_values(array_filter(
                array_map('trim', explode("\n", $request->options_str))
            ));
        }

        $field->update([
            'label'       => $request->label,
            'name'        => Str::slug($request->label, '_') . '_' . substr($field->name, -4),
            'placeholder' => $request->placeholder,
            'required'    => $request->boolean('required'),
            'options'     => $options,
        ]);

        return response()->json(['label' => $field->label]);
    }

    public function destroyField(Form $form, FormField $field): JsonResponse
    {
        $this->authorise($form);
        abort_if($field->form_id !== $form->id, 403);
        $field->delete();
        return response()->json(['ok' => true]);
    }

    public function reorderFields(Request $request, Form $form): JsonResponse
    {
        $this->authorise($form);
        foreach ($request->input('order', []) as $index => $id) {
            $form->fields()->where('id', $id)->update(['sort_order' => $index]);
        }
        return response()->json(['ok' => true]);
    }

    // ── Submissions ───────────────────────────────────────────────────

    public function submissions(Form $form): View
    {
        $this->authorise($form);
        $submissions = $form->submissions()->latest()->get();
        $form->submissions()->where('read', false)->update(['read' => true]);
        return view('forms.submissions', compact('form', 'submissions'));
    }

    public function exportSubmissions(Form $form): Response
    {
        $this->authorise($form);

        $fields = $form->fields->pluck('label')->toArray();
        $output = implode(',', array_map(fn($h) => '"' . $h . '"', array_merge($fields, ['Submitted At']))) . "\n";

        foreach ($form->submissions()->latest()->get() as $sub) {
            $row = array_map(fn($f) => '"' . str_replace('"', '""', (string) ($sub->data[$f] ?? '')) . '"', $fields);
            $row[] = '"' . $sub->created_at->format('d/m/Y H:i') . '"';
            $output .= implode(',', $row) . "\n";
        }

        return response($output, 200, [
            'Content-Type'        => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . Str::slug($form->title) . '-submissions.csv"',
        ]);
    }

    // ── Helpers ───────────────────────────────────────────────────────

    private function authorise(Form $form): void
    {
        abort_if($form->organisation_id !== auth()->user()->organisation_id, 403);
        abort_unless(auth()->user()->canEdit(), 403);
    }

    private function defaultLabel(string $type): string
    {
        return match($type) {
            'text'       => 'Your Name',
            'email'      => 'Email Address',
            'phone'      => 'Phone Number',
            'textarea'   => 'Message',
            'select'     => 'Please Select',
            'checkbox'   => 'I agree',
            'checkboxes' => 'Please select all that apply',
            'radio'      => 'Please choose one',
            default      => ucfirst($type),
        };
    }

    private function applyTemplate(Form $form, string $template): void
    {
        $templates = [
            'contact' => [
                ['text',     'Your Name',        true,  null],
                ['email',    'Email Address',     true,  null],
                ['text',     'Subject',           false, null],
                ['textarea', 'Message',           true,  'How can we help?'],
            ],
            'volunteer' => [
                ['text',     'Full Name',                 true,  null],
                ['email',    'Email Address',             true,  null],
                ['phone',    'Phone Number',              false, null],
                ['text',     'Postcode',                  false, null],
                ['checkboxes','When can you volunteer?',  false, ['Weekday mornings', 'Weekday afternoons', 'Evenings', 'Weekends']],
                ['textarea', 'Tell us about yourself',    false, 'Any relevant skills, experience, or why you want to volunteer...'],
            ],
            'referral' => [
                ['text',     'Your Name (Referrer)',       true,  null],
                ['email',    'Your Email',                 true,  null],
                ['text',     'Organisation / Role',        false, null],
                ['text',     'Client First Name',          true,  null],
                ['phone',    'Client Contact Number',      false, null],
                ['textarea', 'Reason for Referral',        true,  'Please describe the support needed...'],
                ['checkbox', 'The client has given consent for this referral', true, null],
            ],
        ];

        if (! isset($templates[$template])) return;

        foreach ($templates[$template] as $i => [$type, $label, $required, $placeholder]) {
            $form->fields()->create([
                'type'        => $type,
                'label'       => $label,
                'name'        => Str::slug($label, '_') . '_' . Str::random(4),
                'placeholder' => $placeholder,
                'required'    => $required,
                'sort_order'  => $i,
            ]);
        }
    }
}
