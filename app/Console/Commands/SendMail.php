<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Queue;
use Symfony\Component\Console\Command\Command as CommandAlias;

class SendMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send messages from the queue';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $job = Queue::pop();

        // OK: Send email according the job
        $job->run();

        return CommandAlias::SUCCESS;
    }
}
