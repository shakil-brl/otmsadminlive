@extends('layouts.auth-master')

@section('content')
    <!--begin::Content-->
    <div class="m-5">
        <h3>{{__('batch-schedule.batch_schedule')}}</h3>
        @isset($batch)
            <div>
                <h4>{{__('batch-schedule.batch_code')}}: {{ $batch['batchCode'] }}</h4>
                <div>{{__('batch-schedule.course_name')}}:
                    {{ $batch['get_training'] ? ($batch['get_training']['title'] ? $batch['get_training']['title']['Name'] : '') : '' }}
                </div>
                <div>
                    {{__('batch-schedule.start_date')}}: {{ \Carbon\Carbon::parse($batch['startDate'])->format('d-m-Y') }}
                </div>
                <div>
                    {{__('batch-schedule.total_class')}}: {{ $batch['totalTrainees'] ?? '' }} {{__('batch-schedule.days')}}
                </div>
                <div>
                    {{__('batch-schedule.location')}}: {{ $batch['GEOLocation'] ?? '' }}
                </div>
            </div>
        @endisset
        <br>
        <x-alert />
        @isset($schedule_details)
            <table class="table table-bordered bg-white">
                <thead>
                    <th>{{__('batch-schedule.sl')}}</th>
                    <th>{{__('batch-schedule.date')}}</th>
                    <th>{{__('batch-schedule.day')}}</th>
                    <th>{{__('batch-schedule.start_time')}}</th>
                    <th>{{__('batch-schedule.end_time')}}</th>
                    <th>{{__('batch-schedule.status')}}</th>
                    <th>{{__('batch-schedule.action')}}</th>
                </thead>
                <tbody>
                    @foreach (collect($schedule_details) as $schedule_detail)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                @php
                                    $date = \Carbon\Carbon::createFromFormat('Y-m-d', $schedule_detail['date']);
                                @endphp
                                {{ $date->format('d/m/Y') }}
                            </td>
                            <td>
                                {{ $date->format('l') }}
                            </td>
                            <td>{{ $schedule_detail['start_time'] ?? '' }}</td>
                            <td>{{ $schedule_detail['end_time'] ?? '' }}</td>
                            <td>
                                @isset($schedule_detail['status'])
                                    @if ($schedule_detail['status'] == 1)
                                        <span class="badge bg-secondary">{{__('batch-schedule.not_started')}}</span>
                                    @elseif ($schedule_detail['status'] == 2)
                                        <span class="badge bg-warning">{{__('batch-schedule.class_running')}}</span>
                                    @elseif ($schedule_detail['status'] == 3)
                                        <span class="badge bg-success">{{__('batch-schedule.class_completed')}}</span>
                                    @endif
                                @endisset
                            </td>
                            <td>
                                @isset($schedule_detail['status'])
                                    @if ($schedule_detail['status'] == 3)
                                        <a href="{{ route('attendance.schedule', [$schedule_detail['id']]) }}"
                                            class="btn btn-sm btn-info">
                                            {{__('batch-schedule.view')}}
                                        </a>
                                    @else
                                        <button type="button" class="btn btn-sm btn-info" disabled>
                                            {{__('batch-schedule.view')}}
                                        </button>
                                    @endif
                                @endisset
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        @endisset
    </div>
@section('script')
    <script></script>
@endsection
@endsection
