<?php

namespace App\Jobs;

use App\Mail\PostMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class ProcessEmail implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public $details;

    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $emailBy = $this->details['email_by'];
        $cc = ['hamzah@bskp.co.id', 'ga@bskp.co.id', $emailBy];
        Mail::to($this->details['email'])->cc($cc)->send(new PostMail($this->details));
    }
}
