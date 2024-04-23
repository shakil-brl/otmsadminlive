@extends('layouts.auth-master')
@section('content')
    <div class="m-5">
        <h3>{{ __('batch-list.running_batches') }}</h3>
        <x-alert />
        @isset($running_batches)
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
                    <th>{{ __('batch-list.start_date') }}</th>
                    <th>{{ __('batch-list.course_name') }}</th>
                    <th>{{ __('batch-list.location') }}</th>
                    <th>{{ __('batch-list.development_partner') }}</th>
                    <th>{{ __('batch-list.action') }}</th>
                </thead>
                <tbody>
                    @foreach (collect($running_batches) as $batch)
                        <tr>
                            <td>
                                {{ digitLocale($from + $loop->index) }}
                            </td>
                            <td>
                                {{ $batch['training_batch']['batchCode'] ?? '' }}
                            </td>
                            <td>
                                {{ isset($batch['training_batch']['startDate']) ? digitLocale(\Carbon\Carbon::parse($batch['training_batch']['startDate'])->format('d-m-Y')) : digitLocale(null) }}
                            </td>
                            <td>
                                {{ $batch['training_batch']['training']['title']['Name'] ?? '' }}
                            </td>
                            <td>
                                {{ $batch['training_batch']['GEOLocation'] ?? '' }}
                            </td>
                            <td>
                                {{ $batch['training_batch']['provider']['name'] ?? '' }}
                            </td>
                            <td class="">
                                <a href="{{ route('batch-schedule.index', [encrypt($batch['id']), encrypt($batch['training_batch']['id'])]) }}"
                                    class="btn btn-sm btn-info mb-1"> {{ __('batch-list.view_schedule') }}
                                </a>

                                @if (in_array('course-supplies.supply', $roleRoutePermissions) && $batch['training_batch']['batch_phase'])
                                    <a href="{{ route('course-supplies.supply', [encrypt($batch['training_batch']['id'])]) }}"
                                        class="btn btn-sm btn-success mb-1">
                                        Supplies
                                    </a>
                                @endif

                                @if (in_array('laptop-distribution.create', $roleRoutePermissions) && !$batch['training_batch']['laptop'])
                                    <a href="{{ route('laptop-distribution.create', [encrypt($batch['training_batch']['id'])]) }}"
                                        class="btn btn-sm btn-success mb-1">
                                        Laptop Distribution
                                    </a>
                                @elseif(in_array('laptop-distribution.edit', $roleRoutePermissions) && $batch['training_batch']['laptop'])
                                    <a href="{{ route('laptop-distribution.edit', [$batch['training_batch']['laptop']['id'], encrypt($batch['training_batch']['id'])]) }}"
                                        class="btn btn-sm btn-warning mb-1">
                                        Edit Laptop Distribution
                                    </a>
                                @endif

                                @if (in_array('all-exam.training', $roleRoutePermissions) && $batch['training_batch']['training']['exam_config'])
                                    <a href="{{ route('all-exam.training', [encrypt($batch['training_batch']['id']), $batch['training_batch']['training']['id']]) }}"
                                        class="btn btn-sm btn-warning mb-1">
                                        All Exam
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {!! $paginator->links() !!}
        @endisset
    </div>
@section('script')
    <script></script>
@endsection
@endsection
