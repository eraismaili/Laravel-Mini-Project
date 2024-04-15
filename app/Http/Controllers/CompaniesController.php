<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyRequest;
use Illuminate\Http\RedirectResponse;
use App\Http\Resources\CompanyResource;
use App\Models\Company;
use Illuminate\Http\Request;

class CompaniesController extends Controller
{
    public function index()
    {
        $companies = Company::paginate(10);

        return view('companies.index', compact('companies'));
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
            $logoPath = $request->file('logo')->store('public', 'logos');
            $company->logo = $logoPath;
        }

        $company->save();

        return redirect()->route("companies.index")->with("success", "Company created successfully");
    }
    public function show(Company $company)
    {
        return view('companies.show', compact('companies'));
    }
    public function edit(Company $company)
    {
        return view('companies.edit', compact('company'));
    }
    public function update(CompanyRequest $request, Company $company): RedirectResponse
    {
        $validatedData = $request->validated();

        $company->update($validatedData);

        return redirect()->route("companies.index")->with("success", "Company updated successfully");
    }

    public function destroy(Company $company)
    {
        $company->delete();
        return response()->json(['message' => 'Company deleted successfully']);
    }
}