<?php

declare(strict_types=1);

use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\RolesController;
use App\Http\Controllers\Dashboard\UsersController;
use App\Http\Controllers\EnrollmentRegimentController;
use App\Http\Controllers\HomeController;
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

    Route::group(['middleware' => 'route.access'], static function () {
        Route::get('/roles', [RolesController::class, 'index']);
        Route::get('/roles/create', [RolesController::class, 'create']);
        Route::post('/roles', [RolesController::class, 'store']);
        Route::get('/roles/{role}/edit', [RolesController::class, 'edit']);
        Route::patch('/roles/{role}', [RolesController::class, 'update']);
        Route::delete('/roles/{role}', [RolesController::class, 'destroy']);

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
    Route::post('/enrollment/create', [EnrollmentRegimentController::class, 'create']);
});
