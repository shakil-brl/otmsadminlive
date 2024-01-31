@extends('layouts.auth-master')
{{-- @dd($providers); --}}
{{-- @dd($providers[0]) --}}
@section('content')
    <!--begin::Content-->
    <div class="m-5">
        <h3>{{ 'All Batches Schedule But Not Start The Class' }}</h3>
        <x-alert />
        @isset($not_schedule)
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
                <div class="w-50">
                    <div class="d-flex justify-content-end align-items-center">
                    @php 
                         $search = Request::get("search") ? Request::get("search") : 'null';
                         $page = Request::get("page") ? Request::get("page") : 1; @endphp
                    <a href="{{ route('not-start-class.pdf-report',['search' => $search, 'page'=> $page]) }}" class="btn btn-lg btn-secondary gap-3 me-1">
                        {{ 'PDF' }}
                    </a>
                    </div>
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
                    @foreach (collect($not_schedule) as $batch)
                        <tr>
                            <td>
                                {{ $page_from + $loop->iteration - 1 }}
                            </td>
                            <td>
                                {{ $batch['training_batch']['batchCode'] ?? '' }}
                            </td>
                            <td>
                                {{ $batch['training_batch']['GEOLocation'] ?? '' }}
                            </td>
                            <td>
                                {{ $batch['training_batch']['training']['title']['Name'] ?? '' }}
                            </td>
                            <td>
                                {{ $batch['training_batch']['provider']['name'] ?? '' }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {!! $paginator->withQueryString()->links() !!}
        @endisset
    </div>
    <!--end::Content-->
@section('scripts')
@endsection
@endsection
