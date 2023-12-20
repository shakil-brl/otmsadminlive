@extends('front.layouts.app')

@section('title')
    <h1 class="title">Show Tms Evaluation For Student</h1>
@endsection

@section('content')
    @includeif('component.alert')
    <div class="card">
        <div class="card-body">
            
                        <div class="form-group">
                            <strong>Trainer Id:</strong>
                            {{ $tmsEvaluationForStudent->trainer_id }}
                        </div>
                        <div class="form-group">
                            <strong>Batch Id:</strong>
                            {{ $tmsEvaluationForStudent->batch_id }}
                        </div>
                        <div class="form-group">
                            <strong>Student Id:</strong>
                            {{ $tmsEvaluationForStudent->student_id }}
                        </div>
                        <div class="form-group">
                            <strong>Rating:</strong>
                            {{ $tmsEvaluationForStudent->rating }}
                        </div>
                        <div class="form-group">
                            <strong>Review:</strong>
                            {{ $tmsEvaluationForStudent->review }}
                        </div>

        </div>
    </div>
@endsection
