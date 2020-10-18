<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\EmailService;

class syncEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync Emails';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle( EmailService $emailService )
    {
        $emailService->syncEmail();
    }
}
