<?php

namespace App\Http\Controllers;

use App\Models\Upazila;
use App\Models\Union;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Toastr;

class UnionController extends Controller
{
    public function index()
    {
        $unions = Union::with('upazila.district.division')->latest('id')->get();
        return view('admin.geographic.union.index', compact('unions'));
    }

    public function create()
    {
        $upazilas = Upazila::orderBy('name')->get();
        return view('admin.geographic.union.create', compact('upazilas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'upazila_id' => 'required|exists:upazilas,id',
            'name' => 'required|string|max:255',
            'bn_name' => 'nullable|string|max:255',
            'url' => 'nullable|string|max:255',
        ]);

        Union::create($request->only('upazila_id', 'name', 'bn_name', 'url'));

        Toastr::success('Union Created Successfully!', '', ["progressbar" => true]);
        return redirect()->route('geographic.unions.index');
    }

    public function edit(Union $union)
    {
        $upazilas = Upazila::orderBy('name')->get();
        return view('admin.geographic.union.edit', compact('union', 'upazilas'));
    }

    public function update(Request $request, Union $union)
    {
        $request->validate([
            'upazila_id' => 'required|exists:upazilas,id',
            'name' => 'required|string|max:255',
            'bn_name' => 'nullable|string|max:255',
            'url' => 'nullable|string|max:255',
        ]);

        $union->update($request->only('upazila_id', 'name', 'bn_name', 'url'));

        Toastr::success('Union Updated Successfully!', '', ["progressbar" => true]);
        return redirect()->route('geographic.unions.index');
    }

    public function destroy(Union $union)
    {
        $union->delete();
        Toastr::success('Union Deleted Successfully!', '', ["progressbar" => true]);
        return redirect()->route('geographic.unions.index');
    }
}
