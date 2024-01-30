@extends('layouts.auth-master')
{{-- @dd($providers); --}}
{{-- @dd($providers[0]) --}}
@section('content')
    <!--begin::Content-->
    <div class="m-5">
        <h3>{{ 'All Batches Without Schedule' }}</h3>
        <x-alert />
        @isset($without_schedule)
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
                    <th>{{ 'Trainning' }}</th>
                    <th>{{ 'Provider' }}</th>
                </thead>
                <tbody>
                    @foreach (collect($without_schedule) as $batch)
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
                                {{ $batch['get_training']['title']['Name'] ?? '' }}
                            </td>
                            <td>
                                {{ $batch['provider']['name'] ?? '' }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {!! $paginator->links() !!}
        @endisset
    </div>
    <!--end::Content-->
@section('scripts')
    
@endsection
@endsection
