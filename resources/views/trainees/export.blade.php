<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Trainee Export</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div>
        @php
            $first_trainee = collect($trainees)->first() ?? [];
            $batch = $first_trainee['training_batch'] ?? [];
        @endphp
        <table>
            <tr>
                @php
                    $colspan = 8;
                @endphp
            <tr>
                <th style="font-weight: bold; font-size: 24px;" colspan="{{ $colspan }}">
                    Her Power Trainee List
                </th>
            </tr>
            <tr>
                <th style="" colspan="{{ $colspan }}">
                    Generated By: {{ $authProfile['KnownAs'] ?? '' }},
                    Generated At: {{ Carbon\Carbon::now()->format('d/m/Y h:i:s A') }}
                </th>
            </tr>
            <tr>
                <th style="font-weight: bold; "colspan="{{ $colspan }}">
                    Total :{{ count($trainees ?? []) }}
                </th>
            </tr>
            <tr>
                <th style="" colspan="{{ $colspan }}">

                </th>
            </tr>
            <tr>
                <td style="border: 1px solid #000;" colspan="2">
                    <div><strong>Batch Code: </strong> {{ $batch['batchCode'] ?? '' }}</div>
                </td>
                <td style="border: 1px solid #000;" colspan="2">
                    <div><strong>Course Name: </strong> {{ $batch['training']['title']['Name'] ?? '' }}</div>
                </td>
                <td style="border: 1px solid #000;" colspan="2">
                    <div><strong>Address: </strong> {{ $batch['GEOLocation'] ?? '' }}</div>
                </td>
                <td style="border: 1px solid #000;" colspan="2">
                    <div><strong>Total Class Days: </strong> {{ $batch['duration'] ?? '' }} Days</div>
                </td>
            </tr>
        </table>

        <table>
            <thead>
                <tr>
                    <th style="font-weight: bold; border: 1px solid #000;">সিরিয়াল নং</th>
                    <th style="font-weight: bold; border: 1px solid #000;">নাম</th>
                    <th style="font-weight: bold; border: 1px solid #000;">ইমেইল</th>
                    <th style="font-weight: bold; border: 1px solid #000;">জাতীয় পরিচয়পত্র</th>
                    <th style="font-weight: bold; border: 1px solid #000;">মোবাইল নং</th>
                    <th style="font-weight: bold; border: 1px solid #000;">পিতার নাম</th>
                    <th style="font-weight: bold; border: 1px solid #000;">মাতার নাম</th>
                    <th style="font-weight: bold; border: 1px solid #000;">বর্তমান ঠিকানা</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($trainees as $trainee)
                    <tr>
                        <td style="border: 1px solid #000;">{{ $loop->iteration }}</td>
                        <td style="border: 1px solid #000;">{{ $trainee['profile']['KnownAs'] ?? '' }}</td>
                        <td style="border: 1px solid #000;">{{ $trainee['profile']['Email'] ?? '' }}</td>
                        <td style="border: 1px solid #000;">{{ '\ ' . $trainee['profile']['NID'] ?? '' }}</td>
                        <td style="border: 1px solid #000;">{{ $trainee['profile']['Phone'] ?? '' }}</td>
                        <td style="border: 1px solid #000;">{{ $trainee['profile']['FatherNameBangla'] ?? '' }}</td>
                        <td style="border: 1px solid #000;">{{ $trainee['profile']['MotherNameBangla'] ?? '' }}</td>
                        <td style="border: 1px solid #000;">{{ $trainee['profile']['address_present'] ?? '' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
