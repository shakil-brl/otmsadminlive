@extends('layouts.auth-master')
@push('css')
<style>
    .table th,
    .table td {
        text-align: center;
        vertical-align: middle;
    }

    .rotated-header {
        transform: rotate(-90deg);
        white-space: nowrap;
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
@endpush
@section('content')
<div class="container">
    <h2>Attendance Report</h2>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th class="auto-height">Student</th>
                <?php for ($day = 1; $day <= 20; $day++): ?>
                <th class="rotated-header auto-height">
                    <?= now()->addDays($day)->format('d-m-Y') ?>
                </th>
                <?php endfor; ?>
                <th class="auto-height">Monthly %</th>
                <th class="auto-height"># Present</th>
                <th class="auto-height"># Absent</th>
            </tr>
        </thead>
        <tbody>
            <?php
        for ($i = 1; $i <= 30; $i++):
            $studentName = 'Student ' . $i;
            $presentCount = 0;
        ?>
            <tr>
                <td>
                    <?= $studentName ?>
                </td>
                <?php for ($day = 1; $day <= 20; $day++): ?>
                <?php
                    $attendanceStatus = rand(0, 1) == 1 ? 'P' : 'A';
                    $presentCount += $attendanceStatus === 'P' ? 1 : 0;
                    ?>
                <td>
                    <?= $attendanceStatus ?>
                </td>
                <?php endfor; ?>
                <?php
                $monthlyPercentage = ($presentCount / 20) * 100;
                $absentCount = 20 - $presentCount;
                ?>
                <td>
                    <?= round($monthlyPercentage, 2) ?>%
                </td>
                <td>
                    <?= $presentCount ?>
                </td>
                <td>
                    <?= $absentCount ?>
                </td>
            </tr>
            <?php endfor; ?>
        </tbody>
    </table>
</div>

@endsection