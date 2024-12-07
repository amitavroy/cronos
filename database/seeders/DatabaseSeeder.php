<?php

namespace Database\Seeders;

use App\Actions\CreateRandomOrder;
use App\Enum\UserRole;
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
        User::factory(10)->create();

        User::updateOrCreate([
            'email' => config('app.default_credentials.email'),
        ], [
            'name' => 'Amitav Roy',
            'email' => config('app.default_credentials.email'),
            'password' => bcrypt(config('app.default_credentials.password')),
            'position' => 'Solutions Architect',
            'country' => 'India',
            'role' => UserRole::ADMIN->value,
        ]);

        User::factory(10)->create([
            'role' => UserRole::CUSTOMER->value,
        ]);

        $this->createProducts();

        app(CreateRandomOrder::class)->handle(rand(10, 30));
    }

    private function createProducts(): void
    {
        DB::table('products')->truncate();
        $data = file_get_contents(database_path('./seeders/products.json'));
        $products = collect(json_decode($data, true));
        $products->each(function ($product) {
            Product::create([
                'name' => $product['name'],
                'price' => str_replace('$', '', $product['price']),
                'category' => $product['technology'],
                'description' => $product['description'],
            ]);
        });
    }
}
