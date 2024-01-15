<!DOCTYPE html>
<html lang="en">

<head>
    <!-- ... (unchanged) ... -->
    <style>
        body {
            font-family: 'bangla', sans-serif;
        }

        .table th,
        .table td {
            text-align: center;
            vertical-align: middle;
            border: 1px solid #dee2e6;
            /* Bootstrap table border */
        }

        .rotated-header {
            writing-mode: vertical-lr;
            /* Vertical text, from left to right */
            transform: rotate(180deg);
            /* For browsers that support transform property */
        }

        .auto-height {
            height: auto !important;
        }

        .percentage-row {
            font-weight: bold;
        }

        .container {
            margin-top: 50px;
        }

        .reset-pm .col {
            padding: 0em;
            margin: 5px;
            text-align: center;
        }

        /* Custom styles for the table borders */
        .table-bordered {
            border-collapse: collapse;
        }

        .table-bordered th,
        .table-bordered td {
            border: 1px solid #dee2e6;
            /* Bootstrap table border */
            padding: 8px;
            /* Adjust as needed */
        }

        .box {
            border: 1px solid #dee2e6;
            /* Bootstrap table border */
            padding: 10px;
            margin-bottom: 10px;
        }

        /* Added style to prevent line breaks in student names */
        .nowrap {
            white-space: nowrap;
        }

        .container {
            width: 100%;
            margin: 0 auto;
            padding: 10px;
        }

        .row::after {
            content: "";
            clear: both;
            display: table;
        }

        .col-md-8 {
            width: 66.66%;
            float: left;
        }

        .col-md-4 {
            width: 33.33%;
            float: left;
        }

        .box {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 10px;
        }

        img {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>

<body>

    <table style="border-collapse: collapse;">
        <tr>
            <!-- First Column -->
            <td style="width: 80%; padding: 10px; vertical-align: top;">
                <h3>সমস্ত অংশীদার রিপোর্ট</h3>
            </td>

            <!-- Second Column -->
            <td style="width: 30%; vertical-align: top;">

                <!-- Nested Table (4 Columns) -->
                <table style="width:100%; border-collapse: collapse; pading:0">
                    <tr>
                        <td>
                        </td>
                        <td style="width: 50%; padding: 5px; text-align: right;">
                            <img src="img/attendance/logo.png">
                        </td>
                        <td style="width: 10%; padding: 5px; text-align: right;">
                            <img src="img/attendance/gov.png">
                        </td>
                        <td style="width:20%; padding: 5px; text-align: right;">
                            <img src="img/attendance/ict.png">
                        </td>
                        <td style="width: 20%; padding: 5px; ">
                            <img src="img/attendance/doict.png">
                        </td>
                    </tr>
                </table>

            </td>
        </tr>
    </table>
    <br>

    <table style="width:100%; border-collapse: collapse;" class="table table-bordered mt-1 table-bordered">
        <thead>
            <tr>
                <th class="auto-height">S/N</th>

                <th class="auto-height">Vendor Name</th>

                <th class="auto-height">Email</th>
                <th class="auto-height">Phone</th>

                <th class="auto-height">
                    Address
                </th>
            </tr>
        </thead>
        <tbody>
            @empty(!$provider_results['data'])
                @foreach ($provider_results['data'] as $index => $provider)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            {{$provider['name']}}
                        </td>
                        <td>
                            {{$provider['email']}}
                        </td>
                        <td>
                            {{$provider['phone']}}
                        </td>
                        <td>
                            {{$provider['address']}}
                        </td>
                    </tr>
                @endforeach
            @endempty
        </tbody>
    </table>

</body>

</html>
