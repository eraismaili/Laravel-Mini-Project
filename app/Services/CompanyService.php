<?php

namespace App\Services;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CompanyService
{
    public function getAllCompanies()
    {
        return Company::all();
    }

    public function getRecentlyCreatedCompanies()
    {
        return Company::createdLastTenDays()->get();
    }

    public function getCompaniesWithMoreThanTwoEmployees()
    {
        return Company::hasMoreThanTwoEmployees()->get();
    }

    public function createCompany($data)
    {
        $company = new Company();
        $company->name = $data['name'];
        $company->email = $data['email'];
        $company->website = $data['website'];

        if (isset($data['logo'])) {
            $logo = $data['logo'];
            $logoName = time() . '.' . $logo->getClientOriginalExtension();
            $logo->storeAs('public/images', $logoName);
            $company->logo = $logoName;
        }

        $company->save();
        return $company;
    }

    public function updateCompany(Company $company, $data)
    {
        if (isset($data['logo'])) {
            $logo = $data['logo'];
            $logoName = time() . '.' . $logo->getClientOriginalExtension();
            $logo->storeAs('public/images', $logoName);
            $data['logo'] = $logoName;
        }

        $company->update($data);
        return $company;
    }

    public function deleteCompany(Company $company)
    {
        return $company->delete();
    }
}
