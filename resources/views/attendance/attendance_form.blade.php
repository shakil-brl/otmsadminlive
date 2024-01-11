@extends('layouts.auth-master')
@push('css')
    <style>
        .form-check-input:disabled {
            opacity: 1;
        }
    </style>
@endpush
@section('content')
    <!--begin::Content-->
    <div class="m-5">
        @isset($schedule_detail)
            <div id="batch-header" class="mb-1">
                <div>
                    <div class="icon">
                        <img src="{{ asset('img') }}/new_icon/batch_head.png" alt="">
                    </div>
                </div>
                <div class="row row-cols-4">
                    <div class="item">
                        <div class="title"> {{ $schedule_detail['schedule']['training_batch']['batchCode'] ?? '' }}</div>
                        <div class="tag">{{ __('batch-schedule.batch_code') }} #</div>
                    </div>
                    <div class="item">
                        <div class="title">
                            {{ $schedule_detail['schedule']['training_batch']['get_training']['title']['Name'] ?? '' }}
                        </div>
                        <div class="tag">{{ __('batch-schedule.course_name') }}</div>
                    </div>
                    <div class="item">
                        <div class="title">{{ $schedule_detail['schedule']['training_batch']['GEOLocation'] ?? '' }}</div>
                        <div class="tag">{{ __('batch-schedule.address') }}</div>
                    </div>
                    <div class="item">
                        <div class="title">{{ $schedule_detail['schedule']['training_batch']['duration'] ?? '' }}
                            {{ __('batch-schedule.days') }}</div>
                        <div class="tag">{{ __('batch-schedule.total_class_days') }}</div>
                    </div>
                </div>
            </div>
            @if ($schedule_detail['status'] === 2)
                <div class="w-100 mb-2 card p-3">
                    <div class="row row-cols-3 btn-group">
                        @if ($schedule_detail['streaming_link'])
                            <a class="btn btn-sm btn-danger" href="{{ $schedule_detail['streaming_link'] }}" target="_blank">
                                {{ __('batch-schedule.live_streaming') }}
                            </a>
                        @endif
                        @if ($schedule_detail['static_link'])
                            <a type="button" class="btn btn-sm btn-info" href="{{ $schedule_detail['static_link'] }}"
                                target="_blank">
                                {{ __('batch-schedule.join_class') }}
                            </a>
                        @endif
                        <a id="{{ $schedule_detail['id'] }}" class="btn btn-sm btn-warning class-link-update" type="button"
                            data-bs-toggle="modal" data-bs-target="#classLinkUpdateModal" type="button"
                            data-streaming-link="{{ $schedule_detail['streaming_link'] }}"
                            data-static-link="{{ $schedule_detail['static_link'] }}">
                            Update Link
                        </a>
                    </div>
                </div>
            @endif
        @endisset
        <x-alert />
        @php
            $status = $students[0]['schedule_detail']['status'] ?? -1;
        @endphp
        <div>
            <div>
                <h3 class="text-center mb-2 bg-white rounded-4 p-2">Trainee Attendance Form:</h3>
                <form method="POST" action="{{ route('attendance.take-attendance', $detail_id) }}" class=""
                    id="attendanceForm">
                    @csrf
                    <input type="hidden" name="schedule_detail_id" value="{{ $detail_id }}">
                    <div class="m-3">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div id="students">
                            @foreach ($students as $index => $student)
                                <div class="student">
                                    <div class="row row-cols-3 align-items-center">
                                        <div>
                                            <div class="label">সিরিয়াল #</div>
                                            <div class="text">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</div>
                                        </div>
                                        <div>
                                            <label for="student{{ $loop->iteration }}" class="">
                                                <div class="label">প্রশিক্ষণার্থীর নাম</div>
                                                <div class="text">{{ $student['profile']['KnownAs'] }}</div>
                                            </label>
                                        </div>
                                        <div>
                                            <div class="form-check form-switch attendance">
                                                <input @if ($status == 3) disabled @endif name="attendance[]"
                                                    @checked($student['is_present'] == 1) class="form-check-input" type="checkbox"
                                                    role="switch" id="student{{ $loop->iteration }}"
                                                    value="{{ $student['ProfileId'] }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div id="attendance-bottom">
                            <div class="left">
                                <div class="label">
                                    উপস্থিত প্রশিক্ষণার্থী
                                    <span id="totalAttendance"></span>/<span>{{ count($students) }}</span>
                                </div>
                                <div class="attendance-progress">
                                    <div class="success" id="success-progress" style=""></div>
                                </div>
                            </div>
                            <div class="right">
                                @if ($status == 2)
                                    <button class="btn btn-attendance" name="submit" value="attendance">সাবমিট
                                        অ্যাটেনডেন্স</button>
                                    <button class="btn btn-end end-class" name="submit" value="end">শেষ
                                        ক্লাস</button>
                                @endif
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--Start::Update Link Modal-Content-->
    <div class="modal fade" id="classLinkUpdateModal" tabindex="-1" aria-hidden="true">
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
                        <label for="" class="mb-1">Streaming Link</label>
                        <input id="streaming_link_update" type="text" class="form-control">
                    </div>
                    <div class="mb-2">
                        <label for="" class="mb-1">Live Class Link</label>
                        <input id="static_link_update" type="text" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" data-bs-dismiss="modal" class="btn btn-light">Close</button>
                    <button id="link-update-submit" type="button" class="btn btn-danger">Update</button>
                </div>
            </div>
        </div>
    </div>
    <!--End::Update Link Modal-->
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            var app_url = "{{ url('') }}";
            var totalStudent = {{ count($students) }};

            function countAttendance() {
                let att = 0;
                $('#students .form-switch.attendance').each(function(index, element) {
                    if ($(this).children('input').prop('checked')) {
                        att++;
                    }
                });
                let percentage = att * 100 / totalStudent;
                $('#totalAttendance').html(att);
                $('#success-progress').css('width', percentage + '%');
            }
            countAttendance();
            $('.form-switch.attendance').change(function() {
                countAttendance();
            });

            // $(".end-class").on('click', function(e) {
            //     e.preventDefault();
            //     const form = $("#attendanceForm");

            //     Swal.fire({
            //         title: "Are you sure?",
            //         text: "You won't be able to revert this!",
            //         icon: "warning",
            //         showCancelButton: true,
            //         confirmButtonColor: "#3085d6",
            //         cancelButtonColor: "#d33",
            //         confirmButtonText: "Yes, end it!",
            //         cancelButtonText: "No, cancel!",
            //     }).then((result) => {
            //         if (result.isConfirmed) {
            //             console.log(form);
            //             form.submit();
            //         }
            //     });
            // });

            $("#selectAll").click(function() {
                if ($(this).prop('checked')) {
                    $('.attendance').prop('checked', true);
                } else {
                    $('.attendance').prop('checked', false);
                }
            });

            $('.class-link-update').click(function() {
                id = $(this).attr('id');
                let schedulId = @json($schedule_detail['batch_schedule_id']);
                let batchId = @json($schedule_detail['schedule']['training_batch']['id']);
                let stremingLink = $(this).attr('data-streaming-link');
                let staticLink = $(this).attr('data-static-link');

                $("#streaming_link_update").val(stremingLink);
                $("#static_link_update").val(staticLink);

                $('#link-update-submit').click(function() {
                    let streaming_link = $("#streaming_link_update").val();
                    let static_link = $("#static_link_update").val();

                    let finalUrl =
                        `${app_url}/attendance/change-live-link?schedule_id=${encodeURIComponent(schedulId)}&batch_id=${encodeURIComponent(batchId)}&schedule_detail_id=${encodeURIComponent(id)}&streaming_link=${encodeURIComponent(streaming_link)}&static_link=${encodeURIComponent(static_link)}`;

                    window.location.href = finalUrl;
                });
            });

        });
    </script>
@endpush
