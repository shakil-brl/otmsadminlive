@row
    
        <div class="form-group">
            {{ Form::label('ProfileId') }}
            {{ Form::text('ProfileId', $trainingApplicant->ProfileId, ['class' => 'form-control' . ($errors->has('ProfileId') ? ' is-invalid' : '')]) }}
            {!! $errors->first('ProfileId', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('TrainingTitleId') }}
            {{ Form::text('TrainingTitleId', $trainingApplicant->TrainingTitleId, ['class' => 'form-control' . ($errors->has('TrainingTitleId') ? ' is-invalid' : '')]) }}
            {!! $errors->first('TrainingTitleId', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('BatchId') }}
            {{ Form::text('BatchId', $trainingApplicant->BatchId, ['class' => 'form-control' . ($errors->has('BatchId') ? ' is-invalid' : '')]) }}
            {!! $errors->first('BatchId', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('ApplicationDate') }}
            {{ Form::text('ApplicationDate', $trainingApplicant->ApplicationDate, ['class' => 'form-control' . ($errors->has('ApplicationDate') ? ' is-invalid' : '')]) }}
            {!! $errors->first('ApplicationDate', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Marks') }}
            {{ Form::text('Marks', $trainingApplicant->Marks, ['class' => 'form-control' . ($errors->has('Marks') ? ' is-invalid' : '')]) }}
            {!! $errors->first('Marks', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('IsSelected') }}
            {{ Form::text('IsSelected', $trainingApplicant->IsSelected, ['class' => 'form-control' . ($errors->has('IsSelected') ? ' is-invalid' : '')]) }}
            {!! $errors->first('IsSelected', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('IsRejected') }}
            {{ Form::text('IsRejected', $trainingApplicant->IsRejected, ['class' => 'form-control' . ($errors->has('IsRejected') ? ' is-invalid' : '')]) }}
            {!! $errors->first('IsRejected', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('IsTrainee') }}
            {{ Form::text('IsTrainee', $trainingApplicant->IsTrainee, ['class' => 'form-control' . ($errors->has('IsTrainee') ? ' is-invalid' : '')]) }}
            {!! $errors->first('IsTrainee', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('isDroppedOut') }}
            {{ Form::text('isDroppedOut', $trainingApplicant->isDroppedOut, ['class' => 'form-control' . ($errors->has('isDroppedOut') ? ' is-invalid' : '')]) }}
            {!! $errors->first('isDroppedOut', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('droppedOutReason') }}
            {{ Form::text('droppedOutReason', $trainingApplicant->droppedOutReason, ['class' => 'form-control' . ($errors->has('droppedOutReason') ? ' is-invalid' : '')]) }}
            {!! $errors->first('droppedOutReason', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('droppedOutByProfileId') }}
            {{ Form::text('droppedOutByProfileId', $trainingApplicant->droppedOutByProfileId, ['class' => 'form-control' . ($errors->has('droppedOutByProfileId') ? ' is-invalid' : '')]) }}
            {!! $errors->first('droppedOutByProfileId', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('droppedOutDate') }}
            {{ Form::text('droppedOutDate', $trainingApplicant->droppedOutDate, ['class' => 'form-control' . ($errors->has('droppedOutDate') ? ' is-invalid' : '')]) }}
            {!! $errors->first('droppedOutDate', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>

@endrow
<div class="mt-3">
    <button type="submit" class="btn btn-primary">Submit</button>
</div>