<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MenuCategory extends Model
{
    use HasFactory, HasUuids;

    /**
     * Category Types Constants
     */
    public const TYPE_GRID_PROMO = 'grid-promo';
    public const TYPE_PACKAGE_LIST = 'package-list';
    public const TYPE_GRID_PHOTO = 'grid-photo';
    public const TYPE_GRID_PHOTO_SMALL = 'grid-photo-small';
    public const TYPE_PRICE_GROUP = 'price-group';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'slug',
        'name',
        'type',
        'icon',
        'sort_order',
        'is_active',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    /**
     * Get all available types.
     *
     * @return array<string, string>
     */
    public static function getTypes(): array
    {
        return [
            self::TYPE_GRID_PROMO => 'Grid Besar (Promo)',
            self::TYPE_PACKAGE_LIST => 'List Paket (Teks)',
            self::TYPE_GRID_PHOTO => 'Grid Standar',
            self::TYPE_GRID_PHOTO_SMALL => 'Grid Kecil',
            self::TYPE_PRICE_GROUP => 'Grouping Harga',
        ];
    }

    /**
     * Get the type label.
     *
     * @return string
     */
    public function getTypeLabelAttribute(): string
    {
        return self::getTypes()[$this->type] ?? $this->type;
    }

    /**
     * Get the menu items for this category.
     */
    public function items(): HasMany
    {
        return $this->hasMany(MenuItem::class)
            ->where('is_active', true)
            ->orderBy('sort_order');
    }

    /**
     * Get all menu items including inactive.
     */
    public function allItems(): HasMany
    {
        return $this->hasMany(MenuItem::class)
            ->orderBy('sort_order');
    }

    /**
     * Get the price groups for this category (for price-group type).
     */
    public function priceGroups(): HasMany
    {
        return $this->hasMany(MenuPriceGroup::class)
            ->where('is_active', true)
            ->orderBy('sort_order');
    }

    /**
     * Get all price groups including inactive.
     */
    public function allPriceGroups(): HasMany
    {
        return $this->hasMany(MenuPriceGroup::class)
            ->orderBy('sort_order');
    }

    /**
     * Scope a query to only include active categories.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope a query to order by sort_order.
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }

    /**
     * Check if category is price-group type.
     */
    public function isPriceGroupType(): bool
    {
        return $this->type === self::TYPE_PRICE_GROUP;
    }

    /**
     * Check if category requires images.
     */
    public function requiresImages(): bool
    {
        return in_array($this->type, [
            self::TYPE_GRID_PROMO,
            self::TYPE_GRID_PHOTO,
            self::TYPE_GRID_PHOTO_SMALL,
        ]);
    }
}
