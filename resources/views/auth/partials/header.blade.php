<!--begin::Header-->
<div id="kt_app_header" class="app-header">
    <!--begin::Header container-->
    <div class="app-container container-fluid d-flex align-items-stretch justify-content-between"
        id="kt_app_header_container">
        <!--begin::Sidebar mobile toggle-->
        <div class="d-flex align-items-center d-lg-none ms-n3 me-1 me-md-2" title="Show sidebar menu">
            <div class="btn btn-icon btn-active-color-primary w-35px h-35px" id="kt_app_sidebar_mobile_toggle">
                <i class="ki-duotone ki-abstract-14 fs-2 fs-md-1">
                    <span class="path1"></span>
                    <span class="path2"></span>
                </i>
            </div>
        </div>
        <!--end::Sidebar mobile toggle-->
        <!--begin::Mobile logo-->
        <div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0">
            <a href="" class="d-lg-none">
                <img alt="Logo" src="{{ asset('assets/dist/assets/media/svg/logo/Logo_3.svg') }}" class="h-40px" />
            </a>
        </div>
        <!--end::Mobile logo-->
        <!--begin::Header wrapper-->
        <div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1" id="kt_app_header_wrapper">
            <!--begin::Menu wrapper-->
            <div class="app-header-menu app-header-mobile-drawer align-items-stretch" data-kt-drawer="true"
                data-kt-drawer-name="app-header-menu" data-kt-drawer-activate="{default: true, lg: false}"
                data-kt-drawer-overlay="true" data-kt-drawer-width="250px" data-kt-drawer-direction="end"
                data-kt-drawer-toggle="#kt_app_header_menu_toggle" data-kt-swapper="true"
                data-kt-swapper-mode="{default: 'append', lg: 'prepend'}"
                data-kt-swapper-parent="{default: '#kt_app_body', lg: '#kt_app_header_wrapper'}">
                <!--begin::Menu-->
                <div class="menu menu-rounded menu-column menu-lg-row my-5 my-lg-0 align-items-stretch fw-semibold px-2 px-lg-0"
                    id="kt_app_header_menu" data-kt-menu="true">
                    <!--begin:Menu item-->
                    <div class="menu-item menu-here-bg menu-lg-down-accordion me-0 me-lg-2">
                        <!--begin:Menu link-->
                        <span class="menu-link d-none">
                            <a href="" class="menu-title">{{ __('dashboard-header.frontend') }}</a>
                            <span class="menu-arrow d-lg-none"></span>
                        </span>
                        {{-- <div class="">
                            <select class="form-control changeLang">
                                <option value="en" {{ session()->get('locale') == 'en' ? 'selected' : '' }}>
                                    {{ __('dashboard-header.lang_english') }}</option>
                                <option value="bn" {{ session()->get('locale') == 'bn' ? 'selected' : '' }}>
                                    {{ __('dashboard-header.lang_bangla') }}</option>
                            </select>
                        </div> --}}
                        <div class="govt-logo">
                            <img src="{{ asset('img/govt.png') }}" height="59" alt="">
                        </div>
                        <!--end:Menu link-->
                        <!--begin:Menu sub-->
                        <div class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown p-0 w-100 w-lg-850px">
                            <!--begin:Dashboards menu-->
                            <div class="menu-state-bg menu-extended overflow-hidden overflow-lg-visible"
                                data-kt-menu-dismiss="true">
                            </div>
                            <!--end:Dashboards menu-->
                        </div>
                        <!--end:Menu sub-->
                    </div>
                    <!--end:Menu item-->

                </div>
                <!--end::Menu-->
            </div>
            <!--end::Menu wrapper-->
            <!--begin::Navbar-->
            <div class="app-navbar flex-shrink-0">
                <!--begin::Notifications-->
                <div class="app-navbar-item ms-1 ms-md-3 me-3" id="lang">
                    <!--begin::Menu- wrapper-->
                    <div class="btn btn-icon btn-custom btn-icon-muted btn-active-light btn-active-color-primary w-30px h-30px w-md-40px h-md-40px position-relative"
                        data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent"
                        data-kt-menu-placement="bottom-end" id="kt_menu_item_wow">

                        <div class="lang-header">
                            @if (session()->get('locale') == 'en')
                                <img class="flag" src="{{ asset('img/icon/us.svg') }}" alt="">
                                <span class="label dropdown-toggle">English</span>
                            @elseif(session()->get('locale') == 'bn')
                                <img class="flag" src="{{ asset('img/icon/bd.svg') }}" alt="">
                                <span class="label dropdown-toggle">বাংলা</span>
                            @else
                                <img class="flag" src="{{ asset('img/icon/us.svg') }}" alt="">
                                <span class="label dropdown-toggle">English</span>
                            @endif
                        </div>

                    </div>
                    <!--begin::Menu-->
                    <div class="menu menu-sub menu-sub-dropdown menu-column" data-kt-menu="true">
                        <a class="lang-menu" id="lang-bd">
                            <img class="flag" src="{{ asset('img/icon/bd.svg') }}" alt="">
                            <span class="label">বাংলা</span>
                        </a>
                        <a class="lang-menu" id="lang-us">
                            <img class="flag" src="{{ asset('img/icon/us.svg') }}" alt="">
                            <span class="label">English</span>
                        </a>
                    </div>
                    <!--end::Menu-->
                    <!--end::Menu wrapper-->
                </div>
                <!--end::Notifications-->
                <!--begin::Search-->
                <div class="app-navbar-item align-items-stretch ms-1 ms-md-3">

                </div>
                <!--end::Search-->
                <!--begin::User menu-->
                <div class="app-navbar-item ms-1 ms-md-3" id="kt_header_user_menu_toggle">
                    <!--begin::Menu wrapper-->
                    <div class="cursor-pointer d-flex align-items-center symbol symbol-30px symbol-md-40px"
                        data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent"
                        data-kt-menu-placement="bottom-end">
                        <img src="{{ asset('assets/dist/assets/media/svg/avatars/blank.svg') }}" alt="user" />
                        <span class="username" id="userInfo">
                            <div class="fw-bold fs-5 userName">
                            </div>
                        </span>
                    </div>
                    <!--begin::User account menu-->
                    <div id="logout-panel"
                        class="menu menu-sub bd-dark menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px"
                        data-kt-menu="true">
                        <!--begin::Menu item-->
                        <div class="menu-item">
                            <div class="menu-content d-flex align-items-center">
                                <!--begin::Avatar-->
                                <div class="symbol symbol-50px me-5">
                                    <img alt="Logo"
                                        src="{{ asset('assets/dist/assets/media/svg/avatars/blank.svg') }}"
                                        alt="image" />
                                </div>
                                <!--end::Avatar-->
                                <!--begin::Username-->
                                <div class="d-flex flex-column" id="userInfo">
                                    <div class="fw-bold d-flex align-items-center fs-5 userName">
                                        <span class="badge badge-light-success fw-bold fs-8 px-2 py-1 ms-2">
                                        </span>
                                    </div>
                                    <a href="#"
                                        class="fw-semibold text-muted text-hover-primary fs-7 userEmail"></a>
                                </div>
                                <!--end::Username-->
                            </div>
                        </div>
                        <!--end::Menu item-->
                        <!--begin::Menu separator-->
                        <div class="separator my-2"></div>
                        <!--end::Menu separator-->
                        <!--begin::Menu item-->
                        <div class="menu-item px-5">
                            <a href="{{ route('admins.profile') }}" class="menu-link px-5">
                                <img src="{{ asset('img/icon/person.svg') }}" alt="">
                                {{ __('dashboard-header.my_account') }}
                            </a>
                        </div>
                        <div class="menu-item px-5">
                            <a href="" class="menu-link px-5">
                                <img src="{{ asset('img/icon/feedback.svg') }}" alt="">
                                Send Feedback
                            </a>
                        </div>
                        <!--end::Menu item-->
                        <!--begin::Menu item-->
                        <div class="separator my-2"></div>
                        <form action="{{ url('/logout') }}" method="POST" class="logout-btn">
                            @csrf
                            <button class="logout btn">
                                <img src="{{ asset('img/icon/logout.svg') }}">
                                {{ __('dashboard-header.sign_out') }}
                            </button>
                        </form>
                        <!--end::Menu item-->
                    </div>
                    <!--end::User account menu-->
                    <!--end::Menu wrapper-->
                </div>
                <!--end::User menu-->
                <!--begin::Header menu toggle-->
                <div class="app-navbar-item d-lg-none ms-2 me-n2" title="Show header menu">
                    <div class="btn btn-flex btn-icon btn-active-color-primary w-30px h-30px"
                        id="kt_app_header_menu_toggle">
                        <i class="ki-duotone ki-element-4 fs-1">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                    </div>
                </div>
                <!--end::Header menu toggle-->
            </div>
            <!--end::Navbar-->
        </div>
        <!--end::Header wrapper-->
    </div>
    <!--end::Header container-->
</div>
<!--end::Header-->
<script>
    window.onload = function() {
        let userObj = JSON.parse(localStorage.getItem('authUser'));
        sessionStorage.setItem("userData", 'sayed al momin');
        if (userObj) {
            //console.log(userObj.fullName);
            $("#userInfo .userName").text(userObj.fullName);
            $("#userInfo .userEmail").text(userObj.userEmail);
        }
    }
</script>
