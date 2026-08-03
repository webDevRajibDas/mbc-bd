<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Models\Activity;
use Yajra\DataTables\Facades\DataTables;

class ActivityLogController extends Controller
{
    public function getLoginActivity(){
        $login_activity = Activity::inLog('login', 'logout')->latest()->get();
        return view('admin.activity_log.login_activity',compact('login_activity'));
    }

    public function cleanLoginActivity(){
        Artisan::call('activitylog:clean');
        return back();
    }

    public function getAdminActivity(){
        $admin_activity = Activity::query()->whereNotIn('log_name',['login', 'logout'])->with('causer')->latest();
        if (\request()->ajax()) {
            return DataTables::of($admin_activity)
                ->addIndexColumn()
                ->addColumn('date', function ($row) {
                    return Carbon::parse($row->created_at)->format('d-m-Y h:i A');
                })
                ->addColumn('user_type', function ($row) {
                    return $row->causer ? $row->causer->getRoleNames()->first() : '';
                })
                ->filterColumn('user_type', function($query, $keyword) {
                    $roles = Role::query()->where('name','LIKE', "%{$keyword}%")->get();
                    $user_ids = [];
                    foreach ($roles as $role){
                        $results = DB::table('model_has_roles')->where('role_id',$role->id)->get();
                        foreach ($results as $result){
                            array_push($user_ids,$result->model_id);
                        }
                    }
                    $query->whereIn('causer_id',$user_ids);
                })
                ->addColumn('type', function ($row) {
                    if($row->description=='created'){
                        return '<span class="badge badge-success">'.$row->description.'</span>';
                    } elseif ($row->description=='updated'){
                        return '<span class="badge badge-primary">'.$row->description.'</span>';
                    } elseif ($row->description=='deleted'){
                        return '<span class="badge badge-danger">'.$row->description.'</span>';
                    }
                })
                ->addColumn('action', function ($row) {
                    $route = route('view-admin-activity',$row->id);
                    return auth()->user()->can('Admin activity show') ? '<a href="'.$route.'" class="btn btn-sm btn-success">View</a>' : '';
                })
                ->rawColumns(['action','type'])
                ->toJson();
        } else{
            return view('admin.activity_log.admin_activity',compact('admin_activity'));
        }
    }

    public function viewAdminActivity($id){
        $activity_log = Activity::find($id);
        return view('admin.activity_log.view_admin_activity',compact('activity_log'));
    }

    public function revertAllAdminActivity($id){
        $log = Activity::find($id);
        $log->subject->update($log->changes['old']);
        Toastr::success('Log Reverted successfully.');
        return back();
    }

    public function revertAdminActivity(Request $request, $id){
        $log = Activity::find($id);
        $field_name = $request->field_name;
        $old_value = $request->old_value;
        $log->subject->update([
            $field_name => $old_value,
        ]);
        Toastr::success('Log Reverted successfully.');
        return back();
    }

}
