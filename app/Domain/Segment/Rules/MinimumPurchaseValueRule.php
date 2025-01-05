<?php

namespace App\Domain\Segment\Rules;

use Illuminate\Database\Eloquent\Builder;

class MinimumPurchaseValueRule implements SegmentRuleInterface
{
    public function execute(Builder $query, int $value): void
    {
        $query->whereHas('orders', function ($query) use ($value) {
            $query->where('total_amount', '>', $value);
        });
    }

    public function getFriendlyName(): string
    {
        return 'Minimum Purchase Value';
    }
}
