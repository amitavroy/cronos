<?php

namespace App\Console\Commands;

use App\Actions\CreateRandomOrder;
use Illuminate\Console\Command;

class TestCreateOrderCommand extends Command
{
    protected $signature = 'test:create-order';

    protected $description = 'This command will create a random order using a Random customer';

    public function handle(CreateRandomOrder $createRandomOrder): void
    {
        $orderCount = random_int(1, 2);

        for ($i = 0; $i < $orderCount; $i++) {
            $createRandomOrder->handle($orderCount);
        }
    }
}
