@php
    use Carbon\Carbon;
@endphp
<div>
    <table class="table table-bordered bg-white">
        <thead>
            <tr>
                <th>{{ __('batch-schedule.sl') }}</th>
                <th>{{ __('batch-schedule.batch_code') }}</th>
                <th>{{ __('batch-list.class_detail') }}</th>
                <th>{{ __('batch-list.course_location') }}</th>
                <th>{{ __('batch-list.vendor_info') }}</th>
                <th>{{ __('batch-list.trainer') }}</th>
                <th>Status</th>
                <th class="text-end" style="max-width: 280px;">{{ __('batch-schedule.action') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach (collect($classes) as $batch)
                @php
                    $is_late = 0;
                    $start_time = Carbon::createFromFormat('H:i:s', $batch['start_time']);
                    $strart_time_clone = clone $start_time;
                    $end_time = Carbon::createFromFormat('H:i:s', $batch['end_time']);
                    $now = Carbon::now();

                    if (
                        (Carbon::parse($batch['date'])->format('Y-m-d') == Carbon::now()->toDateString()) &
                        ($batch['status'] == 1)
                    ) {
                        if ($strart_time_clone->addMinutes(30)->lt($now)) {
                            $is_late = 1;

                            $difference = $strart_time_clone->diff($now);
                            // Format the difference
                            $hours = $difference->format('%h');
                            $minutes = $difference->format('%i');
                            $seconds = $difference->format('%s');
                        }
                    }
                @endphp
                <tr @if ($is_late) style="background: rgba(255,0,0,.2);" @endif>
                    <td>
                        {{ digitLocale($from + $loop->index) }}
                    </td>
                    <td>
                        {{ $batch['schedule']['training_batch']['batchCode'] ?? '' }}
                        <small class="d-block">
                            {{ $batch['schedule']['training_batch']['training']['title']['Name'] ?? '' }}
                        </small>
                        {{-- <small class="text-danger">Total Trainees: {{$batch['schedule']['training_batch']['totalTrainees']}}</small>  --}}
                    </td>
                    <td>
                        {{ isset($batch['date']) ? digitLocale(Carbon::parse($batch['date'])->format('d-m-Y')) : digitLocale(null) }}
                        <div>
                            <small>
                                {{ digitLocale($start_time->format('h:i A')) }}
                                -
                                {{ digitLocale($end_time->format('h:i A')) }}
                            </small>
                        </div>
                    </td>
                    <td>
                        {{ $batch['schedule']['training_batch']['GEOLocation'] ?? '' }}
                        <small class="d-block">
                            {{ $batch['schedule']['training_batch']['TrainingVenue'] ?? '' }}
                        </small>
                    </td>
                    <td>
                        {{ $batch['schedule']['training_batch']['provider']['name'] ?? '' }}
                        <br />
                        <a href="callto:+{{ $trainer['profile']['Phone'] ?? '' }}">
                            {{ $batch['schedule']['training_batch']['provider']['phone'] ?? '' }}
                        </a>

                    </td>
                    <td>
                        @isset($batch['schedule']['training_batch']['provider_trainers'])
                            @foreach ($batch['schedule']['training_batch']['provider_trainers'] as $trainer)
                                {{ $trainer['profile']['KnownAs'] ?? '' }}
                                <br />

                                <a href="callto:+{{ $trainer['profile']['Phone'] ?? '' }}">{{ $trainer['profile']['Phone'] ?? '' }}
                                </a>
                            @endforeach
                        @endisset
                    </td>
                    <td>
                        @if ($batch['status'] == 1)
                            <span class="badge badge-secondary">Class Not Started</span>
                            @if ($is_late)
                                @if ($end_time->gt($now))
                                    <div>
                                        <span class="badge badge-danger mt-1">
                                            Late: {{ "$hours:$minutes:$seconds" }}
                                        </span>
                                    </div>
                                @endif
                            @endif
                        @elseif ($batch['status'] == 2)
                            <div>
                                <span class="badge badge-info">Class Running</span>
                            </div>
                            @php
                                $class_end_time = Carbon::createFromFormat(
                                    'Y-m-d H:i:s',
                                    $batch['date'] . ' ' . $batch['end_time'],
                                );
                            @endphp

                            @if ($now > $class_end_time)
                                <span class="badge badge-danger mt-1">Time Expired</span>
                            @endif
                        @elseif ($batch['status'] == 3)
                            <span class="badge badge-success">Class Completed</span>
                        @endif

                    </td>
                    <td>
                        <div class="d-flex flex-wrap gap-1 text-end">
                            @if ($batch['status'] == 2)
                                @if ($batch['streaming_link'])
                                    <a class="btn btn-sm btn-danger" href="{{ $batch['streaming_link'] }}"
                                        target="_blank">
                                        {{ __('batch-schedule.live_streaming') }}
                                    </a>
                                @endif
                                @if ($batch['static_link'])
                                    <a type="button" class="btn btn-sm btn-info" href="{{ $batch['static_link'] }}"
                                        target="_blank">
                                        {{ __('batch-schedule.join_class') }}
                                    </a>
                                @endif
                            @endif
                            @php
                                $inspection_pm = [
                                    'batch_id' => $batch['schedule']['training_batch']['id'],
                                    'schedule_detail_id' => $batch['id'],
                                ];
                            @endphp
                            @isset($inspection_pm)
                                @if ($batch['status'] == 2)
                                    @if (in_array('tms-inspections.create', Session::get('access_token.rolePermission')))
                                        <a class="btn btn-sm btn-primary"
                                            href="{{ route('tms-inspections.create', $inspection_pm) }}" target="_blank">
                                            {{ __('batch-list.inspection') }}
                                        </a>
                                    @endif
                                @endif
                                @if ($batch['status'] >= 2)
                                    <a class="btn btn-sm btn-info"
                                        href="{{ route('attendance.form', encrypt($batch['id'])) }}"
                                        target="_blank">{{ __('batch-list.view_attendance') }}
                                    </a>
                                @endif
                            @endisset
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
