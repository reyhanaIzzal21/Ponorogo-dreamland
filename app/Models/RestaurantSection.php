<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class RestaurantSection extends Model
{
    use HasFactory, HasUuids;

    /**
     * Section Type Constants
     */
    public const TYPE_HERO = 'hero';
    public const TYPE_FILOSOFI = 'filosofi';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'section_type',
        'title',
        'subtitle',
        'description',
        'extra_data',
        'sort_order',
        'is_active',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'extra_data' => 'array',
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    /**
     * Get all available section types.
     *
     * @return array<string, string>
     */
    public static function getSectionTypes(): array
    {
        return [
            self::TYPE_HERO => 'Hero Section',
            self::TYPE_FILOSOFI => 'Filosofi Kami',
        ];
    }

    /**
     * Get extra data value by key.
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public function getExtraValue(string $key, mixed $default = null): mixed
    {
        return $this->extra_data[$key] ?? $default;
    }

    /**
     * Set extra data value by key.
     *
     * @param string $key
     * @param mixed $value
     * @return void
     */
    public function setExtraValue(string $key, mixed $value): void
    {
        $extraData = $this->extra_data ?? [];
        $extraData[$key] = $value;
        $this->extra_data = $extraData;
    }

    /**
     * Get background image URL from extra_data.
     *
     * @return string|null
     */
    public function getBackgroundImageAttribute(): ?string
    {
        return $this->getExtraValue('background_image');
    }

    /**
     * Get Instagram username from extra_data.
     *
     * @return string|null
     */
    public function getInstagramUsernameAttribute(): ?string
    {
        return $this->getExtraValue('instagram_username');
    }

    /**
     * Get Instagram URL from extra_data.
     *
     * @return string|null
     */
    public function getInstagramUrlAttribute(): ?string
    {
        return $this->getExtraValue('instagram_url');
    }

    /**
     * Scope a query to only include active sections.
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope a query to order by sort_order.
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order');
    }

    /**
     * Scope a query to filter by section type.
     *
     * @param Builder $query
     * @param string $type
     * @return Builder
     */
    public function scopeOfType(Builder $query, string $type): Builder
    {
        return $query->where('section_type', $type);
    }
}
