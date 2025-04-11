<?php

namespace App\Jobs;

use App\Mail\ReminderApproveMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

class ReminderApproveEmail implements ShouldQueue
{
    use Queueable;
    public $details;

    /**
     * Create a new job instance.
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->details['email'])->send(new ReminderApproveMail($this->details));
    }
}
