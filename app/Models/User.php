<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'organisation_id',
        'first_name',
        'last_name',
        'email',
        'password',
        'role',
        'status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'totp_secret',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'last_login_at'     => 'datetime',
            'totp_enabled'      => 'boolean',
            'password'          => 'hashed',
        ];
    }

    public function organisation(): BelongsTo
    {
        return $this->belongsTo(Organisation::class);
    }

    public function fullName(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function isOwner(): bool    { return $this->role === 'owner'; }
    public function isAdmin(): bool    { return in_array($this->role, ['owner', 'admin']); }
    public function canPublish(): bool { return in_array($this->role, ['owner', 'admin', 'publisher']); }
    public function canEdit(): bool    { return $this->role !== 'reviewer'; }
}
