<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ActivityLogController;

Route::prefix('access-control')->middleware('permission:Access control menu')->group(function () {
    Route::resource('role', RoleController::class);
    Route::get('user/deleted', [UserController::class, 'getDeletedUser'])->name('user.deleted');
    Route::get('user/restore/{id}', [UserController::class, 'restore'])->name('user.restore');
    Route::delete('user/permanent-delete/{id}', [UserController::class, 'permanentDelete'])->name('user.permanent-delete');
    Route::resource('user', UserController::class);
    Route::get('user-reset/{id}', [UserController::class, 'reset'])->name('user-reset');
    Route::resource('permission', PermissionController::class);
});

Route::middleware('permission:Activity log menu')->group(function () {
    Route::get('login-activity', [ActivityLogController::class, 'getLoginActivity'])->name('login-activity');
    Route::get('activity-log-clean-by-name', [ActivityLogController::class, 'cleanLoginActivity'])->name('activity-log-clean-by-name');
    Route::get('admin-activity', [ActivityLogController::class, 'getAdminActivity'])->name('admin-activity');
    Route::get('view-admin-activity/{id}', [ActivityLogController::class, 'viewAdminActivity'])->name('view-admin-activity');
    Route::post('revert-all-admin-activity/{id}', [ActivityLogController::class, 'revertAllAdminActivity'])->name('revert-all-admin-activity');
    Route::post('revert-admin-activity/{id}', [ActivityLogController::class, 'revertAdminActivity'])->name('revert-admin-activity');
});
