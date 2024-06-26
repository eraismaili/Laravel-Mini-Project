<?php

namespace App\Exports;

use App\Models\Company;
use Maatwebsite\Excel\Concerns\FromCollection;

class CompaniesExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Company::all();
    }
    public function headings(): array
    {
        return [
            'Name',
            'Email',
            'Employee',
            'Logo',
            'Website',
        ];
    }
}
