<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RestaurantBestSeller extends Model
{
    use HasFactory, HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'menu_item_id',
        'slot_number',
        'is_active',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'slot_number' => 'integer',
        'is_active' => 'boolean',
    ];

    /**
     * Get the menu item for this best seller slot.
     *
     * @return BelongsTo
     */
    public function menuItem(): BelongsTo
    {
        return $this->belongsTo(MenuItem::class);
    }

    /**
     * Scope a query to only include active best sellers.
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope a query to order by slot number.
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('slot_number');
    }

    /**
     * Scope a query to filter by slot number.
     *
     * @param Builder $query
     * @param int $slot
     * @return Builder
     */
    public function scopeSlot(Builder $query, int $slot): Builder
    {
        return $query->where('slot_number', $slot);
    }
}
