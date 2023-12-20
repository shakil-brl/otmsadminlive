@extends('front.layouts.app')

@section('title')
<div class="d-flex justify-content-between align-items-end">
    <h1 class="title">Tms Inspection Information</h1>
    <a href="{{ route('tms-inspections.create') }}" class="btn btn-primary">
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

                        <th>Batch Id</th>
                        <th>Class No</th>
                        <th>Lab Size</th>
                        <th>Electricity</th>
                        <th>Internet</th>
                        <th>Lab Bill</th>
                        <th>Lab Attendance</th>
                        <th>Computer</th>
                        <th>Router</th>
                        <th>Projector</th>
                        <th>Student Laptop</th>
                        <th>Lab Security</th>
                        <th>Lab Register</th>
                        <th>Class Regularity</th>
                        <th>Trainer Attituted</th>
                        <th>Trainer Tab Attendance</th>
                        <th>Upazila Audit</th>
                        <th>Upazila Monitoring</th>
                        <th>Remark</th>
                        <th>Asset List</th>
                        <th>Created By</th>
                        <th>Updated By</th>
                        <th>Updated At</th>

                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tmsInspections as $tmsInspection)
                    <tr>
                        <td>{{ $loop->iteration}}</td>

                        <td>{{ $tmsInspection->batch_id }}</td>
                        <td>{{ $tmsInspection->class_no }}</td>
                        <td>{{ $tmsInspection->lab_size }}</td>
                        <td>{{ $tmsInspection->electricity }}</td>
                        <td>{{ $tmsInspection->internet }}</td>
                        <td>{{ $tmsInspection->lab_bill }}</td>
                        <td>{{ $tmsInspection->lab_attendance }}</td>
                        <td>{{ $tmsInspection->computer }}</td>
                        <td>{{ $tmsInspection->router }}</td>
                        <td>{{ $tmsInspection->projector }}</td>
                        <td>{{ $tmsInspection->student_laptop }}</td>
                        <td>{{ $tmsInspection->lab_security }}</td>
                        <td>{{ $tmsInspection->lab_register }}</td>
                        <td>{{ $tmsInspection->class_regularity }}</td>
                        <td>{{ $tmsInspection->trainer_attituted }}</td>
                        <td>{{ $tmsInspection->trainer_tab_attendance }}</td>
                        <td>{{ $tmsInspection->upazila_audit }}</td>
                        <td>{{ $tmsInspection->upazila_monitoring }}</td>
                        <td>{{ $tmsInspection->remark }}</td>
                        <td>{{ $tmsInspection->asset_list }}</td>
                        <td>{{ $tmsInspection->created_by }}</td>
                        <td>{{ $tmsInspection->updated_by }}</td>
                        <td>{{ $tmsInspection->Updated_at }}</td>

                        <td>
                            <form action="{{ route('tms-inspections.destroy',$tmsInspection->id) }}" method="POST">
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
                                            <a class="dropdown-item"
                                                href="{{ route('tms-inspections.show',$tmsInspection->id) }}">
                                                <span class="material-icons-outlined">
                                                    visibility
                                                </span>
                                                View
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item"
                                                href="{{ route('tms-inspections.edit',$tmsInspection->id) }}">
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
{!! $tmsInspections->links() !!}
@endsection