<?php

namespace App\Domain\Product\Models;

use App\Models\Order;
use Database\Factories\ProductFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    /** @use HasFactory<ProductFactory> */
    use HasFactory, SoftDeletes;

    protected static function newFactory(): ProductFactory
    {
        return ProductFactory::new();
    }

    protected $fillable = [
        'name',
        'price',
        'category',
        'description',
        'featured_image',
    ];

    protected function featuredImage(): Attribute
    {
        return Attribute::make(
            get: fn (?string $value): mixed => $value
                ? route('private-image', ['filename' => $value])
                : config('app.default_product_pic')
        );
    }

    /**
     * @return BelongsToMany<Order, covariant $this>
     */
    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class, 'order_items')
            ->withPivot('quantity', 'unit_price')
            ->withTimestamps();
    }
}
