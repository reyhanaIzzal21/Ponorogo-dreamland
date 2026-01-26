<?php

namespace App\Contracts\Interfaces;

use App\Models\RestaurantGalleryImage;
use Illuminate\Database\Eloquent\Collection;

interface RestaurantGalleryImageRepositoryInterface
{
    /**
     * Get all gallery images.
     *
     * @return Collection
     */
    public function getAll(): Collection;

    /**
     * Get all active gallery images ordered.
     *
     * @return Collection
     */
    public function getActiveOrdered(): Collection;

    /**
     * Find image by ID.
     *
     * @param string $id
     * @return RestaurantGalleryImage|null
     */
    public function findById(string $id): ?RestaurantGalleryImage;

    /**
     * Create a new gallery image.
     *
     * @param array $data
     * @return RestaurantGalleryImage
     */
    public function create(array $data): RestaurantGalleryImage;

    /**
     * Update an image.
     *
     * @param string $id
     * @param array $data
     * @return bool
     */
    public function update(string $id, array $data): bool;

    /**
     * Delete an image.
     *
     * @param string $id
     * @return bool
     */
    public function delete(string $id): bool;

    /**
     * Get the count of active images.
     *
     * @return int
     */
    public function getActiveCount(): int;

    /**
     * Reorder images.
     *
     * @param array $orderedIds
     * @return bool
     */
    public function reorder(array $orderedIds): bool;
}
