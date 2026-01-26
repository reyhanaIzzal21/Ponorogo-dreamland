<?php

namespace App\Contracts\Interfaces;

use App\Models\RestaurantBestSeller;
use Illuminate\Database\Eloquent\Collection;

interface RestaurantBestSellerRepositoryInterface
{
    /**
     * Get all best sellers with menu items.
     *
     * @return Collection
     */
    public function getAll(): Collection;

    /**
     * Get all active best sellers ordered by slot.
     *
     * @return Collection
     */
    public function getActiveOrdered(): Collection;

    /**
     * Find best seller by ID.
     *
     * @param string $id
     * @return RestaurantBestSeller|null
     */
    public function findById(string $id): ?RestaurantBestSeller;

    /**
     * Find best seller by slot number.
     *
     * @param int $slotNumber
     * @return RestaurantBestSeller|null
     */
    public function findBySlot(int $slotNumber): ?RestaurantBestSeller;

    /**
     * Set a menu item to a specific slot.
     *
     * @param int $slotNumber
     * @param string $menuItemId
     * @return RestaurantBestSeller
     */
    public function setSlot(int $slotNumber, string $menuItemId): RestaurantBestSeller;

    /**
     * Clear a slot.
     *
     * @param int $slotNumber
     * @return bool
     */
    public function clearSlot(int $slotNumber): bool;

    /**
     * Update all slots at once.
     *
     * @param array $slots [slotNumber => menuItemId]
     * @return bool
     */
    public function updateAllSlots(array $slots): bool;
}
