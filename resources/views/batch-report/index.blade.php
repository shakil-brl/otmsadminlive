@extends('layouts.auth-master')
{{-- @dd($providers); --}}
{{-- @dd($providers[0]) --}}
@section('content')
    <!--begin::Content-->
    <div class="m-5">
        <h3>{{ __('provider-list.all_vendor') }}</h3>
        <x-alert />
        @isset($providers)
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
                    <th>{{ __('provider-list.sl') }}</th>
                    <th>{{ __('provider-list.name') }}</th>
                    <th>{{ __('provider-list.email') }}</th>
                    <th>{{ __('provider-list.phone') }}</th>
                    <th>{{ __('provider-list.address') }}</th>
                    <th>{{ __('provider-list.action') }}</th>
                </thead>
                <tbody>
                    @foreach (collect($providers) as $provider)
                        {{-- @dump($provider) --}}
                        <tr>
                            <td>
                                {{ $page_from + $loop->iteration - 1 }}
                            </td>
                            <td>
                                {{ $provider['name'] ?? '' }}
                            </td>
                            <td>
                                {{ $provider['email'] ?? '' }}
                            </td>
                            <td>
                                {{ $provider['phone'] ?? '' }}
                            </td>
                            <td>
                                {{ $provider['address'] ?? '' }}
                            </td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Provider Actions">                                   
                                    <a href="{{ route('vendor.batches', $provider['id']) }}"
                                        class="btn btn-sm btn-success show-loader" data-bs-toggle="tooltip"
                                        data-bs-custom-class="tooltip-inverse" data-bs-placement="bottom"
                                        title="{{ 'Provider Batch Lists' }}">
                                        {{ 'Batch List'}}
                                    </a>
                                    
                                </div>
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
