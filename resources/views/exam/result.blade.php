@extends('layouts.auth-master')

@section('content')
    @isset($result)
        <div class="m-5">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between border p-5">
                        <p class="fw-semibold fs-6">Batch Code: {{ $result['training_batch']['batchCode'] ?? '' }}</p>
                        <p class="fw-semibold fs-6">Location: {{ $result['training_batch']['GEOLocation'] ?? '' }}</p>
                        <p class="fw-semibold fs-6">Training Title:
                            {{ $result['training_batch']['training']['title']['Name'] ?? '' }}</p>
                    </div>

                    @php
                        $exam_date = '';
                        $schedule_date = '';

                        if ($result['exam_schedule_date']) {
                            $schedule_date = \Carbon\Carbon::createFromFormat(
                                'Y-m-d',
                                $result['exam_schedule_date'],
                            )->format('d/m/Y');
                        }
                        if ($result['exact_exam_date']) {
                            $exam_date = \Carbon\Carbon::createFromFormat('Y-m-d', $result['exact_exam_date'])->format(
                                'd/m/Y',
                            );
                        }

                    @endphp

                    <div class="mt-5 border p-5">
                        @if (isset($result['exam_details']))
                            @if (count($result['exam_details']) > 0)
                                <div class="mb-5">
                                    <div>
                                        <h5 class="text-center">About Exam:</h5>
                                        <hr>
                                        <div class="d-flex justify-content-between mb-3 fw-semibold">
                                            <p>Exam Title: {{ $result['exam_config']['exam_title'] }}</p>
                                            <p>Total Mark: {{ $result['exam_config']['total_mark'] }}</p>
                                            <p>Pass Mark: {{ $result['exam_config']['pass_mark'] }}</p>
                                        </div>
                                        <div>
                                            <h6>Exam Details</h6>
                                            <p>Total Trainee: {{ $result['total_student'] }}</p>
                                            <p>Total Present: {{ $result['total_present'] }}</p>
                                            <p>Schedule Date: {{ $schedule_date }}</p>
                                            <p>Taken Date: {{ $exam_date }}</p>
                                        </div>

                                    </div>
                                </div>
                                <h6>Trainee List:</h6>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="max-width: 35px">S.N.</th>
                                            <th>Name</th>
                                            <th class="text-center">Marks</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($result['exam_details'] as $details)
                                            <tr>
                                                <td style="max-width: 35px">{{ $loop->iteration }}.</td>
                                                <td>{{ $details['training_applicant']['profile']['KnownAs'] }}</td>
                                                <td class="text-center">
                                                    {{ $details['obtained_mark'] }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <p class="text-danger">No Trainee Found</p>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endisset
@endsection

@push('js')
    <script>
        $(document).ready(function() {

        });
    </script>
@endpush
