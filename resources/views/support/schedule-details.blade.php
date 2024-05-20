@extends('layouts.auth-master')
@push('css')
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined:opsz,wght,FILL,GRAD@48,700,0,0"
        rel="stylesheet">
    <style>
        .btn-support {
            position: fixed;
            z-index: 99;
            bottom: 25px;
            left: 0;
            right: 0;
            padding-left: 265px;
        }
    </style>
@endpush
@section('content')
    @isset($batch)
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
            <x-alert />
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

                <div class="card p-5">
                    <div class="borderd">
                        <form action="{{ route('support.start-all') }}" method="POST">
                            @csrf
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>S.N.</th>
                                        <th>{{ __('batch-schedule.date') }}</th>
                                        <th>{{ __('batch-schedule.time') }}</th>
                                        <th>{{ __('batch-schedule.class_status') }}</th>
                                        <th> Actions</th>
                                        <th class="text-center">
                                            <input type="checkbox" id="selectAll" class="form-check-input">
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach (collect($schedule_details) as $schedule_detail)
                                        @php
                                            $date = \Carbon\Carbon::createFromFormat('Y-m-d', $schedule_detail['date']);
                                            $start_time = \Carbon\Carbon::createFromFormat(
                                                'H:i:s',
                                                $schedule_detail['start_time'],
                                            );
                                            $end_time = \Carbon\Carbon::createFromFormat(
                                                'H:i:s',
                                                $schedule_detail['end_time'],
                                            );
                                        @endphp
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $date->format('l, d/m/Y') }}</td>
                                            <td>{{ $start_time->format('h:i A') }} - {{ $end_time->format('h:i A') }}</td>
                                            <td>
                                                @isset($schedule_detail['status'])
                                                    @if ($schedule_detail['status'] == 1)
                                                        <span
                                                            class="badge bg-warning text-dark">{{ __('batch-schedule.class_status_waiting') }}</span>
                                                    @else
                                                        <span class="badge bg-primary"></span>
                                                    @endif
                                                @endisset
                                            </td>
                                            <td>
                                                @isset($role)
                                                    @isset($schedule_detail['status'])
                                                        @if ($schedule_detail['status'] == 1 && !$runningClass)
                                                            @if ($date <= \Carbon\Carbon::now())
                                                                <a id="{{ encrypt($schedule_detail['id']) }}"
                                                                    class="btn btn-primary btn-sm update w-100 start-class" type="button"
                                                                    data-bs-toggle="modal" data-bs-target="#classStartModal">
                                                                    {{ __('batch-schedule.start_class') }}
                                                                </a>
                                                            @else
                                                                <button class="btn btn-secondary btn-sm w-100"
                                                                    disabled>{{ __('batch-schedule.start_class') }}</button>
                                                            @endif
                                                        @endif
                                                    @endisset
                                                @endisset
                                            </td>
                                            <input type="hidden" name="batch_id" value="{{ $batch['id'] }}">
                                            <input type="hidden" name="schedule_id" value="{{ $batch['schedule']['id'] }}">
                                            <td class="text-center">
                                                <input type="checkbox" name="schedule_detail_ids[]"
                                                    value="{{ $schedule_detail['id'] }}" class="form-check-input schedule-detail">
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="text-center btn-support">
                                <button type="submit" class="btn btn-lg btn-success">Start All</button>
                            </div>
                        </form>
                    </div>
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
        </div>
    @endisset
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            $("#selectAll").click(function() {
                if ($(this).prop('checked')) {
                    $('.schedule-detail').prop('checked', true);
                } else {
                    $('.schedule-detail').prop('checked', false);
                }
            });

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
        });
    </script>
@endpush
