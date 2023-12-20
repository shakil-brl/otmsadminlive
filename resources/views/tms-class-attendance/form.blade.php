@row
    
        <div class="form-group">
            {{ Form::label('batch_schedule_detail_id') }}
            {{ Form::text('batch_schedule_detail_id', $tmsClassAttendance->batch_schedule_detail_id, ['class' => 'form-control' . ($errors->has('batch_schedule_detail_id') ? ' is-invalid' : '')]) }}
            {!! $errors->first('batch_schedule_detail_id', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('ProfileId') }}
            {{ Form::text('ProfileId', $tmsClassAttendance->ProfileId, ['class' => 'form-control' . ($errors->has('ProfileId') ? ' is-invalid' : '')]) }}
            {!! $errors->first('ProfileId', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('is_present') }}
            {{ Form::text('is_present', $tmsClassAttendance->is_present, ['class' => 'form-control' . ($errors->has('is_present') ? ' is-invalid' : '')]) }}
            {!! $errors->first('is_present', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('joining_time') }}
            {{ Form::text('joining_time', $tmsClassAttendance->joining_time, ['class' => 'form-control' . ($errors->has('joining_time') ? ' is-invalid' : '')]) }}
            {!! $errors->first('joining_time', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>

@endrow
<div class="mt-3">
    <button type="submit" class="btn btn-primary">Submit</button>
</div>