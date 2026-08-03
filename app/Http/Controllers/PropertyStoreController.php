<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Models\PropertyCategory;
use App\Models\PropertyStore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Toastr;

class PropertyStoreController extends Controller
{
    public function index()
    {
        $properties = PropertyStore::with('category')->latest()->get();
        return view('admin.property_stores.index', compact('properties'));
    }

    public function create() { return view('admin.property_stores.form', $this->formData()); }
    public function edit(PropertyStore $propertyStore) { return view('admin.property_stores.form', $this->formData(compact('propertyStore'))); }

    public function store(Request $request)
    {
        PropertyStore::create($this->payload($request));
        Toastr::success('Property stored successfully!', '', ['progressbar' => true]);
        return redirect()->route('master.property-stores.index');
    }

    public function update(Request $request, PropertyStore $propertyStore)
    {
        $propertyStore->update($this->payload($request, $propertyStore));
        Toastr::success('Property updated successfully!', '', ['progressbar' => true]);
        return redirect()->route('master.property-stores.index');
    }

    public function destroy(PropertyStore $propertyStore)
    {
        $this->deleteImages($propertyStore);
        $propertyStore->delete();
        Toastr::success('Property deleted successfully!', '', ['progressbar' => true]);
        return redirect()->route('master.property-stores.index');
    }

    private function formData(array $data = []): array
    {
        return array_merge(['categories' => PropertyCategory::where('is_active', true)->orderBy('name')->get(), 'divisions' => Division::orderBy('name')->get()], $data);
    }

    private function payload(Request $request, ?PropertyStore $property = null): array
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'], 'title_bn' => ['nullable', 'string', 'max:255'],
            'property_category_id' => ['nullable', 'exists:property_categories,id'], 'community_type' => ['nullable', 'string', 'max:255'],
            'reference_code' => ['nullable', 'string', 'max:100', Rule::unique('property_stores', 'reference_code')->ignore($property)],
            'short_description' => ['nullable', 'string'], 'description_bn' => ['nullable', 'string'],
            'division_id' => ['nullable', 'exists:divisions,id'], 'district_id' => ['nullable', 'exists:districts,id'], 'upazila_id' => ['nullable', 'exists:upazilas,id'], 'union_id' => ['nullable', 'exists:unions,id'], 'landmark' => ['nullable', 'string', 'max:255'],
            'minimum_plot_size' => ['nullable', 'numeric', 'min:0'], 'plot_unit' => ['nullable', 'string', 'max:30'], 'total_plots' => ['nullable', 'integer', 'min:0'], 'members_target' => ['nullable', 'integer', 'min:0'], 'booking_money' => ['nullable', 'numeric', 'min:0'], 'installment_duration' => ['nullable', 'integer', 'min:0'], 'duration_unit' => ['nullable', 'string', 'max:20'],
            'installments' => ['nullable', 'array'], 'installments.*.milestone' => ['nullable', 'string', 'max:100'], 'installments.*.amount' => ['nullable', 'numeric', 'min:0'], 'installments.*.due_months' => ['nullable', 'integer', 'min:0'],
            'entry_designation' => ['nullable', 'string', 'max:255'], 'top_designation' => ['nullable', 'string', 'max:255'], 'promotion_path' => ['nullable', 'string', 'max:500'],
            'feature_image' => ['nullable', 'image', 'max:4096'], 'gallery_images' => ['nullable', 'array'], 'gallery_images.*' => ['image', 'max:4096'],
            'status' => ['required', Rule::in(['active', 'upcoming', 'sold_out', 'draft'])], 'is_featured' => ['nullable', 'boolean'], 'is_members_only' => ['nullable', 'boolean'],
        ]);
        $data['is_featured'] = $request->boolean('is_featured'); $data['is_members_only'] = $request->boolean('is_members_only');
        $data['installments'] = collect($data['installments'] ?? [])->filter(fn ($row) => filled($row['milestone'] ?? null) || filled($row['amount'] ?? null))->values()->all();
        if ($request->hasFile('feature_image')) { if ($property?->feature_image) Storage::disk('public')->delete($property->feature_image); $data['feature_image'] = $request->file('feature_image')->store('property-stores', 'public'); }
        unset($data['gallery_images']);
        if ($request->hasFile('gallery_images')) { $gallery = $property?->gallery_images ?? []; foreach ($request->file('gallery_images') as $image) $gallery[] = $image->store('property-stores/gallery', 'public'); $data['gallery_images'] = $gallery; }
        return $data;
    }

    private function deleteImages(PropertyStore $property): void { Storage::disk('public')->delete(array_filter(array_merge([$property->feature_image], $property->gallery_images ?? []))); }
}
