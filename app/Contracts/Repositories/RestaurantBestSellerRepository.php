<?php

namespace App\Contracts\Repositories;

use App\Contracts\Interfaces\RestaurantBestSellerRepositoryInterface;
use App\Models\RestaurantBestSeller;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class RestaurantBestSellerRepository implements RestaurantBestSellerRepositoryInterface
{
    /**
     * Get all best sellers with menu items.
     *
     * @return Collection
     */
    public function getAll(): Collection
    {
        return RestaurantBestSeller::with('menuItem')->ordered()->get();
    }

    /**
     * Get all active best sellers ordered by slot.
     *
     * @return Collection
     */
    public function getActiveOrdered(): Collection
    {
        return RestaurantBestSeller::with('menuItem')
            ->active()
            ->ordered()
            ->get();
    }

    /**
     * Find best seller by ID.
     *
     * @param string $id
     * @return RestaurantBestSeller|null
     */
    public function findById(string $id): ?RestaurantBestSeller
    {
        return RestaurantBestSeller::with('menuItem')->find($id);
    }

    /**
     * Find best seller by slot number.
     *
     * @param int $slotNumber
     * @return RestaurantBestSeller|null
     */
    public function findBySlot(int $slotNumber): ?RestaurantBestSeller
    {
        return RestaurantBestSeller::with('menuItem')->slot($slotNumber)->first();
    }

    /**
     * Set a menu item to a specific slot.
     *
     * @param int $slotNumber
     * @param string $menuItemId
     * @return RestaurantBestSeller
     */
    public function setSlot(int $slotNumber, string $menuItemId): RestaurantBestSeller
    {
        return RestaurantBestSeller::updateOrCreate(
            ['slot_number' => $slotNumber],
            ['menu_item_id' => $menuItemId, 'is_active' => true]
        );
    }

    /**
     * Clear a slot.
     *
     * @param int $slotNumber
     * @return bool
     */
    public function clearSlot(int $slotNumber): bool
    {
        $slot = $this->findBySlot($slotNumber);

        if (!$slot) {
            return true;
        }

        return $slot->delete();
    }

    /**
     * Update all slots at once.
     *
     * @param array $slots [slotNumber => menuItemId]
     * @return bool
     */
    public function updateAllSlots(array $slots): bool
    {
        try {
            DB::beginTransaction();

            foreach ($slots as $slotNumber => $menuItemId) {
                if ($menuItemId) {
                    $this->setSlot($slotNumber, $menuItemId);
                } else {
                    $this->clearSlot($slotNumber);
                }
            }

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }
}
