<?php

namespace App\Domain\Segment\Rules;

interface SegmentRuleInterface
{
    public function getFriendlyName(): string;

    public function execute(): void;
}
