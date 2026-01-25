<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Menu\StorePriceGroupRequest;
use App\Http\Requests\Admin\Menu\UpdatePriceGroupRequest;
use App\Services\MenuService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MenuPriceGroupController extends Controller
{
    public function __construct(
        protected MenuService $menuService
    ) {}

    /**
     * Get price groups for a category.
     */
    public function index(Request $request): JsonResponse
    {
        $categoryId = $request->query('category_id');

        if (!$categoryId) {
            return response()->json([
                'success' => false,
                'message' => 'Category ID is required',
            ], 400);
        }

        $priceGroups = $this->menuService->getPriceGroupsByCategory($categoryId);

        return response()->json([
            'success' => true,
            'data' => $priceGroups,
        ]);
    }

    /**
     * Store a newly created price group.
     */
    public function store(StorePriceGroupRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $items = $validated['items'] ?? [];
        unset($validated['items']);

        $priceGroup = $this->menuService->createPriceGroup($validated, $items);

        return response()->json([
            'success' => true,
            'message' => 'Price group berhasil ditambahkan',
            'data' => $priceGroup,
        ]);
    }

    /**
     * Get price group data for editing.
     */
    public function show(string $id): JsonResponse
    {
        $priceGroup = $this->menuService->getPriceGroupById($id);

        if (!$priceGroup) {
            return response()->json([
                'success' => false,
                'message' => 'Price group tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $priceGroup,
        ]);
    }

    /**
     * Update the specified price group.
     */
    public function update(UpdatePriceGroupRequest $request, string $id): JsonResponse
    {
        $validated = $request->validated();

        $items = $validated['items'] ?? null;
        unset($validated['items']);

        $result = $this->menuService->updatePriceGroup($id, $validated, $items);

        if (!$result) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengupdate price group',
            ], 400);
        }

        return response()->json([
            'success' => true,
            'message' => 'Price group berhasil diupdate',
        ]);
    }

    /**
     * Remove the specified price group.
     */
    public function destroy(string $id): JsonResponse
    {
        $result = $this->menuService->deletePriceGroup($id);

        if (!$result) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus price group',
            ], 400);
        }

        return response()->json([
            'success' => true,
            'message' => 'Price group berhasil dihapus',
        ]);
    }

    /**
     * Add item to price group.
     */
    public function addItem(Request $request, string $groupId): JsonResponse
    {
        $validated = $request->validate([
            'item_name' => 'required|string|max:255',
        ], [
            'item_name.required' => 'Nama item wajib diisi.',
            'item_name.max' => 'Nama item maksimal 255 karakter.',
        ]);

        $this->menuService->addPriceGroupItem($groupId, $validated['item_name']);

        return response()->json([
            'success' => true,
            'message' => 'Item berhasil ditambahkan',
        ]);
    }

    /**
     * Remove item from price group.
     */
    public function removeItem(string $itemId): JsonResponse
    {
        $result = $this->menuService->removePriceGroupItem($itemId);

        if (!$result) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus item',
            ], 400);
        }

        return response()->json([
            'success' => true,
            'message' => 'Item berhasil dihapus',
        ]);
    }

    /**
     * Reorder price groups.
     */
    public function reorder(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'order' => 'required|array',
            'order.*' => 'required|string|exists:menu_price_groups,id',
        ]);

        $this->menuService->reorderPriceGroups($validated['order']);

        return response()->json([
            'success' => true,
            'message' => 'Urutan price group berhasil diupdate',
        ]);
    }
}
