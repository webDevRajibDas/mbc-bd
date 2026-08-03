<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Brian2694\Toastr\Facades\Toastr;
use DB;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function index()
    {
        $data = [
            'users' => User::with('roles')->latest('id')->get(),
        ];
        return view('admin.access_control.user.index', $data);
    }


    public function create()
    {
        $data = [
            'model' => new User(),
            'roles' => Role::whereNotIn('name', ['Super Admin', 'Master Admin'])->pluck('name', 'id'),
        ];
        return view('admin.access_control.user.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => ['required', 'string', 'confirmed', Password::min(8)->mixedCase()->letters()->numbers()->symbols()],
            'status' => 'required|in:active,inactive',
        ]);

        try {
            DB::beginTransaction();
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->status = $request->status;
            $user->save();

            if ($request->role) {
                $user->syncRoles(Role::findOrFail($request->role));
            }
            DB::commit();

            Toastr::success('User Created Successfully!', '', ["progressbar" => true]);
            return redirect()->route('user.index');

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::emergency("File:" . $e->getFile() . "Line:" . $e->getLine() . "Message:" . $e->getMessage());
            Toastr::info('Something went wrong!', '', ["progressbar" => true]);
            return redirect()->route('user.index');
        }
    }

    public function show(User $user)
    {
        return $this->edit($user);
    }


    public function edit(User $user)
    {
        $data = [
            'user' => $user,
            'roles' => Role::whereNotIn('name', ['Super Admin', 'Master Admin'])->pluck('name', 'id'),
            'selected_role' => $user->roles->first()?->id,
        ];
        return view('admin.access_control.user.edit', $data);
    }


    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => ['nullable', 'string', 'confirmed', Password::min(8)->mixedCase()->letters()->numbers()->symbols()],
            'status' => 'required|in:active,inactive',
        ]);

        try {
            DB::beginTransaction();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->status = $request->status;
            if($request->get('password')){
                $user->password=bcrypt($request->get('password'));
            }
            $user->save();

            if ($request->role) {
                $user->syncRoles(Role::findOrFail($request->role));
            }
            DB::commit();
            Toastr::success('User Updated Successfully!', '', ["progressbar" => true]);
            return redirect()->route('user.index');
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::emergency("File:" . $e->getFile() . "Line:" . $e->getLine() . "Message:" . $e->getMessage());
            Toastr::info('Something went wrong!', '', ["progressbar" => true]);
            return back();
        }
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        Toastr::success('User Deleted Successfully!', '', ["progressbar" => true]);
        return redirect()->back();
    }


    public function getDeletedUser()
    {
        $users = User::onlyTrashed()->get();
        return view('admin.access_control.user.deleted_user', compact('users'));
    }

    public function restore($id)
    {
        $user = User::withTrashed()->findOrFail($id)->restore();
        Toastr::success('User Restore Successfully!', '', ["closeButton" => "true", "progressBar" => "true"]);
        return redirect()->route('user.deleted');
    }

    public function permanentDelete($id)
    {
        $user = User::withTrashed()->findOrFail($id);
        $user->forceDelete();
        Toastr::success('User Permanently Deleted!');
        return redirect()->route('user.deleted');
    }


    public function reset($id){
        $user = User::findOrFail($id);
        $tempPassword = \Illuminate\Support\Str::random(12);
        $user->password = bcrypt($tempPassword);
        $user->save();

        Toastr::success('Password Reset Successfully!', '', ["progressbar" => true]);
        return redirect()->back();
    }
}
