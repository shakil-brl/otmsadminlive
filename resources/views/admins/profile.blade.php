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
                        {{ __('profile.page_heading') }}
                    </h1>
                    <!--end::Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('home.index') }}" class="text-muted text-hover-primary">Home</a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">Account</li>
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
                <!--begin::Navbar-->
                <div class="card mb-5 mb-xl-10">
                    <div class="card-body pt-9 pb-0">
                        <!--begin::Details-->
                        <div class="d-flex flex-wrap flex-sm-nowrap">
                            <!--begin: Pic-->
                            <div class="me-7 mb-4">
                                <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative user-image">
                                    <div
                                        class="position-absolute translate-middle bottom-0 start-100 mb-6 bg-success rounded-circle border border-4 border-body h-20px w-20px">
                                    </div>
                                </div>
                            </div>
                            <!--end::Pic-->
                            <!--begin::Info-->
                            <div class="flex-grow-1">
                                <!--begin::Title-->
                                <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                                    <!--begin::User-->
                                    <div class="d-flex flex-column">
                                        <!--begin::Name-->
                                        <div class="d-flex align-items-center mb-2">
                                            <a href="#"
                                                class="text-gray-900 text-hover-primary fs-2 fw-bold me-1 user-name"></a>
                                            <a href="#">
                                                <i class="ki-duotone ki-verify fs-1 text-primary">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </a>
                                        </div>
                                        <!--end::Name-->
                                        <!--begin::Info-->
                                        <div class="d-flex flex-wrap fw-semibold fs-6 mb-4 pe-2">
                                            <a href="#"
                                                class="d-flex align-items-center text-gray-400 text-hover-primary me-5 mb-2">
                                                <i class="ki-duotone ki-profile-circle fs-4 me-1">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                    <span class="path3"></span>
                                                </i>
                                                <span class="role-name"></span>
                                            </a>
                                            <i class="email-id"> </i>
                                        </div>
                                        <!--end::Info-->
                                    </div>
                                    <!--end::User-->
                                    <!--begin::Actions-->
                                    <div class="d-flex my-4">
                                        <div class="me-0">
                                            <div class="d-flex align-items-center w-200px w-sm-300px flex-column mt-3">
                                                <div class="d-flex justify-content-between w-100 mt-auto mb-2">
                                                    <span class="fw-semibold fs-6 text-gray-400">
                                                        {{ __('profile.profile_completion') }}
                                                    </span>
                                                    <span class="fw-bold fs-6 percentage"></span>
                                                </div>
                                                <div class="h-5px mx-3 w-100 bg-light mb-3">
                                                    <div class="bg-success rounded h-5px" role="progressbar"
                                                        style="width:50%;" aria-valuenow="50" aria-valuemin="0"
                                                        aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                            <!--end::Progress-->
                                        </div>
                                        <!--end::Menu-->
                                    </div>
                                    <!--end::Actions-->
                                </div>
                                <!--end::Title-->
                            </div>
                            <!--end::Info-->
                        </div>
                        <!--end::Details-->
                        <!--begin::Navs-->
                        <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bold">
                            <!--begin::Nav item-->
                            <li class="nav-item mt-2">
                                <a class="nav-link text-active-primary ms-0 me-10 py-5 active" data-bs-toggle="tab"
                                    href="#kt_user_view_overview_tab">Overview</a>
                            </li>
                            <!--end::Nav item-->

                            <!--begin::Nav item-->
                            <li class="nav-item mt-2">
                                <a class="nav-link text-active-primary ms-0 me-10 py-5" data-bs-toggle="tab"
                                    href="#kt_user_view_overview_events_and_logs_tab">Logs</a>
                            </li>
                            <!--end::Nav item-->
                        </ul>
                        <!--begin::Navs-->
                    </div>
                </div>
                <!--end::Navbar-->
                <!--begin::details View-->
                <!--begin:::Tab content-->
                <div class="tab-content" id="myTabContent">
                    <!--begin:::Tab pane-->
                    <div class="tab-pane fade show active" id="kt_user_view_overview_tab" role="tabpanel">
                        <div class="card mb-5 mb-xl-10" id="kt_profile_details_view">
                            <!--begin::Card header-->
                            <div class="card-header cursor-pointer">
                                <!--begin::Card title-->
                                <div class="card-title m-0">
                                    <h3 class="fw-bold m-0">
                                        {{ __('profile.profile_details_title') }}
                                    </h3>
                                </div>
                                <!--end::Card title-->
                            </div>
                            <!--begin::Card header-->
                            <!--begin::Card body-->
                            <div class="card-body p-9">
                                <!--begin::Row-->
                                <div class="row mb-7">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 fw-semibold text-muted">{{ __('profile.reg_id') }}</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8">
                                        <span class="fw-bold fs-6 text-gray-800 reg-id"></span>
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Row-->
                                <!--begin::Row-->
                                <div class="row mb-7">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 fw-semibold text-muted">{{ __('profile.full_name') }}</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8">
                                        <span class="fw-bold fs-6 text-gray-800 user-full-name"></span>
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Row-->
                                <!--begin::Input group-->
                                <div class="row mb-7">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 fw-semibold text-muted">{{ __('profile.username') }}</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <span class="fw-semibold text-gray-800 fs-6 username"></span>
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="row mb-7">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 fw-semibold text-muted">
                                        {{ __('profile.email') }}
                                    </label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 d-flex align-items-center">
                                        <span class="fw-bold fs-6 text-gray-800 me-2"></span>
                                        <span class="badge badge-success">{{ __('profile.email_v_batch') }}</span>
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->
                            </div>
                            <!--end::Card body-->
                        </div>
                        <!--end::details View-->

                        <!--begin::profile Edit-->
                        <div class="card mb-5 mb-xl-10" id="kt_profile_edit_view">
                            <!-- start : edit profile form -->
                            <!--begin::Basic info-->
                            <div class="card mb-5 mb-xl-10">
                                <!--begin::Card header-->
                                <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
                                    data-bs-target="#kt_account_profile_details" aria-expanded="true"
                                    aria-controls="kt_account_profile_details">
                                    <!--begin::Card title-->
                                    <div class="card-title m-0">
                                        <h3 class="fw-bold m-0">{{ __('profile.profile_update_title') }}</h3>
                                    </div>
                                    <!--end::Card title-->
                                </div>
                                <!--begin::Card header-->
                                <!--begin::Content-->
                                <div id="kt_account_settings_profile_details" class="collapse show">
                                    <!--begin::Form-->
                                    <form class="form" method="post" action="" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="profile" value="profile" />
                                        <!--begin::Card body-->
                                        <div class="card-body border-top p-9">
                                            <!--begin::Input group-->
                                            <div class="row mb-6">
                                                <!--begin::Label-->
                                                <label class="col-lg-4 col-form-label fw-semibold fs-6">{{ __('profile.image') }}</label>
                                                <!--end::Label-->
                                                <!--begin::Col-->
                                                <div class="col-lg-8">
                                                    <!--begin::Image input-->
                                                    <div class="image-input image-input-outline"
                                                        data-kt-image-input="true"
                                                        style="background-image: url('{{ asset('assets/dist/assets/media/svg/avatars/blank.svg') }}')">
                                                        <!--begin::Preview existing avatar-->
                                                        <div class="image-input-wrapper w-125px h-125px"
                                                            style="background-image: url('{{ asset('assets/dist/assets/media/svg/avatars/blank.svg') }}')">
                                                        </div>
                                                        <!--end::Preview existing avatar-->
                                                        <!--begin::Label-->
                                                        <label
                                                            class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                            data-kt-image-input-action="change" data-bs-toggle="tooltip"
                                                            title="Change avatar">
                                                            <i class="ki-duotone ki-pencil fs-7">
                                                                <span class="path1"></span>
                                                                <span class="path2"></span>
                                                            </i>
                                                            <!--begin::Inputs-->
                                                            <input type="file" name="photo_url"
                                                                accept=".png, .jpg, .jpeg, .gif, .svg" />
                                                            <input type="hidden" name="avatar_remove" />
                                                            <!--end::Inputs-->
                                                        </label>
                                                        <!--end::Label-->
                                                        <!--begin::Cancel-->
                                                        <span
                                                            class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                            data-kt-image-input-action="cancel" data-bs-toggle="tooltip"
                                                            title="Cancel avatar">
                                                            <i class="ki-duotone ki-cross fs-2">
                                                                <span class="path1"></span>
                                                                <span class="path2"></span>
                                                            </i>
                                                        </span>
                                                        <!--end::Cancel-->
                                                        <!--begin::Remove-->
                                                        <span
                                                            class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                            data-kt-image-input-action="remove" data-bs-toggle="tooltip"
                                                            title="Remove avatar">
                                                            <i class="ki-duotone ki-cross fs-2">
                                                                <span class="path1"></span>
                                                                <span class="path2"></span>
                                                            </i>
                                                        </span>
                                                        <!--end::Remove-->
                                                    </div>
                                                    <!--end::Image input-->
                                                    <!--begin::Hint-->
                                                    <div class="form-text">{{ __('profile.image_allow_type') }}
                                                    </div>
                                                    <!--end::Hint-->
                                                    <span class="text-danger form-message-error-photo_url">
                                                    </span>
                                                </div>
                                                <!--end::Col-->
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="row mb-6">
                                                <!--begin::Label-->
                                                <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                                    {{ __('profile.full_name') }}
                                                </label>
                                                <!--end::Label-->
                                                <!--begin::Col-->
                                                <div class="col-lg-8">
                                                    <!--begin::Row-->
                                                    <div class="row">
                                                        <!--begin::Col-->
                                                        <div class="col-lg-6 fv-row">
                                                            <input type="text" name="fname"
                                                                class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"
                                                                placeholder="{{ __('profile.fname_ph') }}"
                                                                value="" />
                                                            <span class="text-danger form-message-error-fname">
                                                            </span>
                                                        </div>
                                                        <!--end::Col-->
                                                        <!--begin::Col-->
                                                        <div class="col-lg-6 fv-row">
                                                            <input type="text" name="lname"
                                                                class="form-control form-control-lg form-control-solid"
                                                                placeholder="{{ __('profile.lname_ph') }}"
                                                                value="" />
                                                            <span class="text-danger form-message-error-fname">
                                                            </span>
                                                        </div>
                                                        <!--end::Col-->
                                                    </div>
                                                    <!--end::Row-->
                                                </div>
                                                <!--end::Col-->
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="row mb-6">
                                                <!--begin::Label-->
                                                <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                                    {{ __('profile.gender') }}
                                                </label>
                                                <!--end::Label-->
                                                <!--begin::Col-->
                                                <div class="col-lg-8 fv-row">
                                                    <!--begin::Options-->
                                                    <div class="d-flex align-items-center mt-3">
                                                        <!--begin::Option-->
                                                        <label
                                                            class="form-check form-check-custom form-check-inline form-check-solid me-5">
                                                            <input class="form-check-input" name="gender" type="radio"
                                                                value="M" />
                                                            <span
                                                                class="fw-semibold ps-2 fs-6">{{ __('profile.gender_male') }}</span>
                                                        </label>
                                                        <!--end::Option-->
                                                        <!--begin::Option-->
                                                        <label
                                                            class="form-check form-check-custom form-check-inline form-check-solid">
                                                            <input class="form-check-input" name="gender" type="radio"
                                                                value="F" />
                                                            <span
                                                                class="fw-semibold ps-2 fs-6">{{ __('profile.gender_female') }}</span>
                                                        </label>
                                                        <!--end::Option-->
                                                        <!--begin::Option-->
                                                        <label
                                                            class="form-check form-check-custom form-check-inline form-check-solid">
                                                            <input class="form-check-input" name="gender" type="radio"
                                                                value="F" />
                                                            <span
                                                                class="fw-semibold ps-2 fs-6">{{ __('profile.gender_others') }}</span>
                                                        </label>
                                                        <!--end::Option-->
                                                    </div>
                                                    <!--end::Options-->
                                                </div>
                                                <!--end::Col-->
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="row mb-6">
                                                <!--begin::Label-->
                                                <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                                    {{ __('profile.father_name') }}
                                                </label>
                                                <!--end::Label-->
                                                <!--begin::Col-->
                                                <div class="col-lg-8 fv-row">
                                                    <input type="tel" name="father_name"
                                                        class="form-control form-control-lg form-control-solid"
                                                        placeholder="{{ __('profile.father_name_ph') }}"
                                                        value="" />
                                                    <span class="text-danger form-message-error-father_name">
                                                    </span>
                                                </div>
                                                <!--end::Col-->
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="row mb-6">
                                                <!--begin::Label-->
                                                <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                                    {{ __('profile.mother_name') }}
                                                </label>
                                                <!--end::Label-->
                                                <!--begin::Col-->
                                                <div class="col-lg-8 fv-row">
                                                    <input type="tel" name="mother_name"
                                                        class="form-control form-control-lg form-control-solid"
                                                        placeholder="{{ __('profile.mother_name_ph') }}"
                                                        value="" />
                                                    <span class="text-danger form-message-error-mother_name">
                                                    </span>
                                                </div>
                                                <!--end::Col-->
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="row mb-6">
                                                <!--begin::Label-->
                                                <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                                    {{ __('profile.phone_contact') }}
                                                    <span class="ms-1" data-bs-toggle="tooltip"
                                                        title="{{ __('profile.phone_active') }}">
                                                        <i class="ki-duotone ki-information-5 text-gray-500 fs-6">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                            <span class="path3"></span>
                                                        </i>
                                                    </span>
                                                </label>
                                                <!--end::Label-->
                                                <!--begin::Col-->
                                                <div class="col-lg-8 fv-row">
                                                    <input type="tel" name="phone_number"
                                                        class="form-control form-control-lg form-control-solid"
                                                        placeholder="{{ __('profile.phone_num_ph') }}" value="" />
                                                    <span class="text-danger form-message-error-phone_number">
                                                    </span>
                                                </div>
                                                <!--end::Col-->
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="row mb-6">
                                                <!--begin::Label-->
                                                <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                                    <span>{{ __('profile.phone_nid') }}</span>
                                                    <span class="ms-1" data-bs-toggle="tooltip"
                                                        title="{{ __('profile.phone_nid_valid') }}">
                                                        <i class="ki-duotone ki-information-5 text-gray-500 fs-6">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                            <span class="path3"></span>
                                                        </i>
                                                    </span>
                                                </label>
                                                <!--end::Label-->
                                                <!--begin::Col-->
                                                <div class="col-lg-8 fv-row">
                                                    <input type="tel" name="nid"
                                                        class="form-control form-control-lg form-control-solid"
                                                        placeholder="{{ __('profile.phone_nid_ph') }}" value="" />
                                                    <span class="text-danger form-message-error-nid">
                                                    </span>
                                                </div>
                                                <!--end::Col-->
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="row mb-6">
                                                <!--begin::Label-->
                                                <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                                    <span>{{ __('profile.dob') }}</span>
                                                </label>
                                                <!--end::Label-->
                                                <!--begin::Col-->
                                                <div class="col-lg-8 fv-row">
                                                    <input type="date" name="dob" id="birthday" value=""
                                                        class="form-control form-control-lg form-control-solid" />
                                                </div>
                                                <!--end::Col-->
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="row mb-6">
                                                <!--begin::Label-->
                                                <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                                    {{ __('profile.bd_certificate') }}
                                                </label>
                                                <!--end::Label-->
                                                <!--begin::Col-->
                                                <div class="col-lg-8 fv-row">
                                                    <input type="number" name="nid"
                                                        class="form-control form-control-lg form-control-solid"
                                                        placeholder="{{ __('profile.bd_certificate_ph') }}"
                                                        value="" />
                                                    <span class="text-danger form-message-error-nid">
                                                    </span>
                                                </div>
                                                <!--end::Col-->
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="row mb-6">
                                                <!--begin::Label-->
                                                <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                                    {{ __('profile.district') }}
                                                </label>
                                                <!--end::Label-->
                                                <!--begin::Col-->
                                                <div class="col-lg-8 fv-row">
                                                    <select name="district_id"
                                                        aria-label="{{ __('profile.district_ph') }}"
                                                        data-control="select2"
                                                        data-placeholder="{{ __('profile.district_ph') }}"
                                                        class="form-select form-select-solid" data-dropdown-parent=""
                                                        id="district_id">
                                                        <option value="">{{ __('profile.district_ph') }}
                                                        </option>
                                                        <option value="dhaka">Dhaka</option>
                                                        <option value="rajshahi">Rajshahi</option>
                                                    </select>
                                                    <span class="form-message-error-district_id"></span>
                                                </div>
                                                <!--end::Col-->
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="row mb-6">
                                                <!--begin::Label-->
                                                <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                                    {{ __('profile.upazila') }}
                                                </label>
                                                <!--end::Label-->
                                                <!--begin::Col-->
                                                <div class="col-lg-8 fv-row">
                                                    <select name="upazila_id" aria-label="{{ __('profile.upazila_ph') }}"
                                                        data-control="select2"
                                                        data-placeholder="{{ __('profile.upazila_ph') }}"
                                                        class="form-select form-select-solid" data-dropdown-parent=""
                                                        id="upazila_id">
                                                        <option value="">{{ __('profile.upazila_ph') }}
                                                        </option>
                                                        <option value="dhaka">Rajpara</option>
                                                        <option value="rajshahi">Boaliya</option>
                                                    </select>
                                                    <span class="form-message-error-upazila_id"></span>
                                                </div>
                                                <!--end::Col-->
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="row mb-6">
                                                <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                                    <span>{{ __('profile.address') }}</span>
                                                </label>
                                                <div class="col-lg-8 fv-row">
                                                    <textarea class="form-control form-control-solid" rows="4" name="address"
                                                        placeholder="{{ __('profile.address_ph') }}"></textarea>
                                                    <span class="text-danger">
                                                    </span>
                                                </div>
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="row mb-6">
                                                <!--begin::Label-->
                                                <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                                    {{ __('profile.employment_status') }}
                                                </label>
                                                <!--end::Label-->
                                                <!--begin::Col-->
                                                <div class="col-lg-8 fv-row">
                                                    <select name="employment_status"
                                                        aria-label="{{ __('profile.employment_status_ph') }}"
                                                        data-control="select2"
                                                        data-placeholder="{{ __('profile.employment_status_ph') }}"
                                                        class="form-select form-select-solid" data-dropdown-parent=""
                                                        id="employment_status">
                                                        <option value="">
                                                            {{ __('profile.employment_status_ph') }}</option>
                                                        <option value="dhaka">Employed</option>
                                                        <option value="rajshahi">Unemployed</option>
                                                    </select>
                                                    <span class="form-message-error-employment_status"></span>
                                                </div>
                                                <!--end::Col-->
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="row mb-6">
                                                <!--begin::Label-->
                                                <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                                    {{ __('profile.financial_status') }}
                                                </label>
                                                <!--end::Label-->
                                                <!--begin::Col-->
                                                <div class="col-lg-8 fv-row">
                                                    <select name="financial_status"
                                                        aria-label="{{ __('profile.financial_status') }}"
                                                        data-control="select2"
                                                        data-placeholder="{{ __('profile.financial_status') }}"
                                                        class="form-select form-select-solid" data-dropdown-parent=""
                                                        id="financial_status">
                                                        <option value="">
                                                            {{ __('profile.financial_status') }}
                                                        </option>
                                                        <option value="dhaka">Solvent</option>
                                                        <option value="rajshahi">Not Solvent</option>
                                                    </select>
                                                    <span class="form-message-error-financial_status"></span>
                                                </div>
                                                <!--end::Col-->
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="row mb-6">
                                                <!--begin::Label-->
                                                <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                                    {{ __('profile.past_training') }}
                                                </label>
                                                <!--end::Label-->
                                                <!--begin::Col-->
                                                <div class="col-lg-8 fv-row">
                                                    <!--begin::Options-->
                                                    <div class="d-flex align-items-center mt-3">
                                                        <!--begin::Option-->
                                                        <label
                                                            class="form-check form-check-custom form-check-inline form-check-solid me-5">
                                                            <input class="form-check-input" name="past_training"
                                                                type="radio" value="1" />
                                                            <span
                                                                class="fw-semibold ps-2 fs-6">{{ __('profile.radio_input_yes') }}</span>
                                                        </label>
                                                        <!--end::Option-->
                                                        <!--begin::Option-->
                                                        <label
                                                            class="form-check form-check-custom form-check-inline form-check-solid">
                                                            <input class="form-check-input" name="past_training"
                                                                type="radio" value="0" />
                                                            <span
                                                                class="fw-semibold ps-2 fs-6">{{ __('profile.radio_input_no') }}</span>
                                                        </label>
                                                        <!--end::Option-->
                                                    </div>
                                                    <!--end::Options-->
                                                </div>
                                                <!--end::Col-->
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="row mb-6">
                                                <!--begin::Label-->
                                                <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                                    {{ __('profile.past_course_name') }}
                                                </label>
                                                <!--end::Label-->
                                                <!--begin::Col-->
                                                <div class="col-lg-8 fv-row">
                                                    <input type="text" name="past_course_name"
                                                        class="form-control form-control-lg form-control-solid"
                                                        placeholder="{{ __('profile.past_course_name_ph') }}"
                                                        value="" />
                                                    <span class="text-danger form-message-error-past_course_name">
                                                    </span>
                                                </div>
                                                <!--end::Col-->
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="row mb-6">
                                                <!--begin::Label-->
                                                <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                                    {{ __('profile.past_course_duration') }}
                                                </label>
                                                <!--end::Label-->
                                                <!--begin::Col-->
                                                <div class="col-lg-8 fv-row">
                                                    <input type="text" name="past_course_duration"
                                                        class="form-control form-control-lg form-control-solid"
                                                        placeholder="{{ __('profile.past_course_duration_ph') }}"
                                                        value="" />
                                                    <span class="text-danger form-message-error-past_course_duration">
                                                    </span>
                                                </div>
                                                <!--end::Col-->
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="row mb-6">
                                                <!--begin::Label-->
                                                <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                                    {{ __('profile.past_provider_id') }}
                                                </label>
                                                <!--end::Label-->
                                                <!--begin::Col-->
                                                <div class="col-lg-8 fv-row">
                                                    <input type="text" name="past_provider_id"
                                                        class="form-control form-control-lg form-control-solid"
                                                        placeholder="{{ __('profile.past_provider_id_ph') }}"
                                                        value="" />
                                                    <span class="text-danger form-message-error-past_provider_id">
                                                    </span>
                                                </div>
                                                <!--end::Col-->
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="row mb-6">
                                                <!--begin::Label-->
                                                <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                                    {{ __('profile.bank_id') }}
                                                </label>
                                                <!--end::Label-->
                                                <!--begin::Col-->
                                                <div class="col-lg-8 fv-row">
                                                    <input type="text" name="bank_id"
                                                        class="form-control form-control-lg form-control-solid"
                                                        placeholder="{{ __('profile.bank_id_ph') }}" value="" />
                                                    <span class="text-danger form-message-error-bank_id">
                                                    </span>
                                                </div>
                                                <!--end::Col-->
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="row mb-6">
                                                <!--begin::Label-->
                                                <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                                    {{ __('profile.bkash_id') }}
                                                </label>
                                                <!--end::Label-->
                                                <!--begin::Col-->
                                                <div class="col-lg-8 fv-row">
                                                    <input type="text" name="bkash_id"
                                                        class="form-control form-control-lg form-control-solid"
                                                        placeholder="{{ __('profile.bkash_id_ph') }}" value="" />
                                                    <span class="text-danger form-message-error-bkash_id">
                                                    </span>
                                                </div>
                                                <!--end::Col-->
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="row mb-6">
                                                <!--begin::Label-->
                                                <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                                    {{ __('profile.ssc_certificate') }}
                                                </label>
                                                <!--end::Label-->
                                                <!--begin::Col-->
                                                <div class="col-lg-4 col-md-9 col-sm-12">
                                                    <input type="file" name="ssc_certificate" id=""
                                                        class="form-control">
                                                </div>
                                                <!--end::Col-->
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="row mb-6">
                                                <!--begin::Label-->
                                                <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                                    {{ __('profile.hsc_certificate') }}
                                                </label>
                                                <!--end::Label-->
                                                <!--begin::Col-->
                                                <div class="col-lg-4 col-md-9 col-sm-12">
                                                    <input type="file" name="hsc_certificate" id=""
                                                        class="form-control">
                                                </div>
                                                <!--end::Col-->
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="row mb-6">
                                                <!--begin::Label-->
                                                <label class="col-lg-4 col-form-label fw-semibold fs-6">
                                                    {{ __('profile.signature') }}
                                                </label>
                                                <!--end::Label-->
                                                <!--begin::Col-->
                                                <div class="col-lg-4 col-md-9 col-sm-12">
                                                    <input type="file" name="signature" id=""
                                                        class="form-control">
                                                </div>
                                                <!--end::Col-->
                                            </div>
                                            <!--end::Input group-->
                                        </div>
                                        <!--end::Card body-->
                                        <!--begin::Actions-->
                                        <div class="card-footer d-flex justify-content-end py-6 px-9">
                                            <button type="submit" class="btn btn-primary"
                                                id="kt_account_profile_details_submit">{{ __('profile.save_btn') }}</button>
                                        </div>
                                        <!--end::Actions-->
                                    </form>
                                    <!--end::Form-->
                                </div>
                                <!--end::Content-->
                            </div>
                            <!--end::Basic info-->
                            <!-- end : edit profile form -->

                        </div>
                        <!--end:profile Edit-->
                        <!--begin::profile Signin Edit-->
                        <div class="card mb-5 mb-xl-10" id="kt_profile_signin_edit_view">

                            <!--begin::Sign-in Method-->
                            <div class="card mb-5 mb-xl-10">
                                <!--begin::Card header-->
                                <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
                                    data-bs-target="#kt_account_signin_method">
                                    <div class="card-title m-0">
                                        <h3 class="fw-bold m-0">{{ __('profile.sign_in_method_title') }}</h3>
                                    </div>
                                </div>
                                <!--end::Card header-->
                                <!--begin::Content-->
                                <div id="kt_account_settings_signin_method" class="collapse show">
                                    <!--begin::Card body-->
                                    <div class="card-body border-top p-9">
                                        <!--begin::Email Address-->
                                        <div class="d-flex flex-wrap align-items-center">
                                            <!--begin::Label-->
                                            <div id="kt_signin_email">
                                                <div class="fs-6 fw-bold mb-1">{{ __('profile.signin_email') }}
                                                </div>
                                                <div class="fw-semibold text-gray-600"></div>
                                            </div>
                                            <!--end::Label-->
                                            <!--begin::Edit-->
                                            <div id="kt_signin_email_edit" class="flex-row-fluid d-none">
                                                <!--begin::Form-->
                                                <form class="form" novalidate="novalidate" method="post"
                                                    action="">
                                                    @csrf

                                                    <input type="hidden" name="emailchange" value="emailchange" />
                                                    <div class="row mb-6">
                                                        <div class="col-lg-6 mb-4 mb-lg-0">
                                                            <div class="fv-row mb-0">
                                                                <label for="emailaddress"
                                                                    class="form-label fs-6 fw-bold mb-3">Enter New Email
                                                                    Address</label>
                                                                <input type="email"
                                                                    class="form-control form-control-lg form-control-solid"
                                                                    id="emailaddress" placeholder="Email Address"
                                                                    name="email" value="" />
                                                                <span class="text-danger">
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex">
                                                        <button id="kt_signin_submit" type="submit"
                                                            class="btn btn-primary me-2 px-6">Update Email</button>
                                                        <button id="kt_signin_cancel" type="button"
                                                            class="btn btn-color-gray-400 btn-active-light-primary px-6">Cancel</button>
                                                    </div>
                                                </form>
                                                <!--end::Form-->
                                            </div>
                                            <!--end::Edit-->
                                            <!--begin::Action-->
                                            <div id="kt_signin_email_button" class="ms-auto">
                                                <button class="btn btn-light btn-active-light-primary">
                                                    {{ __('profile.emailchange_btn') }}
                                                </button>
                                            </div>
                                            <!--end::Action-->
                                        </div>
                                        <!--end::Email Address-->
                                        <!--begin::Separator-->
                                        <div class="separator separator-dashed my-6"></div>
                                        <!--end::Separator-->
                                        <!--begin::Password-->
                                        <div class="d-flex flex-wrap align-items-center mb-10">
                                            <!--begin::Label-->
                                            @if (Session::has('error'))
                                                <div class="text-danger text-center mb-3">{{ Session::has('error') }}
                                                </div>
                                            @endif
                                            <div id="kt_signin_password">
                                                <div class="fs-6 fw-bold mb-1">
                                                    {{ __('profile.password') }}
                                                </div>
                                                <div class="fw-semibold text-gray-600">************</div>
                                            </div>
                                            <!--end::Label-->
                                            <!--begin::Edit-->
                                            <div id="kt_signin_password_edit" class="flex-row-fluid d-none">
                                                <!--begin::Form-->
                                                <form class="form" novalidate="novalidate" method="post"
                                                    accept="">
                                                    @csrf

                                                    <input type="hidden" name="passwordchange" value="passwordchange" />
                                                    <div class="row mb-1">
                                                        <div class="col-lg-4">
                                                            <div class="fv-row mb-0">
                                                                <label for="currentpassword"
                                                                    class="form-label fs-6 fw-bold mb-3">Current
                                                                    Password</label>
                                                                <input type="password"
                                                                    class="form-control form-control-lg form-control-solid"
                                                                    name="password" id="currentpassword" />
                                                                <span class="text-danger">
                                                                </span>

                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div class="fv-row mb-0">
                                                                <label for="newpassword"
                                                                    class="form-label fs-6 fw-bold mb-3">New
                                                                    Password</label>
                                                                <input type="password"
                                                                    class="form-control form-control-lg form-control-solid"
                                                                    name="newpassword" id="newpassword" />
                                                                <span class="text-danger">
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div class="fv-row mb-0">
                                                                <label for="confirmpassword"
                                                                    class="form-label fs-6 fw-bold mb-3">Confirm New
                                                                    Password</label>
                                                                <input type="password"
                                                                    class="form-control form-control-lg form-control-solid"
                                                                    name="confirmpassword" id="confirmpassword" />
                                                                <span class="text-danger">
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-text mb-5">Password must be at least 8 character and
                                                        contain
                                                        symbols</div>
                                                    <div class="d-flex">
                                                        <button id="kt_password_submit" type="submit"
                                                            class="btn btn-primary me-2 px-6">Update Password</button>
                                                        <button id="kt_password_cancel" type="button"
                                                            class="btn btn-color-gray-400 btn-active-light-primary px-6">Cancel</button>
                                                    </div>
                                                </form>
                                                <!--end::Form-->
                                            </div>
                                            <!--end::Edit-->
                                            <!--begin::Action-->
                                            <div id="kt_signin_password_button" class="ms-auto">
                                                <button class="btn btn-light btn-active-light-primary">
                                                    {{ __('profile.passwordchange_btn') }}
                                                </button>
                                            </div>
                                            <!--end::Action-->
                                        </div>
                                        <!--end::Password-->
                                    </div>
                                    <!--end::Card body-->
                                </div>
                                <!--end::Content-->
                            </div>
                            <!--end::Sign-in Method-->
                        </div>
                        <!--end::profile Signin Edit-->
                    </div>
                    <!--end::Content container-->
                    <!--begin:::Tab pane-->
                    <div class="tab-pane fade" id="kt_user_view_overview_events_and_logs_tab" role="tabpanel">
                        <!--begin::Card-->
                        <div class="card pt-4 mb-6 mb-xl-9">
                            <!--begin::Card header-->
                            <div class="card-header border-0">
                                <!--begin::Card title-->
                                <div class="card-title">
                                    <h2>User Logs</h2>
                                </div>
                                <!--end::Card title-->
                                <!--begin::Card toolbar-->
                                <div class="card-toolbar">
                                    <!--begin::Filter-->

                                    <!--end::Filter-->
                                </div>
                                <!--end::Card toolbar-->
                            </div>
                            <!--end::Card header-->
                            <!--begin::Card body-->
                            <div class="card-body pt-0 pb-5">
                                <!--begin::Table wrapper-->
                                <div class="table-responsive">
                                    <!--begin::Table-->
                                    <table class="table align-middle table-row-dashed gy-5">
                                        <thead class="border-bottom border-gray-200 fs-7 fw-bold">
                                            <tr class="text-start text-muted text-uppercase gs-0">
                                                <th class="min-w-100px">Login Time</th>
                                                <th>Logout Time</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody class="fs-6 fw-semibold text-gray-600">

                                        </tbody>
                                    </table>
                                    <!--end::Table-->
                                </div>
                                <!--end::Table wrapper-->
                            </div>
                            <!--end::Card body-->
                        </div>
                        <!--end::Card-->
                    </div>
                    <!--end:::Tab pane-->
                </div>
                <!--end::Content-->
            </div>
            <!--end::Content container-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Content wrapper-->

@section('scripts')
    <!--begin::Custom Javascript(used for this page only)-->
    <script src="{{ asset('assets/dist/assets/js/custom/pages/user-profile/general.js') }}"></script>
    <script src="{{ asset('assets/dist/assets/js/widgets.bundle.js') }}"></script>
    <script src="{{ asset('assets/dist/assets/js/custom/account/settings/profile-details.js') }}"></script>

    <script>
        let birthday = document.getElementById('birthday')
        birthday.addEventListener('change', (e) => {
            format: 'DD-MM-YYYY HH:mm:ss' // change format here
            let startDateVal = e.target.value

            document.getElementById('startDateSelected').innerText = startDateVal
        })
    </script>
@endsection

@endsection
