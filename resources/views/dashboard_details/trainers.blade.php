@extends('layouts.auth-master')

@section('content')

    <div class="m-5">
        <h3>{{ __('dashboard.all_trainer') }}</h3>
        <x-alert />
        @isset($total_trainers)
            <div class="my-3">
                <form action="">
                    <div class="w-50 d-flex gap-3">
                        <input type="search" name="search" value="{{ request('search') }}" class="form-control w-75"
                            placeholder="{{ __('dashboard.search_here') }}">
                        <input type="submit" class="form-control btn btn-primary w-25" value="{{ __('dashboard.search') }}">
                    </div>
                </form>
            </div>
            <table class="table table-bordered bg-white">
                <thead>
                    <th>{{ __('dashboard.sl') }}</th>
                    <th>{{ __('dashboard.name') }}</th>
                    <th>{{ __('dashboard.phone') }}</th>
                    <th>{{ __('dashboard.email') }}</th>
                    <th>{{ __('dashboard.gender') }}</th>
                    <th>{{ __('dashboard.address') }}</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                    @if (count($total_trainers) > 0)
                        @foreach (collect($total_trainers) as $trainers)
                            <tr>
                                <td>
                                    {{ digitLocale($from + $loop->index) }}
                                </td>
                                <td>
                                    {{ $trainers['profile']['KnownAs'] }}
                                </td>
                                <td>
                                    {{ $trainers['profile']['Phone'] }}
                                </td>
                                <td>
                                    {{ $trainers['profile']['Email'] }}

                                </td>
                                <td>
                                    {{ $trainers['profile']['Gender'] }}

                                </td>
                                <td>
                                    {{ $trainers['profile']['address'] }}

                                </td>
                                <td>
                                    <a href="" class="btn btn-sm btn-info">
                                        {{ __('upazila-list.view') }}
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="7">No data found</td>
                        </tr>
                    @endif
                </tbody>
            </table>

            {!! $paginator->links() !!}
        @endisset
    </div>
@endsection
