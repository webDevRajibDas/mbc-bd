<?php

namespace App\Http\Controllers;

use App\Models\ShopCategory;
use App\Models\ShopProduct;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ShopProductController extends Controller
{
    public function index() { $products = ShopProduct::with('category')->latest('id')->get(); return view('admin.e_shop.products.index', compact('products')); }
    public function create() { return view('admin.e_shop.products.form', $this->formData()); }
    public function edit(ShopProduct $shopProduct) { return view('admin.e_shop.products.form', $this->formData(compact('shopProduct'))); }
    public function store(Request $request) { ShopProduct::create($this->payload($request)); Toastr::success('Product created successfully!', '', ['progressbar' => true]); return redirect()->route('admin.e-shop.products.index'); }
    public function update(Request $request, ShopProduct $shopProduct) { $shopProduct->update($this->payload($request, $shopProduct)); Toastr::success('Product updated successfully!', '', ['progressbar' => true]); return redirect()->route('admin.e-shop.products.index'); }
    public function destroy(ShopProduct $shopProduct) { if ($shopProduct->image) Storage::disk('public')->delete($shopProduct->image); $shopProduct->delete(); Toastr::success('Product deleted successfully!', '', ['progressbar' => true]); return redirect()->route('admin.e-shop.products.index'); }
    private function formData(array $data = []): array { return array_merge(['categories' => ShopCategory::where('is_active', true)->orderBy('name')->get()], $data); }
    private function payload(Request $request, ?ShopProduct $product = null): array { $data = $request->validate(['shop_category_id' => ['nullable', 'exists:shop_categories,id'], 'name' => ['required', 'string', 'max:255'], 'sku' => ['nullable', 'string', 'max:80', Rule::unique('shop_products', 'sku')->ignore($product)], 'price' => ['required', 'numeric', 'min:0'], 'sale_price' => ['nullable', 'numeric', 'min:0', 'lte:price'], 'stock_quantity' => ['required', 'integer', 'min:0'], 'description' => ['nullable', 'string', 'max:2000'], 'image' => ['nullable', 'image', 'max:4096'], 'is_active' => ['required', 'boolean'], 'is_featured' => ['nullable', 'boolean']]); $data['is_featured'] = $request->boolean('is_featured'); if ($request->hasFile('image')) { if ($product?->image) Storage::disk('public')->delete($product->image); $data['image'] = $request->file('image')->store('shop-products', 'public'); } return $data; }
}
