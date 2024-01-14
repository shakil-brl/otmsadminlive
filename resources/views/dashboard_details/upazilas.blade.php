@extends('layouts.auth-master')

@section('content')
    <!--begin::Content -->
    <div class="m-5">
        <h3>{{ __('upazila-list.upazila_list') }}</h3>
        <x-alert />
        @isset($total_upazilas)
            <div class="my-3">
                <form action="">
                    <div class="w-50 d-flex gap-3">
                        <input type="search" name="search" value="{{ request('search') }}" class="form-control w-75"
                            placeholder="{{ __('upazila-list.search_here') }}">
                        <input type="submit" class="form-control btn btn-primary w-25" value="{{ __('upazila-list.search') }}">
                    </div>
                </form>
            </div>
            <table class="table table-bordered bg-white">
                <thead>
                    <th>{{ __('upazila-list.sl') }}</th>
                    <th>{{ __('upazila-list.upazila_code') }}</th>
                    <th>{{ __('upazila-list.upazila_name_english') }}</th>
                    <th>{{ __('upazila-list.upazila_name_bangla') }}</th>
                    <th>{{ __('upazila-list.district_name') }}</th>
                    <th>{{ __('upazila-list.action') }}</th>
                </thead>
                <tbody>
                    @foreach (collect($total_upazilas) as $upazilas)
                        <tr>
                            <td>
                                {{ digitLocale($from + $loop->index) }}
                            </td>
                            <td>
                                {{ $upazilas['Code'] }}
                            </td>
                            <td>
                                {{ $upazilas['NameEng'] }}
                            </td>
                            <td>
                                {{ $upazilas['Name'] }}
                            </td>
                            <td>
                                {{ $upazilas['district']['NameEng'] }}
                            </td>
                            <td>
                                <a href="" class="btn btn-sm btn-info">
                                    {{ __('upazila-list.view') }}
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
