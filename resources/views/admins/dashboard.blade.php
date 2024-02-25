<!doctype html>
<html lang="en">
<!--begin::Head-->

<head>
    <title>Training Management System</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    {{--
    <link rel="shortcut icon" href="{{ asset('assets/media/logos/favicon.ico') }}" /> --}}
    <link rel="shortcut icon" href="{{ asset('img/logo-icon.svg') }}" type="image/x-icon">





    <link rel="stylesheet" href="{{ asset('assets/dist/assets/plugins/global/plugins.bundle.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/dist/assets/css/style.bundle.css') }}">

    <link rel="stylesheet" href="{{ asset('css/dashboard/dashboard.css?v=1') }}">
    <link rel="stylesheet" href="{{ asset('css/new_dashboard/dashboard.css?v=1') }}">
    {{-- <script src="https://cdn.ckeditor.com/ckeditor5/40.2.0/classic/ckeditor.js"></script> --}}

</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_app_body" data-kt-app-layout="dark-sidebar" data-kt-app-header-fixed="true"
    data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-hoverable="true"
    data-kt-app-sidebar-push-header="true" data-kt-app-sidebar-push-toolbar="true"
    data-kt-app-sidebar-push-footer="true" data-kt-app-toolbar-enabled="true" class="app-default">

    <div id="preloader">
        <div class="loader"></div>
    </div>

    <div class="d-flex flex-column flex-root app-root" id="kt_app_root">
        <!--begin::Page-->
        <div class="app-page flex-column flex-column-fluid" id="kt_app_page">
            <!--begin::Header-->
            @include('auth.partials.header')
            <!--end::Header-->
            <!--begin::Wrapper-->
            <div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
                <!--begin::Sidebar-->
                @include('auth.partials.sidebar')
                <!--end::Sidebar-->
                <!--begin::Main-->
                <div class="app-main flex-column flex-row-fluid" id="kt_app_main">

                    <div class="d-flex flex-column flex-column-fluid">

                        <div class="m-5">
                            <div id="main-content bg-warning">
                                <div class="page-content" style="background-color: transparent;">
                                    <div class="m-4">
                                        <div class="row g-4 row-cols-3 cards" id="dashboard-card">
                                            @if (in_array('dashboard_details.total_batches', $roleRoutePermissions))
                                            <div>
                                                {{-- $data['total_batch'] ?? 0 --}}
                                                <x-dashboard-card :url="route('dashboard_details.total_batches')"
                                                    :totalBatch="$data['total_batch'] ?? 0"
                                                    :icon="asset('img/new_icon/total_batch.png')"
                                                    :title="__('dashboard.total_batch')"
                                                    :class="'card-item purple show-loader'" />
                                            </div>
                                            @endif

                                            @if (in_array('dashboard_details.running_batches', $roleRoutePermissions))
                                            <div>
                                                <x-dashboard-card
                                                    :url="route('dashboard_details.total_batches', ['batch_status' => 1])"
                                                    :totalBatch="$data['running_batch'] ?? 0"
                                                    :icon="asset('img/new_icon/current_batch.png')"
                                                    :title="__('dashboard.running_batch')"
                                                    :class="'card-item yellow show-loader'" />
                                            </div>
                                            @endif

                                            @if (in_array('dashboard_details.complete_batches', $roleRoutePermissions))
                                            <div>
                                                <x-dashboard-card
                                                    :url="route('dashboard_details.total_batches', ['batch_status' => 2])"
                                                    :totalBatch="$data['completed_batch']"
                                                    :icon="asset('img/new_icon/completed_batch.png')"
                                                    :title="__('dashboard.complete_batch')"
                                                    :class="'card-item green show-loader'" />
                                            </div>
                                            @endif

                                            @if (in_array('dashboard_details.ongoing_classes', $roleRoutePermissions))
                                            <div>
                                                <x-dashboard-card :url="route('dashboard_details.ongoing_classes')"
                                                    :totalBatch="collect($data['running_class'])
                                    ->where('status', 2)
                                    ->first()['total'] ?? 0" :icon="asset('img/new_icon/livestrem.gif')"
                                                    :title="__('dashboard.ongoing_class')"
                                                    :class="'card-item red show-loader'" />
                                            </div>
                                            @endif
                                            @if (in_array('dashboard_details.complete_classes', $roleRoutePermissions))
                                            <div>
                                                <x-dashboard-card
                                                    :url="route('dashboard_details.ongoing_classes', ['status' => 3])"
                                                    :totalBatch="$data['complete_class'] ?? 0"
                                                    :icon="asset('img/new_icon/completedclass.png')"
                                                    :title="__('dashboard.complete_class')"
                                                    :class="'card-item purple show-loader'" />
                                            </div>
                                            @endif
                                            @if (in_array('dashboard_details.districts', $roleRoutePermissions))
                                            <div>
                                                <x-dashboard-card :url="route('dashboard_details.districts')"
                                                    :totalBatch="$data['total_district'] ?? 0"
                                                    :icon="asset('img/new_icon/district.png')"
                                                    :title="__('dashboard.district')"
                                                    :class="'card-item green-white show-loader'" />
                                            </div>
                                            @endif

                                            @if (in_array('dashboard_details.upazilas', $roleRoutePermissions))
                                            <div>
                                                <x-dashboard-card :url="route('dashboard_details.upazilas')"
                                                    :totalBatch="$data['total_upazila'] ?? 0"
                                                    :icon="asset('img/new_icon/upazila.png')"
                                                    :title="__('dashboard.upazila')"
                                                    :class="'card-item info show-loader'" />
                                            </div>
                                            @endif
                                            @if (in_array('dashboard_details.partners', $roleRoutePermissions))
                                            <div>
                                                {{-- $data['total_vendor'] --}}
                                                <x-dashboard-card :url="route('dashboard_details.partners')"
                                                    :totalBatch="$data['total_vendor'] ?? 0"
                                                    :icon="asset('img/new_icon/developmentpartner.png')"
                                                    :title="__('dashboard.partner')" :class="'card-item red'" />
                                            </div>
                                            @endif
                                            @if (in_array('dashboard_details.partners', $roleRoutePermissions))
                                            <div>
                                                <x-dashboard-card :url="route('dashboard_details.partners')"
                                                    :totalBatch="$total_ongoing ?? 0"
                                                    :icon="asset('img/new_icon/developmentpartner.png')"
                                                    :title="__('dashboard.todays_class')"
                                                    :class="'card-item red show-loader'" />
                                            </div>
                                            @endif
                                        </div>
                                        @php
                                        $permissionsToCheck = ['dashboard.total_present',
                                        'dashboard.average_attendance', 'dashboard.dropout_trainee'];

                                        $commonPermissions = array_intersect($permissionsToCheck,
                                        $roleRoutePermissions);
                                        @endphp
                                        @if (!empty($commonPermissions))
                                        <div id="dashboard-attendance">
                                            <div class="row align-items-stretch">
                                                <div class="col-7">
                                                    <div id="attendance-summery">
                                                        <div class="header">
                                                            <div class="left menu">
                                                                <a class="link active" href="#">{{
                                                                    __('dashboard.todays') }}</a>
                                                                <a class="link" href="#">{{ __('dashboard.weekly')
                                                                    }}</a>
                                                                <a class="link" href="#">{{ __('dashboard.monthly')
                                                                    }}</a>
                                                            </div>
                                                            <div class="right menu">
                                                                <a class="link" href="#">{{ __('dashboard.details')
                                                                    }}</a>
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <div class="content">
                                                                <div class="icon">
                                                                    <img src="{{ asset('img/new_icon') }}/attendance.png"
                                                                        alt="">
                                                                </div>
                                                                <div class="attendance">
                                                                    <div class="items">
                                                                        @if (in_array('dashboard.total_present',
                                                                        $roleRoutePermissions))
                                                                        <div class="item">
                                                                            <div class="digit">
                                                                                {{ isset($data['total_attend_today']) ?
                                                                                digitLocale($data['total_attend_today'])
                                                                                : digitLocale(0) }}
                                                                            </div>
                                                                            <div class="label">{{
                                                                                __('dashboard.total_present') }}
                                                                            </div>
                                                                        </div>
                                                                        @endif
                                                                        <div class="item">
                                                                            {{-- <div class="digit">66%</div>
                                                                            <div class="label">{{
                                                                                __('dashboard.percentage_attendance') }}
                                                                            </div> --}}
                                                                        </div>
                                                                    </div>
                                                                    <div class="items">
                                                                        @if (in_array('dashboard.average_attendance',
                                                                        $roleRoutePermissions))
                                                                        <div class="item">
                                                                            <div class="digit">
                                                                                {{ isset($data['total_trainee']) ?
                                                                                digitLocale($data['total_trainee']) :
                                                                                digitLocale(0) }}
                                                                            </div>
                                                                            <div class="label">{{
                                                                                __('dashboard.average_attendance') }}
                                                                            </div>
                                                                        </div>
                                                                        @endif
                                                                        @if (in_array('dashboard.dropout_trainee',
                                                                        $roleRoutePermissions))
                                                                        <div class="item">
                                                                            <div class="digit">
                                                                                {{ isset($data['total_dropout']) ?
                                                                                digitLocale($data['total_dropout']) :
                                                                                digitLocale(0) }}
                                                                            </div>
                                                                            <div class="label">{{
                                                                                __('dashboard.dropout_trainee') }}
                                                                            </div>
                                                                        </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-5">
                                                    <div id="attendance-chart" class="h-100 d-none">
                                                        <div class="chart-item">
                                                            <div class="bar" style="height: 70%;">
                                                                {{-- <span class="bar-text">75%</span> --}}
                                                            </div>
                                                            <div class="label">{{ __('dashboard.class_day_sat') }}</div>
                                                        </div>
                                                        <div class="chart-item">
                                                            <div class="bar danger" style="height: 0%;">
                                                                {{-- <span class="bar-text">25%</span> --}}
                                                            </div>
                                                            {{-- <div class="label">{{ __('dashboard.class_day_sun') }}
                                                            </div> --}}
                                                        </div>
                                                        <div class="chart-item">
                                                            <div class="bar" style="height: 95%;">
                                                                <span class="bar-text">100%</span>
                                                            </div>
                                                            <div class="label">{{ __('dashboard.class_day_mon') }}</div>
                                                        </div>
                                                        <div class="chart-item">
                                                            <div class="bar" style="height: 35%;">
                                                                <span class="bar-text">35%</span>
                                                            </div>
                                                            <div class="label">{{ __('dashboard.class_day_tue') }}</div>
                                                        </div>
                                                        <div class="chart-item">
                                                            <div class="bar" style="height: 90%;">
                                                                <span class="bar-text">100%</span>
                                                            </div>
                                                            <div class="label">{{ __('dashboard.class_day_wed') }}</div>
                                                        </div>
                                                        <div class="chart-item">
                                                            <div class="bar" style="height: 50%;">
                                                                <span class="bar-text">55%</span>
                                                            </div>
                                                            <div class="label">{{ __('dashboard.class_day_thu') }}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif

                                        <div id="allownce">
                                            <div class="row  align-items-stretch">
                                                @php
                                                $permissionsToCheck = ['dashboard_details.trainers',
                                                'traineeEnroll.index'];

                                                $commonPermissions = array_intersect($permissionsToCheck,
                                                $roleRoutePermissions);
                                                @endphp
                                                @if (!empty($commonPermissions))
                                                <div class="col-7">
                                                    @if (in_array('dashboard_details.trainers', $roleRoutePermissions))
                                                    <a href="{{ route('dashboard_details.trainers') }}">
                                                        <div class="trainer-info">
                                                            <div id="attendance-summery">
                                                                <div>
                                                                    <div class="content">
                                                                        <div class="icon">
                                                                            <img src="{{ asset('img/new_icon') }}/trainer.png"
                                                                                alt="">
                                                                        </div>
                                                                        <div class="attendance">
                                                                            <div class="items">
                                                                                <div class="item">
                                                                                    <div class="digit">

                                                                                        {{ isset($data['total_trainer'])
                                                                                        ?
                                                                                        digitLocale($data['total_trainer'])
                                                                                        : digitLocale(0) }}
                                                                                    </div>
                                                                                    <div class="label">
                                                                                        {{ __('dashboard.total_trainer')
                                                                                        }}
                                                                                    </div>
                                                                                </div>
                                                                                <div class="item">
                                                                                    <div class="digit"></div>
                                                                                    <div class="label">
                                                                                        {{-- {{
                                                                                        __('dashboard.top_trainer') }}
                                                                                        --}}
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="items">
                                                                                {{-- <div class="item">
                                                                                    <div class="digit">20000</div>
                                                                                    <div class="label">
                                                                                        {{
                                                                                        __('dashboard.reserve_trainer')
                                                                                        }}
                                                                                    </div>
                                                                                </div> --}}
                                                                                {{-- <div class="item">
                                                                                    <div class="digit">7</div>
                                                                                    <div class="label">{{
                                                                                        __('dashboard.lack_trainer') }}
                                                                                    </div>
                                                                                </div> --}}
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                    @endif
                                                    @if (in_array('traineeEnroll.index', $roleRoutePermissions))
                                                    <a href="{{ route('traineeEnroll.index') }}">
                                                        <div class="student-info">
                                                            <div id="attendance-summery">
                                                                <div>
                                                                    <div class="content">
                                                                        <div class="icon">
                                                                            <img src="{{ asset('img/new_icon') }}/student_info.png"
                                                                                alt="">
                                                                        </div>
                                                                        <div class="attendance">
                                                                            <div class="items">
                                                                                <div class="item">
                                                                                    <div class="digit">
                                                                                        {{ isset($data['total_trainee'])
                                                                                        ?
                                                                                        digitLocale($data['total_trainee'])
                                                                                        : digitLocale(0) }}
                                                                                    </div>
                                                                                    <div class="label">
                                                                                        {{ __('dashboard.total_trainee')
                                                                                        }}
                                                                                    </div>
                                                                                </div>

                                                                                <div class="item">
                                                                                    {{-- <div class="digit">
                                                                                        {{ isset($data['total_dropout'])
                                                                                        ?
                                                                                        digitLocale($data['total_dropout'])
                                                                                        : digitLocale(0) }}
                                                                                    </div> --}}
                                                                                    {{-- <div class="label">
                                                                                        {{
                                                                                        __('dashboard.dropout_trainee')
                                                                                        }}
                                                                                    </div> --}}
                                                                                    {{-- <div class="digit">66%</div>
                                                                                    <div class="label">
                                                                                        {{
                                                                                        __('dashboard.successful_freelancer')
                                                                                        }}</div> --}}
                                                                                </div>
                                                                            </div>

                                                                            {{-- <div class="items">
                                                                                <div class="item">
                                                                                    <div class="digit">{{
                                                                                        $data['total_dropout']}}</div>
                                                                                    <div class="label">
                                                                                        {{
                                                                                        __('dashboard.dropout_trainee')
                                                                                        }}
                                                                                    </div>
                                                                                </div>
                                                                            </div> --}}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                    @endif
                                                </div>
                                                @endif

                                                @php
                                                $permissionsToCheck = ['traineeEnroll.index'];

                                                $commonPermissions = array_intersect($permissionsToCheck,
                                                $roleRoutePermissions);
                                                @endphp
                                                @if (!empty($commonPermissions))
                                                <div class="col-5">
                                                    <div id="py-chart" class="">
                                                        <div id="attendance-summery">
                                                            <div>
                                                                <div class="content">
                                                                    <div class="icon">
                                                                        <img src="{{ asset('img/new_icon') }}/alownce.png"
                                                                            alt="">
                                                                    </div>
                                                                    <div class="attendance">
                                                                        <div class="items d-block">
                                                                            <div class="item">
                                                                                <div class="digit">{{ digitLocale(0) }}
                                                                                </div>
                                                                                <div class="label">{{
                                                                                    __('dashboard.total_trainee') }}
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div>
                                                                    <canvas id="allownceChart"></canvas>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Content wrapper-->
                    <!--begin::Footer-->
                    <div id="kt_app_footer" class="app-footer">
                        <!--begin::Footer container-->
                        @include('auth.partials.footer')
                        <!--end::Footer container-->
                    </div>
                    <!--end::Footer-->
                </div>
                <!--end:::Main-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Page-->
    </div>

    <script src="{{ asset('assets/dist/assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('assets/dist/assets/js/scripts.bundle.js') }}"></script>
    {{-- <script src="{{ asset('assets/dist/assets/plugins/custom/fullcalendar/fullcalendar.bundle.js') }}"></script>
    --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script> --}}
    {{-- <script src="{{ asset('assets/dist/assets/js/custom/assets/functions.js') }}"></script> --}}
    <!--end::Global Javascript Bundle-->
    <!--begin::Vendors Javascript(used for this page only)-->
    {{-- <script src="{{ asset('assets/dist/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    --}}


    <script>
        if (sessionStorage.getItem('message')) {
            var type = sessionStorage.getItem('alert-type')
            switch (type) {
                case 'info':
                    toastr.info(sessionStorage.getItem('message'));
                    break;
            }
        }

        let admin_baseurl = '{{ route('home.index') }}';
        let api_baseurl = '{{ config('app.api_url') }}';
        let api_assets_baseurl = '{{ config('app.api_asset_url') }}';
        // let authToken = localStorage.getItem('authToken');
        // let token = localStorage.getItem('token');
        // if (authToken == null) {
        //     window.open('/', '_self')
        // }

        let url = "{{ route('changeLang') }}";
        let language = "{{ session()->get('locale') }}";
        let selectDivision = "{{ __('district-list.select_division') }}";
        let selectCourseCategory = "{{ __('sub-categorie-list.select_category') }}";
        let selectDistrict = "{{ __('upazila-list.select_district') }}";

        function changeLocale(lang) {
            let url_link = api_baseurl + "language";
            $.ajax({
                type: "get",
                url: url_link,
                headers: {
                    'X-localization': lang
                },
                data: {},
                dataType: "JSON",
                success: function(results) {
                    if (results.success === true) {
                        console.log(results.message);
                    } else {
                        // swal.fire("Error!", results.message, "error");
                    }
                },
                error: function(response) {
                    // alert(response);
                },
            });
            window.location.href = url + "?lang=" + lang;
        }
        $("#lang-bd").click(function() {
            changeLocale('bn');
        });
        $("#lang-us").click(function() {
            changeLocale('en');
        });
        $(".changeLang").change(function() {
            let url_link = api_baseurl + "language";
            $.ajax({
                type: "get",
                url: url_link,
                headers: {
                    'X-localization': $(this).val()
                },
                data: {},
                dataType: "JSON",
                success: function(results) {
                    if (results.success === true) {
                        console.log(results.message);
                    } else {
                        swal.fire("Error!", results.message, "error");
                    }
                },
                error: function(response) {
                    alert(response);
                },
            });
            window.location.href = url + "?lang=" + $(this).val();
        });     
</body>
<!--end::Body-->

</html>