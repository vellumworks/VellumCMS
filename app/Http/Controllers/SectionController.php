<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Section;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    private const TYPES = [
        'hero', 'text', 'image_text', 'impact_stats',
        'cta', 'donation_cta', 'events_list', 'get_involved',
    ];

    public function store(Request $request, Page $page): JsonResponse
    {
        abort_if($page->organisation_id !== auth()->user()->organisation_id, 403);
        abort_unless(auth()->user()->canEdit(), 403);

        $request->validate(['type' => ['required', 'in:' . implode(',', self::TYPES)]]);

        $section = $page->sections()->create([
            'type'       => $request->type,
            'content'    => $this->defaults($request->type),
            'sort_order' => $page->sections()->max('sort_order') + 1,
        ]);

        return response()->json([
            'id'      => $section->id,
            'type'    => $section->type,
            'label'   => $section->label(),
            'preview' => $section->preview(),
        ]);
    }

    public function update(Request $request, Section $section): JsonResponse
    {
        abort_if($section->page->organisation_id !== auth()->user()->organisation_id, 403);
        abort_unless(auth()->user()->canEdit(), 403);

        $content = $this->processContent($section->type, $request->all());
        $section->update(['content' => $content]);

        return response()->json([
            'preview' => $section->fresh()->preview(),
        ]);
    }

    public function destroy(Section $section): JsonResponse
    {
        abort_if($section->page->organisation_id !== auth()->user()->organisation_id, 403);
        abort_unless(auth()->user()->isAdmin(), 403);

        $section->delete();

        return response()->json(['ok' => true]);
    }

    public function reorder(Request $request, Page $page): JsonResponse
    {
        abort_if($page->organisation_id !== auth()->user()->organisation_id, 403);

        foreach ($request->input('order', []) as $index => $id) {
            $page->sections()->where('id', $id)->update(['sort_order' => $index]);
        }

        return response()->json(['ok' => true]);
    }

    // ----------------------------------------------------------------
    // Defaults for each type on creation
    // ----------------------------------------------------------------

    private function defaults(string $type): array
    {
        return match($type) {
            'hero' => [
                'headline'     => 'Making a Difference in Our Community',
                'subtext'      => 'Tell your story here — who you help, how you help, and why it matters.',
                'button_label' => 'Get Involved',
                'button_url'   => '/get-involved',
                'style'        => 'dark',
            ],
            'text' => [
                'content' => '',
            ],
            'image_text' => [
                'image_url'    => '',
                'alt_text'     => '',
                'heading'      => 'Our Work in Action',
                'text'         => 'Share the story behind your work. Who are the people you support? What difference does your organisation make day to day?',
                'image_side'   => 'left',
                'button_label' => '',
                'button_url'   => '',
            ],
            'impact_stats' => [
                'heading' => 'Our Impact This Year',
                'subtext' => '',
                'stats'   => [
                    ['number' => '0', 'label' => 'People Supported', 'colour' => '#4361EE'],
                    ['number' => '0', 'label' => 'Volunteer Hours',  'colour' => '#10B981'],
                    ['number' => '0', 'label' => 'Meals Delivered',  'colour' => '#EA580C'],
                ],
            ],
            'cta' => [
                'heading'      => 'Ready to Make a Difference?',
                'subtext'      => 'Your support helps us reach more people who need it.',
                'button_label' => 'Get Involved',
                'button_url'   => '',
                'style'        => 'primary',
            ],
            'donation_cta' => [
                'heading'      => 'Support Our Work',
                'subtext'      => 'Every pound goes directly to the people we serve. No waste, no overhead.',
                'amounts'      => [5, 10, 25, 50],
                'button_label' => 'Donate Now',
                'donation_url' => '',
                'gift_aid'     => true,
            ],
            'events_list' => [
                'heading'       => 'Upcoming Events',
                'limit'         => 3,
                'show_all_link' => true,
            ],
            'get_involved' => [
                'heading' => 'Ways You Can Help',
                'subtext' => 'Whether you have time, money, or skills — there is a place for you.',
                'options' => [
                    ['type' => 'volunteer', 'title' => 'Volunteer', 'text' => 'Give your time and make a direct impact in your community.', 'button_label' => 'Start Volunteering', 'button_url' => '', 'colour' => '#4361EE'],
                    ['type' => 'donate',    'title' => 'Donate',    'text' => 'A regular gift, however small, helps us plan for the future.', 'button_label' => 'Donate Today', 'button_url' => '', 'colour' => '#10B981'],
                    ['type' => 'fundraise', 'title' => 'Fundraise', 'text' => 'Run an event, challenge yourself, and raise vital funds for our cause.', 'button_label' => 'Start Fundraising', 'button_url' => '', 'colour' => '#EA580C'],
                ],
            ],
            default => [],
        };
    }

    // ----------------------------------------------------------------
    // Process and sanitise content from form POST
    // ----------------------------------------------------------------

    private function processContent(string $type, array $data): array
    {
        return match($type) {
            'hero' => [
                'headline'     => $data['headline'] ?? '',
                'subtext'      => $data['subtext'] ?? '',
                'button_label' => $data['button_label'] ?? '',
                'button_url'   => $data['button_url'] ?? '',
                'style'        => in_array($data['style'] ?? '', ['dark', 'light']) ? $data['style'] : 'dark',
            ],
            'text' => [
                'content' => $data['content'] ?? '',
            ],
            'image_text' => [
                'image_url'    => $data['image_url'] ?? '',
                'alt_text'     => $data['alt_text'] ?? '',
                'heading'      => $data['heading'] ?? '',
                'text'         => $data['text'] ?? '',
                'image_side'   => in_array($data['image_side'] ?? '', ['left', 'right']) ? $data['image_side'] : 'left',
                'button_label' => $data['button_label'] ?? '',
                'button_url'   => $data['button_url'] ?? '',
            ],
            'impact_stats' => [
                'heading' => $data['heading'] ?? '',
                'subtext' => $data['subtext'] ?? '',
                'stats'   => array_values(array_filter(
                    array_map(fn($s) => [
                        'number' => $s['number'] ?? '',
                        'label'  => $s['label'] ?? '',
                        'colour' => $s['colour'] ?? '#4361EE',
                    ], $data['stats'] ?? []),
                    fn($s) => $s['number'] !== '' || $s['label'] !== ''
                )),
            ],
            'cta' => [
                'heading'      => $data['heading'] ?? '',
                'subtext'      => $data['subtext'] ?? '',
                'button_label' => $data['button_label'] ?? '',
                'button_url'   => $data['button_url'] ?? '',
                'style'        => in_array($data['style'] ?? '', ['primary', 'urgent', 'minimal']) ? $data['style'] : 'primary',
            ],
            'donation_cta' => [
                'heading'      => $data['heading'] ?? '',
                'subtext'      => $data['subtext'] ?? '',
                'amounts'      => array_values(array_filter(array_map('intval', explode(',', $data['amounts_str'] ?? '5,10,25,50')), fn($v) => $v > 0)),
                'button_label' => $data['button_label'] ?? 'Donate Now',
                'donation_url' => $data['donation_url'] ?? '',
                'gift_aid'     => isset($data['gift_aid']),
            ],
            'events_list' => [
                'heading'       => $data['heading'] ?? '',
                'limit'         => max(1, min(12, (int) ($data['limit'] ?? 3))),
                'show_all_link' => isset($data['show_all_link']),
            ],
            'get_involved' => [
                'heading' => $data['heading'] ?? '',
                'subtext' => $data['subtext'] ?? '',
                'options' => array_map(fn($o) => [
                    'type'         => $o['type'] ?? 'volunteer',
                    'title'        => $o['title'] ?? '',
                    'text'         => $o['text'] ?? '',
                    'button_label' => $o['button_label'] ?? '',
                    'button_url'   => $o['button_url'] ?? '',
                    'colour'       => $o['colour'] ?? '#4361EE',
                ], $data['options'] ?? []),
            ],
            default => [],
        };
    }
}
