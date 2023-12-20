<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\DevelopmentPartnerController;
use App\Http\Controllers\DevelopmentPartnerEmpolyController;
use App\Http\Controllers\GeodistrictController;
use App\Http\Controllers\GeodivisionController;
use App\Http\Controllers\GeoupazilaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TmsBatchGroupController;
use App\Http\Controllers\TmsBatchScheduleDetailController;
use App\Http\Controllers\TmsCategoryController;
use App\Http\Controllers\TmsClassAttendanceController;
use App\Http\Controllers\TmsClassDocumentController;
use App\Http\Controllers\TmsCourseController;
use App\Http\Controllers\TmsEvaluationForStudentController;
use App\Http\Controllers\TmsEvaluationForTrainerController;
use App\Http\Controllers\TmsHollyDayController;
use App\Http\Controllers\TmsInspectionController;
use App\Http\Controllers\TmsPermissionController;
use App\Http\Controllers\TmsProviderController;
use App\Http\Controllers\TmsProvidersBatchController;
use App\Http\Controllers\TmsProvidersTrainerController;
use App\Http\Controllers\TmsRoleController;
use App\Http\Controllers\TmsRoleHasPermissionController;
use App\Http\Controllers\TmsTrainingBatchScheduleController;
use App\Http\Controllers\TmsUserTypeController;
use App\Http\Controllers\TrainingApplicantController;
use App\Http\Controllers\TrainingBatchController;
use App\Http\Controllers\TrainingTitleController;
use App\Models\DevelopmentPartner;
use App\Models\TmsEvaluationForStudent;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
})->name('auth.login');

Route::post('/get-token', [ApiController::class, 'getToken']);
Route::post('/logout', [ApiController::class, 'logout']);

Route::get('home', function () {
    return view('front.layouts.app');
});
Route::resource('development-partner', DevelopmentPartnerController::class);
Route::resource('development-partner-empoly', DevelopmentPartnerEmpolyController::class);
Route::resource('geodistrict', GeodistrictController::class);
Route::resource('geodivision', GeodivisionController::class);
Route::resource('geoupazilas', GeoupazilaController::class);
Route::resource('profile', ProfileController::class);
Route::resource('tms-batch-schedule-detail', TmsBatchScheduleDetailController::class);
Route::resource('tms-categorie', TmsCategoryController::class);
Route::resource('class-attendance', TmsClassAttendanceController::class);
Route::resource('class-document', TmsClassDocumentController::class);
Route::resource('tms-course', TmsCourseController::class);
Route::resource('evaluation-student', TmsEvaluationForStudentController::class);
Route::resource('evaluation-for-trainer', TmsEvaluationForTrainerController::class);
Route::resource('tms-holly-day', TmsHollyDayController::class);
Route::resource('tms-inspections', TmsInspectionController::class);
Route::resource('role-permision', TmsPermissionController::class);
Route::resource('provider', TmsProviderController::class);
Route::resource('providers-batche', TmsProvidersBatchController::class);
Route::resource('providers-trainer', TmsProvidersTrainerController::class);
Route::resource('role', TmsRoleController::class);
//Route::resource('permission', TmsRoleHasPermissionController::class);
Route::resource('batch-schedule', TmsTrainingBatchScheduleController::class);
Route::resource('user-type', TmsUserTypeController::class);
Route::resource('trainer-profile', TmsUserTypeController::class);
Route::resource('training-applicant', TrainingApplicantController::class);
Route::resource('training-batche', TrainingBatchController::class);
Route::resource('training-title', TrainingTitleController::class);
Route::resource('batch-group', TmsBatchGroupController::class);
