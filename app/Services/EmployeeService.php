<?php

namespace App\Services;

use App\Models\Company;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeService
{
    public function getAllEmployees()
    {
        return Employee::with('company')->get();
    }

    public function getEmployeesQuery()
    {
        return Employee::query()->with('company');
    }

    public function getAllCompanies()
    {
        return Company::all();
    }

    public function createEmployee($data)
    {
        return Employee::create($data);
    }

    public function updateEmployee(Employee $employee, $data)
    {
        return $employee->update($data);
    }

    public function deleteEmployee(Employee $employee)
    {
        return $employee->delete();
    }
}
