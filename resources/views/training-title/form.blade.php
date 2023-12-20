@row
    
        <div class="form-group">
            {{ Form::label('Name') }}
            {{ Form::text('Name', $trainingTitle->Name, ['class' => 'form-control' . ($errors->has('Name') ? ' is-invalid' : '')]) }}
            {!! $errors->first('Name', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('NameEn') }}
            {{ Form::text('NameEn', $trainingTitle->NameEn, ['class' => 'form-control' . ($errors->has('NameEn') ? ' is-invalid' : '')]) }}
            {!! $errors->first('NameEn', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('TrainingAreaId') }}
            {{ Form::text('TrainingAreaId', $trainingTitle->TrainingAreaId, ['class' => 'form-control' . ($errors->has('TrainingAreaId') ? ' is-invalid' : '')]) }}
            {!! $errors->first('TrainingAreaId', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>

@endrow
<div class="mt-3">
    <button type="submit" class="btn btn-primary">Submit</button>
</div>