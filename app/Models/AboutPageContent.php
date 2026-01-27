<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutPageContent extends Model
{
    use HasFactory;

    protected $fillable = [
        'hero_title',
        'hero_subtitle',
        'hero_blob_image',
        'story_1_title',
        'story_1_description',
        'story_1_image',
        'story_2_title',
        'story_2_description',
        'story_2_image',
        'story_3_title',
        'story_3_description',
        'story_3_image',
        'value_1_title',
        'value_1_description',
        'value_2_title',
        'value_2_description',
        'value_3_title',
        'value_3_description',
        'stat_1_label',
        'stat_1_value',
        'stat_2_label',
        'stat_2_value',
        'stat_3_label',
        'stat_3_value',
        'founder_quote',
        'founder_job',
        'founder_sub_job',
    ];
}
