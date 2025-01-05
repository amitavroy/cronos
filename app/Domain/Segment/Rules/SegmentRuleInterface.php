<?php

namespace App\Domain\Segment\Rules;

use Illuminate\Database\Eloquent\Builder;

interface SegmentRuleInterface
{
    public function getFriendlyName(): string;

    public function execute(Builder $query): void;
}
