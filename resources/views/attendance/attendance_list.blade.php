@extends('layouts.auth-master')

@section('content')
    <!--begin::Content-->
    <div class="m-5">
        <h3 class="h1 text-center">{{__('batch-list.class_attendance')}}</h3>
        @isset($trainees)
            @php
                $totalTrainees = count($trainees);
                $presentTrainees = collect($trainees)
                    ->where('is_present', 1)
                    ->count();
                $absentTrainees = $totalTrainees - $presentTrainees;
            @endphp
            <div class="d-flex h2 justify-content-center gap-2">
                <p class="text-info">{{__('batch-list.total_tarinees')}}: {{ digitLocale($totalTrainees) }} {{__('batch-list.jon')}}</p>
                <p class="text-success">{{__('batch-list.present_tarinees')}}: {{ digitLocale($presentTrainees) }} {{__('batch-list.jon')}}</p>
                <p class="text-danger">{{__('batch-list.absent_tarinees')}}: {{ digitLocale($absentTrainees) }} {{__('batch-list.jon')}}</p>
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
                    <th>{{__('batch-schedule.sl')}}</th>
                    <th>{{__('batch-list.name')}}</th>
                    <th>
                        {{__('batch-list.attendance')}}
                    </th>
                </thead>
                <tbody>
                    @foreach ($trainees as $index => $student)
                        <tr>
                            <td>{{ digitLocale($loop->iteration) }}</td>
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
