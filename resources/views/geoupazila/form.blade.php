@row
    
        <div class="form-group">
            {{ Form::label('Code') }}
            {{ Form::text('Code', $geoupazila->Code, ['class' => 'form-control' . ($errors->has('Code') ? ' is-invalid' : '')]) }}
            {!! $errors->first('Code', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Name') }}
            {{ Form::text('Name', $geoupazila->Name, ['class' => 'form-control' . ($errors->has('Name') ? ' is-invalid' : '')]) }}
            {!! $errors->first('Name', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('NameEng') }}
            {{ Form::text('NameEng', $geoupazila->NameEng, ['class' => 'form-control' . ($errors->has('NameEng') ? ' is-invalid' : '')]) }}
            {!! $errors->first('NameEng', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('ParentCode') }}
            {{ Form::text('ParentCode', $geoupazila->ParentCode, ['class' => 'form-control' . ($errors->has('ParentCode') ? ' is-invalid' : '')]) }}
            {!! $errors->first('ParentCode', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>

@endrow
<div class="mt-3">
    <button type="submit" class="btn btn-primary">Submit</button>
</div>