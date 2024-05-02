<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyRequest;
use Illuminate\Http\RedirectResponse;
use App\Http\Resources\CompanyResource;
use App\Models\Company;
use App\Models\Employee;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class CompaniesController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    //     $this->middleware('role:admin')->except('delete');
    //     $this->middleware('role:user')->only('index', 'show');
    // }
    function __construct()
    {
        // $this->middleware(['permission:view-users|create-users|edit-users|delete-users|view-companies|create-companies|edit-companies|delete-companies'], ['only' => ['index', 'show']]);
        $this->middleware(['permission:view-companies'], ['only' => ['index']]);
        $this->middleware(['permission:create-users|create-companies'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:edit-users|edit-companies'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:delete-users|delete-companies'], ['only' => ['destroy']]);
    }
    public function index()
    {
        $recentlyCreatedCompanies = Company::createdLastTenDays()->get();
        $companiesWithMoreThanTwoEmployees = Company::hasMoreThanTwoEmployees()->get();
        $companies = Company::paginate(5);

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

        $company = new Company();
        $company->name = $validatedData['name'];
        $company->email = $validatedData['email'];
        $company->website = $validatedData['website'];

        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $logoName = time() . '.' . $logo->getClientOriginalExtension();
            $logo->storeAs('public/images', $logoName);
            $company->logo = $logoName;
        }

        $company->save();

        return redirect()->route("companies.index")->with("success", "Company created successfully");
    }
    public function show(Company $company)
    {
        $employees = Employee::where('company_id', $company->id)->get();
        return view('companies.show', compact('company', 'employees'));
    }

    public function edit(Company $company)
    {
        return view('companies.edit', compact('company'));
    }
    public function update(CompanyRequest $request, Company $company): RedirectResponse
    {
        $validatedData = $request->validated();

        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $logoName = time() . '.' . $logo->getClientOriginalExtension();
            $logo->storeAs('public/images', $logoName);
            $validatedData['logo'] = $logoName;
        }

        $company->update($validatedData);

        return redirect()->route("companies.index")->with("success", "Company updated successfully");
    }

    public function destroy(Company $company)
    {
        $company->delete();
        return redirect()->route('companies.index')->with('success', 'Employee deleted successfully');
    }
}