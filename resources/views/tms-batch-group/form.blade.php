@row
    
        <div class="form-group">
            {{ Form::label('name_bn') }}
            {{ Form::text('name_bn', $tmsBatchGroup->name_bn, ['class' => 'form-control' . ($errors->has('name_bn') ? ' is-invalid' : '')]) }}
            {!! $errors->first('name_bn', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('name_en') }}
            {{ Form::text('name_en', $tmsBatchGroup->name_en, ['class' => 'form-control' . ($errors->has('name_en') ? ' is-invalid' : '')]) }}
            {!! $errors->first('name_en', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('code') }}
            {{ Form::text('code', $tmsBatchGroup->code, ['class' => 'form-control' . ($errors->has('code') ? ' is-invalid' : '')]) }}
            {!! $errors->first('code', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('remark') }}
            {{ Form::text('remark', $tmsBatchGroup->remark, ['class' => 'form-control' . ($errors->has('remark') ? ' is-invalid' : '')]) }}
            {!! $errors->first('remark', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>

@endrow
<div class="mt-3">
    <button type="submit" class="btn btn-primary">Submit</button>
</div>