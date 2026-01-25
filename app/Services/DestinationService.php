<?php

namespace App\Services;

use App\Contracts\Interfaces\DestinationRepositoryInterface;
use App\Models\Destination;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DestinationService
{
    /**
     * Cache key for destinations.
     */
    private const CACHE_KEY = 'destinations.active';
    private const CACHE_TTL = 3600; // 1 hour

    public function __construct(
        protected DestinationRepositoryInterface $repository
    ) {}

    /**
     * Generate unique slug from name.
     *
     * @param string $name
     * @param string|null $excludeId
     * @return string
     */
    public function generateUniqueSlug(string $name, ?string $excludeId = null): string
    {
        $baseSlug = Str::slug($name);
        $slug = $baseSlug;
        $counter = 1;

        while ($this->slugExists($slug, $excludeId)) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }

    /**
     * Check if slug exists.
     *
     * @param string $slug
     * @param string|null $excludeId
     * @return bool
     */
    private function slugExists(string $slug, ?string $excludeId = null): bool
    {
        $query = Destination::where('slug', $slug);

        if ($excludeId) {
            $query->where('id', '!=', $excludeId);
        }

        return $query->exists();
    }

    /**
     * Upload cover image.
     *
     * @param UploadedFile $file
     * @return string
     */
    public function uploadImage(UploadedFile $file): string
    {
        $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs('destinations', $filename, 'public');

        return $path;
    }

    /**
     * Delete cover image.
     *
     * @param string|null $path
     * @return bool
     */
    public function deleteImage(?string $path): bool
    {
        if (!$path) {
            return false;
        }

        if (Storage::disk('public')->exists($path)) {
            return Storage::disk('public')->delete($path);
        }

        return false;
    }

    /**
     * Get all active destinations (cached).
     *
     * @return Collection
     */
    public function getActiveDestinations(): Collection
    {
        return Cache::remember(self::CACHE_KEY, self::CACHE_TTL, function () {
            return $this->repository->getActiveOrdered();
        });
    }

    /**
     * Get all destinations for admin.
     *
     * @return Collection
     */
    public function getAllDestinations(): Collection
    {
        return $this->repository->getAll();
    }

    /**
     * Get destination by ID.
     *
     * @param string $id
     * @return Destination|null
     */
    public function getDestinationById(string $id): ?Destination
    {
        return $this->repository->findById($id);
    }

    /**
     * Create a new destination.
     *
     * @param array $data
     * @param UploadedFile|null $coverImage
     * @return Destination
     */
    public function createDestination(array $data, ?UploadedFile $coverImage = null): Destination
    {
        // Generate slug from name
        $data['slug'] = $this->generateUniqueSlug($data['name']);

        // Handle image upload
        if ($coverImage) {
            $data['cover_image'] = $this->uploadImage($coverImage);
        }

        $destination = $this->repository->create($data);

        $this->clearCache();

        return $destination;
    }

    /**
     * Update a destination.
     *
     * @param string $id
     * @param array $data
     * @param UploadedFile|null $coverImage
     * @return bool
     */
    public function updateDestination(string $id, array $data, ?UploadedFile $coverImage = null): bool
    {
        $destination = $this->repository->findById($id);

        if (!$destination) {
            return false;
        }

        // Regenerate slug if name changed
        if (isset($data['name']) && $data['name'] !== $destination->name) {
            $data['slug'] = $this->generateUniqueSlug($data['name'], $id);
        }

        // Handle image upload
        if ($coverImage) {
            // Delete old image
            $this->deleteImage($destination->cover_image);
            $data['cover_image'] = $this->uploadImage($coverImage);
        }

        $result = $this->repository->update($id, $data);

        if ($result) {
            $this->clearCache();
        }

        return $result;
    }

    /**
     * Delete a destination.
     *
     * @param string $id
     * @return bool
     */
    public function deleteDestination(string $id): bool
    {
        $destination = $this->repository->findById($id);

        if (!$destination) {
            return false;
        }

        // Delete cover image
        $this->deleteImage($destination->cover_image);

        $result = $this->repository->delete($id);

        if ($result) {
            $this->clearCache();
        }

        return $result;
    }

    /**
     * Clear destinations cache.
     *
     * @return void
     */
    public function clearCache(): void
    {
        Cache::forget(self::CACHE_KEY);
    }
}
