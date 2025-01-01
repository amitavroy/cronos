<?php

namespace App\Domain\Segment\Rules;

class TotalPurchaseValueRule implements SegmentRuleInterface
{
    public function execute(): void {}

    public function getFriendlyName(): string
    {
        return 'Total Purchase Value';
    }
}
