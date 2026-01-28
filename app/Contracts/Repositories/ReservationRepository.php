<?php

namespace App\Contracts\Repositories;

use App\Contracts\Interfaces\ReservationRepositoryInterface;
use App\Models\Reservation;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class ReservationRepository implements ReservationRepositoryInterface
{
    public function all(): Collection
    {
        return Reservation::latest()->get();
    }

    public function paginate(int $perPage = 10): LengthAwarePaginator
    {
        return Reservation::with('destination')->latest()->paginate($perPage)->withQueryString();;
    }

    public function create(array $data)
    {
        return Reservation::create($data);
    }

    public function find($id)
    {
        return Reservation::findOrFail($id);
    }

    public function update($id, array $data)
    {
        $reservation = $this->find($id);
        $reservation->update($data);
        return $reservation;
    }

    public function delete($id)
    {
        $reservation = $this->find($id);
        return $reservation->delete();
    }

    public function search(string $query, int $perPage = 10): LengthAwarePaginator
    {
        return Reservation::with('destination')
            ->where('user_name', 'like', "%{$query}%")
            ->orWhere('user_whatsapp', 'like', "%{$query}%")
            ->latest()
            ->paginate($perPage)->withQueryString();;
    }

    public function filterByDate(string $date, int $perPage = 10): LengthAwarePaginator
    {
        return Reservation::with('destination')
            ->whereDate('reservation_date', $date)
            ->latest()
            ->paginate($perPage)->withQueryString();;
    }

    public function getFiltered(array $filters, int $perPage = 10): LengthAwarePaginator
    {
        $paginator = $this->buildFilteredQuery($filters)->paginate($perPage);
        $paginator->appends($filters);
        return $paginator;
    }

    public function getFilteredForExport(array $filters): Collection
    {
        return $this->buildFilteredQuery($filters)->get();
    }

    private function buildFilteredQuery(array $filters): \Illuminate\Database\Eloquent\Builder
    {
        $query = Reservation::with('destination')->latest();

        if (!empty($filters['search'])) {
            $searchTerm = $filters['search'];
            $query->where(function ($q) use ($searchTerm) {
                $q->where('user_name', 'like', "%{$searchTerm}%")
                    ->orWhere('user_whatsapp', 'like', "%{$searchTerm}%");
            });
        }

        if (!empty($filters['date'])) {
            $query->whereDate('reservation_date', $filters['date']);
        }

        if (!empty($filters['type']) && $filters['type'] !== 'all') {
            $type = $filters['type'];

            // detect UUID-ish (simple check: contains dash and length >= 8)
            if (preg_match('/[0-9a-fA-F\-]{8,}/', $type)) {
                $query->where('destination_id', $type);
            } else {
                // Map legacy frontend type names to destination.type
                $typeMap = [
                    'resto' => 'restaurant',
                    'pendopo' => 'venue',
                ];
                $destinationType = $typeMap[$type] ?? $type;

                $query->whereHas('destination', function ($q) use ($destinationType) {
                    $q->where('type', $destinationType);
                });
            }
        }

        // Status filter (optional)
        if (!empty($filters['status']) && $filters['status'] !== 'all') {
            $query->where('status', $filters['status']);
        }

        return $query;
    }

    public function getByDateRange(string $startDate, string $endDate): Collection
    {
        return Reservation::with('destination')
            ->whereBetween('reservation_date', [$startDate, $endDate])
            ->latest()
            ->get();
    }
}
