@extends('layouts.auth-master')

@section('content')
<!--begin::Content -->
<div class="m-5">
    <h3>{{ __('provider-list.provider_list') }}</h3>
    <x-alert />
    @isset($total_partners)
    <div class="my-3">
        <form action="">
            <div class="w-50 d-flex gap-3">
                <input type="search" name="search" value="{{ request('search') }}" class="form-control w-75"
                    placeholder="search here">
                <input type="submit" class="form-control btn btn-primary w-25" value="Search">
            </div>
        </form>
    </div>
    <table class="table table-bordered bg-white">
        <thead>
            <th>SN</th>
            <th>Name</th>
            <th>Address</th>
            <th>Email</th>
            <th>Phone</th>
            <th>{{ __('batch-list.action') }}</th>
        </thead>
        <tbody>
            @foreach (collect($total_partners) as $partners)
            <tr>
                <td>
                    {{ $loop->iteration }}
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
                    <a href="" class="btn btn-sm btn-info">
                        View
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