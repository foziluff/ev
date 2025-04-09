<?php

namespace App\Interfaces;

use App\Models\Company;
use Illuminate\Database\Eloquent\Collection;

interface CompanyRepositoryInterface
{
    public function getAll(): Collection;
    public function getOrFail(int $id): Company;
    public function update(int $id, array $data): Company;
    public function create(array $data): Company;
    public function delete(int $id): int;
}
