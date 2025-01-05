<?php

namespace App\Jobs;

use App\Domain\Segment\Actions\SegmentUserMapAction;
use App\Domain\Segment\Models\Segment;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class MapCustomerToSegmentJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(private readonly Segment $segment)
    {
        //
    }

    /**
     * Execute the job.
     *
     * @throws Exception
     */
    public function handle(SegmentUserMapAction $action): void
    {
        $action->execute($this->segment);
    }
}
