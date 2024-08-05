<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use App\Models\Company;
use App\Models\Employee;
use App\Http\Requests\EmployeeRequest;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Exports\EmployeesExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Services\EmployeeService;

class EmployeesController extends Controller
{
    protected $employeeService;

    public function __construct(EmployeeService $employeeService)
    {
        $this->employeeService = $employeeService;

        $this->middleware(['permission:view-users'], ['only' => ['index', 'show']]);
        $this->middleware(['permission:create-users'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:edit-users'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:delete-users'], ['only' => ['destroy']]);
    }

    public function index()
    {
        $employees = $this->employeeService->getAllEmployees();
        return view('employees.index', compact('employees'));
    }

    public function getEmployees(Request $request)
    {
        $employeesQuery = $this->employeeService->getEmployeesQuery();
        return datatables()->eloquent($employeesQuery)->toJson();
    }

    public function create()
    {
        $companies = $this->employeeService->getAllCompanies();
        return view('employees.create', compact('companies'));
    }

    public function store(EmployeeRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();
        $validatedData['company_id'] = $request->input('company_id');

        $this->employeeService->createEmployee($validatedData);

        return redirect()->route("employees.index")->with("success", "Employee created successfully");
    }

    public function show(Employee $employee)
    {
        return view('employees.show', compact('employee'));
    }

    public function edit(Employee $employee)
    {
        $companies = $this->employeeService->getAllCompanies();
        return view('employees.edit', compact('employee', 'companies'));
    }

    public function update(EmployeeRequest $request, Employee $employee)
    {
        $validatedData = $request->validated();
        $this->employeeService->updateEmployee($employee, $validatedData);

        return redirect()->route("employees.index")->with("success", "Employee updated successfully");
    }

    public function destroy(Employee $employee)
    {
        $this->employeeService->deleteEmployee($employee);
        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully');
    }

    public function export()
    {
        return Excel::download(new EmployeesExport, 'employees.xlsx');
    }
}
