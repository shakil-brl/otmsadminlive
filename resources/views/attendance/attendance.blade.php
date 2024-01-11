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

    .reset-pm .col{
padding: 0em;
margin: 5px;
text-align: center;
    }

 


</style>
</head>
@endpush
@section('content')
<div class="container bg-white shadow my-3">
 <div class="container">
        <div class="row">
          <!-- Left Column (half width) -->
          <div class="col-md-8">
            <div class="box">
              <h2>মাসিক উপস্থিতি রিপোর্ট</h2>
            </div>
          </div>
    
          <!-- Right Column (half width) -->
          <div class="col-md-4">
            <!-- Inner row with 5 columns -->
            <div class="row reset-pm">
              <div class="col">
                <div class="box">
                  <p><img src="{{ asset('img') }}/attendance/logo.png" alt=""></p>
                </div>
              </div>
              <div class="col">
                <div class="box">
                    <img src="{{ asset('img') }}/attendance/gov.png" alt="">
                </div>
              </div>
              <div class="col">
                <div class="box">
                    <img src="{{ asset('img') }}/attendance/ict.png" alt="">
                </div>
              </div>
              <div class="col">
                <div class="box">
                    <img src="{{ asset('img') }}/attendance/doict.png" alt="">
                </div>
              </div>
             
            </div>
          </div>
        </div>
      </div>


        <div class="border my-3">
          <div class="row p-3">
            <div class="col">
                <div class="box">
                  <p>মাস</p>
                  <b>নভেম্বর ২০২৩</b>
                </div>
              </div>
              <div class="col">
                <div class="box">
                  <p>ব্যাচ কোড #</p>
                   <b>নভেম্বর ২০২৩</b>
                </div>
              </div>
              <div class="col">
                <div class="box">
                  <p>কোর্সের নাম</p>
                   <b>নভেম্বর ২০২৩</b>
                </div>
              </div>
              <div class="col">
                <div class="box">
                  <p>ঠিকানা</p>
                   <b>নভেম্বর ২০২৩</b>
                </div>
              </div>
              <div class="col">
                <div class="box">
                  <p>সময়সূচী</p>
                   <b>নভেম্বর ২০২৩</b>
                </div>
              </div>              
              <div class="col">
                <div class="box">
                  <p>প্রশিক্ষণার্থী</p>
                   <b>নভেম্বর ২০২৩</b>
                </div>
              </div>
            <div class="col">
              <div class="box">
                <p>মোট ক্লাস</p>
                 <b>নভেম্বর ২০২৩</b>
              </div>             
            </div>
            <div class="col">
                <div class="box">
                  <p>উপস্থিতি</p>
                   <b>নভেম্বর ২০২৩</b>
                </div>
              </div>
          
            <!-- Repeat this block for the remaining 6 columns -->
          </div>
    </div>
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
</div>

@endsection