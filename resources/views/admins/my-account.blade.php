@extends('layouts.auth-master')
@push('css')
    <link
        href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp"
        rel="stylesheet">
@endpush
@section('content')
    <div class="m-5">
        <div class="card">
            @isset($authProfile)
                {{-- @dump($authProfile)
                @dump($userRole)
                @dump($userAuth) --}}

                <div class="card-header d-flex align-items-center">
                    <h5>User Information</h5>
                </div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-3">Reg. ID:</dt>
                        <dd class="col-sm-9">{{ $userAuth['reg_id'] }}</dd>

                        <dt class="col-sm-3">Role:</dt>
                        <dd class="col-sm-9">{{ $userRole ?? '' }}</dd>

                        <dt class="col-sm-3">Known As (English):</dt>
                        <dd class="col-sm-9">{{ $authProfile['KnownAs'] ?? '' }}</dd>

                        <dt class="col-sm-3">Known As (Bangla):</dt>
                        <dd class="col-sm-9">{{ $authProfile['KnownAsBangla'] ?? '' }}</dd>

                        <dt class="col-sm-3">Father's Name:</dt>
                        <dd class="col-sm-9">{{ $authProfile['FatherName'] ?? '' }}</dd>

                        <dt class="col-sm-3">Father's Name (Bangla):</dt>
                        <dd class="col-sm-9">{{ $authProfile['FatherNameBangla'] ?? '' }}</dd>

                        <dt class="col-sm-3">Mother's Name:</dt>
                        <dd class="col-sm-9">{{ $authProfile['MotherName'] ?? '' }}</dd>

                        <dt class="col-sm-3">Mother's Name (Bangla):</dt>
                        <dd class="col-sm-9">{{ $authProfile['MotherNameBangla'] ?? '' }}</dd>

                        <dt class="col-sm-3">Gender:</dt>
                        <dd class="col-sm-9">{{ $authProfile['Gender'] ?? '' }}</dd>

                        <dt class="col-sm-3">Marital Status:</dt>
                        <dd class="col-sm-9">{{ $authProfile['MaritalStatus'] ?? '' }}</dd>

                        <dt class="col-sm-3">Date of Birth:</dt>
                        <dd class="col-sm-9">{{ $authProfile['DateOfBirth'] }}</dd>

                        <dt class="col-sm-3">Blood Group:</dt>
                        <dd class="col-sm-9">{{ $authProfile['BloodGroup'] ?? '' }}</dd>

                        <dt class="col-sm-3">Email:</dt>
                        <dd class="col-sm-9">{{ $authProfile['Email'] ?? '' }}</dd>

                        <dt class="col-sm-3">Phone:</dt>
                        <dd class="col-sm-9">{{ $authProfile['Phone'] ?? '' }}</dd>

                        <dt class="col-sm-3">NID:</dt>
                        <dd class="col-sm-9">{{ $authProfile['NID'] ?? '' }}</dd>

                        <dt class="col-sm-3">Birth Registration No:</dt>
                        <dd class="col-sm-9">{{ $authProfile['BirthRegNo'] ?? '' }}</dd>

                        <dt class="col-sm-3">Passport No:</dt>
                        <dd class="col-sm-9">{{ $authProfile['PassportNo'] ?? '' }}</dd>

                        <dt class="col-sm-3">Religion:</dt>
                        <dd class="col-sm-9">{{ $authProfile['Religion'] ?? '' }}</dd>

                        <dt class="col-sm-3">Present Address:</dt>
                        <dd class="col-sm-9">{{ $authProfile['address'] ?? '' }}</dd>

                        <dt class="col-sm-3">Present Address:</dt>
                        <dd class="col-sm-9">{{ $authProfile['address_present'] ?? '' }}</dd>
                    </dl>
                </div>
            @endisset
        </div>
    </div>
@endsection

@push('js')
    <script></script>
@endpush
