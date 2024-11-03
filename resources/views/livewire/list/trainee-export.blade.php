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
        $colspan = 10;
    @endphp
    <table>
        <thead style="display: table-header-group;">
            <tr>
                <th colspan="{{ $colspan }}" style="text-align: center; font-size: 25px;">
                    Trainee List
                </th>
            </tr>
            <tr>
                <th colspan="{{ $colspan }}" style="text-align: center; ">
                    Total Trainee Found : {{ count($total_trainee ?? []) }}
                </th>
            </tr>
            <tr>
                <th colspan="{{ $colspan }}" style="text-align: center; ">

                </th>
            </tr>
            <tr>
                <th style="border: 1px solid black;">Sl. No.</th>
                <th style="border: 1px solid black;">Vendor</th>
                <th style="border: 1px solid black;">Division</th>
                <th style="border: 1px solid black;">District</th>
                <th style="border: 1px solid black;">Upazila</th>
                <th style="border: 1px solid black;">Batch Code</th>
                <th style="border: 1px solid black;">Training Title</th>
                <th style="border: 1px solid black;">Name of Trainee</th>
                <th style="border: 1px solid black;">Father</th>
                <th style="border: 1px solid black;">Mother</th>
            </tr>
        </thead>
        <tbody>
            @php
                $providers = collect($providers);
            @endphp
            @forelse  ($total_trainee as $trainee)
                <tr style="text-align: right;">
                    <td style="text-align: center; border: 1px solid black">
                        {{ $loop->iteration }}
                    </td>
                    <td style="border: 1px solid black;">
                        {{ $providers?->where('id', $trainee['training_batch']['provider_id'])?->first()['name'] ?? null }}
                    </td>
                    @php
                        $location = explode(', ', @$trainee['training_batch']['GEOLocation']);
                    @endphp
                    <td style="border: 1px solid black;">{{ @$location[2] }}</td>
                    <td style="border: 1px solid black;">{{ @$location[1] }}</td>
                    <td style="border: 1px solid black;">{{ @$location[0] }}</td>
                    <td style="border: 1px solid black;">{{ @$trainee['training_batch']['batchCode'] }}</td>
                    <td style="border: 1px solid black;">
                        {{ @$trainee['training_batch']['training']['title']['Name'] }}
                    </td>
                    <td style="border: 1px solid black;">{{ @$trainee['profile']['KnownAs'] }}</td>
                    <td style="border: 1px solid black;">{{ @$trainee['profile']['FatherName'] }}</td>
                    <td style="border: 1px solid black;">{{ @$trainee['profile']['MotherName'] }}</td>
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
    </table>

</body>

</html>
