<?php

namespace App\Http\Middleware;

use App\Http\Controllers\SiteController;
use App\Models\Organisation;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DetectCharitySite
{
    /** Platform domains that should never be handled as charity sites */
    private array $platformDomains = [
        'vellumcms.com',
        'www.vellumcms.com',
        'app.vellumcms.com',
    ];

    public function handle(Request $request, Closure $next): Response
    {
        $host = $request->getHost();

        // Skip platform domains and localhost/test server
        if (in_array($host, $this->platformDomains) || str_contains($host, 'sandboxprojects.info')) {
            return $next($request);
        }

        // Check custom domain
        $org = Organisation::where('custom_domain', $host)
            ->where('status', 'verified')
            ->first();

        // Check subdomain (slug.vellumcms.com)
        if (! $org) {
            $parts = explode('.', $host);
            if (count($parts) >= 3) {
                $org = Organisation::where('slug', $parts[0])
                    ->where('status', 'verified')
                    ->first();
            }
        }

        if (! $org) {
            return $next($request);
        }

        // Route to the site controller
        $path = trim($request->getPathInfo(), '/');

        if ($path === '') {
            return app(SiteController::class)->home($request);
        }

        return app(SiteController::class)->page($request, $path);
    }
}
