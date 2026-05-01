<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FormField extends Model
{
    protected $fillable = [
        'form_id', 'type', 'label', 'name',
        'placeholder', 'required', 'options', 'sort_order',
    ];

    protected $casts = [
        'options'  => 'array',
        'required' => 'boolean',
    ];

    public function form(): BelongsTo
    {
        return $this->belongsTo(Form::class);
    }

    public function hasOptions(): bool
    {
        return in_array($this->type, ['select', 'radio', 'checkboxes']);
    }

    public function typeLabel(): string
    {
        return match($this->type) {
            'text'       => 'Short Text',
            'email'      => 'Email',
            'phone'      => 'Phone',
            'textarea'   => 'Long Text',
            'select'     => 'Dropdown',
            'checkbox'   => 'Checkbox',
            'checkboxes' => 'Multiple Choice',
            'radio'      => 'Single Choice',
            default      => ucfirst($this->type),
        };
    }
}
