<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'whatsapp_number',
        'instagram_url',
        'tiktok_url',
        'address',
        'maps_embed_url',
    ];
}
