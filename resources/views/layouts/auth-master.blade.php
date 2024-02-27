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

    <!--begin::Fonts(mandatory for all pages)-->
    {{--
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" /> --}}
    <!--end::Fonts-->
    <link rel="stylesheet" href="{{ asset('assets/dist/assets/plugins/custom/fullcalendar/fullcalendar.bundle.css') }}"
        type="text/css" />
    <!--begin::Vendor Stylesheets(used for this page only)-->
    <link href="{{ asset('assets/dist/assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet"
        type="text/css" />
    <!--end::Vendor Stylesheets-->
    <!--begin::Vendor Stylesheets(used for this page only)-->
    <link href="{{ asset('assets/dist/assets/plugins/custom/leaflet/leaflet.bundle.css') }}" rel="stylesheet"
        type="text/css" />
    <!--end::Vendor Stylesheets-->
    <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
    <link rel="stylesheet" href="{{ asset('assets/dist/assets/plugins/global/plugins.bundle.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dist/assets/css/style.bundle.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/dist/assets/css/bootstrap-tagsinput.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dist/assets/css/toastr.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dist/assets/css/sidebar-custom.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dist/assets/css/user-custom.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dist/assets/css/class-custom.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dist/assets/css/custom.css') }}">

    {{--
    <link rel="stylesheet" href="{{ asset('assets/dist/assets/css/custom.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('css/dashboard/dashboard.css?v=1') }}">
    <link rel="stylesheet" href="{{ asset('css/new_dashboard/dashboard.css?v=1') }}">
    <link rel="stylesheet" href="{{ asset('css/new_pages/main.css?v=1') }}">
    {{--
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css" rel="stylesheet">
    --}}
    {{--
    <link href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css" rel="stylesheet"> --}}
    <style>
        /* styles.css */

        #preloader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            background-color: transparent;
            /* Set the background color of your preloader */
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 1000;
            /* backdrop-filter: blur(2px); */
            /* Set a high z-index to make sure it's on top of other elements */
        }

        /* HTML: <div class="loadernew"></div> */
        .loader {
            --d: 22px;
            width: 4px;
            height: 4px;
            border-radius: 50%;
            color: #c5c5c5;
            box-shadow:
                calc(1*var(--d)) calc(0*var(--d)) 0 0,
                calc(0.707*var(--d)) calc(0.707*var(--d)) 0 1px,
                calc(0*var(--d)) calc(1*var(--d)) 0 2px,
                calc(-0.707*var(--d)) calc(0.707*var(--d)) 0 3px,
                calc(-1*var(--d)) calc(0*var(--d)) 0 4px,
                calc(-0.707*var(--d)) calc(-0.707*var(--d))0 5px,
                calc(0*var(--d)) calc(-1*var(--d)) 0 6px;
            animation: l27 1s infinite steps(8);
        }

        @keyframes l27 {
            100% {
                transform: rotate(1turn)
            }
        }

        #kt_app_root {
            display: none;
            /* Hide the page content by default */
        }

        [data-kt-app-layout="dark-sidebar"] .app-sidebar .menu .menu-item .menu-link.active {
            border-left: 3px solid #FAF5FF;
            background: linear-gradient(90deg, rgba(164, 64, 255, 0.30) 0%, rgba(164, 64, 255, 0.00) 100%);
        }

        [data-kt-app-layout="dark-sidebar"] .app-sidebar .menu .menu-item .menu-link.active .menu-title {
            color: #FFF !important;
        }
    </style>
    @stack('css')
    @livewireScripts
    @livewireStyles
    <style>
        .ck.ck-balloon-panel.ck-balloon-panel_position_border-side_right.ck-powered-by-balloon {
            display: none !important;
        }
    </style>


    @if (Session::get('access_token.access_token'))
    <script>
        var accessToken = 'Bearer {{ Session::get("access_token.access_token") }}';
        var authToken = accessToken;
    </script>

    @endif

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
    <!--begin::Theme mode setup on page load-->
    <script>
        var defaultThemeMode = "light";
        let areYouSure = "{{ __('sign-out.are_you') }}";
        let wantLogout = "{{ __('sign-out.want_logout') }}";
        let yesLogout = "{{ __('sign-out.yes') }}";
        let cancelLogout = "{{ __('sign-out.cancel') }}";
        let areYou = "{{ __('categorie-list.are_you') }}";
        let wantUpdate = "{{ __('categorie-list.want_update') }}";
        let yesUpdate = "{{ __('categorie-list.yes_update') }}";
        let noCancel = "{{ __('categorie-list.no_cancel') }}";
        let sucessfullyUpdated = "{{ __('categorie-list.sucessfully_updated') }}";
        let ValidationError = "{{ __('categorie-list.update_validation_error') }}";
        let deleteData = "{{ __('categorie-list.delete_data') }}";
        let yesDelete = "{{ __('categorie-list.yes_delete') }}";
        let noDelete = "{{ __('categorie-list.cancel_delete') }}";
        let deletedData = "{{ __('categorie-list.deleted') }}";
        let yes = "{{ __('categorie-list.yes') }}";
        let linkBatch = "{{ __('provider-list.link_batch') }}";
        let selectBatch = "{{ __('provider-list.select_batche') }}";
        let enrollBatchCode = "{{ __('trainee-enrollment-list.enroll_batch_code') }}";
        let startDate = "{{ __('trainee-enrollment-list.start_date') }}";
        let geoCode = "{{ __('trainee-enrollment-list.geocode') }}";
        let locations = "{{ __('trainee-enrollment-list.location') }}";
        let vanue = "{{ __('trainee-enrollment-list.vanue') }}";
        let totalTrainee = "{{ __('trainee-enrollment-list.total_trainee') }}";
        let totalDuration = "{{ __('trainee-enrollment-list.total_duration') }}";
        let wantCreateSchedule = "{{ __('batch-schedule.want_create_schedule') }}";
        let yesCreate = "{{ __('batch-schedule.yes_create') }}";
        let successfullyCreate = "{{ __('batch-schedule.successfully_create') }}";
        let userFullName = "{{ __('admin-user-list.full_name') }}"

        var themeMode;
        if (document.documentElement) {
            if (document.documentElement.hasAttribute("data-bs-theme-mode")) {
                themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
            } else {
                if (localStorage.getItem("data-bs-theme") !== null) {
                    themeMode = localStorage.getItem("data-bs-theme");
                } else {
                    themeMode = defaultThemeMode;
                }
            }
            if (themeMode === "system") {
                themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
            }
            document.documentElement.setAttribute("data-bs-theme", themeMode);
        }
    </script>
    <!--end::Theme mode setup on page load-->



    <!--begin::App-->
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
                        @yield('content')
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
    <!--end::App-->
    <!--begin::Javascript-->

    <!--begin::Global Javascript Bundle(mandatory for all pages)-->
    <script src="{{ asset('assets/dist/assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('assets/dist/assets/js/scripts.bundle.js') }}"></script>
    {{-- <script src="{{ asset('assets/dist/assets/plugins/custom/fullcalendar/fullcalendar.bundle.js') }}"></script>
    --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script> --}}
    <script src="{{ asset('assets/dist/assets/js/custom/assets/functions.js') }}"></script>
    <!--end::Global Javascript Bundle-->
    <!--begin::Vendors Javascript(used for this page only)-->
    <script src="{{ asset('assets/dist/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>

    <script src="{{ asset('assets/dist/assets/js/custom/code.js') }}"></script>
    <script src="{{ asset('assets/dist/assets/js/custom/custom.js') }}"></script>
    <!--end::Vendors Javascript-->
    <!--begin::Custom Javascript(used for this page only)-->
    <script src="{{ asset('assets/dist/assets/js/custom/pages/user-profile/general.js') }}"></script>
    <script src="{{ asset('assets/dist/assets/js/custom/bootstrap-tagsinput.min.js') }}"></script>
    {{-- <script src="{{ asset('assets/dist/assets/js/custom/toastr.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('assets/dist/assets/js/custom/ckeditor.js') }}"></script> --}}



    <!--end::Custom Javascript-->
    <!--end::Javascript-->
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

        function permissionRole(link) {
            let permissionInfo = JSON.parse(localStorage.getItem('rolePermission'));
            let route_id = 0;
            permissionInfo.forEach(function(route) {
                if (link == route.route_name) {
                    route_id = 1;
                }
            });

            if (route_id == 0) {
                window.location.href = "{{ route('auth.error') }}";
            }

        }

        // script.js

        // document.addEventListener("DOMContentLoaded", function() {
        //     document.getElementById("preloader").style.display = "none";
        //     document.getElementById("kt_app_root").style.display = "block";
        // });
        $('.show-loader').on('click', function() {
            var myDiv = document.getElementById("preloader");
            if (myDiv.style.display === "none" || myDiv.style.display === "") {
                myDiv.style.display = "flex";
            } else {
                myDiv.style.display = "none";
            }

            setTimeout(function() {
                myDiv.style.display = "none";
            }, 80000);
        });
    </script>

    <!--begin::Custom Javascript(used for this page only)-->
    <script src="{{ asset('assets/dist/assets/js/custom/call.category.api.js') }}"></script>
    <script src="{{ asset('assets/dist/assets/js/custom/call.division.api.js') }}"></script>
    <script src="{{ asset('assets/dist/assets/js/custom/call.provider.api.js') }}"></script>
    <script src="{{ asset('assets/dist/assets/js/custom/call.permission.api.js') }}"></script>
    <script src="{{ asset('assets/dist/assets/js/custom/call.admin.show.api.js') }}"></script>
    @stack('js')

    @section('scripts')

    @show


    @yield('js')
</body>
<!--end::Body-->

</html>