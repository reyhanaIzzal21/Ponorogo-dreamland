<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class MenuItem extends Model
{
    use HasFactory, HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'menu_category_id',
        'name',
        'slug',
        'description',
        'price',
        'price_suffix',
        'image_path',
        'is_promo',
        'promo_badge',
        'sort_order',
        'is_active',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'price' => 'decimal:2',
        'is_promo' => 'boolean',
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    /**
     * Get the category that owns this item.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(MenuCategory::class, 'menu_category_id');
    }

    /**
     * Get the package contents for this item (for package-list type).
     */
    public function packageContents(): HasMany
    {
        return $this->hasMany(MenuPackageContent::class)
            ->orderBy('sort_order');
    }

    /**
     * Get formatted price with suffix.
     *
     * @return string
     */
    public function getFormattedPriceAttribute(): string
    {
        $formatted = 'Rp ' . number_format((float) $this->price, 0, ',', '.');

        if ($this->price_suffix) {
            $formatted .= $this->price_suffix;
        }

        return $formatted;
    }

    /**
     * Get the image URL.
     *
     * @return string|null
     */
    public function getImageUrlAttribute(): ?string
    {
        if (!$this->image_path) {
            return null;
        }

        // If it's an external URL, return as is
        if (filter_var($this->image_path, FILTER_VALIDATE_URL)) {
            return $this->image_path;
        }

        // Return storage URL
        return Storage::url($this->image_path);
    }

    /**
     * Scope a query to only include active items.
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
     * Scope a query to only include promo items.
     */
    public function scopePromo($query)
    {
        return $query->where('is_promo', true);
    }

    /**
     * Check if item has package contents.
     */
    public function hasPackageContents(): bool
    {
        return $this->packageContents()->exists();
    }

    /**
     * Get package contents as array of names.
     *
     * @return array<string>
     */
    public function getPackageContentsArrayAttribute(): array
    {
        return $this->packageContents->pluck('content_name')->toArray();
    }
}
