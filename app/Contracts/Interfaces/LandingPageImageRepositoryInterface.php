<?php

namespace App\Contracts\Interfaces;

use App\Models\LandingPageImage;
use Illuminate\Database\Eloquent\Collection;

interface LandingPageImageRepositoryInterface
{
    /**
     * Get all images for a section.
     *
     * @param string $sectionId
     * @return Collection
     */
    public function getBySectionId(string $sectionId): Collection;

    /**
     * Get images by section type.
     *
     * @param string $sectionType
     * @param string|null $imageType
     * @return Collection
     */
    public function getBySectionType(string $sectionType, ?string $imageType = null): Collection;

    /**
     * Find image by ID.
     *
     * @param string $id
     * @return LandingPageImage|null
     */
    public function findById(string $id): ?LandingPageImage;

    /**
     * Create a new image.
     *
     * @param array $data
     * @return LandingPageImage
     */
    public function create(array $data): LandingPageImage;

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
     * Delete all images for a section.
     *
     * @param string $sectionId
     * @return bool
     */
    public function deleteBySectionId(string $sectionId): bool;

    /**
     * Get max sort order for a section.
     *
     * @param string $sectionId
     * @return int
     */
    public function getMaxSortOrder(string $sectionId): int;
}
