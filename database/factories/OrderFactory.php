<?php

namespace Database\Factories;

use App\Enum\OrderStatus;
use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition(): array
    {
        return [
            'user_id' => $this->faker->randomNumber(),
            'total_amount' => $this->faker->randomFloat(),
            'status' => $this->faker->randomElement(OrderStatus::values()),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
