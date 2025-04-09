<?php

namespace App\Services;

use App\Interfaces\StationRepositoryInterface;
use App\Models\Station;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class StationService extends CoreService
{
    public function __construct(
        readonly private StationRepositoryInterface $stationRepository,
    ){
        parent::__construct();
    }

    public function getInRadius(array $data): Collection
    {
        return $this->stationRepository->getInRadius($data);
    }

    public function search(array $data, int $quantity): LengthAwarePaginator
    {
        return $this->stationRepository->search($data, $quantity);
    }

    public function create(array $data): Station
    {
        return $this->stationRepository->create($data);
    }

    public function getOrFail(int $id): Station
    {
        return $this->stationRepository->getOrFail($id);
    }

    public function update(int $id, array $data): Station
    {
        return $this->stationRepository->update($id, $data);
    }

    public function delete(int $id): int
    {
        return $this->stationRepository->delete($id);
    }
}
