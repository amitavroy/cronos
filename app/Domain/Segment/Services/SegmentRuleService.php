<?php

namespace App\Domain\Segment\Services;

use App\Domain\Segment\Rules\MinimumPurchaseValueRule;
use App\Domain\Segment\Rules\TotalPurchaseValueRule;
use Illuminate\Support\Collection;

class SegmentRuleService
{
    /**
     * @return Collection<string, string>
     */
    public function getRuleMapping(): Collection
    {
        return collect([
            'total_purchase_value' => TotalPurchaseValueRule::class,
            'minimum_purchase_value' => MinimumPurchaseValueRule::class,
        ]);
    }

    /**
     * @return Collection<string, string>
     */
    public function getRuleNames(): Collection
    {
        $rules = $this->getRuleMapping();

        $ruleNames = collect();

        $rules->each(function ($rule, $key) use (&$ruleNames) {
            $ruleNames->push([
                'machine_name' => $key,
                'friendly_name' => app($rule)->getFriendlyName(),
            ]);
        });

        return $ruleNames;
    }
}
