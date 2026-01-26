<?php

namespace App\Services;

use App\Contracts\Interfaces\PavilionSectionRepositoryInterface;
use App\Contracts\Interfaces\PavilionFacilityRepositoryInterface;
use App\Contracts\Interfaces\PavilionLayoutRepositoryInterface;
use App\Models\PavilionSection;
use App\Models\PavilionLayout;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PavilionPageService
{
    /**
     * Cache key for pavilion page data.
     */
    private const CACHE_KEY = 'pavilion_page.data';
    private const CACHE_TTL = 3600; // 1 hour

    public function __construct(
        protected PavilionSectionRepositoryInterface $sectionRepository,
        protected PavilionFacilityRepositoryInterface $facilityRepository,
        protected PavilionLayoutRepositoryInterface $layoutRepository
    ) {}

    // ==================== PUBLIC PAGE DATA ====================

    /**
     * Get all pavilion page data (cached).
     *
     * @return array
     */
    public function getPageData(): array
    {
        return Cache::remember(self::CACHE_KEY, self::CACHE_TTL, function () {
            return [
                'hero' => $this->getHeroSection(),
                'specs' => $this->getSpecsSection(),
                'facilitiesSection' => $this->getFacilitiesSection(),
                'facilities' => $this->getActiveFacilities(),
                'layouts' => $this->getActiveLayouts(),
            ];
        });
    }

    // ==================== ADMIN DATA ====================

    /**
     * Get all data for admin panel (no cache).
     *
     * @return array
     */
    public function getAdminData(): array
    {
        return [
            'hero' => $this->getHeroSection(),
            'specs' => $this->getSpecsSection(),
            'facilitiesSection' => $this->getFacilitiesSection(),
            'facilities' => $this->facilityRepository->getAll(),
            'layouts' => $this->layoutRepository->getAll(),
        ];
    }

    // ==================== SECTION OPERATIONS ====================

    /**
     * Get Hero section.
     *
     * @return PavilionSection|null
     */
    public function getHeroSection(): ?PavilionSection
    {
        return $this->sectionRepository->findByType(PavilionSection::TYPE_HERO);
    }

    /**
     * Get Specs section.
     *
     * @return PavilionSection|null
     */
    public function getSpecsSection(): ?PavilionSection
    {
        return $this->sectionRepository->findByType(PavilionSection::TYPE_SPECS);
    }

    /**
     * Get Facilities section.
     *
     * @return PavilionSection|null
     */
    public function getFacilitiesSection(): ?PavilionSection
    {
        return $this->sectionRepository->findByType(PavilionSection::TYPE_FACILITIES);
    }

    /**
     * Update Hero section.
     *
     * @param array $data
     * @return bool
     */
    public function updateHeroSection(array $data): bool
    {
        $section = $this->getHeroSection();

        if (!$section) {
            // Create if not exists
            $this->sectionRepository->create([
                'section_type' => PavilionSection::TYPE_HERO,
                'title' => $data['title'] ?? null,
                'subtitle' => $data['subtitle'] ?? null,
                'description' => $data['description'] ?? null,
                'extra_data' => $data['extra_data'] ?? [],
            ]);
            $this->clearCache();
            return true;
        }

        // Merge extra_data if provided
        if (isset($data['extra_data'])) {
            $existingExtra = $section->extra_data ?? [];
            $data['extra_data'] = array_merge($existingExtra, $data['extra_data']);
        }

        $result = $this->sectionRepository->updateByType(PavilionSection::TYPE_HERO, $data);
        $this->clearCache();
        return $result;
    }

    /**
     * Update Specs section.
     *
     * @param array $data
     * @return bool
     */
    public function updateSpecsSection(array $data): bool
    {
        $section = $this->getSpecsSection();

        if (!$section) {
            // Create if not exists
            $this->sectionRepository->create([
                'section_type' => PavilionSection::TYPE_SPECS,
                'title' => $data['title'] ?? null,
                'subtitle' => $data['subtitle'] ?? null,
                'extra_data' => $data['extra_data'] ?? [],
            ]);
            $this->clearCache();
            return true;
        }

        $result = $this->sectionRepository->updateByType(PavilionSection::TYPE_SPECS, $data);
        $this->clearCache();
        return $result;
    }

    /**
     * Update Facilities section.
     *
     * @param array $data
     * @return bool
     */
    public function updateFacilitiesSection(array $data): bool
    {
        $section = $this->getFacilitiesSection();

        if (!$section) {
            // Create if not exists
            $this->sectionRepository->create([
                'section_type' => PavilionSection::TYPE_FACILITIES,
                'title' => $data['title'] ?? null,
                'description' => $data['description'] ?? null,
                'image_path' => $data['image_path'] ?? null,
            ]);
            $this->clearCache();
            return true;
        }

        $result = $this->sectionRepository->updateByType(PavilionSection::TYPE_FACILITIES, $data);
        $this->clearCache();
        return $result;
    }

    /**
     * Upload hero background image.
     *
     * @param UploadedFile $file
     * @return string|null The new image URL
     */
    public function uploadHeroBackground(UploadedFile $file): ?string
    {
        $section = $this->getHeroSection();

        // Delete old image if exists
        if ($section) {
            // Check image_path first
            $oldPath = $section->image_path;
            if (!$oldPath) {
                // Fallback to extra_data for legacy
                $oldPath = $section->getExtraValue('background_image');
            }

            if ($oldPath && !str_starts_with($oldPath, 'http') && Storage::disk('public')->exists($oldPath)) {
                Storage::disk('public')->delete($oldPath);
            }
        }

        // Upload new image
        $filename = 'hero_' . Str::uuid() . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs('pavilion', $filename, 'public');

        if ($section) {
            // Update image_path column
            $section->update(['image_path' => $path]);

            // Optional: Clean up extra_data background_image if it exists to avoid confusion
            $extraData = $section->extra_data ?? [];
            if (isset($extraData['background_image'])) {
                unset($extraData['background_image']);
                $section->update(['extra_data' => $extraData]);
            }
        } else {
            $this->sectionRepository->create([
                'section_type' => PavilionSection::TYPE_HERO,
                'image_path' => $path,
                'extra_data' => [],
            ]);
        }

        $this->clearCache();
        return asset('storage/' . $path);
    }

    /**
     * Upload facilities section image.
     *
     * @param UploadedFile $file
     * @return string The new image URL
     */
    public function uploadFacilitiesImage(UploadedFile $file): string
    {
        $section = $this->getFacilitiesSection();

        // Delete old image if exists
        if ($section && $section->image_path) {
            $oldPath = $section->image_path;
            if (!str_starts_with($oldPath, 'http') && Storage::disk('public')->exists($oldPath)) {
                Storage::disk('public')->delete($oldPath);
            }
        }

        // Upload new image
        $filename = 'facilities_' . Str::uuid() . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs('pavilion', $filename, 'public');

        // Update or create section with image_path
        if ($section) {
            $section->update(['image_path' => $path]);
        } else {
            $this->sectionRepository->create([
                'section_type' => PavilionSection::TYPE_FACILITIES,
                'title' => 'Segala yang Anda Butuhkan',
                'description' => 'Kami memahami bahwa kelancaran acara bergantung pada fasilitas pendukung.',
                'image_path' => $path,
            ]);
        }

        $this->clearCache();
        return asset('storage/' . $path);
    }

    // ==================== FACILITY OPERATIONS ====================

    /**
     * Get active facilities.
     *
     * @return Collection
     */
    public function getActiveFacilities(): Collection
    {
        return $this->facilityRepository->getActiveOrdered();
    }

    /**
     * Add a new facility.
     *
     * @param array $data
     * @return \App\Models\PavilionFacility
     */
    public function addFacility(array $data): \App\Models\PavilionFacility
    {
        $facility = $this->facilityRepository->create($data);
        $this->clearCache();
        return $facility;
    }

    /**
     * Update a facility.
     *
     * @param string $id
     * @param array $data
     * @return bool
     */
    public function updateFacility(string $id, array $data): bool
    {
        $result = $this->facilityRepository->update($id, $data);
        $this->clearCache();
        return $result;
    }

    /**
     * Delete a facility.
     *
     * @param string $id
     * @return bool
     */
    public function deleteFacility(string $id): bool
    {
        $result = $this->facilityRepository->delete($id);
        $this->clearCache();
        return $result;
    }

    /**
     * Bulk update facilities.
     *
     * @param array $facilities
     * @return bool
     */
    public function bulkUpdateFacilities(array $facilities): bool
    {
        $result = $this->facilityRepository->bulkUpdate($facilities);
        $this->clearCache();
        return $result;
    }

    // ==================== LAYOUT OPERATIONS ====================

    /**
     * Get active layouts.
     *
     * @return Collection
     */
    public function getActiveLayouts(): Collection
    {
        return $this->layoutRepository->getActiveOrdered();
    }

    /**
     * Upload a layout image.
     *
     * @param UploadedFile $file
     * @param string $title
     * @return PavilionLayout
     */
    public function uploadLayout(UploadedFile $file, string $title): PavilionLayout
    {
        $filename = 'layout_' . Str::uuid() . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs('pavilion/layouts', $filename, 'public');

        $layout = $this->layoutRepository->create([
            'title' => $title,
            'image_path' => $path,
        ]);

        $this->clearCache();
        return $layout;
    }

    /**
     * Update a layout.
     *
     * @param string $id
     * @param array $data
     * @param UploadedFile|null $file
     * @return bool
     */
    public function updateLayout(string $id, array $data, ?UploadedFile $file = null): bool
    {
        $layout = $this->layoutRepository->findById($id);

        if (!$layout) {
            return false;
        }

        // Handle new image upload
        if ($file) {
            // Delete old image
            if ($layout->image_path && !str_starts_with($layout->image_path, 'http')) {
                if (Storage::disk('public')->exists($layout->image_path)) {
                    Storage::disk('public')->delete($layout->image_path);
                }
            }

            $filename = 'layout_' . Str::uuid() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('pavilion/layouts', $filename, 'public');
            $data['image_path'] = $path;
        }

        $result = $this->layoutRepository->update($id, $data);
        $this->clearCache();
        return $result;
    }

    /**
     * Delete a layout.
     *
     * @param string $id
     * @return bool
     */
    public function deleteLayout(string $id): bool
    {
        $layout = $this->layoutRepository->findById($id);

        if (!$layout) {
            return false;
        }

        // Delete file from storage
        if ($layout->image_path && !str_starts_with($layout->image_path, 'http')) {
            if (Storage::disk('public')->exists($layout->image_path)) {
                Storage::disk('public')->delete($layout->image_path);
            }
        }

        $result = $this->layoutRepository->delete($id);

        if ($result) {
            $this->clearCache();
        }

        return $result;
    }

    /**
     * Get layout count.
     *
     * @return int
     */
    public function getLayoutCount(): int
    {
        return $this->layoutRepository->getActiveCount();
    }

    // ==================== CACHE ====================

    /**
     * Clear pavilion page cache.
     *
     * @return void
     */
    public function clearCache(): void
    {
        Cache::forget(self::CACHE_KEY);
    }
}
