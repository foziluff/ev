<?php

namespace App\Repositories;
use App\Models\Company as Model;
use App\Interfaces\CompanyRepositoryInterface;
//use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class CompanyRepository extends CoreRepository implements CompanyRepositoryInterface
{
    protected function getModel(): string
    {
        return Model::class;
    }

    public function getAll(): Collection
    {
        return $this->startInit()->get();
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
