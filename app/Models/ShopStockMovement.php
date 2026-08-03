<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopStockMovement extends Model
{
    use HasFactory;

    protected $fillable = ['shop_product_id', 'type', 'quantity', 'stock_before', 'stock_after', 'note', 'created_by'];

    public function product() { return $this->belongsTo(ShopProduct::class, 'shop_product_id'); }
    public function creator() { return $this->belongsTo(User::class, 'created_by'); }
}
