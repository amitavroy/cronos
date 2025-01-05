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
    )
    {
    }

    /**
     * @throws Exception
     */
    public function execute(Segment $segment): void
    {
        $customers = $this->segmentRuleService->segmentQuery($segment)
            ->get();

        $dataToInsert = collect();
        $customers->each(function ($customer) use ($segment, $dataToInsert) {
            $dataToInsert->push([
                'user_id' => $customer->id,
                'segment_id' => $segment->id,
            ]);
        });

        DB::table('segment_customer')
            ->where('segment_id', $segment->id)
            ->delete(); // need to clear the old segment data

        DB::table('segment_customer')
            ->insert($dataToInsert->toArray()); // pushing the new segment data
    }
}
