<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\RestaurantPageService;
use App\Contracts\Interfaces\MenuItemRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class RestaurantPageController extends Controller
{
    public function __construct(
        protected RestaurantPageService $restaurantService,
        protected MenuItemRepositoryInterface $menuItemRepository
    ) {}

    /**
     * Display the restaurant CMS page.
     */
    public function index(): View
    {
        $data = $this->restaurantService->getAdminData();
        $menuItems = $this->menuItemRepository->getAllActive();

        return view('admin.pages.restaurant.index', [
            'heroSection' => $data['hero'],
            'filosofiSection' => $data['filosofi'],
            'bestSellers' => $data['bestSellers'],
            'galleryImages' => $data['gallery'],
            'menuItems' => $menuItems,
            'galleryCount' => $this->restaurantService->getGalleryCount(),
        ]);
    }

    /**
     * Update the hero section.
     */
    public function updateHero(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:1000',
            'background_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        // Handle background image upload
        if ($request->hasFile('background_image')) {
            $imageUrl = $this->restaurantService->uploadHeroBackground($request->file('background_image'));
        }

        // Prepare extra_data
        $extraData = [];
        if (isset($imageUrl)) {
            $extraData['background_image'] = $imageUrl;
        }

        $this->restaurantService->updateHeroSection([
            'title' => $validated['title'] ?? null,
            'subtitle' => $validated['subtitle'] ?? null,
            'description' => $validated['description'] ?? null,
            'extra_data' => !empty($extraData) ? $extraData : null,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Hero section berhasil diperbarui!',
        ]);
    }

    /**
     * Update the filosofi section.
     */
    public function updateFilosofi(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:5000',
        ]);

        $this->restaurantService->updateFilosofiSection([
            'title' => $validated['title'] ?? null,
            'description' => $validated['description'] ?? null,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Filosofi section berhasil diperbarui!',
        ]);
    }

    /**
     * Update best seller slots.
     */
    public function updateBestSellers(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'slot1' => 'nullable|uuid|exists:menu_items,id',
            'slot2' => 'nullable|uuid|exists:menu_items,id',
            'slot3' => 'nullable|uuid|exists:menu_items,id',
        ]);

        $this->restaurantService->updateBestSellers([
            1 => $validated['slot1'] ?? null,
            2 => $validated['slot2'] ?? null,
            3 => $validated['slot3'] ?? null,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Menu Best Seller berhasil diperbarui!',
        ]);
    }

    /**
     * Upload a gallery image.
     */
    public function storeGalleryImage(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'alt_text' => 'nullable|string|max:255',
        ]);

        // Check max images limit (4)
        if ($this->restaurantService->getGalleryCount() >= 4) {
            return response()->json([
                'success' => false,
                'message' => 'Maksimal 4 gambar gallery!',
            ], 422);
        }

        $image = $this->restaurantService->uploadGalleryImage(
            $request->file('image'),
            $validated['alt_text'] ?? null
        );

        return response()->json([
            'success' => true,
            'message' => 'Gambar berhasil diupload!',
            'image' => [
                'id' => $image->id,
                'url' => $image->image_url,
                'alt_text' => $image->alt_text,
            ],
        ]);
    }

    /**
     * Delete a gallery image.
     */
    public function destroyGalleryImage(string $id): JsonResponse
    {
        $deleted = $this->restaurantService->deleteGalleryImage($id);

        if (!$deleted) {
            return response()->json([
                'success' => false,
                'message' => 'Gambar tidak ditemukan!',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Gambar berhasil dihapus!',
        ]);
    }

    /**
     * Update social media settings.
     */
    public function updateSocialMedia(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'instagram_username' => 'nullable|string|max:100',
            'instagram_url' => 'nullable|url|max:255',
        ]);

        $this->restaurantService->updateSocialMedia(
            $validated['instagram_username'] ?? null,
            $validated['instagram_url'] ?? null
        );

        return response()->json([
            'success' => true,
            'message' => 'Social media berhasil diperbarui!',
        ]);
    }
}
