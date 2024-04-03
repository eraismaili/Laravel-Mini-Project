<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeesController extends Controller
{
    //
    public function index()
    {
        $employees = Employee::all();
        return view('employees.index', compact('employees'));
    }
    public function store(EmployeeRequest $request)
    {
        Employee::create($request->validated());

        return redirect()->route("employees.index")->with("success", "Employee created succesfully");
    }
    public function update(EmployeeRequest $request, Employee $employee)
    {
        $employee->update($request->validated());
        return redirect()->route("employees.index")->with("success", "Employee updated succesfully.");
    }
}
