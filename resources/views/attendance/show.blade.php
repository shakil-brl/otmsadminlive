@extends('layouts.auth-master')

@section('content')
<!--begin::Content-->
<div id="kt_app_content" class="app-content flex-column-fluid">
    <!--begin::Main-->
    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
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
                            Class Attendance
                        </h1>
                        <!--end::Title-->
                        <!--begin::Breadcrumb-->
                        <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                            <!--begin::Item-->
                            <li class="breadcrumb-item text-muted">
                                <a href="" class="text-muted text-hover-primary">Home</a>
                            </li>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <li class="breadcrumb-item">
                                <span class="bullet bg-gray-400 w-5px h-2px"></span>
                            </li>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <li class="breadcrumb-item text-muted">Courses Management</li>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <li class="breadcrumb-item">
                                <span class="bullet bg-gray-400 w-5px h-2px"></span>
                            </li>
                            <!--end::Item-->

                            <!--begin::Item-->
                            <li class="breadcrumb-item text-muted">
                                <a href="" class="text-muted text-hover-primary">Courses</a>
                            </li>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <li class="breadcrumb-item">
                                <span class="bullet bg-gray-400 w-5px h-2px"></span>
                            </li>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <li class="breadcrumb-item text-muted">
                                <a href="#" class="text-muted text-hover-primary">Course Details</a>
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
                    <!--begin::Navbar-->
                    <div class="card mb-6 mb-xl-9">
                        <div class="card-body pt-9 pb-0">
                            <!--begin::Details-->
                            <div class="d-flex flex-wrap flex-sm-nowrap mb-6">
                                <!--begin::Wrapper-->
                                <div class="flex-grow-1">
                                    <!--begin::Head-->
                                    <div class="d-flex justify-content-between align-items-center flex-wrap mb-2">
                                        <!--begin::Details-->
                                        <div class="d-flex flex-column">
                                            <!--begin::Description-->
                                            <div class="d-flex flex-wrap fw-semibold mb-4 fs-5 text-gray-400">
                                                <h1>Batch Code : <span id="batch-code"></span></h1>
                                            </div>
                                            <!--end::Description-->
                                        </div>
                                        <!--end::Details-->
                                        <!--begin::Actions-->
                                        {{-- <div class="d-flex mb-4">
                                            <a href="#" class="btn btn-sm btn-bg-light btn-active-color-primary me-3"
                                                data-bs-toggle="modal" data-bs-target="#kt_modal_view_users">Enrolled
                                                Student</a>
                                            <a href="#" class="btn btn-sm btn-primary me-3">Generate Report</a>
                                        </div> --}}
                                        <!--end::Actions-->
                                    </div>
                                    <!--end::echo $date->format('l jS \o\f F Y h:i:s A'), "\n";Head-->
                                    <!--begin::Info-->
                                    <div class="d-flex flex-wrap justify-content-start">
                                        <!--begin::Stats-->
                                        <div class="d-flex flex-wrap">
                                            <!--begin::Stat-->
                                            <div
                                                class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                                <!--begin::Number-->
                                                <div class="d-flex align-items-center">
                                                    <div class="fs-4 fw-bold">
                                                        Today's date
                                                    </div>
                                                </div>
                                                <!--end::Number-->
                                                <!--begin::Label-->
                                                <div class="fw-semibold fs-6 text-gray-400">
                                                    <?php $date = date('Y-m-d'); ?>
                                                    {{ $date }}
                                                </div>
                                                <!--end::Label-->
                                            </div>
                                            <!--end::Stat-->
                                            <!--begin::Stat-->
                                            {{-- <div
                                                class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                                <!--begin::Number-->
                                                <div class="d-flex align-items-center">
                                                    <div class="fs-4 fw-bold">
                                                        end date
                                                    </div>
                                                </div>
                                                <!--end::Number-->
                                                <!--begin::Label-->
                                                <div class="fw-semibold fs-6 text-gray-400">End Date</div>
                                                <!--end::Label-->
                                            </div> --}}
                                            <!--end::Stat-->
                                        </div>
                                        <!--end::Stats-->
                                        <!--begin::Users-->
                                        {{-- <div class="symbol-group symbol-hover mb-3">
                                            <!--begin::User-->
                                            <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip"
                                                title="">
                                                <img src="" />

                                            </div>
                                            <!--end::User-->
                                            <!--begin::All users-->
                                            <a href="#" class="symbol symbol-35px symbol-circle" data-bs-toggle="modal"
                                                data-bs-target="#kt_modal_view_users">
                                                <span class="symbol-label bg-dark text-inverse-dark fs-8 fw-bold"
                                                    data-bs-toggle="tooltip" data-bs-trigger="hover"
                                                    title="View Enroll Users">+ all enrolled</span>
                                            </a>
                                            <!--end::All users-->
                                        </div> --}}
                                        <!--end::Users-->
                                    </div>
                                    <!--end::Info-->
                                </div>
                                <!--end::Wrapper-->
                            </div>
                            <!--end::Details-->
                            <div class="separator"></div>
                            <!--begin::Nav-->
                            <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bold">
                                <!--begin::Nav item-->
                                <li class="nav-item">
                                    <a class="nav-link text-active-primary py-5 me-6 active" data-bs-toggle="tab"
                                        href="#kt_attend_trainee_tab">Attend</a>
                                </li>
                                <!--end::Nav item-->
                                <!--begin::Nav item-->
                                {{-- <li class="nav-item">
                                    <a class="nav-link text-active-primary py-5 me-6" data-bs-toggle="tab"
                                        href="#kt_absent_trainee_tab">Absent</a>
                                </li> --}}
                                <!--end::Nav item-->
                            </ul>
                            <!--end::Nav-->
                        </div>
                    </div>
                    <!--end::Navbar-->
                    <!--begin:::Tab content-->
                    <div class="tab-content" id="myTabContent">
                        <!--begin:::Tab pane-->
                        <div class="tab-pane fade show active" id="kt_attend_trainee_tab" role="tabpanel">
                            <div class="card mb-5 mb-xl-10" id="kt_profile_details_view">
                                <!--begin::Card header-->
                                <div class="card-header cursor-pointer">
                                    <!--begin::Card title-->
                                    <div class="card-title m-0">
                                        <h3 class="fw-bold m-0">Attend List</h3>
                                    </div>
                                    <!--end::Card title-->
                                </div>
                                <!--begin::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body p-9">
                                    <div class="table-responsive">
                                        <!--begin::Table-->
                                        <table class="table table-responsive align-middle table-row-dashed fs-6 gy-5"
                                            id="kt_district_report_views_table">
                                            <thead>
                                                <tr class="text-center text-muted fw-bold fs-7 text-uppercase gs-0">
                                                    <th class="w-10px pe-2">
                                                        <div
                                                            class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                                            <input class="form-check-input" data-kt-check="true"
                                                                data-kt-check-target="#kt_table_districts .form-check-input"
                                                                type="checkbox" value="" name="all-attend"
                                                                id="all-attend" />
                                                        </div>
                                                    </th>
                                                    <th class="text-start">Id</th>
                                                    <th class="">User Id</th>
                                                    <th class="">Name</th>
                                                    <th class="w-100px text-end">Status</th>
                                                </tr>
                                            </thead>
                                            <tbody class="text-gray-600 fw-semibold" id="attendance-tbody">

                                            </tbody>
                                        </table>
                                        <!--end::Table-->
                                    </div>
                                    <div class="text-center">
                                        <button type="button" class="btn btn-warning" id="absent-button">
                                            Mark as Absent
                                        </button>
                                    </div>
                                </div>
                                <!--end::Card body-->
                            </div>
                        </div>
                        <!--end::Content container-->
                        <!--begin:::Tab pane-->
                        {{-- <div class="tab-pane fade" id="kt_absent_trainee_tab" role="tabpanel">

                        </div> --}}
                        <!--end:::Tab pane-->
                    </div>
                    <!--end::Tab content-->
                </div>
                <!--end::Content-->
            </div>
            <!--end::Content wrapper-->
        </div>
        <!--end:::Main-->
    </div>
    <!--end::Content-->

    <!--begin::Modal - View Users-->
    {{-- <div class="modal fade" id="kt_modal_view_users" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog mw-650px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Modal header-->
                <div class="modal-header pb-0 border-0 justify-content-end">
                    <!--begin::Close-->
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <i class="ki-duotone ki-cross fs-1">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                    </div>
                    <!--end::Close-->
                </div>
                <!--begin::Modal header-->
                <!--begin::Modal body-->
                <div class="modal-body scroll-y mx-5 mx-xl-18 pt-0 pb-15">
                    <!--begin::Heading-->
                    <div class="text-center mb-13">
                        <!--begin::Title-->
                        <h1 class="mb-3">Enroll Users</h1>
                        <!--end::Title-->
                        <!--begin::Description-->
                        <div class="text-muted fw-semibold fs-5">Check the all users who are enrolled on this course
                            <a href="#" class="link-primary fw-bold"></a>.
                        </div>
                        <!--end::Description-->
                    </div>
                    <!--end::Heading-->
                    <!--begin::Users-->
                    <div class="mb-15">
                        <!--begin::List-->
                        <div class="mh-375px scroll-y me-n7 pe-7">
                            <!--begin::User-->
                            <div class="d-flex flex-stack py-5 border-bottom border-gray-300 border-bottom-dashed">
                                <!--begin::Details-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Avatar-->
                                    <div class="symbol symbol-35px symbol-circle">
                                        <img class="mw-50px mw-lg-75px" src="" alt="image" />
                                    </div>
                                    <!--end::Avatar-->
                                    <!--begin::Details-->
                                    <div class="ms-6">
                                        <!--begin::Name-->
                                        <a href="#"
                                            class="d-flex align-items-center fs-5 fw-bold text-dark text-hover-primary">
                                            <span class="badge badge-light fs-8 fw-semibold ms-2"></span></a>
                                        <!--end::Name-->
                                        <!--begin::Email-->
                                        <div class="fw-semibold text-muted"></div>
                                        <!--end::Email-->
                                    </div>
                                    <!--end::Details-->
                                </div>
                                <!--end::Details-->
                                <!--begin::Stats-->
                                <div class="d-flex">
                                    <!--begin::Sales-->
                                    <div class="text-end">
                                        <div class="fs-5 fw-bold text-dark"></div>
                                        <div class="fs-7 text-muted"></div>
                                    </div>
                                    <!--end::Sales-->
                                </div>
                                <!--end::Stats-->
                            </div>
                            <!--end::User-->

                        </div>
                        <!--end::List-->
                    </div>
                    <!--end::Users-->
                    <!--begin::Notice-->
                    <div class="d-flex justify-content-between">
                    </div>
                    <!--end::Notice-->
                </div>
                <!--end::Modal body-->
            </div>
            <!--end::Modal content-->
        </div>
        <!--end::Modal dialog-->
    </div> --}}
    <!--end::Modal - View Users-->
    @section('scripts')
    <script>
        let attendanceTbody = $("#attendance-tbody");
            $(document).ready(function() {
                let scheduleId = @json($scheduleId);
                console.log(scheduleId);
                const link = api_baseurl + "batch-schedule/" + scheduleId + "/checkAttendance";
                $.ajax({
                    type: "GET",
                    url: link,
                    headers: {
                        Authorization: authToken,
                    },
                    success: function(results) {
                        // Handle the successful response here
                        let allAttends = results.data.attendance;
                        let batchDetails = results.data.schedule;
                        console.log(allAttends);
                        $("#batch-code").html(batchDetails.training_batch ? batchDetails.training_batch
                            .batchCode : '');
                        sessionStorage.removeItem('message');
                        if (allAttends.length > 0) {
                            $.each(allAttends, function(index, attend) {
                                let userName = (attend.user ? attend.user.fname : '') + " " + (
                                    attend.user ? attend.user.lname : '')
                                let attendTr = `
                                <tr class="text-center">
                                    <td>
                                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                                            <input class="form-check-input attend-item" type="checkbox" name="attendId"
                                                data-attend-id="${attend.trainee_id}" />
                                        </div>
                                    </td>
                                    <td class="text-start">                                        
                                        ${attend.id}
                                    </td>
                                    <td class="">
                                        <a href="#" class="text-gray-800 text-hover-primary mb-1">
                                            ${attend.trainee_id}
                                        </a>
                                    </td>
                                    <td class="">                                        
                                        ${userName}
                                    </td>
                                    <td class="text-end">                                        
                                        present
                                    </td>                                    
                                </tr>
                            `;

                                attendanceTbody.append(attendTr);
                            });
                        } else {
                            attendanceTbody.innerHTML = `
                            <tr>
                                <td class="w-100">No Attend Data Found</td>
                            </tr>                            
                            `;
                        }
                    },
                    error: function(xhr, status, error) {
                        // Handle errors here
                        console.error(xhr, status, error);
                    }
                });

                let selectedAttendIds = [];

                function setSelectedAttendIds() {
                    selectedAttendIds = [];
                    $(".attend-item").each(function() {
                        var attendId = $(this).data("attend-id");
                        if (attendId) {
                            selectedAttendIds.push(attendId);
                        }
                    });
                    // console.log(selectedAttendIds);
                }

                function setSelectedAttendId(userElement) {
                    var attendId = $(userElement).data("attend-id");

                    if (attendId) {
                        selectedAttendIds.push(attendId);
                    }
                    // console.log(selectedAttendIds);
                }

                function removeSelectedAttendId(userElement) {
                    var attendId = $(userElement).data("attend-id");
                    var index = selectedAttendIds.indexOf(attendId);
                    if (index !== -1) {
                        selectedAttendIds.splice(index, 1);
                    }
                    // console.log(selectedAttendIds);
                }

                // Add a click event handler to individual attend checkboxes
                $(document).on("click", ".attend-item", function() {
                    if ($(this).is(":checked")) {
                        setSelectedAttendId(this);
                    } else {
                        removeSelectedAttendId(this);
                    }
                });

                // select attends
                $('[name="all-attend"]').on("click", function() {
                    if ($(this).is(":checked")) {
                        $.each($(".attend-item"), function() {
                            $(this).prop("checked", true);
                        });
                        setSelectedAttendIds();
                    } else {
                        $.each($(".attend-item"), function() {
                            $(this).prop("checked", false);
                        });
                        selectedAttendIds = [];
                        // console.log(selectedAttendIds);
                    }
                });

                let absentButton = $("#absent-button");
                absentButton.click(function() {
                    if (selectedAttendIds.length == 0) {
                        alert("No Trainee Selected! Select At Least One");
                    } else {
                        Swal.fire({
                            title: "Are you sure",
                            text: "Add selected Trainee as absent today?",
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#3085d6",
                            cancelButtonColor: "#d33",
                            confirmButtonText: "Yes, Submit",
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // console.log(selectedAttendIds);
                                api_link = api_baseurl + "batch-schedule/" + scheduleId +
                                    "/counterAttendance";
                                $.ajax({
                                    method: "POST",
                                    url: api_link,
                                    headers: {
                                        Authorization: authToken,
                                    },
                                    data: JSON.stringify({
                                        selectedAttendIds: selectedAttendIds,
                                    }),
                                    contentType: "application/json",
                                    success: function(results) {
                                        console.log(results);

                                        if (results.success === true) {
                                            swal.fire(
                                                "Success:",
                                                "Mark as Absent Successfully!"
                                            );
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
                    }
                });
            });
    </script>
    @endsection

    @endsection