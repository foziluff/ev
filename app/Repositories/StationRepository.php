<?php

namespace App\Repositories;
use App\Interfaces\StationRepositoryInterface;
use App\Models\Station as Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class StationRepository extends CoreRepository implements StationRepositoryInterface
{
    protected function getModel(): string
    {
        return Model::class;
    }

    public function getInRadius(array $data): Collection
    {
        return $this->startInit()
            ->selectRaw("*, ROUND(
                (6371000 *  acos(
                    cos(radians(?)) *
                    cos(radians(latitude)) *
                    cos(radians(longitude) - radians(?)) +
                    sin(radians(?)) *
                    sin(radians(latitude))
                ))) AS distance", [$data['latitude'], $data['longitude'], $data['latitude']])
            ->having("distance", "<=", $data['radius'])
            ->orderBy("distance")
            ->with('company')
            ->get();
    }


    public function search(array $data, int $quantity): LengthAwarePaginator
    {
        return $this->startInit()
            ->where('name', 'like', '%' . $data['query'] . '%')
            ->orderBy('name')
            ->with('company')
            ->paginate($quantity);
    }

    public function getOrFail(int $id): Model
    {
        return $this->startInit()
            ->findOrFail($id);
    }

    public function update(int $id, array $data): Model
    {
        $record = $this->startInit()->findOrFail($id);
        $record->update($data);
        return $record;
    }

    public function create(array $data): Model
    {
        return $this->startInit()->create($data);
    }

    public function delete(int $id): int
    {
        return $this->startInit()->where('id', $id)->delete();
    }
}
