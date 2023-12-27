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
                    <th>About Class</th>
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
                                {{ $from + $loop->iteration - 1 }}
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
                                    @if ($batch['startDate'])
                                        {{ \Carbon\Carbon::parse($batch['startDate'])->format('d-m-Y') }}
                                    @endif
                                </div>
                                <div>
                                    {{ $batch['duration'] }} {{ __('batch-list.days') }}
                                </div>
                            </td>
                            <td>
                                @if ($schedule !== null)
                                    <span> {{ __('batch-list.days') }}: {{ $schedule['class_days'] }}</span><br>
                                    <div class="mt-1 d-flex justify-content-between align-item-center">
                                        <span>{{ __('batch-list.time') }}: {{ $schedule['class_time'] }}</span>
                                        <span>{{ __('batch-list.duration') }}: {{ $schedule['class_duration'] }}
                                            {{ __('batch-list.hours') }}</span>
                                    </div>
                                @else
                                @endif
                            </td>
                            <td>
                                @if ($schedule == null)
                                 <span class="badge bg-secondary">Not Created</span>
                                @else
                                    <a href="{{ route('batch-schedule.office', [$schedule['id'], $batch['id']]) }}"
                                        class="btn btn-sm btn-info">
                                        {{ __('batch-list.view_schedule') }}
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
@endsection
