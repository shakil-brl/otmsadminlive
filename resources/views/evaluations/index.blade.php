@extends('layouts.auth-master')
@push('css')
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined:opsz,wght,FILL,GRAD@48,700,0,0"
        rel="stylesheet">   
@endpush
@section('content')
    <!--begin::Content-->
            <div class="m-4">
                <div id="batch-header">
                    <x-alert />
                    <div class="my-3 d-flex">
                        <div class="w-50">
                            <form action="">
                                <div class="d-flex gap-3">
                                    <input type="search" name="search" value="{{ request('search') }}"
                                        class="form-control w-75" placeholder="{{ 'search' }}">
                                    <input type="submit" class="form-control btn btn-primary w-25"
                                        value="{{ 'Search' }}">
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
                                <div class="day-no">
                                    <div class="label">
                                        {{ 'Locations' }} #
                                    </div>
                                    <div class="title">
                                        {{ $schedule_detail['schedule']['training_batch']['GEOLocation'] }}
                                    </div>
                                </div>
                                <div class="day-no">
                                    <div class="label">
                                        {{ 'Vendor' }} #
                                    </div>
                                    <div class="title">
                                        {{ $schedule_detail['schedule']['training_batch']['provider']['name'] }}
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
                                    <div class="right">
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
                                    @if ($user == 'trainer')
                                        <a href="{{ route('trainer-schedule-details.students', [$schedule_detail['id']]) }}"
                                            class="btn btn-lg complete" style="background: #3b0764; color:#fff">
                                            {{ 'Create Evaluations' }}</a>
                                        <a href="{{ route('evaluation-pdf', [$schedule_detail['id']]) }}"
                                            class="btn btn-lg btn-secondary me-1">
                                            {{ 'PDF' }}
                                        </a>
                                    @elseif($user == 'superadmin' || $user == 'provider')
                                        <a href="{{ route('evaluation-pdf', [$schedule_detail['id']]) }}"
                                            class="btn btn-lg btn-secondary me-1">
                                            {{ 'PDF' }}
                                        </a>
                                    @endif

                                </div>
                            </div>
                        @endforeach

                    </div>
                    <div class="row my-5">
                        {!! $paginator->links() !!}
                    </div>
                @endisset


            </div>

@endsection
@push('js')
@endpush
