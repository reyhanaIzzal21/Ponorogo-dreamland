<?php

namespace App\Contracts\Interfaces;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface ReservationRepositoryInterface
{
    public function all(): Collection;
    public function paginate(int $perPage = 10): LengthAwarePaginator;
    public function create(array $data);
    public function find($id);
    public function update($id, array $data);
    public function delete($id);
    public function search(string $query, int $perPage = 10): LengthAwarePaginator;
    public function filterByDate(string $date, int $perPage = 10): LengthAwarePaginator;
    public function getFiltered(array $filters, int $perPage = 10): LengthAwarePaginator;
    public function getFilteredForExport(array $filters): Collection;
    public function getByDateRange(string $startDate, string $endDate): Collection;
}
