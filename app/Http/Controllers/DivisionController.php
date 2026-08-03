<?php

namespace App\Http\Controllers;

use App\Models\Division;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Toastr;

class DivisionController extends Controller
{
    public function index()
    {
        $divisions = Division::latest('id')->get();
        return view('admin.geographic.division.index', compact('divisions'));
    }

    public function create()
    {
        return view('admin.geographic.division.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:divisions,name',
            'bn_name' => 'nullable|string|max:255',
            'url' => 'nullable|string|max:255',
        ]);

        Division::create($request->only('name', 'bn_name', 'url'));

        Toastr::success('Division Created Successfully!', '', ["progressbar" => true]);
        return redirect()->route('geographic.divisions.index');
    }

    public function edit(Division $division)
    {
        return view('admin.geographic.division.edit', compact('division'));
    }

    public function update(Request $request, Division $division)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('divisions', 'name')->ignore($division->id),
            ],
            'bn_name' => 'nullable|string|max:255',
            'url' => 'nullable|string|max:255',
        ]);

        $division->update($request->only('name', 'bn_name', 'url'));

        Toastr::success('Division Updated Successfully!', '', ["progressbar" => true]);
        return redirect()->route('geographic.divisions.index');
    }

    public function destroy(Division $division)
    {
        $division->delete();
        Toastr::success('Division Deleted Successfully!', '', ["progressbar" => true]);
        return redirect()->route('geographic.divisions.index');
    }
}
