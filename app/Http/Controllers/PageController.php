<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use App\Models\Page;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class PageController extends Controller
{
    public function index(): View
    {
        $pages = auth()->user()->organisation
            ->pages()
            ->orderByDesc('is_homepage')
            ->latest()
            ->get();

        return view('pages.index', compact('pages'));
    }

    public function create(): View
    {
        return view('pages.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $org        = auth()->user()->organisation;
        $isHomepage = $request->boolean('is_homepage');

        $validated = $request->validate([
            'title'            => ['required', 'string', 'max:255'],
            'slug'             => $isHomepage
                                    ? ['nullable', 'string', 'max:255']
                                    : ['required', 'string', 'max:255', 'alpha_dash',
                                       Rule::unique('pages')->where('organisation_id', $org->id)],
            'content'          => ['nullable', 'string'],
            'meta_title'       => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string', 'max:500'],
        ]);

        if ($isHomepage) {
            $org->pages()->update(['is_homepage' => false]);
        }

        $page = Page::create([
            ...$validated,
            'organisation_id' => $org->id,
            'created_by'      => auth()->id(),
            'status'          => 'draft',
            'is_homepage'     => $isHomepage,
            'slug'            => $isHomepage ? '' : $validated['slug'],
        ]);

        AuditLog::record('page.created', $org->id, auth()->id(), [
            'page'        => $page->title,
            'is_homepage' => $isHomepage,
        ]);

        return redirect()->route('pages.edit', $page)->with('status', 'Page created.');
    }

    public function edit(Page $page): View
    {
        $this->authorise($page);
        return view('pages.edit', compact('page'));
    }

    public function preview(Page $page): View
    {
        $this->authorise($page);
        return view('pages.preview', compact('page'));
    }

    public function update(Request $request, Page $page): RedirectResponse
    {
        $this->authorise($page);

        $isHomepage = $request->boolean('is_homepage');

        $validated = $request->validate([
            'title'            => ['required', 'string', 'max:255'],
            'slug'             => $isHomepage
                                    ? ['nullable', 'string', 'max:255']
                                    : ['required', 'string', 'max:255', 'alpha_dash',
                                       Rule::unique('pages')->where('organisation_id', $page->organisation_id)->ignore($page->id)],
            'content'          => ['nullable', 'string'],
            'meta_title'       => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string', 'max:500'],
        ]);

        if ($isHomepage && ! $page->is_homepage) {
            $page->organisation->pages()->where('id', '!=', $page->id)->update(['is_homepage' => false]);
        }

        $page->update([
            ...$validated,
            'is_homepage' => $isHomepage,
            'slug'        => $isHomepage ? '' : $validated['slug'],
        ]);

        AuditLog::record('page.updated', $page->organisation_id, auth()->id(), ['page' => $page->title]);

        return back()->with('status', 'Page saved.');
    }

    public function publish(Page $page): RedirectResponse
    {
        $this->authorise($page);
        abort_unless(auth()->user()->canPublish(), 403);

        $page->update([
            'status'       => 'published',
            'published_at' => $page->published_at ?? now(),
        ]);

        AuditLog::record('page.published', $page->organisation_id, auth()->id(), ['page' => $page->title]);

        return back()->with('status', '"' . $page->title . '" published.');
    }

    public function unpublish(Page $page): RedirectResponse
    {
        $this->authorise($page);
        abort_unless(auth()->user()->canPublish(), 403);

        $page->update(['status' => 'draft']);

        AuditLog::record('page.unpublished', $page->organisation_id, auth()->id(), ['page' => $page->title]);

        return back()->with('status', '"' . $page->title . '" moved back to draft.');
    }

    public function destroy(Page $page): RedirectResponse
    {
        $this->authorise($page);
        abort_unless(auth()->user()->isAdmin(), 403);

        $title = $page->title;
        $page->delete();

        AuditLog::record('page.deleted', $page->organisation_id, auth()->id(), ['page' => $title]);

        return redirect()->route('pages.index')
            ->with('status', '"' . $title . '" deleted.');
    }

    private function authorise(Page $page): void
    {
        abort_if($page->organisation_id !== auth()->user()->organisation_id, 403);
        abort_unless(auth()->user()->canEdit(), 403);
    }
}
