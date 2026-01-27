<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PoolSneakPeek extends Model
{
    use HasFactory;

    protected $fillable = [
        'slot_number',
        'title',
        'description',
        'image_path',
        'icon',
    ];
}
