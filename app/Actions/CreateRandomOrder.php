<?php

namespace App\Actions;

use App\Domain\Product\Models\Product;
use App\Enum\OrderStatus;
use App\Exceptions\NoUserFound;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Exception;
use Random\RandomException;

class CreateRandomOrder
{
    /**
     * @throws RandomException
     * @throws Exception
     */
    public function handle(int $count): void
    {
        for ($i = 0; $i < $count; $i++) {
            $user = User::where('role', 'customer')->inRandomOrder()->first();

            if (! $user) {
                throw new NoUserFound;
            }

            $order = Order::create([
                'user_id' => $user->id,
                'total_amount' => 0, // Will be updated after adding items
                'status' => OrderStatus::COMPLETED->value,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $products = Product::inRandomOrder()->take(random_int(1, 3))->get();
            $totalAmount = 0;

            $products->each(function ($product) use ($order, &$totalAmount) {
                $quantity = random_int(1, 5);
                $subtotal = $product->price * $quantity;

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'unit_price' => $product->price,
                    'subtotal' => $subtotal,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                $totalAmount = $totalAmount + $subtotal;
            });

            $order->update([
                'total_amount' => $totalAmount,
            ]);
        }
    }
}
