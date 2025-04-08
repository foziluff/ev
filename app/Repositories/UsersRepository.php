<?php

namespace App\Repositories;
use App\Models\User as Model;

class UsersRepository extends CoreRepository
{
    protected function getModel(): string
    {
        return Model::class;
    }

    public function findByPhone(string $phone): ?Model
    {
        return $this->startInit()->where('phone', $phone)->first();
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
