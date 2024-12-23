<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <table class="table table-bordered bg-white">
        @php
            $colspan = 15;
        @endphp
        <tr>
            <th style="font-weight: bold; font-size: 24px;" colspan="{{ $colspan }}">
                Training Batch Detail Information
            </th>
        </tr>
        <tr>
            <th style="" colspan="{{ $colspan }}">
                Generated By: {{ $authProfile['KnownAs'] ?? '' }},
                Generated At: {{ Carbon\Carbon::now()->format('d/m/Y h:i:s A') }},
            </th>
        </tr>
        <tr>
            <th style="font-weight: bold; "colspan="{{ $colspan }}">
                Total :{{ count($total_batches ?? []) }}
            </th>
        </tr>
        <tr>
            <th style="" colspan="{{ $colspan }}">

            </th>
        </tr>
        <tr>
            <th style="font-weight: bold; border: 1px solid #000;">{{ __('batch-list.sl') }}</th>
            <th style="font-weight: bold; border: 1px solid #000;">{{ __('batch-list.batch_code') }}</th>
            <th style="font-weight: bold; border: 1px solid #000;">Phase</th>
            <th style="font-weight: bold; border: 1px solid #000;">Training Title</th>
            <th style="font-weight: bold; border: 1px solid #000;">Training Location</th>
            <th style="font-weight: bold; border: 1px solid #000;">Provider Name</th>
            <th style="font-weight: bold; border: 1px solid #000;">Provider Contact</th>
            <th style="font-weight: bold; border: 1px solid #000;">Trainer Name</th>
            <th style="font-weight: bold; border: 1px solid #000;">Trainer Contact</th>
            <th style="font-weight: bold; border: 1px solid #000;">Total Trainee</th>
            <th style="font-weight: bold; border: 1px solid #000;">Start Date</th>
            <th style="font-weight: bold; border: 1px solid #000;">Total Class Days</th>
            <th style="font-weight: bold; border: 1px solid #000;">Total Completed Class</th>
            <th style="font-weight: bold; border: 1px solid #000;">Total Running Class</th>
            <th style="font-weight: bold; border: 1px solid #000;">Total Remaining Class</th>
        </tr>
        <tbody>
            @foreach (collect($total_batches) as $batch)
                <tr>
                    <td style="border: 1px solid #000;">
                        {{ $loop->iteration }}
                    </td>
                    <td style="border: 1px solid #000;">
                        {{ $batch['batchCode'] }}
                    </td>
                    <td style="border: 1px solid #000;">
                        {{ $batch['batch_phase']['phase']['name_en'] ?? '' }}
                    </td>
                    <td style="border: 1px solid #000;">
                        {{ $batch['get_training']['title']['Name'] ?? '' }}
                    </td>
                    <td style="border: 1px solid #000;">
                        {{ $batch['GEOLocation'] ?? '' }}
                    </td>
                    <td style="border: 1px solid #000;">
                        {{ $batch['provider']['name'] ?? '' }}
                    </td>
                    <td style="border: 1px solid #000;">
                        {{ $batch['provider']['phone'] ?? '' }}
                    </td>
                    <td style="border: 1px solid #000;">
                        @forelse ($batch['provider_trainers'] as $trainer)
                            {{ $trainer['profile']['KnownAsBangla'] ?? '' }}
                            @if (!$loop->last)
                                ,
                            @endif
                        @empty
                        @endforelse
                    </td>

                    <td style="border: 1px solid #000;">
                        @forelse ($batch['provider_trainers'] as $trainer)
                            {{ $trainer['profile']['Phone'] ?? '' }}
                            @if (!$loop->last)
                                ,
                            @endif
                        @empty
                        @endforelse
                    </td>

                    <td style="border: 1px solid #000;">
                        @isset($batch['trainees'])
                            @if ($batch['trainees'] == null)
                                0
                            @else
                                {{ count($batch['trainees']) }}
                            @endif
                        @endisset
                    </td>
                    <td style="border: 1px solid #000;">
                        @if (isset($batch['startDate']))
                            {{ \Carbon\Carbon::parse($batch['startDate'])->format('d/m/Y') }}
                        @endif
                    </td>
                    <td style="border: 1px solid #000;">
                        {{ isset($batch['duration']) ? $batch['duration'] : 0 }}
                    </td>
                    <td style="border: 1px solid #000;">
                        {{ $batch['schedule']['total_complete'] ?? '' }}
                    </td>
                    <td style="border: 1px solid #000;">
                        {{ $batch['schedule']['total_running'] ?? '' }}
                    </td>
                    <td style="border: 1px solid #000;">
                        {{ $batch['schedule']['total_pending'] ?? '' }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
