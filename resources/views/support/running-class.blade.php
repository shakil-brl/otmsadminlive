@extends('layouts.auth-master')
@push('css')
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined:opsz,wght,FILL,GRAD@48,700,0,0"
        rel="stylesheet">
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
                        <form action="{{ route('support.end-all') }}" method="POST">
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
                                    @if (count($schedule_details) > 0)
                                        @foreach (collect($schedule_details) as $schedule_detail)
                                            @php
                                                $date = \Carbon\Carbon::createFromFormat(
                                                    'Y-m-d',
                                                    $schedule_detail['date'],
                                                );
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
                                                        @if ($schedule_detail['status'] == 2)
                                                            <span class="badge bg-success text-dark">Running</span>
                                                        @else
                                                            <span class="badge bg-primary"></span>
                                                        @endif
                                                    @endisset
                                                </td>
                                                <td>
                                                    @isset($role)
                                                        @isset($schedule_detail['status'])
                                                            @if ($schedule_detail['status'] == 2)
                                                                <a href="{{ route('attendance.form', [encrypt($schedule_detail['id'])]) }}"
                                                                    class="btn btn-info btn-sm w-100">
                                                                    {{ __('batch-schedule.join_class') }}
                                                                </a>
                                                            @endif
                                                        @endisset
                                                    @endisset
                                                </td>
                                                {{-- <input type="hidden" name="batch_id" value="{{ $batch['id'] }}">
                                        <input type="hidden" name="schedule_id" value="{{ $batch['schedule']['id'] }}"> --}}
                                                <td class="text-center">
                                                    <input type="checkbox" name="schedule_detail_ids[]"
                                                        value="{{ $schedule_detail['id'] }}"
                                                        class="form-check-input schedule-detail">
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="7" class="text-danger">No class running</td>
                                        <tr>
                                    @endif

                                </tbody>
                            </table>
                            <div class="text-center  btn-support">
                                <button type="submit" class="btn btn-lg btn-warning">End All</button>
                            </div>
                        </form>
                    </div>
                </div>
            @endisset
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
        });
    </script>
@endpush
