@row
    
        <div class="form-group">
            {{ Form::label('name') }}
            {{ Form::text('name', $developmentPartner->name, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : '')]) }}
            {!! $errors->first('name', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('address') }}
            {{ Form::text('address', $developmentPartner->address, ['class' => 'form-control' . ($errors->has('address') ? ' is-invalid' : '')]) }}
            {!! $errors->first('address', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('email') }}
            {{ Form::text('email', $developmentPartner->email, ['class' => 'form-control' . ($errors->has('email') ? ' is-invalid' : '')]) }}
            {!! $errors->first('email', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('phone') }}
            {{ Form::text('phone', $developmentPartner->phone, ['class' => 'form-control' . ($errors->has('phone') ? ' is-invalid' : '')]) }}
            {!! $errors->first('phone', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('is_active') }}
            {{ Form::text('is_active', $developmentPartner->is_active, ['class' => 'form-control' . ($errors->has('is_active') ? ' is-invalid' : '')]) }}
            {!! $errors->first('is_active', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('blocked') }}
            {{ Form::text('blocked', $developmentPartner->blocked, ['class' => 'form-control' . ($errors->has('blocked') ? ' is-invalid' : '')]) }}
            {!! $errors->first('blocked', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>

@endrow
<div class="mt-3">
    <button type="submit" class="btn btn-primary">Submit</button>
</div>