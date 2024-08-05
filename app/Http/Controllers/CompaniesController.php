<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyRequest;
use Illuminate\Http\RedirectResponse;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Exports\CompaniesExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Services\CompanyService;
use App\Imports\CompaniesImport;

class CompaniesController extends Controller
{
    protected $companyService;

    public function __construct(CompanyService $companyService)
    {
        $this->companyService = $companyService;

        $this->middleware(['permission:view-companies'], ['only' => ['index']]);
        $this->middleware(['permission:create-companies'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:edit-companies'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:delete-companies'], ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $recentlyCreatedCompanies = $this->companyService->getRecentlyCreatedCompanies();
        $companiesWithMoreThanTwoEmployees = $this->companyService->getCompaniesWithMoreThanTwoEmployees();
        $companies = $this->companyService->getAllCompanies();

        return view('companies.index', [
            'recentlyCreatedCompanies' => $recentlyCreatedCompanies,
            'companiesWithMoreThanTwoEmployees' => $companiesWithMoreThanTwoEmployees,
            'companies' => $companies,
        ]);
    }

    public function create()
    {
        return view('companies.create');
    }

    public function store(CompanyRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();

        $this->companyService->createCompany($validatedData);

        return redirect()->route("companies.index")->with("success", "Company created successfully");
    }

    public function show(Company $company)
    {
        return view('companies.show', compact('company'));
    }

    public function edit(Company $company)
    {
        return view('companies.edit', compact('company'));
    }

    public function update(CompanyRequest $request, Company $company): RedirectResponse
    {
        $validatedData = $request->validated();

        $this->companyService->updateCompany($company, $validatedData);

        return redirect()->route("companies.index")->with("success", "Company updated successfully");
    }

    public function destroy(Company $company)
    {
        $this->companyService->deleteCompany($company);
        return redirect()->route('companies.index')->with('success', 'Company deleted successfully');
    }

    public function export()
    {
        return Excel::download(new CompaniesExport, 'companies.xlsx');
    }
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        Excel::import(new CompaniesImport, $request->file('file'));

        return redirect()->route('companies.index')->with('success', 'Companies imported successfully!');
    }
}
