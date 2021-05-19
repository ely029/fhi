<?php

declare(strict_types=1);

use App\Http\Controllers\Api\ITISController;
use App\Http\Controllers\CaseManagementController;
use App\Http\Controllers\CaseManagementRecommendationController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\UsersController;
use App\Http\Controllers\EnrollmentRegimentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ResubmitCaseManagementController;
use App\Http\Controllers\ResubmitEnrollmentController;
use App\Http\Controllers\ResubmitTreatmentOutcomeController;
use App\Http\Controllers\TreatmentOutcomeAttachmentsController;
use App\Http\Controllers\TreatmentOutcomeRecommendationController;
use App\Http\Controllers\TreatmentOutcomesController;
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

    Route::group(['middleware' => 'health_care_worker'], static function () {
        Route::get('/enrollments/create', [EnrollmentRegimentController::class, 'create']);
        Route::post('/enrollments', [EnrollmentRegimentController::class, 'store']);
        Route::post('resubmit/enrollment/{tbMacForm}', [ResubmitEnrollmentController::class, 'resubmit']);
        Route::get('/case-management/resubmit/{tbMacForm}', [ResubmitCaseManagementController::class, 'edit']);
        Route::post('/case-management/resubmit/{tbMacForm}', [ResubmitCaseManagementController::class, 'reSubmit']);

        Route::get('/treatment-outcomes/create', [TreatmentOutcomesController::class, 'create']);
        Route::post('/treatment-outcomes', [TreatmentOutcomesController::class, 'store']);
        Route::get('/treatment-outcomes/resubmit/{tbMacForm}', [ResubmitTreatmentOutcomeController::class, 'edit']);
        Route::post('/treatment-outcomes/resubmit/{tbMacForm}', [ResubmitTreatmentOutcomeController::class, 'reSubmit']);
    });

    Route::get('/enrollments/{tbMacForm}', [EnrollmentRegimentController::class,'show']);

    Route::get('/enrollments/{tbMacForm}/{fileName}/attachment', [EnrollmentRegimentController::class,'showAttachment']);
    Route::get('/enrollments/{tbMacForm}/{fileName}/download', [EnrollmentRegimentController::class,'downloadAttachment']);
    Route::post('/enrollments/sent-recommendation', 'App\Http\Controllers\EnrollmentRegimentController@sendRecommendation')->name('enrolment.sendRecommendation');
    Route::get('resubmit/enrollment/{tbMacForm}', [ResubmitEnrollmentController::class, 'edit']);

    Route::get('/case-management', [CaseManagementController::class, 'index']);

    Route::get('/case-management/show/{tbMacForm}', [CaseManagementController::class,'show']);
    Route::get('/case-management/create', [CaseManagementController::class, 'create']);
    Route::post('/case-management/create', [CaseManagementController::class, 'store']);
    Route::post('/case-management/{tbMacForm}/recommendation', [CaseManagementRecommendationController::class,'store']);
    Route::get('/case-management/{tbMacForm}/{fileName}/attachment', [CaseManagementController::class,'showAttachment']);
    Route::get('/case-management/{tbMacForm}/{fileName}/download', [CaseManagementController::class,'downloadAttachment']);

    Route::get('/treatment-outcomes', [TreatmentOutcomesController::class,'index']);
    Route::get('/treatment-outcomes/{tbMacForm}', [TreatmentOutcomesController::class,'show']);

    Route::get('itis/get/patient', [ITISController::class, 'getPatient']);
    Route::get('itis/patient/treatment', [ITISController::class, 'getPatientTreatment']);
    Route::get('/treatment-outcomes/{tbMacForm}/{fileName}/attachment', [TreatmentOutcomeAttachmentsController::class,'showAttachment']);
    Route::get('/treatment-outcomes/{tbMacForm}/{fileName}/download', [TreatmentOutcomeAttachmentsController::class,'downloadAttachment']);
    Route::post('/treatment-outcomes/{tbMacForm}/recommendation', [TreatmentOutcomeRecommendationController::class,'store']);
    Route::get('/treatment/view/{presentationNumber}/{fileName}', [TreatmentOutcomesController::class, 'viewAttachment']);
});
