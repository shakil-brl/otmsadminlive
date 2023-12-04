@extends('layouts.auth-master')

@section('content')
    <!--begin::Content-->
    <div class="m-5">
        <h3>Batch Schedules</h3>
        @isset($batch)
            <div>
                <h4>Batch Code: {{ $batch['batchCode'] }}</h4>
                <div>Training Title:
                    {{ $batch['get_training'] ? ($batch['get_training']['title'] ? $batch['get_training']['title']['Name'] : '') : '' }}
                </div>
                <div>
                    Start Date: {{ \Carbon\Carbon::parse($batch['startDate'])->format('d-m-Y') }}
                </div>
                <div>
                    Total Class: {{ $batch['totalTrainees'] ?? '' }}
                </div>
                <div>
                    Location: {{ $batch['GEOLocation'] ?? '' }}
                </div>
            </div>
        @endisset
        <br>
        <x-alert />
        @isset($schedule_details)
            <table class="table table-bordered bg-white">
                <thead>
                    <th>SL</th>
                    <th>Date</th>
                    <th>Day</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Status</th>
                    <th>Action</th>
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
                                        <span class="badge bg-secondary">Not Started</span>
                                    @elseif ($schedule_detail['status'] == 2)
                                        <span class="badge bg-warning">Class Running</span>
                                    @elseif ($schedule_detail['status'] == 3)
                                        <span class="badge bg-success">Complete</span>
                                    @endif
                                @endisset
                            </td>
                            <td>
                                @isset($schedule_detail['status'])
                                    @if ($schedule_detail['status'] == 3)
                                        <a href="{{ route('attendance.schedule', [$schedule_detail['id']]) }}"
                                            class="btn btn-sm btn-info">
                                            View
                                        </a>
                                    @else
                                        <button type="button" class="btn btn-sm btn-info" disabled>
                                            View
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
