<?php

namespace App\Contracts\Repositories;

use App\Contracts\Interfaces\PavilionFacilityRepositoryInterface;
use App\Models\PavilionFacility;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class PavilionFacilityRepository implements PavilionFacilityRepositoryInterface
{
    /**
     * Get all facilities.
     *
     * @return Collection
     */
    public function getAll(): Collection
    {
        return PavilionFacility::ordered()->get();
    }

    /**
     * Get all active facilities ordered by sort_order.
     *
     * @return Collection
     */
    public function getActiveOrdered(): Collection
    {
        return PavilionFacility::active()->ordered()->get();
    }

    /**
     * Find facility by ID.
     *
     * @param string $id
     * @return PavilionFacility|null
     */
    public function findById(string $id): ?PavilionFacility
    {
        return PavilionFacility::find($id);
    }

    /**
     * Create a new facility.
     *
     * @param array $data
     * @return PavilionFacility
     */
    public function create(array $data): PavilionFacility
    {
        if (!isset($data['sort_order'])) {
            $maxOrder = PavilionFacility::max('sort_order') ?? 0;
            $data['sort_order'] = $maxOrder + 1;
        }

        return PavilionFacility::create($data);
    }

    /**
     * Update a facility.
     *
     * @param string $id
     * @param array $data
     * @return bool
     */
    public function update(string $id, array $data): bool
    {
        $facility = $this->findById($id);

        if (!$facility) {
            return false;
        }

        return $facility->update($data);
    }

    /**
     * Delete a facility.
     *
     * @param string $id
     * @return bool
     */
    public function delete(string $id): bool
    {
        $facility = $this->findById($id);

        if (!$facility) {
            return false;
        }

        return $facility->delete();
    }

    /**
     * Get count of active facilities.
     *
     * @return int
     */
    public function getActiveCount(): int
    {
        return PavilionFacility::active()->count();
    }

    /**
     * Bulk update facilities.
     *
     * @param array $facilities Array of facility data
     * @return bool
     */
    public function bulkUpdate(array $facilities): bool
    {
        try {
            DB::beginTransaction();

            // Delete all existing facilities
            PavilionFacility::query()->delete();

            // Create new facilities
            foreach ($facilities as $index => $facilityData) {
                $facilityData['sort_order'] = $index;
                PavilionFacility::create($facilityData);
            }

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }
}
