@extends('layouts.auth-master')
{{-- @dd($providers); --}}
{{-- @dd($providers[0]) --}}
@section('content')
    <!--begin::Content-->
    <div class="m-5">
        <x-alert />
        @isset($results)
            <div class="my-3 d-flex">
                <div class="w-50">
                    <div id="">
                        <h1>{{ 'Schedule Details Informations' }}</h1>
                    </div>

                    <div class="row">
                        <div class="col-md-9">
                            <div>{{ 'Provider' }}: {{ $results['training_batch']['provider']['name'] ?? '' }}</div>
                            <div>{{ 'Batch' }}: {{ $results['training_batch']['batchCode'] ?? '' }}</div>
                            <div>{{ 'Trainning' }}: {{ $results['training_batch']['get_training']['title']['Name'] ?? '' }}</div>
                            <div>{{ 'Location' }}: {{ $results['training_batch']['GEOLocation'] ?? '' }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <table class="table table-bordered bg-white">
                <thead>
                    <th>{{ 'S/N' }}</th>
                    <th>{{ 'Trainer' }}</th>
                    <th>{{ 'Date' }}</th>
                    <th>{{ 'Start Time' }}</th>
                    <th>{{ 'End Time' }}</th>
                    <th>{{ 'Links' }}</th>
                    <th>{{ 'Total Trainee' }}</th>
                    <th>{{ 'Total Present' }}</th>
                    <th>{{ 'Total Absent' }}</th>
                    <th>{{ 'Attendance Rate(%)' }}</th>
                    <th>{{ __('provider-list.action') }}</th>
                </thead>
                <tbody>
                    @foreach (collect($results['schedule_details']) as $schedule)
                        <tr>
                            <td>
                                {{ $loop->iteration }}
                            </td>
                            <td>
                                {{ $schedule['trainer']['KnownAsBangla'] ?? '' }}
                            </td>
                            <td>
                                {{  date('l jS F Y',strtotime($schedule['date'])) ?? '' }}
                            </td>
                            <td>
                                {{ date("h.i A", strtotime($schedule['start_time'])) ?? '' }}
                            </td>
                            <td>
                                {{ date("h.i A", strtotime($schedule['end_time'])) ?? '' }}
                            </td>
                            <td>
                                <a href="{{ $schedule['streaming_link'] }}" class="btn btn-sm btn-secondary" data-name=""
                                    data-bs-toggle="tooltip" data-bs-custom-class="tooltip-inverse" data-bs-placement="bottom"
                                    title="{{ $schedule['streaming_link'] }}">
                                    {{ 'live link' }}
                                </a>
                                <a href="{{ $schedule['static_link'] }}" class="btn btn-sm btn-secondary" data-name=""
                                    data-bs-toggle="tooltip" data-bs-custom-class="tooltip-inverse" data-bs-placement="bottom"
                                    title="{{ $schedule['static_link'] }}">
                                    {{ 'join link' }}
                                </a>
                            </td>
                            <td>
                                {{ count($schedule['attendance']) ?? '' }}
                            </td>
                            <td>
                                @isset($schedule['attendance'])
                                    @php
                                        $present = 0;
                                        foreach ($schedule['attendance'] as $value) {
                                            if ($value['is_present'] == 1) {
                                                $present += 1;
                                            }
                                    } @endphp
                                    {{ $present }}
                                @endisset
                            </td>
                            <td>
                                @isset($schedule['attendance'])
                                    @php
                                        $absent = 0;
                                        foreach ($schedule['attendance'] as $value) {
                                            if ($value['is_present'] == 0) {
                                                $absent += 1;
                                            }
                                    } @endphp
                                    {{ $absent }}
                                @endisset
                            </td>
                            <td>
                                @php
                                    if ($present > 0) {
                                        $percent = ($present * 100) / count($schedule['attendance']);
                                    } else {
                                        $percent = 0;
                                } @endphp
                                {{ round($percent, 2) }}
                            </td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Provider Batch Actions">
                                    @empty(!$schedule['attendance'])
                                        <a href="{{ route('vendor-batch-schedule.attendance', $schedule['id']) }}" class="btn btn-sm btn-success show-loader" data-bs-toggle="tooltip"
                                            data-bs-custom-class="tooltip-inverse" data-bs-placement="bottom"
                                            title="{{ date('l jS \of F Y',strtotime($schedule['date'])).' Attendance Details' }}">
                                            {{ 'Attendance Details' }}
                                        </a>
                                    @else
                                        <a href="" class="btn btn-sm btn-success" data-date="{{ date('l jS \of F Y',strtotime($schedule['date'])) }}" data-bs-toggle="tooltip"
                                            data-bs-custom-class="tooltip-inverse" data-bs-placement="bottom"
                                            title="{{ date('l jS \of F Y',strtotime($schedule['date'])).' Attendance Details' }}" id="attendant">
                                            {{ 'Attendance Details' }}
                                        </a>
                                    @endempty
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endisset
    </div>
    <!--end::Content-->
@section('scripts')
    <script>
        $(document).on("click", "#attendant", function(e) {
            e.preventDefault();
            let date = $(this).attr("data-date");
            Swal.fire({
                title: date,
                text: "There is no attendance on this date!!",
                icon: "warning",
                showCancelButton: false,
            }).then((result) => {});
        });
    </script>
@endsection
@endsection
