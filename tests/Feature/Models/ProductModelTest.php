<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

describe('Product model test', function () {
    it('featured image is send whe there is a value', function () {
        $product = \App\Domain\Product\Models\Product::factory()
            ->create(['featured_image' => 'image.jpg']);

        expect($product->featured_image)
            ->toEqual(route('private-image', ['filename' => 'image.jpg']));
    });
});
