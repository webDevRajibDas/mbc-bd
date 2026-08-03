<?php

use App\Http\Controllers\AppSettingController;
use App\Http\Controllers\ProjectNameController;
use App\Http\Controllers\PropertyCategoryController;
use App\Http\Controllers\PropertyStoreController;
use Illuminate\Support\Facades\Route;

/* This file is loaded inside the authenticated Master Admin route group. */
Route::view('/dashboard', 'home')->name('dashboard');
Route::redirect('/', '/master/dashboard');

Route::get('/settings', [AppSettingController::class, 'edit'])->name('settings.edit');
Route::post('/settings', [AppSettingController::class, 'update'])->name('settings.update');

Route::resource('/project-names', ProjectNameController::class)
    ->except(['show'])
    ->names('project-names');

Route::resource('/property-categories', PropertyCategoryController::class)
    ->except(['show'])
    ->names('property-categories');

Route::resource('/property-stores', PropertyStoreController::class)
    ->except(['show'])
    ->parameters(['property-stores' => 'propertyStore'])
    ->names('property-stores');
