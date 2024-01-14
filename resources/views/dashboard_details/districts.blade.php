@extends('layouts.auth-master')

@section('content')
<!--begin::Content -->
<div class="m-5">
    <h3>{{__('district-list.district_list')}}</h3>
    <x-alert />
    @isset($total_districts)
    <div class="my-3">
        <form action="">
            <div class="w-50 d-flex gap-3">
                <input type="search" name="search" value="{{ request('search') }}" class="form-control w-75"
                    placeholder="{{__('district-list.search_here')}}">
                <input type="submit" class="form-control btn btn-primary w-25" value="{{__('district-list.search')}}">
            </div>
        </form>
    </div>
    <table class="table table-bordered bg-white">
        <thead>
            <th>{{__('district-list.sl')}}</th>
            <th>{{__('district-list.district_code')}}</th>
            <th>{{__('district-list.district_name_english')}}</th>
            <th>{{__('district-list.district_name_bangla')}}</th>
            <th>{{__('district-list.action')}}</th>
        </thead>
        <tbody>
            @foreach (collect($total_districts) as $district)
            <tr>
                <td>
                    {{-- {{ $from + $loop->index }} --}}
                </td>
                <td>
                    {{ $district['Code'] }}
                </td>
                <td>
                    {{ $district['NameEng'] }}
                </td>
                <td>
                    {{ $district['Name'] }}
                </td>
                <td>
                    <a href="" class="btn btn-sm btn-info">
                        {{__('district-list.view')}}
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