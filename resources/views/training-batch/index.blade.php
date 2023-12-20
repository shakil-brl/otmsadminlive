@extends('front.layouts.app')

@section('title')
<div class="d-flex justify-content-between align-items-end">
    <h1 class="title">Training Batch Information</h1>
    <a href="{{ route('training-batche.create') }}" class="btn btn-primary">
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

                        <th>Batchcode</th>
                        <th>Trainingid</th>
                        <th>Geocode</th>
                        <th>Totaltrainees</th>
                        <th>Startdate</th>
                        <th>Lastapplicationdate</th>
                        <th>Provider Id</th>
                        <th>Trainingproviderorgid</th>
                        <th>Geolocation</th>
                        <th>Trainingvenue</th>
                        <th>Duration</th>

                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($trainingBatches as $trainingBatch)
                    <tr>
                        <td>{{ $loop->iteration}}</td>

                        <td>{{ $trainingBatch->batchCode }}</td>
                        <td>{{ $trainingBatch->trainingId }}</td>
                        <td>{{ $trainingBatch->GEOCode }}</td>
                        <td>{{ $trainingBatch->totalTrainees }}</td>
                        <td>{{ $trainingBatch->startDate }}</td>
                        <td>{{ $trainingBatch->lastApplicationDate }}</td>
                        <td>{{ $trainingBatch->provider_id }}</td>
                        <td>{{ $trainingBatch->TrainingProviderOrgId }}</td>
                        <td>{{ $trainingBatch->GEOLocation }}</td>
                        <td>{{ $trainingBatch->TrainingVenue }}</td>
                        <td>{{ $trainingBatch->duration }}</td>

                        <td>
                            <form action="{{ route('training-batche.destroy',$trainingBatch->id) }}" method="POST">
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
                                                href="{{ route('training-batche.show',$trainingBatch->id) }}">
                                                <span class="material-icons-outlined">
                                                    visibility
                                                </span>
                                                View
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item"
                                                href="{{ route('training-batche.edit',$trainingBatch->id) }}">
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
{!! $trainingBatches->links() !!}
@endsection