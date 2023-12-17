@extends('layouts.auth-master')

@section('content')
@auth
<!--begin::Content wrapper-->
<div class="d-flex flex-column flex-column-fluid">
    <!--begin::Toolbar-->
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <!--begin::Toolbar container-->
        <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
            <!--begin::Page title-->
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <!--begin::Title-->
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Hello
                </h1>
                <!--end::Title-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        <a href="../../demo1/dist/index.html" class="text-muted text-hover-primary">Home</a>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">Dashboards</li>
                    <!--end::Item-->
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
        </div>
        <!--end::Toolbar container-->
    </div>
    <!--end::Toolbar-->
    <!--begin::Content-->
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-xxl">
            <!--begin::Row-->
            <div class="row g-1 g-xl-10">
                <!--begin::Col-->
                <div class="col-xl-4 mb-10  class-feed">
                    <!--begin::Lists Widget 19-->
                    <div class="card card-flush  h-100">
                        <!--begin::Heading-->
                        <div style="height: 10%!important;">
                            <h4 style="padding: 8px;">
                                <span class="card-label fw-bold text-gray-800">Classe Feed</span>
                            </h4>
                        </div>
                        <!--end::Heading-->
                        <!--begin::Body-->
                        <div class="card-body mt-n10">
                            <!--begin::Messages-->
                            <div class="scroll-y me-n5 pe-5 h-300px h-lg-auto" data-kt-element="messages"
                                data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}"
                                data-kt-scroll-max-height="auto"
                                data-kt-scroll-dependencies="#kt_header, #kt_app_header, #kt_app_toolbar, #kt_toolbar, #kt_footer, #kt_app_footer, #kt_chat_messenger_header, #kt_chat_messenger_footer"
                                data-kt-scroll-wrappers="#kt_content, #kt_app_content, #kt_chat_messenger_body"
                                data-kt-scroll-offset="5px">
                                <div id="class_feed">
                                </div>
                            </div>
                            <!--end::Messages-->
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Lists Widget 19-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-xl-8 mb-xl-10">
                    <!--begin::Row-->
                    <div class="row g-5 g-xl-10">
                        <!--begin::Col-->
                        <div class="col-xl-6">
                            <!--begin::Slider Widget 1-->
                            <div id="kt_sliders_widget_1_slider"
                                class="card card-flush carousel carousel-custom carousel-stretch slide h-xl-100"
                                data-bs-ride="carousel" data-bs-interval="5000">
                                <!--begin::Body-->
                                <div class="card-body py-6">
                                    <!--begin::Carousel-->
                                    <div class="carousel-inner">
                                    </div>
                                    <!--end::Carousel-->
                                </div>
                                <!--end::Body-->
                            </div>
                            <!--end::Slider Widget 1-->
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-xl-6 ">
                            <!--begin::Slider Widget 2-->
                            <div id="kt_sliders_widget_2_slider"
                                class="card card-flush carousel carousel-custom carousel-stretch slide h-xl-100"
                                data-bs-ride="carousel" data-bs-interval="5500">
                                <!--begin::Header-->
                                <div class="card-header pt-5">
                                    <!--begin::Title-->
                                    <h4 class="card-title d-flex align-items-start flex-column">
                                        <span class="card-label fw-bold text-gray-800">Exam Results</span>
                                        <span class="text-gray-400 mt-1 fw-bold fs-7"></span>
                                    </h4>
                                    <!--end::Title-->
                                    <!--begin::Toolbar-->
                                    <div class="card-toolbar">
                                        <!--begin::Carousel Indicators-->
                                        <ol
                                            class="p-0 m-0 carousel-indicators carousel-indicators-bullet carousel-indicators-active-success">
                                        </ol>
                                        <!--end::Carousel Indicators-->
                                    </div>
                                    <!--end::Toolbar-->
                                </div>
                                <!--end::Header-->
                                <!--begin::Body-->
                                <div class="card-body py-6">
                                    <!--begin::Carousel-->
                                    <div class="carousel-inner">
                                    </div>
                                    <!--end::Carousel-->
                                </div>
                                <!--end::Body-->
                            </div>
                            <!--end::Slider Widget 2-->
                        </div>
                        <!--end::Col-->
                        <div class="col-xl-12  courses-certificate">
                            <div class="col-xl-12">
                                <!--begin::Lists Widget 19-->
                                <div class="card card-flush h-xl-100">
                                    <!--begin::Heading-->
                                    <div
                                        class="card-header rounded bgi-no-repeat bgi-size-cover bgi-position-y-top bgi-position-x-center align-items-start h-100px">
                                        <!--begin::Toolbar-->
                                        <div class="card-toolbar">
                                            <!--begin::Menu-->
                                            <button
                                                class="btn btn-sm btn-icon btn-active-color-primary btn-color-white bg-white bg-opacity-25 bg-hover-opacity-100 bg-hover-white bg-active-opacity-25 w-20px h-20px"
                                                data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end"
                                                data-kt-menu-overflow="true">
                                                <i class="ki-duotone ki-dots-square fs-4">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                    <span class="path3"></span>
                                                    <span class="path4"></span>
                                                </i>
                                            </button>
                                            <!--begin::Menu 2-->
                                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px"
                                                data-kt-menu="true">
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <div class="menu-content fs-6 text-dark fw-bold px-3 py-4">Quick
                                                        Actions</div>
                                                </div>
                                                <!--end::Menu item-->
                                                <!--begin::Menu separator-->
                                                <div class="separator mb-3 opacity-75"></div>
                                                <!--end::Menu separator-->
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="#" class="menu-link px-3">New Ticket</a>
                                                </div>
                                                <!--end::Menu item-->
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="#" class="menu-link px-3">New Customer</a>
                                                </div>
                                                <!--end::Menu item-->
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3" data-kt-menu-trigger="hover"
                                                    data-kt-menu-placement="right-start">
                                                    <!--begin::Menu item-->
                                                    <a href="#" class="menu-link px-3">
                                                        <span class="menu-title">New Group</span>
                                                        <span class="menu-arrow"></span>
                                                    </a>
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu sub-->
                                                    <div class="menu-sub menu-sub-dropdown w-175px py-4">
                                                        <!--begin::Menu item-->
                                                        <div class="menu-item px-3">
                                                            <a href="#" class="menu-link px-3">Admin Group</a>
                                                        </div>
                                                        <!--end::Menu item-->
                                                        <!--begin::Menu item-->
                                                        <div class="menu-item px-3">
                                                            <a href="#" class="menu-link px-3">Staff Group</a>
                                                        </div>
                                                        <!--end::Menu item-->
                                                        <!--begin::Menu item-->
                                                        <div class="menu-item px-3">
                                                            <a href="#" class="menu-link px-3">Member Group</a>
                                                        </div>
                                                        <!--end::Menu item-->
                                                    </div>
                                                    <!--end::Menu sub-->
                                                </div>
                                                <!--end::Menu item-->
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="#" class="menu-link px-3">New Contact</a>
                                                </div>
                                                <!--end::Menu item-->
                                                <!--begin::Menu separator-->
                                                <div class="separator mt-3 opacity-75"></div>
                                                <!--end::Menu separator-->
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <div class="menu-content px-3 py-3">
                                                        <a class="btn btn-primary btn-sm px-4" href="#">Generate
                                                            Reports</a>
                                                    </div>
                                                </div>
                                                <!--end::Menu item-->
                                            </div>
                                            <!--end::Menu 2-->
                                            <!--end::Menu-->
                                        </div>
                                        <!--end::Toolbar-->
                                    </div>
                                    <!--end::Heading-->
                                    <!--begin::Body-->
                                    <div class="card-body mt-n20">
                                        <!--begin::Stats-->
                                        <div class="mt-n20 position-relative">
                                            <!--begin::Row-->
                                            <div class="row g-3 g-lg-6">
                                                <!--begin::Col-->
                                                <div class="col-6">
                                                    <!--begin::Items-->
                                                    <div class="bg-gray-100 bg-opacity-70 rounded-2 px-6 py-5">
                                                        <!--begin::Symbol-->
                                                        <div class="symbol symbol-30px me-5 mb-8">
                                                            <i class="ki-duotone ki-note-2 fs-2qx">
                                                                <i class="path1"></i>
                                                                <i class="path2"></i>
                                                                <i class="path3"></i>
                                                                <i class="path4"></i>
                                                            </i>
                                                        </div>
                                                        <!--end::Symbol-->
                                                        <!--begin::Stats-->
                                                        <div class="m-0">
                                                            <!--begin::Number-->
                                                            <span
                                                                class="text-gray-700 fw-bolder d-block fs-2qx lh-1 ls-n1 mb-1"></span>
                                                            <!--end::Number-->
                                                            <!--begin::Desc-->
                                                            <span class="text-gray-500 fw-semibold fs-6">Courses</span>
                                                            <!--end::Desc-->
                                                        </div>
                                                        <!--end::Stats-->
                                                    </div>
                                                    <!--end::Items-->
                                                </div>
                                                <!--end::Col-->
                                                <!--begin::Col-->
                                                <div class="col-6">
                                                    <!--begin::Items-->
                                                    <div class="bg-gray-100 bg-opacity-70 rounded-2 px-6 py-5">
                                                        <!--begin::Symbol-->
                                                        <div class="symbol symbol-30px me-5 mb-8">
                                                            <span class="symbol-label">
                                                                <i class="ki-duotone ki-badge fs-2qx">
                                                                    <i class="path1"></i>
                                                                    <i class="path2"></i>
                                                                    <i class="path3"></i>
                                                                    <i class="path4"></i>
                                                                    <i class="path5"></i>
                                                                </i>
                                                            </span>
                                                        </div>
                                                        <!--end::Symbol-->
                                                        <!--begin::Stats-->
                                                        <div class="m-0">
                                                            <!--begin::Desc-->
                                                            <span class="text-gray-500 fw-semibold fs-6"></span>
                                                            <!--end::Desc-->
                                                        </div>
                                                        <!--end::Stats-->
                                                    </div>
                                                    <!--end::Items-->
                                                </div>
                                                <!--end::Col-->
                                                <!--begin::Col-->
                                                <div class="col-6">
                                                    <!--begin::Items-->
                                                    <div class="bg-gray-100 bg-opacity-70 rounded-2 px-6 py-5">
                                                        <!--begin::Symbol-->
                                                        <div class="symbol symbol-30px me-5 mb-8">
                                                            <span class="symbol-label">
                                                                <i class="ki-duotone ki-people fs-2qx ">
                                                                    <i class="path1"></i>
                                                                    <i class="path2"></i>
                                                                    <i class="path3"></i>
                                                                    <i class="path4"></i>
                                                                    <i class="path5"></i>
                                                                </i>
                                                            </span>
                                                        </div>
                                                        <!--end::Symbol-->
                                                        <!--begin::Stats-->
                                                        <div class="m-0">
                                                            <!--begin::Desc-->
                                                            <span class="text-gray-500 fw-semibold fs-6">Total
                                                                Students</span>
                                                            <!--end::Desc-->
                                                        </div>
                                                        <!--end::Stats-->
                                                    </div>
                                                    <!--end::Items-->
                                                </div>
                                                <!--end::Col-->
                                                <!--begin::Col-->
                                                <div class="col-6">
                                                    <!--begin::Items-->
                                                    <div class="bg-gray-100 bg-opacity-70 rounded-2 px-6 py-5">
                                                        <!--begin::Symbol-->
                                                        <div class="symbol symbol-30px me-5 mb-8">
                                                            <span class="symbol-label">
                                                                <i class="ki-duotone ki-profile-user fs-2qx">
                                                                    <i class="path1"></i>
                                                                    <i class="path2"></i>
                                                                    <i class="path3"></i>
                                                                    <i class="path4"></i>
                                                                </i>
                                                            </span>
                                                        </div>
                                                        <!--end::Symbol-->
                                                        <!--begin::Stats-->
                                                        <div class="m-0">
                                                            <!--begin::Desc-->
                                                            <span class="text-gray-500 fw-semibold fs-6">Mentors &
                                                                Instructors</span>
                                                            <!--end::Desc-->
                                                        </div>
                                                        <!--end::Stats-->
                                                    </div>
                                                    <!--end::Items-->
                                                </div>
                                                <!--end::Col-->
                                                <!--begin::Col-->
                                                <div class="col-6">
                                                    <!--begin::Items-->
                                                    <div class="bg-gray-100 bg-opacity-70 rounded-2 px-6 py-5">
                                                        <!--begin::Symbol-->
                                                        <div class="symbol symbol-30px me-5 mb-8">
                                                            <span class="symbol-label">
                                                                <i class="ki-duotone ki-questionnaire-tablet fs-2qx  ">
                                                                    <i class="path1"></i>
                                                                    <i class="path2"></i>
                                                                </i>
                                                            </span>
                                                        </div>
                                                        <!--end::Symbol-->
                                                        <!--begin::Stats-->
                                                        <div class="m-0">
                                                            <!--begin::Desc-->
                                                            <span class="text-gray-500 fw-semibold fs-6">Classes
                                                                Held</span>
                                                            <!--end::Desc-->
                                                        </div>
                                                        <!--end::Stats-->
                                                    </div>
                                                    <!--end::Items-->
                                                </div>
                                                <!--end::Col-->
                                                <!--begin::Col-->
                                                <div class="col-6">
                                                    <!--begin::Items-->
                                                    <div class="bg-gray-100 bg-opacity-70 rounded-2 px-6 py-5">
                                                        <!--begin::Symbol-->
                                                        <div class="symbol symbol-30px me-5 mb-8">
                                                            <span class="symbol-label">
                                                                <i class="ki-duotone ki-time fs-2qx">
                                                                    <i class="path1"></i>
                                                                    <i class="path2"></i>
                                                                </i>
                                                            </span>
                                                        </div>
                                                        <!--end::Symbol-->
                                                        <!--begin::Stats-->
                                                        <div class="m-0">
                                                            <!--begin::Desc-->
                                                            <span class="text-gray-500 fw-semibold fs-6">Exam
                                                                Taken</span>
                                                            <!--end::Desc-->
                                                        </div>
                                                        <!--end::Stats-->
                                                    </div>
                                                    <!--end::Items-->
                                                </div>
                                                <!--end::Col-->
                                            </div>
                                            <!--end::Row-->
                                        </div>
                                        <!--end::Stats-->
                                    </div>
                                    <!--end::Body-->
                                </div>
                                <!--end::Lists Widget 19-->
                            </div>
                        </div>
                    </div>
                    <!--end::Row-->
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
            <!--begin::Row-->
            <div class="row g-5 g-xl-10 recommended-section">
                <!--begin::Col-->
                <div class="col-xl-4 mb-xl-10">
                    <!--begin::List widget 20-->
                    <div class="card h-xl-100">
                        <!--begin::Header-->
                        <div class="card-header border-0 pt-5">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold text-dark">District Wise Courses</span>
                            </h3>
                            <!--begin::Toolbar-->
                            <div class="card-toolbar">
                                <a href="" class="btn btn-sm btn-light">All Courses</a>
                            </div>
                            <!--end::Toolbar-->
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body pt-6 mb-5 scroll-y mh-375px" style="">
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::List widget 20-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-xl-8 mb-5 mb-xl-10">
                    <!--begin::Timeline Widget 1-->
                    <div class="card card-flush h-xl-100">
                        <!--begin::Card header-->
                        <div class="card-header pt-5">
                            <!--begin::Card title-->
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold text-dark">Team Schedule</span>
                                <span class="text-gray-400 pt-2 fw-semibold fs-6">49 Acual Tasks</span>
                            </h3>
                            <!--end::Card title-->
                            <!--begin::Card toolbar-->
                            <div class="card-toolbar">
                                <!--begin::Tabs-->
                                <ul class="nav">
                                    <li class="nav-item">
                                        <a class="nav-link btn btn-sm btn-color-muted btn-active btn-active-light fw-bold px-4 me-1 active"
                                            data-kt-timeline-widget-1="tab" data-bs-toggle="tab"
                                            href="#kt_timeline_widget_1_tab_day">Day</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link btn btn-sm btn-color-muted btn-active btn-active-light fw-bold px-4 me-1"
                                            data-kt-timeline-widget-1="tab" data-bs-toggle="tab"
                                            href="#kt_timeline_widget_1_tab_week">Week</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link btn btn-sm btn-color-muted btn-active btn-active-light fw-bold px-4 me-1"
                                            data-kt-timeline-widget-1="tab" data-bs-toggle="tab"
                                            href="#kt_timeline_widget_1_tab_month">Month</a>
                                    </li>
                                </ul>
                                <!--end::Tabs-->
                            </div>
                            <!--end::Card toolbar-->
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body pb-0">
                            <!--begin::Tab content-->
                            <div class="tab-content">
                                <!--begin::Tab pane-->
                                <div class="tab-pane active" id="kt_timeline_widget_1_tab_day" role="tabpanel"
                                    aria-labelledby="day-tab" data-kt-timeline-widget-1-blockui="true">
                                    <div class="table-responsive pb-10">
                                        <!--begin::Timeline-->
                                        <div id="kt_timeline_widget_1_1" class="vis-timeline-custom h-350px min-w-700px"
                                            data-kt-timeline-widget-1-image-root="assets/media/"></div>
                                        <!--end::Timeline-->
                                    </div>
                                </div>
                                <!--end::Tab pane-->
                                <!--begin::Tab pane-->
                                <div class="tab-pane" id="kt_timeline_widget_1_tab_week" role="tabpanel"
                                    aria-labelledby="week-tab" data-kt-timeline-widget-1-blockui="true">
                                    <div class="table-responsive pb-10">
                                        <!--begin::Timeline-->
                                        <div id="kt_timeline_widget_1_2" class="vis-timeline-custom h-350px min-w-700px"
                                            data-kt-timeline-widget-1-image-root="assets/media/"></div>
                                        <!--end::Timeline-->
                                    </div>
                                </div>
                                <!--end::Tab pane-->
                                <!--begin::Tab pane-->
                                <div class="tab-pane" id="kt_timeline_widget_1_tab_month" role="tabpanel"
                                    aria-labelledby="month-tab" data-kt-timeline-widget-1-blockui="true">
                                    <div class="table-responsive pb-10">
                                        <!--begin::Timeline-->
                                        <div id="kt_timeline_widget_1_3" class="vis-timeline-custom h-350px min-w-700px"
                                            data-kt-timeline-widget-1-image-root="assets/media/"></div>
                                        <!--end::Timeline-->
                                    </div>
                                </div>
                                <!--end::Tab pane-->
                            </div>
                            <!--end::Tab content-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Timeline Widget 1-->
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
            <!--begin::Row-->
            <div class="row g-5 g-xl-10">
                <!--begin::Col-->
                <div class="col-xl-4">
                    <!--begin::List widget 21-->
                    <div class="card card-flush h-xl-100">
                        <!--begin::Header-->
                        <div class="card-header border-0 pt-5">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold text-dark">Active Lessons</span>
                                <span class="text-muted mt-1 fw-semibold fs-7">Avg. 72% completed lessons</span>
                            </h3>
                            <!--begin::Toolbar-->
                            <div class="card-toolbar">
                                <a href="#" class="btn btn-sm btn-light">All Lessons</a>
                            </div>
                            <!--end::Toolbar-->
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body pt-5">
                            <!--begin::Item-->
                            <div class="d-flex flex-stack">
                                <!--begin::Wrapper-->
                                <div class="d-flex align-items-center me-3">
                                    <!--begin::Logo-->
                                    <img src="assets/media/svg/brand-logos/laravel-2.svg" class="me-4 w-30px" alt="" />
                                    <!--end::Logo-->
                                    <!--begin::Section-->
                                    <div class="flex-grow-1">
                                        <!--begin::Text-->
                                        <a href="#"
                                            class="text-gray-800 text-hover-primary fs-5 fw-bold lh-0">Laravel</a>
                                        <!--end::Text-->
                                        <!--begin::Description-->
                                        <span class="text-gray-400 fw-semibold d-block fs-6">PHP Framework</span>
                                        <!--end::Description=-->
                                    </div>
                                    <!--end::Section-->
                                </div>
                                <!--end::Wrapper-->
                                <!--begin::Statistics-->
                                <div class="d-flex align-items-center w-100 mw-125px">
                                    <!--begin::Progress-->
                                    <div class="progress h-6px w-100 me-2 bg-light-success">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 65%"
                                            aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <!--end::Progress-->
                                    <!--begin::Value-->
                                    <span class="text-gray-400 fw-semibold">65%</span>
                                    <!--end::Value-->
                                </div>
                                <!--end::Statistics-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Separator-->
                            <div class="separator separator-dashed my-3"></div>
                            <!--end::Separator-->
                            <!--begin::Item-->
                            <div class="d-flex flex-stack">
                                <!--begin::Wrapper-->
                                <div class="d-flex align-items-center me-3">
                                    <!--begin::Logo-->
                                    <img src="assets/media/svg/brand-logos/vue-9.svg" class="me-4 w-30px" alt="" />
                                    <!--end::Logo-->
                                    <!--begin::Section-->
                                    <div class="flex-grow-1">
                                        <!--begin::Text-->
                                        <a href="#" class="text-gray-800 text-hover-primary fs-5 fw-bold lh-0">Vue 3</a>
                                        <!--end::Text-->
                                        <!--begin::Description-->
                                        <span class="text-gray-400 fw-semibold d-block fs-6">JS Framework</span>
                                        <!--end::Description=-->
                                    </div>
                                    <!--end::Section-->
                                </div>
                                <!--end::Wrapper-->
                                <!--begin::Statistics-->
                                <div class="d-flex align-items-center w-100 mw-125px">
                                    <!--begin::Progress-->
                                    <div class="progress h-6px w-100 me-2 bg-light-warning">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 87%"
                                            aria-valuenow="87" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <!--end::Progress-->
                                    <!--begin::Value-->
                                    <span class="text-gray-400 fw-semibold">87%</span>
                                    <!--end::Value-->
                                </div>
                                <!--end::Statistics-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Separator-->
                            <div class="separator separator-dashed my-3"></div>
                            <!--end::Separator-->
                            <!--begin::Item-->
                            <div class="d-flex flex-stack">
                                <!--begin::Wrapper-->
                                <div class="d-flex align-items-center me-3">
                                    <!--begin::Logo-->
                                    <img src="assets/media/svg/brand-logos/bootstrap5.svg" class="me-4 w-30px" alt="" />
                                    <!--end::Logo-->
                                    <!--begin::Section-->
                                    <div class="flex-grow-1">
                                        <!--begin::Text-->
                                        <a href="#" class="text-gray-800 text-hover-primary fs-5 fw-bold lh-0">Bootstrap
                                            5</a>
                                        <!--end::Text-->
                                        <!--begin::Description-->
                                        <span class="text-gray-400 fw-semibold d-block fs-6">CSS Framework</span>
                                        <!--end::Description=-->
                                    </div>
                                    <!--end::Section-->
                                </div>
                                <!--end::Wrapper-->
                                <!--begin::Statistics-->
                                <div class="d-flex align-items-center w-100 mw-125px">
                                    <!--begin::Progress-->
                                    <div class="progress h-6px w-100 me-2 bg-light-primary">
                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 44%"
                                            aria-valuenow="44" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <!--end::Progress-->
                                    <!--begin::Value-->
                                    <span class="text-gray-400 fw-semibold">44%</span>
                                    <!--end::Value-->
                                </div>
                                <!--end::Statistics-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Separator-->
                            <div class="separator separator-dashed my-3"></div>
                            <!--end::Separator-->
                            <!--begin::Item-->
                            <div class="d-flex flex-stack">
                                <!--begin::Wrapper-->
                                <div class="d-flex align-items-center me-3">
                                    <!--begin::Logo-->
                                    <img src="assets/media/svg/brand-logos/angular-icon.svg" class="me-4 w-30px"
                                        alt="" />
                                    <!--end::Logo-->
                                    <!--begin::Section-->
                                    <div class="flex-grow-1">
                                        <!--begin::Text-->
                                        <a href="#" class="text-gray-800 text-hover-primary fs-5 fw-bold lh-0">Angular
                                            13</a>
                                        <!--end::Text-->
                                        <!--begin::Description-->
                                        <span class="text-gray-400 fw-semibold d-block fs-6">JS Framework</span>
                                        <!--end::Description=-->
                                    </div>
                                    <!--end::Section-->
                                </div>
                                <!--end::Wrapper-->
                                <!--begin::Statistics-->
                                <div class="d-flex align-items-center w-100 mw-125px">
                                    <!--begin::Progress-->
                                    <div class="progress h-6px w-100 me-2 bg-light-info">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: 70%"
                                            aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <!--end::Progress-->
                                    <!--begin::Value-->
                                    <span class="text-gray-400 fw-semibold">70%</span>
                                    <!--end::Value-->
                                </div>
                                <!--end::Statistics-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Separator-->
                            <div class="separator separator-dashed my-3"></div>
                            <!--end::Separator-->
                            <!--begin::Item-->
                            <div class="d-flex flex-stack">
                                <!--begin::Wrapper-->
                                <div class="d-flex align-items-center me-3">
                                    <!--begin::Logo-->
                                    <img src="assets/media/svg/brand-logos/spring-3.svg" class="me-4 w-30px" alt="" />
                                    <!--end::Logo-->
                                    <!--begin::Section-->
                                    <div class="flex-grow-1">
                                        <!--begin::Text-->
                                        <a href="#"
                                            class="text-gray-800 text-hover-primary fs-5 fw-bold lh-0">Spring</a>
                                        <!--end::Text-->
                                        <!--begin::Description-->
                                        <span class="text-gray-400 fw-semibold d-block fs-6">Java Framework</span>
                                        <!--end::Description=-->
                                    </div>
                                    <!--end::Section-->
                                </div>
                                <!--end::Wrapper-->
                                <!--begin::Statistics-->
                                <div class="d-flex align-items-center w-100 mw-125px">
                                    <!--begin::Progress-->
                                    <div class="progress h-6px w-100 me-2 bg-light-danger">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 56%"
                                            aria-valuenow="56" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <!--end::Progress-->
                                    <!--begin::Value-->
                                    <span class="text-gray-400 fw-semibold">56%</span>
                                    <!--end::Value-->
                                </div>
                                <!--end::Statistics-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Separator-->
                            <div class="separator separator-dashed my-3"></div>
                            <!--end::Separator-->
                            <!--begin::Item-->
                            <div class="d-flex flex-stack">
                                <!--begin::Wrapper-->
                                <div class="d-flex align-items-center me-3">
                                    <!--begin::Logo-->
                                    <img src="assets/media/svg/brand-logos/typescript-1.svg" class="me-4 w-30px"
                                        alt="" />
                                    <!--end::Logo-->
                                    <!--begin::Section-->
                                    <div class="flex-grow-1">
                                        <!--begin::Text-->
                                        <a href="#"
                                            class="text-gray-800 text-hover-primary fs-5 fw-bold lh-0">TypeScript</a>
                                        <!--end::Text-->
                                        <!--begin::Description-->
                                        <span class="text-gray-400 fw-semibold d-block fs-6">Better Tooling</span>
                                        <!--end::Description=-->
                                    </div>
                                    <!--end::Section-->
                                </div>
                                <!--end::Wrapper-->
                                <!--begin::Statistics-->
                                <div class="d-flex align-items-center w-100 mw-125px">
                                    <!--begin::Progress-->
                                    <div class="progress h-6px w-100 me-2 bg-light-success">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 82%"
                                            aria-valuenow="82" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <!--end::Progress-->
                                    <!--begin::Value-->
                                    <span class="text-gray-400 fw-semibold">82%</span>
                                    <!--end::Value-->
                                </div>
                                <!--end::Statistics-->
                            </div>
                            <!--end::Item-->
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::List widget 21-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-xl-8">
                    <!--begin::Chart widget 18-->
                    <div class="card card-flush h-xl-100">
                        <!--begin::Header-->
                        <div class="card-header pt-7">
                            <!--begin::Title-->
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold text-gray-800">Learn Activity</span>
                                <span class="text-gray-400 mt-1 fw-semibold fs-6">Hours per course</span>
                            </h3>
                            <!--end::Title-->
                            <!--begin::Toolbar-->
                            <div class="card-toolbar">
                                <!--begin::Daterangepicker(defined in src/js/layout/app.js)-->
                                <div data-kt-daterangepicker="true" data-kt-daterangepicker-opens="left"
                                    class="btn btn-sm btn-light d-flex align-items-center px-4">
                                    <!--begin::Display range-->
                                    <div class="text-gray-600 fw-bold">Loading date range...</div>
                                    <!--end::Display range-->
                                    <i class="ki-duotone ki-calendar-8 fs-1 ms-2 me-0">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                        <span class="path4"></span>
                                        <span class="path5"></span>
                                        <span class="path6"></span>
                                    </i>
                                </div>
                                <!--end::Daterangepicker-->
                            </div>
                            <!--end::Toolbar-->
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body d-flex align-items-end px-0 pt-3 pb-5">
                            <!--begin::Chart-->
                            <div id="kt_charts_widget_18_chart" class="h-325px w-100 min-h-auto ps-4 pe-6"></div>
                            <!--end::Chart-->
                        </div>
                        <!--end: Card Body-->
                    </div>
                    <!--end::Chart widget 18-->
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
        </div>
        <!--end::Content container-->
    </div>
    <!--end::Content-->
</div>
<!--end::Content wrapper-->
<!--begin::Modal - Class-->
<div class="modal fade" id="kt_modal_attendance" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-1000px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header py-7 d-flex justify-content-between align-items-center">
                <!--begin::Modal title-->
                {{-- <h2>Class Attendance</h2> --}}
                <div class="" id="header-info">

                </div>
                <!--end::Modal title-->
                <!--begin::Close-->
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <i class="ki-duotone ki-cross fs-1">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                </div>
                <!--end::Close-->
            </div>
            <!--begin::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body scroll-y" id="attendance-mb">
                <div class="" id="carouselContainer">
                    <div class="mh-175px scroll-y" style="background-color: #FDF3E7; padding:10px">
                        <!--begin::Nav-->
                        <ul class="nav nav-pills nav-pills-custom mb-3" id="schedule-tabs">

                        </ul>
                        <!--end::Nav-->
                    </div>

                    <!--begin::Tab Content-->
                    <div class="tab-content mt-4" id="attendance-tab-contents">

                    </div>
                </div>
            </div>
            <!--begin::Modal body-->
        </div>
    </div>
</div>
<!--end::Modal - Class-->
<!--begin::Modal - Class Result-->
<div class="modal fade" id="kt_modal_batch_result" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-1000px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header py-7 d-flex justify-content-between align-items-center">
                <!--begin::Modal title-->
                <div class="" id="exam-header-info">
                    <h2>Exam Reuslt</h2>
                </div>
                <!--end::Modal title-->
                <!--begin::Close-->
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <i class="ki-duotone ki-cross fs-1">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                </div>
                <!--end::Close-->
            </div>
            <!--begin::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body scroll-y" id="exam-result-dates">
                <div class="" id="carouselContainer">
                    <div class="mh-175px scroll-y" style="background-color: #FDF3E7; padding:10px">
                        <!--begin::Nav-->
                        <ul class="nav nav-pills nav-pills-custom mb-3" id="exam-schedule-tabs">

                        </ul>
                        <!--end::Nav-->
                    </div>
                    <!--begin::Tab Content-->
                    <div class="tab-content mt-4" id="result-tab-contents">

                    </div>
                </div>
            </div>
            <!--begin::Modal body-->
        </div>
    </div>
</div>
<!--end::Modal - Class-->
@endauth

@guest
<h1>Welcome User Dashboard</h1>

@if(Auth::check())
<!-- User is authenticated -->
<form action="{{ route('logout') }}" method="post">
    @csrf
    <button type="submit">Logout</button>
</form>
@else
<!-- User is not authenticated -->
<a href="{{ route('login') }}">Login</a>
@endif

@endguest
@section('scripts')
<!--begin::Vendors Javascript(used for this page only)-->
<script src="{{ asset('assets/dist/assets/plugins/custom/fullcalendar/fullcalendar.bundle.js') }}"></script>
<script src="{{ asset('assets/dist/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
<!--end::Vendors Javascript-->
<!--begin::Custom Javascript(used for this page only)-->
<script src="{{ asset('assets/dist/assets/js/custom/apps/calendar/calendar.js') }}"></script>

@endsection
@endsection