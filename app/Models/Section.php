<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Section extends Model
{
    protected $fillable = ['page_id', 'type', 'content', 'sort_order'];

    protected $casts = ['content' => 'array'];

    public function page(): BelongsTo
    {
        return $this->belongsTo(Page::class);
    }

    /** Human-readable type label */
    public function label(): string
    {
        return match($this->type) {
            'hero'          => 'Hero',
            'text'          => 'Text Block',
            'image_text'    => 'Image + Text',
            'impact_stats'  => 'Impact Stats',
            'cta'           => 'Call to Action',
            'donation_cta'  => 'Donation CTA',
            'events_list'   => 'Events List',
            'get_involved'  => 'Get Involved',
            default         => ucfirst(str_replace('_', ' ', $this->type)),
        };
    }

    /** Short preview text for the editor card */
    public function preview(): string
    {
        return match($this->type) {
            'hero'         => $this->content['headline'] ?? '',
            'text'         => strip_tags($this->content['content'] ?? ''),
            'image_text'   => $this->content['heading'] ?? '',
            'impact_stats' => ($this->content['heading'] ?? '') ?: count($this->content['stats'] ?? []) . ' stats',
            'cta'          => $this->content['heading'] ?? '',
            'donation_cta' => $this->content['heading'] ?? 'Donation prompt',
            'events_list'  => 'Shows upcoming events',
            'get_involved' => $this->content['heading'] ?? 'Ways to support',
            default        => '',
        };
    }
}
