<?php

namespace App\Http\Controllers;

use App\Models\Organisation;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class SiteController extends Controller
{
    /**
     * Resolve the organisation from the incoming request.
     * Checks custom domain first, then subdomain, then slug param.
     */
    public static function resolveOrg(Request $request, ?string $slug = null): ?Organisation
    {
        $host = $request->getHost();

        // Custom domain match
        $org = Organisation::where('custom_domain', $host)
            ->where('status', 'verified')
            ->first();

        if ($org) return $org;

        // Subdomain match (e.g. charity-slug.vellumcms.com)
        $parts = explode('.', $host);
        if (count($parts) >= 3) {
            $org = Organisation::where('slug', $parts[0])
                ->where('status', 'verified')
                ->first();
            if ($org) return $org;
        }

        // Fallback: slug passed explicitly (test server /sites/{slug})
        if ($slug) {
            return Organisation::where('slug', $slug)
                ->where('status', 'verified')
                ->first();
        }

        return null;
    }

    /** Homepage */
    public function home(Request $request, ?string $slug = null): View|Response
    {
        $org = self::resolveOrg($request, $slug);

        if (! $org) {
            return response(view('site.404', ['message' => 'Organisation not found.']), 404);
        }

        $page = $org->pages()
            ->where('is_homepage', true)
            ->where('status', 'published')
            ->first();

        if (! $page) {
            // Fall back to first published page
            $page = $org->pages()->where('status', 'published')->first();
        }

        $nav = $org->pages()->where('status', 'published')->orderBy('title')->get();

        return view('site.page', compact('org', 'page', 'nav'));
    }

    /** Any other page by slug */
    public function page(Request $request, string $slugOrOrg, ?string $pageSlug = null): View|Response
    {
        // When called from /sites/{orgSlug}/{pageSlug}
        if ($pageSlug !== null) {
            $org = self::resolveOrg($request, $slugOrOrg);
            $slug = $pageSlug;
        } else {
            // When called from domain-based routing /{pageSlug}
            $org  = self::resolveOrg($request);
            $slug = $slugOrOrg;
        }

        if (! $org) {
            return response(view('site.404', ['message' => 'Organisation not found.']), 404);
        }

        $page = $org->pages()
            ->where('slug', $slug)
            ->where('status', 'published')
            ->first();

        if (! $page) {
            return response(view('site.404', ['org' => $org, 'message' => 'Page not found.']), 404);
        }

        $nav = $org->pages()->where('status', 'published')->orderBy('title')->get();

        return view('site.page', compact('org', 'page', 'nav'));
    }
}
