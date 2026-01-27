<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PoolTimelinePhoto extends Model
{
    use HasFactory;

    protected $fillable = [
        'pool_timeline_stage_id',
        'image_path',
    ];

    public function stage(): BelongsTo
    {
        return $this->belongsTo(PoolTimelineStage::class, 'pool_timeline_stage_id');
    }
}
