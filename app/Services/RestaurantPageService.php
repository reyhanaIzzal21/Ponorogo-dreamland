<?php

namespace App\Services;

use App\Contracts\Interfaces\RestaurantSectionRepositoryInterface;
use App\Contracts\Interfaces\RestaurantGalleryImageRepositoryInterface;
use App\Contracts\Interfaces\RestaurantBestSellerRepositoryInterface;
use App\Models\RestaurantSection;
use App\Models\RestaurantGalleryImage;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class RestaurantPageService
{
    /**
     * Cache key for restaurant page data.
     */
    private const CACHE_KEY = 'restaurant_page.data';
    private const CACHE_TTL = 3600; // 1 hour

    public function __construct(
        protected RestaurantSectionRepositoryInterface $sectionRepository,
        protected RestaurantGalleryImageRepositoryInterface $galleryRepository,
        protected RestaurantBestSellerRepositoryInterface $bestSellerRepository
    ) {}

    // ==================== PUBLIC PAGE DATA ====================

    /**
     * Get all restaurant page data (cached).
     *
     * @return array
     */
    public function getPageData(): array
    {
        return Cache::remember(self::CACHE_KEY, self::CACHE_TTL, function () {
            return [
                'hero' => $this->getHeroSection(),
                'filosofi' => $this->getFilosofiSection(),
                'bestSellers' => $this->getActiveBestSellers(),
                'gallery' => $this->getActiveGalleryImages(),
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
            'filosofi' => $this->getFilosofiSection(),
            'bestSellers' => $this->bestSellerRepository->getAll(),
            'gallery' => $this->galleryRepository->getAll(),
        ];
    }

    // ==================== SECTION OPERATIONS ====================

    /**
     * Get Hero section.
     *
     * @return RestaurantSection|null
     */
    public function getHeroSection(): ?RestaurantSection
    {
        return $this->sectionRepository->findByType(RestaurantSection::TYPE_HERO);
    }

    /**
     * Get Filosofi section.
     *
     * @return RestaurantSection|null
     */
    public function getFilosofiSection(): ?RestaurantSection
    {
        return $this->sectionRepository->findByType(RestaurantSection::TYPE_FILOSOFI);
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
                'section_type' => RestaurantSection::TYPE_HERO,
                'title' => $data['title'] ?? null,
                'subtitle' => $data['subtitle'] ?? null,
                'description' => $data['description'] ?? null,
                'extra_data' => $data['extra_data'] ?? [],
            ]);
            $this->clearCache();
            return true;
        }

        $result = $this->sectionRepository->updateByType(RestaurantSection::TYPE_HERO, $data);
        $this->clearCache();
        return $result;
    }

    /**
     * Update Filosofi section.
     *
     * @param array $data
     * @return bool
     */
    public function updateFilosofiSection(array $data): bool
    {
        $section = $this->getFilosofiSection();

        if (!$section) {
            // Create if not exists
            $this->sectionRepository->create([
                'section_type' => RestaurantSection::TYPE_FILOSOFI,
                'title' => $data['title'] ?? null,
                'description' => $data['description'] ?? null,
                'extra_data' => $data['extra_data'] ?? [],
            ]);
            $this->clearCache();
            return true;
        }

        $result = $this->sectionRepository->updateByType(RestaurantSection::TYPE_FILOSOFI, $data);
        $this->clearCache();
        return $result;
    }

    /**
     * Upload hero background image.
     *
     * @param UploadedFile $file
     * @return string The new image path (relative)
     */
    public function uploadHeroBackground(UploadedFile $file): string
    {
        $section = $this->getHeroSection();

        // Delete old image if exists
        if ($section) {
            $oldPath = $section->getExtraValue('background_image');
            if ($oldPath && !str_starts_with($oldPath, 'http') && Storage::disk('public')->exists($oldPath)) {
                Storage::disk('public')->delete($oldPath);
            }
        }

        // Upload new image
        $filename = 'hero_' . Str::uuid() . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs('restaurant', $filename, 'public');

        // Update section with new background_image path
        $extraData = $section ? ($section->extra_data ?? []) : [];
        $extraData['background_image'] = $path;

        if ($section) {
            $section->update(['extra_data' => $extraData]);
        } else {
            $this->sectionRepository->create([
                'section_type' => RestaurantSection::TYPE_HERO,
                'extra_data' => $extraData,
            ]);
        }

        $this->clearCache();
        return $path;
    }

    // ==================== BEST SELLERS OPERATIONS ====================

    /**
     * Get active best sellers with menu items.
     *
     * @return Collection
     */
    public function getActiveBestSellers(): Collection
    {
        return $this->bestSellerRepository->getActiveOrdered();
    }

    /**
     * Update best seller slots.
     *
     * @param array $slots [slotNumber => menuItemId]
     * @return bool
     */
    public function updateBestSellers(array $slots): bool
    {
        $result = $this->bestSellerRepository->updateAllSlots($slots);
        $this->clearCache();
        return $result;
    }

    // ==================== GALLERY OPERATIONS ====================

    /**
     * Get active gallery images.
     *
     * @return Collection
     */
    public function getActiveGalleryImages(): Collection
    {
        return $this->galleryRepository->getActiveOrdered();
    }

    /**
     * Upload a gallery image.
     *
     * @param UploadedFile $file
     * @param string|null $altText
     * @return RestaurantGalleryImage
     */
    public function uploadGalleryImage(UploadedFile $file, ?string $altText = null): RestaurantGalleryImage
    {
        $filename = 'gallery_' . Str::uuid() . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs('restaurant/gallery', $filename, 'public');

        $image = $this->galleryRepository->create([
            'image_path' => $path,
            'alt_text' => $altText,
        ]);

        $this->clearCache();
        return $image;
    }

    /**
     * Delete a gallery image.
     *
     * @param string $imageId
     * @return bool
     */
    public function deleteGalleryImage(string $imageId): bool
    {
        $image = $this->galleryRepository->findById($imageId);

        if (!$image) {
            return false;
        }

        // Delete file from storage
        if ($image->image_path && !str_starts_with($image->image_path, 'http')) {
            if (Storage::disk('public')->exists($image->image_path)) {
                Storage::disk('public')->delete($image->image_path);
            }
        }

        $result = $this->galleryRepository->delete($imageId);

        if ($result) {
            $this->clearCache();
        }

        return $result;
    }

    /**
     * Get gallery image count.
     *
     * @return int
     */
    public function getGalleryCount(): int
    {
        return $this->galleryRepository->getActiveCount();
    }

    // ==================== SOCIAL MEDIA ====================

    /**
     * Update social media settings.
     *
     * @param string|null $instagramUsername
     * @param string|null $instagramUrl
     * @return bool
     */
    public function updateSocialMedia(?string $instagramUsername, ?string $instagramUrl): bool
    {
        $section = $this->getHeroSection();

        $extraData = $section ? ($section->extra_data ?? []) : [];
        $extraData['instagram_username'] = $instagramUsername;
        $extraData['instagram_url'] = $instagramUrl;

        if ($section) {
            $result = $section->update(['extra_data' => $extraData]);
        } else {
            $this->sectionRepository->create([
                'section_type' => RestaurantSection::TYPE_HERO,
                'extra_data' => $extraData,
            ]);
            $result = true;
        }

        $this->clearCache();
        return $result;
    }

    // ==================== CACHE ====================

    /**
     * Clear restaurant page cache.
     *
     * @return void
     */
    public function clearCache(): void
    {
        Cache::forget(self::CACHE_KEY);
    }
}
