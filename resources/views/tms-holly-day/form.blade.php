@row
    
        <div class="form-group">
            {{ Form::label('day_name_en') }}
            {{ Form::text('day_name_en', $tmsHollyDay->day_name_en, ['class' => 'form-control' . ($errors->has('day_name_en') ? ' is-invalid' : '')]) }}
            {!! $errors->first('day_name_en', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('day_name_bn') }}
            {{ Form::text('day_name_bn', $tmsHollyDay->day_name_bn, ['class' => 'form-control' . ($errors->has('day_name_bn') ? ' is-invalid' : '')]) }}
            {!! $errors->first('day_name_bn', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('holly_bay') }}
            {{ Form::text('holly_bay', $tmsHollyDay->holly_bay, ['class' => 'form-control' . ($errors->has('holly_bay') ? ' is-invalid' : '')]) }}
            {!! $errors->first('holly_bay', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>

@endrow
<div class="mt-3">
    <button type="submit" class="btn btn-primary">Submit</button>
</div>