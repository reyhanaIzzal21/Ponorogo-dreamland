<?php

namespace App\Services;

use App\Contracts\Interfaces\LandingPageSectionRepositoryInterface;
use App\Contracts\Interfaces\LandingPageImageRepositoryInterface;
use App\Models\LandingPageSection;
use App\Models\LandingPageImage;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class LandingPageService
{
    /**
     * Cache key for landing page sections.
     */
    private const CACHE_KEY = 'landing_page.sections';
    private const CACHE_TTL = 3600; // 1 hour

    public function __construct(
        protected LandingPageSectionRepositoryInterface $sectionRepository,
        protected LandingPageImageRepositoryInterface $imageRepository
    ) {}

    /**
     * Get all sections with images (cached).
     *
     * @return Collection
     */
    public function getAllSections(): Collection
    {
        return Cache::remember(self::CACHE_KEY, self::CACHE_TTL, function () {
            return $this->sectionRepository->getActiveOrdered();
        });
    }

    /**
     * Get all sections for admin (no cache).
     *
     * @return Collection
     */
    public function getAllSectionsForAdmin(): Collection
    {
        return $this->sectionRepository->getAll();
    }

    /**
     * Get Hero section.
     *
     * @return LandingPageSection|null
     */
    public function getHeroSection(): ?LandingPageSection
    {
        return $this->sectionRepository->findByType(LandingPageSection::TYPE_HERO);
    }

    /**
     * Get About section.
     *
     * @return LandingPageSection|null
     */
    public function getAboutSection(): ?LandingPageSection
    {
        return $this->sectionRepository->findByType(LandingPageSection::TYPE_ABOUT);
    }

    /**
     * Get Why Choose Us section.
     *
     * @return LandingPageSection|null
     */
    public function getWhyChooseUsSection(): ?LandingPageSection
    {
        return $this->sectionRepository->findByType(LandingPageSection::TYPE_WHY_CHOOSE_US);
    }

    /**
     * Get Moment section.
     *
     * @return LandingPageSection|null
     */
    public function getMomentSection(): ?LandingPageSection
    {
        return $this->sectionRepository->findByType(LandingPageSection::TYPE_MOMENT);
    }

    /**
     * Update Hero section.
     *
     * @param array $data
     * @return bool
     */
    public function updateHeroSection(array $data): bool
    {
        $result = $this->sectionRepository->updateByType(LandingPageSection::TYPE_HERO, $data);
        $this->clearCache();
        return $result;
    }

    /**
     * Update About section.
     *
     * @param array $data
     * @return bool
     */
    public function updateAboutSection(array $data): bool
    {
        $result = $this->sectionRepository->updateByType(LandingPageSection::TYPE_ABOUT, $data);
        $this->clearCache();
        return $result;
    }

    /**
     * Update Why Choose Us section.
     *
     * @param array $data
     * @return bool
     */
    public function updateWhyChooseUsSection(array $data): bool
    {
        $result = $this->sectionRepository->updateByType(LandingPageSection::TYPE_WHY_CHOOSE_US, $data);
        $this->clearCache();
        return $result;
    }

    /**
     * Update Moment section.
     *
     * @param array $data
     * @return bool
     */
    public function updateMomentSection(array $data): bool
    {
        $result = $this->sectionRepository->updateByType(LandingPageSection::TYPE_MOMENT, $data);
        $this->clearCache();
        return $result;
    }

    /**
     * Upload image to a section.
     *
     * @param string $sectionType
     * @param UploadedFile $file
     * @param string $imageType
     * @param string|null $altText
     * @return LandingPageImage|null
     */
    public function uploadImage(string $sectionType, UploadedFile $file, string $imageType = 'default', ?string $altText = null): ?LandingPageImage
    {
        $section = $this->sectionRepository->findByType($sectionType);

        if (!$section) {
            return null;
        }

        $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs('landing-page', $filename, 'public');

        $image = $this->imageRepository->create([
            'landing_page_section_id' => $section->id,
            'image_path' => $path,
            'alt_text' => $altText,
            'image_type' => $imageType,
        ]);

        $this->clearCache();

        return $image;
    }

    /**
     * Delete an image.
     *
     * @param string $imageId
     * @return bool
     */
    public function deleteImage(string $imageId): bool
    {
        $image = $this->imageRepository->findById($imageId);

        if (!$image) {
            return false;
        }

        // Delete file from storage
        if ($image->image_path && Storage::disk('public')->exists($image->image_path)) {
            Storage::disk('public')->delete($image->image_path);
        }

        $result = $this->imageRepository->delete($imageId);

        if ($result) {
            $this->clearCache();
        }

        return $result;
    }

    /**
     * Update image for About section (left/right).
     *
     * @param string $imageType 'left' or 'right'
     * @param UploadedFile $file
     * @return LandingPageImage|null
     */
    public function updateAboutImage(string $imageType, UploadedFile $file): ?LandingPageImage
    {
        $section = $this->sectionRepository->findByType(LandingPageSection::TYPE_ABOUT);

        if (!$section) {
            return null;
        }

        // Find and delete existing image of this type
        $existingImages = $section->images->where('image_type', $imageType);
        foreach ($existingImages as $existingImage) {
            $this->deleteImage($existingImage->id);
        }

        // Upload new image
        return $this->uploadImage(LandingPageSection::TYPE_ABOUT, $file, $imageType);
    }

    /**
     * Get image by ID.
     *
     * @param string $imageId
     * @return LandingPageImage|null
     */
    public function getImageById(string $imageId): ?LandingPageImage
    {
        return $this->imageRepository->findById($imageId);
    }

    /**
     * Clear landing page cache.
     *
     * @return void
     */
    public function clearCache(): void
    {
        Cache::forget(self::CACHE_KEY);
    }
}
