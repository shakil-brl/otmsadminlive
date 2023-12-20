@row
    
        <div class="form-group">
            {{ Form::label('profile_id') }}
            {{ Form::text('profile_id', $developmentPartnerEmpoly->profile_id, ['class' => 'form-control' . ($errors->has('profile_id') ? ' is-invalid' : '')]) }}
            {!! $errors->first('profile_id', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('development_partner_id') }}
            {{ Form::text('development_partner_id', $developmentPartnerEmpoly->development_partner_id, ['class' => 'form-control' . ($errors->has('development_partner_id') ? ' is-invalid' : '')]) }}
            {!! $errors->first('development_partner_id', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('joining_date') }}
            {{ Form::text('joining_date', $developmentPartnerEmpoly->joining_date, ['class' => 'form-control' . ($errors->has('joining_date') ? ' is-invalid' : '')]) }}
            {!! $errors->first('joining_date', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('training_batch_id_list') }}
            {{ Form::text('training_batch_id_list', $developmentPartnerEmpoly->training_batch_id_list, ['class' => 'form-control' . ($errors->has('training_batch_id_list') ? ' is-invalid' : '')]) }}
            {!! $errors->first('training_batch_id_list', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>

@endrow
<div class="mt-3">
    <button type="submit" class="btn btn-primary">Submit</button>
</div>