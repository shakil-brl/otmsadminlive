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
                        {{ __('upazila-list.upazila_list') }}</h1>
                    <!--end::Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('home.index') }}"
                                class="text-muted text-hover-primary">{{ __('upazila-list.home') }}</a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">{{ __('upazila-list.setting_management') }}</li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="" class="text-muted text-hover-primary">{{ __('upazila-list.upazilas') }}</a>
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
                                <form>
                                    <input type="text" data-kt-user-order-filter="search" id="myInput"
                                        class="form-control form-control-solid w-250px ps-13"
                                        placeholder="{{ __('upazila-list.search_upazila') }}" name="search"
                                        value="{{ request('search') }}" />
                                </form>
                            </div>
                            <!--end::Search-->
                        </div>
                        <!--begin::Card title-->
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body py-4">
                        <div class="table-responsive">
                            <!--begin::Table-->
                            <table class="table table-responsive align-middle table-row-dashed fs-6 gy-5"
                                id="kt_upazila_report_views_table">
                                <thead>
                                    <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                        <th class="min-w-125px">S.N.</th>
                                        <th class="min-w-125px">{{ __('upazila-list.upazila_code') }}</th>
                                        <th class="min-w-125px">{{ __('upazila-list.upazila_name') }}</th>
                                        <th class="min-w-125px text-center">{{ __('upazila-list.district_name') }}</th>
                                        <th class="min-w-125px text-end">{{ __('upazila-list.division_name') }}</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-600 fw-semibold" id="upazila-tbody">

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
@section('scripts')
    <!--begin::Custom Javascript(used for this page only)-->
    <script src="{{ asset('assets/dist/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script src="{{ asset('assets/dist/assets/js/custom/apps/user-management/users/list/export-users.js') }}"></script>
    <script src="{{ asset('assets/dist/assets/js/custom/pages/user/general.js') }}"></script>

    <script>
        let upazilaTbody = $("#upazila-tbody");
        $(document).ready(function() {
            const link = api_baseurl + "upazilas";
            $.ajax({
                type: "GET",
                url: link,
                headers: {
                    Authorization: authToken,
                },
                success: function(results) {
                    // Handle the successful response here
                    console.log(results.data);
                    let allUpazilas = results.data;
                    sessionStorage.removeItem('message');
                    if (allUpazilas.length > 0) {
                        $.each(allUpazilas, function(index, upazila) {
                            let upazilaTr = `
                                <tr>
                                    <td>                                        
                                        ${index + 1}.
                                    </td>
                                    <td>                                        
                                        ${upazila.Code}
                                    </td>
                                    <td>
                                        ${upazila.NameEng ?? ''}
                                        (${upazila.Name ?? ''})
                                    </td>
                                    <td class="text-center">
                                        ${upazila.district ? upazila.district.NameEng : ''}
                                        (${upazila.district ? upazila.district.Name : ''})
                                    </td>

                                    <td class="text-end">
                                        ${upazila.district ? (upazila.district.division ? upazila.district.division.NameEng : '') : ''}
                                        (${upazila.district ? (upazila.district.division ? upazila.district.division.Name : '') : ''})
                                    </td>   
                                </tr>
                            `;

                            upazilaTbody.append(upazilaTr);
                        });
                    } else {
                        upazilaTbody.innerHTML = `
                            <tr>
                                <td class="w-100">No Upazila Found</td>
                            </tr>                            
                        `;
                    }
                    let table = $("#kt_upazila_report_views_table").DataTable();
                    $('#myInput').on('keyup', function() {
                        table.search(this.value).draw();
                    });
                },
                error: function(xhr, status, error) {
                    // Handle errors here
                    console.error(xhr, status, error);
                }
            });


        });
    </script>
@endsection
@endsection
