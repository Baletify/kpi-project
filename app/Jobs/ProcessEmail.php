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
        $cc = ['hamzah@bskp.co.id', 'ga@bskp.co.id'];
        Mail::to($this->details['email'])->cc($cc)->send(new PostMail($this->details));
    }
}
