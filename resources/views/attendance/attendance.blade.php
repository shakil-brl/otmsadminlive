@extends('layouts.auth-master')
@push('css')
<style>
    @page {
        size: A4 landscape;
        margin: 0;
    }

    body {
        margin: 1.5cm;
    }

    .table th, .table td {
        text-align: center;
        vertical-align: middle;
    }

    .rotated-header {
        transform: rotate(-90deg);
        /* white-space: nowrap; */
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
</style>
<title>Attendance Report</title>
</head>
@endpush
@section('content')
<div class="container bg-warning">
    <h2>Attendance Report</h2>
    <table class="table table-bordered mt-3">
        <thead>
        <tr>
            <th class="auto-height">Student</th>
            <?php for ($day = 1; $day <= 20; $day++): ?>
                <th class="rotated-header auto-height">
                    <span style="white-space: nowrap; font-size:10px">
                        <?= now()->addDays($day)->format('d-m') ?></span>
                </th>
            <?php endfor; ?>
            <th class="auto-height">Monthly %</th>
            <th class="auto-height">Present <br>Absent</th>
        </tr>
        </thead>
        <tbody>
        <?php
        for ($i = 1; $i <= 30; $i++):
            $studentName = 'Student ' . $i;
            $presentCount = 0;
        ?>
            <tr>
                <td><?= $studentName ?></td>
                <?php for ($day = 1; $day <= 20; $day++): ?>
                    <?php
                    $attendanceStatus = rand(0, 1) == 1 ? 'P' : 'A';
                    $presentCount += $attendanceStatus === 'P' ? 1 : 0;
                    ?>
                    <td><?= $attendanceStatus ?></td>
                <?php endfor; ?>
                <?php
                $monthlyPercentage = ($presentCount / 20) * 100;
                $absentCount = 20 - $presentCount;
                ?>
                <td><?= round($monthlyPercentage, 2) ?>%</td>
                <td><?= $presentCount ?> / <?= $absentCount ?></td>
            </tr>
        <?php endfor; ?>
        </tbody>
    </table>
</div>

@endsection