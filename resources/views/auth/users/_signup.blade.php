@extends('layouts.app-master-home')

@section('content')
    @guest
        <!--begin::Authentication - Sign-up -->
        <div class="d-flex flex-column flex-lg-row flex-column-fluid  mt-20">
            <!--begin::Body-->
            <div class="d-flex flex-column flex-lg-row-fluid w-lg-50 p-10 order-2 order-lg-1">
                <!--begin::Form-->
                <div class="d-flex flex-center flex-column flex-lg-row-fluid">
                    <!--begin::Wrapper-->
                    <div class="w-lg-500px p-10">
                        <!--begin::Form-->
                        <form class="form w-100" method="POST" action="" id="register_form">
                            @csrf
                            <!--begin::Heading-->
                            <div class="text-center mb-11">
                                <!--begin::Title-->
                                <h1 class="text-dark fw-bolder mb-3">{{ __('register.sign_up') }}</h1>
                                @include('layouts.partials.messages')
                                <span class="text-info form-message-error-success">
                                </span>
                            </div>
                            <div class="fv-row mb-8">
                                <!--begin::First Name-->
                                <input type="text" placeholder="{{ __('register.placeholder_fname') }}" type="text"
                                    id="fname" name="fname" autocomplete="off" class="form-control bg-transparent"
                                    value="" />
                                <span class="text-danger form-message-error-fname">
                                </span>
                                <!--end::First Name-->
                            </div>
                            <div class="fv-row mb-8">
                                <!--begin::Last Name-->
                                <input type="text" placeholder="{{ __('register.placeholder_lname') }}" type="text"
                                    id="lname" name="lname" autocomplete="off" class="form-control bg-transparent"
                                    value="" />
                                <span class="text-danger form-message-error-lname">
                                </span>
                                <!--end::Last Name-->
                            </div>
                            <div class="fv-row mb-8">
                                <!--begin::Email-->
                                <input type="text" placeholder="{{ __('register.email') }}" type="email" id="email"
                                    name="email" autocomplete="off" class="form-control bg-transparent" value="" />
                                <span class="text-danger form-message-error-email">
                                </span>
                                <!--end::Email-->
                            </div>
                            <!--begin::Input group-->

                            <div class="fv-row mb-8">
                                <!--begin::Username-->
                                <input type="text" placeholder="{{ __('register.username') }}" type="text" id="username"
                                    name="username" autocomplete="off" class="form-control bg-transparent" value="" />
                                <span class="text-danger form-message-error-username">
                                </span>
                                <!--end::Username-->
                            </div>

                            <!--begin::Input group-->
                            <div class="fv-row mb-8">
                                <!--begin::Wrapper-->
                                <div class="mb-1">
                                    <!--begin::Input wrapper-->
                                    <div class="position-relative mb-3">
                                        <input class="form-control bg-transparent" value="" type="password"
                                            placeholder="{{ __('register.password') }}" name="password" autocomplete="off" />
                                        <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2"
                                            data-kt-password-meter-control="visibility">
                                            <i class="ki-duotone ki-eye-slash fs-2"></i>
                                            <i class="ki-duotone ki-eye fs-2 d-none"></i>
                                        </span>
                                        <span class="text-danger form-message-error-password">
                                        </span>
                                    </div>
                                    <!--end::Input wrapper-->
                                </div>
                                <!--end::Wrapper-->
                                <!--begin::Hint-->
                                <div class="text-muted">{{ __('register.password_requirement') }}</div>
                                <!--end::Hint-->
                            </div>
                            <!--end::Input group=-->
                            <div class="fv-row mb-8">
                                <!--begin::Repeat Password-->
                                <input class="form-control bg-transparent" value=""
                                    placeholder="{{ __('register.repeat_password') }}" name="confirm_password"
                                    id="confirm_password" type="password" autocomplete="off" />
                                <!--end::Repeat Password-->
                                <span class="text-danger form-message-error-confirm_password" id="">
                                </span>
                            </div>
                            <!--end::Input group=-->
                            <!--begin::Submit button-->
                            <div class="d-grid mb-10">
                                <button type="submit" class="btn btn-primary">{{ __('register.save') }}</button>
                            </div>
                            <!--end::Submit button-->
                            <!--begin::Sign up-->
                            <div class="text-gray-500 text-center fw-semibold fs-6">{{ __('register.already_acount') }}
                                <a href="{{ route('login.show') }}"
                                    class="link-primary fw-semibold">{{ __('register.sign_in') }}</a>
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
            <div class="d-flex flex-lg-row-fluid w-lg-50 bgi-size-cover bgi-position-center order-1 order-lg-2">
                <!--begin::Content-->
                <div class="d-flex flex-column flex-center py-7 py-lg-15 px-5 px-md-15 w-100">

                    <!--begin::Image-->
                    <img class="d-none d-lg-block mx-auto w-275px w-md-50 w-xl-500px mb-10 mb-lg-20"
                        src="{{ asset('assets/dist/assets/media/svg/img/002.svg') }}" alt="" />
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
