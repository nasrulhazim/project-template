<?php

namespace App\Console\Commands;

use App\Mail\DefaultMail;
use Illuminate\Console\Command;
use Illuminate\Mail\Message;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Mail;

class TestSendMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test-send-mail {email} {--queue=sync : Type of queue. Default is sync.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send test email to given ';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $mail = (new DefaultMail('Test E-mail', 'Hello World'));
        $email = $this->argument('email');
        $name = str($this->argument('email'))->before('@')->title()->toString();

        if($this->option('queue')) {
            $mail->onQueue($this->option('queue'));
        }

        Mail::to($email, $name)->send($mail);
    }
}
