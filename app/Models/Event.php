<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{
    protected $fillable = [
        'organisation_id', 'created_by', 'title', 'slug', 'description',
        'start_date', 'end_date', 'start_time', 'end_time',
        'location', 'is_online', 'online_url', 'image_url',
        'capacity', 'status', 'meta_title', 'meta_description',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date'   => 'date',
        'is_online'  => 'boolean',
    ];

    public function organisation(): BelongsTo
    {
        return $this->belongsTo(Organisation::class);
    }

    public function registrations(): HasMany
    {
        return $this->hasMany(EventRegistration::class);
    }

    public function isPublished(): bool { return $this->status === 'published'; }

    public function spotsLeft(): ?int
    {
        if (! $this->capacity) return null;
        $taken = $this->registrations()->where('status', '!=', 'cancelled')->count();
        return max(0, $this->capacity - $taken);
    }

    public function isFull(): bool
    {
        if (! $this->capacity) return false;
        return $this->spotsLeft() === 0;
    }

    public function isPast(): bool
    {
        return $this->start_date->isPast();
    }

    public function dateRange(): string
    {
        if (! $this->end_date || $this->end_date->eq($this->start_date)) {
            return $this->start_date->format('d M Y');
        }
        return $this->start_date->format('d M') . ' – ' . $this->end_date->format('d M Y');
    }

    public function timeRange(): string
    {
        if (! $this->start_time) return '';
        $t = date('g:ia', strtotime($this->start_time));
        if ($this->end_time) $t .= ' – ' . date('g:ia', strtotime($this->end_time));
        return $t;
    }
}
