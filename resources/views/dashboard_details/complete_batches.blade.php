@extends('layouts.auth-master')

@section('content')
<!--begin::Content-->
<div class="m-5">
    <h3>{{ __('batch-list.complete_batches') }}</h3>
    <x-alert />

    <table class="table table-bordered bg-white">
        <thead>
            <th>{{ __('batch-list.sl') }}</th>
            <th>{{ __('batch-list.batch_code') }}</th>
            <th>{{ __('batch-list.course_name') }}</th>
            <th>{{ __('batch-list.location') }}</th>
            <th>{{ __('batch-list.start_date') }}</th>
            <th>{{ __('batch-list.total_class') }}</th>
            <th>{{ __('batch-list.class_schedule') }}</th>
            <th>{{ __('batch-list.action') }}</th>
        </thead>
        <tbody>
            @foreach (range(1, 5) as $batch)
            <tr>
                <td>
                    {{ $loop->iteration }}
                </td>
                <td>
                    {{ fake()->name() }}
                </td>
                <td>
                    {{ fake()->name() }}
                </td>
                <td>
                    {{ fake()->city() }}
                </td>
                <td>
                    {{ fake()->time() }}
                </td>
                <td>
                    {{ rand(0, 50) }}
                </td>
                <td>
                    {{ fake()->date() }}
                </td>
                <td>
                    <a href="" class="btn btn-sm btn-info">
                        {{ __('batch-list.view') }}
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection