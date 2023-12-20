@extends('front.layouts.app')

@section('title')
<div class="d-flex justify-content-between align-items-end">
    <h1 class="title">Profile Information</h1>
    <a href="{{ route('profile.create') }}" class="btn btn-primary">
        <span class="material-icons-outlined">
            add
        </span>
        {{ __('Create New') }}
    </a>
</div>
@endsection

@section('content')
@includeif('component.alert')
@php
$options = [
'value1' => 'Label 1',
'value2' => 'Label 2',
// Add more options as needed
];

$options2 = [
'value1' => 'Label 1',
'value2' => 'Label 2',
// Add more options as needed
];

$options3 = [
'value1' => 'Label 1',
'value2' => 'Label 2',
// Add more options as needed
];

@endphp


<div class="card">
    <div class="card-body">
        <div class="row justify-content-between">
            <form method="GET" action="{{ route('geodivision.index') }}" role="form">
                <div class="row row-cols-5 g-2 mb-3">
                    <div class="">
                        <select name="" class="form-select form-select-sm select2" id="">
                            <option value="">Select </option>
                            @foreach ($options as $value => $label)
                            <option value="{{ $value }}" {{ old('example')==$value ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="">
                        <select name="" class="form-select form-select-sm select2" id="">
                            <option value="">Select </option>
                            @foreach ($options2 as $value => $label)
                            <option value="{{ $value }}" {{ old('example')==$value ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="">
                        <select name="" class="form-select form-select-sm select2" id="">

                            <option value="">Select </option>
                            @foreach ($options3 as $value => $label)
                            <option value="{{ $value }}" {{ old('example')==$value ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="">
                        <input type="text" name="search" placeholder="Search" class="form-control form-select-sm">
                    </div>
                    <div class="">
                        <a href="http://127.0.0.1:8000/tms-user-type/create" class="btn btn-primary filter w-100">

                            Filter
                        </a>
                    </div>
                </div>
        </div>

        <div class="table-responsive">
            <table class="table  table-bordered">
                <thead class="thead">
                    <tr>
                        <th>No</th>

                        <th>Gender</th>
                        <th>Dateofbirth</th>
                        <th>Knownas</th>
                        <th>Created</th>
                        <th>Bloodgroup</th>
                        <th>Email</th>
                        <th>Nid</th>
                        <th>Phone</th>
                        <th>Religion</th>
                        <th>Birthregno</th>
                        <th>Fathername</th>
                        <th>Mothername</th>
                        <th>Passportno</th>
                        <th>Fathernamebangla</th>
                        <th>Knownasbangla</th>
                        <th>Mothernamebangla</th>
                        <th>Maritalstatus</th>
                        <th>Division Code</th>
                        <th>District Code</th>
                        <th>Upazila Id</th>
                        <th>Address</th>
                        <th>Postname</th>
                        <th>Division Code Present</th>
                        <th>District Code Present</th>
                        <th>Upazila Id Present</th>
                        <th>Address Present</th>
                        <th>Postname Present</th>
                        <th>Photourl</th>
                        <th>Phone2</th>
                        <th>Signatureurl</th>

                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($profiles as $profile)
                    <tr>
                        <td>{{ $loop->iteration}}</td>

                        <td>{{ $profile->Gender }}</td>
                        <td>{{ $profile->DateOfBirth }}</td>
                        <td>{{ $profile->KnownAs }}</td>
                        <td>{{ $profile->Created }}</td>
                        <td>{{ $profile->BloodGroup }}</td>
                        <td>{{ $profile->Email }}</td>
                        <td>{{ $profile->NID }}</td>
                        <td>{{ $profile->Phone }}</td>
                        <td>{{ $profile->Religion }}</td>
                        <td>{{ $profile->BirthRegNo }}</td>
                        <td>{{ $profile->FatherName }}</td>
                        <td>{{ $profile->MotherName }}</td>
                        <td>{{ $profile->PassportNo }}</td>
                        <td>{{ $profile->FatherNameBangla }}</td>
                        <td>{{ $profile->KnownAsBangla }}</td>
                        <td>{{ $profile->MotherNameBangla }}</td>
                        <td>{{ $profile->MaritalStatus }}</td>
                        <td>{{ $profile->division_code }}</td>
                        <td>{{ $profile->district_code }}</td>
                        <td>{{ $profile->upazila_id }}</td>
                        <td>{{ $profile->address }}</td>
                        <td>{{ $profile->postname }}</td>
                        <td>{{ $profile->division_code_present }}</td>
                        <td>{{ $profile->district_code_present }}</td>
                        <td>{{ $profile->upazila_id_present }}</td>
                        <td>{{ $profile->address_present }}</td>
                        <td>{{ $profile->postname_present }}</td>
                        <td>{{ $profile->PhotoUrl }}</td>
                        <td>{{ $profile->Phone2 }}</td>
                        <td>{{ $profile->SignatureUrl }}</td>

                        <td>
                            <form action="{{ route('profile.destroy',$profile->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <div class="dropdown action">
                                    <button class="btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Action <span class="material-icons-outlined">
                                            expand_more
                                        </span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item" href="{{ route('profile.show',$profile->id) }}">
                                                <span class="material-icons-outlined">
                                                    visibility
                                                </span>
                                                View
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="{{ route('profile.edit',$profile->id) }}">
                                                <span class="material-icons-outlined">
                                                    edit
                                                </span>
                                                Edit
                                            </a>
                                        </li>
                                        <li>
                                            <button type="submit" class="dropdown-item">
                                                <span class="material-icons-outlined">
                                                    delete
                                                </span>
                                                Delete
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
{!! $profiles->links() !!}
@endsection