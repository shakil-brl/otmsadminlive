@extends('front.layouts.app')

@section('title')
<div class="d-flex justify-content-between align-items-end">
    <h1 class="title">Tms Evaluation For Trainer Information</h1>
    <a href="{{ route('evaluation-for-trainer.create') }}" class="btn btn-primary">
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

@endphp


<div class="card">
    <div class="card-body">
        <form action="" class="mb-2">
            <div class="row justify-content-between">
                <div class="col-9">
                    <form method="GET" action="{{ route('evaluation-for-trainer.index') }}" role="form">
                        <div class="row row-cols-4 g-2 mb-3">
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
                                    @foreach ($options as $value => $label)
                                    <option value="{{ $value }}" {{ old('example')==$value ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="">
                                <a href="http://127.0.0.1:8000/tms-user-type/create" class="btn btn-primary filter">

                                    Filter
                                </a>
                            </div>
                        </div>


                </div>
                <div class="col-3">
                    <input type="text" name="search" placeholder="Search" class="form-control form-select-sm">
                </div>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table  table-bordered">
                <thead class="thead">
                    <tr>
                        <th>No</th>
                        
										<th>Trainer Id</th>
										<th>Batch Id</th>
										<th>Student Id</th>
										<th>Rating</th>
										<th>Review</th>

                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tmsEvaluationForTrainers as $tmsEvaluationForTrainer)
                    <tr>
                        <td>{{ $loop->iteration}}</td>
                        
											<td>{{ $tmsEvaluationForTrainer->trainer_id }}</td>
											<td>{{ $tmsEvaluationForTrainer->batch_id }}</td>
											<td>{{ $tmsEvaluationForTrainer->student_id }}</td>
											<td>{{ $tmsEvaluationForTrainer->rating }}</td>
											<td>{{ $tmsEvaluationForTrainer->review }}</td>

                        <td>
                            <form action="{{ route('evaluation-for-trainer.destroy',$tmsEvaluationForTrainer->id) }}"
                                method="POST">
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
                                                href="{{ route('evaluation-for-trainer.show',$tmsEvaluationForTrainer->id) }}">
                                                <span class="material-icons-outlined">
                                                    visibility
                                                </span>
                                                View
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item"
                                                href="{{ route('evaluation-for-trainer.edit',$tmsEvaluationForTrainer->id) }}">
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
{!! $tmsEvaluationForTrainers->links() !!}
@endsection