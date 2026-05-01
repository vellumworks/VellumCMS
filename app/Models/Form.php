<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Form extends Model
{
    protected $fillable = [
        'organisation_id', 'created_by', 'title', 'slug',
        'description', 'submit_button_label', 'success_message',
        'notify_email', 'status',
    ];

    public function organisation(): BelongsTo
    {
        return $this->belongsTo(Organisation::class);
    }

    public function fields(): HasMany
    {
        return $this->hasMany(FormField::class)->orderBy('sort_order');
    }

    public function submissions(): HasMany
    {
        return $this->hasMany(FormSubmission::class);
    }

    public function isActive(): bool
    {
        return $this->status === 'active';
    }

    public function unreadCount(): int
    {
        return $this->submissions()->where('read', false)->count();
    }
}
