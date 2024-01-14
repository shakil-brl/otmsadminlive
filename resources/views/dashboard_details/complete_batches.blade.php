@extends('layouts.auth-master')
{{-- @dd($running_batches); --}}
@section('content')
    <!--begin::Content-->
    <div class="m-5">
        <h3>{{ __('batch-list.complete_batches') }}</h3>
        <x-alert />
        @isset($complete_batches)
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
                    @foreach (collect($complete_batches) as $batch)
                        <tr>
                            <td>
                                {{ $from + $loop->index }}
                            </td>
                            <td>
                                {{ $batch['training_batch'] ? $batch['training_batch']['batchCode'] : '' }}
                            </td>
                            <td>
                                {{ $batch['training_batch'] ? $batch['training_batch']['startDate'] : '' }}
                            </td>
                            <td>
                                {{ $batch['training_batch'] ? $batch['training_batch']['training']['title']['Name'] : '' }}
                            </td>
                            <td>
                                {{ $batch['training_batch'] ? $batch['training_batch']['GEOLocation'] : '' }}
                            </td>
                            <td>
                                {{ $batch['training_batch'] ? $batch['training_batch']['provider']['name'] : '' }}
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
    <!--end::Content-->
@section('script')
    <script></script>
@endsection
@endsection
