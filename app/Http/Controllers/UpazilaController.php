<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Upazila;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Toastr;

class UpazilaController extends Controller
{
    public function index()
    {
        $upazilas = Upazila::with('district.division')->latest('id')->get();
        return view('admin.geographic.upazila.index', compact('upazilas'));
    }

    public function create()
    {
        $districts = District::orderBy('name')->get();
        return view('admin.geographic.upazila.create', compact('districts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'district_id' => 'required|exists:districts,id',
            'name' => 'required|string|max:255',
            'bn_name' => 'nullable|string|max:255',
            'url' => 'nullable|string|max:255',
        ]);

        Upazila::create($request->only('district_id', 'name', 'bn_name', 'url'));

        Toastr::success('Upazila Created Successfully!', '', ["progressbar" => true]);
        return redirect()->route('geographic.upazilas.index');
    }

    public function edit(Upazila $upazila)
    {
        $districts = District::orderBy('name')->get();
        return view('admin.geographic.upazila.edit', compact('upazila', 'districts'));
    }

    public function update(Request $request, Upazila $upazila)
    {
        $request->validate([
            'district_id' => 'required|exists:districts,id',
            'name' => 'required|string|max:255',
            'bn_name' => 'nullable|string|max:255',
            'url' => 'nullable|string|max:255',
        ]);

        $upazila->update($request->only('district_id', 'name', 'bn_name', 'url'));

        Toastr::success('Upazila Updated Successfully!', '', ["progressbar" => true]);
        return redirect()->route('geographic.upazilas.index');
    }

    public function destroy(Upazila $upazila)
    {
        $upazila->delete();
        Toastr::success('Upazila Deleted Successfully!', '', ["progressbar" => true]);
        return redirect()->route('geographic.upazilas.index');
    }
}
