<?php

namespace App\Contracts\Repositories;

use App\Contracts\Interfaces\VisitorLogRepositoryInterface;
use App\Models\VisitorLog;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class VisitorLogRepository implements VisitorLogRepositoryInterface
{
    /**
     * Record a visitor if not already logged today.
     */
    public function recordVisitor(string $ip, ?string $page = null): void
    {
        VisitorLog::firstOrCreate(
            [
                'ip_address' => $ip,
                'visit_date' => Carbon::today()->toDateString(),
            ],
            [
                'page_visited' => $page,
            ]
        );
    }

    /**
     * Get today's visitor count.
     */
    public function getTodayCount(): int
    {
        return VisitorLog::today()->count();
    }

    /**
     * Get yesterday's visitor count.
     */
    public function getYesterdayCount(): int
    {
        return VisitorLog::yesterday()->count();
    }

    /**
     * Get visitor counts grouped by date for a date range.
     */
    public function getCountsByDateRange(Carbon $from, Carbon $to): Collection
    {
        return VisitorLog::select('visit_date', DB::raw('COUNT(*) as count'))
            ->dateRange($from, $to)
            ->groupBy('visit_date')
            ->orderBy('visit_date')
            ->get()
            ->pluck('count', 'visit_date');
    }
}
