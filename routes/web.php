<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\CollegeController;
use App\Http\Controllers\OnePalakasanController;
use App\Http\Controllers\PalakasanController;
use App\Http\Controllers\PalakasanSportsController;
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
Route::resource('account', AccountController::class);
Route::resource('palakasan/details',PalakasanController::class);
Route::post('/palakasan/details', [PalakasanController::class, 'store'])->name('palakasan.store');
Route::resource('palakasan/team', PalakasanTeamController::class);
Route::resource('palakasan/sportselection', PalakasanSportsController::class);


//trial routinf
Route::get('details', [OnePalakasanController::class, 'details'])->name('palakasan.details'); // Displays the details
Route::post('detail/store', [OnePalakasanController::class, 'store_palakasan'])->name('palakasan.store');
Route::post('sport/store', [OnePalakasanController::class, 'store_sports'])->name('palakasanSport.store');
Route::post('team/store', [OnePalakasanController::class, 'store_teams'])->name('team.store');
Route::put('/palakasan/{id}/update-status', [OnePalakasanController::class, 'updateStatus'])->name('palakasan.updateStatus');





Route::resource('student', StudentController::class);
Route::post('student/import', [StudentController::class, 'import'])->name('student.import');

Route::get('/', function () {
    return Inertia::render('SSCAdmin/Dashboard');
});






