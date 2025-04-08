<?php

namespace App\Console\Commands;

use App\Http\Controllers\MailController;
use Illuminate\Console\Command;

class SendEmailReminderInput extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:send-reminder-input';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email reminders for input';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $mailController = new MailController();
        $mailController->sendEmailReminderInput();
    }
}
