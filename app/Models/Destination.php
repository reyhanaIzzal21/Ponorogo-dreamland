<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Destination extends Model
{
    use HasFactory, HasUuids;

    /**
     * Status Constants
     */
    public const STATUS_OPEN = 'open';
    public const STATUS_CLOSED = 'closed';
    public const STATUS_SOON = 'soon';
    public const STATUS_MAINTENANCE = 'maintenance';

    /**
     * Type Constants
     */
    public const TYPE_RESTAURANT = 'restaurant';
    public const TYPE_VENUE = 'venue';
    public const TYPE_RECREATION = 'recreation';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'slug',
        'description',
        'type',
        'status',
        'cover_image',
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
     * Get all available statuses with labels.
     *
     * @return array<string, string>
     */
    public static function getStatuses(): array
    {
        return [
            self::STATUS_OPEN => 'Open',
            self::STATUS_CLOSED => 'Closed',
            self::STATUS_SOON => 'Coming Soon',
            self::STATUS_MAINTENANCE => 'Maintenance',
        ];
    }

    /**
     * Get all available types with labels.
     *
     * @return array<string, string>
     */
    public static function getTypes(): array
    {
        return [
            self::TYPE_RESTAURANT => 'F&B (Resto)',
            self::TYPE_VENUE => 'Venue (Gedung)',
            self::TYPE_RECREATION => 'Recreation (Wisata)',
        ];
    }

    /**
     * Get the status label attribute.
     *
     * @return string
     */
    public function getStatusLabelAttribute(): string
    {
        return self::getStatuses()[$this->status] ?? $this->status;
    }

    /**
     * Get the type label attribute.
     *
     * @return string
     */
    public function getTypeLabelAttribute(): string
    {
        return self::getTypes()[$this->type] ?? $this->type;
    }

    /**
     * Get the cover image URL attribute.
     *
     * @return string|null
     */
    public function getCoverImageUrlAttribute(): ?string
    {
        if (!$this->cover_image) {
            return null;
        }

        return asset('storage/' . $this->cover_image);
    }

    /**
     * Check if destination is open.
     *
     * @return bool
     */
    public function isOpen(): bool
    {
        return $this->status === self::STATUS_OPEN;
    }

    /**
     * Check if destination can be reserved.
     *
     * @return bool
     */
    public function canBeReserved(): bool
    {
        return $this->isOpen() && $this->is_active;
    }

    /**
     * Scope a query to only include active destinations.
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
     * Scope a query to only include open destinations.
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeOpen(Builder $query): Builder
    {
        return $query->where('status', self::STATUS_OPEN);
    }
}
