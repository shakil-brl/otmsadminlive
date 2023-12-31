@extends('layouts.app-master-home')

@section('content')
    @guest
        <!--begin::Authentication - Sign-in -->
        <div class="d-flex flex-column flex-lg-row flex-column-fluid mt-20">
            <!--begin::Body-->
            <div class="d-flex flex-column flex-lg-row-fluid w-lg-50 p-10 order-2 order-lg-2">
                <!--begin::Form-->
                <div class="d-flex flex-center flex-column flex-lg-row-fluid">
                    <!--begin::Wrapper-->
                    <div class="w-lg-500px p-10">
                        <!--begin::Form-->
                        <form class="form w-100" novalidate="novalidate" id="kt_sign_in_form" method="POST" action="">
                            @csrf
                            <!--begin::Heading-->
                            <div class="text-center mb-11">
                                <!--begin::Title-->
                                <h1 class="text-dark fw-bolder mb-3">{{ __('login.sign_in') }}</h1>
                                @include('layouts.partials.messages')

                                @if (request('message'))
                                    <div class="alert alert-info">
                                        {{ urldecode(request('message')) }}
                                    </div>
                                @endif
                                <span class="text-info form-message-error-success">
                                </span>
                                <span class="text-info form-message-error-error">
                                </span>
                            </div>
                            <!--begin::Input group=-->
                            <div class="fv-row mb-8">
                                <!--begin::User Name-->
                                <input type="text" placeholder="{{ __('login.placeholder_username') }}" name="username"
                                    autocomplete="off" class="form-control bg-transparent" value="" />
                                <span class="text-danger form-message-error-username">
                                </span>

                                <!--end::User Name-->
                            </div>
                            <!--end::Input group=-->
                            <div class="fv-row mb-3">
                                <!--begin::Password-->
                                <input type="password" placeholder="{{ __('login.placeholder_password') }}" value=""
                                    name="password" autocomplete="off" class="form-control bg-transparent" />
                                <span class="text-danger form-message-error-password">
                                </span>
                                <!--end::Password-->
                            </div>
                            <!--end::Input group=-->
                            <!--begin::Wrapper-->
                            <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
                                <div></div>
                                <!--begin::Link-->
                                <a href="" class="link-primary">{{ __('login.forgot_password') }}</a>
                                <!--end::Link-->
                            </div>
                            <!--end::Wrapper-->
                            <!--begin::Submit button-->
                            <div class="d-grid mb-10">
                                <button type="submit" class="btn btn-primary  show-loader ">
                                    <!--begin::Indicator label-->
                                    <span class="indicator-label">{{ __('login.sign_in') }}</span>
                                    <!--end::Indicator label-->
                                    <!--begin::Indicator progress-->
                                    <span class="indicator-progress">Please wait...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    <!--end::Indicator progress-->
                                </button>
                            </div>
                            <!--end::Submit button-->
                            <!--begin::Sign up-->
                            <div class="text-gray-500 text-center fw-semibold fs-6">{{ __('login.not_member_yet') }}
                                <a href="{{ route('register.show') }}" class="link-primary">{{ __('login.sign_up') }}</a>
                            </div>
                            <!--end::Sign up-->
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
            <div class="d-flex flex-lg-row-fluid w-lg-50 bgi-size-cover bgi-position-center order-1 order-lg-1">
                <!--begin::Content-->
                <div class="d-flex flex-column flex-center py-7 py-lg-15 px-5 px-md-15 w-100">
                    <!--begin::Logo-->

                    <!--end::Logo-->
                    <!--begin::Image-->
                    <img class="d-none d-lg-block mx-auto w-275px w-md-50 w-xl-500px mb-10 mb-lg-20"
                        src="{{ asset('assets/dist/assets/media/svg/img/001.svg') }}" alt="" />
                    <!--end::Image-->


                </div>
                <!--end::Content-->
            </div>
            <!--end::Aside-->
        </div>
        <!--end::Authentication - Sign-in-->
        @include('layouts.partials.footer')
        </div>

        <!--end::Root-->
    @endguest
@endsection
