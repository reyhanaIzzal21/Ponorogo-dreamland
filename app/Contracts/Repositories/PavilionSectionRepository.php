<?php

namespace App\Contracts\Repositories;

use App\Contracts\Interfaces\PavilionSectionRepositoryInterface;
use App\Models\PavilionSection;
use Illuminate\Database\Eloquent\Collection;

class PavilionSectionRepository implements PavilionSectionRepositoryInterface
{
    /**
     * Get all sections.
     *
     * @return Collection
     */
    public function getAll(): Collection
    {
        return PavilionSection::ordered()->get();
    }

    /**
     * Get all active sections ordered by sort_order.
     *
     * @return Collection
     */
    public function getActiveOrdered(): Collection
    {
        return PavilionSection::active()->ordered()->get();
    }

    /**
     * Find section by ID.
     *
     * @param string $id
     * @return PavilionSection|null
     */
    public function findById(string $id): ?PavilionSection
    {
        return PavilionSection::find($id);
    }

    /**
     * Find section by type.
     *
     * @param string $type
     * @return PavilionSection|null
     */
    public function findByType(string $type): ?PavilionSection
    {
        return PavilionSection::ofType($type)->first();
    }

    /**
     * Create a new section.
     *
     * @param array $data
     * @return PavilionSection
     */
    public function create(array $data): PavilionSection
    {
        if (!isset($data['sort_order'])) {
            $maxOrder = PavilionSection::max('sort_order') ?? 0;
            $data['sort_order'] = $maxOrder + 1;
        }

        return PavilionSection::create($data);
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
