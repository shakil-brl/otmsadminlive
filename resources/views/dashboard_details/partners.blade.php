@extends('layouts.auth-master')

@section('content')
    <!--begin::Content -->
    <div class="m-5">
        <h3>{{ __('provider-list.development_partner') }}</h3>
        <x-alert />
        @isset($total_partners)
            <div class="my-3">
                <form action="">
                    <div class="w-50 d-flex gap-3">
                        <input type="search" name="search" value="{{ request('search') }}" class="form-control w-75"
                            placeholder="{{ __('provider-list.search_here') }}">
                        <input type="submit" class="form-control btn btn-primary w-25" value="{{ __('provider-list.search') }}">
                    </div>
                </form>
            </div>
            <table class="table table-bordered bg-white">
                <thead>
                    <th>{{ __('provider-list.sl') }}</th>
                    <th>{{ __('provider-list.name') }}</th>
                    <th>{{ __('provider-list.address') }}</th>
                    <th>{{ __('provider-list.email') }}</th>
                    <th>{{ __('provider-list.phone') }}</th>
                    <th>{{ __('batch-list.action') }}</th>
                </thead>
                <tbody>
                    @foreach (collect($total_partners) as $partners)
                        <tr>
                            <td>
                                {{ digitLocale($from + $loop->index) }}
                            </td>
                            <td>
                                {{ $partners['name'] }}
                            </td>
                            <td>
                                {{ $partners['address'] }}
                            </td>
                            <td>
                                {{ $partners['email'] }}
                            </td>
                            <td>
                                {{ $partners['phone'] }}
                            </td>
                            <td>
                                <a href="{{ route('providers.show', $partners['id']) }}" class="btn btn-sm mt-1 btn-info">
                                    View
                                </a>
                                @if (in_array(strtolower(Session::get('access_token')['role']), [
                                        'superadmin',
                                        'pd',
                                        'dpd',
                                        'admin',
                                        'consultant',
                                        'dg',
                                        'minister',
                                        'secretary',
                                        'project office',
                                    ]))
                                    @if ($partners['evaluation'] == null)
                                        <a href="{{ route('evaluate.vendor.form', $partners['id']) }}"
                                            class="btn mt-1 btn-sm btn-primary">
                                            Evaluate
                                        </a>
                                    @else
                                        <span class="badge badge-success">Evaluated</span>
                                    @endif
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
