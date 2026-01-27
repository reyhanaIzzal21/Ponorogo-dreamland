<?php

namespace App\Contracts\Interfaces;

use App\Models\PoolContent;
use App\Models\PoolSneakPeek;
use Illuminate\Database\Eloquent\Collection;

interface PoolRepositoryInterface
{
    // Content / Hero
    public function getContent(): ?PoolContent;
    public function updateContent(array $data): PoolContent;

    // Sneak Peek
    public function getSneakPeeks(): Collection;
    public function updateSneakPeek(int $slotNumber, array $data): PoolSneakPeek;

    // Timeline Stages
    public function getTimelineStages(): Collection;
    public function createContext(array $data); // Generic create
    public function createStage(array $data);
    public function updateStage(mixed $id, array $data);
    public function deleteStage(mixed $id);

    // Timeline Photos
    public function addStagePhoto(mixed $stageId, string $imagePath);
    public function deleteStagePhoto(mixed $photoId);
}
