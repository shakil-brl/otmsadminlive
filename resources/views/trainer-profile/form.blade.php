@row
    
        <div class="form-group">
            {{ Form::label('ProfileId') }}
            {{ Form::text('ProfileId', $trainerProfile->ProfileId, ['class' => 'form-control' . ($errors->has('ProfileId') ? ' is-invalid' : '')]) }}
            {!! $errors->first('ProfileId', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('professionalBio') }}
            {{ Form::text('professionalBio', $trainerProfile->professionalBio, ['class' => 'form-control' . ($errors->has('professionalBio') ? ' is-invalid' : '')]) }}
            {!! $errors->first('professionalBio', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('review') }}
            {{ Form::text('review', $trainerProfile->review, ['class' => 'form-control' . ($errors->has('review') ? ' is-invalid' : '')]) }}
            {!! $errors->first('review', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('rating') }}
            {{ Form::text('rating', $trainerProfile->rating, ['class' => 'form-control' . ($errors->has('rating') ? ' is-invalid' : '')]) }}
            {!! $errors->first('rating', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('isActive') }}
            {{ Form::text('isActive', $trainerProfile->isActive, ['class' => 'form-control' . ($errors->has('isActive') ? ' is-invalid' : '')]) }}
            {!! $errors->first('isActive', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('CreatorProfileId') }}
            {{ Form::text('CreatorProfileId', $trainerProfile->CreatorProfileId, ['class' => 'form-control' . ($errors->has('CreatorProfileId') ? ' is-invalid' : '')]) }}
            {!! $errors->first('CreatorProfileId', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>

@endrow
<div class="mt-3">
    <button type="submit" class="btn btn-primary">Submit</button>
</div>