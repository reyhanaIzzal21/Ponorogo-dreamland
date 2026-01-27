<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PoolTimelineStage extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'period',
        'status',
        'progress_percentage',
        'description',
        'sort_order',
    ];

    public function photos(): HasMany
    {
        return $this->hasMany(PoolTimelinePhoto::class);
    }
}
