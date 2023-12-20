@row
    
        <div class="form-group">
            {{ Form::label('Gender') }}
            {{ Form::text('Gender', $profile->Gender, ['class' => 'form-control' . ($errors->has('Gender') ? ' is-invalid' : '')]) }}
            {!! $errors->first('Gender', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('DateOfBirth') }}
            {{ Form::text('DateOfBirth', $profile->DateOfBirth, ['class' => 'form-control' . ($errors->has('DateOfBirth') ? ' is-invalid' : '')]) }}
            {!! $errors->first('DateOfBirth', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('KnownAs') }}
            {{ Form::text('KnownAs', $profile->KnownAs, ['class' => 'form-control' . ($errors->has('KnownAs') ? ' is-invalid' : '')]) }}
            {!! $errors->first('KnownAs', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Created') }}
            {{ Form::text('Created', $profile->Created, ['class' => 'form-control' . ($errors->has('Created') ? ' is-invalid' : '')]) }}
            {!! $errors->first('Created', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('BloodGroup') }}
            {{ Form::text('BloodGroup', $profile->BloodGroup, ['class' => 'form-control' . ($errors->has('BloodGroup') ? ' is-invalid' : '')]) }}
            {!! $errors->first('BloodGroup', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Email') }}
            {{ Form::text('Email', $profile->Email, ['class' => 'form-control' . ($errors->has('Email') ? ' is-invalid' : '')]) }}
            {!! $errors->first('Email', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('NID') }}
            {{ Form::text('NID', $profile->NID, ['class' => 'form-control' . ($errors->has('NID') ? ' is-invalid' : '')]) }}
            {!! $errors->first('NID', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Phone') }}
            {{ Form::text('Phone', $profile->Phone, ['class' => 'form-control' . ($errors->has('Phone') ? ' is-invalid' : '')]) }}
            {!! $errors->first('Phone', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Religion') }}
            {{ Form::text('Religion', $profile->Religion, ['class' => 'form-control' . ($errors->has('Religion') ? ' is-invalid' : '')]) }}
            {!! $errors->first('Religion', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('BirthRegNo') }}
            {{ Form::text('BirthRegNo', $profile->BirthRegNo, ['class' => 'form-control' . ($errors->has('BirthRegNo') ? ' is-invalid' : '')]) }}
            {!! $errors->first('BirthRegNo', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('FatherName') }}
            {{ Form::text('FatherName', $profile->FatherName, ['class' => 'form-control' . ($errors->has('FatherName') ? ' is-invalid' : '')]) }}
            {!! $errors->first('FatherName', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('MotherName') }}
            {{ Form::text('MotherName', $profile->MotherName, ['class' => 'form-control' . ($errors->has('MotherName') ? ' is-invalid' : '')]) }}
            {!! $errors->first('MotherName', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('PassportNo') }}
            {{ Form::text('PassportNo', $profile->PassportNo, ['class' => 'form-control' . ($errors->has('PassportNo') ? ' is-invalid' : '')]) }}
            {!! $errors->first('PassportNo', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('FatherNameBangla') }}
            {{ Form::text('FatherNameBangla', $profile->FatherNameBangla, ['class' => 'form-control' . ($errors->has('FatherNameBangla') ? ' is-invalid' : '')]) }}
            {!! $errors->first('FatherNameBangla', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('KnownAsBangla') }}
            {{ Form::text('KnownAsBangla', $profile->KnownAsBangla, ['class' => 'form-control' . ($errors->has('KnownAsBangla') ? ' is-invalid' : '')]) }}
            {!! $errors->first('KnownAsBangla', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('MotherNameBangla') }}
            {{ Form::text('MotherNameBangla', $profile->MotherNameBangla, ['class' => 'form-control' . ($errors->has('MotherNameBangla') ? ' is-invalid' : '')]) }}
            {!! $errors->first('MotherNameBangla', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('MaritalStatus') }}
            {{ Form::text('MaritalStatus', $profile->MaritalStatus, ['class' => 'form-control' . ($errors->has('MaritalStatus') ? ' is-invalid' : '')]) }}
            {!! $errors->first('MaritalStatus', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('division_code') }}
            {{ Form::text('division_code', $profile->division_code, ['class' => 'form-control' . ($errors->has('division_code') ? ' is-invalid' : '')]) }}
            {!! $errors->first('division_code', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('district_code') }}
            {{ Form::text('district_code', $profile->district_code, ['class' => 'form-control' . ($errors->has('district_code') ? ' is-invalid' : '')]) }}
            {!! $errors->first('district_code', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('upazila_id') }}
            {{ Form::text('upazila_id', $profile->upazila_id, ['class' => 'form-control' . ($errors->has('upazila_id') ? ' is-invalid' : '')]) }}
            {!! $errors->first('upazila_id', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('address') }}
            {{ Form::text('address', $profile->address, ['class' => 'form-control' . ($errors->has('address') ? ' is-invalid' : '')]) }}
            {!! $errors->first('address', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('postname') }}
            {{ Form::text('postname', $profile->postname, ['class' => 'form-control' . ($errors->has('postname') ? ' is-invalid' : '')]) }}
            {!! $errors->first('postname', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('division_code_present') }}
            {{ Form::text('division_code_present', $profile->division_code_present, ['class' => 'form-control' . ($errors->has('division_code_present') ? ' is-invalid' : '')]) }}
            {!! $errors->first('division_code_present', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('district_code_present') }}
            {{ Form::text('district_code_present', $profile->district_code_present, ['class' => 'form-control' . ($errors->has('district_code_present') ? ' is-invalid' : '')]) }}
            {!! $errors->first('district_code_present', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('upazila_id_present') }}
            {{ Form::text('upazila_id_present', $profile->upazila_id_present, ['class' => 'form-control' . ($errors->has('upazila_id_present') ? ' is-invalid' : '')]) }}
            {!! $errors->first('upazila_id_present', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('address_present') }}
            {{ Form::text('address_present', $profile->address_present, ['class' => 'form-control' . ($errors->has('address_present') ? ' is-invalid' : '')]) }}
            {!! $errors->first('address_present', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('postname_present') }}
            {{ Form::text('postname_present', $profile->postname_present, ['class' => 'form-control' . ($errors->has('postname_present') ? ' is-invalid' : '')]) }}
            {!! $errors->first('postname_present', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('PhotoUrl') }}
            {{ Form::text('PhotoUrl', $profile->PhotoUrl, ['class' => 'form-control' . ($errors->has('PhotoUrl') ? ' is-invalid' : '')]) }}
            {!! $errors->first('PhotoUrl', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Phone2') }}
            {{ Form::text('Phone2', $profile->Phone2, ['class' => 'form-control' . ($errors->has('Phone2') ? ' is-invalid' : '')]) }}
            {!! $errors->first('Phone2', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('SignatureUrl') }}
            {{ Form::text('SignatureUrl', $profile->SignatureUrl, ['class' => 'form-control' . ($errors->has('SignatureUrl') ? ' is-invalid' : '')]) }}
            {!! $errors->first('SignatureUrl', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>

@endrow
<div class="mt-3">
    <button type="submit" class="btn btn-primary">Submit</button>
</div>