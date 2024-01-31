@extends('layouts.auth-master')

@section('content')
    <!--begin::Content-->
    <div class="m-5">
        <h3>{{ __('batch-list.batches_list') }}</h3>
        <table class="table table-bordered bg-white">
            <thead>
                <th>{{ __('batch-list.sl') }}</th>
                <th>{{ __('batch-list.batch_code') }}</th>
                <th>{{ __('batch-list.course_name') }}</th>
                <th>{{ __('batch-list.location') }}</th>
                <th>{{ __('batch-list.start_date') }}</th>
                <th>{{ __('batch-list.total_class') }}</th>
                <th>{{ __('batch-list.class_schedule') }}</th>
                <th>{{ __('batch-list.action') }}</th>
            </thead>
            <tbody>
                @foreach ($results ?? [] as $index => $batch)
                    @php
                        $schedule = $batch['schedule'] ?? null;
                    @endphp
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $batch['batchCode'] }}</td>
                        <td>
                            {{ $batch['get_training'] ? ($batch['get_training']['title'] ? $batch['get_training']['title']['Name'] : '') : '' }}
                        </td>
                        <td>{{ $batch['GEOLocation'] }}</td>
                        <td>
                            {{ \Carbon\Carbon::parse($batch['startDate'])->format('d-m-Y') }}
                        </td>
                        <td>{{ $batch['duration'] }} {{ __('batch-list.days') }}</td>
                        <td>
                            @if ($schedule !== null)
                                <span> Days: {{ $schedule['class_days'] }}</span><br>
                                <div class="mt-1 d-flex justify-content-between align-item-center">
                                    <span>Time: {{ $schedule['class_time'] }}</span>
                                    <span>Time: {{ $schedule['class_duration'] }} Hours</span>
                                </div>
                            @else
                            @endif
                        </td>
                        <td>
                            @if ($schedule == null)
                                <a href="{{ route('batch-schedule.create', encrypt($batch['id'])) }}"
                                    class="btn btn-sm btn-primary">
                                    {{ __('batch-list.create_schedule') }}</a>
                            @else
                                <a href="{{ route('batch-schedule.index', [encrypt($schedule['id']), encrypt($batch['id'])]) }}"
                                    class="btn btn-sm btn-info"> {{ __('batch-list.view_schedule') }}</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
