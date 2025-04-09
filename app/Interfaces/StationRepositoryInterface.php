<?php

namespace App\Interfaces;

use App\Models\Station;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface StationRepositoryInterface
{

    public function getInRadius(array $data): Collection;

    public function search(array $data, int $quantity): LengthAwarePaginator;
    public function getOrFail(int $id): Station;
    public function update(int $id, array $data): Station;
    public function create(array $data): Station;
    public function delete(int $id): int;
}
