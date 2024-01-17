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
                <h3>ক্লাস মূল্যায়ন রিপোর্ট</h3>
                <p>This is the content of class evaluation.</p>
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
    <div style="border: 1px solid #E5E5E5; padding:10px">
        <table style="width:100%; border-collapse: collapse;">
            <tr>
                <td>
                    <p>ক্লাসের তারিখ #</p>
                    <b>{{date("F j, Y",strtotime($scheduleDetails['data']['date']))}} {{date('D', strtotime($scheduleDetails['data']['date']))}}</b>
                </td>
                <td>
                    <p>ক্লাস সময় #</p>
                    <b>{{date("h.i A", strtotime($scheduleDetails['data']['schedule']['class_time']))}}</b>
                </td>
                <td>
                    <p>ব্যাচ কোড #</p>
                    <b>{{ $scheduleDetails['data']['schedule']['training_batch']['batchCode'] }}</b>
                </td>
                <td>
                    <p>কোর্সের নাম</p>
                    <b>{{ $scheduleDetails['data']['schedule']['training_batch']['training']['title']['Name'] }}</b>
                </td>
                <td>
                    <p>ঠিকানা</p>
                    <b>{{ $scheduleDetails['data']['schedule']['training_batch']['GEOLocation'] }}</b>
                </td>
                <td>
                    <p>অংশীদার নাম</p>
                    <b>{{ $scheduleDetails['data']['schedule']['training_batch']['provider']['name'] }}</b>
                </td>
                <td>
                    <p>প্রশিক্ষক</p>
                    <b>{{ $scheduleDetails['data']['trainer']['KnownAsBangla'] }}</b>
                </td>
            </tr>
        </table>

    </div>
    <br>
    <table style="width:100%; border-collapse: collapse;" class="table table-bordered mt-1 table-bordered">
        <thead>
            <tr>
                <th class="auto-height">S/N</th>

                <th class="auto-height">Student Name</th>

                <th class="auto-height">Total Score</th>
                <th class="auto-height">Obtained Score</th>
                <th class="auto-height">Percentage</th>
                <th class="auto-height">Remark</th>
            </tr>
        </thead>
        <tbody>
            @empty(!$results['data'])
                @foreach ($results['data'] as $index => $evaluation)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            {{ $evaluation['profile']['KnownAsBangla'] }}
                        </td>
                        <td>
                            {{ $evaluation['total_mark'] }}
                        </td>
                        <td>
                            {{ $evaluation['obtained_mark'] }}
                        </td>
                        <td>
                            {{ round((($evaluation['obtained_mark'] * 100) / $evaluation['total_mark']),2)."%" }}
                        </td>
                        <td>
                            {{ $evaluation['remark'] }}
                        </td>
                    </tr>
                @endforeach
            @endempty
        </tbody>
    </table>

</body>

</html>
