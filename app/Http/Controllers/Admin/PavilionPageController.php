<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Pavilion\SaveAllPavilionRequest;
use App\Http\Requests\Admin\Pavilion\StorePavilionFacilityRequest;
use App\Http\Requests\Admin\Pavilion\StorePavilionLayoutRequest;
use App\Http\Requests\Admin\Pavilion\UpdatePavilionFacilitiesRequest;
use App\Http\Requests\Admin\Pavilion\UpdatePavilionHeroRequest;
use App\Http\Requests\Admin\Pavilion\UpdatePavilionLayoutRequest;
use App\Http\Requests\Admin\Pavilion\UpdatePavilionSpecsRequest;
use App\Services\PavilionPageService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class PavilionPageController extends Controller
{
    public function __construct(
        protected PavilionPageService $pavilionService
    ) {}

    /**
     * Display the pavilion CMS page.
     */
    public function index(): View
    {
        $data = $this->pavilionService->getAdminData();

        return view('admin.pages.pavilion.index', [
            'heroSection' => $data['hero'],
            'specsSection' => $data['specs'],
            'facilitiesSection' => $data['facilitiesSection'],
            'facilities' => $data['facilities'],
            'layouts' => $data['layouts'],
        ]);
    }

    /**
     * Update the hero section.
     */
    public function updateHero(UpdatePavilionHeroRequest $request): JsonResponse
    {
        $validated = $request->validated();

        // Handle background image upload
        if ($request->hasFile('background_image')) {
            $this->pavilionService->uploadHeroBackground($request->file('background_image'));
        }

        // Prepare extra_data
        $extraData = [];
        if (isset($validated['highlighted_title'])) {
            $extraData['highlighted_title'] = $validated['highlighted_title'];
        }
        if (isset($validated['cta_text'])) {
            $extraData['cta_text'] = $validated['cta_text'];
        }
        if (isset($validated['cta_url'])) {
            $extraData['cta_url'] = $validated['cta_url'];
        }

        $this->pavilionService->updateHeroSection([
            'title' => $validated['title'] ?? null,
            'description' => $validated['description'] ?? null,
            'extra_data' => !empty($extraData) ? $extraData : null,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Hero section berhasil diperbarui!',
        ]);
    }

    /**
     * Update the specs section.
     */
    public function updateSpecs(UpdatePavilionSpecsRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $extraData = [];
        if (isset($validated['specs_items'])) {
            $extraData['specs_items'] = $validated['specs_items'];
        }

        $this->pavilionService->updateSpecsSection([
            'title' => $validated['title'] ?? null,
            'subtitle' => $validated['subtitle'] ?? null,
            'extra_data' => $extraData,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Spesifikasi berhasil diperbarui!',
        ]);
    }

    /**
     * Update facilities (bulk update).
     */
    public function updateFacilities(UpdatePavilionFacilitiesRequest $request): JsonResponse
    {
        $validated = $request->validated();

        // Update facilities section title/description
        $this->pavilionService->updateFacilitiesSection([
            'title' => $validated['section_title'] ?? null,
            'description' => $validated['section_description'] ?? null,
        ]);

        // Bulk update facilities
        if (isset($validated['facilities'])) {
            $this->pavilionService->bulkUpdateFacilities($validated['facilities']);
        }

        return response()->json([
            'success' => true,
            'message' => 'Fasilitas berhasil diperbarui!',
        ]);
    }

    /**
     * Store a new facility.
     */
    public function storeFacility(StorePavilionFacilityRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $facility = $this->pavilionService->addFacility($validated);

        return response()->json([
            'success' => true,
            'message' => 'Fasilitas berhasil ditambahkan!',
            'facility' => [
                'id' => $facility->id,
                'icon' => $facility->icon,
                'title' => $facility->title,
                'description' => $facility->description,
            ],
        ]);
    }

    /**
     * Delete a facility.
     */
    public function destroyFacility(string $id): JsonResponse
    {
        $deleted = $this->pavilionService->deleteFacility($id);

        if (!$deleted) {
            return response()->json([
                'success' => false,
                'message' => 'Fasilitas tidak ditemukan!',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Fasilitas berhasil dihapus!',
        ]);
    }

    /**
     * Upload facilities section image.
     */
    public function uploadFacilitiesImage(Request $request): JsonResponse
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $imageUrl = $this->pavilionService->uploadFacilitiesImage($request->file('image'));

        return response()->json([
            'success' => true,
            'message' => 'Gambar fasilitas berhasil diupload!',
            'image_url' => $imageUrl,
        ]);
    }

    /**
     * Upload a layout image.
     */
    public function storeLayout(StorePavilionLayoutRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $layout = $this->pavilionService->uploadLayout(
            $request->file('image'),
            $validated['title']
        );

        return response()->json([
            'success' => true,
            'message' => 'Layout berhasil diupload!',
            'layout' => [
                'id' => $layout->id,
                'title' => $layout->title,
                'image_url' => $layout->image_url,
            ],
        ]);
    }

    /**
     * Update a layout.
     */
    public function updateLayout(Request $request, string $id): JsonResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $file = $request->hasFile('image') ? $request->file('image') : null;

        $updated = $this->pavilionService->updateLayout($id, ['title' => $validated['title']], $file);

        if (!$updated) {
            return response()->json([
                'success' => false,
                'message' => 'Layout tidak ditemukan!',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Layout berhasil diperbarui!',
        ]);
    }

    /**
     * Delete a layout.
     */
    public function destroyLayout(string $id): JsonResponse
    {
        $deleted = $this->pavilionService->deleteLayout($id);

        if (!$deleted) {
            return response()->json([
                'success' => false,
                'message' => 'Layout tidak ditemukan!',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Layout berhasil dihapus!',
        ]);
    }

    /**
     * Save all sections at once.
     */
    public function saveAll(SaveAllPavilionRequest $request): JsonResponse
    {
        $validated = $request->validated();

        // Update Hero
        if (isset($validated['hero'])) {
            $heroData = $validated['hero'];
            $extraData = [];
            if (isset($heroData['highlighted_title'])) {
                $extraData['highlighted_title'] = $heroData['highlighted_title'];
            }
            $this->pavilionService->updateHeroSection([
                'title' => $heroData['title'] ?? null,
                'description' => $heroData['description'] ?? null,
                'extra_data' => $extraData,
            ]);
        }

        // Update Specs
        if (isset($validated['specs'])) {
            $specsData = $validated['specs'];
            $this->pavilionService->updateSpecsSection([
                'title' => $specsData['title'] ?? null,
                'subtitle' => $specsData['subtitle'] ?? null,
                'extra_data' => [
                    'specs_items' => $specsData['items'] ?? [],
                ],
            ]);
        }

        // Update Facilities section title and items
        if (isset($validated['facilities'])) {
            $facilitiesData = $validated['facilities'];

            // Update facilities section (now separate from hero)
            $this->pavilionService->updateFacilitiesSection([
                'title' => $facilitiesData['title'] ?? null,
                'description' => $facilitiesData['description'] ?? null,
            ]);

            // Bulk update facilities
            if (isset($facilitiesData['items'])) {
                $facilities = array_map(function ($item) {
                    return [
                        'icon' => $item['icon'],
                        'title' => $item['title'],
                        'description' => $item['desc'] ?? null,
                    ];
                }, $facilitiesData['items']);
                $this->pavilionService->bulkUpdateFacilities($facilities);
            }
        }

        // Update Layouts titles
        if (isset($validated['layouts'])) {
            foreach ($validated['layouts'] as $layoutData) {
                if (isset($layoutData['id']) && isset($layoutData['title'])) {
                    $this->pavilionService->updateLayout($layoutData['id'], ['title' => $layoutData['title']]);
                }
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Semua perubahan berhasil disimpan!',
        ]);
    }
}
