<?php

namespace App\Services;

use App\Contracts\Interfaces\PoolRepositoryInterface;
use App\Models\PoolContent;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class PoolService
{
    public function __construct(
        protected PoolRepositoryInterface $poolRepository
    ) {}

    // --- Content / Hero ---
    public function getContent(): ?PoolContent
    {
        return $this->poolRepository->getContent();
    }

    public function updateContent(array $data, ?UploadedFile $teaserSettings = null): PoolContent
    {
        if ($teaserSettings) {
            // Delete old image if exists (optional logic)
            $old = $this->getContent();
            if ($old && $old->teaser_background) Storage::disk('public')->delete($old->teaser_background);

            $path = $teaserSettings->store('pool/hero', 'public');
            $data['teaser_background'] = $path;
        }

        return $this->poolRepository->updateContent($data);
    }

    // --- Sneak Peek ---
    public function getSneakPeeks(): Collection
    {
        return $this->poolRepository->getSneakPeeks();
    }

    public function updateSneakPeek(int $slotNumber, array $data, ?UploadedFile $image = null)
    {
        if ($image) {
            $path = $image->store('pool/sneakpeak', 'public');
            $data['image_path'] = $path;
        }

        return $this->poolRepository->updateSneakPeek($slotNumber, $data);
    }

    // --- Timeline ---
    public function getTimelineStages(): Collection
    {
        return $this->poolRepository->getTimelineStages();
    }

    public function createStage(array $data)
    {
        // Enforce logic: Done = 100%, Planned = 0%
        if (isset($data['status'])) {
            if ($data['status'] === 'done') {
                $data['progress_percentage'] = 100;
            } elseif ($data['status'] === 'planned') {
                $data['progress_percentage'] = 0;
            }
        }
        return $this->poolRepository->createStage($data);
    }

    public function updateStage(mixed $id, array $data)
    {
        // Enforce logic: Done = 100%, Planned = 0%
        if (isset($data['status'])) {
            if ($data['status'] === 'done') {
                $data['progress_percentage'] = 100;
            } elseif ($data['status'] === 'planned') {
                $data['progress_percentage'] = 0;
            }
        }
        return $this->poolRepository->updateStage($id, $data);
    }

    public function deleteStage(mixed $id)
    {
        // Delete associated photos from storage first if needed
        return $this->poolRepository->deleteStage($id);
    }

    // --- Timeline Photos ---
    public function addStagePhoto(mixed $stageId, UploadedFile $image)
    {
        $path = $image->store('pool/timeline', 'public');
        return $this->poolRepository->addStagePhoto($stageId, $path);
    }

    public function deleteStagePhoto(mixed $photoId)
    {
        // Delete file from storage logic can be added here
        return $this->poolRepository->deleteStagePhoto($photoId);
    }
}
