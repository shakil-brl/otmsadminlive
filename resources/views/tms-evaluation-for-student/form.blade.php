@row
    
        <div class="form-group">
            {{ Form::label('trainer_id') }}
            {{ Form::text('trainer_id', $tmsEvaluationForStudent->trainer_id, ['class' => 'form-control' . ($errors->has('trainer_id') ? ' is-invalid' : '')]) }}
            {!! $errors->first('trainer_id', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('batch_id') }}
            {{ Form::text('batch_id', $tmsEvaluationForStudent->batch_id, ['class' => 'form-control' . ($errors->has('batch_id') ? ' is-invalid' : '')]) }}
            {!! $errors->first('batch_id', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('student_id') }}
            {{ Form::text('student_id', $tmsEvaluationForStudent->student_id, ['class' => 'form-control' . ($errors->has('student_id') ? ' is-invalid' : '')]) }}
            {!! $errors->first('student_id', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('rating') }}
            {{ Form::text('rating', $tmsEvaluationForStudent->rating, ['class' => 'form-control' . ($errors->has('rating') ? ' is-invalid' : '')]) }}
            {!! $errors->first('rating', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('review') }}
            {{ Form::text('review', $tmsEvaluationForStudent->review, ['class' => 'form-control' . ($errors->has('review') ? ' is-invalid' : '')]) }}
            {!! $errors->first('review', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>

@endrow
<div class="mt-3">
    <button type="submit" class="btn btn-primary">Submit</button>
</div>