<?php

namespace App\Domain\Segment\Rules;

class MinimumPurchaseValueRule implements SegmentRuleInterface
{
    public function execute(): void {}

    public function getFriendlyName(): string
    {
        return 'Minimum Purchase Value';
    }
}
