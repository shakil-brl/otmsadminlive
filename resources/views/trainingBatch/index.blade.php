@extends('layouts.auth-master')
@section('content')
<!--begin::Content wrapper-->
<div class="d-flex flex-column flex-column-fluid">
    <!--begin::Toolbar-->
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <!--begin::Toolbar container-->
        <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
            <!--begin::Page title-->
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <!--begin::Title-->
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                    {{ __('trainer-enrollment-list.trainer_batch_link_list') }}</h1>
                <!--end::Title-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route('home.index') }}" class="text-muted text-hover-primary">{{
                            __('division-list.home') }}</a>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted"> {{ __('batch-schedule.enroll_management') }}</li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Items-->
                    <li class="breadcrumb-item text-muted">
                        <a href="" class="text-muted text-hover-primary">
                            {{ __('batch-schedule.batch_schedule') }}</a>
                    </li>
                    <!--end::Items-->
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
            <!--begin::Actions-->
            <div class="d-flex align-items-center gap-2 gap-lg-3">

            </div>
            <!--end::Actions-->
        </div>
        <!--end::Toolbar container-->
    </div>
    <!--end::Toolbar-->
    <!--begin::Content-->
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-xxl">
            @include('layouts.partials.messages')
            <!--begin::Card-->
            <div class="card">
                <!--begin::Card header-->
                <div class="card-header border-0 pt-6">
                    <!--begin::Card title-->
                    <div class="card-title">
                        <!--begin::Search-->
                        <div class="d-flex align-items-center position-relative my-1">
                            <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            <form action="">
                                <input type="text" data-kt-user-order-filter="search"
                                    class="form-control form-control-solid w-260px ps-13"
                                    placeholder=" {{ __('batch-schedule.search_batch_schedule') }}" name="search"
                                    value="{{ request('search') }}" />
                            </form>
                            {{-- <input type="text" data-kt-user-table-filter="search"
                                class="form-control form-control-solid w-250px ps-13" placeholder="Search user" /> --}}
                            <!--begin::Export buttons-->
                            <div id="kt_user_report_views_export" class="d-none"></div>
                            <!--end::Export buttons-->
                        </div>
                        <!--end::Search-->
                    </div>
                    <!--begin::Card title-->
                    <!--begin::Card toolbar-->
                    <div class="card-toolbar">
                        <!--begin::Export dropdown-->
                        <button type="button" class="btn btn-light-primary" data-kt-menu-trigger="click"
                            data-kt-menu-placement="bottom-end">
                            <i class="ki-duotone ki-exit-up fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>{{ __('division-list.export_report') }}</button>
                        <!--begin::Menu-->
                        <div id="kt_user_report_views_export_menu"
                            class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-200px py-4"
                            data-kt-menu="true">
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link px-3" data-kt-user-export="copy">{{
                                    __('division-list.copy_clipboard') }}</a>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link px-3" data-kt-user-export="excel">{{
                                    __('division-list.export_excel') }}</a>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link px-3" data-kt-user-export="csv">{{
                                    __('division-list.export_csv') }}</a>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link px-3" data-kt-user-export="pdf">{{
                                    __('division-list.export_pdf') }}</a>
                            </div>
                            <!--end::Menu item-->
                        </div>
                        <!--end::Menu-->
                        <!--begin::Toolbar-->
                        <div class="d-flex justify-content-end px-3" data-kt-user-table-toolbar="base">
                            <!--begin::Add Division-->
                            <a href="" type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#create_division">
                                <i class="ki-duotone ki-plus fs-2"></i>
                                {{ __('batch-schedule.add_batch_schedule') }}</a>
                            <!--end::Add Division-->
                        </div>
                        <!--end::Toolbar-->
                    </div>
                    <!--end::Card toolbar-->
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body py-4" id="batch-container">
                    <!--begin::Row-->
                    <div class="row g-6 g-xl-9" id="batch-items-row">
                    </div>
                    <!--end::Row-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->
        </div>
        <!--end::Content container-->
    </div>
    <!--end::Content-->
</div>
<!--End::Content wrapper-->

<!--begin::Modal - Create Batch Schedule-->
<div class="modal fade" id="kt_modal_traning_schedule" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-950px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Form-->
            <form class="form" action="" id="kt_modal_store_batch_schedule_form">
                <input type="hidden" name="training_batch_id">
                <input type="hidden" name="provider_id">
                <input type="hidden" name="training_id">
                <!--begin::Modal header-->
                <div class="modal-header" id="kt_modal_update_user_header">
                    <!--begin::Modal title-->
                    <h2 class="fw-bold">{{ __('batch-schedule.create_class_schedule') }}</h2>
                    <!--end::Modal title-->
                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                        <i class="ki-duotone ki-cross fs-1">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                    </div>
                    <!--end::Close-->
                </div>
                <!--end::Modal header-->
                <!--begin::Modal body-->
                <div class="modal-body py-10 px-lg-17">
                    <!--begin::Scroll-->
                    <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_update_user_scroll"
                        data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}"
                        data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_update_user_header"
                        data-kt-scroll-wrappers="#kt_modal_update_user_scroll" data-kt-scroll-offset="300px">
                        <!--begin::Address toggle-->
                        <div class="fw-bolder fs-3 rotate collapsible mb-7" data-bs-toggle="collapse"
                            href="#kt_modal_traning_schedule_time" role="button" aria-expanded="false"
                            aria-controls="kt_modal_course_location">{{ __('batch-schedule.class_schedule_time') }}
                            <span class="ms-2 rotate-180">
                                <i class="ki-duotone ki-down fs-3"></i>
                            </span>
                        </div>
                        <!--end::Address toggle-->
                        <!--begin::User form-->
                        <div id="kt_modal_traning_schedule_time" class="collapse show">
                            <!--begin::Input group-->
                            <div class="row g-9 mb-8">
                                <!-- begin:: Class Time Col -->
                                <div class="fv-row col-md-6">
                                    <label class="fs-6 fw-semibold mb-2">{{ __('batch-schedule.class_time') }}</label>
                                    <input name="class_time" class="form-control form-control-solid ps-12"
                                        placeholder="{{ __('batch-schedule.pick_class_time') }}" id="kt_datepicker_8" />
                                    <span class="text-danger form-message-error-class_time">

                                    </span>
                                </div>
                                <!--end: Class Time Col -->
                                <!-- begin:: Duration Col -->
                                <div class="col-md-6 fv-row">
                                    <label class="fs-6 fw-semibold mb-2">{{ __('batch-schedule.class_duration')
                                        }}</label>
                                    <input type="text" class="form-control form-control-solid"
                                        placeholder="{{ __('batch-schedule.class_duration_minute') }}"
                                        name="class_duration">
                                    <span class="form-message-error-class_duration">

                                    </span>
                                </div>
                                <!--end: Duration Col -->
                            </div>
                            <!--end::Input group-->
                        </div>
                        <!--End::User form-->
                        <!--begin::Days toggle-->
                        <div class="fw-bolder fs-3 rotate collapsible mb-3" data-bs-toggle="collapse"
                            href="#kt_modal_course_weekly_day" role="button" aria-expanded="false"
                            aria-controls="kt_modal_course_weekly_day">
                            {{ __('batch-schedule.weekly_class_schedule') }}
                            <span class="ms-2 rotate-180">
                                <i class="ki-duotone ki-down fs-3"></i>
                            </span>
                        </div>
                        <!--end::Days toggle-->
                        <!--begin::Input group-->
                        <div id="kt_modal_course_weekly_day" class="collapse show">
                            <!--begin::Input group-->
                            <div class="row">
                                <!--begin::Roles-->
                                <!--begin::Input row-->
                                <div class='separator separator-dashed my-3'></div>
                                <div class="fv-row col-md-2 my-2">
                                    <!--begin::Radio-->
                                    <div class="form-check form-check-custom form-check-solid">
                                        <!--begin::Input-->
                                        <input class="form-check-input me-3" name="saturday" type="checkbox"
                                            value="Saturday" id="kt_modal_update_role_option_0" />
                                        <!--end::Input-->
                                        <!--begin::Label-->
                                        <label class="form-check-label" for="kt_modal_update_role_option_0">
                                            <div class="fw-bold text-gray-900">
                                                {{ __('batch-schedule.weekly_day_sat') }}</div>
                                        </label>
                                        <!--end::Label-->
                                    </div>
                                    <!--end::Radio-->
                                </div>
                                <!--end::Input row-->
                                <!--begin::Input row-->
                                <div class="fv-row col-md-2 my-2">
                                    <!--begin::Radio-->
                                    <div class="form-check form-check-custom form-check-solid">
                                        <!--begin::Input-->
                                        <input class="form-check-input me-3" name="sunday" type="checkbox"
                                            value="Sunday" id="kt_modal_update_role_option_1" />
                                        <!--end::Input-->
                                        <!--begin::Label-->
                                        <label class="form-check-label" for="kt_modal_update_role_option_1">
                                            <div class="fw-bold text-gray-800">
                                                {{ __('batch-schedule.weekly_day_sun') }}</div>
                                        </label>
                                        <!--end::Label-->
                                    </div>
                                    <!--end::Radio-->
                                </div>
                                <!--end::Input row-->
                                <!--begin::Input row-->
                                <div class="fv-row col-md-2 my-2">
                                    <!--begin::Radio-->
                                    <div class="form-check form-check-custom form-check-solid">
                                        <!--begin::Input-->
                                        <input class="form-check-input me-3" name="monday" type="checkbox"
                                            value="Monday" id="kt_modal_update_role_option_1" />
                                        <!--end::Input-->
                                        <!--begin::Label-->
                                        <label class="form-check-label" for="kt_modal_update_role_option_1">
                                            <div class="fw-bold text-gray-800">
                                                {{ __('batch-schedule.weekly_day_mon') }}</div>
                                        </label>
                                        <!--end::Label-->
                                    </div>
                                    <!--end::Radio-->
                                </div>
                                <!--end::Input row-->
                                <!--begin::Input row-->
                                <div class="fv-row col-md-2 my-2">
                                    <!--begin::Radio-->
                                    <div class="form-check form-check-custom form-check-solid">
                                        <!--begin::Input-->
                                        <input class="form-check-input me-3" name="tuesday" type="checkbox"
                                            value="Tuesday" id="kt_modal_update_role_option_1" />
                                        <!--end::Input-->
                                        <!--begin::Label-->
                                        <label class="form-check-label" for="kt_modal_update_role_option_1">
                                            <div class="fw-bold text-gray-800">
                                                {{ __('batch-schedule.weekly_day_tue') }}</div>
                                        </label>
                                        <!--end::Label-->
                                    </div>
                                    <!--end::Radio-->
                                </div>
                                <!--end::Input row-->
                                <!--begin::Input row-->
                                <div class="fv-row col-md-2 my-2">
                                    <!--begin::Radio-->
                                    <div class="form-check form-check-custom form-check-solid">
                                        <!--begin::Input-->
                                        <input class="form-check-input me-3" name="wednesday" type="checkbox"
                                            value="Wednesday" id="kt_modal_update_role_option_1" />
                                        <!--end::Input-->
                                        <!--begin::Label-->
                                        <label class="form-check-label" for="kt_modal_update_role_option_1">
                                            <div class="fw-bold text-gray-800">
                                                {{ __('batch-schedule.weekly_day_wed') }}</div>
                                        </label>
                                        <!--end::Label-->
                                    </div>
                                    <!--end::Radio-->
                                </div>
                                <!--end::Input row-->
                                <!--begin::Input row-->
                                <div class="fv-row col-md-2 my-2">
                                    <!--begin::Radio-->
                                    <div class="form-check form-check-custom form-check-solid">
                                        <!--begin::Input-->
                                        <input class="form-check-input me-3" name="thursday" type="checkbox"
                                            value="Thursday" id="kt_modal_update_role_option_1" />
                                        <!--end::Input-->
                                        <!--begin::Label-->
                                        <label class="form-check-label" for="kt_modal_update_role_option_1">
                                            <div class="fw-bold text-gray-800">
                                                {{ __('batch-schedule.weekly_day_thu') }}</div>
                                        </label>
                                        <!--end::Label-->
                                    </div>
                                    <!--end::Radio-->
                                </div>
                                <!--end::Input row-->
                                <!--begin::Input row-->
                                <div class="fv-row col-md-2 my-2">
                                    <!--begin::Radio-->
                                    <div class="form-check form-check-custom form-check-solid">
                                        <!--begin::Input-->
                                        <input class="form-check-input me-3" name="friday" type="checkbox"
                                            value="Friday" id="kt_modal_update_role_option_1" />
                                        <!--end::Input-->
                                        <!--begin::Label-->
                                        <label class="form-check-label" for="kt_modal_update_role_option_1">
                                            <div class="fw-bold text-gray-800">
                                                {{ __('batch-schedule.weekly_day_fri') }}</div>
                                        </label>
                                        <!--end::Label-->
                                    </div>
                                    <!--end::Radio-->
                                </div>
                                <!--end::Input row-->
                                <div class='separator separator-dashed my-2'></div>
                            </div>
                            <!--end::Roles-->
                            <span class="text-danger form-message-error-class_days">

                            </span>
                        </div>
                        <!--end::Input group-->
                    </div>
                    <!--end::Scroll-->
                </div>
                <!--end::Modal body-->
                <!--begin::Modal footer-->
                <div class="modal-footer flex-center">
                    <!--begin::Button-->
                    <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">{{
                        __('batch-schedule.discard') }}</button>
                    <!--end::Button-->
                    <!--begin::Button-->
                    <button type="submit" id="addCourseScheduleBtn" class="btn btn-primary"
                        data-kt-users-modal-action="submit">
                        <span class="indicator-label">{{ __('batch-schedule.submit') }}</span>
                        <span class="indicator-progress">Please wait...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                    <!--end::Button-->
                </div>
                <!--end::Modal footer-->
            </form>
            <!--end::Form-->
        </div>
    </div>
</div>
<!--end::Modal - Create Batch Schedule-->
<!--begin::Modal - link trainers-->
<div class="modal fade" id="link_trainers_batches" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-950px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <div class="modal-header" id="kt_modal_update_trainer_header">
                <!--begin::Modal title-->
                <h2 class="fw-bold">{{ __('batch-schedule.tariner_link_batch') }}</h2>
                <!--end::Modal title-->
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                    <i class="ki-duotone ki-cross fs-1">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                </div>
                <!--end::Close-->
            </div>
            <!--begin::Provider added Form-->
            <form id="link_trainers_form" method="post" class="form m-7" action="">
                @csrf
                <!--begin::Scroll-->
                <div class="d-flex flex-column scroll-y me-n7 pe-7">
                    <input type="hidden" name="batch-id">
                    <input type="hidden" name="provider-id">
                    <!--start::Input group-->
                    <div class="fv-row mb-7">
                        <label class="col-form-label text-right col-lg-3 col-sm-12">{{ __('batch-schedule.triner_list')
                            }}</label>
                        <div class="col">
                            <select class="form-control select2" id="kt_select2_3" multiple="multiple">

                            </select>
                            <span class="form-message-error-trainer_ids">

                            </span>
                        </div>
                    </div>
                    <!--end::Input group-->
                    <div class='separator separator-dashed my-2'></div>
                </div>
                <!--end::Scroll-->
                <!--begin::Actions-->
                <div class="text-center pt-15">
                    <a href="#" type="reset" data-bs-dismiss="modal" class="btn btn-light me-3"
                        data-kt-users-modal-action="cancel">{{ __('provider-list.discard') }}</a>
                    <button type="submit" class="btn btn-primary">
                        <span class="indicator-label">{{ __('provider-list.submit') }}</span>
                        <span class="indicator-progress">Please wait...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                </div>
                <!--end::Actions-->
            </form>
            <!--Provider added end::Form-->
        </div>
    </div>
</div>
<!--end::Modal - link trainers-->
<!--begin::Modal - link coordinator-->
<div class="modal fade" id="link_coordinator_batch" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-950px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <div class="modal-header" id="kt_modal_update_trainer_header">
                <!--begin::Modal title-->
                <h2 class="fw-bold">{{ __('batch-schedule.tariner_link_batch') }}</h2>
                <!--end::Modal title-->
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                    <i class="ki-duotone ki-cross fs-1">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                </div>
                <!--end::Close-->
            </div>
            <!--begin::Provider added Form-->
            <form id="link_coordinator_form" method="post" class="form m-7" action="">
                @csrf
                <!--begin::Scroll-->
                <div class="d-flex flex-column scroll-y me-n7 pe-7">
                    <input type="hidden" name="batch-id">
                    <input type="hidden" name="provider-id">
                    <!--start::Input group-->
                    <div class="fv-row mb-7">
                        <label class="col-form-label text-right col-lg-3 col-sm-12">{{ __('batch-schedule.triner_list')
                            }}</label>
                        <div class="col">
                            <select class="form-control select2" id="kt_select2_3" multiple="multiple">

                            </select>
                            <span class="form-message-error-trainer_ids">

                            </span>
                        </div>
                    </div>
                    <!--end::Input group-->
                    <div class='separator separator-dashed my-2'></div>
                </div>
                <!--end::Scroll-->
                <!--begin::Actions-->
                <div class="text-center pt-15">
                    <a href="#" type="reset" data-bs-dismiss="modal" class="btn btn-light me-3"
                        data-kt-users-modal-action="cancel">{{ __('provider-list.discard') }}</a>
                    <button type="submit" class="btn btn-primary">
                        <span class="indicator-label">{{ __('provider-list.submit') }}</span>
                        <span class="indicator-progress">Please wait...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                </div>
                <!--end::Actions-->
            </form>
            <!--Provider added end::Form-->
        </div>
    </div>
</div>
<!--end::Modal - link trainers-->
@section('scripts')
<!--begin::Custom Javascript(used for this page only)-->
<script src="{{ asset('assets/dist/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
<script src="{{ asset('assets/dist/assets/js/custom/apps/user-management/users/list/export-users.js') }}"></script>
<script src="{{ asset('assets/dist/assets/js/custom/pages/user/general.js') }}"></script>
<script src="{{ asset('assets/dist/assets/js/custom/call.training.schedule.api.js') }}"></script>
<script src="{{ asset('assets/dist/assets/js/custom/call.trainer.api.js') }}"></script>
<script>
    let batchContainer = $("#batch-container");
        let batchItemsRow = $("#batch-items-row");
        let training = " {{ __('batch-schedule.training') }}";
        let trainingLocation = " {{ __('batch-schedule.training_location') }}";
        let trainingVanue = " {{ __('batch-schedule.training_vanue') }}";
        let totalTrainees = " {{ __('batch-schedule.total_trainee') }}";
        let startDates = " {{ __('batch-schedule.start_date') }}";
        let trainingDuration = " {{ __('batch-schedule.tarining_duration') }}";
        let trainingClassTime = " {{ __('batch-schedule.tarining_class_time') }}";
        let classDaySat = " {{ __('batch-schedule.class_day_sat') }}";
        let classDaySun = " {{ __('batch-schedule.class_day_sun') }}";
        let classDayMon = " {{ __('batch-schedule.class_day_mon') }}";
        let classDayTue = " {{ __('batch-schedule.class_day_tue') }}";
        let classDayWed = " {{ __('batch-schedule.class_day_wed') }}";
        let classDayThu = " {{ __('batch-schedule.class_day_thu') }}";
        let classDayFri = " {{ __('batch-schedule.class_day_fri') }}";
        let classHour = " {{ __('batch-schedule.hour') }}";
        let notDefined = " {{ __('batch-schedule.not_defined') }}";
        let createSchedule = " {{ __('batch-schedule.create_schedule') }}";
        let linkTrainerWithBatch = " {{ __('batch-schedule.link_trainer') }}";
        let joinClasses = " {{ __('batch-schedule.join_class') }}";

        $(document).ready(function() {
            const link = `${api_baseurl}batches/provider`; // Use template literals here
            // console.log(link);
            axios
                .get(link, {
                    headers: {
                        Authorization: authToken,
                    },
                })
                .then((response) => {
                    // Handle the successful response here
                    // console.log(response.data.data);
                    let allBatches = response.data.data;
                    // console.log(allBatches);
                    sessionStorage.removeItem('message');
                    if (allBatches.length > 0) {
                        $.each(allBatches, function(index, batch) {
                            let classDays = batch.training_batch_schedule ? batch
                                .training_batch_schedule.class_days : '';
                            let traningBatchScheduleId = batch.training_batch_schedule ? batch
                                .training_batch_schedule.id : '';
                            let classRouteLink = null;
                            let todayIsClassDay = null;

                            if (classDays) {
                                const currentDay = new Date().getDay();

                                // array of week day names 
                                const dayNames = ['Sunday', 'Monday', 'Tuesday', 'Wednesday',
                                    'Thursday',
                                    'Friday', 'Saturday'
                                ];

                                // Check if the current day matches any of the class days
                                const classDaysArray = classDays.split(',');
                                todayIsClassDay = classDaysArray.includes(dayNames[currentDay]);

                                if (todayIsClassDay) {
                                    if (traningBatchScheduleId) {
                                        classRouteLink = "{{ route('my-class.index', ':id') }}"
                                            .replace(':id',
                                                traningBatchScheduleId);
                                        // console.log(classRouteLink);
                                    }
                                }
                            }

                            let batchItem = `                            
                                <!--begin::Col-->
                                <div class="col-md-6 col-xxl-4">
                                    <!--begin::Card-->
                                    <div class="card">
                                        <!--begin::Card body-->
                                        <div class="card-body d-flex flex-center flex-column pt-12 p-9 bg-gray-100">
                                            <!--begin::Name-->
                                            <a href="#" class="fs-4 text-gray-800 text-hover-primary fw-bold mb-0">
                                                ${batch.batchCode ?? ''}
                                            </a>
                                            <!--end::Name-->
                                            <!--begin::Position-->
                                            <div class="fw-semibold text-gray-600 mb-6 text-center">
                                                <div class="d-flex align-item-center justify-content-center gap-1">
                                                    <span class="text-gray-700">${training}- </span>                                                    
                                                    <span>
                                                        ${batch.training ? (batch.training.training_title ? batch.training.training_title.Name : '') : ''}
                                                    </span>
                                                </div>
                                                <div class="d-flex align-item-center justify-content-center gap-1">
                                                    <span class="text-gray-700">${trainingLocation} - </span>                                                    
                                                    <span>
                                                        ${batch.GEOLocation ?? ''}
                                                    </span>
                                                </div>
                                                <div class="d-flex align-item-center justify-content-center gap-1">
                                                    <span class="text-gray-700">${trainingVanue}-</span>                                                    
                                                    <span>
                                                        ${batch.TrainingVenue ?? ''}    
                                                    </span>
                                                </div>                                                
                                                <div class="d-flex align-item-center justify-content-center gap-1">
                                                    <span class="text-gray-700">${totalTrainees} - </span>                                                    
                                                    <span>
                                                        ${batch.totalTrainees ?? ''}    
                                                    </span>
                                                </div>                                              
                                            </div>
                                            <!--end::Position-->
                                            <!--begin::day-->
                                            <div class="symbol-group symbol-hover my-2">
                                                <div class="symbol symbol-45px symbol-circle" data-bs-toggle="tooltip"
                                                    title="Saturday">
                                                    ${classDays.includes("Saturday") ? 
                                                        '<span class="symbol-label bg-success text-inverse-success fw-bold">'+ classDaySat +'</span>' :
                                                        '<span class="symbol-label text-inverse-success fw-bold">'+ classDaySat +'</span>'
                                                    }  
                                                </div>

                                                <div class="symbol symbol-45px symbol-circle" data-bs-toggle="tooltip"
                                                    title="Sunday">
                                                    ${classDays.includes("Sunday") ? 
                                                        '<span class="symbol-label bg-info text-inverse-success fw-bold">'+ classDaySun +'</span>' :
                                                        '<span class="symbol-label text-inverse-success fw-bold">'+ classDaySun +'</span>'
                                                    } 
                                                </div>
                                                <div class="symbol symbol-45px symbol-circle" data-bs-toggle="tooltip"
                                                    title="Monday">
                                                    ${classDays.includes("Monday") ? 
                                                        '<span class="symbol-label bg-primary text-inverse-primary fw-bold">'+ classDayMon +'</span>' :
                                                        '<span class="symbol-label text-inverse-primary fw-bold">'+ classDayMon +'</span>'
                                                    }
                                                </div>
                                                <div class="symbol symbol-45px symbol-circle" data-bs-toggle="tooltip"
                                                    title="Tuesday">
                                                    ${classDays.includes("Tuesday") ?
                                                        '<span class="symbol-label bg-danger text-inverse-primary fw-bold">'+ classDayTue +'</span>' :
                                                        '<span class="symbol-label text-inverse-primary fw-bold">'+ classDayTue +'</span>'
                                                    }
                                                </div>
                                                <div class="symbol symbol-45px symbol-circle" data-bs-toggle="tooltip"
                                                    title="Wednesday">
                                                    ${classDays.includes("Wednesday") ?
                                                        '<span class="symbol-label text-inverse-primary fw-bold" style="background:#8666e0">'+ classDayWed +'</span>' :
                                                        '<span class="symbol-label text-inverse-primary fw-bold">'+ classDayWed +'</span>'
                                                    }
                                                </div>
                                                <div class="symbol symbol-45px symbol-circle" data-bs-toggle="tooltip"
                                                    title="Thursday">
                                                    ${classDays.includes("Thursday") ?
                                                        '<span class="symbol-label text-inverse-primary fw-bold" style="background:#d4e066">'+ classDayThu +'</span>' :
                                                        '<span class="symbol-label text-inverse-primary fw-bold">'+ classDayThu +'</span>'
                                                    }

                                                </div>
                                                <div class="symbol symbol-45px symbol-circle" data-bs-toggle="tooltip"
                                                    title="Friday">
                                                    ${classDays.includes("Friday") ?
                                                        '<span class="symbol-label text-inverse-primary fw-bold" style="background:#e066ad">'+ classDayFri+'</span>' :
                                                        '<span class="symbol-label text-inverse-primary fw-bold">'+ classDayFri +'</span>'
                                                    }

                                                </div>
                                            </div>
                                            <!--end::day-->
                                            <!--begin::Info-->
                                            <div class="d-flex flex-center flex-wrap">
                                                <!--begin::Stats-->
                                                <div
                                                    class="border border-gray-300 border-dashed rounded min-w-80px py-3 px-4 mx-2 mb-3">
                                                    <div class="fs-6 fw-bold text-gray-700">
                                                        ${batch.startDate ? extractDatePart(batch.startDate) : notDefined}                                                        
                                                    </div>
                                                    <div class="fw-semibold text-gray-400">${startDate}</div>
                                                </div>
                                                <!--end::Stats-->
                                                <!--begin::Stats-->
                                                <div
                                                    class="border border-gray-300 border-dashed rounded min-w-80px py-3 px-4 mx-2 mb-3">
                                                    <div class="fs-6 fw-bold text-gray-700">${batch.duration ?? ""} ${classHour}</div>
                                                    <div class="fw-semibold text-gray-400">${trainingDuration}</div>
                                                </div>
                                                <!--end::Stats-->
                                                <!--begin::Stats-->
                                                <div
                                                    class="border border-gray-300 border-dashed rounded min-w-80px py-3 px-4 mx-2 mb-3">
                                                    <div class="fs-6 fw-bold text-gray-700">
                                                        ${batch.training_batch_schedule ? batch.training_batch_schedule.class_time : notDefined}
                                                    </div>
                                                    <div class="fw-semibold text-gray-400">${trainingClassTime}</div>
                                                </div>
                                                <!--end::Stats-->
                                            </div>
                                            <!--end::Info-->
                                            <!--begin::Actions-->
                                            <div class="d-flex flex-center flex-wrap gap-2 mb-2">
                                                <a href="#" id="link-trainer-with-batches-modal" data-batch-id="${batch.id}" data-provider-id="${batch.provider_id}" class="btn btn-sm fw-bold btn-success" data-bs-toggle="modal"data-bs-target="#link_trainers_batches">${linkTrainerWithBatch}</a>         
                                            </div>
                                            <!--end::Actions-->
                                        </div>
                                        <!--end::Card body-->
                                    </div>
                                    <!--end::Card-->
                                </div>
                                <!--end::Col-->                        
                            `;

                            batchItemsRow.append(batchItem);
                        });
                    } else {
                        batchItemsRow.innerHTML = `
                            <div class="col">
                                No Batch Found 
                            </div>                            
                        `;
                    }
                })
                .catch((error) => {
                    // Handle errors here
                    console.error(error);
                });

            // select all batches
            $('[name="all-batch"]').on('click', function() {
                if ($(this).is(':checked')) {
                    $.each($('.batch-item'), function() {
                        $(this).prop('checked', true);
                    });
                } else {
                    $.each($('.batch-item'), function() {
                        $(this).prop('checked', false);
                    });
                }
            });

            // create batch schedule modal action
            $(document).on('click', '.create-schedule-btn', function(e) {
                e.preventDefault();
                let link = api_baseurl + "batch-schedule/create";
                permissionRole(link);
                let batchId = $(this).data('batch-id');
                let providerId = $(this).data('provider-id');
                let trainingId = $(this).data('training-id');
                $("#kt_modal_store_batch_schedule_form [name=training_batch_id]").val(batchId);
                $("#kt_modal_store_batch_schedule_form [name=provider_id]").val(providerId);
                $("#kt_modal_store_batch_schedule_form [name=training_id]").val(trainingId);
            });

            // link coordinator with batch modal open
            $(document).on(
                "click",
                "#link-coordinator-with-batch-modal",
                function(e) {
                    // search load data
                    let provider_id = $(this).attr("data-provider-id");
                    let id = $(this).attr("data-batch-id");
                    const api_link = api_baseurl + "coordinators/linkBatch/" + id;
                    coordinatorSelector = $("#link_coordinator_form #kt_select2_4");
                    $("#link_coordinator_form [name=batch-id]").val(id);
                    $("#link_coordinator_form [name=provider-id]").val(provider_id);
                    populateCoordinatorOption(api_link, authToken, coordinatorSelector);
                }
            );
        });
</script>
@endsection
@endsection