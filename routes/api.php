<?php

declare(strict_types=1);

// @TB: https://laravel.com/docs/controllers#route-caching
// use Illuminate\Http\Request;

use App\Http\Controllers\Api\CronJobController;
use App\Http\Controllers\Api\EnrollmentRecommendationsController;
use App\Http\Controllers\Api\EnrollmentsController;
use App\Http\Controllers\Api\Users\FcmRegistrationTokensController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// @TB: https://laravel.com/docs/controllers#route-caching
// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/cron', [CronJobController::class, 'run']);

// @TB: Do not remove these unless absolutely required. Removing will cause
// negative side-effect not limited to failed unit tests.
// To implement, set required config.boilerplate.firebase keys
Route::group([
    'prefix' => 'users',
    'namespace' => 'Users',
    'middleware' => ['auth.once'],
], static function () {
    // Normally done when (1) logging in, (2) device token changes.
    Route::post('/{user}/fcm_registration_tokens', [FcmRegistrationTokensController::class, 'store']);

    // Normally done when the user logs out
    Route::delete('/{user}/fcm_registration_tokens', [FcmRegistrationTokensController::class, 'destroy']);
});

Route::group([
    'middleware' => ['auth.once'],
], static function () {
    Route::get('/enrollments', [EnrollmentsController::class, 'index']);
    Route::get('/enrollments/{tbMacForm}', [EnrollmentsController::class, 'show']);
    Route::get('/enrollments/{tbMacForm}/{fileName}/attachment', [EnrollmentsController::class, 'showAttachment']);
    Route::post('/enrollments', [EnrollmentsController::class, 'store']);
    Route::post('/enrollments/{tbMacForm}/recommendation', [EnrollmentRecommendationsController::class, 'store']);
});
