@php
    use Carbon\Carbon;
@endphp

<table>
    <thead class="">
        <tr>
            <td colspan="19" style="font-size: 20px; font-weight: 700;">
                Her Power Project
            </td>
        </tr>
        <tr>
            <td colspan="19" style="font-weight: 700;">
                Generate Time: {{ Carbon::now()->format('d-m-Y h:i:s A') }},
                Generate By: {{ Session::get('access_token.authProfile')['KnownAs'] }}
            </td>
        </tr>
        <tr>
            <td colspan="19">

            </td>
        </tr>
        <tr>
            <th style="font-weight: 700;">{{ __('batch-schedule.sl') }}</th>
            <th style="font-weight: 700;">{{ __('batch-schedule.batch_code') }}</th>
            <th style="font-weight: 700;">Traiting Title</th>
            <th style="font-weight: 700;">Date</th>
            <th style="font-weight: 700;">Start Time</th>
            <th style="font-weight: 700;">End Time</th>
            <th style="font-weight: 700;">Location</th>
            <th style="font-weight: 700;">Venue</th>
            <th style="font-weight: 700;">Vendor Name </th>
            <th style="font-weight: 700;">Vendor Contact</th>
            <th style="font-weight: 700;">Vendor Email</th>
            <th style="font-weight: 700;">Trainer Name</th>
            <th style="font-weight: 700;">Trainer Contact</th>
            <th style="font-weight: 700;">Trainer Email</th>
            <th style="font-weight: 700;">Status</th>
            <th style="font-weight: 700;">Late Info</th>
            <th style="font-weight: 700;">Live Streaming Link</th>
            <th style="font-weight: 700;">Video Conference Link</th>
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
                if ((Carbon::parse($batch['date'])->format('Y-m-d') == Carbon::now()->toDateString()) & ($batch['status'] == 1)) {
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
                </td>
                <td>
                    {{ $batch['schedule']['training_batch']['training']['title']['Name'] ?? '' }}
                </td>
                <td>
                    {{ isset($batch['date']) ? digitLocale(Carbon::parse($batch['date'])->format('d-m-Y')) : digitLocale(null) }}
                </td>
                <td>
                    {{ digitLocale($start_time->format('h:i A')) }}
                </td>
                <td>
                    {{ digitLocale($end_time->format('h:i A')) }}
                </td>

                <td>
                    {{ $batch['schedule']['training_batch']['GEOLocation'] ?? '' }}
                </td>
                <td>
                    {{ $batch['schedule']['training_batch']['TrainingVenue'] ?? '' }}
                </td>
                <td>
                    {{ $batch['schedule']['training_batch']['provider']['name'] ?? '' }}

                </td>
                <td>
                    {{ $batch['schedule']['training_batch']['provider']['phone'] ?? '' }}
                </td>
                <td>
                    {{ $batch['schedule']['training_batch']['provider']['email'] ?? '' }}
                </td>
                <td>
                    {{ $trainer['profile']['KnownAs'] ?? '' }}
                </td>
                <td>
                    {{ $trainer['profile']['Phone'] ?? '' }}
                </td>
                <td>
                    {{ $trainer['profile']['Email'] ?? '' }}
                </td>

                <td>
                    @if ($batch['status'] == 1)
                        Class Not Started
                    @elseif ($batch['status'] == 2)
                        Class running
                        @php
                            $class_end_time = Carbon::createFromFormat('Y-m-d H:i:s', $batch['date'] . ' ' . $batch['end_time']);
                        @endphp
                        @if ($now > $class_end_time)
                            but Time Expired
                        @endif
                    @elseif ($batch['status'] == 3)
                        Class Completed
                    @endif

                </td>
                <td>
                    @if ($batch['status'] == 1)
                        @if ($is_late)
                            @if ($end_time->gt($now))
                                Late: {{ "$hours:$minutes:$seconds" }}
                            @endif
                        @endif
                    @endif
                </td>
                <td>
                    {{ $batch['streaming_link'] ?? '' }}
                </td>
                <td>
                    {{ $batch['static_link'] ?? '' }}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
