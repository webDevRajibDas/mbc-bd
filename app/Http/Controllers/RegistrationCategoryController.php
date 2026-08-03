<?php

namespace App\Http\Controllers;

use App\Models\RegistrationCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Toastr;

class RegistrationCategoryController extends Controller
{
    public function index()
    {
        $registrationCategories = RegistrationCategory::latest('id')->get();
        return view('admin.registration_categories.index', compact('registrationCategories'));
    }

    public function create() { return view('admin.registration_categories.form'); }
    public function edit(RegistrationCategory $registrationCategory) { return view('admin.registration_categories.form', compact('registrationCategory')); }

    public function store(Request $request)
    {
        RegistrationCategory::create($this->payload($request));
        Toastr::success('Registration category created successfully!', '', ['progressbar' => true]);
        return redirect()->route('admin.registration-categories.index');
    }

    public function update(Request $request, RegistrationCategory $registrationCategory)
    {
        $registrationCategory->update($this->payload($request, $registrationCategory));
        Toastr::success('Registration category updated successfully!', '', ['progressbar' => true]);
        return redirect()->route('admin.registration-categories.index');
    }

    public function destroy(RegistrationCategory $registrationCategory)
    {
        $registrationCategory->delete();
        Toastr::success('Registration category deleted successfully!', '', ['progressbar' => true]);
        return redirect()->route('admin.registration-categories.index');
    }

    private function payload(Request $request, ?RegistrationCategory $category = null): array
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:100', Rule::unique('registration_categories', 'name')->ignore($category)],
            'slug' => ['nullable', 'string', 'max:120'],
            'description' => ['nullable', 'string', 'max:1000'],
            'is_active' => ['required', 'boolean'],
        ]);
        $data['slug'] = $this->uniqueSlug($data['slug'] ?: $data['name'], $category);
        return $data;
    }

    private function uniqueSlug(string $value, ?RegistrationCategory $ignore = null): string
    {
        $base = Str::slug($value) ?: 'registration-category';
        $slug = $base;
        $suffix = 2;

        while (RegistrationCategory::query()->where('slug', $slug)->when($ignore, fn ($query) => $query->whereKeyNot($ignore->getKey()))->exists()) {
            $slug = $base . '-' . $suffix++;
        }

        return $slug;
    }
}
