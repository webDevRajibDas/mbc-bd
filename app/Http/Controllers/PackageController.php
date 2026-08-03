<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function index()
    {
        $packages = Package::orderBy('level')->orderBy('sort_order')->latest('id')->get();
        return view('admin.packages.index', compact('packages'));
    }

    public function create()
    {
        return view('admin.packages.form');
    }

    public function store(Request $request)
    {
        Package::create($this->payload($request));
        Toastr::success('Package created successfully!', '', ['progressbar' => true]);
        return redirect()->route('admin.packages.index');
    }

    public function edit(Package $package)
    {
        return view('admin.packages.form', compact('package'));
    }

    public function update(Request $request, Package $package)
    {
        $package->update($this->payload($request));
        Toastr::success('Package updated successfully!', '', ['progressbar' => true]);
        return redirect()->route('admin.packages.index');
    }

    public function destroy(Package $package)
    {
        $package->delete();
        Toastr::success('Package deleted successfully!', '', ['progressbar' => true]);
        return redirect()->route('admin.packages.index');
    }

    private function payload(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'level' => ['required', 'in:level_1,level_2'],
            'regular_price' => ['nullable', 'numeric', 'min:0'],
            'selling_price' => ['nullable', 'numeric', 'min:0'],
            'description' => ['nullable', 'string', 'max:2000'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['required', 'boolean'],
        ]);
    }
}
