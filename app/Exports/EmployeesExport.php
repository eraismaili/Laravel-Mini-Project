<?php

namespace App\Exports;

use App\Models\Employee;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EmployeesExport implements FromCollection, WithHeadings
{
    /**
     * Return a collection of employees.
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Employee::select('id', 'first_name', 'last_name', 'company_id', 'email', 'phone')->get();
    }

    /**
     * Return the headings for the export.
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'Id',
            'First Name',
            'Last Name',
            'Company',
            'Email',
            'Phone',

        ];
    }
}
