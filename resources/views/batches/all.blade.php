@extends('layouts.auth-master')

@section('content')
    <!--begin::Content-->
    <div class="m-5">
        <h3>{{ __('batch-list.batch_list') }}</h3>
        <x-alert />
        @isset($results['data'])
            <div class="my-3">
                <form action="">
                    <div class="w-50 d-flex gap-3">
                        <input type="search" name="search" value="{{ request('search') }}" class="form-control w-75"
                            placeholder="{{ __('batch-list.search_here') }}">
                        <input type="submit" class="form-control btn btn-primary w-25" value="{{ __('batch-list.search') }}">
                    </div>
                </form>
            </div>
            <table class="table table-bordered bg-white">
                <thead>
                    <th>{{ __('batch-list.sl') }}</th>
                    <th>{{ __('batch-list.batch_code') }}</th>
                    <th>{{ __('batch-list.course_name') }}</th>
                    <th>{{ __('batch-list.location') }}</th>
                    <th>{{ __('batch-list.development_partner') }}</th>
                    <th>{{ __('batch-list.class_details') }}</th>
                    <th>{{ __('batch-list.class_schedule') }}</th>
                    <th>{{ __('batch-list.action') }}</th>
                </thead>
                <tbody>
                    @foreach ($results['data'] ?? [] as $index => $batch)
                        @php
                            $schedule = $batch['schedule'] ?? null;
                            $from = $results['from'];
                        @endphp
                        <tr>
                            <td>
                                {{ digitLocale($from + $loop->iteration - 1) }}
                                
                            </td>
                            <td>
                                {{ $batch['batchCode'] }}
                            </td>
                            <td>
                                {{ $batch['get_training']['title']['Name'] ?? '' }}
                            </td>
                            <td>
                                {{ $batch['GEOLocation'] ?? '' }}
                            </td>
                            <td>
                                {{ $batch['provider']['name'] ?? '' }}
                            </td>
                            <td class="">
                                <div>
                                   
                                    @if (isset($batch['startDate']))
                                      {{ __('batch-list.start_date') }}:
                                      {{ isset($batch['startDate']) ? digitLocale(\Carbon\Carbon::parse($batch['startDate'])->format('d-m-Y')) : digitLocale(null) }}

                                    @endif
                                </div>
                                <div>
                                    {{ __('batch-list.total_class') }}:
                                    {{ isset($batch['duration']) ? digitLocale($batch['duration']) : digitLocale(null) }}
                                    {{ __('batch-list.days') }}
                                </div>
                            </td>
                            <td>
                                @if ($schedule !== null)
                                    <span> {{ __('batch-list.class_days') }}: {{ isset($schedule['class_days']) ? digitLocale($schedule['class_days']) : digitLocale(null) }}</span><br>
                                    <div class="mt-1 d-flex justify-content-between align-item-center">
                                        <span>{{ __('batch-list.class_start_time') }}: {{ isset($schedule['class_time']) ? digitLocale(\Carbon\Carbon::parse($schedule['class_time'])->format('h:i A')) : digitLocale(null) }} </span>
                                        <span>{{ __('batch-list.duration') }}: {{ isset($schedule['class_duration']) ? digitLocale($schedule['class_duration']) : digitLocale(null) }}
                                            {{ __('batch-list.hours') }}</span>
                                    </div>
                                @else
                                @endif
                            </td>
                            <td>
                                @if ($schedule == null)
                                    <span class="badge bg-secondary">{{ __('batch-list.not_created-schedule') }}</span>
                                @else
                                    <div class="d-flex flex-column gap-1">
                                        <a href="{{ route('batch-schedule.office', [$schedule['id'], $batch['id']]) }}"
                                            class="btn btn-sm btn-info">
                                            {{ __('batch-list.view_schedule') }}
                                        </a>
                                        @if (in_array('batch-schedule.destroy', $roleRoutePermissions))
                                            <a href="" id="{{ $batch['id'] }}"
                                                class="btn btn-sm btn-danger delete-schedule">
                                                {{ __('batch-list.delete_schedule') }}
                                            </a>
                                        @endif
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {!! $paginator->links() !!}
        @endisset
    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            var app_url = "{{ url('') }}";

            $('.delete-schedule').click(function(e) {
                e.preventDefault();
                id = $(this).attr('id');

                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!",
                    cancelButtonText: "No, cancel!",
                }).then((result) => {
                    if (result.isConfirmed) {
                        let finalUrl = `${app_url}/batch_schedules/destroy/${id}`;
                        window.location.href = finalUrl;
                    }
                });
            });
        });
    </script>
@endpush
