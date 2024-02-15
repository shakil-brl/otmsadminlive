@extends('layouts.auth-master')
@push('css')
    <style>
        @page {
            size: A4 landscape;
            margin: 0;
        }

        table {
            width: 100%;
        }

        .span-color-red {
            background-color: red;
            color: white;
        }

        .table th,
        .table td {
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

        .reset-pm .col {
            padding: 0em;
            margin: 5px;
            text-align: center;
        }
    </style>
@endpush
@section('content')
    <!--begin::Content-->
    <div class="m-5">
        <x-alert />

        <div class="row bg-white">
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
        <div class="my-3 d-flex">
            <div class="w-70">
                <form action="">
                    <div class="d-flex gap-20">
                        <div class="">
                            <label for="">Batch</label>
                            <input type="search" name="batchCode" value="{{ request('batchCode') }}" class="form-control"
                                placeholder="{{ __('batch-list.search_here') }}">
                        </div>
                        <div class="">
                            <label for="">From Date</label>
                            <input type="date" name="startDate" value="{{ request('startDate') }}" class="form-control">
                        </div>
                        <div class="">
                            <label for="">To Date</label>
                            <input type="date" name="endDate" value="{{ request('endDate') }}" class="form-control">
                        </div>
                        <div class="">
                            <label for=""></label>
                            <input type="submit" class="form-control btn btn-primary"
                                value="{{ __('batch-list.search') }}">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="border my-3 bg-white">
            <div class="row p-3">
                <div class="col">
                    <div class="box">
                        <p>মাস</p>
                        @isset($month)
                            <b>{{ $month }}</b>
                        @endisset
                    </div>
                </div>
                <div class="col">
                    <div class="box">
                        <p>ব্যাচ কোড #</p>
                        @isset($schedule)
                            @empty(!$schedule)
                                <b>{{ $schedule[0]['schedule']['training_batch']['batchCode'] }}</b>
                            @endempty
                        @endisset
                    </div>
                </div>
                <div class="col">
                    <div class="box">
                        <p>কোর্সের নাম</p>
                        @isset($schedule)
                            @empty(!$schedule)
                                <b>{{ $schedule[0]['schedule']['training_batch']['get_training']['title']['Name'] }}</b>
                            @endempty
                        @endisset
                    </div>
                </div>
                <div class="col">
                    <div class="box">
                        <p>ঠিকানা</p>
                        @isset($schedule)
                            @empty(!$schedule)
                                <b>{{ $schedule[0]['schedule']['training_batch']['GEOLocation'] }}</b>
                            @endempty
                        @endisset
                    </div>
                </div>
                <div class="col">
                    <div class="box">
                        <p>সময়সূচী</p>
                        @isset($schedule)
                            @empty(!$schedule)
                                <b>{{ $schedule[0]['schedule']['class_days'] }}<br />{{ date('h:i A', strtotime($schedule[0]['schedule']['class_time'])) }}</b>
                            @endempty
                        @endisset
                    </div>
                </div>
                <div class="col">
                    <div class="box">
                        <p>প্রশিক্ষণার্থী</p>
                        @isset($schedule)
                            @empty(!$schedule)
                                <b>{{ $schedule[0]['trainer']['KnownAsBangla'] }}</b>
                            @endempty
                        @endisset
                    </div>
                </div>
                <div class="col">
                    <div class="box">
                        <p>মোট ক্লাস</p>
                        @isset($schedule)
                            @empty(!$schedule)
                                <b>{{ count($schedule) }}</b>
                            @endempty
                        @endisset
                    </div>
                </div>
                <div class="col">
                    <div class="box">
                        <p>উপস্থিতি</p>
                        @isset($schedule)
                            @empty(!$schedule)
                                <b></b>
                            @endempty
                        @endisset
                    </div>
                </div>

                <!-- Repeat this block for the remaining 6 columns -->
            </div>
        </div>
        <div class="row">
            <table class="table table-bordered mt-3 bg-white">
                @isset($schedule)
                    @empty(!$schedule)
                        <thead>
                            <tr>
                                <th class="auto-height">Student</th>
                                @foreach ($schedule as $index => $row)
                                    <th class="rotated-header auto-height">
                                        <span style="white-space: nowrap; font-size:10px">
                                            {{ $row['date'] }}
                                        </span>
                                    </th>
                                @endforeach
                                <th class="auto-height">Monthly %</th>
                                <th class="auto-height">Present <br>Absent</th>
                            </tr>
                        </thead>
                    @endempty
                @endisset
                @isset($students)
                    @empty(!$students)
                        @empty(!$schedule)
                            <tbody>
                                @foreach ($students as $index => $student)
                                    <tr>
                                        <td>{{ $student['profile']['KnownAs'] }}</td>
                                        @isset($schedule)
                                            <?php
                                            $presentCount = 0;
                                            ?>
                                            @foreach ($schedule as $index => $row)
                                                <?php
                                                $count = 0;
                                                ?>
                                                @foreach ($data as $index1 => $present)
                                                    @if ($row['id'] == $present['batch_schedule_detail_id'] && $row['date'] == $present['schedule_detail']['date'])
                                                        @if ($student['profile']['id'] == $present['profile']['id'])
                                                            @if ($present['is_present'] == 1)
                                                                @php
                                                                    $presentCount++;
                                                                    $count++;
                                                                @endphp
                                                            @else
                                                                @php $count++; @endphp
                                                            @endif
                                                            <td>{{ $present['is_present'] == 1 ? 'P' : 'A' }}</td>
                                                        @endif
                                                    @endif
                                                @endforeach
                                                @if ($count == 0)
                                                    <td>{{ ' ' }}</td>
                                                @else
                                                    @php $count = 0; @endphp
                                                @endif
                                            @endforeach
                                            <?php
                                            
                                            $monthlyPercentage = ($presentCount / count($schedule)) * 100;
                                            $absentCount = count($schedule) - $presentCount;
                                            ?>
                                        @endisset
                                        <td><?= round($monthlyPercentage, 2) ?>%</td>
                                        <td><?= $presentCount ?> / <?= $absentCount ?></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        @endempty
                    @endempty
                @endisset
            </table>
        </div>
    </div>
@endsection
