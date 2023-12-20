@row
    
        <div class="form-group">
            {{ Form::label('provider_id') }}
            {{ Form::text('provider_id', $tmsProvidersBatch->provider_id, ['class' => 'form-control' . ($errors->has('provider_id') ? ' is-invalid' : '')]) }}
            {!! $errors->first('provider_id', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('batch_ids') }}
            {{ Form::text('batch_ids', $tmsProvidersBatch->batch_ids, ['class' => 'form-control' . ($errors->has('batch_ids') ? ' is-invalid' : '')]) }}
            {!! $errors->first('batch_ids', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('created_user_id') }}
            {{ Form::text('created_user_id', $tmsProvidersBatch->created_user_id, ['class' => 'form-control' . ($errors->has('created_user_id') ? ' is-invalid' : '')]) }}
            {!! $errors->first('created_user_id', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('tms_group_id') }}
            {{ Form::text('tms_group_id', $tmsProvidersBatch->tms_group_id, ['class' => 'form-control' . ($errors->has('tms_group_id') ? ' is-invalid' : '')]) }}
            {!! $errors->first('tms_group_id', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>

@endrow
<div class="mt-3">
    <button type="submit" class="btn btn-primary">Submit</button>
</div>