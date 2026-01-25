<?php

namespace App\Http\Controllers;

use App\Services\MenuService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MenuController extends Controller
{
    public function __construct(
        protected MenuService $menuService
    ) {}

    /**
     * Display the menu page for users.
     */
    public function index(): View
    {
        $categories = $this->menuService->getAllCategoriesWithItems();

        return view('user.pages.destinations.restaurant.menu', compact('categories'));
    }

    /**
     * Get paginated items for a category (AJAX endpoint for lazy loading).
     */
    public function getCategoryItems(Request $request, string $categoryId): JsonResponse
    {
        $perPage = $request->query('per_page', 12);
        $items = $this->menuService->getCategoryItemsPaginated($categoryId, $perPage);

        return response()->json([
            'success' => true,
            'data' => $items->items(),
            'meta' => [
                'current_page' => $items->currentPage(),
                'last_page' => $items->lastPage(),
                'per_page' => $items->perPage(),
                'total' => $items->total(),
                'has_more' => $items->hasMorePages(),
            ],
        ]);
    }
}
