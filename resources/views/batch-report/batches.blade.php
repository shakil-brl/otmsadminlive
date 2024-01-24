@extends('layouts.auth-master')
{{-- @dd($providers); --}}
{{-- @dd($providers[0]) --}}
@section('content')
    <!--begin::Content-->
    <div class="m-5">
        <h3>{{ 'All batch lists of'.' '.$provider['name'] }}</h3>
        <x-alert />
        @isset($results)
            <div class="my-3 d-flex">
                <div class="w-50">
                    <form action="">
                        <div class="d-flex gap-3">
                            <input type="search" name="search" value="{{ request('search') }}" class="form-control w-75"
                                placeholder="{{ __('batch-list.search_here') }}">
                            <input type="submit" class="form-control btn btn-primary w-25"
                                value="{{ __('batch-list.search') }}">
                        </div>
                    </form>
                </div>
            </div>
            <table class="table table-bordered bg-white">
                <thead>
                    <th>{{ 'S/N' }}</th>
                    <th>{{ 'Batch Code' }}</th>
                    <th>{{ 'Locations' }}</th>
                    <th>{{ 'Total Class' }}</th>
                    <th>{{ 'Complete Class' }}</th>
                    <th>{{ 'Running Class' }}</th>
                    <th>{{ __('provider-list.action') }}</th>
                </thead>
                <tbody>
                    @foreach (collect($results) as $batch)
                        <tr>
                            <td>
                                {{ $page_from + $loop->iteration - 1 }}
                            </td>
                            <td>
                                {{ $batch['batchCode'] ?? '' }}
                            </td>
                            <td>
                                {{ $batch['GEOLocation'] ?? '' }}
                            </td>
                            <td>
                                {{ $batch['duration'] ?? '' }}
                            </td>
                            <td>
                                @isset($batch['schedule']['schedule_details'])
                                    @php
                                        $completeClass = 0;
                                        foreach ($batch['schedule']['schedule_details'] as $value) {
                                            if ($value['status'] == 3) {
                                                $completeClass += 1;
                                            }
                                    } @endphp
                                    {{ $completeClass }}
                                @endisset
                            </td>
                            <td>
                                @isset($batch['schedule']['schedule_details'])
                                    @php
                                        $runningClass = 0;
                                        foreach ($batch['schedule']['schedule_details'] as $value) {
                                            if ($value['status'] == 2) {
                                                $runningClass += 1;
                                            }
                                    } @endphp
                                    {{ $runningClass }}
                                @endisset
                            </td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Provider Batch Actions">
                                    @empty(!$batch['schedule'])
                                        <a href="{{ route('vendor-batch.schedule', $batch['schedule']['id']) }}" class="btn btn-sm btn-success show-loader" data-bs-toggle="tooltip"
                                            data-bs-custom-class="tooltip-inverse" data-bs-placement="bottom"
                                            title="{{ $batch['batchCode'].' Batch Schedule Lists' }}">
                                            {{ 'Schedule Details' }}
                                        </a>
                                    @else
                                        <a href="" class="btn btn-sm btn-success" data-name="{{ $batch['batchCode'] }}"
                                            data-bs-toggle="tooltip" data-bs-custom-class="tooltip-inverse"
                                            data-bs-placement="bottom" title="{{ $batch['batchCode'].' Batch Schedule Lists' }}"
                                            id="schedule">
                                            {{ 'Schedule Details' }}
                                        </a>
                                    @endempty
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
        $(document).on("click", "#schedule", function(e) {
            e.preventDefault();
            let batch = $(this).attr("data-name");
            Swal.fire({
                title: batch,
                text: "This batch schedule does not created yet!!",
                icon: "warning",
                showCancelButton: false,
            }).then((result) => {});
        });
    </script>
@endsection
@endsection
