<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Roadmap | VellumCMS</title>
    <link rel="stylesheet" href="/assets/styles.css">
    <meta name="description" content="See what we're building, what's coming next, and where VellumCMS is headed. We build in public.">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="VellumCMS">
    <meta property="og:title" content="Roadmap | VellumCMS">
    <meta property="og:description" content="See what we're building, what's coming next, and where VellumCMS is headed. We build in public.">
    <meta property="og:url" content="https://vellumcms.xyz/roadmap">
    <link rel="canonical" href="https://vellumcms.xyz/roadmap">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#fefefe] text-gray-800 font-sans leading-relaxed">
<?php include '../includes/header.php'; ?>

<!-- Hero -->
<section class="bg-[#0f172a] text-white py-20 px-6 text-center relative overflow-hidden">
    <div class="max-w-3xl mx-auto relative z-10">
        <p class="text-sm uppercase tracking-widest text-[#4CC9F0] mb-3 font-semibold">Roadmap</p>
        <h1 class="text-5xl md:text-6xl font-extrabold tracking-tight mb-6">Built in Public.</h1>
        <p class="text-lg md:text-xl text-gray-300 max-w-2xl mx-auto">No vague promises. No hype. Here's exactly what we're working on, what's next, and where we're headed.</p>
    </div>
    <div class="absolute inset-0 z-0 bg-gradient-to-r from-[#4361EE] via-[#4895EF] to-[#4CC9F0] opacity-10 blur-3xl"></div>
</section>

<!-- Status key -->
<section class="bg-white border-b border-gray-100 py-5 px-6">
    <div class="max-w-4xl mx-auto flex flex-wrap gap-6 justify-center text-sm">
        <span class="flex items-center gap-2"><span class="inline-block w-3 h-3 rounded-full bg-[#4361EE]"></span> Building now</span>
        <span class="flex items-center gap-2"><span class="inline-block w-3 h-3 rounded-full bg-[#F59E0B]"></span> Up next</span>
        <span class="flex items-center gap-2"><span class="inline-block w-3 h-3 rounded-full bg-gray-300"></span> Planned</span>
        <span class="flex items-center gap-2"><span class="inline-block w-3 h-3 rounded-full bg-[#10B981]"></span> Done</span>
    </div>
</section>

<!-- Timeline -->
<section class="py-20 px-6">
    <div class="max-w-4xl mx-auto">

        <!-- Phase 1 -->
        <div class="relative pl-10 mb-16">
            <div class="absolute left-0 top-1 w-5 h-5 rounded-full bg-[#4361EE] ring-4 ring-[#EEF2FF]"></div>
            <div class="absolute left-2.5 top-6 bottom-0 w-px bg-gray-200"></div>

            <div class="mb-6">
                <span class="inline-block bg-[#EEF2FF] text-[#4361EE] text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wide mb-2">Phase 1 — Foundation</span>
                <h2 class="text-2xl font-extrabold text-gray-900">Building Now</h2>
                <p class="text-gray-500 mt-1">The core infrastructure everything else depends on.</p>
            </div>

            <div class="grid md:grid-cols-2 gap-4">
                <div class="flex items-start gap-3 bg-[#F8FAFF] border border-[#E0E7FF] rounded-xl p-5">
                    <span class="mt-0.5 w-3 h-3 flex-shrink-0 rounded-full bg-[#4361EE]"></span>
                    <div>
                        <p class="font-semibold text-gray-900 text-sm">Core CMS infrastructure</p>
                        <p class="text-gray-500 text-xs mt-0.5">Routing, database schema, deployment pipeline</p>
                    </div>
                </div>
                <div class="flex items-start gap-3 bg-[#F8FAFF] border border-[#E0E7FF] rounded-xl p-5">
                    <span class="mt-0.5 w-3 h-3 flex-shrink-0 rounded-full bg-[#4361EE]"></span>
                    <div>
                        <p class="font-semibold text-gray-900 text-sm">Charity sign-up & verification</p>
                        <p class="text-gray-500 text-xs mt-0.5">UK Charity Commission API integration, auto-verify on signup</p>
                    </div>
                </div>
                <div class="flex items-start gap-3 bg-[#F8FAFF] border border-[#E0E7FF] rounded-xl p-5">
                    <span class="mt-0.5 w-3 h-3 flex-shrink-0 rounded-full bg-[#4361EE]"></span>
                    <div>
                        <p class="font-semibold text-gray-900 text-sm">User auth & roles</p>
                        <p class="text-gray-500 text-xs mt-0.5">Login, 2FA, admin/editor/reviewer/publisher roles</p>
                    </div>
                </div>
                <div class="flex items-start gap-3 bg-[#F8FAFF] border border-[#E0E7FF] rounded-xl p-5">
                    <span class="mt-0.5 w-3 h-3 flex-shrink-0 rounded-full bg-[#4361EE]"></span>
                    <div>
                        <p class="font-semibold text-gray-900 text-sm">Admin dashboard shell</p>
                        <p class="text-gray-500 text-xs mt-0.5">Navigation, settings, team management</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Phase 2 -->
        <div class="relative pl-10 mb-16">
            <div class="absolute left-0 top-1 w-5 h-5 rounded-full bg-[#F59E0B] ring-4 ring-[#FFFBEB]"></div>
            <div class="absolute left-2.5 top-6 bottom-0 w-px bg-gray-200"></div>

            <div class="mb-6">
                <span class="inline-block bg-[#FFFBEB] text-[#F59E0B] text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wide mb-2">Phase 2 — Publishing</span>
                <h2 class="text-2xl font-extrabold text-gray-900">Up Next</h2>
                <p class="text-gray-500 mt-1">The tools your team needs to publish with confidence.</p>
            </div>

            <div class="grid md:grid-cols-2 gap-4">
                <div class="flex items-start gap-3 bg-[#FFFDF5] border border-[#FEF3C7] rounded-xl p-5">
                    <span class="mt-0.5 w-3 h-3 flex-shrink-0 rounded-full bg-[#F59E0B]"></span>
                    <div>
                        <p class="font-semibold text-gray-900 text-sm">Drag-and-drop block editor</p>
                        <p class="text-gray-500 text-xs mt-0.5">Composable page blocks — hero, story, donate, petition, and more</p>
                    </div>
                </div>
                <div class="flex items-start gap-3 bg-[#FFFDF5] border border-[#FEF3C7] rounded-xl p-5">
                    <span class="mt-0.5 w-3 h-3 flex-shrink-0 rounded-full bg-[#F59E0B]"></span>
                    <div>
                        <p class="font-semibold text-gray-900 text-sm">Autosave & version history</p>
                        <p class="text-gray-500 text-xs mt-0.5">Every edit saved. Roll back to any point with one click</p>
                    </div>
                </div>
                <div class="flex items-start gap-3 bg-[#FFFDF5] border border-[#FEF3C7] rounded-xl p-5">
                    <span class="mt-0.5 w-3 h-3 flex-shrink-0 rounded-full bg-[#F59E0B]"></span>
                    <div>
                        <p class="font-semibold text-gray-900 text-sm">Media library</p>
                        <p class="text-gray-500 text-xs mt-0.5">Image uploads, optimisation, alt-text prompts built in</p>
                    </div>
                </div>
                <div class="flex items-start gap-3 bg-[#FFFDF5] border border-[#FEF3C7] rounded-xl p-5">
                    <span class="mt-0.5 w-3 h-3 flex-shrink-0 rounded-full bg-[#F59E0B]"></span>
                    <div>
                        <p class="font-semibold text-gray-900 text-sm">SEO toolkit</p>
                        <p class="text-gray-500 text-xs mt-0.5">Meta, Open Graph, JSON-LD, sitemaps — all automatic</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Phase 3 -->
        <div class="relative pl-10 mb-16">
            <div class="absolute left-0 top-1 w-5 h-5 rounded-full bg-gray-300 ring-4 ring-gray-100"></div>
            <div class="absolute left-2.5 top-6 bottom-0 w-px bg-gray-200"></div>

            <div class="mb-6">
                <span class="inline-block bg-gray-100 text-gray-500 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wide mb-2">Phase 3 — Fundraising</span>
                <h2 class="text-2xl font-extrabold text-gray-900">Planned</h2>
                <p class="text-gray-500 mt-1">Ethical donation flows with no platform fees.</p>
            </div>

            <div class="grid md:grid-cols-2 gap-4">
                <div class="flex items-start gap-3 bg-gray-50 border border-gray-200 rounded-xl p-5">
                    <span class="mt-0.5 w-3 h-3 flex-shrink-0 rounded-full bg-gray-300"></span>
                    <div>
                        <p class="font-semibold text-gray-900 text-sm">Donation pages</p>
                        <p class="text-gray-500 text-xs mt-0.5">One-time & recurring, Stripe / GoCardless / PayPal — no lock-in</p>
                    </div>
                </div>
                <div class="flex items-start gap-3 bg-gray-50 border border-gray-200 rounded-xl p-5">
                    <span class="mt-0.5 w-3 h-3 flex-shrink-0 rounded-full bg-gray-300"></span>
                    <div>
                        <p class="font-semibold text-gray-900 text-sm">Gift Aid declarations</p>
                        <p class="text-gray-500 text-xs mt-0.5">Automatic collection and compliant digital receipts</p>
                    </div>
                </div>
                <div class="flex items-start gap-3 bg-gray-50 border border-gray-200 rounded-xl p-5">
                    <span class="mt-0.5 w-3 h-3 flex-shrink-0 rounded-full bg-gray-300"></span>
                    <div>
                        <p class="font-semibold text-gray-900 text-sm">Campaign fundraising pages</p>
                        <p class="text-gray-500 text-xs mt-0.5">Progress bars, targets, social sharing — launch in minutes</p>
                    </div>
                </div>
                <div class="flex items-start gap-3 bg-gray-50 border border-gray-200 rounded-xl p-5">
                    <span class="mt-0.5 w-3 h-3 flex-shrink-0 rounded-full bg-gray-300"></span>
                    <div>
                        <p class="font-semibold text-gray-900 text-sm">Petition & action pages</p>
                        <p class="text-gray-500 text-xs mt-0.5">Rapid-response tools to rally support at speed</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Phase 4 -->
        <div class="relative pl-10">
            <div class="absolute left-0 top-1 w-5 h-5 rounded-full bg-gray-300 ring-4 ring-gray-100"></div>

            <div class="mb-6">
                <span class="inline-block bg-gray-100 text-gray-500 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wide mb-2">Phase 4 — Community & Reach</span>
                <h2 class="text-2xl font-extrabold text-gray-900">Planned</h2>
                <p class="text-gray-500 mt-1">Everything your charity needs to connect with every community.</p>
            </div>

            <div class="grid md:grid-cols-2 gap-4">
                <div class="flex items-start gap-3 bg-gray-50 border border-gray-200 rounded-xl p-5">
                    <span class="mt-0.5 w-3 h-3 flex-shrink-0 rounded-full bg-gray-300"></span>
                    <div>
                        <p class="font-semibold text-gray-900 text-sm">Multilingual publishing</p>
                        <p class="text-gray-500 text-xs mt-0.5">One site, every language, RTL support — no plugins</p>
                    </div>
                </div>
                <div class="flex items-start gap-3 bg-gray-50 border border-gray-200 rounded-xl p-5">
                    <span class="mt-0.5 w-3 h-3 flex-shrink-0 rounded-full bg-gray-300"></span>
                    <div>
                        <p class="font-semibold text-gray-900 text-sm">Privacy-first analytics</p>
                        <p class="text-gray-500 text-xs mt-0.5">Cookie-light, IP-less metrics — no surveillance</p>
                    </div>
                </div>
                <div class="flex items-start gap-3 bg-gray-50 border border-gray-200 rounded-xl p-5">
                    <span class="mt-0.5 w-3 h-3 flex-shrink-0 rounded-full bg-gray-300"></span>
                    <div>
                        <p class="font-semibold text-gray-900 text-sm">Events & RSVP</p>
                        <p class="text-gray-500 text-xs mt-0.5">Event schema, calendar feeds, ticketing integrations</p>
                    </div>
                </div>
                <div class="flex items-start gap-3 bg-gray-50 border border-gray-200 rounded-xl p-5">
                    <span class="mt-0.5 w-3 h-3 flex-shrink-0 rounded-full bg-gray-300"></span>
                    <div>
                        <p class="font-semibold text-gray-900 text-sm">Forms, directories & CRM-lite</p>
                        <p class="text-gray-500 text-xs mt-0.5">Volunteer intake, supporter database, CSV export</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

<!-- CTA -->
<section class="bg-[#0f172a] text-white py-20 px-6 text-center">
    <div class="max-w-2xl mx-auto">
        <h2 class="text-3xl font-extrabold mb-4">Want to shape the roadmap?</h2>
        <p class="text-gray-300 text-lg mb-8">Join the waitlist and we'll keep you posted as each phase ships. Early access orgs get a say in what gets built first.</p>
        <a href="/get-started" class="bg-white text-[#0f172a] px-8 py-3 rounded-full font-bold hover:bg-gray-100 transition">
            Join the Waitlist
        </a>
    </div>
</section>

<?php include '../includes/footer.php'; ?>
</body>
</html>
