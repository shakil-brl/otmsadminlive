@extends('layouts.auth-master')

@section('content')
    <!--begin::Content-->
    <div class="m-5">
        <h3>Batch List</h3>
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
                    {{ isset($batch['get_training']) ?? '' ? ($batch['get_training']['title'] ? $batch['get_training']['title']['Name'] : '') : '' }}
                </div>
                <div>
                    Start Date:
                    {{ isset($batch['startDate']) ? \Carbon\Carbon::parse($batch['startDate'])->format('d-m-Y') : '' }}
                </div>
                <div>
                    Total Class: {{ $batch['totalTrainees'] ?? '' }}
                </div>
                <div>
                    Location: {{ $batch['GEOLocation'] ?? '' }}
                </div>
            </div>
        @endisset
        @isset($detail_id)
            @php
                $status = $students[0]['schedule_detail']['status'] ?? -1;
            @endphp
            <form action="{{ route('attendance.take-attendance', $detail_id) }}" method="POST">
                @csrf
                <input type="hidden" name="schedule_detail_id" value="{{ $detail_id }}">
                <table class="table table-bordered bg-white">
                    <thead>
                        <th>SL</th>
                        <th>Name</th>
                        <th>
                            @if ($status != 3)
                                <input type="checkbox" id="selectAll">
                            @endif
                            Attendance
                        </th>
                    </thead>
                    <tbody>
                        @foreach ($students as $index => $student)
                            @if ($loop->first)
                                @php
                                    $status = $student['schedule_detail']['status'];
                                @endphp
                            @endif
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <label for="att{{ $loop->iteration }}"> {{ $student['profile']['KnownAs'] ?? '' }}</label>
                                </td>
                                <td>
                                    <input @if ($status == 3) disabled @endif class="attendance"
                                        name="attendance[]" @checked($student['is_present'] == 1) value="{{ $student['ProfileId'] }}"
                                        id="att{{ $loop->iteration }}" type="checkbox">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @if ($status == 2)
                    <div class="mt-4 d-flex justify-content-between">
                        <button class="btn btn-info" name="submit" value="attendance">Submit Attendance</button>
                        <button class="btn btn-danger" name="submit" value="end">End Class</button>
                    </div>
                @endif
            </form>
        @endisset

    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            $("#selectAll").click(function() {
                if ($(this).prop('checked')) {
                    $('.attendance').prop('checked', true);
                } else {
                    $('.attendance').prop('checked', false);
                }
            });
        });
    </script>
@endpush
