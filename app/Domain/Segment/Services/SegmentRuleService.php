<?php

namespace App\Domain\Segment\Services;

use App\Domain\Segment\Models\Segment;
use App\Domain\Segment\Rules\MinimumPurchaseValueRule;
use App\Domain\Segment\Rules\TotalPurchaseValueRule;
use App\Services\UserService;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class SegmentRuleService
{
    /**
     * @return Collection<string, string>
     */
    private function getRuleMapping(): Collection
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

    /**
     * @throws Exception
     */
    public function segmentQuery(Segment $segment): Builder
    {
        $query = app(UserService::class)->getBaseUserQueryForSegment();

        $rules = collect($segment->rules);

        $rules->each(function ($rule) use ($query) {
            $allowedRules = $this->getRuleMapping();

            if (! $allowedRules->has($rule['rule_name'])) {
                throw new Exception('No such rule exist');
            }

            app($allowedRules[$rule['rule_name']])->execute($query, $rule['value']);
        });

        return $query;
    }
}
