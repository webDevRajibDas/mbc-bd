<?php

namespace App\Http\Controllers;

use App\Models\ShopProduct;
use App\Models\ShopStockMovement;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class ShopStockController extends Controller
{
    public function index()
    {
        $products = ShopProduct::with('category')->orderBy('name')->get();
        $movements = ShopStockMovement::with(['product', 'creator'])->latest()->take(20)->get();
        return view('admin.e_shop.stock.index', compact('products', 'movements'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'shop_product_id' => ['required', 'exists:shop_products,id'],
            'type' => ['required', Rule::in(['in', 'out', 'adjustment'])],
            'quantity' => ['required', 'integer', 'min:0'],
            'note' => ['nullable', 'string', 'max:500'],
        ]);

        DB::transaction(function () use ($data) {
            $product = ShopProduct::lockForUpdate()->findOrFail($data['shop_product_id']);
            $before = $product->stock_quantity;
            $after = $data['type'] === 'in' ? $before + $data['quantity'] : ($data['type'] === 'out' ? $before - $data['quantity'] : $data['quantity']);

            if ($after < 0) {
                abort(422, 'Stock out quantity cannot exceed the available stock.');
            }

            $product->update(['stock_quantity' => $after]);
            ShopStockMovement::create([
                'shop_product_id' => $product->id, 'type' => $data['type'], 'quantity' => $data['quantity'],
                'stock_before' => $before, 'stock_after' => $after, 'note' => $data['note'] ?? null,
                'created_by' => auth()->id(),
            ]);
        });

        Toastr::success('Stock updated successfully!', '', ['progressbar' => true]);
        return redirect()->route('admin.e-shop.stock.index');
    }
}
