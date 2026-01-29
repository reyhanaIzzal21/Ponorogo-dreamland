<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\DashboardService;

class DashboardController extends Controller
{
    public function __construct(
        protected DashboardService $dashboardService
    ) {}

    /**
     * Display the admin dashboard.
     */
    public function index()
    {
        $kpi = $this->dashboardService->getKpiData();
        $trafficData = $this->dashboardService->getTrafficAnalytics(7);
        $distribution = $this->dashboardService->getBookingDistribution();
        $recentReservations = $this->dashboardService->getRecentReservations(5);
        $recentActivities = $this->dashboardService->getRecentActivities(5);

        return view('admin.pages.dashboard', compact(
            'kpi',
            'trafficData',
            'distribution',
            'recentReservations',
            'recentActivities'
        ));
    }
}
