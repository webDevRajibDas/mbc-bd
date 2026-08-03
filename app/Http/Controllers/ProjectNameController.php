<?php

namespace App\Http\Controllers;

use App\Models\ProjectName;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Toastr;

class ProjectNameController extends Controller
{
    public function index()
    {
        $projectNames = ProjectName::latest('id')->get();
        return view('admin.project_names.index', compact('projectNames'));
    }

    public function create()
    {
        return view('admin.project_names.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:project_names,name',
        ]);

        ProjectName::create($request->only('name'));

        Toastr::success('Project Name Created Successfully!', '', ["progressbar" => true]);
        return redirect()->route('master.project-names.index');
    }

    public function edit(ProjectName $projectName)
    {
        return view('admin.project_names.edit', compact('projectName'));
    }

    public function update(Request $request, ProjectName $projectName)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('project_names', 'name')->ignore($projectName->id),
            ],
        ]);

        $projectName->update($request->only('name'));

        Toastr::success('Project Name Updated Successfully!', '', ["progressbar" => true]);
        return redirect()->route('master.project-names.index');
    }

    public function destroy(ProjectName $projectName)
    {
        $projectName->delete();

        Toastr::success('Project Name Deleted Successfully!', '', ["progressbar" => true]);
        return redirect()->route('master.project-names.index');
    }
}
