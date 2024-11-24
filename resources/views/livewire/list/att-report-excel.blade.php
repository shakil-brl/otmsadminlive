<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        * {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin: auto;
        }

        th,
        td {
            padding: 3px 5px;
        }
    </style>
</head>

<body>
    @php
        $class_dates = $class_attendances?->pluck('class_date')?->unique();
        $total_class = $class_dates?->count();
        if ($with_date) {
            $colspan = 6 + $total_class;
        } else {
            $colspan = 6;
        }
    @endphp
    <table>
        <thead style="display: table-header-group;">
            <tr>
                <th colspan="{{ $colspan }}" style="text-align: left; font-size: 25px;">
                    Attendance Report
                </th>
            </tr>
            <tr>
                <th colspan="{{ $colspan }}" style="text-align: left; ">
                    Report Period : {{ dateView($from_date) }} - {{ dateView($to_date) }}
                </th>
            </tr>
            <tr>
                <th colspan="{{ $colspan }}" style="text-align: left; ">
                    Batch Code : {{ $batch['batchCode'] ?? '' }}
                </th>
            </tr>
            <tr>
                <th colspan="{{ $colspan }}" style="text-align: left; ">
                    Localtion : {{ $batch['GEOLocation'] ?? '' }}
                </th>
            </tr>
            <tr>
                <th colspan="{{ $colspan }}" style="text-align: left; ">
                    Vendor : {{ $batch['provider']['name'] ?? '' }}
                </th>
            </tr>
            <tr>
                <th colspan="{{ $colspan }}" style="text-align: left; ">
                    Generated At: {{ Carbon\Carbon::now()->format('d/m/Y h:i:s A') }}
                </th>
            </tr>
            <tr>
                <th colspan="{{ $colspan }}" style="text-align: left; ">

                </th>
            </tr>
            <tr>

                <th style="white-space: nowrap; border: 1px solid black;">Sl. NO.</th>
                <th style="white-space: nowrap; border: 1px solid black;">Student Name</th>
                <th style="white-space: nowrap; border: 1px solid black;">Student Name Bangla</th>
                @if ($with_date)
                    @foreach ($class_dates as $class_date)
                        <th style="white-space: nowrap; border: 1px solid black;">{{ $class_date }}</th>
                    @endforeach
                @endif
                <th style="white-space: nowrap; border: 1px solid black;">Total Class</th>
                <th style="white-space: nowrap; border: 1px solid black;">Total Present</th>
                <th style="white-space: nowrap; border: 1px solid black;">Attendance Rate (%)</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($class_attendances->pluck('profile_id')->unique() as $profile_id)
                @php
                    $profile = $class_attendances->where('profile_id', $profile_id)->first();
                    $total_student_present = 0;
                @endphp
                <tr>
                    <td style="white-space: nowrap; border: 1px solid black;">{{ $loop->iteration }}</td>
                    <td style="white-space: nowrap; border: 1px solid black;">{{ $profile['student_name'] }}</td>
                    <td style="white-space: nowrap; border: 1px solid black;">{{ $profile['student_name_bn'] }}</td>
                    @foreach ($class_dates as $class_date)
                        @php
                            $class =
                                $class_attendances
                                    ->where('profile_id', $profile_id)
                                    ->where('class_date', $class_date)
                                    ->first() ?? null;
                            if ($class['is_present'] ?? 0) {
                                $total_student_present++;
                            }
                        @endphp
                        @if ($with_date)
                            @if (($class['is_present'] ?? 0) == 1)
                                <td style="white-space: nowrap;  text-align: right; border: 1px solid black;">P</td>
                            @else
                                <td
                                    style="white-space: nowrap; text-align: right; color: red; border: 1px solid black;">
                                    @if ($class != null)
                                        A
                                    @endif
                                </td>
                            @endif
                        @endif
                    @endforeach
                    <td style="white-space: nowrap;  text-align: right; border: 1px solid black;">
                        {{ $total_class }}
                    </td>
                    <td style="white-space: nowrap;  text-align: right; border: 1px solid black;">
                        {{ $total_student_present }}</td>
                    <td style="white-space: nowrap;  text-align: right; border: 1px solid black;">
                        {{ round(($total_student_present * 100) / $total_class, 2) }}%
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="{{ $colspan }}"
                        style="text-align: center; font-size: 20px; border: 1px solid black;">
                        No Data Found
                    </td>
                </tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr>
                <th style="border: 1px solid black; text-align: right; font-weight: bold;" colspan="3">Total</th>
                @if ($with_date)
                    @foreach ($class_dates as $class_date)
                        <th style="white-space: nowrap; border: 1px solid black;">
                            {{ $class_attendances?->where('class_date', $class_date)?->where('is_present', 1)?->count() }}
                        </th>
                    @endforeach
                @endif
                <th style="border: 1px solid black; text-align: right; "></th>
                <th style="border: 1px solid black; text-align: right;"></th>
                <th style="border: 1px solid black; text-align: right;">
                    @php
                        $all_count = $class_attendances?->count();
                        $all_present = $class_attendances?->where('is_present', 1)?->count();
                    @endphp
                    {{ round(($all_present * 100) / $all_count, 2) }}%
                </th>
            </tr>
        </tfoot>
    </table>

</body>

</html>
