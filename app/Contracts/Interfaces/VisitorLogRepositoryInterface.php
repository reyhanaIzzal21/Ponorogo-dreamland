<?php

namespace App\Contracts\Interfaces;

use Illuminate\Support\Collection;
use Carbon\Carbon;

interface VisitorLogRepositoryInterface
{
    /**
     * Record a visitor if not already logged today.
     */
    public function recordVisitor(string $ip, ?string $page = null): void;

    /**
     * Get today's visitor count.
     */
    public function getTodayCount(): int;

    /**
     * Get yesterday's visitor count.
     */
    public function getYesterdayCount(): int;

    /**
     * Get visitor counts grouped by date for a date range.
     */
    public function getCountsByDateRange(Carbon $from, Carbon $to): Collection;
}
