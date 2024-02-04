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
                    <h3>{{__('admin-user-list.user_info')}}</h3>
                </div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-3">{{__('admin-user-list.profile_id')}}:</dt>
            
                        <dd class="col-sm-9">{{ $authProfile['id'] ?? '' }}</dd>

                        <dt class="col-sm-3">{{__('admin-user-list.user_roles')}}:</dt>
                        <dd class="col-sm-9">{{ $userRole ?? '' }}</dd>

                        <dt class="col-sm-3">{{__('admin-user-list.english_name')}}:</dt>
                        <dd class="col-sm-9">{{ $authProfile['KnownAs'] ?? '' }}</dd>

                        <dt class="col-sm-3">{{__('admin-user-list.bangla_name')}}:</dt>
                        <dd class="col-sm-9">{{ $authProfile['KnownAsBangla'] ?? '' }}</dd>

                        <dt class="col-sm-3">{{__('admin-user-list.father_name')}}:</dt>
                        <dd class="col-sm-9">{{ $authProfile['FatherName'] ?? '' }}</dd>

                        <dt class="col-sm-3">{{__('admin-user-list.father_name_bangla')}}:</dt>
                        <dd class="col-sm-9">{{ $authProfile['FatherNameBangla'] ?? '' }}</dd>

                        <dt class="col-sm-3">{{__('admin-user-list.mother_name')}}:</dt>
                        <dd class="col-sm-9">{{ $authProfile['MotherName'] ?? '' }}</dd>

                        <dt class="col-sm-3">{{__('admin-user-list.mother_name_bangla')}}:</dt>
                        <dd class="col-sm-9">{{ $authProfile['MotherNameBangla'] ?? '' }}</dd>

                        <dt class="col-sm-3">{{__('admin-user-list.genders')}}:</dt>
                        <dd class="col-sm-9">{{ $authProfile['Gender'] ?? '' }}</dd>

                        <dt class="col-sm-3">{{__('admin-user-list.marital_status')}}:</dt>
                        <dd class="col-sm-9">{{ $authProfile['MaritalStatus'] ?? '' }}</dd>

                        <dt class="col-sm-3">{{__('admin-user-list.dob')}}:</dt>
                        <dd class="col-sm-9">{{ \Carbon\Carbon::parse($authProfile['DateOfBirth'])->format('d/m/Y') }}</dd>

                        <dt class="col-sm-3">{{__('admin-user-list.blood_group')}}:</dt>
                        <dd class="col-sm-9">{{ $authProfile['BloodGroup'] ?? '' }}</dd>

                        <dt class="col-sm-3">{{__('admin-user-list.mail')}}:</dt>
                        <dd class="col-sm-9">{{ $authProfile['Email'] ?? '' }}</dd>

                        <dt class="col-sm-3">{{__('admin-user-list.phone_number')}}:</dt>
                        <dd class="col-sm-9">{{ $authProfile['Phone'] ?? '' }}</dd>

                        <dt class="col-sm-3">{{__('admin-user-list.nid_no')}}:</dt>
                        <dd class="col-sm-9">{{ $authProfile['NID'] ?? '' }}</dd>

                        <dt class="col-sm-3">{{__('admin-user-list.birth_reg_no')}}:</dt>
                        <dd class="col-sm-9">{{ $authProfile['BirthRegNo'] ?? '' }}</dd>

                        <dt class="col-sm-3">{{__('admin-user-list.passport_no')}}:</dt>
                        <dd class="col-sm-9">{{ $authProfile['PassportNo'] ?? '' }}</dd>

                        <dt class="col-sm-3">{{__('admin-user-list.religion')}}:</dt>
                        <dd class="col-sm-9">{{ $authProfile['Religion'] ?? '' }}</dd>

                        <dt class="col-sm-3">{{__('admin-user-list.parmanent_address')}}:</dt>
                        <dd class="col-sm-9">{{ $authProfile['address'] ?? '' }}</dd>

                        <dt class="col-sm-3">{{__('admin-user-list.present_address')}}:</dt>
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
