<?php

namespace App\Http\Controllers;

use App\Http\request\StoreCompanyRequest;
use App\Http\request\UpdateCompanyRequest;
use App\Models\Company;
use App\Services\CompanyService;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    protected $service;

    public function __construct(CompanyService $service)
    {
        $this->service = $service;
    }
    

    public function index(Request $request)
    {
        $filters = $request->only(['name', 'responsible_id']);
        return response()->json($this->service->listCompanies($filters));
    }

    

    public function store(StoreCompanyRequest $request)
    {
        $company = $this->service->createCompany($request->validated());
        return response()->json($company, 201);
    }


    public function show(Company $company)
    {
        return response()->json($company);
    }


    public function update(UpdateCompanyRequest $request, Company $company)
    {
        $update = $this->service->updateCompany($company, $request->validated());
        return response()->json($update);
    }


    public function destroy(Company $company)
    {
        $this->service->deleteCompany($company);
        return response()->json(null, 204);
    }
}
