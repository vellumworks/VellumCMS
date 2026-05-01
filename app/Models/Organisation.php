<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Organisation extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'charity_number',
        'org_type',
        'status',
        'custom_domain',
        'settings',
    ];

    protected $casts = [
        'settings' => 'array',
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function pages(): HasMany
    {
        return $this->hasMany(Page::class);
    }

    public function auditLog(): HasMany
    {
        return $this->hasMany(AuditLog::class);
    }

    public function isVerified(): bool
    {
        return $this->status === 'verified';
    }

    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    /** Default subdomain URL before a custom domain is connected */
    public function subdomainUrl(): string
    {
        return "https://{$this->slug}.vellumcms.com";
    }
}
