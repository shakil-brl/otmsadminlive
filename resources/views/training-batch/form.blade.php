@row
    
        <div class="form-group">
            {{ Form::label('batchCode') }}
            {{ Form::text('batchCode', $trainingBatch->batchCode, ['class' => 'form-control' . ($errors->has('batchCode') ? ' is-invalid' : '')]) }}
            {!! $errors->first('batchCode', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('trainingId') }}
            {{ Form::text('trainingId', $trainingBatch->trainingId, ['class' => 'form-control' . ($errors->has('trainingId') ? ' is-invalid' : '')]) }}
            {!! $errors->first('trainingId', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('GEOCode') }}
            {{ Form::text('GEOCode', $trainingBatch->GEOCode, ['class' => 'form-control' . ($errors->has('GEOCode') ? ' is-invalid' : '')]) }}
            {!! $errors->first('GEOCode', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('totalTrainees') }}
            {{ Form::text('totalTrainees', $trainingBatch->totalTrainees, ['class' => 'form-control' . ($errors->has('totalTrainees') ? ' is-invalid' : '')]) }}
            {!! $errors->first('totalTrainees', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('startDate') }}
            {{ Form::text('startDate', $trainingBatch->startDate, ['class' => 'form-control' . ($errors->has('startDate') ? ' is-invalid' : '')]) }}
            {!! $errors->first('startDate', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('lastApplicationDate') }}
            {{ Form::text('lastApplicationDate', $trainingBatch->lastApplicationDate, ['class' => 'form-control' . ($errors->has('lastApplicationDate') ? ' is-invalid' : '')]) }}
            {!! $errors->first('lastApplicationDate', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('provider_id') }}
            {{ Form::text('provider_id', $trainingBatch->provider_id, ['class' => 'form-control' . ($errors->has('provider_id') ? ' is-invalid' : '')]) }}
            {!! $errors->first('provider_id', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('TrainingProviderOrgId') }}
            {{ Form::text('TrainingProviderOrgId', $trainingBatch->TrainingProviderOrgId, ['class' => 'form-control' . ($errors->has('TrainingProviderOrgId') ? ' is-invalid' : '')]) }}
            {!! $errors->first('TrainingProviderOrgId', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('GEOLocation') }}
            {{ Form::text('GEOLocation', $trainingBatch->GEOLocation, ['class' => 'form-control' . ($errors->has('GEOLocation') ? ' is-invalid' : '')]) }}
            {!! $errors->first('GEOLocation', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('TrainingVenue') }}
            {{ Form::text('TrainingVenue', $trainingBatch->TrainingVenue, ['class' => 'form-control' . ($errors->has('TrainingVenue') ? ' is-invalid' : '')]) }}
            {!! $errors->first('TrainingVenue', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('duration') }}
            {{ Form::text('duration', $trainingBatch->duration, ['class' => 'form-control' . ($errors->has('duration') ? ' is-invalid' : '')]) }}
            {!! $errors->first('duration', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>

@endrow
<div class="mt-3">
    <button type="submit" class="btn btn-primary">Submit</button>
</div>