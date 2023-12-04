<!--begin::Sidebar-->
@php
    $routePermissions = Session::get('rolePermission');
    $roleRoutePermissions = Session::get('accessPermission');
    //dd($roleRoutePermissions);
    use Illuminate\Support\Facades\Route;
@endphp
<div style="font-size:14px;" id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true"
    data-kt-drawer-name="app-sidebar" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true"
    data-kt-drawer-width="225px" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
    <!--begin::Logo-->
    <div class="app-sidebar-logo px-6" id="kt_app_sidebar_logo">
        <!--begin::Logo image-->
        <a href="">
            <img alt="Logo" src="{{ asset('assets/dist/assets/media/svg/logo/TMS_Logo.svg') }}"
                class="app-sidebar-logo-default" />
            <img alt="Logo" src="{{ asset('assets/dist/assets/media/svg/logo/TMS_Logo1_1.svg') }}"
                class="h-30px app-sidebar-logo-minimize" />
        </a>
        <!--end::Logo image-->
        <div id="kt_app_sidebar_toggle"
            class="app-sidebar-toggle btn btn-icon btn-shadow btn-sm btn-color-muted btn-active-color-primary body-bg h-30px w-30px position-absolute top-50 start-100 translate-middle rotate"
            data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body"
            data-kt-toggle-name="app-sidebar-minimize">
            <i class="ki-duotone ki-double-left fs-2 rotate-180">
                <span class="path1"></span>
                <span class="path2"></span>
            </i>
        </div>
        <!--end::Sidebar toggle-->
    </div>
    <!--end::Logo-->
    <!--begin::sidebar menu-->
    <div class="app-sidebar-menu overflow-hidden flex-column-fluid">
        <!--begin::Menu wrapper-->
        <div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper hover-scroll-overlay-y my-5"
            data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto"
            data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer"
            data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px" data-kt-scroll-save-state="true">
            <!--begin::Menu-->
            <div class="menu menu-column menu-rounded menu-sub-indention px-3" id="#kt_app_sidebar_menu"
                data-kt-menu="true" data-kt-menu-expand="false">
                @php
                    $momin = Session::get('momin');
                    $userRole = Session::get('authUser.fullName');
                @endphp
                <!--begin:Menu item-->
                <div data-kt-menu-trigger="click"
                    class="menu-item menu-accordion <?php if ( Illuminate\Support\Facades\Route::is('admins.profile')|| Illuminate\Support\Facades\Route::is('admins.dashboard') || Illuminate\Support\Facades\Route::is('profile.index') || Illuminate\Support\Facades\Route::is('dashboard')) {?>here show <?php } ?>">
                    <!--begin:Menu link-->

                    @if ($userRole == 'Trainee' || $userRole == 'trainee')
                        <span
                            class="menu-link sidebar-menu-link dashboard-item <?php if (Illuminate\Support\Facades\Route::is('profile.index') || Illuminate\Support\Facades\Route::is('dashboard')) {?>active<?php } ?>">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-element-7 fs-2">
                                    <i class="path1"></i>
                                    <i class="path2"></i>
                                </i>
                            </span>
                            <span class="menu-title">{{ __('sidemenu.user_dashboard') }}</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <!--begin:Menu sub-->
                        <div class="menu-sub menu-sub-accordion <?php if (Illuminate\Support\Facades\Route::is('dashboard')) {?>here show <?php } ?>">

                            <!--begin:Menu item-->
                            <div class="menu-item">
                                <!--begin:Menu link-->
                                <a class="menu-link sidebar-menu-link <?php if (Illuminate\Support\Facades\Route::is('dashboard') ) {?>active<?php } ?>"
                                    href="{{ route('dashboard') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title ">{{ __('sidemenu.dashboard') }}</span>
                                </a>
                                <!--end:Menu link-->
                                <!--begin:Menu link-->
                                <a class="menu-link sidebar-menu-link <?php if (Illuminate\Support\Facades\Route::is('profile.index')) {?>active<?php } ?>"
                                    href="{{ route('profile.index') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title ">{{ __('sidemenu.my_account') }}</span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <!--end:Menu item-->
                        </div>
                        <!--end:Menu sub-->
                    @else
                        <span
                            class="menu-link sidebar-menu-link dashboard-item <?php if (Illuminate\Support\Facades\Route::is('admins.profile') || Illuminate\Support\Facades\Route::is('admins.dashboard')) {?>active<?php } ?>">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-element-7 fs-2">
                                    <i class="path1"></i>
                                    <i class="path2"></i>
                                </i>
                            </span>
                            <span class="menu-title">{{ __('sidemenu.admin_dashboard') }}</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <!--end:Menu link-->
                        <!--begin:Menu sub-->
                        <div class="menu-sub menu-sub-accordion <?php if (Illuminate\Support\Facades\Route::is('admins.dashboard')) {?>here show <?php } ?>">

                            <!--begin:Menu item-->
                            <div class="menu-item">
                                <!--begin:Menu link-->
                                <a class="menu-link sidebar-menu-link <?php if (Illuminate\Support\Facades\Route::is('admins.dashboard') ) {?>active<?php } ?>"
                                    href="{{ route('admins.dashboard') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title ">{{ __('sidemenu.dashboard') }}</span>
                                </a>
                                <!--end:Menu link-->
                                <!--begin:Menu link-->
                                <a class="menu-link sidebar-menu-link <?php if (Illuminate\Support\Facades\Route::is('admins.profile')) {?>active<?php } ?>"
                                    href="{{ route('admins.profile') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title ">{{ __('sidemenu.my_account') }}</span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <!--end:Menu item-->
                        </div>
                        <!--end:Menu sub-->
                    @endif
                </div>
                <!--end:Menu item-->
                <!--begin:Menu item-->
                <div class="menu-item pt-5">
                    <!--begin:Menu content-->
                    <div class="menu-content">
                        <span class="menu-heading fw-bold text-uppercase fs-7">{{ __('sidemenu.pages') }}</span>
                    </div>
                    <!--end:Menu content-->

                </div>
                <!--end:Menu item-->
                @if ($userRole == 'Trainee' || $userRole == 'trainee')
                @else
                    <div data-kt-menu-trigger="click"
                        class="menu-item here menu-accordion <?php if (Illuminate\Support\Facades\Route::is('users.index') || Illuminate\Support\Facades\Route::is('users.show')||Illuminate\Support\Facades\Route::is('admins.index') || Illuminate\Support\Facades\Route::is('admins.show') ||Illuminate\Support\Facades\Route::is('preliminary-selected.index')||Illuminate\Support\Facades\Route::is('role.index')|| Illuminate\Support\Facades\Route::is('permission.index')) {?> here show<?php } ?> ">
                        <!--begin:Menu link-->

                        <span class="menu-link sidebar-menu-link <?php if (Illuminate\Support\Facades\Route::is('users.index')|| Illuminate\Support\Facades\Route::is('users.show')|| Illuminate\Support\Facades\Route::is('admins.index') || Illuminate\Support\Facades\Route::is('admins.show')||Illuminate\Support\Facades\Route::is('preliminary-selected.index')||Illuminate\Support\Facades\Route::is('role.index')|| Illuminate\Support\Facades\Route::is('permission.index')) {?> active<?php } ?>   ">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-profile-user fs-2">
                                    <i class="path1"></i>
                                    <i class="path2"></i>
                                    <i class="path3"></i>
                                    <i class="path4"></i>
                                </i>
                            </span>
                            <span class="menu-title ">{{ __('sidemenu.user_management') }}</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <!--end:Menu link-->
                        <!--begin:Menu sub-->
                        <div class="menu-sub menu-sub-accordion" kt-hidden-height="124" style="">
                            <!--begin:Menu item-->

                            <div data-kt-menu-trigger="click"
                                class="menu-item menu-accordion  mb-1 <?php if (Illuminate\Support\Facades\Route::is('users.index') || Illuminate\Support\Facades\Route::is('users.show')||Illuminate\Support\Facades\Route::is('preliminary-selected.index')) {?> here show<?php } ?>">
                                <!--begin:Menu link-->
                                <span
                                    class="menu-link sidebar-menu-link <?php if (Illuminate\Support\Facades\Route::is('users.index') || Illuminate\Support\Facades\Route::is('users.show')||Illuminate\Support\Facades\Route::is('preliminary-selected.index')) {?> active<?php } ?>">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">{{ __('sidemenu.register_user') }}</span>
                                    <span class="menu-arrow"></span>
                                </span>
                                <!--end:Menu link-->
                                <!--begin:Menu sub-->
                                <div class="menu-sub menu-sub-accordion <?php if (Illuminate\Support\Facades\Route::is('users.index') || Illuminate\Support\Facades\Route::is('users.show')|| Illuminate\Support\Facades\Route::is('preliminary-selected.index')) {?> here show<?php } ?>"
                                    kt-hidden-height="81" style="">
                                    <!--begin:Menu item-->

                                    <div class="menu-item ">
                                        <!--begin:Menu link-->
                                        <a class="menu-link sidebar-menu-link <?php if (Illuminate\Support\Facades\Route::is('users.index') || Illuminate\Support\Facades\Route::is('users.show')) {?> active<?php } ?>"
                                            href="{{ route('users.index') }}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">{{ __('sidemenu.user_heading') }}</span>
                                        </a>
                                        <!--end:Menu link-->
                                    </div>
                                    <!--end:Menu item-->
                                    <!--begin:Menu item-->

                                    <div class="menu-item ">
                                        <!--begin:Menu link-->
                                        <a class="menu-link sidebar-menu-link <?php if (Illuminate\Support\Facades\Route::is('preliminary-selected.index')) {?> active<?php } ?>"
                                            href="{{ route('preliminary-selected.index') }}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">{{ __('sidemenu.preliminary_selected') }}</span>
                                        </a>
                                        <!--end:Menu link-->
                                    </div>
                                    <!--end:Menu item-->
                                </div>
                                <!--end:Menu sub-->
                            </div>

                            <!--end:Menu item-->
                            <!--begin:Menu item-->

                            <div data-kt-menu-trigger="click"
                                class="menu-item menu-accordion  mb-1 <?php if (Illuminate\Support\Facades\Route::is('admins.index') || Illuminate\Support\Facades\Route::is('admins.show')) {?> here show<?php } ?>">
                                <!--begin:Menu link-->
                                <span
                                    class="menu-link sidebar-menu-link <?php if (Illuminate\Support\Facades\Route::is('admins.index') || Illuminate\Support\Facades\Route::is('admins.show')) {?> active<?php } ?>">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">{{ __('sidemenu.admin_user') }}
                                        {{ Session::get('userData') }}</span>
                                    <span class="menu-arrow"></span>
                                </span>
                                <!--end:Menu link-->
                                <!--begin:Menu sub-->
                                <div class="menu-sub menu-sub-accordion <?php if (Illuminate\Support\Facades\Route::is('admins.index') || Illuminate\Support\Facades\Route::is('admins.show')) {?> here show<?php } ?>"
                                    kt-hidden-height="81" style="">
                                    <!--begin:Menu item-->

                                    <div class="menu-item ">
                                        <!--begin:Menu link-->
                                        <a class="menu-link sidebar-menu-link <?php if (Illuminate\Support\Facades\Route::is('admins.index') || Illuminate\Support\Facades\Route::is('admins.show')) {?> active<?php } ?>"
                                            href="{{ route('admins.index') }}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">{{ __('sidemenu.user_heading') }}</span>
                                        </a>
                                        <!--end:Menu link-->
                                    </div>
                                    <!--end:Menu item-->
                                </div>
                                <!--end:Menu sub-->
                            </div>

                            <!--end:Menu item-->
                            <!--begin:Menu item-->

                            <div data-kt-menu-trigger="click"
                                class="menu-item menu-accordion <?php if (Illuminate\Support\Facades\Route::is('role.index')||Illuminate\Support\Facades\Route::is('permission.index')) {?> here show<?php } ?> ">
                                <!--begin:Menu link-->
                                <span
                                    class="menu-link sidebar-menu-link <?php if (Illuminate\Support\Facades\Route::is('role.index')||Illuminate\Support\Facades\Route::is('permission.index')) {?> active<?php } ?> ">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">{{ __('sidemenu.roles_permission') }}</span>
                                    <span class="menu-arrow"></span>
                                </span>
                                <!--end:Menu link-->
                                <!--begin:Menu sub-->
                                <div
                                    class="menu-sub menu-sub-accordion <?php if (Illuminate\Support\Facades\Route::is('role.index') ) {?>here show<?php } ?> ">
                                    <!--begin:Menu item-->

                                    <div class="menu-item">
                                        <!--begin:Menu link-->
                                        <a class="menu-link sidebar-menu-link <?php if (Illuminate\Support\Facades\Route::is('role.index')) {?>active<?php } ?>"
                                            href="{{ route('role.index') }}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">{{ __('sidemenu.role_list') }}</span>
                                        </a>
                                        <!--end:Menu link-->
                                    </div>

                                    <!--end:Menu item-->
                                </div>
                                <!--end:Menu sub-->
                                <!--begin:Menu sub-->
                                <div
                                    class="menu-sub menu-sub-accordion <?php if (Illuminate\Support\Facades\Route::is('permission.index') ) {?>here show<?php } ?>">
                                    <!--begin:Menu item-->

                                    <div class="menu-item">
                                        <!--begin:Menu link-->
                                        <a class="menu-link sidebar-menu-link <?php if (Illuminate\Support\Facades\Route::is('permission.index')) {?>active<?php } ?> "
                                            href="{{ route('permission.index') }}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">{{ __('sidemenu.permission_list') }}</span>
                                        </a>
                                        <!--end:Menu link-->
                                    </div>

                                    <!--end:Menu item-->
                                </div>
                                <!--end:Menu sub-->
                            </div>

                            <!--end:Menu item-->
                        </div>
                        <!--end:Menu sub-->

                    </div>
                    <div data-kt-menu-trigger="click"
                        class="menu-item here menu-accordion  <?php if (Illuminate\Support\Facades\Route::is('categories.index') || Illuminate\Support\Facades\Route::is('categories.show')|| Illuminate\Support\Facades\Route::is('subcategories.index') || Illuminate\Support\Facades\Route::is('divisions.index') || Illuminate\Support\Facades\Route::is('divisions.show') || Illuminate\Support\Facades\Route::is('districts.index') || Illuminate\Support\Facades\Route::is('districts.show')|| Illuminate\Support\Facades\Route::is('upazilas.index') || Illuminate\Support\Facades\Route::is('upazilas.show') || Illuminate\Support\Facades\Route::is('providers.index') || Illuminate\Support\Facades\Route::is('providers.show')) {?>here show<?php } ?>">
                        <!--begin:Menu link-->
                        <span class="menu-link sidebar-menu-link <?php if (Illuminate\Support\Facades\Route::is('categories.index') || Illuminate\Support\Facades\Route::is('categories.show')|| Illuminate\Support\Facades\Route::is('subcategories.index')|| Illuminate\Support\Facades\Route::is('divisions.index') || Illuminate\Support\Facades\Route::is('divisions.show')|| Illuminate\Support\Facades\Route::is('districts.index') || Illuminate\Support\Facades\Route::is('districts.show')|| Illuminate\Support\Facades\Route::is('upazilas.index') || Illuminate\Support\Facades\Route::is('upazilas.show') || Illuminate\Support\Facades\Route::is('providers.index') || Illuminate\Support\Facades\Route::is('providers.show')) {?>active<?php } ?>">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-setting-2 fs-2">
                                    <i class="path1"></i>
                                    <i class="path2"></i>
                                </i>
                            </span>
                            <span class="menu-title">{{ __('sidemenu.settings_management') }}</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <!--end:Menu link-->
                        <!--begin:Menu sub-->
                        <div class="menu-sub menu-sub-accordion" kt-hidden-height="124" style="">
                            <!--begin:Menu item-->
                            <div data-kt-menu-trigger="click"
                                class="menu-item menu-accordion <?php if (Illuminate\Support\Facades\Route::is('categories.index') || Illuminate\Support\Facades\Route::is('categories.show') ) {?>here show<?php } ?>  mb-1">
                                <!--begin:Menu link-->
                                <span
                                    class="menu-link sidebar-menu-link <?php if (Illuminate\Support\Facades\Route::is('categories.index') || Illuminate\Support\Facades\Route::is('categories.show')) {?>active<?php } ?>">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">{{ __('sidemenu.categories') }}</span>
                                    <span class="menu-arrow"></span>
                                </span>
                                <!--end:Menu link-->
                                <!--begin:Menu sub-->
                                <div class="menu-sub menu-sub-accordion <?php if (Illuminate\Support\Facades\Route::is('categories.index') || Illuminate\Support\Facades\Route::is('categories.show') ) {?>here show<?php } ?>"
                                    kt-hidden-height="81" style="">
                                    <!--begin:Menu item-->
                                    <div class="menu-item">
                                        <!--begin:Menu link-->
                                        <a class="menu-link sidebar-menu-link <?php if (Illuminate\Support\Facades\Route::is('categories.index') || Illuminate\Support\Facades\Route::is('categories.show')) {?>active<?php } ?>"
                                            href="{{ route('categories.index') }}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">{{ __('sidemenu.categorie_list') }}</span>
                                        </a>
                                        <!--end:Menu link-->
                                    </div>
                                    <!--end:Menu item-->
                                </div>
                                <!--end:Menu sub-->
                            </div>
                            <!--end:Menu item-->
                            <!--begin:Menu item-->
                            <div data-kt-menu-trigger="click"
                                class="menu-item menu-accordion <?php if (Illuminate\Support\Facades\Route::is('subcategories.index') || Illuminate\Support\Facades\Route::is('subcategories.show') ) {?>here show<?php } ?>  mb-1">
                                <!--begin:Menu link-->
                                <span
                                    class="menu-link sidebar-menu-link <?php if (Illuminate\Support\Facades\Route::is('subcategories.index') || Illuminate\Support\Facades\Route::is('subcategories.show')) {?>active<?php } ?>">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">{{ __('sidemenu.sub_categories') }}</span>
                                    <span class="menu-arrow"></span>
                                </span>
                                <!--end:Menu link-->
                                <!--begin:Menu sub-->
                                <div class="menu-sub menu-sub-accordion <?php if (Illuminate\Support\Facades\Route::is('subcategories.index') || Illuminate\Support\Facades\Route::is('subcategories.show') ) {?>here show<?php } ?>"
                                    kt-hidden-height="81" style="">
                                    <!--begin:Menu item-->
                                    <div class="menu-item">
                                        <!--begin:Menu link-->
                                        <a class="menu-link sidebar-menu-link <?php if (Illuminate\Support\Facades\Route::is('subcategories.index') || Illuminate\Support\Facades\Route::is('subcategories.show')) {?>active<?php } ?>"
                                            href="{{ route('subcategories.index') }}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">{{ __('sidemenu.sub_categories_list') }}</span>
                                        </a>
                                        <!--end:Menu link-->
                                    </div>
                                    <!--end:Menu item-->

                                </div>

                                <!--end:Menu sub-->
                            </div>
                            <!--end:Menu item-->
                            <!--begin:Menu item-->
                            <div data-kt-menu-trigger="click"
                                class="menu-item menu-accordion <?php if (Illuminate\Support\Facades\Route::is('divisions.index') || Illuminate\Support\Facades\Route::is('divisions.show') ) {?>here show<?php } ?>  mb-1">
                                <!--begin:Menu link-->
                                <span
                                    class="menu-link sidebar-menu-link <?php if (Illuminate\Support\Facades\Route::is('divisions.index') || Illuminate\Support\Facades\Route::is('divisions.show')) {?>active<?php } ?>">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">{{ __('sidemenu.divisions') }}</span>
                                    <span class="menu-arrow"></span>
                                </span>
                                <!--end:Menu link-->
                                <!--begin:Menu sub-->
                                <div class="menu-sub menu-sub-accordion <?php if (Illuminate\Support\Facades\Route::is('divisions.index') || Illuminate\Support\Facades\Route::is('divisions.show') ) {?>here show<?php } ?>"
                                    kt-hidden-height="81" style="">
                                    <!--begin:Menu item-->
                                    <div class="menu-item">
                                        <!--begin:Menu link-->
                                        <a class="menu-link sidebar-menu-link <?php if (Illuminate\Support\Facades\Route::is('divisions.index') || Illuminate\Support\Facades\Route::is('divisions.show')) {?>active<?php } ?>"
                                            href="{{ route('divisions.index') }}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">{{ __('sidemenu.division_list') }}</span>
                                        </a>
                                        <!--end:Menu link-->
                                    </div>
                                    <!--end:Menu item-->
                                </div>
                                <!--end:Menu sub-->
                            </div>
                            <!--end:Menu item-->
                            <!--begin:Menu item-->
                            <div
                                data-kt-menu-trigger="click"class="menu-item menu-accordion <?php if (Illuminate\Support\Facades\Route::is('districts.index') || Illuminate\Support\Facades\Route::is('districts.show') ) {?>here show<?php } ?>  mb-1">
                                <!--begin:Menu link-->
                                <span
                                    class="menu-link sidebar-menu-link <?php if (Illuminate\Support\Facades\Route::is('districts.index') || Illuminate\Support\Facades\Route::is('districts.show')) {?>active<?php } ?>">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">{{ __('sidemenu.districts') }}</span>
                                    <span class="menu-arrow"></span>
                                </span>
                                <!--end:Menu link-->
                                <!--begin:Menu sub-->
                                <div class="menu-sub menu-sub-accordion <?php if (Illuminate\Support\Facades\Route::is('districts.index') || Illuminate\Support\Facades\Route::is('districts.show') ) {?>here show<?php } ?>"
                                    kt-hidden-height="81" style="">
                                    <!--begin:Menu item-->
                                    <div class="menu-item">
                                        <!--begin:Menu link-->
                                        <a class="menu-link sidebar-menu-link <?php if (Illuminate\Support\Facades\Route::is('districts.index') || Illuminate\Support\Facades\Route::is('districts.show')) {?>active<?php } ?>"
                                            href="{{ route('districts.index') }}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">{{ __('sidemenu.district_list') }}</span>
                                        </a>
                                        <!--end:Menu link-->
                                    </div>
                                    <!--end:Menu item-->
                                </div>
                                <!--end:Menu sub-->
                            </div>
                            <!--end:Menu item-->
                            <!--begin:Menu item-->
                            <div data-kt-menu-trigger="click"
                                class="menu-item menu-accordion <?php if (Illuminate\Support\Facades\Route::is('upazilas.index') || Illuminate\Support\Facades\Route::is('upazilas.show') ) {?>here show<?php } ?>  mb-1">
                                <!--begin:Menu link-->
                                <span
                                    class="menu-link sidebar-menu-link <?php if (Illuminate\Support\Facades\Route::is('upazilas.index') || Illuminate\Support\Facades\Route::is('upazilas.show')) {?>active<?php } ?>">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">{{ __('sidemenu.upazilas') }}</span>
                                    <span class="menu-arrow"></span>
                                </span>
                                <!--end:Menu link-->
                                <!--begin:Menu sub-->
                                <div class="menu-sub menu-sub-accordion <?php if (Illuminate\Support\Facades\Route::is('upazilas.index') || Illuminate\Support\Facades\Route::is('upazilas.show') ) {?>here show<?php } ?>"
                                    kt-hidden-height="81" style="">
                                    <!--begin:Menu item-->
                                    <div class="menu-item">
                                        <!--begin:Menu link-->
                                        <a class="menu-link sidebar-menu-link <?php if (Illuminate\Support\Facades\Route::is('upazilas.index') || Illuminate\Support\Facades\Route::is('upazilas.show')) {?>active<?php } ?>"
                                            href="{{ route('upazilas.index') }}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">{{ __('sidemenu.upazila_list') }}</span>
                                        </a>
                                        <!--end:Menu link-->
                                    </div>
                                    <!--end:Menu item-->
                                </div>
                                <!--end:Menu sub-->
                            </div>
                            <!--end:Menu item-->
                            <!--begin:Menu item-->
                            <div data-kt-menu-trigger="click"
                                class="menu-item menu-accordion <?php if (Illuminate\Support\Facades\Route::is('providers.index') || Illuminate\Support\Facades\Route::is('providers.show') ) {?>here show<?php } ?>  mb-1">
                                <!--begin:Menu link-->
                                <span
                                    class="menu-link sidebar-menu-link <?php if (Illuminate\Support\Facades\Route::is('providers.index') || Illuminate\Support\Facades\Route::is('providers.show')) {?>active<?php } ?>">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">{{ __('sidemenu.providers') }}</span>
                                    <span class="menu-arrow"></span>
                                </span>
                                <!--end:Menu link-->
                                <!--begin:Menu sub-->
                                <div class="menu-sub menu-sub-accordion <?php if (Illuminate\Support\Facades\Route::is('providers.index') || Illuminate\Support\Facades\Route::is('providers.show') ) {?>here show<?php } ?>"
                                    kt-hidden-height="81" style="">
                                    <!--begin:Menu item-->
                                    <div class="menu-item">
                                        <!--begin:Menu link-->
                                        <a class="menu-link sidebar-menu-link <?php if (Illuminate\Support\Facades\Route::is('providers.index') || Illuminate\Support\Facades\Route::is('providers.show')) {?>active<?php } ?>"
                                            href="{{ route('providers.index') }}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">{{ __('sidemenu.providers_list') }}</span>
                                        </a>
                                        <!--end:Menu link-->
                                    </div>
                                    <!--end:Menu item-->
                                </div>
                                <!--end:Menu sub-->
                            </div>
                            <!--end:Menu item-->

                            <!--begin:Menu item-->
                            <div data-kt-menu-trigger="click"
                                class="menu-item menu-accordion <?php if (Illuminate\Support\Facades\Route::is('providers.index') || Illuminate\Support\Facades\Route::is('providers.show') ) {?>here show<?php } ?>  mb-1">
                                <!--begin:Menu link-->
                                <span
                                    class="menu-link sidebar-menu-link <?php if (Illuminate\Support\Facades\Route::is('providers.index') || Illuminate\Support\Facades\Route::is('providers.show')) {?>active<?php } ?>">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Batches</span>
                                    <span class="menu-arrow"></span>
                                </span>
                                <!--end:Menu link-->
                                <!--begin:Menu sub-->
                                <div class="menu-sub menu-sub-accordion <?php if (Illuminate\Support\Facades\Route::is('batches.index') || Illuminate\Support\Facades\Route::is('batches.show') ) {?>here show<?php } ?>"
                                    kt-hidden-height="81" style="">
                                    <!--begin:Menu item-->
                                    <div class="menu-item">
                                        <!--begin:Menu link-->
                                        <a class="menu-link sidebar-menu-link <?php if (Illuminate\Support\Facades\Route::is('batches.index') || Illuminate\Support\Facades\Route::is('batches.show')) {?>active<?php } ?>"
                                            href="">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>


                                            </span>
                                            <span class="menu-title">Batches List</span>
                                        </a>
                                        <!--end:Menu link-->
                                    </div>
                                    <!--end:Menu item-->
                                </div>
                                <!--end:Menu sub-->
                            </div>
                            <!--end:Menu item-->
                        </div>
                        <!--end:Menu sub-->

                    </div>

                    <div data-kt-menu-trigger="click"
                        class="menu-item here menu-accordion  <?php if (Illuminate\Support\Facades\Route::is('traineeEnroll.index')||Illuminate\Support\Facades\Route::is('trainerEnroll.index')||Illuminate\Support\Facades\Route::is('trainerEnroll.index')) {?>here show<?php } ?>">
                        <!--begin:Menu link-->
                        <span class="menu-link sidebar-menu-link <?php if (Illuminate\Support\Facades\Route::is('traineeEnroll.index')||Illuminate\Support\Facades\Route::is('trainerEnroll.index')) {?>active<?php } ?>">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-user-tick fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                </i>
                            </span>

                            <span class="menu-title">{{ __('sidemenu.enrollment_management') }}</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <!--end:Menu link-->
                        <!--begin:Menu sub-->
                        <div class="menu-sub menu-sub-accordion" kt-hidden-height="124" style="">
                            <!--begin:Menu item-->
                            <div data-kt-menu-trigger="click"
                                class="menu-item menu-accordion <?php if (Illuminate\Support\Facades\Route::is('traineeEnroll.index')||Illuminate\Support\Facades\Route::is('trainerEnroll.index')) {?>here show<?php } ?>  mb-1">
                                <!--begin:Menu link-->
                                <span
                                    class="menu-link sidebar-menu-link <?php if (Illuminate\Support\Facades\Route::is('traineeEnroll.index')||Illuminate\Support\Facades\Route::is('trainerEnroll.index')) {?>active<?php } ?>">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">{{ __('sidemenu.trainee_enrollment') }}</span>
                                    <span class="menu-arrow"></span>
                                </span>
                                <!--end:Menu link-->
                                <!--begin:Menu sub-->
                                <div class="menu-sub menu-sub-accordion <?php if (Illuminate\Support\Facades\Route::is('traineeEnroll.index') ) {?>here show<?php } ?>"
                                    kt-hidden-height="81" style="">
                                    <!--begin:Menu item-->
                                    <div class="menu-item">
                                        <!--begin:Menu link-->
                                        <a class="menu-link sidebar-menu-link <?php if (Illuminate\Support\Facades\Route::is('traineeEnroll.index')) {?>active<?php } ?>"
                                            href="{{ route('traineeEnroll.index') }}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>


                                            </span>
                                            <span
                                                class="menu-title">{{ __('sidemenu.trainee_enrollment_list') }}</span>
                                        </a>
                                        <!--end:Menu link-->
                                    </div>
                                    <!--end:Menu item-->
                                </div>
                                <!--end:Menu sub-->
                                <!--begin:Menu sub-->
                                <div class="menu-sub menu-sub-accordion <?php if (Illuminate\Support\Facades\Route::is('trainerEnroll.index') ) {?>here show<?php } ?>"
                                    kt-hidden-height="81" style="">
                                    <!--begin:Menu item-->
                                    <div class="menu-item">
                                        <!--begin:Menu link-->
                                        <a class="menu-link sidebar-menu-link <?php if (Illuminate\Support\Facades\Route::is('trainerEnroll.index')) {?>active<?php } ?>"
                                            href="{{ route('trainerEnroll.index') }}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>


                                            </span>
                                            <span
                                                class="menu-title">{{ __('sidemenu.trainer_enrollment_list') }}</span>
                                        </a>
                                        <!--end:Menu link-->
                                    </div>
                                    <!--end:Menu item-->
                                </div>
                                <!--end:Menu sub-->
                            </div>
                            <!--end:Menu item-->
                        </div>
                        <!--end:Menu sub-->

                    </div>
                    <div data-kt-menu-trigger="click"
                        class="menu-item here menu-accordion  <?php if (Illuminate\Support\Facades\Route::is('batches.index')) {?>here show<?php } ?>">
                        <!--begin:Menu link-->
                        <span class="menu-link sidebar-menu-link <?php if (Illuminate\Support\Facades\Route::is('batches.index')) {?>active<?php } ?>">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-add-notepad fs-2 ">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                </i>
                            </span>

                            <span class="menu-title">{{ __('sidemenu.schedule_management') }}</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <!--end:Menu link-->
                        <!--begin:Menu sub-->
                        <div class="menu-sub menu-sub-accordion" kt-hidden-height="124" style="">
                            <!--begin:Menu item-->
                            <div data-kt-menu-trigger="click"
                                class="menu-item menu-accordion <?php if (Illuminate\Support\Facades\Route::is('batches.index')) {?>here show<?php } ?>  mb-1">
                                <!--begin:Menu link-->
                                <span
                                    class="menu-link sidebar-menu-link <?php if (Illuminate\Support\Facades\Route::is('batches.index')) {?>active<?php } ?>">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">{{ __('sidemenu.batch_schedule') }}</span>
                                    <span class="menu-arrow"></span>
                                </span>
                                <!--end:Menu link-->
                                <!--begin:Menu sub-->
                                <div class="menu-sub menu-sub-accordion <?php if (Illuminate\Support\Facades\Route::is('batches.index') ) {?>here show<?php } ?>"
                                    kt-hidden-height="81" style="">
                                    <!--begin:Menu item-->
                                    <div class="menu-item">
                                        <!--begin:Menu link-->
                                        <a class="menu-link sidebar-menu-link <?php if (Illuminate\Support\Facades\Route::is('batches.index')) {?>active<?php } ?>"
                                            href="{{ route('batches.index') }}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">{{ __('sidemenu.create_batch_schedul') }}</span>
                                        </a>
                                        <!--end:Menu link-->
                                    </div>
                                    <!--end:Menu item-->

                                </div>
                                <!--end:Menu sub-->
                            </div>
                            <!--end:Menu item-->
                        </div>
                        <!--end:Menu sub-->

                    </div>
                @endif
            </div>
            <!--end::Menu-->

        </div>
        <!--end::Menu wrapper-->
    </div>
    <!--end::sidebar menu-->
    <!--begin::Footer-->
    <!--end::Footer-->
</div>
<!--end::Sidebar-->
