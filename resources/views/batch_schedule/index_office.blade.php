@extends('layouts.auth-master')

@section('content')
    <!--begin::Content-->
    <div class="m-5">
        <h3>{{ __('batch-schedule.batch_schedule') }}</h3>
        @isset($schedule_details)
            @php
                $schedule_used = false;
                $desiredKey = 'status';
                foreach ($schedule_details as $array) {
                    if (array_key_exists($desiredKey, $array) && ($array[$desiredKey] == 2 || $array[$desiredKey] == 3)) {
                        $schedule_used = true;
                        break;
                    }
                }
            @endphp
        @endisset
        @isset($batch)
            <div>
                <h4>{{ __('batch-schedule.batch_code') }}: {{ $batch['batchCode'] }}</h4>
                <div>{{ __('batch-schedule.course_name') }}:
                    {{ $batch['get_training'] ? ($batch['get_training']['title'] ? $batch['get_training']['title']['Name'] : '') : '' }}
                </div>
                <div>
                    {{ __('batch-schedule.start_date') }}: {{ isset($batch['startDate']) ? digitLocale(\Carbon\Carbon::parse($batch['startDate'])->format('d-m-Y')) : digitLocale(null) }}
                </div>
                <div>
                    {{ __('batch-list.total_tarinee') }}: {{ isset($batch['totalTrainees']) ? digitLocale($batch['totalTrainees']) : digitLocale(null) }} {{ __('batch-list.jon') }}
                </div>
                <div>
                    {{ __('batch-schedule.location') }}: {{ $batch['GEOLocation'] ?? '' }}
                </div>
            </div>
        @endisset
        <br>
        <x-alert />
        @isset($schedule_details)
            @if (in_array('batch-schedule.clean', $roleRoutePermissions) && !$schedule_used)
                <div class="text-end mb-2">
                    <a href="" id="{{ $batch['id'] }}" class="btn btn-md btn-danger clean-schedule">
                        {{ __('batch-list.clean_schedule') }}
                    </a>
                </div>
            @endif
            <table class="table table-bordered bg-white">
                <thead>
                    <th>{{ __('batch-schedule.sl') }}</th>
                    <th>{{ __('batch-schedule.date') }}</th>
                    <th>{{ __('batch-schedule.day') }}</th>
                    <th>{{ __('batch-schedule.start_time') }}</th>
                    <th>{{ __('batch-schedule.end_time') }}</th>
                    <th>{{ __('batch-schedule.status') }}</th>
                    <th class="text-center">{{ __('batch-schedule.action') }}</th>
                </thead>
                <tbody>
                    @foreach (collect($schedule_details) as $schedule_detail)
                        <tr>
                            <td>{{ digitLocale($loop->iteration) }}</td>
                            <td>
                                @php
                                    $date = \Carbon\Carbon::createFromFormat('Y-m-d', $schedule_detail['date']);
                                @endphp
                               
                                {{ isset($date) ? digitLocale(\Carbon\Carbon::parse($date)->format('d/m/Y')) : digitLocale(null) }}
                            </td>
                            <td>
                                {{ isset($date) ? digitLocale(\Carbon\Carbon::parse($date)->format('l')) : digitLocale(null) }}
                            </td>
                            <td>{{ isset($schedule_detail['start_time']) ? digitLocale(\Carbon\Carbon::parse($schedule_detail['start_time'])->format('h:i A')) : digitLocale(null) }}
                            <td>{{ isset($schedule_detail['end_time']) ? digitLocale(\Carbon\Carbon::parse($schedule_detail['end_time'])->format('h:i A')) : digitLocale(null) }}
                            </td>
                            <td>
                                @isset($schedule_detail['status'])
                                    @if ($schedule_detail['status'] == 1)
                                        <span class="badge bg-secondary">{{ __('batch-schedule.not_started') }}</span>
                                    @elseif ($schedule_detail['status'] == 2)
                                        <span class="badge bg-warning">{{ __('batch-schedule.class_running') }}</span>
                                    @elseif ($schedule_detail['status'] == 3)
                                        <span class="badge bg-success">{{ __('batch-schedule.class_completed') }}</span>
                                    @endif
                                @endisset
                            </td>
                            <td class="text-center">
                                @isset($schedule_detail['status'])
                                    @if ($schedule_detail['status'] == 3)
                                        <a href="{{ route('attendance.schedule', [$schedule_detail['id']]) }}"
                                            class="btn btn-sm btn-success">
                                           {{__('batch-list.view_attendance')}}
                                        </a>
                                    @else
                                        @isset($schedule_detail['status'])
                                            @if (in_array('batch-schedule.edit', $roleRoutePermissions) && $schedule_detail['status'] == 1)
                                                <a href="" type="button" class="btn btn-sm btn-primary btn-edit-schedule"
                                                    id="btn-edit-schedule" data-bs-toggle="modal"
                                                    data-bs-target="#edit_schedule_details" data-sd-id="{{ $schedule_detail['id'] }}"
                                                    data-date={{ $date->format('d/m/Y') }}
                                                    data-start-time={{ $schedule_detail['start_time'] }}
                                                    data-end-time={{ $schedule_detail['end_time'] }}>
                                                    {{__('batch-list.edit_schedule')}}
                                                </a>
                                            @elseif($schedule_detail['status'] == 2)
                                                <div class="d-flex flex-wrap gap-1 justify-content-center">
                                                    @if ($schedule_detail['streaming_link'])
                                                        <a class="btn btn-sm btn-danger"
                                                            href="{{ $schedule_detail['streaming_link'] }}" target="_blank">
                                                            {{ __('batch-schedule.live_streaming') }}
                                                        </a>
                                                    @endif
                                                    @if ($schedule_detail['static_link'])
                                                        <a type="button" class="btn btn-sm btn-info"
                                                            href="{{ $schedule_detail['static_link'] }}" target="_blank">
                                                            {{ __('batch-schedule.join_class') }}
                                                        </a>
                                                    @endif
                                                </div>
                                            @endif
                                        @endisset
                                        {{-- <button type="button" class="btn btn-sm btn-info" disabled>
                                            {{ __('batch-schedule.view') }}
                                        </button> --}}
                                    @endif
                                @endisset
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endisset
    </div>

    <!--Start::Edit Schedule Modal-->
    <div class="modal fade" id="edit_schedule_details" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered mw-950px">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{__('batch-list.edit_schedule')}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="edit_schedule_details_form" method="POST" class="form m-7" action="">
                        @csrf
                        {{-- @method('PUT') --}}
                        <input type="hidden" name="schedule_details_id" id="sd-id">
                        <div class="d-flex gap-3">
                            <div class="mb-3 w-100">
                                <label for="startTimeInput" class="col-form-label"> {{__('batch-list.start_time')}}:</label>
                                <input type="text" class="form-control form-control-solid" id="startTimeInput"
                                    name="start_time">
                                <span class="text-danger form-message-error-start_time"></span>
                            </div>
                            <div class="mb-3 w-100">
                                <label for="endTimeInput" class="col-form-label">{{__('batch-list.end_time')}}:</label>
                                <input type="text" class="form-control form-control-solid" id="endTimeInput"
                                    name="end_time">
                                <span class="text-danger form-message-error-end_time"></span>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="dateInput" class="col-form-label">{{__('batch-list.class_start_date')}}:</label>
                            <input type="text" class="form-control form-control-solid" id="dateInput" name="date">
                            <span class="text-danger form-message-error-date"></span>
                        </div>
                        <div class="text-center mt-5">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('batch-list.close')}}</button>
                            <button type="submit" class="btn btn-primary">{{__('batch-list.submit')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--End::Edit Schedule Modal-->
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            var app_url = "{{ url('') }}";

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
