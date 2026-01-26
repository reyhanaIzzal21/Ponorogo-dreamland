<?php

namespace App\Contracts\Repositories;

use App\Contracts\Interfaces\RestaurantGalleryImageRepositoryInterface;
use App\Models\RestaurantGalleryImage;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class RestaurantGalleryImageRepository implements RestaurantGalleryImageRepositoryInterface
{
    /**
     * Get all gallery images.
     *
     * @return Collection
     */
    public function getAll(): Collection
    {
        return RestaurantGalleryImage::ordered()->get();
    }

    /**
     * Get all active gallery images ordered.
     *
     * @return Collection
     */
    public function getActiveOrdered(): Collection
    {
        return RestaurantGalleryImage::active()->ordered()->get();
    }

    /**
     * Find image by ID.
     *
     * @param string $id
     * @return RestaurantGalleryImage|null
     */
    public function findById(string $id): ?RestaurantGalleryImage
    {
        return RestaurantGalleryImage::find($id);
    }

    /**
     * Create a new gallery image.
     *
     * @param array $data
     * @return RestaurantGalleryImage
     */
    public function create(array $data): RestaurantGalleryImage
    {
        if (!isset($data['sort_order'])) {
            $maxOrder = RestaurantGalleryImage::max('sort_order') ?? 0;
            $data['sort_order'] = $maxOrder + 1;
        }

        return RestaurantGalleryImage::create($data);
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
     * Get the count of active images.
     *
     * @return int
     */
    public function getActiveCount(): int
    {
        return RestaurantGalleryImage::active()->count();
    }

    /**
     * Reorder images.
     *
     * @param array $orderedIds
     * @return bool
     */
    public function reorder(array $orderedIds): bool
    {
        try {
            DB::beginTransaction();

            foreach ($orderedIds as $order => $id) {
                RestaurantGalleryImage::where('id', $id)->update(['sort_order' => $order + 1]);
            }

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }
}
