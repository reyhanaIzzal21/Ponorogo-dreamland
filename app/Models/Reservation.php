<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Builder;

class Reservation extends Model
{
    use HasFactory, HasUuids;

    public const STATUS_PENDING = 'pending';
    public const STATUS_CONFIRMED = 'confirmed';
    public const STATUS_CANCELLED = 'cancelled';
    public const STATUS_COMPLETED = 'completed';

    protected $fillable = [
        'destination_id',
        'user_name',
        'user_whatsapp',
        'reservation_date',
        'number_of_people',
        'needs',
        'notes',
        'wa_sent',
        'wa_sent_at',
        'wa_error',
    ];

    protected $casts = [
        'reservation_date' => 'date',
        'number_of_people' => 'integer',
        'wa_sent' => 'boolean',
        'wa_sent_at' => 'datetime',
    ];

    public function destination(): BelongsTo
    {
        return $this->belongsTo(Destination::class);
    }
}
