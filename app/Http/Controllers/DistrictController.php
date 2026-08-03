<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Models\District;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Toastr;

class DistrictController extends Controller
{
    public function index()
    {
        $districts = District::with('division')->latest('id')->get();
        return view('admin.geographic.district.index', compact('districts'));
    }

    public function create()
    {
        $divisions = Division::orderBy('name')->get();
        return view('admin.geographic.district.create', compact('divisions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'division_id' => 'required|exists:divisions,id',
            'name' => 'required|string|max:255',
            'bn_name' => 'nullable|string|max:255',
            'url' => 'nullable|string|max:255',
        ]);

        District::create($request->only('division_id', 'name', 'bn_name', 'url'));

        Toastr::success('District Created Successfully!', '', ["progressbar" => true]);
        return redirect()->route('geographic.districts.index');
    }

    public function edit(District $district)
    {
        $divisions = Division::orderBy('name')->get();
        return view('admin.geographic.district.edit', compact('district', 'divisions'));
    }

    public function update(Request $request, District $district)
    {
        $request->validate([
            'division_id' => 'required|exists:divisions,id',
            'name' => 'required|string|max:255',
            'bn_name' => 'nullable|string|max:255',
            'url' => 'nullable|string|max:255',
        ]);

        $district->update($request->only('division_id', 'name', 'bn_name', 'url'));

        Toastr::success('District Updated Successfully!', '', ["progressbar" => true]);
        return redirect()->route('geographic.districts.index');
    }

    public function destroy(District $district)
    {
        $district->delete();
        Toastr::success('District Deleted Successfully!', '', ["progressbar" => true]);
        return redirect()->route('geographic.districts.index');
    }
}
