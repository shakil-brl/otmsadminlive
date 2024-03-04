@extends('layouts.auth-master')
{{-- @dump($total_batches) --}}
@section('content')
    <!--begin::Content -->
    <div class="m-5">
        <h3>Trainee List</h3>

        <x-alert />
        @isset($students)
            <div>
                @php
                    $batch = collect($students)->first()['training_batch'] ?? [];
                @endphp
                <div class="h3">
                    Batch Code:{{ $batch['batchCode'] ?? '' }} <br>
                </div>
            </div>

            <table class="table table-bordered bg-white">
                <thead>
                    <th>{{ __('batch-list.sl') }}</th>
                    <th>Student Name</th>
                    <th>Fathers Name</th>
                    <th>Mothers Name</th>
                    <th>{{ __('batch-list.action') }}</th>
                </thead>
                <tbody>
                    @foreach ($students as $student)
                        <tr>
                            <td>
                                {{ $loop->iteration }}
                            </td>
                            <td>
                                {{ $student['profile']['KnownAsBangla'] ?? '' }}
                            </td>
                            <td>
                                {{ $student['profile']['FatherNameBangla'] ?? '' }}
                            </td>
                            <td>
                                {{ $student['profile']['MotherNameBangla'] ?? '' }}
                            </td>
                            <td>
                                <a href="{{ route('evaluate.trainee.form', $student['id']) }}" class="btn btn-sm btn-info">
                                    Evaluate
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endisset
    </div>
@endsection
