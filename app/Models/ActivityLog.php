<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ActivityLog extends Model
{
    use HasFactory;

    public const ACTION_CREATE = 'create';
    public const ACTION_UPDATE = 'update';
    public const ACTION_DELETE = 'delete';

    protected $fillable = [
        'user_id',
        'action',
        'entity_type',
        'entity_id',
        'description',
    ];

    /**
     * Get the user that performed the action.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get action label for display.
     */
    public function getActionLabelAttribute(): string
    {
        return match ($this->action) {
            self::ACTION_CREATE => 'Tambah',
            self::ACTION_UPDATE => 'Update',
            self::ACTION_DELETE => 'Hapus',
            default => ucfirst($this->action),
        };
    }

    /**
     * Get action color for display.
     */
    public function getActionColorAttribute(): string
    {
        return match ($this->action) {
            self::ACTION_CREATE => 'blue',
            self::ACTION_UPDATE => 'yellow',
            self::ACTION_DELETE => 'red',
            default => 'gray',
        };
    }

    /**
     * Get time ago string.
     */
    public function getTimeAgoAttribute(): string
    {
        return $this->created_at->diffForHumans();
    }
}
