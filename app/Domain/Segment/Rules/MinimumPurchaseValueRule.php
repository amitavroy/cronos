<?php

namespace App\Domain\Segment\Rules;

use Illuminate\Database\Eloquent\Builder;

class MinimumPurchaseValueRule implements SegmentRuleInterface
{
    public function execute(Builder $query): void
    {
        $query->whereHas('orders', function ($query) {
            $query->where('total_amount', '>', 1000);
        });
    }

    public function getFriendlyName(): string
    {
        return 'Minimum Purchase Value';
    }
}
