<?php

use App\Http\Controllers\CollegeController;
use App\Http\Controllers\PalakasanController;
use App\Http\Controllers\PalakasanTeamController;
use App\Http\Controllers\PointsController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SportController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\VenueController;

Route::resource('product', ProductController::class);
Route::resource('college', CollegeController::class);
Route::resource('venue', VenueController::class);
Route::resource('sport', SportController::class);
Route::resource('points', PointsController::class);
Route::resource('palakasan/details',PalakasanController::class);
Route::resource('palakasan/team', PalakasanTeamController::class);

// Use resource for common CRUD routes
Route::resource('student', StudentController::class);
Route::post('student/import', [StudentController::class, 'import'])->name('student.import');

Route::get('/', function () {
    return Inertia::render('SSCAdmin/Dashboard');
});

Route::get('/palakasan/sports', function () {
    return Inertia::render('SSCAdmin/Palakasan/Sports');
});





