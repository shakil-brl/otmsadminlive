@extends('front.layouts.app')

@section('title')
    <h1 class="title">Show Profile</h1>
@endsection

@section('content')
    @includeif('component.alert')
    <div class="card">
        <div class="card-body">
            
                        <div class="form-group">
                            <strong>Gender:</strong>
                            {{ $profile->Gender }}
                        </div>
                        <div class="form-group">
                            <strong>Dateofbirth:</strong>
                            {{ $profile->DateOfBirth }}
                        </div>
                        <div class="form-group">
                            <strong>Knownas:</strong>
                            {{ $profile->KnownAs }}
                        </div>
                        <div class="form-group">
                            <strong>Created:</strong>
                            {{ $profile->Created }}
                        </div>
                        <div class="form-group">
                            <strong>Bloodgroup:</strong>
                            {{ $profile->BloodGroup }}
                        </div>
                        <div class="form-group">
                            <strong>Email:</strong>
                            {{ $profile->Email }}
                        </div>
                        <div class="form-group">
                            <strong>Nid:</strong>
                            {{ $profile->NID }}
                        </div>
                        <div class="form-group">
                            <strong>Phone:</strong>
                            {{ $profile->Phone }}
                        </div>
                        <div class="form-group">
                            <strong>Religion:</strong>
                            {{ $profile->Religion }}
                        </div>
                        <div class="form-group">
                            <strong>Birthregno:</strong>
                            {{ $profile->BirthRegNo }}
                        </div>
                        <div class="form-group">
                            <strong>Fathername:</strong>
                            {{ $profile->FatherName }}
                        </div>
                        <div class="form-group">
                            <strong>Mothername:</strong>
                            {{ $profile->MotherName }}
                        </div>
                        <div class="form-group">
                            <strong>Passportno:</strong>
                            {{ $profile->PassportNo }}
                        </div>
                        <div class="form-group">
                            <strong>Fathernamebangla:</strong>
                            {{ $profile->FatherNameBangla }}
                        </div>
                        <div class="form-group">
                            <strong>Knownasbangla:</strong>
                            {{ $profile->KnownAsBangla }}
                        </div>
                        <div class="form-group">
                            <strong>Mothernamebangla:</strong>
                            {{ $profile->MotherNameBangla }}
                        </div>
                        <div class="form-group">
                            <strong>Maritalstatus:</strong>
                            {{ $profile->MaritalStatus }}
                        </div>
                        <div class="form-group">
                            <strong>Division Code:</strong>
                            {{ $profile->division_code }}
                        </div>
                        <div class="form-group">
                            <strong>District Code:</strong>
                            {{ $profile->district_code }}
                        </div>
                        <div class="form-group">
                            <strong>Upazila Id:</strong>
                            {{ $profile->upazila_id }}
                        </div>
                        <div class="form-group">
                            <strong>Address:</strong>
                            {{ $profile->address }}
                        </div>
                        <div class="form-group">
                            <strong>Postname:</strong>
                            {{ $profile->postname }}
                        </div>
                        <div class="form-group">
                            <strong>Division Code Present:</strong>
                            {{ $profile->division_code_present }}
                        </div>
                        <div class="form-group">
                            <strong>District Code Present:</strong>
                            {{ $profile->district_code_present }}
                        </div>
                        <div class="form-group">
                            <strong>Upazila Id Present:</strong>
                            {{ $profile->upazila_id_present }}
                        </div>
                        <div class="form-group">
                            <strong>Address Present:</strong>
                            {{ $profile->address_present }}
                        </div>
                        <div class="form-group">
                            <strong>Postname Present:</strong>
                            {{ $profile->postname_present }}
                        </div>
                        <div class="form-group">
                            <strong>Photourl:</strong>
                            {{ $profile->PhotoUrl }}
                        </div>
                        <div class="form-group">
                            <strong>Phone2:</strong>
                            {{ $profile->Phone2 }}
                        </div>
                        <div class="form-group">
                            <strong>Signatureurl:</strong>
                            {{ $profile->SignatureUrl }}
                        </div>

        </div>
    </div>
@endsection
