<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LandingPageSection;
use App\Services\LandingPageService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LandingPageController extends Controller
{
    public function __construct(
        protected LandingPageService $landingPageService
    ) {}

    /**
     * Display the landing page manager.
     *
     * @return View
     */
    public function index(): View
    {
        $heroSection = $this->landingPageService->getHeroSection();
        $aboutSection = $this->landingPageService->getAboutSection();
        $whySection = $this->landingPageService->getWhyChooseUsSection();
        $momentSection = $this->landingPageService->getMomentSection();

        return view('admin.pages.landing-page.index', [
            'heroSection' => $heroSection,
            'aboutSection' => $aboutSection,
            'whySection' => $whySection,
            'momentSection' => $momentSection,
        ]);
    }

    /**
     * Update Hero section.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function updateHero(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'highlight_text' => 'nullable|string|max:255',
        ]);

        $this->landingPageService->updateHeroSection([
            'title' => $validated['title'],
            'subtitle' => $validated['subtitle'] ?? null,
            'description' => $validated['description'] ?? null,
            'extra_data' => [
                'highlight_text' => $validated['highlight_text'] ?? '',
            ],
        ]);

        return redirect()->back()->with('success', 'Hero section berhasil diperbarui!');
    }

    /**
     * Update About section.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function updateAbout(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'extra_description' => 'nullable|string',
        ]);

        $this->landingPageService->updateAboutSection([
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'extra_data' => [
                'extra_description' => $validated['extra_description'] ?? '',
            ],
        ]);

        return redirect()->back()->with('success', 'Section Tentang Kami berhasil diperbarui!');
    }

    /**
     * Update Why Choose Us section.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function updateWhy(Request $request): RedirectResponse
    {
                $validated = $request->validate([
                    'features' => 'required|array|min:1|max:4',
                    'features.*.icon' => 'required|string|max:10',
                    'features.*.title' => 'required|string|max:255',
                    'features.*.description' => 'required|string|max:500',
                ]);

                $this->landingPageService->updateWhyChooseUsSection([
                    'extra_data' => [
                        'features' => $validated['features'],
                    ],
                ]);

        return redirect()->back()->with('success', 'Section Why Choose Us berhasil diperbarui!');
    }

    /**
     * Update Moment section.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function updateMoment(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
        ]);

        $this->landingPageService->updateMomentSection([
            'title' => $validated['title'] ?? null,
            'subtitle' => $validated['subtitle'] ?? null,
        ]);

        return redirect()->back()->with('success', 'Section Momen Spesial berhasil diperbarui!');
    }

    /**
     * Store a new image for a section.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function storeImage(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'section_type' => 'required|in:hero,about,why_choose_us,moment',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'image_type' => 'nullable|string|max:50',
            'alt_text' => 'nullable|string|max:255',
        ]);

        $imageType = $validated['image_type'] ?? 'default';

        // For About section with left/right type, replace existing
        if ($validated['section_type'] === LandingPageSection::TYPE_ABOUT && in_array($imageType, ['left', 'right'])) {
            $image = $this->landingPageService->updateAboutImage($imageType, $request->file('image'));
        } else {
            $image = $this->landingPageService->uploadImage(
                $validated['section_type'],
                $request->file('image'),
                $imageType,
                $validated['alt_text'] ?? null
            );
        }

        if (!$image) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengupload gambar. Section tidak ditemukan.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Gambar berhasil diupload!',
            'data' => [
                'id' => $image->id,
                'url' => $image->image_url,
                'image_type' => $image->image_type,
            ],
        ]);
    }

    /**
     * Delete an image.
     *
     * @param string $id
     * @return JsonResponse
     */
    public function destroyImage(string $id): JsonResponse
    {
        $result = $this->landingPageService->deleteImage($id);

        if (!$result) {
            return response()->json([
                'success' => false,
                'message' => 'Gambar tidak ditemukan.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Gambar berhasil dihapus!',
        ]);
    }
}
