<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopProduct extends Model
{
    use HasFactory;

    protected $fillable = ['shop_category_id', 'name', 'sku', 'price', 'sale_price', 'stock_quantity', 'description', 'image', 'is_active', 'is_featured'];
    protected $casts = ['price' => 'decimal:2', 'sale_price' => 'decimal:2', 'is_active' => 'boolean', 'is_featured' => 'boolean'];

    public function category() { return $this->belongsTo(ShopCategory::class, 'shop_category_id'); }
    public function stockMovements() { return $this->hasMany(ShopStockMovement::class); }
}
