<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class TestCreateCustomer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:create-customer';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will create a random customer';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $userCount = random_int(1, 3);

        for ($i = 0; $i < $userCount; $i++) {
            User::factory($userCount)->customer()->create();
        }
    }
}
