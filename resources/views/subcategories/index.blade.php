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
                    {{ __('sub-categorie-list.sub_categorie_list') }}</h1>
                <!--end::Title-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route('home.index') }}" class="text-muted text-hover-primary">{{
                            __('sub-categorie-list.home') }}</a>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">{{ __('sub-categorie-list.Setting_management') }}</li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        <a href="" class="text-muted text-hover-primary">{{ __('sub-categorie-list.sub_categorie')
                            }}</a>
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
                                    placeholder="{{ __('sub-categorie-list.search_sub_category_ph') }}" name="search"
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
                            </i>{{ __('sub-categorie-list.export_report') }}</button>
                        <!--begin::Menu-->
                        <div id="kt_user_report_views_export_menu"
                            class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-200px py-4"
                            data-kt-menu="true">
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link px-3" data-kt-user-export="copy">{{
                                    __('sub-categorie-list.copy_clipboard') }}</a>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link px-3" data-kt-user-export="excel">{{
                                    __('sub-categorie-list.export_excel') }}</a>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link px-3" data-kt-user-export="csv">{{
                                    __('sub-categorie-list.sub_categorie_list') }}</a>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link px-3" data-kt-user-export="pdf">{{
                                    __('sub-categorie-list.export_pdf') }}</a>
                            </div>
                            <!--end::Menu item-->
                        </div>
                        <!--end::Menu-->
                        <!--begin::Toolbar-->
                        <div class="d-flex justify-content-end px-3" data-kt-user-table-toolbar="base">
                            <!--begin::Add user-->
                            <a href="" type="button" class="btn btn-primary select-category" data-bs-toggle="modal"
                                data-bs-target="#create_subcategory">
                                <i class="ki-duotone ki-plus fs-2"></i>{{ __('sub-categorie-list.add_sub_categorie')
                                }}</a>
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
                            id="kt_sub_category_report_views_table">
                            <thead>
                                <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                    <th class="w-10px pe-2">
                                        <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                            <input class="form-check-input" data-kt-check="true"
                                                data-kt-check-target="#kt_table_sub_categories .form-check-input"
                                                type="checkbox" value="" name="all-subcategory" id="all-subcategory" />
                                        </div>
                                    </th>
                                    <th class="min-w-125px">{{ __('sub-categorie-list.id') }}</th>
                                    <th class="min-w-125px">{{ __('sub-categorie-list.sub_categorie_name') }}</th>
                                    <th class="min-w-125px">{{ __('sub-categorie-list.categorie_name') }}</th>
                                    <th class="text-end min-w-100px">{{ __('sub-categorie-list.action') }}</th>

                                </tr>
                            </thead>
                            <tbody class="text-gray-600 fw-semibold" id="subcategory-tbody">

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
<!--Begin::Category Create Modal-->
<div class="modal fade" id="create_subcategory" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-950px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <div class="modal-header" id="kt_modal_create_subcategory_header">
                <!--begin::Modal title-->
                <h2 class="fw-bold">{{ __('sub-categorie-list.add_sub_categorie') }}</h2>
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
            <!--begin::Category added Form-->
            <form id="subcategory_add_form" method="post" class="form m-7" action="">
                @csrf
                <!--begin::Scroll-->
                <div class="d-flex flex-column scroll-y me-n7 pe-7">
                    <!--begin::Input group-->
                    <div class="fv-row mb-7">
                        <!--begin::Label-->
                        <label class="required fw-semibold fs-6 mb-2">{{ __('sub-categorie-list.sub_categorie_name')
                            }}</label>
                        <!--end::Label-->
                        <!--begin::First Name-->
                        <input type="text" placeholder="{{ __('sub-categorie-list.sub_categorie_name_ph') }}"
                            type="text" id="subcategory" name="name" autocomplete="off"
                            class="form-control form-control-solid mb-3 mb-lg-0" value="" />
                        <span class="text-danger form-message-error-name">

                        </span>
                        <!--end::First Name-->
                    </div>

                    <div class='separator separator-dashed my-5'></div>
                    <!--begin::Input group-->
                    <div class="d-flex flex-column mb-7 fv-row">
                        <!--begin::Label-->
                        <label class="fs-6 fw-semibold mb-2">
                            <span>{{ __('sub-categorie-list.categories') }}</span>
                            <span class="ms-1" data-bs-toggle="tooltip" title="Course Category">
                                <i class="ki-duotone ki-information fs-7">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                </i>
                            </span>
                        </label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <select name="category_id" aria-label="Select Course Category" data-control="select2"
                            data-placeholder="Select Course Category" class="form-select form-select-solid "
                            data-dropdown-parent="#subcategory_add_form" id="category_id">
                        </select>
                        <span class="text-danger form-message-error-category_id"></span>
                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->
                </div>
                <!--end::Scroll-->
                <!--begin::Actions-->
                <div class="text-center pt-15">
                    <a href="#" type="reset" class="btn btn-light me-3" data-bs-dismiss="modal"
                        data-kt-users-modal-action="cancel">{{ __('sub-categorie-list.discard') }}</a>
                    <button type="submit" class="btn btn-primary">
                        <span class="indicator-label">{{ __('sub-categorie-list.submit') }}</span>
                        <span class="indicator-progress">Please wait...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                </div>
                <!--end::Actions-->
            </form>
            <!--Category added end::Form-->

        </div>
    </div>
</div>
<!--End::Category Create Modal-->
<!--Start::Category Update Modal-Content-->
<div class="modal fade" id="edit_subcategory" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-950px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <div class="modal-header" id="kt_modal_update_subcategory_header">
                <!--begin::Modal title-->
                <h2 class="fw-bold">{{ __('sub-categorie-list.sub_categorie-edit') }}</h2>
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
            <!--begin::Category added Form-->
            <form id="subcategory_edit_form" method="post" class="form m-7" action="">
                @csrf
                @method('PATCH')
                <!--begin::Scroll-->
                <div class="d-flex flex-column scroll-y me-n7 pe-7">
                    <!--begin::Input group-->
                    <div class="fv-row mb-7">
                        <!--begin::Label-->
                        <label class="required fw-semibold fs-6 mb-2">{{ __('sub-categorie-list.sub_categorie_name')
                            }}</label>
                        <!--end::Label-->
                        <input type="hidden" name="subcategory_id" id="subcategrory_id" value="" />
                        <!--begin::First Name-->
                        <input type="text" placeholder="{{ __('sub-categorie-list.sub_categorie_name_ph') }}"
                            type="text" id="name" name="name" autocomplete="off"
                            class="form-control form-control-solid mb-3 mb-lg-0" value="" />
                        <span class="text-danger form-message-error-name">

                        </span>
                        <!--end::First Name-->
                    </div>

                    <div class='separator separator-dashed my-5'></div>

                    <!--begin::Input group-->
                    <div class="d-flex flex-column mb-7 fv-row">
                        <!--begin::Label-->
                        <label class="fs-6 fw-semibold mb-2">
                            <span>{{ __('sub-categorie-list.categories') }}</span>
                            <span class="ms-1" data-bs-toggle="tooltip" title="Course Category">
                                <i class="ki-duotone ki-information fs-7">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                </i>
                            </span>
                        </label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <select name="category_id" aria-label="Select Course Category" data-control="select2"
                            data-placeholder="Select Course Category" class="form-select form-select-solid "
                            data-dropdown-parent="#subcategory_edit_form" id="category_id">
                        </select>
                        <span class="text-danger form-message-error-category_id"></span>
                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->
                </div>
                <!--end::Scroll-->
                <!--begin::Actions-->
                <div class="text-center pt-15">
                    <a href="#" type="reset" data-bs-dismiss="modal" class="btn btn-light me-3"
                        data-kt-users-modal-action="cancel">{{ __('sub-categorie-list.discard') }}</a>
                    <button type="submit" class="btn btn-primary">
                        <span class="indicator-label">{{ __('sub-categorie-list.submit') }}</span>
                        <span class="indicator-progress">Please wait...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                </div>
                <!--end::Actions-->
            </form>
            <!--Category added end::Form-->

        </div>
    </div>
</div>
<!--End::Category Update Modal-->
@section('scripts')
<!--begin::Custom Javascript(used for this page only)-->
<script src="{{ asset('assets/dist/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
<script src="{{ asset('assets/dist/assets/js/custom/apps/user-management/users/list/export-users.js') }}"></script>
<script src="{{ asset('assets/dist/assets/js/custom/pages/user/general.js') }}"></script>

<script>
    let subcategoryTbody = $("#subcategory-tbody");
        $(document).ready(function() {
            const link = api_baseurl + "subcategories";
            $.ajax({
                type: "GET",
                url: link,
                headers: {
                    Authorization: authToken,
                },
                success: function(results) {
                    // Handle the successful response here
                    // console.log(results.data);
                    let allSubCategories = results.data;
                    sessionStorage.removeItem('message');
                    if (allSubCategories.length > 0) {
                        $.each(allSubCategories, function(index, subcategory) {
                            let subcategoryTr = `
                                <tr>
                                    <td>
                                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                                            <input class="form-check-input subcategory-item" type="checkbox" name="subcategoryId"
                                                value="${subcategory.id}" />
                                        </div>
                                    </td>
                                    <td>                                        
                                        ${subcategory.id}
                                    </td>
                                    <td class="d-flex align-items-center">
                                        <!--begin::User details-->
                                        <div class="d-flex flex-column">
                                            <a href="#" class="text-gray-800 text-hover-primary mb-1">
                                                ${subcategory.name}
                                            </a>
                                            <span></span>
                                        </div>
                                        <!--begin::category details-->
                                    </td>
                                    <td>
                                                ${subcategory.category.name}
                                    </td>
                                    
                                    <td class="text-end">
                                        <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 show-action" 
                                        data-subcategory-id="${subcategory.id}">
                                            <i class="ki-duotone ki-switch fs-2">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </a>
                                        <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 editSubCategory" 
                                        data-subcategory-id="${subcategory.id}" data-bs-toggle="modal" data-bs-target="#edit_subcategory">
                                            <i class="ki-duotone ki-pencil fs-2">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </a>
                                        <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm delete-subcategory" 
                                        data-subcategory-id="${subcategory.id}" data-subcategory-name="${subcategory.name}">
                                            <i class="ki-duotone ki-trash fs-2">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                                <span class="path4"></span>
                                                <span class="path5"></span>
                                            </i>
                                        </a>
                                    </td>
                                </tr>
                            `;

                            subcategoryTbody.append(subcategoryTr);
                        });
                    } else {
                        subcategoryTbody.innerHTML = `
                            <tr>
                                <td class="w-100">No Sub Category Found</td>
                            </tr>                            
                        `;
                    }
                },
                error: function(xhr, status, error) {
                    // Handle errors here
                    console.error(xhr, status, error);
                }
            });

            $('[name="all-subcategory"]').on('click', function() {
                if ($(this).is(':checked')) {
                    $.each($('.subcategory-item'), function() {
                        $(this).prop('checked', true);
                    });
                } else {
                    $.each($('.subcategory-item'), function() {
                        $(this).prop('checked', false);
                    });
                }
            });


        });
</script>
@endsection
@endsection