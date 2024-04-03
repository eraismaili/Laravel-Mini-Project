<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyRequest;
use App\Models\Company;
use Illuminate\Http\Request;

class CompaniesController extends Controller
{
    public function index()
    {
        $companies = Company::all(); // Fetch all companies

        return view('companies.index', compact('companies'));
    }
    public function store(CompanyRequest $request)
    {
        Company::create($request->validated());

        return redirect()->route("companies.index")->with("success", "Company created successfully");
    }
    public function update(CompanyRequest $request, Company $company)
    {
        $company->update($request->validated());
        return redirect()->route("companies.index")->with("success", "Company updated successfully.");
    }
}
