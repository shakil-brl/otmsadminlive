@extends('layouts.app-master-home')

@section('content')
    @guest
        <!--begin::Authentication - Sign-up -->
        <div class="d-flex flex-column flex-lg-row flex-column-fluid mt-20">
            <!--begin::Body-->
            <div class="d-flex flex-column flex-lg-row-fluid w-lg-50 p-10 order-2 order-lg-1">
                <!--begin::Form-->
                <div class="d-flex flex-center flex-column flex-lg-row-fluid">
                    <!--begin::Wrapper-->
                    <div class="w-lg-500px p-10">

                        <!--begin::Form-->
                        <form class="form w-100" novalidate="novalidate" method="POST" action="{{ route('forget.store') }}">
                            @csrf
                            <!--begin::Heading-->

                            <div class="text-center mb-10">
                                <!--begin::Title-->
                                <h1 class="text-dark fw-bolder mb-3">Forgot Password ?</h1>
                                <!--end::Title-->
                                <!--begin::Link-->
                                <div class="text-gray-500 fw-semibold fs-6">Enter your email to reset your password.</div>
                                <!--end::Link-->
                            </div>
                            @include('layouts.partials.messages')
                            <!--begin::Heading-->
                            <!--begin::Input group=-->
                            <div class="fv-row mb-8">
                                <!--begin::Email-->
                                <input type="text" placeholder="Email" name="email" autocomplete="off"
                                    class="form-control bg-transparent" value="{{ old('email') }}" />
                                <span class="text-danger">
                                    @error('email')
                                        {{ $message }}
                                    @enderror
                                </span>
                                <!--end::Email-->
                            </div>
                            <!--begin::Actions-->
                            <div class="d-flex flex-wrap justify-content-center pb-lg-0">
                                <button type="submit" class="btn btn-primary me-4">
                                    <!--begin::Indicator label-->
                                    <span class="indicator-label">Submit</span>
                                    <!--end::Indicator label-->
                                    <!--begin::Indicator progress-->
                                    <span class="indicator-progress">Please wait...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    <!--end::Indicator progress-->
                                </button>
                                <a href="{{ route('login.show') }}" class="btn btn-light">Cancel</a>
                            </div>
                            <!--end::Actions-->
                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Form-->
                <!--begin::Footer-->
                <!--end::Footer-->
            </div>
            <!--end::Body-->
            <!--begin::Aside-->
            <div class="d-flex flex-lg-row-fluid w-lg-50 bgi-size-cover bgi-position-center order-1 order-lg-2">
                <!--begin::Content-->
                <div class="d-flex flex-column flex-center py-7 py-lg-15 px-5 px-md-15 w-100">

                    <!--begin::Image-->
                    <img class="d-none d-lg-block mx-auto w-275px w-md-50 w-xl-500px mb-10 mb-lg-20"
                        src="{{ asset('assets/dist/assets/media/svg/img/003.svg') }}" alt="" />
                    <!--end::Image-->

                </div>
                <!--end::Content-->
            </div>
            <!--end::Aside-->
        </div>
        <!--end::Authentication - Sign-up-->
        @include('layouts.partials.footer')
        </div>
        <!--end::Root-->
    @endguest

@section('scripts')
    <script src="{{ asset('assets/dist/assets/js/custom/authentication/sign-up/general.js') }}"></script>
@endsection
@endsection
