<?php

namespace App\Contracts\Repositories;

use App\Contracts\Interfaces\LandingPageSectionRepositoryInterface;
use App\Models\LandingPageSection;
use Illuminate\Database\Eloquent\Collection;

class LandingPageSectionRepository implements LandingPageSectionRepositoryInterface
{
    /**
     * Get all sections.
     *
     * @return Collection
     */
    public function getAll(): Collection
    {
        return LandingPageSection::with('images')->ordered()->get();
    }

    /**
     * Get all active sections ordered by sort_order.
     *
     * @return Collection
     */
    public function getActiveOrdered(): Collection
    {
        return LandingPageSection::with('images')->active()->ordered()->get();
    }

    /**
     * Find section by ID.
     *
     * @param string $id
     * @return LandingPageSection|null
     */
    public function findById(string $id): ?LandingPageSection
    {
        return LandingPageSection::with('images')->find($id);
    }

    /**
     * Find section by type.
     *
     * @param string $type
     * @return LandingPageSection|null
     */
    public function findByType(string $type): ?LandingPageSection
    {
        return LandingPageSection::with('images')->ofType($type)->first();
    }

    /**
     * Create a new section.
     *
     * @param array $data
     * @return LandingPageSection
     */
    public function create(array $data): LandingPageSection
    {
        // Auto-generate sort_order if not provided
        if (!isset($data['sort_order'])) {
            $maxOrder = LandingPageSection::max('sort_order') ?? 0;
            $data['sort_order'] = $maxOrder + 1;
        }

        return LandingPageSection::create($data);
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
