<?php

namespace App\Jobs;

use App\Mail\ReminderCheck2Mail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

class ReminderCheck2Email implements ShouldQueue
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
        Mail::to($this->details['email'])->send(new ReminderCheck2Mail($this->details));
    }
}
