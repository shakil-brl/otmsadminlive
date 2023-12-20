@row
    
        <div class="form-group">
            {{ Form::label('role_id') }}
            {{ Form::text('role_id', $tmsUserType->role_id, ['class' => 'form-control' . ($errors->has('role_id') ? ' is-invalid' : '')]) }}
            {!! $errors->first('role_id', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('ProfileId') }}
            {{ Form::text('ProfileId', $tmsUserType->ProfileId, ['class' => 'form-control' . ($errors->has('ProfileId') ? ' is-invalid' : '')]) }}
            {!! $errors->first('ProfileId', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('district_id') }}
            {{ Form::text('district_id', $tmsUserType->district_id, ['class' => 'form-control' . ($errors->has('district_id') ? ' is-invalid' : '')]) }}
            {!! $errors->first('district_id', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('upazila_id') }}
            {{ Form::text('upazila_id', $tmsUserType->upazila_id, ['class' => 'form-control' . ($errors->has('upazila_id') ? ' is-invalid' : '')]) }}
            {!! $errors->first('upazila_id', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('provider_id') }}
            {{ Form::text('provider_id', $tmsUserType->provider_id, ['class' => 'form-control' . ($errors->has('provider_id') ? ' is-invalid' : '')]) }}
            {!! $errors->first('provider_id', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('created_user_id') }}
            {{ Form::text('created_user_id', $tmsUserType->created_user_id, ['class' => 'form-control' . ($errors->has('created_user_id') ? ' is-invalid' : '')]) }}
            {!! $errors->first('created_user_id', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>

@endrow
<div class="mt-3">
    <button type="submit" class="btn btn-primary">Submit</button>
</div>