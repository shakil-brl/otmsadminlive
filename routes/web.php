<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Api\TmsBatchPhaseController;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AttendanceRepoController;
use App\Http\Controllers\AuthUserController;
use App\Http\Controllers\BatchController;
use App\Http\Controllers\BatchExamController;
use App\Http\Controllers\BatchScheduleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\ClassDocumentController;
use App\Http\Controllers\CommitteeController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CourseSupplies;
use App\Http\Controllers\CourseSuppliesController;
use App\Http\Controllers\DashboardDetailsController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\EvaluationHeadController;
use App\Http\Controllers\ExamConfigController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\FileSettingController;
use App\Http\Controllers\HolydayController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LaptopDistributionController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LotController;
use App\Http\Controllers\MyClassController;
use App\Http\Controllers\PaymentBatchController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PreliminarySelectionController;
use App\Http\Controllers\ProductComboController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\TmsBatchClosingController;
use App\Http\Controllers\TmsPhaseController;
use App\Http\Controllers\TmsSettingController;
use App\Http\Controllers\TraineeEnrollmentController;
use App\Http\Controllers\TrainerEnrollmentController;
use App\Http\Controllers\UpazilaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TmsInspectionController;
use App\Http\Controllers\ProviderBatchesController;
use App\Http\Controllers\TrainingProviderPartnerController;
use App\Http\Controllers\VerifyController;
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

// Route::get('/token-form', [ApiController::class, 'showTokenForm']);
Route::post('/get-token', [ApiController::class, 'getToken']);
Route::post('/logout', [ApiController::class, 'logout']);

// // Route::group(['middleware' => ['access.token']], function () {
// //     Route::get('/', [HomeController::class, 'index'])->name('home.index');
// // });


/**
 * Home Routes
 */
//Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/', [ApiController::class, 'showTokenForm'])->name('home.index');
/**
 * language change route
 */
Route::get('/lang/change', [HomeController::class, 'change'])->name('changeLang');
/**
 * Register Routes
 */
Route::get('/register', [RegisterController::class, 'show'])->name('register.show');

/**
 * Login Routes
 */
Route::get('/login', [ApiController::class, 'showTokenForm'])->name('login.show');

/**
 * user dashboard Routes
 */
Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');

/**
 * user dashboard Routes
 */
Route::get('/profile', [UserController::class, 'profile'])->name('profile.index');

Route::post('/set-token', [AuthUserController::class, 'setToken'])->name('setToken');
Route::post('/store-auth-user', [AuthUserController::class, 'storeAuthUser'])->name('storeAuth');
Route::get('/auth-error', [AuthUserController::class, 'authError'])->name('auth.error');

Route::group(['middleware' => ['access.token', 'permission']], function () {

    Route::group(['prefix' => 'users'], function () {
        Route::get('/', [UserController::class, 'index'])->name('users.index');
        Route::get('/{userId}', [UserController::class, 'show'])->name('users.show');
    });

    Route::group(['prefix' => 'preliminary-selected'], function () {
        Route::get('/', [PreliminarySelectionController::class, 'index'])->name('preliminary-selected.index');
        Route::get('/{userId}', [PreliminarySelectionController::class, 'show'])->name('preliminary-selected.show');
    });

    Route::group(['prefix' => 'admins'], function () {
        Route::get('/', [AdminController::class, 'index'])->name('admins.index');
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admins.dashboard');
        Route::get('/profile', [AdminController::class, 'profile'])->name('admins.profile');
        Route::get('/{userProfileId}/show', [AdminController::class, 'show'])->name('admins.show');
    });

    Route::group(['prefix' => 'categories'], function () {
        Route::get('/', [CategoryController::class, 'index'])->name('categories.index');
        Route::get('/{categoryId}', [CategoryController::class, 'show'])->name('categories.show');
    });

    Route::group(['prefix' => 'subcategories'], function () {
        Route::get('/', [SubCategoryController::class, 'index'])->name('subcategories.index');
        Route::get('/{subCategoryId}', [SubCategoryController::class, 'show'])->name('subcategories.show');
    });

    Route::group(['prefix' => 'divisions'], function () {
        Route::get('/', [DivisionController::class, 'index'])->name('divisions.index');
        Route::get('/{divisionId}', [DivisionController::class, 'show'])->name('divisions.show');
    });

    Route::group(['prefix' => 'districts'], function () {
        Route::get('/', [DistrictController::class, 'index'])->name('districts.index');
        Route::get('/{districtId}', [DistrictController::class, 'show'])->name('districts.show');
    });


    Route::group(['prefix' => 'upazilas'], function () {
        Route::get('/', [UpazilaController::class, 'index'])->name('upazilas.index');
        Route::get('/{upazilaId}', [UpazilaController::class, 'show'])->name('upazilas.show');
    });

    Route::group(['prefix' => 'providers'], function () {
        Route::get('/', [ProviderController::class, 'index'])->name('providers.index');
        Route::get('/{providerId}', [ProviderController::class, 'show'])->name('providers.show');
    });

    Route::group(['prefix' => 'committees'], function () {
        Route::get('/', [CommitteeController::class, 'index'])->name('committees.index');
        Route::get('/{committeeId}', [CommitteeController::class, 'show'])->name('committees.show');
    });


    Route::group(['prefix' => 'batches'], function () {
        Route::get('/', [BatchController::class, 'index'])->name('batches.index');
        Route::get('/all', [BatchController::class, 'all'])->name('batches.all');
        Route::get('/{batchId}', [BatchController::class, 'show'])->name('batches.show');
    });

    /**
     * Trainees Enrollment Routes
     */
    Route::group(['prefix' => 'trainee-enrollment'], function () {
        Route::get('/', [TraineeEnrollmentController::class, 'index'])->name('traineeEnroll.index');
        Route::get('/{enrollId}', [TraineeEnrollmentController::class, 'show'])->name('traineeEnroll.show');
    });

    /**
     * Trainers Enrollment Routes
     */
    Route::group(['prefix' => 'trainer-enrollment'], function () {
        Route::get('/batches', [TrainerEnrollmentController::class, 'batches'])->name('trainer-enrollment.batches');
        Route::get('/', [TrainerEnrollmentController::class, 'index'])->name('trainerEnroll.index');
        Route::get('/{enrollId}', [TrainerEnrollmentController::class, 'show'])->name('trainerEnroll.show');
    });

    /**
     * User Permission
     */
    Route::group(['prefix' => 'permission'], function () {
        Route::get('/', [PermissionController::class, 'index'])->name('permission.index');
    });

    // Route::resource('roles', RoleController::class);

    /**
     * Role Permission Routes
     */
    Route::group(['prefix' => 'role-permissions'], function () {
        Route::get('/', [RolePermissionController::class, 'index'])->name('role.index');
        Route::get('/{roleId}', [RolePermissionController::class, 'show'])->name('role.show');
        Route::get('/{roleId}', [RolePermissionController::class, 'edit'])->name('role.edit');
    });

    /**
     * Class Routes
     */
    Route::group(['prefix' => 'my-class'], function () {
        Route::get('/{scheduleId}', [MyClassController::class, 'index'])->name('my-class.index');
        Route::get('/{scheduleId}/attendance', [MyClassController::class, 'checkAttendance'])->name('my-class.attendance');
    });

    /**
     * Attendance Routes
     */
    Route::group(['prefix' => 'attendance'], function () {
        Route::get('/batch-list', [BatchScheduleController::class, 'trainerBatch'])->name('attendance.batch-list');
        Route::get('/{scheduleId}/show', [AttendanceController::class, 'show'])->name('attendance.show');
        Route::get('/{scheduleDetailId}/show/schedule', [AttendanceController::class, 'showAttendance'])->name('attendance.schedule');
        Route::get('/{scheduleDetailId}/start', [AttendanceController::class, 'start'])
            ->name('attendance.start');
        Route::get('/change-live-link', [AttendanceController::class, 'updateLink'])
            ->name('attendance.update-link');
        Route::get('/{scheduleDetailId}/student-list/{batchId?}', [AttendanceController::class, 'attendanceForm'])->name('attendance.form');
        Route::post('/{scheduleDetailId}/take-attendance', [AttendanceController::class, 'takeAttendance'])->name('attendance.take-attendance');
        Route::get('/{scheduleDetailId}/end', [AttendanceController::class, 'end'])->name('attendance.end');
    });

    /**
     * Batch Schedule Routes
     */
    Route::group(['prefix' => 'batch_schedules'], function () {
        Route::match(['get', 'post'], '/', [BatchScheduleController::class, 'batches'])->name('batch-schedule.batches');
        Route::get('/all/{schedule_id}/{batch_id}', [BatchScheduleController::class, 'index'])->name('batch-schedule.index');
        Route::get('/create/{batch_id}', [BatchScheduleController::class, 'create'])->name('batch-schedule.create');
        Route::post('/store', [BatchScheduleController::class, 'store'])->name('batch-schedule.store');
        Route::get('/show/{schedule_id}/{batch_id}', [BatchScheduleController::class, 'show'])->name('batch-schedule.office');
        Route::get('/runningBatches', [BatchScheduleController::class, 'runningBatches'])->name('batch-schedule.runningBatches');
        Route::get('/running-class-list', [BatchScheduleController::class, 'runningClassList'])->name('batch-schedule.running-class-list');
        Route::get('/destroy/{batch_id}', [BatchScheduleController::class, 'destroy'])->name('batch-schedule.destroy');
        Route::get('/clean/{batch_id}', [BatchScheduleController::class, 'clean'])->name('batch-schedule.clean');
        Route::get('/edit/{batch_id}', [BatchScheduleController::class, 'edit'])->name('batch-schedule.edit');



        Route::delete('/schedule_detail/{schedule_detail_id}/destory', [BatchScheduleController::class, 'scheduleDetailDestroy'])->name('batch-schedule-detail.destroy');
        Route::get('/create_schedule_detail/{training_batch_id}/add-new', [BatchScheduleController::class, 'scheduleDetailCreate'])->name('batch-schedule-detail.create');
        Route::post('/schedule_detail_srore/{training_batch_id}', [BatchScheduleController::class, 'scheduleDetailStore'])->name('batch-schedule-detail.store');


    });

    //Route::resource('tms-inspections', TmsInspectionController::class);
    Route::get('/tms-inspections', [TmsInspectionController::class, 'index'])->name('inspaction.index');
    Route::get('/tms-inspections/show/{id}', [TmsInspectionController::class, 'show'])->name('tms-inspections.show');
    Route::get('/tms-inspections/create', [TmsInspectionController::class, 'create'])->name('tms-inspections.create');
    Route::post('/inspections/store', [TmsInspectionController::class, 'store'])->name('tms-inspections.store');
    Route::get('/tms-inspections/inspect', [TmsInspectionController::class, 'inspect'])->name('tms-inspections.inspect');
    // Route::delete('/tms-inspections/edit', [TmsInspectionController::class, 'index'])->name('tms-inspections.edit');
    // Route::res
    /**
     * Dashboard Details Route
     */
    Route::group(['prefix' => 'dashboard_details'], function () {
        Route::get('/total_batches', [DashboardDetailsController::class, 'totalBatches'])->name('dashboard_details.total_batches');
        Route::get('/running_batches', [DashboardDetailsController::class, 'runningBatches'])->name('dashboard_details.running_batches');
        Route::get('/complete_batches', [DashboardDetailsController::class, 'completeBatches'])->name('dashboard_details.complete_batches');
        Route::get('/ongoing_classes', [DashboardDetailsController::class, 'ongoingClasses'])->name('dashboard_details.ongoing_classes');
        Route::get('/complete_classes', [DashboardDetailsController::class, 'completeClasses'])->name('dashboard_details.complete_classes');
        Route::get('/districts', [DashboardDetailsController::class, 'districts'])->name('dashboard_details.districts');
        Route::get('/upazilas', [DashboardDetailsController::class, 'upazilas'])->name('dashboard_details.upazilas');
        Route::get('/partners', [DashboardDetailsController::class, 'partners'])->name('dashboard_details.partners');
        Route::get('/trainers', [DashboardDetailsController::class, 'trainers'])->name('dashboard_details.trainers');
        Route::get('/trainees/{batch_id}', [DashboardDetailsController::class, 'trainees'])->name('dashboard_details.trainees');
    });

    Route::group(['prefix' => 'provider'], function () {
        Route::get('/all-trainers', [ProviderController::class, 'allTrainer'])->name('provider.all-trainer');
        Route::get('/link-batch/{providerId}', [ProviderController::class, 'enrollBatch'])->name('provider.link-batch');
        // Route::get('/link-batch/{providerId}/edit', [ProviderController::class, 'editLinkBatch'])->name('provider.edit.link-batch');
    });

    Route::group(['prefix' => 'provider-batches'], function () {
        Route::get('/', [ProviderBatchesController::class, 'index'])->name('provider-batches.index');
        Route::get('/details/{provider_id}', [ProviderBatchesController::class, 'details'])->name('provider-batches.details');
    });

    Route::resource('holydays', HolydayController::class);

    Route::resource('lots', LotController::class);

    Route::get('/lots/link-batch/{lot_id}', [LotController::class, 'linkBatch'])->name('lots.link-batch');

    Route::resource('/courses', CourseController::class);

    Route::resource('/class-documents', ClassDocumentController::class);

    Route::group(['controller' => ClassDocumentController::class, 'prefix' => 'schedule-class-documents', 'as' => 'schedule-class-documents.'], function () {
        Route::get('/{schedule_details_id}', 'scheduleDocument')->name('index');
        Route::get('/create/{schedule_details_id}', 'createDocument')->name('create');
    });

    Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index'])->name('logs');
    Route::resource('/training-provider-partners', TrainingProviderPartnerController::class);

    Route::resource('/tms-phase', TmsPhaseController::class);
    Route::get('/tms-phase/{id}/link-batch', [TmsPhaseController::class, 'linkBatch'])->name('tms-phase.link-batch');

    Route::resource('products', ProductController::class);
    Route::resource('product-combos', ProductComboController::class);

    Route::get('course-supplies/supply/{batch_id}', [CourseSuppliesController::class, 'supply'])->name('course-supplies.supply');
    Route::get('course-supplies/distribute/{batch_id}/{combo_id}', [CourseSuppliesController::class, 'distribute'])->name('course-supplies.distribute');
    Route::post('course-supplies/allocation', [CourseSuppliesController::class, 'allocation'])->name('course-supplies.allocation');
    Route::get('course-supplies/show/{batch_id}', [CourseSuppliesController::class, 'show'])->name('course-supplies.show');
    Route::get('course-supplies/distribute-list/{batch_id}/{combo_id}', [CourseSuppliesController::class, 'distributedList'])->name('course-supplies.distributed-list');
    Route::resource('roles', RoleController::class);

    Route::resource('payment-batches', PaymentBatchController::class);
    Route::group(['controller' => PaymentBatchController::class, 'prefix' => 'payment-batches', 'as' => 'payment-batches.'], function () {
        Route::get('/{batch_id}/batch', 'batchShow')->name('batch');
    });

    Route::group(['controller' => LaptopDistributionController::class, 'prefix' => 'laptop-distribution', 'as' => 'laptop-distribution.'], function () {
        Route::get('', 'index')->name('index');
        Route::get('/{batch_id}', 'create')->name('create');
        Route::get('/{id}/{batch_id}/show', 'show')->name('show');
        Route::post('', 'store')->name('store');
        Route::get('/{id}/{batch_id}/edit', 'edit')->name('edit');
        Route::put('/{id}', 'update')->name('update');
        Route::delete('/{id}', 'destroy')->name('destroy');
    });

    Route::resource('/exam-config', ExamConfigController::class);
    Route::get('/all-exam/{batch_id}/{training_id?}', [ExamConfigController::class, 'trainingExam'])->name('all-exam.training');

    Route::resource('/exam', ExamController::class)->except([
        'create',
        'destroy'
    ]);
    Route::delete('/exam/{batch_id}/{exam_config_id}/delete', [ExamController::class, 'destroy'])->name('exam.destroy');
    Route::get('/exam/{batch_id}/{exam_config_id}/create', [ExamController::class, 'create'])->name('exam.create');
    Route::get('/exam/result/{batch_id}/{ec_id}show', [ExamController::class, 'result'])->name('exam.result');

    // certificate

    Route::resource('certificates', CertificateController::class)->except([
        'create'
    ]);
    Route::get('certificates/{batch_id}/create', [CertificateController::class, 'create'])->name('certificates.create');
    Route::get('certificates/{batch_id}/print/eligible', [CertificateController::class, 'eligible'])->name('certificates.eligible');
    Route::get('certificates/print/pdf', [CertificateController::class, 'print'])->name('certificates.print');

    Route::get('training-batch/{batch_id}/inspection', [TmsInspectionController::class, 'batchWiseInspection'])->name('training-batch.inspections');

});


//evaluation
Route::resource('evaluation-head', EvaluationHeadController::class)->except('show');
Route::get('/evaluation/trainees/batch-list', [EvaluationController::class, 'batchList'])->name('evaluate.trainee.batch-list');
Route::get('/evaluation/trainees/{batch_id}/trainee-list', [EvaluationController::class, 'traineeList'])->name('evaluate.trainee.trainee-list');
Route::get('/evaluation/trainees/{training_applicant_id}/head', [EvaluationController::class, 'traineeEvaluationForm'])->name('evaluate.trainee.form');
Route::post('/evaluation/trainees/{training_applicant_id}/head', [EvaluationController::class, 'traineeEvaluationStore'])->name('evaluate.trainee.store');

Route::get('/evaluation/vendor/{training_batch_id}/head', [EvaluationController::class, 'vendorEvaluationForm'])->name('evaluate.vendor.form');
Route::post('/evaluation/vendor/{training_batch_id}/head', [EvaluationController::class, 'vendorEvaluationStore'])->name('evaluate.vendor.store');


Route::get('/evaluation/schedule-details', [EvaluationController::class, 'trainerScheduleDetailsList'])->name('trainer-schedule-details.lists');
Route::get('/evaluation/{scheduleDetailId}/student-list/', [EvaluationController::class, 'scheduleClassStudents'])->name('trainer-schedule-details.students');
Route::get('/evaluation/{classAttId}/student-info/', [EvaluationController::class, 'showStudentEvaluation'])->name('trainer-schedule-details.show-student-evaluation');
Route::post('/evaluation/{classAttId}/student-info/', [EvaluationController::class, 'storeStudentEvaluation'])->name('trainer-schedule-details.store-student-evaluation');
//evaluation end



Route::get('/attendance-report', [AttendanceRepoController::class, 'showAttendanceSheet'])->name('attendance.report');
Route::get('/generate-pdf', [AttendanceRepoController::class, 'generateAttendancePdf'])->name('generate-pdf');

// test without permission
Route::group(['controller' => SupportController::class, 'prefix' => 'support'], function () {
    Route::get('/all-batch', 'allBatch')->name('support.all-batch');
    Route::get('/class/{b_id}/{s_id}/miss', 'allScheduleDetails')->name('support.miss-class');
    Route::post('/attendance/start-all', 'startAll')->name('support.start-all');
    Route::get('/class/{b_id}/{s_id}/running', 'allStartDetails')->name('support.running-class');
    Route::post('/attendance/end-all', 'endAll')->name('support.end-all');
});

Route::resource('/tms-settings', TmsSettingController::class);

Route::get('/verify', [VerifyController::class, 'verify']);
Route::post('/verify', [VerifyController::class, 'getCerNo']);
Route::get('/verify/{id}', [VerifyController::class, 'search'])->name('search');

Route::get('batch-closing', [TmsBatchClosingController::class, 'create'])->name('batch-closing.close');
Route::post('batch-closing', [TmsBatchClosingController::class, 'close'])->name('batch-closing.store');

//Tariqul New
Route::get('certificate-config', [CertificateController::class, 'certificateConfig'])->name('certificate.config');
Route::post('certificate-config', [CertificateController::class, 'certificateConfigStore'])->name('certificate.config-store');


Route::get('trainees/export/{batch_id}', [TraineeEnrollmentController::class, 'export'])->name('trainees.export');