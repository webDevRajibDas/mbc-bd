<?php

namespace App\Http\Controllers;

use App\Models\PropertyCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Toastr;

class PropertyCategoryController extends Controller
{
    public function index()
    {
        $propertyCategories = PropertyCategory::latest('id')->get();

        return view('admin.property_categories.index', compact('propertyCategories'));
    }

    public function create()
    {
        return view('admin.property_categories.create');
    }

    public function store(Request $request)
    {
        $data = $this->validatedData($request);
        $data['slug'] = $this->uniqueSlug($data['slug'] ?: $data['name']);

        PropertyCategory::create($data);

        Toastr::success('Property category created successfully!', '', ['progressbar' => true]);

        return redirect()->route('master.property-categories.index');
    }

    public function edit(PropertyCategory $propertyCategory)
    {
        return view('admin.property_categories.edit', compact('propertyCategory'));
    }

    public function update(Request $request, PropertyCategory $propertyCategory)
    {
        $data = $this->validatedData($request, $propertyCategory);
        $data['slug'] = $this->uniqueSlug($data['slug'] ?: $data['name'], $propertyCategory);

        $propertyCategory->update($data);

        Toastr::success('Property category updated successfully!', '', ['progressbar' => true]);

        return redirect()->route('master.property-categories.index');
    }

    public function destroy(PropertyCategory $propertyCategory)
    {
        $propertyCategory->delete();

        Toastr::success('Property category deleted successfully!', '', ['progressbar' => true]);

        return redirect()->route('master.property-categories.index');
    }

    private function validatedData(Request $request, ?PropertyCategory $propertyCategory = null): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:120', Rule::unique('property_categories', 'name')->ignore($propertyCategory)],
            'slug' => ['nullable', 'string', 'max:140'],
            'description' => ['nullable', 'string', 'max:1000'],
            'is_active' => ['required', 'boolean'],
            'is_won' => ['required', 'boolean'],
        ]);
    }

    private function uniqueSlug(string $value, ?PropertyCategory $ignore = null): string
    {
        $base = Str::slug($value) ?: 'property-category';
        $slug = $base;
        $suffix = 2;

        while (PropertyCategory::query()->where('slug', $slug)->when($ignore, fn ($query) => $query->whereKeyNot($ignore->getKey()))->exists()) {
            $slug = $base . '-' . $suffix++;
        }

        return $slug;
    }
}
