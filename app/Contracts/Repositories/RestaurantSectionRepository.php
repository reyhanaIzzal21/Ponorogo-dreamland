<?php

namespace App\Contracts\Repositories;

use App\Contracts\Interfaces\RestaurantSectionRepositoryInterface;
use App\Models\RestaurantSection;
use Illuminate\Database\Eloquent\Collection;

class RestaurantSectionRepository implements RestaurantSectionRepositoryInterface
{
    /**
     * Get all sections.
     *
     * @return Collection
     */
    public function getAll(): Collection
    {
        return RestaurantSection::ordered()->get();
    }

    /**
     * Get all active sections ordered by sort_order.
     *
     * @return Collection
     */
    public function getActiveOrdered(): Collection
    {
        return RestaurantSection::active()->ordered()->get();
    }

    /**
     * Find section by ID.
     *
     * @param string $id
     * @return RestaurantSection|null
     */
    public function findById(string $id): ?RestaurantSection
    {
        return RestaurantSection::find($id);
    }

    /**
     * Find section by type.
     *
     * @param string $type
     * @return RestaurantSection|null
     */
    public function findByType(string $type): ?RestaurantSection
    {
        return RestaurantSection::ofType($type)->first();
    }

    /**
     * Create a new section.
     *
     * @param array $data
     * @return RestaurantSection
     */
    public function create(array $data): RestaurantSection
    {
        if (!isset($data['sort_order'])) {
            $maxOrder = RestaurantSection::max('sort_order') ?? 0;
            $data['sort_order'] = $maxOrder + 1;
        }

        return RestaurantSection::create($data);
    }

    /**
     * Update a section.
     *
     * @param string $id
     * @param array $data
     * @return bool
     */
    public function update(string $id, array $data): bool
    {
        $section = $this->findById($id);

        if (!$section) {
            return false;
        }

        return $section->update($data);
    }

    /**
     * Update section by type.
     *
     * @param string $type
     * @param array $data
     * @return bool
     */
    public function updateByType(string $type, array $data): bool
    {
        $section = $this->findByType($type);

        if (!$section) {
            return false;
        }

        return $section->update($data);
    }

    /**
     * Delete a section.
     *
     * @param string $id
     * @return bool
     */
    public function delete(string $id): bool
    {
        $section = $this->findById($id);

        if (!$section) {
            return false;
        }

        return $section->delete();
    }
}
