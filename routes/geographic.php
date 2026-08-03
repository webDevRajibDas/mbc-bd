<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\UpazilaController;
use App\Http\Controllers\UnionController;

Route::prefix('geographic')->name('geographic.')->group(function () {
    Route::resource('divisions', DivisionController::class);
    Route::resource('districts', DistrictController::class);
    Route::resource('upazilas', UpazilaController::class);
    Route::resource('unions', UnionController::class);
});
