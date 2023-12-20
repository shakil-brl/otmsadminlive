@row
    
        <div class="form-group">
            {{ Form::label('batch_schedule_id') }}
            {{ Form::text('batch_schedule_id', $tmsBatchScheduleDetail->batch_schedule_id, ['class' => 'form-control' . ($errors->has('batch_schedule_id') ? ' is-invalid' : '')]) }}
            {!! $errors->first('batch_schedule_id', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('ConductedProfileId') }}
            {{ Form::text('ConductedProfileId', $tmsBatchScheduleDetail->ConductedProfileId, ['class' => 'form-control' . ($errors->has('ConductedProfileId') ? ' is-invalid' : '')]) }}
            {!! $errors->first('ConductedProfileId', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('start_time') }}
            {{ Form::text('start_time', $tmsBatchScheduleDetail->start_time, ['class' => 'form-control' . ($errors->has('start_time') ? ' is-invalid' : '')]) }}
            {!! $errors->first('start_time', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('streaming_link') }}
            {{ Form::text('streaming_link', $tmsBatchScheduleDetail->streaming_link, ['class' => 'form-control' . ($errors->has('streaming_link') ? ' is-invalid' : '')]) }}
            {!! $errors->first('streaming_link', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('static_link') }}
            {{ Form::text('static_link', $tmsBatchScheduleDetail->static_link, ['class' => 'form-control' . ($errors->has('static_link') ? ' is-invalid' : '')]) }}
            {!! $errors->first('static_link', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('end_time') }}
            {{ Form::text('end_time', $tmsBatchScheduleDetail->end_time, ['class' => 'form-control' . ($errors->has('end_time') ? ' is-invalid' : '')]) }}
            {!! $errors->first('end_time', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('date') }}
            {{ Form::text('date', $tmsBatchScheduleDetail->date, ['class' => 'form-control' . ($errors->has('date') ? ' is-invalid' : '')]) }}
            {!! $errors->first('date', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('status') }}
            {{ Form::text('status', $tmsBatchScheduleDetail->status, ['class' => 'form-control' . ($errors->has('status') ? ' is-invalid' : '')]) }}
            {!! $errors->first('status', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>

@endrow
<div class="mt-3">
    <button type="submit" class="btn btn-primary">Submit</button>
</div>