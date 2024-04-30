<?php

namespace App\Console\Commands;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class DailyReport extends Mailable
{
    use Queueable, SerializesModels;
    protected $signature = 'emails:send';
    protected $description = 'Send daily emails to employees';

    public function build()
    {
        return $this->markdown('mails.daily_report')
            ->subject('Daily Report');
    }
}
