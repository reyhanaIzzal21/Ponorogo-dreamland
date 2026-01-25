<?php

namespace App\Contracts\Interfaces;

use App\Models\Destination;
use Illuminate\Database\Eloquent\Collection;

interface DestinationRepositoryInterface
{
    /**
     * Get all destinations.
     *
     * @return Collection
     */
    public function getAll(): Collection;

    /**
     * Get all active destinations ordered by sort_order.
     *
     * @return Collection
     */
    public function getActiveOrdered(): Collection;

    /**
     * Find destination by ID.
     *
     * @param string $id
     * @return Destination|null
     */
    public function findById(string $id): ?Destination;

    /**
     * Find destination by slug.
     *
     * @param string $slug
     * @return Destination|null
     */
    public function findBySlug(string $slug): ?Destination;

    /**
     * Create a new destination.
     *
     * @param array $data
     * @return Destination
     */
    public function create(array $data): Destination;

    /**
     * Update a destination.
     *
     * @param string $id
     * @param array $data
     * @return bool
     */
    public function update(string $id, array $data): bool;

    /**
     * Delete a destination.
     *
     * @param string $id
     * @return bool
     */
    public function delete(string $id): bool;
}
