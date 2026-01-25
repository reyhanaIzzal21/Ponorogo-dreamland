<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Menu\StoreCategoryRequest;
use App\Http\Requests\Admin\Menu\UpdateCategoryRequest;
use App\Models\MenuCategory;
use App\Services\MenuService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MenuCategoryController extends Controller
{
    public function __construct(
        protected MenuService $menuService
    ) {}

    /**
     * Display the menu management page.
     */
    public function index(): View
    {
        $categories = $this->menuService->getAllCategories();
        $types = MenuCategory::getTypes();

        return view('admin.pages.menu.index', compact('categories', 'types'));
    }

    /**
     * Store a newly created category.
     */
    public function store(StoreCategoryRequest $request): JsonResponse
    {
        $category = $this->menuService->createCategory($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Kategori berhasil ditambahkan',
            'data' => $category,
        ]);
    }

    /**
     * Get category data for editing.
     */
    public function show(string $id): JsonResponse
    {
        $category = $this->menuService->getCategoryById($id);

        if (!$category) {
            return response()->json([
                'success' => false,
                'message' => 'Kategori tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $category,
        ]);
    }

    /**
     * Update the specified category.
     */
    public function update(UpdateCategoryRequest $request, string $id): JsonResponse
    {
        $result = $this->menuService->updateCategory($id, $request->validated());

        if (!$result) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengupdate kategori',
            ], 400);
        }

        return response()->json([
            'success' => true,
            'message' => 'Kategori berhasil diupdate',
        ]);
    }

    /**
     * Remove the specified category.
     */
    public function destroy(string $id): JsonResponse
    {
        $result = $this->menuService->deleteCategory($id);

        if (!$result) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus kategori',
            ], 400);
        }

        return response()->json([
            'success' => true,
            'message' => 'Kategori berhasil dihapus',
        ]);
    }

    /**
     * Reorder categories.
     */
    public function reorder(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'order' => 'required|array',
            'order.*' => 'required|string|exists:menu_categories,id',
        ]);

        $this->menuService->reorderCategories($validated['order']);

        return response()->json([
            'success' => true,
            'message' => 'Urutan kategori berhasil diupdate',
        ]);
    }
}
