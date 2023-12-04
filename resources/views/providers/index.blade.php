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
                        {{ __('provider-list.provider_list') }}</h1>
                    <!--end::Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('home.index') }}"
                                class="text-muted text-hover-primary">{{ __('provider-list.home') }}</a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">{{ __('provider-list.setting_management') }}</li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href=""class="text-muted text-hover-primary">{{ __('provider-list.provider') }}</a>
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
                                        placeholder="{{ __('provider-list.search_provider') }}" name="search"
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
                                </i>{{ __('provider-list.export_report') }}</button>
                            <!--begin::Menu-->
                            <div id="kt_user_report_views_export_menu"
                                class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-200px py-4"
                                data-kt-menu="true">
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link px-3"
                                        data-kt-user-export="copy">{{ __('provider-list.copy_clipboard') }}</a>
                                </div>
                                <!--end::Menu item-->
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link px-3"
                                        data-kt-user-export="excel">{{ __('provider-list.export_excel') }}</a>
                                </div>
                                <!--end::Menu item-->
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link px-3"
                                        data-kt-user-export="csv">{{ __('provider-list.export_csv') }}</a>
                                </div>
                                <!--end::Menu item-->
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link px-3"
                                        data-kt-user-export="pdf">{{ __('provider-list.export_pdf') }}</a>
                                </div>
                                <!--end::Menu item-->
                            </div>
                            <!--end::Menu-->
                            <!--begin::Toolbar-->
                            <div class="d-flex justify-content-end px-3" data-kt-user-table-toolbar="base">
                                <!--begin::Add user-->
                                <a href="" type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#create_provider">
                                    <i class="ki-duotone ki-plus fs-2"></i>{{ __('provider-list.add_provider') }}</a>
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
                                id="kt_provider_report_views_table">
                                <thead>
                                    <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                        <th class="w-10px pe-2">
                                            <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                                <input class="form-check-input" data-kt-check="true"
                                                    data-kt-check-target="#kt_table_providers .form-check-input"
                                                    type="checkbox" value="" name="all-provider" id="all-provider" />
                                            </div>
                                        </th>
                                        <th class="min-w-125px">{{ __('provider-list.id') }}</th>
                                        <th class="min-w-125px">{{ __('provider-list.provider_name') }}</th>
                                        <th class="min-w-125px">{{ __('provider-list.email') }}</th>
                                        <th class="min-w-125px">{{ __('provider-list.phone') }}</th>
                                        <th class="min-w-125px">{{ __('provider-list.address') }}</th>
                                        <th class="text-end min-w-100px">{{ __('provider-list.action') }}</th>

                                    </tr>
                                </thead>
                                <tbody class="text-gray-600 fw-semibold" id="provider-tbody">

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
    <!--Begin::Provider Create Modal-->
    <div class="modal fade" id="create_provider" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-950px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <div class="modal-header" id="kt_modal_create_provider_header">
                    <!--begin::Modal title-->
                    <h2 class="fw-bold">{{ __('provider-list.add_provider') }}</h2>
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
                <form id="provider_add_form" method="post" class="form m-7" action="">
                    @csrf
                    <!--begin::Scroll-->
                    <div class="d-flex flex-column scroll-y me-n7 pe-7">
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-2">{{ __('provider-list.provider_name') }}</label>
                            <!--end::Label-->

                            <!--begin::First Name-->
                            <input type="text" placeholder="{{ __('provider-list.provider_name_ph') }}"
                                type="text" id="name" name="name" autocomplete="off"
                                class="form-control form-control-solid mb-3 mb-lg-0" value="" />
                            <span class="text-danger form-message-error-name">

                            </span>
                            <!--end::First Name-->
                        </div>
                        <!--end::Input group-->
                        <div class='separator separator-dashed my-2'></div>


                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="fw-semibold fs-6 mb-2">{{ __('provider-list.email') }}</label>
                            <!--end::Label-->
                            <!--begin::Email-->
                            <input type="text" placeholder="{{ __('provider-list.email_ph') }}" type="text"
                                id="email" name="email" autocomplete="off"
                                class="form-control form-control-solid mb-3 mb-lg-0" value="" />
                            <span class="text-danger form-message-error-email">

                            </span>
                            <!--end::Email-->
                        </div>
                        <!--end::Input group-->
                        <div class='separator separator-dashed my-2'></div>


                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-2">{{ __('provider-list.mobile_number') }}</label>
                            <!--end::Label-->
                            <input type="text" placeholder="{{ __('provider-list.mobile_number_ph') }}"
                                type="text" id="mobile" name="mobile" autocomplete="off"
                                class="form-control form-control-solid mb-3 mb-lg-0" value="" />
                            <span class="text-danger form-message-error-mobile">

                            </span>
                            <!--end::Mobile-->
                        </div>
                        <!--end::Input group-->
                        <div class='separator separator-dashed my-2'></div>



                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="fw-semibold fs-6 mb-2">{{ __('provider-list.address') }}</label>
                            <!--end::Label-->
                            <!--begin::Address-->
                            <textarea class="form-control form-control-solid" rows="4" name="address"
                                placeholder="{{ __('provider-list.address_ph') }}"></textarea>
                            <span class="text-danger form-message-error-address">

                            </span>
                            <!--end::Address-->
                        </div>
                        <!--end::Input group-->

                    </div>
                    <!--end::Scroll-->
                    <!--begin::Actions-->
                    <div class="text-center pt-15">
                        <a href="#" type="reset" class="btn btn-light me-3" data-bs-dismiss="modal"
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
    <!--End::Provider Create Modal-->
    <!--Start::Provider Update Modal-Content-->
    <div class="modal fade" id="edit_provider" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-950px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <div class="modal-header" id="kt_modal_update_provider_header">
                    <!--begin::Modal title-->
                    <h2 class="fw-bold">{{ __('provider-list.provider-edit') }}</h2>
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
                <form id="provider_edit_form" method="post" class="form m-7" action="">
                    @csrf
                    @method('PATCH')
                    <!--begin::Scroll-->
                    <div class="d-flex flex-column scroll-y me-n7 pe-7">
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-2">{{ __('provider-list.provider_name') }}</label>
                            <!--end::Label-->
                            <input type="hidden" name="provider_id" id="provider_id" value="" />
                            <!--begin::First Name-->
                            <input type="text" placeholder="{{ __('provider-list.provider_name_ph') }}" type="text" id="name"
                                name="name" autocomplete="off" class="form-control form-control-solid mb-3 mb-lg-0"
                                value="" />
                            <span class="text-danger form-message-error-name">

                            </span>
                            <!--end::First Name-->
                        </div>
                        <!--end::Input group-->
                        <div class='separator separator-dashed my-2'></div>


                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="fw-semibold fs-6 mb-2">{{ __('provider-list.email') }}</label>
                            <!--end::Label-->
                            <!--begin::Email-->
                            <input type="text" placeholder="{{ __('provider-list.email_ph') }}" type="text" id="email"
                                name="email" autocomplete="off" class="form-control form-control-solid mb-3 mb-lg-0"
                                value="" />
                            <span class="text-danger form-message-error-email">

                            </span>
                            <!--end::Email-->
                        </div>
                        <!--end::Input group-->
                        <div class='separator separator-dashed my-2'></div>


                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-2">{{ __('provider-list.mobile_number') }}</label>
                            <!--end::Label-->
                            <!--begin::Mobile-->
                            <input type="text" placeholder="{{ __('provider-list.mobile_number_ph') }}" type="text" id="mobile"
                                name="mobile" autocomplete="off" class="form-control form-control-solid mb-3 mb-lg-0"
                                value="" />
                            <span class="text-danger form-message-error-mobile">

                            </span>
                            <!--end::Mobile-->
                        </div>
                        <!--end::Input group-->
                        <div class='separator separator-dashed my-2'></div>


                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="fw-semibold fs-6 mb-2">{{ __('provider-list.address') }}</label>
                            <!--end::Label-->
                            <!--begin::Address-->
                            <textarea class="form-control form-control-solid" rows="4" name="address" id="address"
                                placeholder="{{ __('provider-list.address_ph') }}"></textarea>
                            <span class="text-danger form-message-error-address">

                            </span>
                            <!--end::Address-->
                        </div>
                        <!--end::Input group-->

                    </div>
                    <!--end::Scroll-->
                    <!--begin::Actions-->
                    <div class="text-center pt-15">
                        <a href="#" type="reset" data-bs-dismiss="modal" class="btn btn-light me-3"
                            data-kt-users-modal-action="cancel">{{ __('provider-list.discard') }}</a>
                        <button type="submit" class="btn btn-primary">
                            <span class="indicator-label">{{ __('provider-list.update') }}</span>
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
    <!--End::Provider Update Modal-->
    <!--Start::Provider link with Batches-->
    <div class="modal fade" id="link_batches" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-950px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <div class="modal-header" id="kt_modal_update_provider_header">
                    <!--begin::Modal title-->
                    <h2 class="fw-bold">{{ __('provider-list.link_batche') }}</h2>
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
                <form id="link_batches_form" method="post" class="form m-7" action="">
                    @csrf
                    <!--begin::Scroll-->
                    <div class="d-flex flex-column scroll-y me-n7 pe-7">
                        <input type="hidden" name="provider-id">
                        <!--start::Input group-->
                        <div class="fv-row mb-7">
                            <label class="col-form-label text-right col-lg-3 col-sm-12">{{ __('provider-list.select_batche') }}</label>
                            <div class="col">
                                <select class="form-control select2" id="kt_select2_3" multiple="multiple">

                                </select>
                                <span class="form-message-error-batch-ids">

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
    <!--End::Provider link with Batches-->
    <!--Start::Provider Update Modal-Content-->
    <div class="modal fade" id="view_provider" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-950px">
            <div class="modal-content">
                <div class="modal-header" id="kt_modal_update_provider_header">
                    <!--begin::Modal title-->
                    <h2 class="fw-bold">{{__('provider-list.provider_batches_view')}}</h2>
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
                <div class="modal-body scroll-y mx-5 mx-xl-18 pt-0 pb-15">
                    <!--begin::Heading-->
                    <div class="text-center mb-13">
                        <!--begin::Title-->
                        <h1 class="mt-3" id="provider-name"></h1>
                        <!--end::Title-->
                        <div class="text-muted fw-semibold fs-5">{{__('provider-list.address')}}:
                            <span id="provider-address"></span>
                        </div>
                        <div class="text-muted fw-semibold fs-5">{{__('provider-list.email')}}:
                            <span id="provider-email"></span>
                        </div>
                       
                        <!--begin::SubTitle-->
                        <h3 class="mb-3 text-muted">{{__('provider-list.browse_batches')}}</h3>
                        <!--end::SubTitle-->
                    </div>
                    <!--end::Heading-->
                    <!--begin::Users-->
                    <div class="mb-15">
                        <!--begin::List-->
                        <div class="mh-375px scroll-y me-n7 pe-7" id="training-batches-list">

                        </div>
                        <!--end::List-->
                    </div>
                    <!--end::Users-->
                    <!--begin::Actions-->
                    <div class="text-center pt-15">
                        <a href="#" type="reset" data-bs-dismiss="modal" class="btn btn-light me-3"
                            data-kt-users-modal-action="cancel">{{__('provider-list.discard')}}</a>
                        <button type="submit" class="btn btn-primary">
                            <span class="indicator-label">{{__('provider-list.submit')}}</span>
                            <span class="indicator-progress">Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                    </div>
                    <!--end::Actions-->
                </div>
            </div>
        </div>
    </div>
    <!--End::Provider Update Modal-->
@section('scripts')
    <!--begin::Custom Javascript(used for this page only)-->
    <script src="{{ asset('assets/dist/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script src="{{ asset('assets/dist/assets/js/custom/assets/functions.js') }}"></script>

    <script></script>
@endsection
@endsection
