@extends('layouts.auth-master')
{{-- @dd($running_batches); --}}
@section('content')
    <!--begin::Content-->
    <div class="m-5">
        <h3>{{ 'Provider Batches' }}</h3>
        <x-alert />
        @isset($provider_batches)
            <div class="my-3">
                <form action="">
                    <div class="w-50 d-flex gap-3">
                        <input type="search" name="search" value="{{ request('search') }}" class="form-control w-75"
                            placeholder="{{ __('batch-list.search_here') }}">
                        <input type="submit" class="form-control btn btn-primary w-25" value="{{'provider batches'}}">
                    </div>
                </form>
            </div>
            <table class="table table-bordered bg-white">
                <thead>
                    <th>{{ 'S/N'}}</th>
                    <th>{{ 'Vendor' }}</th>
                    <th>{{ 'Division' }}</th>
                    <th>{{ 'District'}}</th>
                    <th>{{ 'Upazila' }}</th>
                    <th>{{ 'Course Name'}}</th>
                    <th>{{ 'Running Batches' }}</th>
                    <th>{{ 'Total Trainee' }}</th>
                    <th>{{ 'Total Dropout' }}</th>
                </thead>
                <tbody>
                    @foreach (collect($provider_batches) as $batch)
                        <tr>
                            <td>
                                {{ $loop->iteration }}
                            </td>
                            <td>
                                {{ $batch['name'] ? $batch['name'] : '' }}
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
