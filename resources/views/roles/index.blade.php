@extends('layouts.auth-master')

@section('content')
    <!--begin::Content-->
    <div class="m-5">
        {{-- <div class="d-flex justify-content-end align-items-center">
            <a class="btn btn-lg btn-success" data-bs-toggle="modal" data-bs-target="#kt_create_role"
                id="open-create-user-modal">Create Role</a>
        </div> --}}
        <h3>Role List</h3>
        <x-alert />

        @isset($results)
            <div class="my-3">
                <div class="d-none">
                    <div class="w-50 d-flex gap-3">
                        <input type="search" name="search" value="{{ request('search') }}" class="form-control w-75"
                            placeholder="Search role" id="myInput">
                        <input type="submit" class="form-control btn btn-primary w-25" value="Search">
                    </div>
                </div>
                <table class="table table-bordered bg-white" id="role-table">
                    <thead>
                        <th>S.N.</th>
                        <th>Name (English)</th>
                        <th class="text-center">Actions</th>
                    </thead>
                    <tbody id="role-tbody">
                        @if (count($results) > 0)
                            @foreach ($results ?? [] as $index => $role)
                                <tr>
                                    <td>
                                        {{ $loop->iteration }}.
                                    </td>
                                    <td>
                                        {{ $role['name'] ?? '' }}
                                    </td>
                                    <td class="me-0 d-flex gap-1 justify-content-center">
                                        <div class="btn-group" role="group" aria-label="Batch Group Actions">
                                            <a class="btn btn-sm btn-info edit-role-action" data-bs-toggle="modal"
                                                data-bs-target="#kt_update_role" id="open-upadate-user-modal"
                                                data-role-id={{ $role['id'] }}>
                                                Edit
                                            </a>
                                            <a href="{{ route('role.edit', $role['id']) }}"
                                                class="btn btn-sm btn-primary show-action">
                                                Permissions
                                            </a>
                                            {{-- <div class="btn btn-sm btn-danger delete-action">
                                                Delete
                                                <form action="{{ route('roles.destroy', $role['id']) }}" method="post"
                                                    id="deleteForm">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </div> --}}
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <td colspan="6" class="text-danger">Data Not Fount</td>
                        @endif
                    </tbody>
                </table>
            </div>
        @endisset
    </div>

    <!--Begin::Role Create Modal-->
    <div class="modal fade" id="kt_create_role" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <div class="modal-header" id="kt_modal_add_role_header">
                    <!--begin::Modal title-->
                    <h2 class="fw-bold">Create Role</h2>
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
                <div class="modal-body py-lg-5 px-lg-5">
                    <!--begin::Form-->
                    <form id="kt_modal_add_role_form" method="post" class="form m-5" action="">
                        @csrf
                        <!--begin::Scroll-->
                        <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_role_scroll"
                            data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}"
                            data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_role_header"
                            data-kt-scroll-wrappers="#kt_modal_add_role_scroll" data-kt-scroll-offset="300px">

                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="required fw-semibold fs-6 mb-2">Name:</label>
                                <!--end::Label-->

                                <!--begin::Name-->
                                <input type="text" placeholder="role name" id="name" name="name"
                                    autocomplete="off" class="form-control form-control-solid mb-3 mb-lg-0"
                                    value="" />
                                <span class="form-message-error-name">

                                </span>
                                <!--end::Name-->
                            </div>
                            <!--end::Input group-->
                        </div>
                        <!--end::Scroll-->
                        <!--begin::Actions-->
                        <div class="text-center pt-5">
                            <a href="" type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">Discard</a>
                            <button type="submit" class="btn btn-primary show-loader">
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
    <!--End::Role Create Modal-->

    <!--Begin::Role Update Modal-->
    <div class="modal fade" id="kt_update_role" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <div class="modal-header" id="kt_modal_update_role_header">
                    <!--begin::Modal title-->
                    <h2 class="fw-bold">Edit Role</h2>
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
                <div class="modal-body py-lg-5 px-lg-5">
                    <!--begin::Form-->
                    <form id="kt_modal_update_role_form" method="post" class="form m-5" action="">
                        @csrf
                        <!--begin::Scroll-->
                        <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_update_role_scroll"
                            data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}"
                            data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_update_role_header"
                            data-kt-scroll-wrappers="#kt_modal_update_role_scroll" data-kt-scroll-offset="300px">

                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <input type="hidden" name="role_id">
                                <!--begin::Label-->
                                <label class="required fw-semibold fs-6 mb-2">Name:</label>
                                <!--end::Label-->

                                <!--begin::Name-->
                                <input type="text" placeholder="role name" id="name" name="name"
                                    autocomplete="off" class="form-control form-control-solid mb-3 mb-lg-0"
                                    value="" />
                                <span class="form-message-error-name">

                                </span>
                                <!--end::Name-->
                            </div>
                            <!--end::Input group-->
                        </div>
                        <!--end::Scroll-->
                        <!--begin::Actions-->
                        <div class="text-center pt-5">
                            <a href="" type="reset" class="btn btn-light me-3"
                                data-bs-dismiss="modal">Discard</a>
                            <button type="submit" class="btn btn-primary show-loader">
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
    <!--End::Role Create Modal-->
@section('scripts')
    <script>
        $(document).ready(function() {
            let roleTbody = $("#role-tbody");
            let table = $("#role-table").DataTable();
            $('#myInput').on('keyup', function() {
                table.search(this.value).draw();
            });


            // add role form submit
            $("#kt_modal_add_role_form").submit(function(e) {
                e.preventDefault();

                Swal.fire({
                    title: "Are you sure",
                    text: "You want to submit the form?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, Submit",
                }).then((result) => {
                    if (result.isConfirmed) {
                        let fd = new FormData();
                        let CSRF_TOKEN = $('meta[name="csrf-token"]').attr("content");
                        let api_link = api_baseurl + "roles";
                        let name = $("#kt_modal_add_role_form [name=name]").val();

                        fd.append("name", name);
                        fd.append("_token", CSRF_TOKEN);

                        $.ajax({
                            type: "post",
                            url: api_link,
                            data: fd,
                            dataType: "JSON",
                            cache: false,
                            contentType: false,
                            processData: false,
                            headers: {
                                Authorization: authToken,
                            },
                            success: function(results) {
                                if (results.success === true) {
                                    swal.fire("Successfully Created!", results.data);
                                    // refresh page after 2 seconds
                                    setTimeout(function() {
                                        location.reload();
                                    }, 2000);
                                } else {
                                    if (results.error === true) {
                                        var errors = "Validation Error Occurs!!";

                                        swal.fire("", errors);

                                        // function display error message
                                        function displayErrorMessage(
                                            fieldName,
                                            errorMessage
                                        ) {
                                            const errorMessageSelector =
                                                `#kt_modal_add_role_form .form-message-error-${fieldName}`;
                                            $(errorMessageSelector)
                                                .html(errorMessage)
                                                .addClass("text-danger")
                                                .fadeIn(2000);
                                            setTimeout(() => {
                                                $(errorMessageSelector)
                                                    .html("")
                                                    .removeClass(
                                                        "text-danger")
                                                    .fadeOut();
                                            }, 5000);
                                        }

                                        // Define an array of field names you want to handle
                                        const fieldsToHandle = [
                                            "name"
                                        ];

                                        // Usage example for multiple fields
                                        fieldsToHandle.forEach((fieldName) => {
                                            if (results.message[
                                                    fieldName]) {
                                                displayErrorMessage(
                                                    fieldName,
                                                    results.message[
                                                        fieldName][0]
                                                );
                                            }
                                        });
                                    } else {
                                        var errors = results.message ??
                                            "something wrong!";

                                        swal.fire("", errors);
                                    }
                                }
                            },
                            error: function(response) {
                                console.log(response);
                            },
                        });
                    }
                });
            });

            roleTbody.on("click", ".edit-role-action", function(e) {
                e.preventDefault();

                let roleId = $(this).data("role-id");
                let api_link = api_baseurl + "roles/" + roleId;
                $.ajax({
                    type: "get",
                    url: api_link,
                    headers: {
                        Authorization: authToken,
                    },
                    data: {},
                    dataType: "JSON",
                    success: function(results) {
                        let nameField = $('#kt_modal_update_role_form [name="name"]');
                        nameField.val("");
                        let role = results.data;
                        console.log(role);
                        if (role) {
                            nameField.val(role.name);
                            $('#kt_modal_update_role_form [name=role_id]').val(roleId)
                        }
                    },
                    error: function(response) {
                        console.log(response);
                    },
                });

            });

            // update role form submit
            $("#kt_modal_update_role_form").submit(function(e) {
                let roleId = $('#kt_modal_update_role_form [name=role_id]').val();

                e.preventDefault();

                Swal.fire({
                    title: "Are you sure",
                    text: "You want to submit the form?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, Submit",
                }).then((result) => {
                    if (result.isConfirmed) {
                        let fd = new FormData();
                        let CSRF_TOKEN = $('meta[name="csrf-token"]').attr("content");
                        let api_link = api_baseurl + "roles/" + roleId;
                        let name = $("#kt_modal_update_role_form [name=name]").val() ?? '';

                        fd.append("name", name);
                        fd.append("_token", CSRF_TOKEN);
                        fd.append("_method", "patch");

                        $.ajax({
                            type: "POST",
                            url: api_link,
                            data: fd,
                            dataType: "JSON",
                            cache: false,
                            contentType: false,
                            processData: false,
                            headers: {
                                Authorization: authToken,
                            },
                            success: function(results) {
                                if (results.success === true) {
                                    swal.fire("Successfully Updated!", results.data);
                                    // refresh page after 2 seconds
                                    setTimeout(function() {
                                        location.reload();
                                    }, 2000);
                                } else {
                                    if (results.error === true) {
                                        var errors = "Validation Error Occurs!!";

                                        swal.fire("", errors);

                                        // function display error message
                                        function displayErrorMessage(
                                            fieldName,
                                            errorMessage
                                        ) {
                                            const errorMessageSelector =
                                                `#kt_modal_update_role_form .form-message-error-${fieldName}`;
                                            $(errorMessageSelector)
                                                .html(errorMessage)
                                                .addClass("text-danger")
                                                .fadeIn(2000);
                                            setTimeout(() => {
                                                $(errorMessageSelector)
                                                    .html("")
                                                    .removeClass(
                                                        "text-danger")
                                                    .fadeOut();
                                            }, 5000);
                                        }

                                        // Define an array of field names you want to handle
                                        const fieldsToHandle = [
                                            "name"
                                        ];

                                        // Usage example for multiple fields
                                        fieldsToHandle.forEach((fieldName) => {
                                            if (results.message[
                                                    fieldName]) {
                                                displayErrorMessage(
                                                    fieldName,
                                                    results.message[
                                                        fieldName][0]
                                                );
                                            }
                                        });
                                    } else {
                                        var errors = results.message ??
                                            "something wrong!";

                                        swal.fire("", errors);
                                    }
                                }
                            },
                            error: function(response) {
                                console.log(response);
                            },
                        });
                    }
                });
            });

            $(document).on("click", ".delete-action", function(e) {
                e.preventDefault();
                const form = $(this).find('form');

                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!",
                    cancelButtonText: "No, cancel!",
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
@endsection
@endsection
