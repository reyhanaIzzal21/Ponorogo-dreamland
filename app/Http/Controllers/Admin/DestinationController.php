<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDestinationRequest;
use App\Http\Requests\UpdateDestinationRequest;
use App\Models\Destination;
use App\Services\DestinationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DestinationController extends Controller
{
    public function __construct(
        protected DestinationService $destinationService
    ) {}

    /**
     * Display a listing of destinations.
     *
     * @return View
     */
    public function index(): View
    {
        $destinations = $this->destinationService->getAllDestinations();

        return view('admin.pages.destinations.index', [
            'destinations' => $destinations,
            'types' => Destination::getTypes(),
            'statuses' => Destination::getStatuses(),
        ]);
    }

    /**
     * Store a newly created destination.
     *
     * @param StoreDestinationRequest $request
     * @return JsonResponse
     */
    public function store(StoreDestinationRequest $request): JsonResponse
    {
        try {
            $destination = $this->destinationService->createDestination(
                $request->validated(),
                $request->file('cover_image')
            );

            return response()->json([
                'success' => true,
                'message' => 'Destinasi berhasil ditambahkan.',
                'data' => $this->formatDestinationData($destination),
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menambahkan destinasi: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified destination.
     *
     * @param string $id
     * @return JsonResponse
     */
    public function show(string $id): JsonResponse
    {
        $destination = $this->destinationService->getDestinationById($id);

        if (!$destination) {
            return response()->json([
                'success' => false,
                'message' => 'Destinasi tidak ditemukan.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $this->formatDestinationData($destination),
        ]);
    }

    /**
     * Update the specified destination.
     *
     * @param UpdateDestinationRequest $request
     * @param string $id
     * @return JsonResponse
     */
    public function update(UpdateDestinationRequest $request, string $id): JsonResponse
    {
        try {
            $result = $this->destinationService->updateDestination(
                $id,
                $request->validated(),
                $request->file('cover_image')
            );

            if (!$result) {
                return response()->json([
                    'success' => false,
                    'message' => 'Destinasi tidak ditemukan.',
                ], 404);
            }

            $destination = $this->destinationService->getDestinationById($id);

            return response()->json([
                'success' => true,
                'message' => 'Destinasi berhasil diperbarui.',
                'data' => $this->formatDestinationData($destination),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui destinasi: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Remove the specified destination.
     *
     * @param string $id
     * @return JsonResponse
     */
    public function destroy(string $id): JsonResponse
    {
        try {
            $result = $this->destinationService->deleteDestination($id);

            if (!$result) {
                return response()->json([
                    'success' => false,
                    'message' => 'Destinasi tidak ditemukan.',
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'Destinasi berhasil dihapus.',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus destinasi: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Format destination data for JSON response.
     *
     * @param Destination $destination
     * @return array
     */
    private function formatDestinationData(Destination $destination): array
    {
        return [
            'id' => $destination->id,
            'name' => $destination->name,
            'slug' => $destination->slug,
            'description' => $destination->description,
            'type' => $destination->type,
            'type_label' => $destination->type_label,
            'status' => $destination->status,
            'status_label' => $destination->status_label,
            'cover_image' => $destination->cover_image,
            'cover_image_url' => $destination->cover_image_url,
            'sort_order' => $destination->sort_order,
            'is_active' => $destination->is_active,
            'can_be_reserved' => $destination->canBeReserved(),
            'updated_at' => $destination->updated_at->diffForHumans(),
        ];
    }
}
