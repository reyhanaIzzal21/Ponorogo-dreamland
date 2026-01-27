<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PoolContent extends Model
{
    use HasFactory;

    protected $fillable = [
        'badge_text',
        'main_headline',
        'blue_headline',
        'sub_headline',
        'launch_date',
        'teaser_background',
    ];

    protected $casts = [
        'launch_date' => 'date',
    ];
}
