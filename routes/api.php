<?php

declare(strict_types=1);

// @TB: https://laravel.com/docs/controllers#route-caching
// use Illuminate\Http\Request;

use App\Http\Controllers\Api\CaseManagementController;
use App\Http\Controllers\Api\CaseManagementRecommendationController;
use App\Http\Controllers\Api\CaseManagementResubmitController;
use App\Http\Controllers\Api\CronJobController;
use App\Http\Controllers\Api\EnrollmentRecommendationsController;
use App\Http\Controllers\Api\EnrollmentResubmitController;
use App\Http\Controllers\Api\EnrollmentsController;
use App\Http\Controllers\Api\ITISController;
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
    Route::get('/enrollments-with-recommendation', [EnrollmentRecommendationsController::class, 'index']);
    Route::post('/enrollments/{tbMacForm}/recommendation', [EnrollmentRecommendationsController::class, 'store']);
    Route::get('/enrollments/resubmit/{tbMacForm}', [EnrollmentResubmitController::class, 'editPage']);
    Route::get('/case-management', [CaseManagementController::class, 'index']);
    Route::post('/case-management', [CaseManagementController::class, 'store']);

    Route::get('itis/get/patient', [ITISController::class, 'getPatient']);
    Route::get('/case-management/{tbMacForm}', [CaseManagementController::class, 'show']);
    Route::post('/case-management/{tbMacForm}/resubmit', [CaseManagementResubmitController::class, 'reSubmit']);
    Route::get('/case-management/resubmit/{tbMacForm}', [CaseManagementResubmitController::class, 'edit']);
    Route::post('/case-management/{tbMacForm}/recommendations', [CaseManagementRecommendationController::class, 'store']);
    Route::get('/case-management/{tbMacForm}/{fileName}/attachment', [CaseManagementController::class,'showAttachment']);
});
