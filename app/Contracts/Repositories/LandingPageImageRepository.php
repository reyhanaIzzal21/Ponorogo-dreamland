<?php

namespace App\Contracts\Repositories;

use App\Contracts\Interfaces\LandingPageImageRepositoryInterface;
use App\Models\LandingPageImage;
use App\Models\LandingPageSection;
use Illuminate\Database\Eloquent\Collection;

class LandingPageImageRepository implements LandingPageImageRepositoryInterface
{
    /**
     * Get all images for a section.
     *
     * @param string $sectionId
     * @return Collection
     */
    public function getBySectionId(string $sectionId): Collection
    {
        return LandingPageImage::where('landing_page_section_id', $sectionId)
            ->ordered()
            ->get();
    }

    /**
     * Get images by section type.
     *
     * @param string $sectionType
     * @param string|null $imageType
     * @return Collection
     */
    public function getBySectionType(string $sectionType, ?string $imageType = null): Collection
    {
        $section = LandingPageSection::ofType($sectionType)->first();

        if (!$section) {
            return new Collection();
        }

        $query = LandingPageImage::where('landing_page_section_id', $section->id);

        if ($imageType) {
            $query->ofType($imageType);
        }

        return $query->ordered()->get();
    }

    /**
     * Find image by ID.
     *
     * @param string $id
     * @return LandingPageImage|null
     */
    public function findById(string $id): ?LandingPageImage
    {
        return LandingPageImage::find($id);
    }

    /**
     * Create a new image.
     *
     * @param array $data
     * @return LandingPageImage
     */
    public function create(array $data): LandingPageImage
    {
        // Auto-generate sort_order if not provided
        if (!isset($data['sort_order'])) {
            $data['sort_order'] = $this->getMaxSortOrder($data['landing_page_section_id']) + 1;
        }

        return LandingPageImage::create($data);
    }

    /**
     * Update an image.
     *
     * @param string $id
     * @param array $data
     * @return bool
     */
    public function update(string $id, array $data): bool
    {
        $image = $this->findById($id);

        if (!$image) {
            return false;
        }

        return $image->update($data);
    }

    /**
     * Delete an image.
     *
     * @param string $id
     * @return bool
     */
    public function delete(string $id): bool
    {
        $image = $this->findById($id);

        if (!$image) {
            return false;
        }

        return $image->delete();
    }

    /**
     * Delete all images for a section.
     *
     * @param string $sectionId
     * @return bool
     */
    public function deleteBySectionId(string $sectionId): bool
    {
        return LandingPageImage::where('landing_page_section_id', $sectionId)->delete() > 0;
    }

    /**
     * Get max sort order for a section.
     *
     * @param string $sectionId
     * @return int
     */
    public function getMaxSortOrder(string $sectionId): int
    {
        return LandingPageImage::where('landing_page_section_id', $sectionId)
            ->max('sort_order') ?? 0;
    }
}
