@extends('front.layouts.app')

@section('title')
    <h1 class="title">Show Tms Class Attendance</h1>
@endsection

@section('content')
    @includeif('component.alert')
    <div class="card">
        <div class="card-body">
            
                        <div class="form-group">
                            <strong>Batch Schedule Detail Id:</strong>
                            {{ $tmsClassAttendance->batch_schedule_detail_id }}
                        </div>
                        <div class="form-group">
                            <strong>Profileid:</strong>
                            {{ $tmsClassAttendance->ProfileId }}
                        </div>
                        <div class="form-group">
                            <strong>Is Present:</strong>
                            {{ $tmsClassAttendance->is_present }}
                        </div>
                        <div class="form-group">
                            <strong>Joining Time:</strong>
                            {{ $tmsClassAttendance->joining_time }}
                        </div>

        </div>
    </div>
@endsection
