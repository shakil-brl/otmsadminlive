@extends('front.layouts.app')

@section('title')
    <h1 class="title">Show Tms Evaluation For Trainer</h1>
@endsection

@section('content')
    @includeif('component.alert')
    <div class="card">
        <div class="card-body">
            
                        <div class="form-group">
                            <strong>Trainer Id:</strong>
                            {{ $tmsEvaluationForTrainer->trainer_id }}
                        </div>
                        <div class="form-group">
                            <strong>Batch Id:</strong>
                            {{ $tmsEvaluationForTrainer->batch_id }}
                        </div>
                        <div class="form-group">
                            <strong>Student Id:</strong>
                            {{ $tmsEvaluationForTrainer->student_id }}
                        </div>
                        <div class="form-group">
                            <strong>Rating:</strong>
                            {{ $tmsEvaluationForTrainer->rating }}
                        </div>
                        <div class="form-group">
                            <strong>Review:</strong>
                            {{ $tmsEvaluationForTrainer->review }}
                        </div>

        </div>
    </div>
@endsection
