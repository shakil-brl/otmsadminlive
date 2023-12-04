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
                        <form class="form w-100" novalidate="novalidate" method="POST"
                            action="{{ route('reset.password.store') }}">
                            @csrf
                            <!--begin::Heading-->
                            <input type="hidden" name="resetToken" value="{{ $resetPasswordToken }}">
                            <div class="text-center mb-10">
                                <!--begin::Title-->
                                <h1 class="text-dark fw-bolder mb-3">Setup New Password</h1>
                                <!--end::Title-->
                                <!--begin::Link-->
                                <div class="text-gray-500 fw-semibold fs-6">Have you already reset the password ?
                                    <a href="{{ route('login.show') }}" class="link-primary fw-bold">Sign in</a>
                                </div>
                                <!--end::Link-->
                            </div>
                            <!--begin::Heading-->
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
                            <!--begin::Input group-->
                            <div class="fv-row mb-8" data-kt-password-meter="true">
                                <!--begin::Wrapper-->
                                <div class="mb-1">
                                    <!--begin::Input wrapper-->
                                    <div class="position-relative mb-3">
                                        <input class="form-control bg-transparent" type="password" placeholder="Password"
                                            name="password" autocomplete="off" />
                                        <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2"
                                            data-kt-password-meter-control="visibility">
                                            <i class="ki-duotone ki-eye-slash fs-2"></i>
                                            <i class="ki-duotone ki-eye fs-2 d-none"></i>
                                        </span>
                                        <span class="text-danger">
                                            @error('password')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                    <!--end::Input wrapper-->
                                    <!--begin::Meter-->
                                    <div class="d-flex align-items-center mb-3" data-kt-password-meter-control="highlight">
                                        <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                        <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                        <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                        <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
                                    </div>
                                    <!--end::Meter-->
                                </div>
                                <!--end::Wrapper-->
                                <!--begin::Hint-->
                                <div class="text-muted">Use 8 or more characters with a mix of letters, numbers & symbols.</div>
                                <!--end::Hint-->
                            </div>
                            <!--end::Input group=-->
                            <!--end::Input group=-->
                            <div class="fv-row mb-8">
                                <!--begin::Repeat Password-->
                                <input type="password" placeholder="Repeat Password" name="confirm-password" autocomplete="off"
                                    class="form-control bg-transparent" />
                                <span class="text-danger">
                                    @error('password')
                                        {{ $message }}
                                    @enderror
                                    <!--end::Repeat Password-->
                            </div>
                            <!--end::Input group=-->
                            <!--begin::Action-->
                            <div class="d-grid mb-10">
                                <button type="submit" class="btn btn-primary">
                                    <!--begin::Indicator label-->
                                    <span class="indicator-label">Submit</span>
                                    <!--end::Indicator label-->
                                    <!--begin::Indicator progress-->
                                    <span class="indicator-progress">Please wait...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    <!--end::Indicator progress-->
                                </button>
                            </div>
                            <!--end::Action-->
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
