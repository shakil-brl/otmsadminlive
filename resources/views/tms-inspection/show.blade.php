@extends('front.layouts.app')

@section('title')
    <h1 class="title">Show Tms Inspection</h1>
@endsection

@section('content')
    @includeif('component.alert')
    <div class="card">
        <div class="card-body">
            
                        <div class="form-group">
                            <strong>Batch Id:</strong>
                            {{ $tmsInspection->batch_id }}
                        </div>
                        <div class="form-group">
                            <strong>Class No:</strong>
                            {{ $tmsInspection->class_no }}
                        </div>
                        <div class="form-group">
                            <strong>Lab Size:</strong>
                            {{ $tmsInspection->lab_size }}
                        </div>
                        <div class="form-group">
                            <strong>Electricity:</strong>
                            {{ $tmsInspection->electricity }}
                        </div>
                        <div class="form-group">
                            <strong>Internet:</strong>
                            {{ $tmsInspection->internet }}
                        </div>
                        <div class="form-group">
                            <strong>Lab Bill:</strong>
                            {{ $tmsInspection->lab_bill }}
                        </div>
                        <div class="form-group">
                            <strong>Lab Attendance:</strong>
                            {{ $tmsInspection->lab_attendance }}
                        </div>
                        <div class="form-group">
                            <strong>Computer:</strong>
                            {{ $tmsInspection->computer }}
                        </div>
                        <div class="form-group">
                            <strong>Router:</strong>
                            {{ $tmsInspection->router }}
                        </div>
                        <div class="form-group">
                            <strong>Projector:</strong>
                            {{ $tmsInspection->projector }}
                        </div>
                        <div class="form-group">
                            <strong>Student Laptop:</strong>
                            {{ $tmsInspection->student_laptop }}
                        </div>
                        <div class="form-group">
                            <strong>Lab Security:</strong>
                            {{ $tmsInspection->lab_security }}
                        </div>
                        <div class="form-group">
                            <strong>Lab Register:</strong>
                            {{ $tmsInspection->lab_register }}
                        </div>
                        <div class="form-group">
                            <strong>Class Regularity:</strong>
                            {{ $tmsInspection->class_regularity }}
                        </div>
                        <div class="form-group">
                            <strong>Trainer Attituted:</strong>
                            {{ $tmsInspection->trainer_attituted }}
                        </div>
                        <div class="form-group">
                            <strong>Trainer Tab Attendance:</strong>
                            {{ $tmsInspection->trainer_tab_attendance }}
                        </div>
                        <div class="form-group">
                            <strong>Upazila Audit:</strong>
                            {{ $tmsInspection->upazila_audit }}
                        </div>
                        <div class="form-group">
                            <strong>Upazila Monitoring:</strong>
                            {{ $tmsInspection->upazila_monitoring }}
                        </div>
                        <div class="form-group">
                            <strong>Remark:</strong>
                            {{ $tmsInspection->remark }}
                        </div>
                        <div class="form-group">
                            <strong>Asset List:</strong>
                            {{ $tmsInspection->asset_list }}
                        </div>
                        <div class="form-group">
                            <strong>Created By:</strong>
                            {{ $tmsInspection->created_by }}
                        </div>
                        <div class="form-group">
                            <strong>Updated By:</strong>
                            {{ $tmsInspection->updated_by }}
                        </div>
                        <div class="form-group">
                            <strong>Updated At:</strong>
                            {{ $tmsInspection->Updated_at }}
                        </div>

        </div>
    </div>
@endsection
