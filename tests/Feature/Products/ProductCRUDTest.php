<?php

use App\Domain\Product\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\delete;
use function Pest\Laravel\patch;
use function Pest\Laravel\post;

uses(RefreshDatabase::class);

describe('Testing product create', function () {
    it('creates a new product', function () {
        $this->withoutVite();

        $postData = [
            'name' => 'Jhon Smith',
            'price' => 12,
            'category' => 'Tech',
            'description' => 'Something strange',
        ];

        actingAs(User::factory()->create());

        post(route('product.store'), $postData);

        $this->assertDatabaseCount('products', 1);
        $this->assertDatabaseHas('products', $postData);
    });

    it('redirects to index page', function () {
        $this->withoutVite();

        $postData = [
            'name' => 'Jhon Smith',
            'price' => 12,
            'category' => 'Tech',
            'description' => 'Something strange',
        ];

        actingAs(User::factory()->create());

        post(route('product.store'), $postData)
            ->assertRedirectToRoute('product.index');
    });
});

describe('Testing product update', function () {
    it('updates the product', function () {
        $this->withoutVite();

        $product = Product::factory()->create();

        $postData = [
            'name' => 'Jhon Smith',
            'price' => 12,
            'category' => 'Tech',
            'description' => 'Something strange',
        ];

        actingAs(User::factory()->create());

        patch(route('product.update', ['product' => $product]), $postData)
            ->assertRedirectToRoute('product.show', ['product' => $product]);

        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'name' => $postData['name'],
        ]);
    });
});

describe('Testing product delete', function () {
    it('deletes a product', function () {
        $this->withoutVite();

        $product = Product::factory()->create();

        actingAs(User::factory()->create());

        delete(route('product.destroy', ['product' => $product]))
            ->assertRedirectToRoute('product.index');

        expect(Product::find($product->id))->toBeNull();
    });
});
