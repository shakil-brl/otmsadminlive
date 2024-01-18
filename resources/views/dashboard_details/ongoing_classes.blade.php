@extends('layouts.auth-master')
{{-- @dd($running_batches); --}}
@section('content')
    <!--begin::Content-->
    <div class="m-5">
        <h3>{{ __('batch-schedule.ongoing_class') }}</h3>
        <br>
        <x-alert />
        @isset($ongoing_classes)
            <div class="card p-3">
                <form action="">
                    <div id="search-form">
                        <div class="row g-3 mb-2">
                            <div class="col-8">
                                <div class="input-group">
                                    <input type="text" class="form-control api-call" name="search" placeholder="Search here"
                                        value="{{ request('search') }}">
                                    <span class="input-group-text">
                                        <i class="fas fa-search"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="col-4">
                                <select class="form-select api-call" name="training_title_id" id="training_title_id">
                                    <option value="">Select course title</option>
                                </select>
                            </div>
                        </div>
                        <div class="row row-cols-3 g-3">
                            <div class="col">
                                <select class="form-select api-call" name="division_id" id="division_id">
                                    <option value="">Select division</option>
                                </select>
                            </div>
                            <div class="col">
                                <select class="form-select api-call" name="district_id" id="district_id">
                                    <option value="">Select district</option>
                                </select>
                            </div>
                            <div class="col">
                                <select class="form-select api-call" name="upazila_id" id="upazila_id">
                                    <option value="">Select upazila</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <table id="dataTableremove" class="table table-bordered bg-white">

                <thead>
                    <th>{{ __('batch-schedule.sl') }}</th>
                    <th>{{ __('batch-schedule.batch_code') }}</th>
                    <th>Date</th>
                    <th>{{ __('batch-schedule.start_time') }}</th>
                    <th>{{ __('batch-schedule.course_name') }}</th>
                    <th>{{ __('batch-schedule.location') }}</th>
                    <th>{{ __('batch-schedule.development_partner') }}</th>
                    <th>Trainer</th>
                    <th>{{ __('batch-schedule.action') }}</th>
                </thead>
                <tbody>
                    @foreach (collect($ongoing_classes) as $batch)
                        {{-- @dump($batch) --}}
                        <tr>
                            <td>
                                {{ digitLocale($from + $loop->index) }}
                            </td>
                            <td>
                                {{ $batch['schedule']['training_batch']['batchCode'] ?? '' }}
                            </td>
                            <td>
                                {{ isset($batch['date']) ? \Carbon\Carbon::parse($batch['date'])->format('d-m-Y') : '' }}
                            </td>
                            <td>
                                {{-- {{ $batch['start_time'] ?? '' }} --}}
                                {{-- {{ \Carbon\Carbon::createFromFormat('H:i:s',
                                $batch['start_time'])->format('h:i A') }} --}}
                                {{ isset($batch['start_time']) ? digitLocale(\Carbon\Carbon::createFromFormat('H:i:s', $batch['start_time'])->format('h:i A')) : '' }}

                            </td>
                            <td>
                                {{ $batch['schedule']['training_batch']['training']['title']['Name'] ?? '' }}
                            </td>
                            <td>
                                {{ $batch['schedule']['training_batch']['GEOLocation'] ?? '' }}
                            </td>
                            <td>
                                <div>
                                    {{ $batch['schedule']['training_batch']['provider']['name'] ?? '' }}
                                </div>
                                <div>
                                    Phone: {{ $batch['schedule']['training_batch']['provider']['phone'] ?? '' }}
                                </div>
                            </td>
                            <td>
                                @isset($batch['schedule']['training_batch']['provider_trainers'])
                                    @foreach ($batch['schedule']['training_batch']['provider_trainers'] as $trainer)
                                        <div>
                                            {{ $trainer['profile']['KnownAs'] ?? '' }}
                                        </div>
                                        <div>
                                            Phone: {{ $trainer['profile']['Phone'] ?? '' }}
                                        </div>
                                    @endforeach
                                @endisset
                            </td>
                            <td>
                                <div class="d-flex flex-wrap gap-1">
                                    @if ($batch['streaming_link'])
                                        <a class="btn btn-sm btn-danger" href="{{ $batch['streaming_link'] }}" target="_blank">
                                            {{-- {{ __('batch-schedule.live_streaming') }} --}}
                                            live
                                        </a>
                                    @endif
                                    @if ($batch['static_link'])
                                        <a type="button" class="btn btn-sm btn-info" href="{{ $batch['static_link'] }}"
                                            target="_blank">
                                            {{-- {{ __('batch-schedule.join_class') }} --}}
                                            join
                                        </a>
                                    @endif
                                    @php
                                        $inspection_pm = [
                                            'batch_id' => $batch['schedule']['training_batch']['id'],
                                            'schedule_detail_id' => $batch['id'],
                                        ];
                                    @endphp
                                    @isset($inspection_pm)
                                        <a class="btn btn-sm btn-primary"
                                            href="{{ route('tms-inspections.create', $inspection_pm) }}" target="_blank">
                                            Inspection
                                        </a>

                                        <a class="btn btn-sm btn-danger" href="{{ route('attendance.form', $batch['id']) }}"
                                    target="_blank">Attendence
                                </a>
                                    @endisset
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {!! $paginator->links() !!}
        @endisset
    </div>
    <!--end::Content-->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
    
        <script>
    $(document).ready(function () {
        // DataTable initialization with your table ID, search option, and placeholder
        $('#dataTableremove').DataTable({
            searching: true, // Enable searching
            language: {
                searchPlaceholder: 'Search...' // Customize the placeholder text
            }
        });
    });
</script>
@section('script')
{{-- <script>
    $(document).ready(function () {
        // DataTable initialization with your table ID
        $('#dataTableremove').DataTable({
            searching: true // Enable searching
        });
    });
</script> --}}
@endsection
@endsection
