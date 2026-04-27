<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AuditLog extends Model
{
    public $timestamps = false;

    protected $table = 'audit_log';

    protected $fillable = [
        'organisation_id',
        'user_id',
        'action',
        'target_type',
        'target_id',
        'meta',
        'ip_address',
    ];

    protected $casts = [
        'meta'       => 'array',
        'created_at' => 'datetime',
    ];

    public function organisation(): BelongsTo
    {
        return $this->belongsTo(Organisation::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public static function record(
        string $action,
        ?int $organisationId = null,
        ?int $userId = null,
        array $meta = [],
    ): void {
        static::create([
            'action'          => $action,
            'organisation_id' => $organisationId,
            'user_id'         => $userId,
            'meta'            => $meta ?: null,
            'ip_address'      => request()->ip(),
        ]);
    }
}
