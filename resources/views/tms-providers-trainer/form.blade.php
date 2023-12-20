@row
    
        <div class="form-group">
            {{ Form::label('provider_id') }}
            {{ Form::text('provider_id', $tmsProvidersTrainer->provider_id, ['class' => 'form-control' . ($errors->has('provider_id') ? ' is-invalid' : '')]) }}
            {!! $errors->first('provider_id', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('batch_id') }}
            {{ Form::text('batch_id', $tmsProvidersTrainer->batch_id, ['class' => 'form-control' . ($errors->has('batch_id') ? ' is-invalid' : '')]) }}
            {!! $errors->first('batch_id', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('ProfileId') }}
            {{ Form::text('ProfileId', $tmsProvidersTrainer->ProfileId, ['class' => 'form-control' . ($errors->has('ProfileId') ? ' is-invalid' : '')]) }}
            {!! $errors->first('ProfileId', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>

@endrow
<div class="mt-3">
    <button type="submit" class="btn btn-primary">Submit</button>
</div>