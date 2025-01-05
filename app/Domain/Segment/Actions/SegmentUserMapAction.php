<?php

namespace App\Domain\Segment\Actions;

use App\Domain\Segment\Models\Segment;
use App\Domain\Segment\Services\SegmentRuleService;
use Exception;
use Illuminate\Support\Facades\DB;

class SegmentUserMapAction
{
    public function __construct(
        private readonly SegmentRuleService $segmentRuleService
    ) {}

    /**
     * @throws Exception
     */
    public function execute(Segment $segment): void
    {
        $customers = $this->segmentRuleService->segmentQuery($segment)->get();

        $customers->each(function ($customer) use ($segment) {
            DB::table('segment_customer')->insert([
                'user_id' => $customer->id,
                'segment_id' => $segment->id,
            ]);
        });
    }
}
