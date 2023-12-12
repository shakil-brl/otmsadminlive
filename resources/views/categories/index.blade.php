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
                    {{__('categorie-list.categorie_list')}}</h1>
                <!--end::Title-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route('home.index') }}"
                            class="text-muted text-hover-primary">{{__('categorie-list.home')}}</a>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">{{__('categorie-list.Setting_management')}}</li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        <a href="" class="text-muted text-hover-primary">{{__('categorie-list.categorie')}}</a>
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
                                    placeholder="{{__('categorie-list.search_category_ph')}}" name="search"
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
                            </i>{{__('categorie-list.export_report')}}</button>
                        <!--begin::Menu-->
                        <div id="kt_user_report_views_export_menu"
                            class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-200px py-4"
                            data-kt-menu="true">
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link px-3"
                                    data-kt-user-export="copy">{{__('categorie-list.copy_clipboard')}}</a>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link px-3"
                                    data-kt-user-export="excel">{{__('categorie-list.export_excel')}}</a>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link px-3"
                                    data-kt-user-export="csv">{{__('categorie-list.export_csv')}}</a>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link px-3"
                                    data-kt-user-export="pdf">{{__('categorie-list.export_pdf')}}</a>
                            </div>
                            <!--end::Menu item-->
                        </div>
                        <!--end::Menu-->
                        <!--begin::Toolbar-->
                        <div class="d-flex justify-content-end px-3" data-kt-user-table-toolbar="base">
                            <!--begin::Add user-->
                            <a href="" type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#create_category">
                                <i class="ki-duotone ki-plus fs-2"></i>{{__('categorie-list.add_categorie')}}</a>
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
                            id="kt_category_report_views_table">
                            <thead>
                                <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                    <th class="w-10px pe-2">
                                        <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                            <input class="form-check-input" data-kt-check="true"
                                                data-kt-check-target="#kt_table_categories .form-check-input"
                                                type="checkbox" value="" name="all-category" id="all-category" />
                                        </div>
                                    </th>
                                    <th class="min-w-125px">{{__('categorie-list.id')}}</th>
                                    <th class="min-w-125px">{{__('categorie-list.categorie_name')}}</th>
                                    <th class="text-end min-w-100px">{{__('categorie-list.action')}}</th>

                                </tr>
                            </thead>
                            <tbody class="text-gray-600 fw-semibold" id="category-tbody">

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
<div class="modal fade" id="create_category" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-950px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <div class="modal-header" id="kt_modal_create_category_header">
                <!--begin::Modal title-->
                <h2 class="fw-bold">{{__('categorie-list.categorie_add')}}</h2>
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
            <form id="category_add_form" method="post" class="form m-7" action="">
                @csrf
                <!--begin::Scroll-->
                <div class="d-flex flex-column scroll-y me-n7 pe-7">
                    <!--begin::Input group-->
                    <div class="fv-row mb-7">
                        <!--begin::Label-->
                        <label class="required fw-semibold fs-6 mb-2">{{__('categorie-list.categorie_name')}}</label>
                        <!--end::Label-->
                        <!--begin::First Name-->
                        <input type="text" placeholder="{{__('categorie-list.categorie_name_ph')}}" type="text"
                            id="category" name="name" autocomplete="off"
                            class="form-control form-control-solid mb-3 mb-lg-0" value="" />
                        <span class="text-danger form-message-error-name">

                        </span>
                        <!--end::First Name-->
                    </div>

                    <div class='separator separator-dashed my-5'></div>
                </div>
                <!--end::Scroll-->
                <!--begin::Actions-->
                <div class="text-center pt-15">
                    <a href="#" type="reset" class="btn btn-light me-3" data-bs-dismiss="modal"
                        data-kt-users-modal-action="cancel">{{__('categorie-list.discard')}}</a>
                    <button type="submit" class="btn btn-primary">
                        <span class="indicator-label">{{__('categorie-list.submit')}}</span>
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
<div class="modal fade" id="edit_category" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-950px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <div class="modal-header" id="kt_modal_update_category_header">
                <!--begin::Modal title-->
                <h2 class="fw-bold">{{__('categorie-list.category_edit')}}</h2>
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
            <form id="category_edit_form" method="post" class="form m-7" action="">
                @csrf
                @method('PATCH')
                <!--begin::Scroll-->
                <div class="d-flex flex-column scroll-y me-n7 pe-7">
                    <!--begin::Input group-->
                    <div class="fv-row mb-7">
                        <!--begin::Label-->
                        <label class="required fw-semibold fs-6 mb-2">{{__('categorie-list.categorie_name')}}</label>
                        <!--end::Label-->
                        <input type="hidden" name="category_id" id="categrory_id" value="" />
                        <!--begin::First Name-->
                        <input type="text" placeholder="{{__('categorie-list.categorie_name')}}" type="text" id="name"
                            name="name" autocomplete="off" class="form-control form-control-solid mb-3 mb-lg-0"
                            value="" />
                        <span class="text-danger form-message-error-name">

                        </span>
                        <!--end::First Name-->
                    </div>

                    <div class='separator separator-dashed my-5'></div>
                </div>
                <!--end::Scroll-->
                <!--begin::Actions-->
                <div class="text-center pt-15">
                    <a href="#" type="reset" data-bs-dismiss="modal" class="btn btn-light me-3"
                        data-kt-users-modal-action="cancel">{{__('categorie-list.discard')}}</a>
                    <button type="submit" class="btn btn-primary">
                        <span class="indicator-label">{{__('categorie-list.update')}}</span>
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
    let categoryTbody = $("#category-tbody");
        $(document).ready(function() {
            const link = api_baseurl + "categories";
            $.ajax({
                type: "GET",
                url: link,
                headers: {
                    Authorization: authToken,
                },
                success: function(results) {
                    // Handle the successful response here
                    console.log(results.data);
                    let allCategories = results.data;
                    sessionStorage.removeItem('message');
                    if (allCategories.length > 0) {
                        $.each(allCategories, function(index, category) {
                            let categoryTr = `
                                <tr>
                                    <td>
                                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                                            <input class="form-check-input category-item" type="checkbox" name="categoryId"
                                                value="${category.id}" />
                                        </div>
                                    </td>
                                    <td>                                        
                                        ${category.id}
                                    </td>
                                    <td class="d-flex align-items-center">
                                        <!--begin::User details-->
                                        <div class="d-flex flex-column">
                                            <a href="#" class="text-gray-800 text-hover-primary mb-1">
                                                ${category.name}
                                            </a>
                                            <span></span>
                                        </div>
                                        <!--begin::category details-->
                                    </td>
                                    
                                    <td class="text-end">
                                        <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 show-action" 
                                        data-category-id="${category.id}">
                                            <i class="ki-duotone ki-switch fs-2">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </a>
                                        <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 editCategory" 
                                        data-category-id="${category.id}" data-bs-toggle="modal" data-bs-target="#edit_category">
                                            <i class="ki-duotone ki-pencil fs-2">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </a>
                                        <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm  delete-category" 
                                        data-category-id="${category.id}" data-category-name="${category.name}">
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

                            categoryTbody.append(categoryTr);
                        });
                    } else {
                        categoryTbody.innerHTML = `
                            <tr>
                                <td class="w-100">No Category Found</td>
                            </tr>                            
                        `;
                    }
                },
                error: function(xhr, status, error) {
                    // Handle errors here
                    console.error(xhr, status, error);
                }
            });

            $('[name="all-category"]').on('click', function() {
                if ($(this).is(':checked')) {
                    $.each($('.category-item'), function() {
                        $(this).prop('checked', true);
                    });
                } else {
                    $.each($('.category-item'), function() {
                        $(this).prop('checked', false);
                    });
                }
            });


        });
</script>
@endsection
@endsection