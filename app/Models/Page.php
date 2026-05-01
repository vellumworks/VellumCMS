<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Page extends Model
{
    protected $fillable = [
        'organisation_id',
        'created_by',
        'title',
        'slug',
        'content',
        'status',
        'is_homepage',
        'meta_title',
        'meta_description',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'is_homepage'  => 'boolean',
    ];

    public function organisation(): BelongsTo
    {
        return $this->belongsTo(Organisation::class);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function isPublished(): bool
    {
        return $this->status === 'published';
    }
}
