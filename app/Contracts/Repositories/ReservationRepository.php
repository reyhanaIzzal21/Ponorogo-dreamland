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
        return Reservation::with('destination')->latest()->paginate($perPage);
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
            ->paginate($perPage);
    }

    public function filterByDate(string $date, int $perPage = 10): LengthAwarePaginator
    {
        return Reservation::with('destination')
            ->whereDate('reservation_date', $date)
            ->latest()
            ->paginate($perPage);
    }

    public function getByDateRange(string $startDate, string $endDate): Collection
    {
        return Reservation::with('destination')
            ->whereBetween('reservation_date', [$startDate, $endDate])
            ->latest()
            ->get();
    }
}
