<?php

namespace App\Services;
use App\Interfaces\CompanyRepositoryInterface;
use App\Models\Company;
use Illuminate\Database\Eloquent\Collection;

class CompanyService extends CoreService
{
    public function __construct(
        readonly private CompanyRepositoryInterface $companyRepository,
    ){
        parent::__construct();
    }

    public function getAll(): Collection
    {
        return $this->companyRepository->getAll();
    }

    public function create(array $data): Company
    {
        return $this->companyRepository->create($data);
    }

    public function getOrFail(int $id): Company
    {
        return $this->companyRepository->getOrFail($id);
    }

    public function update(int $id, array $data): Company
    {
        return $this->companyRepository->update($id, $data);
    }

    public function delete(int $id): int
    {
        return $this->companyRepository->delete($id);
    }
}
