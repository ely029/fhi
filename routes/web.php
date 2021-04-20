<?php

declare(strict_types=1);

use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\UsersController;
use App\Http\Controllers\EnrollmentRegimentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ResubmitEnrollmentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::group(['namespace' => 'Dashboard', 'prefix' => 'dashboard', 'middleware' => 'auth'], static function () {
    Route::get('/', [DashboardController::class, 'index']);

    //Approver Admin CRUD
    Route::group(['middleware' => 'super_admin'], static function () {
        Route::get('/users', [UsersController::class, 'index']);
        Route::get('/users/create', [UsersController::class, 'create']);
        Route::post('/users', [UsersController::class, 'store']);
        Route::get('/users/{user}/edit', [UsersController::class, 'edit']);
        Route::patch('/users/{user}', [UsersController::class, 'update']);
        Route::delete('/users/{user}', [UsersController::class, 'destroy']);
    });
});

Route::get('/', [HomeController::class, 'index']);
Route::group(['middleware' => 'auth'], static function () {
    Route::get('/enrollments', [EnrollmentRegimentController::class, 'index']);
    Route::get('/enrollments/create', [EnrollmentRegimentController::class, 'create']);
    Route::get('/enrollments/{tbMacForm}', [EnrollmentRegimentController::class,'show']);

    Route::get('/enrollments/{tbMacForm}/{fileName}/attachment', [EnrollmentRegimentController::class,'showAttachment']);
    Route::post('/enrollments', [EnrollmentRegimentController::class, 'store']);
    Route::post('/enrollments/sent-recommendation', 'App\Http\Controllers\EnrollmentRegimentController@sendRecommendation')->name('enrolment.sendRecommendation');
    Route::get('resubmit/enrollment/{tbMacForm}', [ResubmitEnrollmentController::class,'edit']);
    Route::post('resubmit/enrollment/{tbMacForm}', [ResubmitEnrollmentController::class,'resubmit']);
});
