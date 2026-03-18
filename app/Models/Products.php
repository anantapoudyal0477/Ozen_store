<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    protected $table = "products";

    protected $fillable = [
        'product_name',
        'product_description',
        'product_price',
        'product_image',
        'product_stock'
    ];

    protected $casts = [
        // 'product_name' => 'encrypted',
        'product_description' => 'encrypted',
        // Don't encrypt image path unless storing sensitive images
        'product_image' => 'string',
        'product_stock' => 'integer',
        'product_price' => 'decimal:2',

        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

    public function getProductImageAttribute($value)
    {
        return asset( $value); // better than asset()
    }
}

