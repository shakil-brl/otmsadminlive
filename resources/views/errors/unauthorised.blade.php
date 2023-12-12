@extends('layouts.errors-master')

@section('content')
<!--begin::Wrapper-->
<div class="card card-flush w-lg-650px py-5">
    <div class="card-body py-15 py-lg-20">
        <!--begin::Title-->
        <h1 class="fw-bolder fs-2hx text-gray-900 mb-4">Oops!</h1>
        <!--end::Title-->
        <!--begin::Text-->
        @dd($authUser)
        @php
        // if (!is_null($authUser)) {
        // $message = 'Sorry Mr.'.$authUser['fullName'];
        // }else{
        // $message = 'User does not have the right permissions.';
        // }
        @endphp
        <div class="fw-semibold fs-2 text-gray-900 mb-4">{{$message}}</div>
        <!--end::Text-->
        <!--begin::Illustration-->
        <div class="mb-3">
            <img src="{{ asset('assets/dist/assets/media/auth/no-unauthorised1.gif')}}"
                class="mw-100 mh-300px theme-light-show" alt="" />
            <img src="{{ asset('assets/dist/assets/media/auth/no-unauthorised1.gif')}}"
                class="mw-100 mh-300px theme-dark-show" alt="" />
        </div>
        <!--end::Illustration-->
        <!--begin::Link-->
        <div class="mb-0">
            <a href="{{ url()->previous() }}" class="btn btn-sm btn-primary">Return Back</a>
        </div>
        <!--end::Link-->
    </div>
</div>
<!--end::Wrapper-->
@endsection