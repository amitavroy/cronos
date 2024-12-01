<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::updateOrCreate([
            'email' => 'reachme@amitavroy.com',
        ], [
            'name' => 'Amitav Roy',
            'email' => 'reachme@amitavroy.com',
            'password' => bcrypt('Password@123'),
        ]);

        DB::table('products')->truncate();
        $data = file_get_contents(database_path('./seeders/products.json'));
        $products = collect(json_decode($data, true));
        $products->each(function ($product) {
            Product::create([
                'name' => $product['name'],
                'price' => $product['price'],
                'category' => $product['technology'],
                'description' => $product['description'],
            ]);
        });
    }
}
