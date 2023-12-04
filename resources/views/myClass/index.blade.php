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
                        {{ __('my-class.my_class') }}</h1>
                    <!--end::Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('home.index') }}"
                                class="text-muted text-hover-primary">{{ __('division-list.home') }}</a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">{{ __('my-class.schedule_management') }}</li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href=""class="text-muted text-hover-primary"> {{ __('my-class.my_class') }}</a>
                        </li>
                        <!--end::Item-->
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
                <div class="card card-flush pb-0 bgi-position-y-center bgi-no-repeat mb-10">
                    <div class="card-header border-0 pt-6">
                        <!--begin::Card title-->
                        <div class="card-title">
                            <!--begin::Search-->
                            <div class="d-flex align-items-center position-relative my-1">
                                <h1 class="text-success"> {{ __('my-class.batch_class_name') }}</h1>

                            </div>
                            <!--end::Search-->
                        </div>
                        <!--begin::Card title-->
                        <!--begin::Card toolbar-->
                        <div class="card-toolbar">
                            <!--begin::Toolbar-->
                            <div class="d-flex justify-content-end px-3" data-kt-user-table-toolbar="base">
                                <!--begin::Add user-->
                                <a href="{{ Route('my-class.attendance', $scheduleId) }}" type="button"
                                    class="btn btn-primary" id="open-check-attendance">
                                    <i class="ki-duotone ki-check fs-2"></i>Check Attendance</a>
                                <!--end::Add user-->
                            </div>
                            <!--end::Toolbar-->
                        </div>
                        <!--end::Card toolbar-->
                    </div>
                    <!--begin::countdownlayout-->
                    <div class="card-body pt-5">
                        <div class="" id="class-content">

                        </div>
                    </div>
                    <!--end:countdown layout-->
                </div>
            </div>
            <!--end::Content container-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Content wrapper-->
@section('scripts')
    <script>
        let countdownTodayClass = " {{ __('my-class.countdown_today_class') }}";
        let countdownTodayClassHour = " {{ __('my-class.hours') }}";
        let countdownTodayClassMinute = " {{ __('my-class.minutes') }}";
        let countdownTodayClassSecound = " {{ __('my-class.seconds') }}";
        let classWillEnd = " {{ __('my-class.class_will_end') }}";
        $(document).ready(function() {
            let scheduleId = @json($scheduleId);

            const link = api_baseurl + "batch-schedule/" + scheduleId + "/myClass";
            $.ajax({
                type: "GET",
                url: link,
                headers: {
                    Authorization: localStorage.getItem("authToken"),
                },
                success: function(results) {
                    const classContent = $("#class-content");
                    console.log(results.data);
                    if (results.success) {

                    }

                    const checkTime = (i) => {
                        if (i < 10) {
                            i = "0" + i
                        }; // add zero in front of numbers < 10
                        return i;
                    }

                    const countdownCalc = (distance) => {
                        "use strict";

                        const second = 1000,
                            minute = second * 60,
                            hour = minute * 60;

                        let timeHours = checkTime(Math.floor(distance / (hour)));
                        let timeMinutes = checkTime(Math.floor((distance % (hour)) / (
                            minute)));
                        let timeSeconds = checkTime(Math.floor((distance % (minute)) /
                            second));

                        return {
                            hours: timeHours,
                            minutes: timeMinutes,
                            seconds: timeSeconds
                        }
                    }
                },
                error: function(xhr, status, error) {
                    // Handle errors here
                    console.error(xhr, status, error);
                },
            });
        });
    </script>
@endsection
@endsection
