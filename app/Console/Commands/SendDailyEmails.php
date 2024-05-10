<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\DailyReport;
use App\Models\Employee;

class SendDailyEmails extends Command
{
    protected $signature = 'send:email';
    protected $description = 'Send daily emails to employees';

    public function handle()
    {
        $employees = Employee::all();

        foreach ($employees as $employee) {
            Mail::to($employee->email)->send(new DailyReport($employee));
        }

        $this->info('Daily emails sent successfully.');
    }
}
