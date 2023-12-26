<!--begin::Header Section-->
<div class="mb-0" id="home">
    <!--begin::Wrapper-->
    <div class="bgi-no-repeat bgi-size-contain bgi-position-x-center bgi-position-y-bottom landing-dark-bg">
        <!--begin::Header-->
        <div class="landing-header" data-kt-sticky="true" data-kt-sticky-name="landing-header"
            data-kt-sticky-offset="{default: '200px', lg: '300px'}">
            <!--begin::Container-->
            <div class="container">
                <!--begin::Wrapper-->
                <div class="d-flex align-items-center justify-content-between">
                    <!--begin::Logo-->
                    <div class="d-flex align-items-center flex-equal">
                        <!--begin::Mobile menu toggle-->
                        <button class="btn btn-icon btn-active-color-primary me-3 d-flex d-lg-none"
                            id="kt_landing_menu_toggle">
                            <i class="ki-duotone ki-abstract-14 fs-2hx">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </button>
                        <!--end::Mobile menu toggle-->
                        <!--begin::Logo image-->
                        <a href="">
                            <img alt="Logo" src="{{ asset('assets/dist/assets/media/svg/logo/TMS_Logo.svg') }}"
                                class="logo-default h-25px h-lg-60px" />
                            <img alt="Logo" src="{{ asset('assets/dist/assets/media/svg/logo/TMS_Logo.svg') }}"
                                class="logo-sticky h-25px h-lg-60px" />
                        </a>
                        <!--end::Logo image-->
                    </div>
                    <!--end::Logo-->
                    <!--begin::Menu wrapper-->
                    <div class="d-lg-block" id="kt_header_nav_wrapper">
                        <div class="d-lg-block p-5 p-lg-0" data-kt-drawer="true" data-kt-drawer-name="landing-menu"
                            data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true"
                            data-kt-drawer-width="200px" data-kt-drawer-direction="start"
                            data-kt-drawer-toggle="#kt_landing_menu_toggle" data-kt-swapper="true"
                            data-kt-swapper-mode="prepend"
                            data-kt-swapper-parent="{default: '#kt_body', lg: '#kt_header_nav_wrapper'}">
                            <!--begin::Menu-->
                            <div class="menu menu-column flex-nowrap menu-rounded menu-lg-row menu-title-gray-500 menu-state-title-primary nav nav-flush fs-5 fw-semibold"
                                id="kt_landing_menu">
                                <!--begin::Menu item-->
                                <div class="menu-item">
                                    <a class="menu-link nav-link active py-3 px-4 px-xxl-6"
                                        href="{{ route('home.index') }}" data-kt-scroll-toggle="true"
                                        data-kt-drawer-dismiss="true">{{ __('landing-navbar.home') }}</a>
                                </div>
                                <!--end::Menu item-->
                                <!--begin::Menu item-->
                                <div class="menu-item">
                                    <!--begin::Menu link-->
                                    <a class="menu-link nav-link py-3 px-4 px-xxl-6"
                                        href="{{ route('home.index') }}#features" data-kt-scroll-toggle="true"
                                        data-kt-drawer-dismiss="true">{{ __('landing-navbar.feature') }}</a>
                                    <!--end::Menu link-->
                                </div>
                                <!--end::Menu item-->
                                <div class="menu-item">

                                    <!--begin::Menu link-->
                                    <a class="menu-link nav-link py-3 px-4 px-xxl-6"
                                        href="{{ route('home.index') }}#blogs" data-kt-scroll-toggle="true"
                                        data-kt-drawer-dismiss="true">{{ __('landing-navbar.blog') }}</a>
                                </div>
                                <!--end::Menu item-->


                                <div class="col-md-2 ms-2 w-25">
                                    <select class="form-control changeLang">
                                        <option value="en" {{ session()->get('locale') == 'en' ? 'selected' : '' }}>
                                            {{ __('landing-navbar.lang_english') }}
                                        </option>
                                        <option value="bn"
                                            {{ session()->get('locale') == 'bn' ? 'selected' : '' }}>
                                            {{ __('landing-navbar.lang_bangla') }}
                                        </option>
                                    </select>
                                </div>


                            </div>
                            <!--end::Menu-->
                        </div>
                    </div>
                    <!--end::Menu wrapper-->
                    <!--begin::Toolbar-->
                    <div class="flex-equal text-end ms-1">
                        <a href="{{ route('login.show') }}"
                            class="btn btn-success show-loader">{{ __('landing-navbar.sign_in') }}</a>
                    </div>
                    <!--end::Toolbar-->


                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Header-->
    </div>
    <!--end::Wrapper-->

</div>
<!--end::Header Section-->
