@extends('layouts.auth-master')



@section('content')
    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <!--begin::Toolbar container-->
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                <!--begin::Page title-->
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <!--begin::Title-->
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                        Permissions List</h1>
                    <!--end::Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="{{route('home.index')}}" class="text-muted text-hover-primary">Home</a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">User Management</li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="" class="text-muted text-hover-primary">Permission List</a>
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
                <div class="card card-flush">
                    <!--begin::Card header-->
                    <div class="card-header mt-6">
                        <!--begin::Card title-->
                        <div class="card-title">
                            <!--begin::Search-->
                            <div class="d-flex align-items-center position-relative my-1 me-5">
                                <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                                <input type="text" data-kt-permissions-table-filter="search"
                                    class="form-control form-control-solid w-250px ps-13"
                                    placeholder="Search Permissions" />
                            </div>
                            <!--end::Search-->
                        </div>
                        <!--end::Card title-->
                        <!--begin::Card toolbar-->
                        <div class="card-toolbar">
                            <!--begin::Button-->
                            <a href="{{ route('permissions.create') }}" type="button" class="btn btn-light-primary">
                                <i class="ki-duotone ki-plus-square fs-3">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                </i>Add Permission</a>
                            <!--end::Button-->
                        </div>
                        <!--end::Card toolbar-->
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body pt-0">
                        <!--begin::Table-->
                        <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0" id="kt_permissions_table">
                            <thead>
                                <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                    <th class="min-w-125px">Name</th>
                                    <th class="min-w-250px">Assigned to</th>
                                    <th class="min-w-125px">Created Date</th>
                                    <th class="text-end min-w-100px">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="fw-semibold text-gray-600">
                                @foreach ($permissions as $permission)
                                    <tr>
                                        <td>{{ $permission->name }}</td>
                                        <td>
                                            @isset($permission->roles)
                                                @empty(!$permission->roles)
                                                    @foreach ($permission->roles as $role)
                                                        <div class="d-flex align-items-center py-2">
                                                            <span class="bullet bg-primary me-3"></span>{{ $role->name }}
                                                        </div>
                                                    @endforeach
                                                @endempty
                                            @endisset
                                        </td>
                                        <td>{{ $permission->created_at }}</td>
                                        <td class="text-end">

                                            <a href="{{ route('permissions.edit', $permission->id) }}"
                                                class="btn btn-icon btn-active-light-primary w-30px h-30px me-3">
                                                <i class="ki-duotone ki-setting-3 fs-3">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                    <span class="path3"></span>
                                                    <span class="path4"></span>
                                                    <span class="path5"></span>
                                                </i>
                                            </a>
                                            {!! Form::open([
                                                'method' => 'DELETE',
                                                'route' => ['permissions.destroy', $permission->id],
                                                'style' => 'display:inline',
                                            ]) !!}
                                            {!! Form::submit('Delete', ['class' => 'menu-link px-3', 'style' => 'border:none']) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!--end::Table-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card-->
            </div>
            <!--end::Content container-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Content wrapper-->
@endsection

@section('scripts')
    <!--end::Vendors Javascript-->
    <!--begin::Custom Javascript(used for this page only)-->
    <script src="{{ asset('assets/dist/assets/js/custom/apps/user-management/permissions/list.js') }}"></script>
    <script src="{{ asset('assets/dist/assets/js/custom/apps/user-management/permissions/add-permission.js') }}"></script>
    <script src="{{ asset('assets/dist/assets/js/custom/apps/user-management/permissions/update-permission.js') }}">
    </script>
    <script src="{{ asset('assets/dist/assets/js/widgets.bundle.js') }}"></script>
    <script src="{{ asset('assets/dist/assets/js/custom/widgets.js') }}"></script>
    <script src="{{ asset('assets/dist/assets/js/custom/apps/chat/chat.js') }}"></script>
    <script src="{{ asset('assets/dist/assets/js/custom/utilities/modals/upgrade-plan.js') }}"></script>
    <script src="{{ asset('assets/dist/assets/js/custom/utilities/modals/create-app.js') }}"></script>
    <script src="{{ asset('assets/dist/assets/js/custom/utilities/modals/users-search.js') }}"></script>
    <!--end::Custom Javascript-->

    <script type='text/javascript'>
        $(document).ready(function() {

            $('[name="all_permission"]').on('click', function() {

                if ($(this).is(':checked')) {
                    $.each($('.permission'), function() {
                        $(this).prop('checked', true);
                    });
                } else {
                    $.each($('.permission'), function() {
                        $(this).prop('checked', false);
                    });
                }

            });


        });
    </script>

    <!--end::Javascript-->
@endsection
