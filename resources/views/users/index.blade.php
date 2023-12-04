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
                        {{ __('register-user-list.user_list') }}</h1>
                    <!--end::Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('home.index') }}"
                                class="text-muted text-hover-primary">{{ __('register-user-list.home') }}</a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">{{ __('register-user-list.user_management') }}</li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href=""class="text-muted text-hover-primary">{{ __('register-user-list.users') }}</a>
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
                @include('layouts.partials.messages')
                <!--begin::Card-->
                <div class="card">
                    <!--begin::Card header-->
                    <div class="card-header border-0 pt-6">
                        <!--begin::Card title-->
                        <div class="card-title">
                            {{-- <!--begin::Search-->
                            <div class="d-flex align-items-center position-relative my-1">
                                <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                                <form action="">
                                    <input type="text" data-kt-user-order-filter="search"
                                        class="form-control form-control-solid w-250px ps-13"
                                        placeholder="{{ __('register-user-list.search_user_ph') }}" name="search"
                                        value="{{ request('search') }}" />
                                </form>
                                <!--begin::Export buttons-->
                                <div id="kt_user_report_views_export" class="d-none"></div>
                                <!--end::Export buttons-->
                            </div>
                            <!--end::Search--> --}}
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
                                </i>{{ __('register-user-list.export_report') }}</button>
                            <!--begin::Menu-->
                            <div id="kt_user_report_views_export_menu"
                                class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-200px py-4"
                                data-kt-menu="true">
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link px-3"
                                        data-kt-user-export="copy">{{ __('register-user-list.copy_clipboard') }}</a>
                                </div>
                                <!--end::Menu item-->
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link px-3"
                                        data-kt-user-export="excel">{{ __('register-user-list.export_excel') }}</a>
                                </div>
                                <!--end::Menu item-->
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link px-3"
                                        data-kt-user-export="csv">{{ __('register-user-list.export_csv') }}</a>
                                </div>
                                <!--end::Menu item-->
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link px-3"
                                        data-kt-user-export="pdf">{{ __('register-user-list.export_pdf') }}</a>
                                </div>
                                <!--end::Menu item-->
                            </div>
                            <!--end::Menu-->
                            <!--begin::Toolbar-->
                            <div class="d-flex justify-content-end px-3" data-kt-user-table-toolbar="base">
                                <!--begin::Add user-->
                                <a href="" type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#kt_create_user">
                                    <i class="ki-duotone ki-plus fs-2"></i>{{ __('register-user-list.add_user') }}</a>
                                <!--end::Add user-->
                            </div>
                            <!--end::Toolbar-->
                        </div>
                        <!--end::Card toolbar-->
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body py-4">
                        <div class="pb-4">
                            <!--begin::Search-->
                            <form action="" id="targeted_search_form" method="post" class="w-100">
                                @csrf
                                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 mb-3">
                                    <!--begin::Search Reg.Id-->
                                    <div class="d-flex align-items-center position-relative my-1">
                                        <input type="text" data-kt-user-order-filter="search"
                                            class="form-control form-control-solid" placeholder="{{ __('register-user-list.search_reg_id') }}"
                                            name="reg_id" id="reg_id_search" value="{{ request('reg_id') }}" />
                                    </div>
                                    <!--end::Search Reg.Id-->
                                    <!--begin::Search name-->
                                    <div class="d-flex align-items-center position-relative my-1">
                                        <input type="text" data-kt-user-order-filter="search"
                                            class="form-control form-control-solid" placeholder="{{ __('register-user-list.search_by_name') }}"
                                            name="name" id="name_search" value="{{ request('name') }}" />
                                    </div>
                                    <!--end::Search name-->
                                    <!--begin::Search Phone No.-->
                                    <div class="d-flex align-items-center position-relative my-1">
                                        <input type="text" data-kt-user-order-filter="search"
                                            class="form-control form-control-solid" placeholder="{{ __('register-user-list.search_by_mobile') }}"
                                            name="phone_number" value="{{ request('phone_number') }}" />
                                    </div>
                                    <!--end::Search Phone No.-->
                                    <!--begin::Search email-->
                                    <div class="d-flex align-items-center position-relative my-1">
                                        <input type="text" data-kt-user-order-filter="search"
                                            class="form-control form-control-solid" placeholder="{{ __('register-user-list.search_by_email') }}"
                                            name="email" value="{{ request('email') }}" />
                                    </div>
                                    <!--end::Search email-->
                                    <!--begin::Search Division-->
                                    <div class="d-flex align-items-center position-relative my-1">
                                        <select name="division_id" aria-label="Select a Division" data-control="select2"
                                            data-placeholder="{{ __('register-user-list.select_division') }}" class="form-select form-select-solid"
                                            id="division_search">
                                            <option value="">Select Districts</option>

                                        </select>
                                    </div>
                                    <!--end::Search Division-->
                                    <!--begin::Search District-->
                                    <div class="d-flex align-items-center position-relative my-1">
                                        <select name="district_id" aria-label="Select a District" data-control="select2"
                                            data-placeholder="{{ __('register-user-list.select_district') }}" class="form-select form-select-solid"
                                            id="district_search">
                                            <option value="">Select Districts</option>

                                        </select>
                                    </div>
                                    <!--end::Search District-->
                                    <!--begin::Search Upazila-->
                                    <div class="d-flex align-items-center position-relative my-1">
                                        <select name="upazila_id" aria-label="Select a Upazila" data-control="select2"
                                            data-placeholder="{{ __('register-user-list.select_upazila') }}" class="form-select form-select-solid"
                                            id="upazila_search">
                                            <option value="">Select Upazila</option>

                                        </select>
                                    </div>
                                    <!--end::Search Upazila-->

                                    <div class="d-flex align-items-center position-relative my-1 gap-2">
                                        <a href="" class="btn btn-sm fw-bold btn-danger"
                                            id="clear-search-form">{{ __('register-user-list.clear') }}</a>
                                        <a href="" class="btn btn-sm fw-bold btn-success"
                                            id="refresh-page">{{ __('register-user-list.refresh') }}</a>
                                    </div>
                                </div>
                                <!--begin::Toolbar-->
                                <div class="px-3 text-center">
                                    <!--begin::Search Button-->
                                    <button type="submit" class="btn btn-primary">{{ __('register-user-list.search') }}</button>
                                    <!--end::Search Button-->
                                </div>
                                <!--end::Toolbar-->
                            </form>
                            <!--end::Search-->
                        </div>
                        <div class="table-responsive">
                            <!--begin::Table-->
                            <table class="table table-responsive align-middle table-row-dashed fs-6 gy-5"
                                id="kt_user_report_views_table">
                                <thead>
                                    <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                        <th class="w-10px pe-2">
                                            <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                                <input class="form-check-input" data-kt-check="true"
                                                    data-kt-check-target="#kt_table_users .form-check-input"
                                                    type="checkbox" value="" name="all-users" id="all-users" />
                                            </div>
                                        </th>
                                        <th class="min-w-125px">{{ __('register-user-list.user') }}</th>
                                        <th class="min-w-125px">{{ __('register-user-list.district') }}</th>
                                        <th class="min-w-125px">{{ __('register-user-list.upazila') }}</th>
                                        <th class="min-w-125px">{{ __('register-user-list.category') }}</th>
                                        <th class="min-w-125px">{{ __('register-user-list.sub_category') }}</th>
                                        <th class="min-w-125px text-center">{{ __('register-user-list.status') }}</th>
                                        <th class="text-end min-w-100px">{{ __('register-user-list.action') }}</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-600 fw-semibold" id="user-tbody">

                                </tbody>
                            </table>
                            <!--end::Table-->
                        </div>
                        <div class="text-center my-5">
                            <button type="button" class="btn btn-primary" id="preliminary-select-button">
                                {{ __('register-user-list.preliminary_select') }}
                            </button>
                        </div>
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
    <!--Begin::User Create Modal-->
    <div class="modal fade" id="kt_create_user" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-950px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <div class="modal-header" id="kt_modal_update_user_header">
                    <!--begin::Modal title-->
                    <h2 class="fw-bold">{{ __('register-user-list.add_user') }}</h2>
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
                <!--begin::Form-->
                <form id="kt_modal_add_user_form" method="post" class="form m-5" action="">
                    @csrf
                    <!--begin::Scroll-->
                    <div class="d-flex flex-column scroll-y me-n7 pe-7">
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label
                                class="required fw-semibold fs-6 mb-2">{{ __('register-user-list.first_name') }}</label>
                            <!--end::Label-->
                            <!--begin::First Name-->
                            <input type="text" placeholder="{{ __('register-user-list.first_name_ph') }}"
                                type="text" id="fname" name="fname" autocomplete="off"
                                class="form-control form-control-solid mb-3 mb-lg-0" value="" />
                            <span class="text-danger">

                            </span>
                            <!--end::First Name-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-2">{{ __('register-user-list.last_name') }}</label>
                            <!--end::Label-->
                            <!--begin::Last Name-->
                            <input type="text" placeholder="{{ __('register-user-list.last_name_ph') }}"
                                type="text" id="lname" name="lname" autocomplete="off"
                                class="form-control form-control-solid mb-3 mb-lg-0" value="" />
                            <span class="text-danger">

                            </span>
                            <!--end::Last Name-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-2">{{ __('register-user-list.email') }}</label>
                            <!--end::Label-->

                            <!--begin::Email-->
                            <input type="text" placeholder="{{ __('register-user-list.email_ph') }}" type="email"
                                id="email" name="email" autocomplete="off"
                                class="form-control form-control-solid mb-3 mb-lg-0" value="" />
                            <span class="text-danger">

                            </span>
                            <!--end::Email-->
                        </div>
                        <!--end::Input group-->
                        <!--start::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-2">{{ __('register-user-list.username') }}</label>
                            <!--end::Label-->

                            <!--begin::Email-->
                            <input type="text" placeholder="{{ __('register-user-list.username_ph') }}"
                                type="text" id="username" name="username" autocomplete="off"
                                class="form-control form-control-solid mb-3 mb-lg-0" value="" />
                            <span class="text-danger">

                            </span>
                            <!--end::Email-->
                        </div>
                        <!--begin::Input group-->
                        <div class="mb-7">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-5">{{ __('register-user-list.role') }}</label>
                            <!--end::Label-->
                            <!--begin::Roles-->
                            <!--begin::Input row-->
                            <div class="d-flex fv-row">
                                <!--begin::Radio-->
                                <div class="form-check form-check-custom form-check-solid">
                                    <!--begin::Input-->
                                    <input class="form-check-input me-3" name="role" type="radio" value="admin"
                                        id="kt_modal_update_role_option_0" />
                                    <!--end::Input-->
                                    <!--begin::Label-->
                                    <label class="form-check-label" for="kt_modal_update_role_option_0">
                                        <div class="fw-bold text-gray-800">{{ __('register-user-list.administrator') }}
                                        </div>
                                        <div class="text-gray-600">{{ __('register-user-list.best_business') }}</div>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <!--end::Radio-->
                            </div>
                            <!--end::Input row-->
                            <div class='separator separator-dashed my-5'></div>
                            <!--begin::Input row-->
                            <div class="d-flex fv-row">
                                <!--begin::Radio-->
                                <div class="form-check form-check-custom form-check-solid">
                                    <!--begin::Input-->
                                    <input class="form-check-input me-3" name="role" type="radio" value="mentor"
                                        id="kt_modal_update_role_option_1" />
                                    <!--end::Input-->
                                    <!--begin::Label-->
                                    <label class="form-check-label" for="kt_modal_update_role_option_1">
                                        <div class="fw-bold text-gray-800">{{ __('register-user-list.mentor') }}</div>
                                        <div class="text-gray-600">{{ __('register-user-list.skill_develop') }}</div>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <!--end::Radio-->
                            </div>
                            <!--end::Input row-->
                            <div class='separator separator-dashed my-5'></div>
                            <!--begin::Input row-->
                            <div class="d-flex fv-row">
                                <!--begin::Radio-->
                                <div class="form-check form-check-custom form-check-solid">
                                    <!--begin::Input-->
                                    <input class="form-check-input me-3" name="role" type="radio"
                                        value="instructor" id="kt_modal_update_role_option_2" />

                                    <!--end::Input-->
                                    <!--begin::Label-->
                                    <label class="form-check-label" for="kt_modal_update_role_option_2">
                                        <div class="fw-bold text-gray-800">{{ __('register-user-list.instructor') }}</div>
                                        <div class="text-gray-600">{{ __('register-user-list.teacher_teach') }}
                                        </div>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <!--end::Radio-->
                            </div>
                            <!--end::Input row-->
                            <div class='separator separator-dashed my-5'></div>
                            <!--begin::Input row-->
                            <div class="d-flex fv-row">
                                <!--begin::Radio-->
                                <div class="form-check form-check-custom form-check-solid">
                                    <!--begin::Input-->
                                    <input class="form-check-input me-3" name="role" type="radio" value="student"
                                        id="kt_modal_update_role_option_3" />

                                    <!--end::Input-->
                                    <!--begin::Label-->
                                    <label class="form-check-label" for="kt_modal_update_role_option_3">
                                        <div class="fw-bold text-gray-800">{{ __('register-user-list.student') }}</div>
                                        <div class="text-gray-600">{{ __('register-user-list.learning_person') }}</div>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <!--end::Radio-->
                            </div>
                            <!--end::Input row-->
                            <span class="text-danger">

                            </span>
                            <div class='separator separator-dashed my-5'></div>

                            <!--end::Roles-->
                        </div>
                        <!--end::Input group-->
                    </div>
                    <!--end::Scroll-->
                    <!--begin::Actions-->
                    <div class="text-center pt-15">
                        <a href="" type="reset" class="btn btn-light me-3"
                            data-bs-dismiss="modal">{{ __('register-user-list.discard') }}</a>
                        <button type="submit" class="btn btn-primary">
                            <span class="indicator-label">{{ __('register-user-list.submit') }}</span>
                            <span class="indicator-progress">Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                    </div>
                    <!--end::Actions-->
                </form>
                <!--end::Form-->

            </div>
        </div>
    </div>
    <!--End::User Create Modal-->
    <!--Begin::User Edit Modal-->
    <div class="modal fade" id="kt_edit_user" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-950px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <div class="modal-header" id="kt_modal_update_user_header">
                    <!--begin::Modal title-->
                    <h2 class="fw-bold">User Update</h2>
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
                <!--begin::Form-->
                <form id="kt_modal_add_user_form" method="post" class="form m-5" action="">
                    @csrf
                    <!--begin::Scroll-->
                    <div class="d-flex flex-column scroll-y me-n7 pe-7">
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-2">First Name</label>
                            <!--end::Label-->
                            <!--begin::First Name-->
                            <input type="text" placeholder="First Name" type="text" id="fname" name="fname"
                                autocomplete="off" class="form-control form-control-solid mb-3 mb-lg-0" value="" />
                            <span class="text-danger">

                            </span>
                            <!--end::First Name-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-2">Last Name</label>
                            <!--end::Label-->
                            <!--begin::Last Name-->
                            <input type="text" placeholder="Last Name" type="text" id="lname" name="lname"
                                autocomplete="off" class="form-control form-control-solid mb-3 mb-lg-0" value="" />
                            <span class="text-danger">

                            </span>
                            <!--end::Last Name-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-2">Email</label>
                            <!--end::Label-->

                            <!--begin::Email-->
                            <input type="text" placeholder="Email" type="email" id="email" name="email"
                                autocomplete="off" class="form-control form-control-solid mb-3 mb-lg-0" value="" />
                            <span class="text-danger">

                            </span>
                            <!--end::Email-->
                        </div>
                        <!--end::Input group-->
                        <!--start::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-2">Username</label>
                            <!--end::Label-->

                            <!--begin::Email-->
                            <input type="text" placeholder="Username" type="text" id="username" name="username"
                                autocomplete="off" class="form-control form-control-solid mb-3 mb-lg-0" value="" />
                            <span class="text-danger">

                            </span>
                            <!--end::Email-->
                        </div>
                        <!--begin::Input group-->
                        <div class="mb-7">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-5">Role</label>
                            <!--end::Label-->
                            <!--begin::Roles-->
                            <!--begin::Input row-->
                            <div class="d-flex fv-row">
                                <!--begin::Radio-->
                                <div class="form-check form-check-custom form-check-solid">
                                    <!--begin::Input-->
                                    <input class="form-check-input me-3" name="role" type="radio" value="admin"
                                        id="kt_modal_update_role_option_0" />
                                    <!--end::Input-->
                                    <!--begin::Label-->
                                    <label class="form-check-label" for="kt_modal_update_role_option_0">
                                        <div class="fw-bold text-gray-800">Administrator</div>
                                        <div class="text-gray-600">Best for business owners and company
                                            administrators</div>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <!--end::Radio-->
                            </div>
                            <!--end::Input row-->
                            <div class='separator separator-dashed my-5'></div>
                            <!--begin::Input row-->
                            <div class="d-flex fv-row">
                                <!--begin::Radio-->
                                <div class="form-check form-check-custom form-check-solid">
                                    <!--begin::Input-->
                                    <input class="form-check-input me-3" name="role" type="radio" value="mentor"
                                        id="kt_modal_update_role_option_1" />
                                    <!--end::Input-->
                                    <!--begin::Label-->
                                    <label class="form-check-label" for="kt_modal_update_role_option_1">
                                        <div class="fw-bold text-gray-800">Mentor</div>
                                        <div class="text-gray-600">Skill Developer Trainer</div>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <!--end::Radio-->
                            </div>
                            <!--end::Input row-->
                            <div class='separator separator-dashed my-5'></div>
                            <!--begin::Input row-->
                            <div class="d-flex fv-row">
                                <!--begin::Radio-->
                                <div class="form-check form-check-custom form-check-solid">
                                    <!--begin::Input-->
                                    <input class="form-check-input me-3" name="role" type="radio"
                                        value="instructor" id="kt_modal_update_role_option_2" />

                                    <!--end::Input-->
                                    <!--begin::Label-->
                                    <label class="form-check-label" for="kt_modal_update_role_option_2">
                                        <div class="fw-bold text-gray-800">Instructor</div>
                                        <div class="text-gray-600">Teacher who teach the student for best trainer
                                        </div>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <!--end::Radio-->
                            </div>
                            <!--end::Input row-->
                            <div class='separator separator-dashed my-5'></div>
                            <!--begin::Input row-->
                            <div class="d-flex fv-row">
                                <!--begin::Radio-->
                                <div class="form-check form-check-custom form-check-solid">
                                    <!--begin::Input-->
                                    <input class="form-check-input me-3" name="role" type="radio" value="student"
                                        id="kt_modal_update_role_option_3" />

                                    <!--end::Input-->
                                    <!--begin::Label-->
                                    <label class="form-check-label" for="kt_modal_update_role_option_3">
                                        <div class="fw-bold text-gray-800">Student</div>
                                        <div class="text-gray-600">Learning persons who learned for their
                                            development</div>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <!--end::Radio-->
                            </div>
                            <!--end::Input row-->
                            <span class="text-danger">

                            </span>
                            <div class='separator separator-dashed my-5'></div>

                            <!--end::Roles-->
                        </div>
                        <!--end::Input group-->
                    </div>
                    <!--end::Scroll-->
                    <!--begin::Actions-->
                    <div class="text-center pt-15">
                        <a href="" type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">Discard</a>
                        <button type="submit" class="btn btn-primary">
                            <span class="indicator-label">Update</span>
                            <span class="indicator-progress">Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                    </div>
                    <!--end::Actions-->
                </form>
                <!--end::Form-->

            </div>
        </div>
    </div>
    <!--End::User Edit Modal-->
@section('scripts')
    <!--begin::Custom Javascript(used for this page only)-->
    <script src="{{ asset('assets/dist/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script src="{{ asset('assets/dist/assets/js/custom/utilities/modals/users-search.js') }}"></script>
    <script src="{{ asset('assets/dist/assets/js/custom/pages/user/general.js') }}"></script>
    <script src="{{ asset('assets/dist/assets/js/custom/call.register.user.api.js') }}"></script>
    <script src="{{ asset('assets/dist/assets/js/custom/assets/functions.js') }}"></script>

    <script></script>
@endsection
@endsection
