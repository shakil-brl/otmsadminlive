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
                        {{ __('admin-user-list.admin_user_list') }}</h1>
                    <!--end::Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('home.index') }}"
                                class="text-muted text-hover-primary">{{ __('admin-user-list.home') }}</a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">{{ __('admin-user-list.user_management') }}</li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href=""class="text-muted text-hover-primary">{{ __('admin-user-list.users') }}</a>
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
                            <!--begin::Search-->
                            <div class="d-flex align-items-center position-relative my-1">
                                <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                                <form action="">
                                    <input type="text" data-kt-user-order-filter="search"
                                        class="form-control form-control-solid w-250px ps-13"
                                        placeholder="{{ __('admin-user-list.search_user_ph') }}" name="search"
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
                                </i>{{ __('admin-user-list.export_report') }}</button>
                            <!--begin::Menu-->
                            <div id="kt_user_report_views_export_menu"
                                class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-200px py-4"
                                data-kt-menu="true">
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link px-3"
                                        data-kt-user-export="copy">{{ __('admin-user-list.copy_clipboard') }}</a>
                                </div>
                                <!--end::Menu item-->
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link px-3"
                                        data-kt-user-export="excel">{{ __('admin-user-list.export_excel') }}</a>
                                </div>
                                <!--end::Menu item-->
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link px-3"
                                        data-kt-user-export="csv">{{ __('admin-user-list.export_csv') }}</a>
                                </div>
                                <!--end::Menu item-->
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link px-3"
                                        data-kt-user-export="pdf">{{ __('admin-user-list.export_pdf') }}</a>
                                </div>
                                <!--end::Menu item-->
                            </div>
                            <!--end::Menu-->
                            <!--begin::Toolbar-->
                            <div class="d-flex justify-content-end px-3" data-kt-user-table-toolbar="base">
                                <!--begin::Add user-->
                                <a href="" type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#kt_create_user" id="open-create-user-modal">
                                    <i class="ki-duotone ki-plus fs-2"></i>{{ __('admin-user-list.add_user') }}</a>
                                <!--end::Add user-->
                            </div>
                            <!--end::Toolbar-->
                        </div>
                        <!--end::Card toolbar-->
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body py-4">
                        <div class="table-responsive">
                            <!--begin::Table-->
                            <table class="table table-responsive align-middle table-row-dashed fs-6 gy-5"
                                id="kt_user_report_views_table">
                                <thead>
                                    <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                        <th class="w-10px pe-2">
                                            <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                                <input class="form-check-input" data-kt-check="true"
                                                    data-kt-check-target="#kt_table_users .form-check-input" type="checkbox"
                                                    value="" name="all-users" id="all-users" />
                                            </div>
                                        </th>
                                        <th class="min-w-125px">{{ __('admin-user-list.profile_id') }}</th>
                                        <th class="min-w-125px">{{ __('admin-user-list.user_name') }}</th>
                                        <th class="min-w-125px">{{ __('admin-user-list.role') }}</th>
                                        <th class="min-w-125px">{{ __('admin-user-list.email') }}</th>
                                        <th class="min-w-125px">{{ __('admin-user-list.nid') }}</th>
                                        <th class="min-w-125px">{{ __('admin-user-list.vendor_name') }}</th>
                                        <th class="text-end min-w-100px">{{ __('admin-user-list.action') }}</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-600 fw-semibold" id="user-tbody">

                                </tbody>
                            </table>
                            <!--end::Table-->
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
        <div class="modal-dialog modal-dialog-centered mw-950px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <div class="modal-header" id="kt_modal_add_user_header">
                    <!--begin::Modal title-->
                    <h2 class="fw-bold">{{ __('admin-user-list.admin_add_user') }}</h2>
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
                <div class="modal-body py-lg-10 px-lg-10">
                    <!--begin::Form-->
                    <form id="kt_modal_add_admin_form" method="post" class="form m-5" action="">
                        @csrf
                        <!--begin::Scroll-->
                        <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_update_user_scroll"
                            data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}"
                            data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_update_user_header"
                            data-kt-scroll-wrappers="#kt_modal_update_user_scroll" data-kt-scroll-offset="300px">

                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="required fw-semibold fs-6 mb-2">{{ __('admin-user-list.emails') }}</label>
                                <!--end::Label-->

                                <!--begin::Email-->
                                <input type="text" placeholder="{{ __('admin-user-list.email_ph') }}" type="email"
                                    id="email" name="email" autocomplete="off"
                                    class="form-control form-control-solid mb-3 mb-lg-0" value="" />
                                <span class="form-message-error-email">

                                </span>
                                <!--end::Email-->
                            </div>
                            <!--end::Input group-->

                            <!--start::Input group-->
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label
                                    class="required fw-semibold fs-6 mb-2">{{ __('admin-user-list.user_role') }}</label>
                                <!--end::Label-->

                                <!--begin::User Role-->
                                <select name="role_id" aria-label="Select User Role" data-control="select2"
                                    data-placeholder="{{ __('admin-user-list.select_role_ph') }}"
                                    class="form-select form-select-solid" data-dropdown-parent="#kt_modal_add_admin_form"
                                    id="role_id">
                                </select>
                                <span class="form-message-error-role_id">

                                </span>
                                <!--end::User Role-->
                            </div>
                            <!--end::Input group-->
                            @if ($role == 'Provider')
                            @endif
                            <!--start::Input group-->
                            <div class="fv-row mb-7 d-none" id="provider">
                                <!--begin::Label-->
                                <label class="required fw-semibold fs-6 mb-2">{{ __('admin-user-list.vendor_provider') }}</label>
                                <!--end::Label-->

                                <!--begin::Provider-->
                                <select name="provider_id" aria-label="{{ __('profile.provider_id_ph') }}"
                                    data-control="select2" data-placeholder="{{ __('admin-user-list.vendor_select') }}"
                                    class="form-select form-select-solid" data-dropdown-parent="#kt_modal_add_admin_form"
                                    id="provider_id">
                                </select>
                                <span class="form-message-error-provider_id">

                                </span>
                                <!--end::Provider-->
                            </div>
                            <!--end::Input group-->

                            <!--start::Input group-->
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="fw-semibold fs-6 mb-2">{{ __('admin-user-list.district') }}</label>
                                <!--end::Label-->

                                <!--begin::District-->
                                <select name="district_id" aria-label="{{ __('profile.district_ph') }}"
                                    data-control="select2" data-placeholder="{{ __('profile.district_ph') }}"
                                    class="form-select form-select-solid" data-dropdown-parent="#kt_modal_add_admin_form"
                                    id="district_id">
                                </select>
                                <span class="form-message-error-district_id">

                                </span>
                                <!--end::District-->
                            </div>
                            <!--end::Input group-->
                            <!--start::Input group-->
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="fw-semibold fs-6 mb-2">{{ __('admin-user-list.upazila') }}</label>
                                <!--end::Label-->

                                <!--begin::Upazila-->
                                <select name="upazila_id" aria-label="{{ __('profile.upazila_ph') }}"
                                    data-control="select2" data-placeholder="{{ __('profile.upazila_ph') }}"
                                    class="form-select form-select-solid" data-dropdown-parent="#kt_modal_add_admin_form"
                                    id="upazila_id">
                                </select>
                                <span class="form-message-error-upazila_id">

                                </span>
                                <!--end::Upazila-->
                            </div>
                            <!--end::Input group-->
                            <!--start::Input group-->
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="fw-semibold fs-6 mb-2">{{ __('admin-user-list.address') }}</label>
                                <!--end::Label-->

                                <!--begin::Address-->
                                <textarea class="form-control form-control-solid" rows="4" name="address"
                                    placeholder="{{ __('profile.address_ph') }}"></textarea>
                                <!--begin::Hint-->
                                <div class="form-text">
                                    {{ __('profile.address_allow_details') }}
                                </div>
                                <!--end::Hint-->
                                <span class="form-message-error-address">

                                </span>
                                <!--end::Address-->
                            </div>
                            <!--end::Input group-->
                        </div>
                        <!--end::Scroll-->
                        <!--begin::Actions-->
                        <div class="text-center pt-15">
                            <a href="" type="reset" class="btn btn-light me-3"
                                data-bs-dismiss="modal">{{ __('admin-user-list.discard') }}</a>
                            <button type="submit" class="btn btn-primary show-loader">
                                <span class="indicator-label">{{ __('admin-user-list.submit') }}</span>
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
    </div>
    <!--End::User Create Modal-->
    <!--Begin::User Edit Modal-->
    <div class="modal fade" id="kt_edit_user" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered mw-950px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <div class="modal-header" id="kt_modal_update_user_header">
                    <!--begin::Modal title-->
                    <h2 class="fw-bold">Update User</h2>
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
                <div class="modal-body py-lg-10 px-lg-10">
                    <!--begin::Form-->
                    <form id="kt_modal_update_admin_form" method="post" class="form m-5" action="">
                        @csrf
                        @method('PATCH')
                        <!--begin::Scroll-->
                        <input type="hidden" name="user_id">
                        <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_update_user_scroll"
                            data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}"
                            data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_update_user_header"
                            data-kt-scroll-wrappers="#kt_modal_update_user_scroll" data-kt-scroll-offset="300px">
                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="required fw-semibold fs-6 mb-2">Email</label>
                                <!--end::Label-->

                                <!--begin::Email-->
                                <input type="text" placeholder="Email" type="email" id="email" name="email"
                                    autocomplete="off" class="form-control form-control-solid mb-3 mb-lg-0"
                                    value="" />
                                <span class="form-message-error-email">

                                </span>
                                <!--end::Email-->
                            </div>
                            <!--end::Input group-->
                            <!--start::Input group-->
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="required fw-semibold fs-6 mb-2">User Role</label>
                                <!--end::Label-->

                                <!--begin::User Role-->
                                <select name="role_id" aria-label="Select User Role" data-control="select2"
                                    data-placeholder="Select User Role" class="form-select form-select-solid"
                                    data-dropdown-parent="#kt_modal_update_admin_form">
                                </select>
                                <span class="form-message-error-role_id">

                                </span>
                                <!--end::User Role-->
                            </div>
                            <!--end::Input group-->
                            <!--start::Input group-->
                            <div class="fv-row mb-7 d-none" id="provider-row">
                                <!--begin::Label-->
                                <label class="required fw-semibold fs-6 mb-2">Provider</label>
                                <!--end::Label-->

                                <!--begin::Provider-->
                                <select name="provider_id" aria-label="{{ __('profile.provider_id_ph') }}"
                                    data-control="select2" data-placeholder="{{ __('profile.provider_id_ph') }}"
                                    class="form-select form-select-solid"
                                    data-dropdown-parent="#kt_modal_update_admin_form">
                                </select>
                                <span class="form-message-error-provider_id">

                                </span>
                                <!--end::Provider-->
                            </div>
                            <!--end::Input group-->
                            <!--start::Input group-->
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="fw-semibold fs-6 mb-2">District</label>
                                <!--end::Label-->

                                <!--begin::District-->
                                <select name="district_id" aria-label="{{ __('profile.district_ph') }}"
                                    data-control="select2" data-placeholder="{{ __('profile.district_ph') }}"
                                    class="form-select form-select-solid"
                                    data-dropdown-parent="#kt_modal_update_admin_form">
                                </select>
                                <span class="form-message-error-district_id">

                                </span>
                                <!--end::District-->
                            </div>
                            <!--end::Input group-->
                            <!--start::Input group-->
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="fw-semibold fs-6 mb-2">Upazila</label>
                                <!--end::Label-->
                                <!--begin::Upazila-->
                                <select name="upazila_id" aria-label="{{ __('profile.upazila_ph') }}"
                                    data-control="select2" data-placeholder="{{ __('profile.upazila_ph') }}"
                                    class="form-select form-select-solid"
                                    data-dropdown-parent="#kt_modal_update_admin_form">
                                </select>
                                <span class="form-message-error-upazila_id">

                                </span>
                                <!--end::Upazila-->
                            </div>
                            <!--end::Input group-->
                            <!--start::Input group-->
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="fw-semibold fs-6 mb-2">Address</label>
                                <!--end::Label-->

                                <!--begin::Address-->
                                <textarea class="form-control form-control-solid" rows="4" name="address"
                                    placeholder="{{ __('profile.address_ph') }}"></textarea>
                                <!--begin::Hint-->
                                <div class="form-text">
                                    {{ __('profile.address_allow_details') }}
                                </div>
                                <!--end::Hint-->
                                <span class="form-message-error-address">

                                </span>
                                <!--end::Address-->
                            </div>
                            <!--end::Input group-->
                        </div>
                        <!--end::Scroll-->
                        <!--begin::Actions-->
                        <div class="text-center pt-15">
                            <a href="" type="reset" class="btn btn-light me-3"
                                data-bs-dismiss="modal">Discard</a>
                            <button type="submit" class="btn btn-primary  show-loader ">
                                <span class="indicator-label">Submit</span>
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
    </div>
    <!--End::User Edit Modal-->
@section('scripts')
    <script src="{{ asset('assets/dist/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script src="{{ asset('assets/dist/assets/js/custom/call.admin.user.api.js') }}"></script>

    <script>
        let userRole = @json($role);
    </script>
@endsection
@endsection

@push('js')
<script>
$('#dataTable').DataTable();
</script>
@endpush
