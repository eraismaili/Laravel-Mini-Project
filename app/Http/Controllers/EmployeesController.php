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


class EmployeesController extends Controller
{
    function __construct()
    {
        $this->middleware(['permission:view-users'], ['only' => ['index', 'show']]);
        $this->middleware(['permission:create-users'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:edit-users'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:delete-users'], ['only' => ['destroy']]);
    }
    public function index()
    {
        return view('employees.index');
    }
    public function getEmployees(Request $request)
    {
        $employeesQuery = Employee::query()->with('company');

        return datatables()->eloquent($employeesQuery)
            ->addColumn('actions', function ($employee) {
                $editUrl = route('employees.edit', $employee->id);
                $deleteUrl = route('employees.destroy', $employee->id);
                return '
                <a href="' . $editUrl . '" class="btn btn-primary">Edit</a>
                <form action="' . $deleteUrl . '" method="POST" style="display:inline;">
                    ' . csrf_field() . '
                    ' . method_field('DELETE') . '
                    <button type="submit" class="btn btn-danger" onclick="return confirm(\'Are you sure you want to delete ' . $employee->first_name . ' ' . $employee->last_name . '?\')">Delete</button>
                </form>';
            })
            ->rawColumns(['actions'])
            ->toJson();
    }

    public function create()
    {
        $companies = Company::all();
        return view('employees.create', compact('companies'));
    }
    public function store(EmployeeRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();

        $validatedData['company_id'] = $request->input('company_id');

        Employee::create($validatedData);

        return redirect()->route("employees.index")->with("success", "Employee created successfully");
    }
    public function show(Employee $employee)
    {
        return view('employees.show', compact('employee'));
    }
    public function edit(Employee $employee)
    {

        $companies = Company::all();
        return view('employees.edit', compact('employee', 'companies'));
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
    public function export()
    {
        return Excel::download(new EmployeesExport, 'employees.xlsx');
    }
}
