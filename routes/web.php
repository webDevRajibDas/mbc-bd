<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Officer\OfficerDashboardController;


Route::get('/clear-cache', function () {
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    dd('done');
   return back();
});

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes(['register' => false]);
Route::get('/register', function () {
    return redirect('/');
});

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'web'])->group(function () {
    Route::prefix('officer')
        ->name('officer.')
        ->group(function () {
            Route::get('/dashboard', [OfficerDashboardController::class, 'index'])
                ->middleware('role:Officer|Super Admin')
                ->name('dashboard');
            Route::middleware('role:Officer')->group(function () {
                Route::get('/booking-form', [OfficerDashboardController::class, 'bookingForm'])->name('booking-form');
                Route::post('/booking-form', [OfficerDashboardController::class, 'storeBooking'])->name('booking-form.store');
                Route::get('/profile', [OfficerDashboardController::class, 'profile'])->name('profile');
                Route::post('/profile', [OfficerDashboardController::class, 'updateProfile'])->name('profile.update');
                Route::redirect('/panel', '/officer/dashboard')->name('panel');
            });
        });

    Route::get('/get-districts/{division_id}', function ($division_id) {
        return response()->json(\App\Models\District::where('division_id', $division_id)->orderBy('name')->get());
    })->name('get-districts');
    Route::get('/get-upazilas/{district_id}', function ($district_id) {
        return response()->json(\App\Models\Upazila::where('district_id', $district_id)->orderBy('name')->get());
    })->name('get-upazilas');
    Route::get('/get-unions/{upazila_id}', function ($upazila_id) {
        return response()->json(\App\Models\Union::where('upazila_id', $upazila_id)->orderBy('name')->get());
    })->name('get-unions');

    /* Regular administration: available to Admin, Master Admin, and legacy Super Admin accounts. */
    Route::prefix('admin')->middleware('role:Admin|Master Admin|Super Admin')->group(function () {
        Route::middleware('permission:Geographic menu')->group(function () {
            require base_path('routes/geographic.php');
        });

        require base_path('routes/access-control.php');

        Route::resource('/registration-categories', \App\Http\Controllers\RegistrationCategoryController::class)
            ->except(['show'])
            ->parameters(['registration-categories' => 'registrationCategory'])
            ->names('admin.registration-categories');

        Route::resource('/packages', \App\Http\Controllers\PackageController::class)
            ->except(['show'])
            ->names('admin.packages');

        Route::prefix('e-shop')->name('admin.e-shop.')->group(function () {
            Route::get('stock', [\App\Http\Controllers\ShopStockController::class, 'index'])->name('stock.index');
            Route::post('stock', [\App\Http\Controllers\ShopStockController::class, 'store'])->name('stock.store');
            Route::resource('categories', \App\Http\Controllers\ShopCategoryController::class)->except(['show']);
            Route::resource('products', \App\Http\Controllers\ShopProductController::class)->except(['show']);
        });
    });

    /* Master administration: separate URL space for system-wide configuration. */
    Route::prefix('master')
        ->name('master.')
        ->middleware('role:Master Admin|Super Admin')
        ->group(function () {
            require base_path('routes/master-admin.php');
        });
});
