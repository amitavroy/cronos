<?php

namespace App\Domain\Segment\Rules;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class TotalPurchaseValueRule implements SegmentRuleInterface
{
    public function execute(Builder $query, int $value): void
    {
        $query->whereHas('orders', function ($query) use ($value) {
            $query->select(DB::raw('SUM(total_amount) as total_sum'))
                ->groupBy('user_id')
                ->havingRaw('SUM(total_amount) >= ?', [$value]);
        });
    }

    public function getFriendlyName(): string
    {
        return 'Total Purchase Value';
    }
}
