<?php

namespace App\Services;

use App\Repositories\CompanyRepository;
use App\Models\Company;

class CompanyService
{
    protected $repository;

    public function __construct(CompanyRepository $repository)
    {
        $this->repository = $repository;
    }

    public function listCompanies(array $filters = [])
    {
        return $this->repository->getAll($filters);
    }

    public function createCompany(array $data)
    {
        return $this->repository->create($data);
    }

    public function updateCompany(Company $company, array $daata)
    {
        return $this->repository->update($company, $data);
    }

    public function deleteCompany(Company $company)
    {
        return $this->repository->delete($company);
    }
}