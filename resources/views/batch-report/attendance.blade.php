@extends('layouts.auth-master')
{{-- @dd($providers); --}}
{{-- @dd($providers[0]) --}}
@section('content')
    <!--begin::Content-->
    <div class="m-5">
        <x-alert />
        @isset($results)
            <div class="my-3 d-flex">
                <div class="w-50">
                    <div id="">
                        <h1>{{ 'Attendance Details Informations' }}</h1>
                    </div>

                    <div class="row">
                        <div class="col-md-9">
                            <div>{{ 'Provider' }}: {{ $results[0]['schedule_detail']['schedule']['training_batch']['provider']['name'] ?? '' }}</div>
                            <div>{{ 'Batch' }}: {{ $results[0]['schedule_detail']['schedule']['training_batch']['batchCode'] ?? '' }}</div>
                            <div>{{ 'Trainning' }}: {{ $results[0]['schedule_detail']['schedule']['training_batch']['get_training']['title']['Name'] ?? '' }}</div>
                            <div>{{ 'Location' }}: {{ $results[0]['schedule_detail']['schedule']['training_batch']['GEOLocation'] ?? '' }}</div>
                            <div>{{ 'Trainer' }}: {{ $results[0]['schedule_detail']['trainer']['KnownAsBangla'] ?? '' }}</div>
                            <div>{{ 'Date' }}: {{  date('l jS F Y',strtotime($results[0]['schedule_detail']['date'])) ?? '' }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <table class="table table-bordered bg-white">
                <thead>
                    <th>{{ 'S/N' }}</th>
                    <th>{{ 'Name' }}</th>
                    <th>{{ 'Contact' }}</th>
                    <th>{{ 'Attendance' }}</th>
                </thead>
                <tbody>
                    @foreach (collect($results) as $attendance)
                        <tr>
                            <td>
                                {{ $loop->iteration }}
                            </td>
                            <td>
                                {{ $attendance['profile']['KnownAsBangla'] ?? '' }}
                            </td>

                            <td>
                                {{ $attendance['profile']['Phone'] ?? '' }}
                            </td>
                            <td>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="row">Present</div>
                                        <div class="row">
                                            {{($attendance['is_present'] == 1) ? 1 : 0}} 
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="row">Absent</div>
                                        <div class="row">{{($attendance['is_present'] == 1) ? 0 : 0}} </div>
                                    </div>
                                </div>
                            </td>
                            
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endisset
    </div>
    <!--end::Content-->
@section('scripts')
    <script>
        $(document).on("click", "#attendant", function(e) {
            e.preventDefault();
            let date = $(this).attr("data-date");
            Swal.fire({
                title: date,
                text: "There is no attendance on this date!!",
                icon: "warning",
                showCancelButton: false,
            }).then((result) => {});
        });
    </script>
@endsection
@endsection
