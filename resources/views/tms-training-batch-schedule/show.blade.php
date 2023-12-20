@extends('front.layouts.app')

@section('title')
    <h1 class="title">Show Tms Training Batch Schedule</h1>
@endsection

@section('content')
    @includeif('component.alert')
    <div class="card">
        <div class="card-body">
            
                        <div class="form-group">
                            <strong>Training Id:</strong>
                            {{ $tmsTrainingBatchSchedule->training_id }}
                        </div>
                        <div class="form-group">
                            <strong>Training Batch Id:</strong>
                            {{ $tmsTrainingBatchSchedule->training_batch_id }}
                        </div>
                        <div class="form-group">
                            <strong>Provider Id:</strong>
                            {{ $tmsTrainingBatchSchedule->provider_id }}
                        </div>
                        <div class="form-group">
                            <strong>Class Days:</strong>
                            {{ $tmsTrainingBatchSchedule->class_days }}
                        </div>
                        <div class="form-group">
                            <strong>Class Time:</strong>
                            {{ $tmsTrainingBatchSchedule->class_time }}
                        </div>
                        <div class="form-group">
                            <strong>Class Duration:</strong>
                            {{ $tmsTrainingBatchSchedule->class_duration }}
                        </div>

        </div>
    </div>
@endsection
