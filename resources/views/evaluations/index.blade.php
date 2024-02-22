@extends('layouts.auth-master')
@push('css')
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined:opsz,wght,FILL,GRAD@48,700,0,0"
        rel="stylesheet">
@endpush
@section('content')
    <!--begin::Content-->
    <div class="m-4">
        <div id="d-flex flex-column">
            <x-alert />
            <div class="my-3 d-flex">
                <div class="w-50">
                    <form action="">
                        <div class="d-flex gap-3">
                            <input type="search" name="search" value="{{ request('search') }}" class="form-control w-75"
                                placeholder="{{ 'search' }}">
                            <input type="submit" class="form-control btn btn-primary w-25" value="{{ 'Search' }}">
                        </div>
                    </form>
                </div>
            </div>
        </div>


        @isset($evaluation)
            <div id="class-days">
                @foreach (collect($evaluation) as $schedule_detail)
                    @php
                        $date = \Carbon\Carbon::createFromFormat('Y-m-d', $schedule_detail['date']);
                        $start_time = \Carbon\Carbon::createFromFormat('H:i:s', $schedule_detail['start_time']);
                        $end_time = \Carbon\Carbon::createFromFormat('H:i:s', $schedule_detail['end_time']);
                    @endphp
                    <div class="day">
                        <div class="day-no">
                            <div class="label">
                                {{ __('batch-schedule.batch_code') }} #
                            </div>
                            <div class="title">
                                {{ $schedule_detail['schedule']['training_batch']['batchCode'] }}
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
                                        @if ($schedule_detail['status'] == 2)
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

                            @isset($schedule_detail['status'])
                                @if ($schedule_detail['status'] == 2)
                                    <a href="{{ route('trainer-schedule-details.students', [$schedule_detail['id']]) }}"
                                        class="btn btn-detail complete">
                                        {{ 'Create Evaluations' }}
                                    </a>
                                @elseif ($schedule_detail['status'] == 3)
                                    <a href="{{ route('trainer-schedule-details.students', [$schedule_detail['id']]) }}"
                                        class="btn btn-detail complete">
                                        {{ 'Create Evaluations' }}</a>
                                @endif
                            @endisset

                        </div>
                    </div>
                @endforeach

            </div>
            <div class="row my-5">
                {!! $paginator->links() !!}
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
