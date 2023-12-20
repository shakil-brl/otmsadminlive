@extends('front.layouts.app')

@section('title')
    <h1 class="title">Show Tms Batch Schedule Detail</h1>
@endsection

@section('content')
    @includeif('component.alert')
    <div class="card">
        <div class="card-body">
            
                        <div class="form-group">
                            <strong>Batch Schedule Id:</strong>
                            {{ $tmsBatchScheduleDetail->batch_schedule_id }}
                        </div>
                        <div class="form-group">
                            <strong>Conductedprofileid:</strong>
                            {{ $tmsBatchScheduleDetail->ConductedProfileId }}
                        </div>
                        <div class="form-group">
                            <strong>Start Time:</strong>
                            {{ $tmsBatchScheduleDetail->start_time }}
                        </div>
                        <div class="form-group">
                            <strong>Streaming Link:</strong>
                            {{ $tmsBatchScheduleDetail->streaming_link }}
                        </div>
                        <div class="form-group">
                            <strong>Static Link:</strong>
                            {{ $tmsBatchScheduleDetail->static_link }}
                        </div>
                        <div class="form-group">
                            <strong>End Time:</strong>
                            {{ $tmsBatchScheduleDetail->end_time }}
                        </div>
                        <div class="form-group">
                            <strong>Date:</strong>
                            {{ $tmsBatchScheduleDetail->date }}
                        </div>
                        <div class="form-group">
                            <strong>Status:</strong>
                            {{ $tmsBatchScheduleDetail->status }}
                        </div>

        </div>
    </div>
@endsection
