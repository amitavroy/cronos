<?php

namespace Database\Seeders;

use App\Actions\CreateRandomOrder;
use App\Domain\Notification\Models\Notification;
use App\Domain\Product\Models\Product;
use App\Domain\Segment\Models\Segment;
use App\Enum\UserRole;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->hasProfile()->create();
        Notification::factory(10)->create();

        $me = User::updateOrCreate([
            'email' => config('app.default_credentials.email'),
        ], [
            'name' => 'Amitav Roy',
            'email' => config('app.default_credentials.email'),
            'password' => bcrypt(config('app.default_credentials.password')),
            'position' => 'Solutions Architect',
            'country' => 'India',
            'role' => UserRole::ADMIN->value,
        ]);

        UserProfile::create(['user_id' => $me->id]);

        User::factory(10)->create([
            'role' => UserRole::CUSTOMER->value,
        ]);

        $this->createProducts();

        app(CreateRandomOrder::class)->handle(random_int(10, 30));

        Segment::factory(10)->inactive()->create();

        Segment::create([
            'name' => 'VIP Customers',
            'description' => 'Customers who have a high purchase total value on my site.',
            'rules' => [
                ['rule_name' => 'total_purchase_value', 'value' => 50000],
                ['rule_name' => 'minimum_purchase_value', 'value' => 500],
            ],
        ]);
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
