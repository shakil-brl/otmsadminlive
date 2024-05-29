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
                        {{ __('roles-permissions.edit_role') }}
                    </h1>
                    <!--end::Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('home.index') }}"
                                class="text-muted text-hover-primary">{{ __('division-list.home') }}</a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">{{ __('sidemenu.user_management') }}</li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="" class="text-muted text-hover-primary"> {{ __('sidemenu.role_list') }}</a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="" class="text-muted text-hover-primary">
                                {{ __('roles-permissions.edit_role') }}</a>
                        </li>
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
                <div id="success_message"></div>
                <!--begin::Row-->
                <div class="row g-5 g-xl-9">

                    <!--begin::Col-->
                    <div class="col-md-12">
                        <!--begin::Card-->
                        <div class="card card-flush h-md-100">
                            <!--begin::Card header-->
                            <div class="card-header">
                                <!--begin::Card title-->
                                <div class="card-title">

                                </div>
                                <!--end::Card title-->
                            </div>
                            <!--end::Card header-->
                            <!--begin::Card body-->
                            <div class="card-body pt-1">
                                <div class="modal-body mx-5 my-1">
                                    @if (count($errors) > 0)
                                        <div class="alert alert-danger">
                                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    <form id="kt_modal_update_role_form" method="POST" action="#">
                                        @method('patch')
                                        @csrf
                                        <div class="d-flex flex-column me-n7 pe-7" id="kt_modal_create_role_scroll">
                                            <!--begin::Input group-->
                                            <div class="fv-row mb-10">
                                                <input type="hidden" value="{{ $id }}" />
                                                <!--begin::Label-->
                                                <label class="fs-5 fw-bold form-label mb-2">
                                                    <span class="required">{{ __('roles-permissions.role_name') }}</span>
                                                </label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input class="form-control form-control-solid"
                                                    placeholder="{{ __('roles-permissions.role_name_ph') }}" name="name"
                                                    id="name" value="" required />
                                                <span class="text-danger form-message-error-name">

                                                </span>

                                                <!--end::Input-->
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Permissions-->
                                            <div class="fv-row">
                                                <!--begin::Label-->
                                                <label
                                                    class="fs-5 fw-bold form-label mb-2">{{ __('roles-permissions.role_permission') }}</label>
                                                <span class="required"></span>
                                                <!--end::Label-->
                                                <!--begin::Table wrapper-->
                                                <div class="table-responsive">
                                                    <!--begin::Table-->
                                                    <table class="table align-middle table-row-dashed fs-6 gy-5">
                                                        <!--begin::Table body-->
                                                        <thead>
                                                            <tr>
                                                                <td>
                                                                    <!--begin::Checkbox-->
                                                                    <label
                                                                        class="form-check form-check-sm form-check-custom form-check-solid me-9">
                                                                        <input class="form-check-input" type="checkbox"
                                                                            data-kt-check="true" value=""
                                                                            id="kt_roles_select_all"
                                                                            data-kt-check-target="#kt_table_permissions .form-check-input"
                                                                            name="all_permission" id="all_permission" />
                                                                        <span class="form-check-label"
                                                                            for="kt_roles_select_all">{{ __('roles-permissions.all') }}</span>
                                                                    </label>
                                                                    <!--end::Checkbox-->
                                                                </td>
                                                                <td class="text-gray-800">
                                                                    {{ __('roles-permissions.administration_access') }}
                                                                    <span class="ms-1" data-bs-toggle="tooltip"
                                                                        title="Allows a full access to the system">
                                                                    </span>
                                                                    <span class="ms-1 text-danger">
                                                                        @error('permission')
                                                                            {{ $message }}
                                                                        @enderror
                                                                    </span>
                                                                </td>
                                                            </tr>
                                                            <th></th>
                                                            <th class="fw-bold">
                                                                {{ __('roles-permissions.access_route') }}
                                                            </th>
                                                            <th class="fw-bold">
                                                                {{ __('roles-permissions.route_path') }}
                                                            </th>
                                                            <th class="fw-bold">
                                                                {{ __('roles-permissions.guard') }}
                                                            </th>
                                                        </thead>
                                                        <tbody class="text-gray-600 fw-semibold" id="rolepermission">

                                                        </tbody>
                                                        <!--end::Table body-->
                                                    </table>
                                                    <!--end::Table-->
                                                </div>
                                                <!--end::Table wrapper-->
                                            </div>
                                            <!--end::Permissions-->
                                        </div>
                                        <!--end::Scroll-->
                                        <!--begin::Actions-->
                                        <div class="text-center pt-15">
                                            <a href="{{ route('role.index') }}" class="btn btn-light me-3"
                                                data-kt-roles-modal-action="cancel">{{ __('roles-permissions.discard') }}</a>
                                            <button type="submit" class="btn btn-primary" id="access-role-permission">
                                                <span class="indicator-label">{{ __('roles-permissions.update') }}</span>
                                            </button>
                                        </div>
                                        <!--end::Actions-->
                                    </form>
                                </div>
                            </div>

                        </div>
                        <!--end::Card-->
                    </div>
                    <!--end::Col-->
                </div>
            </div>
            <!--end::Content container-->
        </div>
        <!--end::Content-->
    </div>

@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            let id = {{ $id }};
            let permissionTbody = $("#rolepermission");
            let url_link = api_baseurl + "role/" + id + "/edit";
            $.ajax({
                url: url_link,
                type: "GET",
                data: {},
                headers: {
                    Authorization: authToken,
                    "X-localization": language,
                },
                success: function(item) {
                    let roles = item.data;

                    $("#kt_modal_update_role_form #name").val(roles["name"]);
                    let rolePermissions = item.permissions;
                    let rolePermissionArr = item.rolePermissions;
                    sessionStorage.removeItem("message");
                    if (rolePermissions.length > 0) {
                        $.each(rolePermissions, function(index, permission) {
                            let permissionTr = `
                                <tr>
                                    <td>
                                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                                            <input class="form-check-input permission-item" type="checkbox" name="permissionId"
                                                value="${permission.id}"  data-permission-id="${permission.id}"
                                                ${rolePermissionArr.includes(permission.name) ? 'checked' : ''}
                                                />
                                        </div>
                                    </td>
                                    <td>                                      
                                        ${permission.name}
                                    </td>

                                    <td>                                       
                                        ${permission.route_name}
                                    </td>

                                    <td>                                        
                                        ${permission.guard_name}
                                    </td>                                    
                                </tr>
                            `;

                            permissionTbody.append(permissionTr);
                        });
                    } else {
                        permissionTbody.innerHTML = `
                            <tr>
                                <td class="w-100"> No data found</td>
                            </tr>                            
                        `;
                    }
                    setAlreadySelectedIds();
                },
            });

            let accessPermissionIds = [];

            function setAlreadySelectedIds() {
                $('.permission-item:checked').each(function() {
                    var permissionId = $(this).data("permission-id");
                    if (permissionId) {
                        accessPermissionIds.push(permissionId);
                    }
                });
            }

            function setAccessPermissionIds() {
                accessPermissionIds = [];
                $(".permission-item").each(function() {
                    var permissionId = $(this).data("permission-id");
                    if (permissionId) {
                        accessPermissionIds.push(permissionId);
                    }
                });

                console.log(accessPermissionIds);
            }

            function setAccessPermissionId(permissionElement) {
                var permissionId = $(permissionElement).data("permission-id");

                if (permissionId) {
                    accessPermissionIds.push(permissionId);
                }
                console.log(accessPermissionIds);
            }

            function removeAccessPermissionId(permissionElement) {
                var permissionId = $(permissionElement).data("permission-id");
                var index = accessPermissionIds.indexOf(permissionId);
                if (index !== -1) {
                    accessPermissionIds.splice(index, 1);
                }
                console.log(accessPermissionIds);
            }

            // Add a click event handler to individual user checkboxes
            $(document).on("click", ".permission-item", function() {
                if ($(this).is(":checked")) {
                    setAccessPermissionId(this);
                } else {
                    removeAccessPermissionId(this);
                }
            });
            $('[name="all_permission"]').on('click', function() {

                if ($(this).is(':checked')) {
                    $.each($('.permission-item'), function() {
                        $(this).prop('checked', true);
                    });
                    setAccessPermissionIds();
                } else {
                    $.each($('.permission-item'), function() {
                        $(this).prop('checked', false);
                    });
                    accessPermissionIds = [];
                }

            });


            $("#kt_modal_update_role_form").submit(function(e) {
                e.preventDefault();
                Swal.fire({
                    title: "Are you sure?",
                    text: "Do you want to submit this form?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, Submit",
                }).then((result) => {
                    if (result.isConfirmed) {
                        console.log(accessPermissionIds);
                        let fd = new FormData();
                        let CSRF_TOKEN = $('meta[name="csrf-token"]').attr("content");
                        let roleId = {{ $id }};
                        let url_link = api_baseurl + "role/" + roleId + "/update";
                        let name = $("#kt_modal_update_role_form [name=name]").val();
                        fd.append("name", name);
                        fd.append("roleId", roleId);
                        fd.append("accessPermissionIds", accessPermissionIds);
                        fd.append("_token", CSRF_TOKEN);
                        fd.append("_method", "patch");
                        $.ajax({
                            headers: {
                                Authorization: authToken,
                            },
                            type: "POST",
                            data: fd,
                            dataType: "JSON",
                            cache: false,
                            contentType: false,
                            processData: false,
                            url: url_link,
                            success: function(results) {
                                console.log(results);

                                if (results.success === true) {
                                    swal.fire(
                                        "Success:",
                                        "Role and permission update Successfully!"
                                    );
                                    // refresh page after 2 seconds
                                    setTimeout(function() {
                                        location.reload();
                                    }, 2000);

                                    $.ajax({
                                        type: 'post',
                                        url: "/store-auth-user",
                                        data: {
                                            authUser: authUserInfo,
                                            authStatus: authStatus,
                                            rolePermission: rolePermissionInfo,
                                            '_token': CSRF_TOKEN
                                        },
                                        success: function(response) {}
                                    });
                                    // end code
                                    // refresh page after 2 seconds
                                    setTimeout(function() {
                                        location.reload();
                                    }, 2000);
                                } else {
                                    if (results.error === true) {
                                        var errors = results.message;
                                        swal.fire("Error: ", errors);
                                    }
                                    // refresh page after 2 seconds
                                    setTimeout(function() {
                                        location.reload();
                                    }, 2000);
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error(xhr, status, error);
                            },
                        });
                    }
                });
            });

        });
    </script>
@endsection
