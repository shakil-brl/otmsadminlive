@extends('layouts.auth-master')
@push('css')
<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined:opsz,wght,FILL,GRAD@48,700,0,0"
    rel="stylesheet">
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
        <a href="{{ route('batch-schedule.batches') }}" class="text-muted text-hover-primary">{{
            __('batch-schedule.provider_batch_list') }}</a>
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
    <div id="batch-header">
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

    @isset($schedule_details)
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
            <div class="class-time-detail">
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
            <div class="button-area">

                @isset($role)
                @if ($role!='provider' )
                @isset($schedule_detail['status'])
                @if ($schedule_detail['status'] == 1)
                @if ($date <= \Carbon\Carbon::now()) <a id="{{ $schedule_detail['id'] }}"
                    class="btn btn-detail start-class  update" title="{{ $role}}" type="button" data-bs-toggle="modal"
                    data-bs-target="#classStartModal" type="button">
                    {{ __('batch-schedule.start_class') }}
                    </a>
                    @else
                    <a class="btn disabled btn-detail  update">
                        {{ __('batch-schedule.start_class') }}
                    </a>
                    @endif
                    @elseif ($schedule_detail['status'] == 2)
                    <a href="{{ route('attendance.form', [$schedule_detail['id']]) }}" class="btn btn-detail ">
                        {{ __('batch-schedule.join_class') }}
                    </a>
                    @elseif ($schedule_detail['status'] == 3)
                    <a href="{{ route('attendance.form', [$schedule_detail['id']]) }}" class="btn btn-detail complete">
                        {{ __('batch-schedule.class_details') }}</a>
                    @endif
                    @endisset
                    @endisset
                    @endif


            </div>
        </div>
        @endforeach
    </div>
    @endisset

    <!--Start::Provider Update Modal-Content-->
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
                        <label for="" class="mb-1">Streaming Link</label>
                        <input id="streaming_link" type="text" class="form-control">
                    </div>
                    <div class="mb-2">
                        <label for="" class="mb-1">Live Class Link</label>
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
    <!--End::Provider Update Modal-->


</div>

@endsection
@push('js')
<script>
    $(document).ready(function() {
            var app_url = "{{ url('') }}";
            var id = $(this).attr('id');
            $('.start-class').click(function() {
                id = $(this).attr('id');
            });
            $('#start-class').click(function() {
                let streaming_link = $("#streaming_link").val();
                let static_link = $("#static_link").val();

                let finalUrl =
                    `${app_url}/attendance/${id}/start?streaming_link=${encodeURIComponent(streaming_link)}&static_link=${encodeURIComponent(static_link)}`;
                window.location.href = finalUrl;
            });
        });
</script>
@endpush