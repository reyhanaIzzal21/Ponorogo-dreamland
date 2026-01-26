<?php

namespace App\Contracts\Interfaces;

use App\Models\RestaurantSection;
use Illuminate\Database\Eloquent\Collection;

interface RestaurantSectionRepositoryInterface
{
    /**
     * Get all sections.
     *
     * @return Collection
     */
    public function getAll(): Collection;

    /**
     * Get all active sections ordered by sort_order.
     *
     * @return Collection
     */
    public function getActiveOrdered(): Collection;

    /**
     * Find section by ID.
     *
     * @param string $id
     * @return RestaurantSection|null
     */
    public function findById(string $id): ?RestaurantSection;

    /**
     * Find section by type.
     *
     * @param string $type
     * @return RestaurantSection|null
     */
    public function findByType(string $type): ?RestaurantSection;

    /**
     * Create a new section.
     *
     * @param array $data
     * @return RestaurantSection
     */
    public function create(array $data): RestaurantSection;

    /**
     * Update a section.
     *
     * @param string $id
     * @param array $data
     * @return bool
     */
    public function update(string $id, array $data): bool;

    /**
     * Update section by type.
     *
     * @param string $type
     * @param array $data
     * @return bool
     */
    public function updateByType(string $type, array $data): bool;

    /**
     * Delete a section.
     *
     * @param string $id
     * @return bool
     */
    public function delete(string $id): bool;
}
