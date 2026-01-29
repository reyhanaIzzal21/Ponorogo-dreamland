<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;

class VisitorLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'ip_address',
        'page_visited',
        'visit_date',
    ];

    protected $casts = [
        'visit_date' => 'date',
    ];

    /**
     * Scope to filter by today's date.
     */
    public function scopeToday(Builder $query): Builder
    {
        return $query->where('visit_date', Carbon::today()->toDateString());
    }

    /**
     * Scope to filter by yesterday's date.
     */
    public function scopeYesterday(Builder $query): Builder
    {
        return $query->where('visit_date', Carbon::yesterday()->toDateString());
    }

    /**
     * Scope to filter by date range.
     */
    public function scopeDateRange(Builder $query, Carbon $from, Carbon $to): Builder
    {
        return $query->whereBetween('visit_date', [$from->toDateString(), $to->toDateString()]);
    }
}
