<?php

namespace App\Console\Commands;

use App\Domain\Segment\Models\Segment;
use App\Jobs\MapCustomerToSegmentJob;
use Illuminate\Console\Command;

class SyncSegmentDataCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:sync-segment-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will sync the customers into their segments.';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $segments = Segment::query()->active()->get();

        $segments->each(fn ($segment) => MapCustomerToSegmentJob::dispatch($segment));

        $this->info("Segments added to sync: {$segments->count()}");
    }
}
