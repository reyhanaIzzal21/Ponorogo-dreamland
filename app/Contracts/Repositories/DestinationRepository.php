<?php

namespace App\Contracts\Repositories;

use App\Contracts\Interfaces\DestinationRepositoryInterface;
use App\Models\Destination;
use Illuminate\Database\Eloquent\Collection;

class DestinationRepository implements DestinationRepositoryInterface
{
    /**
     * Get all destinations.
     *
     * @return Collection
     */
    public function getAll(): Collection
    {
        return Destination::orderBy('sort_order')->get();
    }

    /**
     * Get all active destinations ordered by sort_order.
     *
     * @return Collection
     */
    public function getActiveOrdered(): Collection
    {
        return Destination::active()->ordered()->get();
    }

    /**
     * Find destination by ID.
     *
     * @param string $id
     * @return Destination|null
     */
    public function findById(string $id): ?Destination
    {
        return Destination::find($id);
    }

    /**
     * Find destination by slug.
     *
     * @param string $slug
     * @return Destination|null
     */
    public function findBySlug(string $slug): ?Destination
    {
        return Destination::where('slug', $slug)->first();
    }

    /**
     * Create a new destination.
     *
     * @param array $data
     * @return Destination
     */
    public function create(array $data): Destination
    {
        // Auto-generate sort_order if not provided
        if (!isset($data['sort_order'])) {
            $maxOrder = Destination::max('sort_order') ?? 0;
            $data['sort_order'] = $maxOrder + 1;
        }

        return Destination::create($data);
    }

    /**
     * Update a destination.
     *
     * @param string $id
     * @param array $data
     * @return bool
     */
    public function update(string $id, array $data): bool
    {
        $destination = $this->findById($id);

        if (!$destination) {
            return false;
        }

        return $destination->update($data);
    }

    /**
     * Delete a destination.
     *
     * @param string $id
     * @return bool
     */
    public function delete(string $id): bool
    {
        $destination = $this->findById($id);

        if (!$destination) {
            return false;
        }

        return $destination->delete();
    }
}
