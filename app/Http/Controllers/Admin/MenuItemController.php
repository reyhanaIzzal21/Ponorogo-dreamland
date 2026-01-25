<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Menu\StoreItemRequest;
use App\Http\Requests\Admin\Menu\UpdateItemRequest;
use App\Services\MenuService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MenuItemController extends Controller
{
    public function __construct(
        protected MenuService $menuService
    ) {}

    /**
     * Get items for a category.
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

        $items = $this->menuService->getItemsByCategory($categoryId);

        return response()->json([
            'success' => true,
            'data' => $items,
        ]);
    }

    /**
     * Store a newly created menu item.
     */
    public function store(StoreItemRequest $request): JsonResponse
    {
        $validated = $request->validated();

        // Extract file and package contents from validated data
        $image = $request->file('image');
        $packageContents = $validated['package_contents'] ?? [];

        // Remove non-model fields
        unset($validated['package_contents'], $validated['image']);

        // Let Service handle file upload and slug generation
        $item = $this->menuService->createMenuItem($validated, $image, $packageContents);

        return response()->json([
            'success' => true,
            'message' => 'Menu item berhasil ditambahkan',
            'data' => $item,
        ]);
    }

    /**
     * Get menu item data for editing.
     */
    public function show(string $id): JsonResponse
    {
        $item = $this->menuService->getItemById($id);

        if (!$item) {
            return response()->json([
                'success' => false,
                'message' => 'Menu item tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $item,
        ]);
    }

    /**
     * Update the specified menu item.
     */
    public function update(UpdateItemRequest $request, string $id): JsonResponse
    {
        $validated = $request->validated();

        // Extract file and package contents from validated data
        $image = $request->file('image');
        $packageContents = $validated['package_contents'] ?? null;

        // Remove non-model fields
        unset($validated['package_contents'], $validated['image']);

        // Let Service handle file upload and slug generation
        $result = $this->menuService->updateMenuItem($id, $validated, $image, $packageContents);

        if (!$result) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengupdate menu item',
            ], 400);
        }

        return response()->json([
            'success' => true,
            'message' => 'Menu item berhasil diupdate',
        ]);
    }

    /**
     * Remove the specified menu item.
     */
    public function destroy(string $id): JsonResponse
    {
        // Service handles image deletion
        $result = $this->menuService->deleteMenuItem($id);

        if (!$result) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus menu item',
            ], 400);
        }

        return response()->json([
            'success' => true,
            'message' => 'Menu item berhasil dihapus',
        ]);
    }

    /**
     * Reorder menu items.
     */
    public function reorder(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'order' => 'required|array',
            'order.*' => 'required|string|exists:menu_items,id',
        ]);

        $this->menuService->reorderItems($validated['order']);

        return response()->json([
            'success' => true,
            'message' => 'Urutan item berhasil diupdate',
        ]);
    }
}
