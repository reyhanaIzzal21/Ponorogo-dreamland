<?php

namespace App\Http\Controllers;

use App\Services\PoolService;
use Illuminate\View\View;

class PoolPageController extends Controller
{
    public function __construct(
        protected PoolService $poolService
    ) {}

    public function index(): View
    {
        $content = $this->poolService->getContent();
        $sneakPeeks = $this->poolService->getSneakPeeks();
        $timelineStages = $this->poolService->getTimelineStages();

        return view('user.pages.destinations.pool.index', compact('content', 'sneakPeeks', 'timelineStages'));
    }
}
