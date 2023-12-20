@extends('layouts.auth-master')
{{-- @dump($total_batches) --}}
@section('content')
    <!--begin::Content -->
    <div class="m-5">
        <h3>{{ __('batch-list.total_batches') }}</h3>
        <x-alert />
        @isset($total_batches)
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
                    <th>{{ __('batch-list.location') }}</th>
                    <th>{{ __('batch-list.start_date') }}</th>
                    <th>{{ __('batch-list.total_class') }}</th>
                    <th>{{ __('batch-list.action') }}</th>
                </thead>
                <tbody>
                    @foreach (collect($total_batches) as $batch)
                        <tr>
                            <td>
                                {{ $from_no + $loop->iteration - 1 }}
                            </td>
                            <td>
                                {{ $batch['batchCode'] }}
                            </td>
                            <td>
                                {{ $batch['GEOLocation'] }}
                            </td>
                            <td>
                                {{ $batch['startDate'] }}
                            </td>
                            <td>
                                {{ $batch['duration'] }} {{ __('batch-list.days') }}
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

            {!! $paginator->links() !!}
        @endisset
    </div>
@endsection
