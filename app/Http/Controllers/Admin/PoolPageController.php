<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Pool\StorePoolTimelineStageRequest;
use App\Http\Requests\Admin\Pool\UpdatePoolContentRequest;
use App\Http\Requests\Admin\Pool\UpdatePoolSneakPeekRequest;
use App\Http\Requests\Admin\Pool\UpdatePoolTimelineStageRequest;
use App\Services\PoolService;
use Illuminate\Http\Request;
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

        return view('admin.pages.pool.index', compact('content', 'sneakPeeks', 'timelineStages'));
    }

    // --- Hero / Content ---
    public function updateHero(UpdatePoolContentRequest $request)
    {
        $this->poolService->updateContent(
            $request->validated(),
            $request->file('teaser_background')
        );

        return redirect()->back()->with('success', 'Hero section updated successfully.');
    }

    // --- Sneak Peek ---
    public function updateSneakPeek(UpdatePoolSneakPeekRequest $request, $slotNumber)
    {
        $this->poolService->updateSneakPeek(
            $slotNumber,
            $request->validated(),
            $request->file('image')
        );

        return redirect()->back()->with('success', 'Sneak peek slot updated successfully.');
    }

    // --- Timeline ---
    public function storeStage(StorePoolTimelineStageRequest $request)
    {
        $this->poolService->createStage($request->validated());
        return redirect()->back()->with('success', 'Timeline stage created successfully.');
    }

    public function updateStage(UpdatePoolTimelineStageRequest $request, $id)
    {
        $this->poolService->updateStage($id, $request->validated());
        return redirect()->back()->with('success', 'Timeline stage updated successfully.');
    }

    public function destroyStage($id)
    {
        $this->poolService->deleteStage($id);
        return redirect()->back()->with('success', 'Timeline stage deleted successfully.');
    }

    public function storeStagePhoto(Request $request, $id)
    {
        $request->validate(['image' => 'required|image|max:2048']);
        $this->poolService->addStagePhoto($id, $request->file('image'));
        return redirect()->back()->with('success', 'Photo added to stage.');
    }

    public function destroyStagePhoto($id)
    {
        $this->poolService->deleteStagePhoto($id);
        return redirect()->back()->with('success', 'Photo removed from stage.');
    }
}
