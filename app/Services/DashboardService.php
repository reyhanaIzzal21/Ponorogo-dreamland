<?php

namespace App\Services;

use App\Contracts\Interfaces\ActivityLogRepositoryInterface;
use App\Contracts\Interfaces\VisitorLogRepositoryInterface;
use App\Models\Destination;
use App\Models\MenuItem;
use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class DashboardService
{
    public function __construct(
        protected VisitorLogRepositoryInterface $visitorLogRepository,
        protected ActivityLogRepositoryInterface $activityLogRepository
    ) {}

    /**
     * Get KPI data for dashboard cards.
     */
    public function getKpiData(): array
    {
        $todayVisitors = $this->visitorLogRepository->getTodayCount();
        $yesterdayVisitors = $this->visitorLogRepository->getYesterdayCount();

        // Calculate percentage change
        $visitorChange = 0;
        if ($yesterdayVisitors > 0) {
            $visitorChange = round((($todayVisitors - $yesterdayVisitors) / $yesterdayVisitors) * 100, 1);
        } elseif ($todayVisitors > 0) {
            $visitorChange = 100; // If no visitors yesterday but some today
        }

        // WhatsApp failed count
        $waFailed = Reservation::where('wa_sent', false)
            ->whereNotNull('wa_error')
            ->count();

        // Active menu items count
        $activeMenuCount = MenuItem::where('is_active', true)->count();

        return [
            'total_visitors' => $todayVisitors,
            'visitor_change' => $visitorChange,
            'wa_failed' => $waFailed,
            'active_menu' => $activeMenuCount,
        ];
    }

    /**
     * Get traffic analytics data for charts.
     */
    public function getTrafficAnalytics(int $days = 7): array
    {
        $endDate = Carbon::today();
        $startDate = Carbon::today()->subDays($days - 1);

        // Get visitor counts by date
        $visitorCounts = $this->visitorLogRepository->getCountsByDateRange($startDate, $endDate);

        // Get reservation counts by date
        $reservationCounts = Reservation::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->whereBetween('created_at', [$startDate->startOfDay(), $endDate->endOfDay()])
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->pluck('count', 'date');

        // Build arrays for each day
        $labels = [];
        $visitors = [];
        $reservations = [];

        for ($i = 0; $i < $days; $i++) {
            $date = $startDate->copy()->addDays($i);
            $dateString = $date->toDateString();

            $labels[] = $date->locale('id')->translatedFormat('l'); // Day name in Indonesian
            $visitors[] = $visitorCounts[$dateString] ?? 0;
            $reservations[] = $reservationCounts[$dateString] ?? 0;
        }

        return [
            'labels' => $labels,
            'visitors' => $visitors,
            'reservations' => $reservations,
        ];
    }

    /**
     * Get booking distribution (resto vs pendopo).
     */
    public function getBookingDistribution(): array
    {
        $total = Reservation::count();

        if ($total === 0) {
            return [
                'resto' => ['count' => 0, 'percentage' => 0],
                'pendopo' => ['count' => 0, 'percentage' => 0],
                'total' => 0,
            ];
        }

        // Count reservations by destination type
        $restoCount = Reservation::whereHas('destination', function ($query) {
            $query->where('type', Destination::TYPE_RESTAURANT);
        })->count();

        $pendopoCount = Reservation::whereHas('destination', function ($query) {
            $query->where('type', Destination::TYPE_VENUE);
        })->count();

        return [
            'resto' => [
                'count' => $restoCount,
                'percentage' => round(($restoCount / $total) * 100),
            ],
            'pendopo' => [
                'count' => $pendopoCount,
                'percentage' => round(($pendopoCount / $total) * 100),
            ],
            'total' => $total,
        ];
    }

    /**
     * Get recent reservations.
     */
    public function getRecentReservations(int $limit = 5): Collection
    {
        return Reservation::with('destination')
            ->latest()
            ->limit($limit)
            ->get();
    }

    /**
     * Get recent activities.
     */
    public function getRecentActivities(int $limit = 5): Collection
    {
        return $this->activityLogRepository->getRecent($limit);
    }
}
