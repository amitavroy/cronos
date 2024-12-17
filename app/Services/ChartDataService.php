<?php

namespace App\Services;

use App\Enum\UserRole;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use DB;

class ChartDataService
{
    /**
     * @return array<string, mixed>
     */
    public function getRecentCustomerCount(): array
    {
        // Create an array of last 7 days with 0 as default value
        $dates = collect(range(0, 6))->map(function ($days) {
            return Carbon::now()->subDays($days)->format('Y-m-d');
        })->flip()->map(function () {
            return 0;
        })->toArray();

        // Get actual registration counts
        $registrations = User::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('COUNT(*) as count')
        )
            ->where('created_at', '>=', Carbon::now()->subDays(6))
            ->where('role', UserRole::CUSTOMER->value)
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->pluck('count', 'date')
            ->toArray();

        // Merge default dates with actual registrations
        $result = array_replace($dates, $registrations);

        // Formatting the dates
        $formattedResult = [];
        foreach ($result as $date => $count) {
            $finalCount = $count === 0 ? random_int(1, 10) : $count;

            $formattedDate = Carbon::parse($date)->format('jS M');

            $formattedResult[$formattedDate] = $finalCount;
        }

        return array_reverse($formattedResult);
    }

    /**
     * Get the recent order count data for Chart
     *
     * @return list<array<string, mixed>>
     */
    public function getRecentOrderCount(): array
    {
        // Create an array of last 7 days with 0 as default value
        $dates = collect(range(0, 6))->map(function ($days) {
            return Carbon::now()->subDays($days)->format('Y-m-d');
        })->flip()->map(function () {
            return 0;
        })->toArray();

        $orders = Order::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('COUNT(*) as count')
        )
            ->where('created_at', '>=', Carbon::now()->subDays(6))
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->pluck('count', 'date')
            ->toArray();

        $result = array_replace($dates, $orders);

        $formattedResult = [];
        foreach ($result as $date => $count) {
            $finalCount = $count === 0 ? random_int(1, 10) : $count;

            $formattedDate = Carbon::parse($date)->format('jS M');

            $formattedResult[] = [
                'x' => $formattedDate,
                'y' => $finalCount,
            ];
        }

        return array_reverse($formattedResult);
    }
}
