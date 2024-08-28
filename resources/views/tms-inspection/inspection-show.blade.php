@extends('layouts.auth-master')

@section('template_title')
    {{ __('Create') }} Tms Inspection
@endsection
@push('css')
    <style>
        .ck.ck-reset.ck-editor.ck-rounded-corners {
            width: 100%;
        }
    </style>
@endpush
@section('content')
    <section class="content container-fluid">
        <div class="mx-5 mt-5">
            <x-batch-header :batch="$batch" />


            <div class=" mt-5">
                <div class="mb-5  text-center">
                    <h2 class="card-title">Inspection Report</h2>

                    @php
                        $inspection_pm = [
                            'batch_id' => $batch['id'],
                            'schedule_detail_id' => 1,
                        ];
                    @endphp
                    <a class="btn btn-primary mt-3" href="{{ route('tms-inspections.create', $inspection_pm) }}">
                        New
                        Inspection
                    </a>
                </div>

                <div class=" ">
                    <table class="table bg-white mb-5 table-sm table-bordered" style="font-size: 12px;">
                        <thead class="bg-secondary">
                            <tr>
                                <th>Visit Date</th>
                                <th>Visited By</th>
                                <th>Class No</th>
                                <th>Lab Size</th>
                                <th>Electricity</th>
                                <th>Internet</th>
                                <th>Lab Bill</th>
                                <th>Lab Attendance</th>
                                <th>Computer</th>
                                <th>Router</th>
                                <th>Projector</th>
                                <th>Student Laptop</th>
                                <th>Lab Security</th>
                                <th>Lab Register</th>
                                <th>Class Regularity</th>
                                <th>Trainer Attitude</th>
                                <th>Trainer Tab Attendance</th>
                                <th>Upazila Audit</th>
                                <th>Upazila Monitoring</th>
                                <th>Remark</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($batch['inspections'] as $inspection)
                                @php($inspection = (object) $inspection)
                                <tr>
                                    <td>
                                        {{ dateView($inspection->visit_date) }}
                                    </td>
                                    <td>
                                        {{ $inspection->created_by['KnownAsBangla'] ?? '' }}
                                    </td>
                                    <td>{{ $inspection->class_no }}</td>
                                    <td>
                                        @if ($inspection->lab_size)
                                            <span class="badge1 bg-success1">Yes</span>
                                        @else
                                            <span class="badge1 bg-danger1 text-danger">No</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($inspection->electricity)
                                            <span class="badge1 bg-success1">Yes</span>
                                        @else
                                            <span class="badge1 bg-danger1 text-danger">No</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($inspection->internet)
                                            <span class="badge1 bg-success1">Yes</span>
                                        @else
                                            <span class="badge1 bg-danger1 text-danger">No</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($inspection->lab_bill)
                                            <span class="badge1 bg-success1">Yes</span>
                                        @else
                                            <span class="badge1 bg-danger1 text-danger">No</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($inspection->lab_attendance)
                                            <span class="badge1 bg-success1">Yes</span>
                                        @else
                                            <span class="badge1 bg-danger1 text-danger">No</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($inspection->computer)
                                            <span class="badge1 bg-success1">Yes</span>
                                        @else
                                            <span class="badge1 bg-danger1 text-danger">No</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($inspection->router)
                                            <span class="badge1 bg-success1">Yes</span>
                                        @else
                                            <span class="badge1 bg-danger1 text-danger">No</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($inspection->projector)
                                            <span class="badge1 bg-success1">Yes</span>
                                        @else
                                            <span class="badge1 bg-danger1 text-danger">No</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($inspection->student_laptop)
                                            <span class="badge1 bg-success1">Yes</span>
                                        @else
                                            <span class="badge1 bg-danger1 text-danger">No</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($inspection->lab_security)
                                            <span class="badge1 bg-success1">Yes</span>
                                        @else
                                            <span class="badge1 bg-danger1 text-danger">No</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($inspection->lab_register)
                                            <span class="badge1 bg-success1">Yes</span>
                                        @else
                                            <span class="badge1 bg-danger1 text-danger">No</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($inspection->class_regularity)
                                            <span class="badge1 bg-success1">Yes</span>
                                        @else
                                            <span class="badge1 bg-danger1 text-danger">No</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($inspection->trainer_attituted)
                                            <span class="badge1 bg-success1">Yes</span>
                                        @else
                                            <span class="badge1 bg-danger1 text-danger">No</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($inspection->trainer_tab_attendance)
                                            <span class="badge1 bg-success1">Yes</span>
                                        @else
                                            <span class="badge1 bg-danger1 text-danger">No</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($inspection->upazila_audit)
                                            <span class="badge1 bg-success1">Yes</span>
                                        @else
                                            <span class="badge1 bg-danger1 text-danger">No</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($inspection->upazila_monitoring)
                                            <span class="badge1 bg-success1">Yes</span>
                                        @else
                                            <span class="badge1 bg-danger1 text-danger">No</span>
                                        @endif
                                    </td>
                                    <td>{{ $inspection->remark }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>


                </div>
            </div>

        </div>
    </section>
@endsection
