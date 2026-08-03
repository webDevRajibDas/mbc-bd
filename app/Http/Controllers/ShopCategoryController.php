<?php

namespace App\Http\Controllers;

use App\Models\ShopCategory;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ShopCategoryController extends Controller
{
    public function index() { $categories = ShopCategory::withCount('products')->latest('id')->get(); return view('admin.e_shop.categories.index', compact('categories')); }
    public function create() { return view('admin.e_shop.categories.form'); }
    public function edit(ShopCategory $shopCategory) { return view('admin.e_shop.categories.form', compact('shopCategory')); }
    public function store(Request $request) { ShopCategory::create($this->payload($request)); Toastr::success('Shop category created successfully!', '', ['progressbar' => true]); return redirect()->route('admin.e-shop.categories.index'); }
    public function update(Request $request, ShopCategory $shopCategory) { $shopCategory->update($this->payload($request, $shopCategory)); Toastr::success('Shop category updated successfully!', '', ['progressbar' => true]); return redirect()->route('admin.e-shop.categories.index'); }
    public function destroy(ShopCategory $shopCategory) { $shopCategory->delete(); Toastr::success('Shop category deleted successfully!', '', ['progressbar' => true]); return redirect()->route('admin.e-shop.categories.index'); }
    private function payload(Request $request, ?ShopCategory $category = null): array { return $request->validate(['name' => ['required', 'string', 'max:120', Rule::unique('shop_categories', 'name')->ignore($category)], 'description' => ['nullable', 'string', 'max:1000'], 'is_active' => ['required', 'boolean']]); }
}
