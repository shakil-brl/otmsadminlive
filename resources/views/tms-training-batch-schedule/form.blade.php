@row
    
        <div class="form-group">
            {{ Form::label('training_id') }}
            {{ Form::text('training_id', $tmsTrainingBatchSchedule->training_id, ['class' => 'form-control' . ($errors->has('training_id') ? ' is-invalid' : '')]) }}
            {!! $errors->first('training_id', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('training_batch_id') }}
            {{ Form::text('training_batch_id', $tmsTrainingBatchSchedule->training_batch_id, ['class' => 'form-control' . ($errors->has('training_batch_id') ? ' is-invalid' : '')]) }}
            {!! $errors->first('training_batch_id', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('provider_id') }}
            {{ Form::text('provider_id', $tmsTrainingBatchSchedule->provider_id, ['class' => 'form-control' . ($errors->has('provider_id') ? ' is-invalid' : '')]) }}
            {!! $errors->first('provider_id', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('class_days') }}
            {{ Form::text('class_days', $tmsTrainingBatchSchedule->class_days, ['class' => 'form-control' . ($errors->has('class_days') ? ' is-invalid' : '')]) }}
            {!! $errors->first('class_days', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('class_time') }}
            {{ Form::text('class_time', $tmsTrainingBatchSchedule->class_time, ['class' => 'form-control' . ($errors->has('class_time') ? ' is-invalid' : '')]) }}
            {!! $errors->first('class_time', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('class_duration') }}
            {{ Form::text('class_duration', $tmsTrainingBatchSchedule->class_duration, ['class' => 'form-control' . ($errors->has('class_duration') ? ' is-invalid' : '')]) }}
            {!! $errors->first('class_duration', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>

@endrow
<div class="mt-3">
    <button type="submit" class="btn btn-primary">Submit</button>
</div>