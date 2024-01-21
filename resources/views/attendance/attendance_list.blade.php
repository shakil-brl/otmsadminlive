@extends('layouts.auth-master')

@section('content')
    <!--begin::Content-->
    <div class="m-5">
        <h3>Attendance List:</h3>
        @isset($trainees)
            @php
                $totalTrainees = count($trainees);
                $presentTrainees = collect($trainees)
                    ->where('is_present', 1)
                    ->count();
                $absentTrainees = $totalTrainees - $presentTrainees;
            @endphp
            <div class="d-flex gap-2">
                <p class="text-info">Total Trainees: {{ $totalTrainees }}</p>
                <p class="text-success">Present Trainees: {{ $presentTrainees }}</p>
                <p class="text-danger">Absent Trainees: {{ $absentTrainees }}</p>
            </div>
        @endisset
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <x-alert />

        @isset($batch)
            <div>
                <h4>Batch Code: {{ $batch['batchCode'] ?? '' }}</h4>
                <div>Training Title:
                    {{ $batch['get_training']['title']['Name'] ?? '' }}
                </div>
                <div>
                    Start Date: {{ \Carbon\Carbon::parse($batch['startDate'])->format('d-m-Y') }}
                </div>
                <div>
                    Total Class: {{ $batch['totalTrainees'] ?? '' }}
                </div>
                <div>
                    Location: {{ $batch['GEOLocation'] ?? '' }}
                </div>
            </div>
        @endisset
        @isset($trainees)
            <table class="table table-bordered bg-white">
                <thead>
                    <th>SL</th>
                    <th>Name</th>
                    <th>
                        Attendance
                    </th>
                </thead>
                <tbody>
                    @foreach ($trainees as $index => $student)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <label for="att{{ $loop->iteration }}"> {{ $student['profile']['KnownAs'] ?? '' }}</label>
                            </td>
                            <td>
                                <input disabled class="attendance" name="attendance[]" @checked($student['is_present'] == 1)
                                    value="{{ $student['ProfileId'] }}" id="att{{ $loop->iteration }}" type="checkbox">
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endisset
    </div>
@endsection
