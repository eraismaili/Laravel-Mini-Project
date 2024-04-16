<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Models\Employee;
use App\Models\Company;
use Illuminate\Http\Request;

class EmployeesController extends Controller
{
    //
    public function index()
    {
        $employees = Employee::paginate(10);
        return view('employees.index', compact('employees'));
    }
    public function create()
    {
        return view('employees.create');
    }
    public function store(EmployeeRequest $request)
    {
        $validatedData = $request->validated();

        Employee::create($validatedData);

        return redirect()->route("employees.index")->with("success", "Employee created successfully");
    }
    public function show(Employee $employee)
    {
        return view('employees.show', compact('employee'));
    }
    public function edit(Employee $employee)
    {
        return view('employees.edit', compact('employee'));
    }
    public function update(EmployeeRequest $request, Employee $employee)
    {
        $validatedData = $request->validated();

        $employee->update($validatedData);

        return redirect()->route("employees.index")->with("success", "Employee updated successfully");
    }
    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully');
    }

}
