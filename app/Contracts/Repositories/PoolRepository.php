<?php

namespace App\Contracts\Repositories;

use App\Contracts\Interfaces\PoolRepositoryInterface;
use App\Models\PoolContent;
use App\Models\PoolSneakPeek;
use App\Models\PoolTimelinePhoto;
use App\Models\PoolTimelineStage;
use Illuminate\Database\Eloquent\Collection;

class PoolRepository implements PoolRepositoryInterface
{
    // Content / Hero
    public function getContent(): ?PoolContent
    {
        return PoolContent::first();
    }

    public function updateContent(array $data): PoolContent
    {
        $content = PoolContent::first();
        if (!$content) {
            return PoolContent::create($data);
        }
        $content->update($data);
        return $content;
    }

    // Sneak Peek
    public function getSneakPeeks(): Collection
    {
        return PoolSneakPeek::orderBy('slot_number')->get();
    }

    public function updateSneakPeek(int $slotNumber, array $data): PoolSneakPeek
    {
        return PoolSneakPeek::updateOrCreate(
            ['slot_number' => $slotNumber],
            $data
        );
    }

    // Timeline Stages
    public function getTimelineStages(): Collection
    {
        return PoolTimelineStage::with('photos')->orderBy('sort_order')->get();
    }

    public function createContext(array $data)
    {
        // Not used, just satisfying potential abstract requirement if any, 
        // but explicit methods are better.
    }

    public function createStage(array $data)
    {
        // Auto sort order
        if (!isset($data['sort_order'])) {
            $data['sort_order'] = PoolTimelineStage::max('sort_order') + 1;
        }
        return PoolTimelineStage::create($data);
    }

    public function updateStage(mixed $id, array $data)
    {
        $stage = PoolTimelineStage::findOrFail($id);
        $stage->update($data);
        return $stage;
    }

    public function deleteStage(mixed $id)
    {
        $stage = PoolTimelineStage::findOrFail($id);
        return $stage->delete();
    }

    // Timeline Photos
    public function addStagePhoto(mixed $stageId, string $imagePath)
    {
        return PoolTimelinePhoto::create([
            'pool_timeline_stage_id' => $stageId,
            'image_path' => $imagePath
        ]);
    }

    public function deleteStagePhoto(mixed $photoId)
    {
        $photo = PoolTimelinePhoto::findOrFail($photoId);
        return $photo->delete();
    }
}
