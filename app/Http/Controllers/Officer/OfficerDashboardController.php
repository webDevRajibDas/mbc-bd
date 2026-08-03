<?php

namespace App\Http\Controllers\Officer;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Schema;
use Spatie\Activitylog\Models\Activity;
use Illuminate\Http\Request;
use App\Models\Division;
use App\Models\ProjectName;
use App\Models\PropertyCategory;
use App\Models\RegistrationCategory;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Toastr;

use App\Models\Booking;
use Illuminate\Support\Facades\DB;

class OfficerDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:Officer|Super Admin')->only('index');
        $this->middleware('role:Officer')->except('index');
    }

    public function index()
    {
        $officer = auth()->user();

        $stats = [
            'assigned_records' => $this->countAssignedRecords($officer->id),
            'pending_records' => $this->countAssignedRecords($officer->id, 'inactive'),
            'approved_records' => $this->countAssignedRecords($officer->id, 'active'),
            'rejected_records' => 0,
            'deposit' => $this->numericUserValue($officer, ['deposit', 'total_deposit']),
            'balance' => $this->numericUserValue($officer, ['balance', 'wallet_balance']),
            'profit' => $this->numericUserValue($officer, ['profit', 'commission']),
            'shopping_points' => $this->numericUserValue($officer, ['shopping_points', 'points']),
            'unread_notifications' => 0,
        ];

        $recentActivities = $this->recentActivities($officer->id);
        $officerReports = $this->officerWiseReports();
        $registrationCategories = RegistrationCategory::query()
            ->where('is_active', true)
            ->orderBy('name')
            ->get();
        $propertyCategories = PropertyCategory::query()
            ->where('is_active', true)
            ->orderBy('name')
            ->get();
        $officerInitials = collect(explode(' ', $officer->name))
            ->filter()
            ->take(2)
            ->map(fn ($part) => mb_substr($part, 0, 1))
            ->implode('');

        return view('officer.officer_panel', compact('officer', 'officerInitials', 'stats', 'recentActivities', 'officerReports', 'registrationCategories', 'propertyCategories'));
    }

    public function profile()
    {
        $officer = auth()->user();

        return view('officer.profile', compact('officer'));
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'nullable|string|min:6|confirmed',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $user->name = $request->name;

        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        if ($request->hasFile('profile_image')) {
            $image = $request->file('profile_image');
            $imageName = 'profile_' . $user->id . '_' . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('uploads/profiles');
            
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }

            if ($user->profile_image) {
                $oldImagePath = public_path($user->profile_image);
                if (file_exists($oldImagePath)) {
                    @unlink($oldImagePath);
                }
            }

            $image->move($destinationPath, $imageName);
            $user->profile_image = 'uploads/profiles/' . $imageName;
        }

        $user->save();

        Toastr::success('Profile Updated Successfully!', '', ["progressbar" => true]);
        return redirect()->back();
    }

    public function bookingForm()
    {
        $officer = auth()->user();
        $divisions = Division::orderBy('name')->get();
        $projectNames = ProjectName::orderBy('name')->get();

        return view('officer.booking_form', compact('officer', 'divisions', 'projectNames'));
    }

    public function storeBooking(Request $request)
    {
        $request->validate([
            'project_name_id' => 'required|exists:project_names,id',
            'user_name' => 'required|string|max:255|unique:users,name',
            'full_name' => 'required|string|max:255',
            'guardian_name' => 'nullable|string|max:255',
            'nid_no' => 'nullable|string|max:255',
            'phone_number' => 'nullable|string|max:255',
            'gender' => 'nullable|string|max:255',
            'division' => 'required|exists:divisions,id',
            'district' => 'required|exists:districts,id',
            'thana' => 'required|exists:upazilas,id',
            'union' => 'required|exists:unions,id',
            'holding_village' => 'nullable|string|max:255',
            'referral_id' => 'nullable|string|max:255',
            'placement_user_id' => 'nullable|string|max:255',
            'password' => 'required|string|min:6|confirmed',
            'nominee_name' => 'nullable|string|max:255',
            'relationship' => 'nullable|string|max:255',
            'terms' => 'required|accepted',
        ]);

        DB::transaction(function () use ($request) {
            $user = User::create([
                'name' => $request->user_name,
                'email' => $request->user_name . '@mbcbd.com',
                'password' => bcrypt($request->password),
                'status' => 'inactive',
            ]);

            Booking::create([
                'user_id' => $user->id,
                'officer_id' => auth()->id(),
                'project_name_id' => $request->project_name_id,
                'full_name' => $request->full_name,
                'guardian_name' => $request->guardian_name,
                'nid_no' => $request->nid_no,
                'phone_number' => $request->phone_number,
                'gender' => $request->gender,
                'division_id' => $request->division,
                'district_id' => $request->district,
                'upazila_id' => $request->thana,
                'union_id' => $request->union,
                'holding_village' => $request->holding_village,
                'referral_id' => $request->referral_id,
                'placement_user_id' => $request->placement_user_id,
                'nominee_name' => $request->nominee_name,
                'relationship' => $request->relationship,
            ]);
        });

        Toastr::success('Booking Form Submitted Successfully!', '', ["progressbar" => true]);
        return redirect()->route('officer.booking-form');
    }

    private function countAssignedRecords(int $officerId, ?string $status = null): int
    {
        if (! Schema::hasTable('bookings')) {
            return 0;
        }

        $query = Booking::query()->where('officer_id', $officerId);

        if ($status !== null) {
            $query->whereHas('user', function ($q) use ($status) {
                $q->where('status', $status);
            });
        }

        return $query->count();
    }

    private function numericUserValue($user, array $columns): float
    {
        foreach ($columns as $column) {
            if (Schema::hasColumn('users', $column)) {
                return (float) ($user->{$column} ?? 0);
            }
        }

        return 0;
    }

    private function recentActivities(int $officerId)
    {
        if (! Schema::hasTable(config('activitylog.table_name', 'activity_log'))) {
            return collect();
        }

        return Activity::query()
            ->where('causer_type', \App\Models\User::class)
            ->where('causer_id', $officerId)
            ->latest()
            ->limit(10)
            ->get();
    }

    private function officerWiseReports()
    {
        if (! Schema::hasTable('bookings') || ! Schema::hasTable('roles')) {
            return collect();
        }

        if (! Role::where('name', 'Officer')->where('guard_name', 'web')->exists()) {
            return collect();
        }

        return User::query()
            ->role('Officer')
            ->withCount([
                'createdBookings as customer_count',
                'createdBookings as refer_count' => function ($query) {
                    $query->whereNotNull('referral_id')
                        ->where('referral_id', '<>', '');
                },
            ])
            ->orderByDesc('customer_count')
            ->orderByDesc('refer_count')
            ->orderBy('name')
            ->get()
            ->sortByDesc(function ($officer) {
                return ((int) $officer->customer_count * 1000) + (int) $officer->refer_count;
            })
            ->values()
            ->map(function ($officer, $index) {
                $officer->rank_position = $index + 1;
                return $officer;
            });
    }
}
