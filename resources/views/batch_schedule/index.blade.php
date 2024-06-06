@extends('layouts.auth-master')
@push('css')
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined:opsz,wght,FILL,GRAD@48,700,0,0"
        rel="stylesheet">
    <style>
        .actions-btn {
            background: #e9d5ff;
        }

        .actions-btn:hover,
        .actions-btn:focus {
            background: #6b21a8;
            color: white;
        }
    </style>
@endpush
@section('content')
    <!--begin::Content-->
    <!--begin::Breadcrumb-->
    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1 m-5">
        <!--begin::Item-->
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('home.index') }}" class="text-muted text-hover-primary">{{ __('categorie-list.home') }}</a>
        </li>
        <!--end::Item-->
        <!--begin::Item-->
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-400 w-5px h-2px"></span>
        </li>
        <!--end::Item-->
        <!--begin::Item-->
        <li class="breadcrumb-item text-muted">{{ __('batch-schedule.enroll_management') }}</li>
        <!--end::Item-->
        <!--begin::Item-->
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-400 w-5px h-2px"></span>
        </li>
        <!--end::Item-->
        <!--begin::Item-->
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('batch-schedule.batches') }}"
                class="text-muted text-hover-primary">{{ __('batch-schedule.provider_batch_list') }}</a>
        </li>
        <!--end::Item-->
        <!--begin::Item-->
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-400 w-5px h-2px"></span>
        </li>
        <!--end::Item-->
        <!--begin::Item-->
        <li class="breadcrumb-item text-muted">{{ __('batch-schedule.batch_schedule') }}</li>
        <!--end::Item-->
    </ul>
    <!--end::Breadcrumb-->
    <div class="m-4">
        <div id="batch-header" class="mb-2">
            <div>
                <div class="icon">
                    <img src="{{ asset('img') }}/new_icon/batch_head.png" alt="">
                </div>
            </div>
            <div class="row row-cols-4">
                <div class="item">
                    <div class="title"> {{ $batch['batchCode'] ?? '' }}</div>
                    <div class="tag">{{ __('batch-schedule.batch_code') }} #</div>
                </div>
                <div class="item">
                    <div class="title">{{ $batch['get_training']['title']['Name'] ?? '' }}</div>
                    <div class="tag">{{ __('batch-schedule.course_name') }}</div>
                </div>
                <div class="item">
                    <div class="title">{{ $batch['GEOLocation'] ?? '' }}</div>
                    <div class="tag">{{ __('batch-schedule.address') }}</div>
                </div>
                <div class="item">
                    <div class="title">{{ $batch['duration'] ?? '' }} {{ __('batch-schedule.days') }}</div>
                    <div class="tag">{{ __('batch-schedule.total_class_days') }}</div>
                </div>
            </div>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif



        @isset($schedule_details)
            @php
                $schedule_used = false;
                $runningClass = false;
                $desiredKey = 'status';
                foreach ($schedule_details as $array) {
                    if (
                        array_key_exists($desiredKey, $array) &&
                        ($array[$desiredKey] == 2 || $array[$desiredKey] == 3)
                    ) {
                        $schedule_used = true;
                        break;
                    }
                }
                foreach ($schedule_details as $array) {
                    if (array_key_exists($desiredKey, $array) && $array[$desiredKey] == 2) {
                        $runningClass = true;
                        break;
                    }
                }
            @endphp

            <div class="d-flex flex-wrap justify-content-between">
                <div>
                    @if (count($schedule_details))
                        @if (in_array('batch-schedule.clean', $roleRoutePermissions) && !$schedule_used)
                            <a href="" id="{{ $batch['id'] }}"
                                class="btn btn-md btn-warning text-black clean-schedule me-2">
                                Clean Schedule
                            </a>
                        @endif
                        @if (strtolower($role) == 'superadmin')
                            <a href="" id="destroy-schedule" class="btn btn-md btn-danger clean-schedule me-3">
                                Schedule Destroy with Attandance
                            </a>
                        @endif
                    @endif
                </div>
                @if (in_array('batch-schedule-detail.create', $roleRoutePermissions))
                    <a href="{{ route('batch-schedule-detail.create', $batch['id']) }}" class="btn btn-primary">
                        Add New
                        Schedule
                    </a>
                @endif
            </div>

            <x-alert />


            <div id="class-days">
                @foreach (collect($schedule_details) as $schedule_detail)
                    @php
                        $date = \Carbon\Carbon::createFromFormat('Y-m-d', $schedule_detail['date']);
                        $start_time = \Carbon\Carbon::createFromFormat('H:i:s', $schedule_detail['start_time']);
                        $end_time = \Carbon\Carbon::createFromFormat('H:i:s', $schedule_detail['end_time']);
                    @endphp
                    <div class="day">
                        <div class="day-no">
                            <div class="label">
                                {{ __('batch-schedule.day') }} #
                            </div>
                            <div class="title">
                                {{ $loop->iteration }}
                            </div>
                        </div>
                        <div class="day-name">
                            <div class="label">
                                {{ $date->format('l') }}
                            </div>
                            <div class="title">
                                {{ $date->format('d/m/Y') }}
                            </div>
                        </div>
                        <div>
                            <div class="class-time-detail mb-1">
                                <div class="left">
                                    <div class="icon">
                                        <span class="material-icons-outlined">
                                            schedule
                                        </span>
                                    </div>
                                    <div class="border-right">
                                        <div class="label">{{ __('batch-schedule.class') }}</div>
                                        <div class="text">{{ __('batch-schedule.time') }}</div>
                                    </div>
                                </div>
                                <div class="right">
                                    <div class="time">
                                        {{ $start_time->format('h:i:s A') }} - {{ $end_time->format('h:i:s A') ?? '' }}
                                        {{ __('batch-schedule.time_ta') }}
                                    </div>
                                    <div class="d-flex">
                                        @isset($schedule_detail['status'])
                                            @if ($schedule_detail['status'] == 1)
                                                <div class="icon waiting">
                                                    <span class="material-icons-outlined">
                                                        event
                                                    </span>
                                                </div>
                                                <div>
                                                    <div class="label">{{ __('batch-schedule.class_status') }}</div>
                                                    <div class="text">{{ __('batch-schedule.class_status_waiting') }}</div>
                                                </div>
                                            @elseif ($schedule_detail['status'] == 2)
                                                <div class="icon running">
                                                    <span class="material-icons-outlined">
                                                        directions_run
                                                    </span>
                                                </div>
                                                <div>
                                                    <div class="label">{{ __('batch-schedule.class_status') }}</div>
                                                    <div class="text">{{ __('batch-schedule.class_status_running') }}</div>
                                                </div>
                                            @elseif ($schedule_detail['status'] == 3)
                                                <div class="icon complete">
                                                    <span class="material-icons-outlined">
                                                        done
                                                    </span>
                                                </div>
                                                <div>
                                                    <div class="label">{{ __('batch-schedule.class_status') }}</div>
                                                    <div class="text">{{ __('batch-schedule.class_status_completed') }}</div>
                                                </div>
                                            @endif
                                        @endisset
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="button-area">
                            @isset($role)
                                <div class="dropdown text-center">
                                    <button class="btn actions-btn dropdown-toggle" type="button" id="dropdownMenuButton"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        Actions
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        @if (in_array('batch-schedule-detail.destroy', $roleRoutePermissions) && $schedule_detail['status'] == 1)
                                            <li>
                                                <form action="{{ route('batch-schedule-detail.destroy', $schedule_detail['id']) }}"
                                                    method="POST" style="display: inline;">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button class="dropdown-item text-danger" id="delete-schedule">
                                                        Delete Schedule
                                                    </button>
                                                </form>
                                            </li>
                                        @endif
                                        @isset($schedule_detail['status'])
                                            @if (in_array('batch-schedule.edit', $roleRoutePermissions) && $schedule_detail['status'] == 1)
                                                <li>
                                                    <a href="" type="button"
                                                        class="dropdown-item text-warning btn-edit-schedule" id="btn-edit-schedule"
                                                        data-bs-toggle="modal" data-bs-target="#edit_schedule_details"
                                                        data-sd-id="{{ $schedule_detail['id'] }}"
                                                        data-date={{ $date->format('d/m/Y') }}
                                                        data-start-time={{ $schedule_detail['start_time'] }}
                                                        data-end-time={{ $schedule_detail['end_time'] }}>
                                                        Edit Schedule
                                                    </a>
                                                </li>
                                            @endif
                                        @endisset
                                        @if (strtolower($role) == 'trainer')
                                            @isset($schedule_detail['status'])
                                                <li>
                                                    <a href="{{ route('schedule-class-documents.index', $schedule_detail['id']) }}"
                                                        class="dropdown-item text-info">Class Document</a>
                                                </li>
                                                @if ($schedule_detail['status'] == 1 && !$runningClass)
                                                    @if ($date <= \Carbon\Carbon::now())
                                                        <li>
                                                            <a id="{{ encrypt($schedule_detail['id']) }}"
                                                                class="dropdown-item start-class update text-primary" type="button"
                                                                data-bs-toggle="modal" data-bs-target="#classStartModal">
                                                                {{ __('batch-schedule.start_class') }}
                                                            </a>
                                                        </li>
                                                    @else
                                                        <li>
                                                            <a class="dropdown-item disabled update text-primary">
                                                                {{ __('batch-schedule.start_class') }}
                                                            </a>
                                                        </li>
                                                    @endif
                                                @elseif ($schedule_detail['status'] == 2)
                                                    <li>
                                                        <a href="{{ route('attendance.form', [encrypt($schedule_detail['id'])]) }}"
                                                            class="dropdown-item text-success">
                                                            {{ __('batch-schedule.join_class') }}
                                                        </a>
                                                    </li>
                                                @elseif ($schedule_detail['status'] == 3)
                                                    <li>
                                                        <a href="{{ route('attendance.form', [encrypt($schedule_detail['id'])]) }}"
                                                            class="dropdown-item complete">
                                                            {{ __('batch-schedule.class_details') }}
                                                        </a>
                                                    </li>
                                                @endif
                                            @endisset
                                        @else
                                            @if ($schedule_detail['status'] == 2)
                                                <li>
                                                    <a href="{{ route('schedule-class-documents.index', $schedule_detail['id']) }}"
                                                        class="dropdown-item">Class Document</a>
                                                </li>
                                                @if ($schedule_detail['streaming_link'])
                                                    <li>
                                                        <a class="dropdown-item text-danger"
                                                            href="{{ $schedule_detail['streaming_link'] }}" target="_blank">
                                                            {{ __('batch-schedule.live_streaming') }}
                                                        </a>
                                                    </li>
                                                @endif
                                                @if ($schedule_detail['static_link'])
                                                    <li>
                                                        <a type="button" class="dropdown-item text-primary"
                                                            href="{{ $schedule_detail['static_link'] }}" target="_blank">
                                                            {{ __('batch-schedule.join_class') }}
                                                        </a>
                                                    </li>
                                                @endif
                                            @elseif ($schedule_detail['status'] == 3)
                                                <li>
                                                    <a href="{{ route('schedule-class-documents.index', $schedule_detail['id']) }}"
                                                        class="dropdown-item">Class Document</a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('attendance.form', [encrypt($schedule_detail['id'])]) }}"
                                                        class="dropdown-item complete">
                                                        {{ __('batch-schedule.class_details') }}
                                                    </a>
                                                </li>
                                            @endif
                                        @endif
                                    </ul>
                                </div>
                            @endisset
                        </div>
                    </div>
                @endforeach
            </div>
        @endisset

        <!--Start::Start Class Modal-Content-->
        <div class="modal fade" id="classStartModal" tabindex="-1" aria-hidden="true">
            <!--begin::Modal dialog-->
            <div class="modal-dialog modal-dialog-centered">
                <!--begin::Modal content-->
                <div class="modal-content">
                    <div class="modal-header" id="kt_modal_update_permission_header">
                        <!--begin::Modal title-->
                        <h2 class="fw-bold">Class Link</h2>
                        <!--end::Modal title-->
                        <!--begin::Close-->
                        <div type="button" class="btn-close" data-bs-dismiss="modal">
                        </div>
                        <!--end::Close-->
                    </div>
                    <!--begin::Provider added Form-->
                    <div class="modal-body">
                        <div class="mb-2">
                            <label for="streaming_link_update" class="mb-1 text-danger h6">ক্লাস লাইভ স্ট্রিমিং লিংক
                                (ফেসবুক বা ইউটিউব)</label>
                            <input id="streaming_link" type="text" class="form-control">
                        </div>
                        <div class="mb-2">
                            <label for="static_link_update" class="mb-1 text-danger h6">লাইভ ক্লাস লিংক (গুগল মিট বা
                                জুম)</label>
                            <input id="static_link" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" data-bs-dismiss="modal" class="btn btn-light">Close</button>
                        <button id="start-class" type="button" class="btn btn-danger">Start CLass</button>
                    </div>

                </div>
            </div>
        </div>
        <!--End::Start Class Modal-->

        <!--Start::Edit Schedule Modal-->
        <div class="modal fade" id="edit_schedule_details" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered mw-950px">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Schedule</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="edit_schedule_details_form" method="POST" class="form m-7" action="">
                            @csrf
                            {{-- @method('PUT') --}}
                            <input type="hidden" name="schedule_details_id" id="sd-id">
                            <div class="d-flex gap-3">
                                <div class="mb-3 w-100">
                                    <label for="startTimeInput" class="col-form-label">Start Time:</label>
                                    <input type="text" class="form-control form-control-solid" id="startTimeInput"
                                        name="start_time">
                                    <span class="text-danger form-message-error-start_time"></span>
                                </div>
                                <div class="mb-3 w-100">
                                    <label for="endTimeInput" class="col-form-label">End Time:</label>
                                    <input type="text" class="form-control form-control-solid" id="endTimeInput"
                                        name="end_time">
                                    <span class="text-danger form-message-error-end_time"></span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="dateInput" class="col-form-label">Date:</label>
                                <input type="text" class="form-control form-control-solid" id="dateInput"
                                    name="date">
                                <span class="text-danger form-message-error-date"></span>
                            </div>
                            <div class="text-center mt-5">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--End::Edit Schedule Modal-->
    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            var app_url = "{{ url('') }}";

            $('.start-class').click(function() {
                id = $(this).attr('id');

                $('#start-class').click(function() {
                    let streaming_link = $("#streaming_link").val();
                    let static_link = $("#static_link").val();

                    let finalUrl =
                        `${app_url}/attendance/${encodeURIComponent(id)}/start?streaming_link=${encodeURIComponent(streaming_link)}&static_link=${encodeURIComponent(static_link)}`;
                    window.location.href = finalUrl;
                });
            });

            $('.clean-schedule').click(function(e) {
                e.preventDefault();
                id = $(this).attr('id');

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
                        let finalUrl = `${app_url}/batch_schedules/clean/${id}`;
                        window.location.href = finalUrl;
                    }
                });
            });

            $('#destroy-schedule').click(function(e) {
                e.preventDefault();
                id = {{ $batch['id'] }};

                Swal.fire({
                    title: "Are you sure?",
                    text: "All schedule deleted with attandance.!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!",
                    cancelButtonText: "No, cancel!",
                }).then((result) => {
                    if (result.isConfirmed) {
                        let finalUrl = `${app_url}/batch_schedules/destroy/${id}`;
                        window.location.href = finalUrl;
                    }
                });
            });

            $(document).on("click", "#delete-schedule", function(e) {
                e.preventDefault();
                const form = $(this).closest('form');

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

            $("#edit_schedule_details").on('shown.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                let sdId = button.data('sd-id');
                let date = button.data('date');
                let startTime = button.data('start-time');
                let endTime = button.data('end-time');

                $("#sd-id").val(sdId);

                let dateFromatJson = {
                    dateFormat: "d/m/Y"
                };
                dateFromatJson['defaultDate'] = date;

                $('#dateInput').flatpickr(dateFromatJson);

                $("#startTimeInput").flatpickr({
                    dateFormat: "H:i",
                    enableTime: true,
                    noCalendar: true,
                    defaultDate: startTime,
                });

                $("#endTimeInput").flatpickr({
                    dateFormat: "H:i",
                    enableTime: true,
                    noCalendar: true,
                    defaultDate: endTime,
                });
            });

            // edit schedule details form submit
            $("#edit_schedule_details_form").submit(function(e) {
                e.preventDefault();
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, submit!",
                    cancelButtonText: "No, cancel!",
                }).then((result) => {
                    if (result.isConfirmed) {
                        let fd = new FormData();
                        let CSRF_TOKEN = $('meta[name="csrf-token"]').attr("content");

                        // console.log(attached_image_url);
                        let start_time = $(
                            "#edit_schedule_details_form [name=start_time]"
                        ).val();
                        let end_time = $(
                            "#edit_schedule_details_form [name=end_time]"
                        ).val();
                        let date = $(
                            "#edit_schedule_details_form [name=date]"
                        ).val();
                        let scheduleDetailId = $(
                            "#edit_schedule_details_form [name=schedule_details_id]"
                        ).val();
                        // alert(scheduleDetailId);
                        let api_link = api_baseurl + "schedule/schedule-detail-change/" +
                            scheduleDetailId;

                        var formattedDate = moment(date, 'DD/MM/YYYY').format('YYYY-MM-DD');
                        // console.log(start_time, end_time, date, formattedDate);
                        fd.append("start_time", start_time);
                        fd.append("end_time", end_time);
                        fd.append("date", formattedDate);
                        fd.append("_token", CSRF_TOKEN);
                        fd.append("_method", "PUT");

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
                                    swal.fire("Successfully updated!", results.data);
                                    // refresh page after 2 seconds
                                    setTimeout(function() {
                                        location.reload();
                                    }, 2000);
                                } else {
                                    if (results.success === false) {
                                        var errors = "Validation Error Occurs!!";
                                        swal.fire("", errors);

                                        // function display error message
                                        function displayErrorMessage(
                                            fieldName,
                                            errorMessage
                                        ) {
                                            const errorMessageSelector =
                                                `#edit_schedule_details_form .form-message-error-${fieldName}`;
                                            $(errorMessageSelector)
                                                .html(errorMessage)
                                                .addClass("text-danger")
                                                .fadeIn(5000);
                                            setTimeout(() => {
                                                $(errorMessageSelector)
                                                    .html("")
                                                    .removeClass("text-danger")
                                                    .fadeOut();
                                            }, 10000);
                                        }

                                        // Define an array of field names you want to handle
                                        const fieldsToHandle = [
                                            "start_time",
                                            "end_time",
                                            "date",
                                        ];

                                        // Usage example for multiple fields
                                        fieldsToHandle.forEach((fieldName) => {
                                            if (results.message[fieldName]) {
                                                displayErrorMessage(
                                                    fieldName,
                                                    results.message[
                                                        fieldName][0]
                                                );
                                            }
                                        });
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
        });
    </script>
@endpush
