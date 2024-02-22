<!--begin::Sidebar-->

<div style="font-size:14px;" id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true"
    data-kt-drawer-name="app-sidebar" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true"
    data-kt-drawer-width="225px" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
    <!--begin::Logo-->
    <div class="app-sidebar-logo px-6" id="kt_app_sidebar_logo">
        <!--begin::Logo image-->
        <a href="{{ url('/') }}">
            <img alt="Logo" src="{{ asset('img/logo.svg') }}" class="h-45px app-sidebar-logo-default" />
            <img alt="Logo" src="{{ asset('img/logo-icon.svg') }}" class="h-30px app-sidebar-logo-minimize" />
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


                <!--begin:Menu item-->
                <div data-kt-menu-trigger="click"
                    class="menu-item menu-accordion <?php if ( Illuminate\Support\Facades\Route::is('admins.profile')|| Illuminate\Support\Facades\Route::is('admins.dashboard') || Illuminate\Support\Facades\Route::is('profile.index') || Illuminate\Support\Facades\Route::is('dashboard')) {?>here show <?php } ?>">

                    <!--begin:Menu link-->
                    @isset($userRole)
                        @empty(!$userRole)
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
                                        <a class="menu-link show-loader  sidebar-menu-link <?php if (Illuminate\Support\Facades\Route::is('dashboard')) {?>active<?php } ?>"
                                            href="{{ route('dashboard') }}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title ">{{ __('sidemenu.dashboard') }}</span>
                                        </a>
                                        <!--end:Menu link-->
                                        <!--begin:Menu link-->
                                        <a class="menu-link show-loader  sidebar-menu-link <?php if (Illuminate\Support\Facades\Route::is('profile.index')) {?>active<?php } ?>"
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
                                @isset($roleRoutePermissions)
                                    @empty(!$roleRoutePermissions)
                                        <!--start:Menu link-->
                                        <a href="{{ route('admins.dashboard') }}">
                                            <span
                                                class="menu-link sidebar-menu-link dashboard-item <?php if (Illuminate\Support\Facades\Route::is('admins.dashboard') || Illuminate\Support\Facades\Route::is('dashboard_details.running_batches')||Illuminate\Support\Facades\Route::is('dashboard_details.complete_batches')||Illuminate\Support\Facades\Route::is('dashboard_details.districts')||Illuminate\Support\Facades\Route::is('dashboard_details.upazilas')||Illuminate\Support\Facades\Route::is('dashboard_details.partners')||Illuminate\Support\Facades\Route::is('dashboard_details.ongoing_classes')||Illuminate\Support\Facades\Route::is('dashboard_details.complete_classes')||Illuminate\Support\Facades\Route::is('dashboard_details.trainers')) {?>active<?php } ?>">
                                                <span class="menu-icon">
                                                    <i class="ki-duotone ki-element-7 fs-2">
                                                        <i class="path1"></i>
                                                        <i class="path2"></i>
                                                    </i>
                                                </span>
                                                <span class="menu-title">{{ __('sidemenu.dashboard') }}</span>
                                            </span>
                                        </a>
                                        <!--end:Menu link-->
                                    @endempty
                                @endisset
                            @endif
                        @endempty
                    @endisset
                </div>
                <!--end:Menu item-->
                {{--
                <!--begin:Menu item-->
                <div class="menu-item pt-5">
                    <!--begin:Menu content-->
                    <div class="menu-content">
                        <span class="menu-heading fw-bold text-uppercase fs-7">{{ __('sidemenu.pages') }}</span>
                    </div>
                    <!--end:Menu content-->

                </div>
                <!--end:Menu item--> --}}

                @isset($userRole)
                    @empty(!$userRole)
                        @if ($userRole == 'Trainee' || $userRole == 'trainee')
                        @else
                            @isset($roleRoutePermissions)
                                @empty(!$roleRoutePermissions)
                                    @if (
                                        $userRole == 'SuperAdmin' || $userRole == 'superadmin' or
                                            $userRole == 'Admin' || $userRole == 'admin' or
                                            $userRole == 'DPD' ||
                                                $userRole == 'dpd' ||
                                                $userRole == 'provider' ||
                                                $userRole == 'Provider' ||
                                                $userRole == 'Consultant' ||
                                                $userRole == 'consultant')
                                        <div data-kt-menu-trigger="click"
                                            class="menu-item here menu-accordion <?php if (Illuminate\Support\Facades\Route::is('users.index') || Illuminate\Support\Facades\Route::is('users.show')||Illuminate\Support\Facades\Route::is('admins.index') || Illuminate\Support\Facades\Route::is('admins.show') ||Illuminate\Support\Facades\Route::is('preliminary-selected.index')||Illuminate\Support\Facades\Route::is('role.index')||Illuminate\Support\Facades\Route::is('role.edit')|| Illuminate\Support\Facades\Route::is('permission.index')||Illuminate\Support\Facades\Route::is('role.edit')||Illuminate\Support\Facades\Route::is('roles.index')) {?> here show<?php } ?> ">
                                            <!--begin:Menu link-->

                                            <span
                                                class="menu-link sidebar-menu-link <?php if (Illuminate\Support\Facades\Route::is('users.index')|| Illuminate\Support\Facades\Route::is('users.show')|| Illuminate\Support\Facades\Route::is('admins.index') || Illuminate\Support\Facades\Route::is('admins.show')||Illuminate\Support\Facades\Route::is('preliminary-selected.index')||Illuminate\Support\Facades\Route::is('role.index')||Illuminate\Support\Facades\Route::is('role.edit')|| Illuminate\Support\Facades\Route::is('permission.index')||Illuminate\Support\Facades\Route::is('role.edit')||Illuminate\Support\Facades\Route::is('roles.index')) {?> active<?php } ?>   ">
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

                                                @if (in_array('admins.index', $roleRoutePermissions))
                                                    <!--begin:Menu sub-->
                                                    <div class="menu-sub menu-sub-accordion <?php if (Illuminate\Support\Facades\Route::is('admins.index') || Illuminate\Support\Facades\Route::is('admins.show')|| Illuminate\Support\Facades\Route::is('role.index') || Illuminate\Support\Facades\Route::is('role.edit')|| Illuminate\Support\Facades\Route::is('permission.index')||Illuminate\Support\Facades\Route::is('roles.index')) {?> here show<?php } ?>"
                                                        kt-hidden-height="81" style="">
                                                        <!--begin:Menu item-->
                                                        @if (in_array('admins.index', $roleRoutePermissions))
                                                            <div class="menu-item ">
                                                                <!--begin:Menu link-->
                                                                <a class="menu-link show-loader  sidebar-menu-link <?php if (Illuminate\Support\Facades\Route::is('admins.index') || Illuminate\Support\Facades\Route::is('admins.show')) {?> active<?php } ?>"
                                                                    href="{{ route('admins.index') }}">
                                                                    <span class="menu-bullet">
                                                                        <span class="bullet bullet-dot"></span>
                                                                    </span>
                                                                    <span class="menu-title">{{ __('sidemenu.admin_user') }}</span>
                                                                </a>
                                                                <!--end:Menu link-->
                                                            </div>
                                                            <!--end:Menu item-->
                                                        @endif
                                                        <!--begin:Menu item-->
                                                        @if (in_array('role.index', $roleRoutePermissions))
                                                            <div class="menu-item">
                                                                <!--begin:Menu link-->
                                                                <a class="menu-link show-loader  sidebar-menu-link <?php if (Illuminate\Support\Facades\Route::is('roles.index')||Illuminate\Support\Facades\Route::is('roles.edit')) {?>active<?php } ?>"
                                                                    href="{{ route('roles.index') }}">
                                                                    <span class="menu-bullet">
                                                                        <span class="bullet bullet-dot"></span>
                                                                    </span>
                                                                    <span class="menu-title">{{ __('sidemenu.roles') }}</span>
                                                                </a>
                                                                <!--end:Menu link-->
                                                            </div>
                                                        @endif
                                                        <!--end:Menu item-->
                                                        <!--begin:Menu item-->
                                                        @if (in_array('role.index', $roleRoutePermissions))
                                                            <div class="menu-item">
                                                                <!--begin:Menu link-->
                                                                <a class="menu-link show-loader  sidebar-menu-link <?php if (Illuminate\Support\Facades\Route::is('role.index')||Illuminate\Support\Facades\Route::is('role.edit')) {?>active<?php } ?>"
                                                                    href="{{ route('role.index') }}">
                                                                    <span class="menu-bullet">
                                                                        <span class="bullet bullet-dot"></span>
                                                                    </span>
                                                                    <span class="menu-title">{{ __('sidemenu.role_list') }}</span>
                                                                </a>
                                                                <!--end:Menu link-->
                                                            </div>
                                                        @endif
                                                        <!--end:Menu item-->
                                                        <!--begin:Menu item-->
                                                        @if (in_array('permission.index', $roleRoutePermissions))
                                                            <div class="menu-item">
                                                                <!--begin:Menu link-->
                                                                <a class="menu-link show-loader  sidebar-menu-link <?php if (Illuminate\Support\Facades\Route::is('permission.index')) {?>active<?php } ?> "
                                                                    href="{{ route('permission.index') }}">
                                                                    <span class="menu-bullet">
                                                                        <span class="bullet bullet-dot"></span>
                                                                    </span>
                                                                    <span
                                                                        class="menu-title">{{ __('sidemenu.permission_list') }}</span>
                                                                </a>
                                                                <!--end:Menu link-->
                                                            </div>
                                                        @endif
                                                        <!--end:Menu item-->
                                                    </div>
                                                    <!--end:Menu sub-->
                                                @endif
                                                <!--end:Menu item-->
                                            </div>
                                            <!--end:Menu sub-->

                                        </div>
                                    @endif
                                    @if (in_array('categories.index', $roleRoutePermissions))
                                        <div data-kt-menu-trigger="click"
                                            class="menu-item here menu-accordion  <?php if ( Illuminate\Support\Facades\Route::is('divisions.index') || Illuminate\Support\Facades\Route::is('divisions.show') || Illuminate\Support\Facades\Route::is('districts.index') || Illuminate\Support\Facades\Route::is('districts.show')|| Illuminate\Support\Facades\Route::is('upazilas.index') || Illuminate\Support\Facades\Route::is('upazilas.show') || Illuminate\Support\Facades\Route::is('providers.index') || Illuminate\Support\Facades\Route::is('providers.show')|| Illuminate\Support\Facades\Route::is('provider.link-batch')) {?>here show<?php } ?>">
                                            <!--begin:Menu link-->
                                            <span class="menu-link sidebar-menu-link <?php if (Illuminate\Support\Facades\Route::is('divisions.index') || Illuminate\Support\Facades\Route::is('divisions.show')|| Illuminate\Support\Facades\Route::is('districts.index') || Illuminate\Support\Facades\Route::is('districts.show')|| Illuminate\Support\Facades\Route::is('upazilas.index') || Illuminate\Support\Facades\Route::is('upazilas.show') || Illuminate\Support\Facades\Route::is('providers.index') || Illuminate\Support\Facades\Route::is('providers.show')|| Illuminate\Support\Facades\Route::is('provider.link-batch')) {?>active<?php } ?>">
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
                                                <div class="menu-item">
                                                    <!--begin:Menu link-->
                                                    <a class="menu-link show-loader  sidebar-menu-link <?php if (Illuminate\Support\Facades\Route::is('divisions.index') || Illuminate\Support\Facades\Route::is('divisions.show')) {?>active<?php } ?>"
                                                        href="{{ route('divisions.index') }}">
                                                        <span class="menu-bullet">
                                                            <span class="bullet bullet-dot"></span>
                                                        </span>
                                                        <span class="menu-title">{{ __('sidemenu.division_list') }}</span>
                                                    </a>
                                                    <!--end:Menu link-->
                                                </div>
                                                <!--end:Menu item-->

                                                <!--begin:Menu item-->
                                                <div class="menu-item">
                                                    <!--begin:Menu link-->
                                                    <a class="menu-link show-loader  sidebar-menu-link <?php if (Illuminate\Support\Facades\Route::is('districts.index') || Illuminate\Support\Facades\Route::is('districts.show')) {?>active<?php } ?>"
                                                        href="{{ route('districts.index') }}">
                                                        <span class="menu-bullet">
                                                            <span class="bullet bullet-dot"></span>
                                                        </span>
                                                        <span class="menu-title">{{ __('sidemenu.district_list') }}</span>
                                                    </a>
                                                    <!--end:Menu link-->
                                                </div>
                                                <!--end:Menu item-->
                                                <!--begin:Menu item-->
                                                <div class="menu-item">
                                                    <!--begin:Menu link-->
                                                    <a class="menu-link show-loader  sidebar-menu-link <?php if (Illuminate\Support\Facades\Route::is('upazilas.index') || Illuminate\Support\Facades\Route::is('upazilas.show')) {?>active<?php } ?>"
                                                        href="{{ route('upazilas.index') }}">
                                                        <span class="menu-bullet">
                                                            <span class="bullet bullet-dot"></span>
                                                        </span>
                                                        <span class="menu-title">{{ __('sidemenu.upazila_list') }}</span>
                                                    </a>
                                                    <!--end:Menu link-->
                                                </div>
                                                <!--end:Menu item-->
                                                <!--begin:Menu item-->
                                                <div class="menu-item">
                                                    <!--begin:Menu link-->
                                                    <a class="menu-link show-loader  sidebar-menu-link <?php if (Illuminate\Support\Facades\Route::is('providers.index') || Illuminate\Support\Facades\Route::is('providers.show')|| Illuminate\Support\Facades\Route::is('provider.link-batch')) {?>active<?php } ?>"
                                                        href="{{ route('providers.index') }}">
                                                        <span class="menu-bullet">
                                                            <span class="bullet bullet-dot"></span>
                                                        </span>
                                                        <span class="menu-title">{{ __('sidemenu.vendor') }}</span>
                                                    </a>
                                                    <!--end:Menu link-->
                                                </div>
                                                <!--end:Menu item-->
                                            </div>
                                            <!--end:Menu sub-->
                                        </div>
                                    @endif

                                    @if (in_array('traineeEnroll.index', $roleRoutePermissions))
                                        <div data-kt-menu-trigger="click"
                                            class="menu-item here menu-accordion  <?php if (Illuminate\Support\Facades\Route::is('traineeEnroll.index')||Illuminate\Support\Facades\Route::is('trainerEnroll.index')||Illuminate\Support\Facades\Route::is('trainerEnroll.index')||Illuminate\Support\Facades\Route::is('batches.index')) {?>here show<?php } ?>">
                                            <!--begin:Menu link-->
                                            <span class="menu-link sidebar-menu-link <?php if (Illuminate\Support\Facades\Route::is('traineeEnroll.index')||Illuminate\Support\Facades\Route::is('trainerEnroll.index')||Illuminate\Support\Facades\Route::is('batches.index')) {?>active<?php } ?>">
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

                                                @if ($userRole == 'provider' || $userRole == 'Provider')
                                                    <!--begin:Menu item-->
                                                    <div class="menu-item">
                                                        <!--begin:Menu link-->
                                                        <a class="menu-link show-loader  sidebar-menu-link <?php if (Illuminate\Support\Facades\Route::is('batches.index')) {?>active<?php } ?>"
                                                            href="{{ route('batches.index') }}">
                                                            <span class="menu-bullet">
                                                                <span class="bullet bullet-dot"></span>


                                                            </span>
                                                            <span class="menu-title">{{ __('sidemenu.trainer_enrollment') }}</span>
                                                        </a>
                                                        <!--end:Menu link-->
                                                    </div>
                                                    <!--end:Menu item-->
                                                @endif
                                                <!--begin:Menu item-->
                                                <div class="menu-item">
                                                    <!--begin:Menu link-->
                                                    <a class="menu-link show-loader  sidebar-menu-link <?php if (Illuminate\Support\Facades\Route::is('traineeEnroll.index')) {?>active<?php } ?>"
                                                        href="{{ route('traineeEnroll.index') }}">
                                                        <span class="menu-bullet">
                                                            <span class="bullet bullet-dot"></span>


                                                        </span>
                                                        <span class="menu-title">{{ __('sidemenu.trainee_enrollment_list') }}</span>
                                                    </a>
                                                    <!--end:Menu link-->
                                                </div>
                                                <!--end:Menu item-->

                                                <!--begin:Menu item-->
                                                <div class="menu-item">
                                                    <!--begin:Menu link-->
                                                    <a class="menu-link show-loader  sidebar-menu-link <?php if (Illuminate\Support\Facades\Route::is('trainerEnroll.index')) {?>active<?php } ?>"
                                                        href="{{ route('trainerEnroll.index') }}">
                                                        <span class="menu-bullet">
                                                            <span class="bullet bullet-dot"></span>


                                                        </span>
                                                        <span class="menu-title">{{ __('sidemenu.trainer_enrollment_list') }}</span>
                                                    </a>
                                                    <!--end:Menu link-->
                                                </div>
                                                <!--end:Menu item-->
                                            </div>
                                            <!--end:Menu sub-->
                                        </div>
                                    @endif
                                    @if ($userRole == 'trainer' || $userRole == 'Trainer' or $userRole == 'provider' || $userRole == 'Provider')
                                        @if (in_array('batches.index', $roleRoutePermissions) ||
                                                in_array('attendance.batch-list', $roleRoutePermissions) ||
                                                in_array('attendance.batch-list', $roleRoutePermissions))
                                            <div data-kt-menu-trigger="click"
                                                class="menu-item here menu-accordion  <?php if (Illuminate\Support\Facades\Route::is('attendance.batch-list')||Illuminate\Support\Facades\Route::is('batch-schedule.batches')||Illuminate\Support\Facades\Route::is('batch-schedule.index')||Illuminate\Support\Facades\Route::is('batch-schedule.create')||Illuminate\Support\Facades\Route::is('attendance.form')) {?>here show<?php } ?>">
                                                <!--begin:Menu link-->
                                                <span
                                                    class="menu-link sidebar-menu-link <?php if (Illuminate\Support\Facades\Route::is('attendance.batch-list')||Illuminate\Support\Facades\Route::is('batch-schedule.batches')||Illuminate\Support\Facades\Route::is('batch-schedule.index')||Illuminate\Support\Facades\Route::is('batch-schedule.create')||Illuminate\Support\Facades\Route::is('attendance.form')) {?>active<?php } ?>">
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
                                                    @if ($userRole == 'trainer' || $userRole == 'Trainer')
                                                        <!--begin:Menu sub-->
                                                        <div class="menu-sub menu-sub-accordion <?php if (Illuminate\Support\Facades\Route::is('attendance.batch-list')||Illuminate\Support\Facades\Route::is('batch-schedule.batches')||Illuminate\Support\Facades\Route::is('batch-schedule.index')||Illuminate\Support\Facades\Route::is('batch-schedule.create')||Illuminate\Support\Facades\Route::is('attendance.form') ) {?>here show<?php } ?>"
                                                            kt-hidden-height="81" style="">
                                                            <!--begin:Menu item-->
                                                            <div class="menu-item">
                                                                <!--begin:Menu link-->
                                                                <a class="menu-link show-loader  sidebar-menu-link <?php if (Illuminate\Support\Facades\Route::is('attendance.batch-list')||Illuminate\Support\Facades\Route::is('attendance.form')||Illuminate\Support\Facades\Route::is('batch-schedule.index')) {?>active<?php } ?>"
                                                                    href="{{ route('attendance.batch-list') }}">
                                                                    <span class="menu-bullet">
                                                                        <span class="bullet bullet-dot"></span>
                                                                    </span>
                                                                    <span
                                                                        class="menu-title">{{ __('sidemenu.trainer_batch_list') }}</span>
                                                                </a>
                                                                <!--end:Menu link-->
                                                            </div>
                                                            <!--end:Menu item-->

                                                        </div>
                                                        <!--end:Menu sub-->
                                                    @endif
                                                    <!--begin:Menu sub-->

                                                    @if ($userRole == 'provider' || $userRole == 'Provider')
                                                        <div class="menu-sub menu-sub-accordion <?php if (Illuminate\Support\Facades\Route::is('batch-schedule.batches')||Illuminate\Support\Facades\Route::is('attendance.batch-list')||Illuminate\Support\Facades\Route::is('batch-schedule.index')||Illuminate\Support\Facades\Route::is('batch-schedule.create')||Illuminate\Support\Facades\Route::is('attendance.form') ) {?>here show<?php } ?>"
                                                            kt-hidden-height="81" style="">
                                                            <!--begin:Menu item-->
                                                            <div class="menu-item">
                                                                <!--begin:Menu link-->
                                                                <a class="menu-link show-loader  sidebar-menu-link <?php if (Illuminate\Support\Facades\Route::is('batch-schedule.batches')||Illuminate\Support\Facades\Route::is('batch-schedule.index')||Illuminate\Support\Facades\Route::is('batch-schedule.create')||Illuminate\Support\Facades\Route::is('attendance.form')) {?>active<?php } ?>"
                                                                    href="{{ route('batch-schedule.batches') }}">
                                                                    <span class="menu-bullet">
                                                                        <span class="bullet bullet-dot"></span>
                                                                    </span>
                                                                    <span
                                                                        class="menu-title">{{ __('sidemenu.provider_batch_list') }}</span>
                                                                </a>
                                                                <!--end:Menu link-->
                                                            </div>
                                                            <!--end:Menu item-->

                                                        </div>
                                                        <!--end:Menu sub-->
                                                    @endif
                                                </div>
                                                <!--end:Menu sub-->

                                            </div>
                                        @endif
                                    @endif
                                    @if (
                                        $userRole == 'SuperAdmin' ||
                                            $userRole == 'superadmin' ||
                                            $userRole == 'Admin' ||
                                            $userRole == 'admin' ||
                                            $userRole == 'DPD' ||
                                            $userRole == 'dpd' ||
                                            $userRole == 'DG' ||
                                            $userRole == 'dg')
                                        <div data-kt-menu-trigger="click"
                                            class="menu-item here menu-accordion  <?php if (Illuminate\Support\Facades\Route::is('dashboard_details.total_batches')||Illuminate\Support\Facades\Route::is('batch-schedule.office')||Illuminate\Support\Facades\Route::is('attendance.schedule')) {?>here show<?php } ?>">
                                            <!--begin:Menu link-->
                                            <span class="menu-link sidebar-menu-link <?php if (Illuminate\Support\Facades\Route::is('dashboard_details.total_batches')||Illuminate\Support\Facades\Route::is('batch-schedule.office')||Illuminate\Support\Facades\Route::is('attendance.schedule')) {?>active<?php } ?>">
                                                <span class="menu-icon">
                                                    <i class="ki-duotone ki-note-2 fs-2">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                        <span class="path3"></span>
                                                        <span class="path4"></span>
                                                    </i>
                                                </span>

                                                <span class="menu-title">{{ __('sidemenu.batch_monitoring') }}</span>
                                                <span class="menu-arrow"></span>
                                            </span>
                                            <!--end:Menu link-->
                                            <!--begin:Menu sub-->
                                            <div class="menu-sub menu-sub-accordion" kt-hidden-height="124" style="">
                                                <!--begin:Menu sub-->
                                                <div class="menu-sub menu-sub-accordion <?php if (Illuminate\Support\Facades\Route::is('dashboard_details.total_batches')||Illuminate\Support\Facades\Route::is('batch-schedule.office')||Illuminate\Support\Facades\Route::is('attendance.schedule') ) {?>here show<?php } ?>"
                                                    kt-hidden-height="81" style="">
                                                    <!--begin:Menu item-->
                                                    <div class="menu-item">
                                                        <!--begin:Menu link-->
                                                        <a class="menu-link show-loader  sidebar-menu-link <?php if (Illuminate\Support\Facades\Route::is('dashboard_details.total_batches')||Illuminate\Support\Facades\Route::is('batch-schedule.office')||Illuminate\Support\Facades\Route::is('attendance.schedule')) {?>active<?php } ?>"
                                                            href="{{ route('dashboard_details.total_batches') }}">
                                                            <span class="menu-bullet">
                                                                <span class="bullet bullet-dot"></span>


                                                            </span>
                                                            <span class="menu-title">{{ __('sidemenu.all_batch_list') }}</span>
                                                        </a>
                                                        <!--end:Menu link-->
                                                    </div>
                                                    <!--end:Menu item-->
                                                </div>
                                                <!--end:Menu sub-->
                                            </div>
                                            <!--end:Menu sub-->

                                        </div>
                                        <div data-kt-menu-trigger="click"
                                            class="menu-item here menu-accordion  <?php if (Illuminate\Support\Facades\Route::is('batch-schedule.runningBatches')) {?>here show<?php } ?>">
                                            <!--begin:Menu link-->
                                            <span class="menu-link sidebar-menu-link <?php if (Illuminate\Support\Facades\Route::is('batch-schedule.runningBatches')) {?>active<?php } ?>">
                                                <span class="menu-icon">
                                                    <i class="ki-duotone ki-update-folder fs-2 ">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                    </i>
                                                </span>

                                                <span class="menu-title">{{ __('sidemenu.running_batch') }}</span>
                                                <span class="menu-arrow"></span>
                                            </span>
                                            <!--end:Menu link-->
                                            <!--begin:Menu sub-->
                                            <div class="menu-sub menu-sub-accordion" kt-hidden-height="124" style="">
                                                <!--begin:Menu sub-->
                                                <div class="menu-sub menu-sub-accordion <?php if (Illuminate\Support\Facades\Route::is('batch-schedule.runningBatches') ) {?>here show<?php } ?>"
                                                    kt-hidden-height="81" style="">
                                                    <!--begin:Menu item-->
                                                    <div class="menu-item">
                                                        <!--begin:Menu link-->
                                                        <a class="menu-link show-loader  sidebar-menu-link <?php if (Illuminate\Support\Facades\Route::is('batch-schedule.runningBatches')) {?>active<?php } ?>"
                                                            href="{{ route('batch-schedule.runningBatches') }}">
                                                            <span class="menu-bullet">
                                                                <span class="bullet bullet-dot"></span>


                                                            </span>
                                                            <span class="menu-title">{{ __('sidemenu.running_batch_list') }}</span>
                                                        </a>
                                                        <!--end:Menu link-->
                                                    </div>
                                                    <!--end:Menu item-->
                                                </div>
                                                <!--end:Menu sub-->
                                            </div>
                                            <!--end:Menu sub-->

                                        </div>
                                        <div data-kt-menu-trigger="click"
                                            class="menu-item here menu-accordion  <?php if (Illuminate\Support\Facades\Route::is('batch-schedule.running-class-list')||Illuminate\Support\Facades\Route::is('tms-inspections.create')) {?>here show<?php } ?>">
                                            <!--begin:Menu link-->
                                            <span class="menu-link sidebar-menu-link <?php if (Illuminate\Support\Facades\Route::is('batch-schedule.running-class-list')||Illuminate\Support\Facades\Route::is('tms-inspections.create')) {?>active<?php } ?>">
                                                <span class="menu-icon">
                                                    <i class="ki-duotone ki-badge fs-2 ">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                        <span class="path3"></span>
                                                        <span class="path4"></span>
                                                        <span class="path5"></span>
                                                    </i>
                                                </span>

                                                <span class="menu-title">{{ __('sidemenu.inspection') }}</span>
                                                <span class="menu-arrow"></span>
                                            </span>
                                            <!--end:Menu link-->
                                            <!--begin:Menu sub-->
                                            <div class="menu-sub menu-sub-accordion" kt-hidden-height="124" style="">
                                                <!--begin:Menu sub-->
                                                <div class="menu-sub menu-sub-accordion <?php if (Illuminate\Support\Facades\Route::is('batch-schedule.running-class-list')||Illuminate\Support\Facades\Route::is('tms-inspections.create') ) {?>here show<?php } ?>"
                                                    kt-hidden-height="81" style="">
                                                    <!--begin:Menu item-->
                                                    <div class="menu-item">
                                                        <!--begin:Menu link-->
                                                        <a class="menu-link show-loader  sidebar-menu-link <?php if (Illuminate\Support\Facades\Route::is('batch-schedule.running-class-list')||Illuminate\Support\Facades\Route::is('tms-inspections.create')) {?>active<?php } ?>"
                                                            href="{{ route('batch-schedule.running-class-list') }}">
                                                            <span class="menu-bullet">
                                                                <span class="bullet bullet-dot"></span>


                                                            </span>
                                                            <span class="menu-title">{{ __('sidemenu.add_new_inspection') }}</span>
                                                        </a>
                                                        <!--end:Menu link-->
                                                    </div>
                                                    <!--end:Menu item-->

                                                </div>
                                                <!--end:Menu sub-->
                                            </div>
                                            <!--end:Menu sub-->

                                        </div>
                                        <div data-kt-menu-trigger="click"
                                            class="menu-item here menu-accordion  <?php if (Illuminate\Support\Facades\Route::is('inspaction.index')||Illuminate\Support\Facades\Route::is('tms-inspections.show')) {?>here show<?php } ?>">
                                            <!--begin:Menu link-->
                                            <span class="menu-link sidebar-menu-link <?php if (Illuminate\Support\Facades\Route::is('inspaction.index')||Illuminate\Support\Facades\Route::is('tms-inspections.show')) {?>active<?php } ?>">
                                                <span class="menu-icon">
                                                    <i class="ki-duotone ki-folder-added fs-2">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                    </i>
                                                </span>

                                                <span class="menu-title">{{ __('sidemenu.report') }}</span>
                                                <span class="menu-arrow"></span>
                                            </span>
                                            <!--end:Menu link-->
                                            <!--begin:Menu sub-->
                                            <div class="menu-sub menu-sub-accordion" kt-hidden-height="124" style="">
                                                <!--begin:Menu sub-->
                                                <div class="menu-sub menu-sub-accordion <?php if (Illuminate\Support\Facades\Route::is('inspaction.index')||Illuminate\Support\Facades\Route::is('tms-inspections.show')) {?>here show<?php } ?>"
                                                    kt-hidden-height="81" style="">

                                                    <!--begin:Menu item-->
                                                    <div class="menu-item">
                                                        <!--begin:Menu link-->
                                                        <a class="menu-link show-loader  sidebar-menu-link <?php if (Illuminate\Support\Facades\Route::is('inspaction.index')||Illuminate\Support\Facades\Route::is('tms-inspections.show')) {?>active<?php } ?>"
                                                            href="{{ route('inspaction.index') }}">
                                                            <span class="menu-bullet">
                                                                <span class="bullet bullet-dot"></span>


                                                            </span>
                                                            <span class="menu-title">{{ __('sidemenu.inspection_report') }}</span>
                                                        </a>
                                                        <!--end:Menu link-->
                                                    </div>
                                                    <!--end:Menu item-->
                                                </div>
                                                <!--end:Menu sub-->
                                            </div>
                                            <!--end:Menu sub-->

                                        </div>
                                        <div data-kt-menu-trigger="click"
                                            class="menu-item here menu-accordion  <?php if (Illuminate\Support\Facades\Route::is('training-provider-partners.index')||Illuminate\Support\Facades\Route::is('training-provider-partners.edit')||Illuminate\Support\Facades\Route::is('lots.index') || Illuminate\Support\Facades\Route::is('lots.create') || Illuminate\Support\Facades\Route::is('lots.edit') || Illuminate\Support\Facades\Route::is('lots.show')|| Illuminate\Support\Facades\Route::is('lots.link-batch')||Illuminate\Support\Facades\Route::is('holydays.index')||Illuminate\Support\Facades\Route::is('holydays.edit')|| Illuminate\Support\Facades\Route::is('holydays.create')||Illuminate\Support\Facades\Route::is('courses.index') || Illuminate\Support\Facades\Route::is('courses.edit')|| Illuminate\Support\Facades\Route::is('courses.create') || Illuminate\Support\Facades\Route::is('tms-phase.index')|| Illuminate\Support\Facades\Route::is('tms-phase.link-batch')) {?>here show<?php } ?>">
                                            <!--begin:Menu link-->
                                            <span class="menu-link sidebar-menu-link <?php if (Illuminate\Support\Facades\Route::is('training-provider-partners.index')||Illuminate\Support\Facades\Route::is('training-provider-partners.edit')||Illuminate\Support\Facades\Route::is('lots.index') || Illuminate\Support\Facades\Route::is('lots.create') || Illuminate\Support\Facades\Route::is('lots.edit') || Illuminate\Support\Facades\Route::is('lots.show')|| Illuminate\Support\Facades\Route::is('lots.link-batch')||Illuminate\Support\Facades\Route::is('holydays.index')||Illuminate\Support\Facades\Route::is('holydays.edit')|| Illuminate\Support\Facades\Route::is('holydays.create')||Illuminate\Support\Facades\Route::is('courses.index') || Illuminate\Support\Facades\Route::is('courses.edit')|| Illuminate\Support\Facades\Route::is('courses.create') || Illuminate\Support\Facades\Route::is('tms-phase.index')|| Illuminate\Support\Facades\Route::is('tms-phase.link-batch')){?>active<?php } ?>">
                                                <span class="menu-icon">
                                                    <i class="ki-duotone ki-wrench  fs-2">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                    </i>
                                                </span>
                                                <span class="menu-title">{{ __('sidemenu.config') }}</span>
                                                <span class="menu-arrow"></span>
                                            </span>
                                            <!--end:Menu link-->
                                            <!--begin:Menu sub-->
                                            <div class="menu-sub menu-sub-accordion" kt-hidden-height="124" style="">
                                                <!--begin:Menu sub-->
                                                <div class="menu-sub menu-sub-accordion <?php if (Illuminate\Support\Facades\Route::is('training-provider-partners.index')||Illuminate\Support\Facades\Route::is('training-provider-partners.edit')||Illuminate\Support\Facades\Route::is('lots.index') || Illuminate\Support\Facades\Route::is('lots.create') || Illuminate\Support\Facades\Route::is('lots.edit') || Illuminate\Support\Facades\Route::is('lots.show')|| Illuminate\Support\Facades\Route::is('lots.link-batch')||Illuminate\Support\Facades\Route::is('holydays.index')||Illuminate\Support\Facades\Route::is('holydays.edit')|| Illuminate\Support\Facades\Route::is('holydays.create')||Illuminate\Support\Facades\Route::is('courses.index') || Illuminate\Support\Facades\Route::is('courses.edit')|| Illuminate\Support\Facades\Route::is('courses.create') || Illuminate\Support\Facades\Route::is('tms-phase.index')|| Illuminate\Support\Facades\Route::is('tms-phase.link-batch')) {?>here show<?php } ?>"
                                                    kt-hidden-height="81" style="">
                                                    <!--begin:Menu item-->
                                                    <div class="menu-item">
                                                        <!--begin:Menu link-->
                                                        <a class="menu-link show-loader  sidebar-menu-link <?php if (Illuminate\Support\Facades\Route::is('') ) {?>active<?php } ?>"
                                                            href="{{ '' }}">
                                                            <span class="menu-icon">
                                                                <i class="ki-duotone ki-subtitle fs-2                    ">
                                                                    <span class="path1"></span>
                                                                    <span class="path2"></span>
                                                                    <span class="path3"></span>
                                                                    <span class="path4"></span>
                                                                    <span class="path5"></span>
                                                                </i>
                                                            </span>
                                                            <span class="menu-title">{{ __('sidemenu.training_title') }}</span>
                                                        </a>
                                                        <!--end:Menu link-->
                                                    </div>
                                                    <!--end:Menu item-->
                                                    <!--begin:Menu item-->
                                                    <div class="menu-item">
                                                        <!--begin:Menu link-->
                                                        <a class="menu-link show-loader  sidebar-menu-link <?php if (Illuminate\Support\Facades\Route::is('training-provider-partners.index')||Illuminate\Support\Facades\Route::is('training-provider-partners.edit')) {?>active<?php } ?>"
                                                            href="{{ route('training-provider-partners.index') }}">
                                                            <span class="menu-icon">
                                                                <i class="ki-duotone ki-profile-user fs-2                      ">
                                                                    <span class="path1"></span>
                                                                    <span class="path2"></span>
                                                                    <span class="path3"></span>
                                                                    <span class="path4"></span>
                                                                </i>
                                                            </span>
                                                            <span class="menu-title">{{ __('sidemenu.org_provider') }}</span>
                                                        </a>
                                                        <!--end:Menu link-->
                                                    </div>
                                                    <!--end:Menu item-->
                                                    <!--begin:Menu item-->
                                                    <div class="menu-item">
                                                        <!--begin:Menu link-->
                                                        <a class="menu-link show-loader  sidebar-menu-link <?php if (Illuminate\Support\Facades\Route::is('lots.index') || Illuminate\Support\Facades\Route::is('lots.create') || Illuminate\Support\Facades\Route::is('lots.edit') || Illuminate\Support\Facades\Route::is('lots.show')|| Illuminate\Support\Facades\Route::is('lots.link-batch')) {?>active<?php } ?>"
                                                            href="{{ route('lots.index') }}">
                                                            <span class="menu-icon">
                                                                <i class="ki-duotone ki-element-2  fs-2                   ">
                                                                    <span class="path1"></span>
                                                                    <span class="path2"></span>
                                                                </i>
                                                            </span>
                                                            <span class="menu-title">{{ __('sidemenu.training_group') }}</span>
                                                        </a>
                                                        <!--end:Menu link-->
                                                    </div>
                                                    <!--end:Menu item-->
                                                    <!--begin:Menu item-->
                                                    <div class="menu-item">
                                                        <!--begin:Menu link-->
                                                        <a class="menu-link show-loader  sidebar-menu-link <?php if (Illuminate\Support\Facades\Route::is('holydays.index')||Illuminate\Support\Facades\Route::is('holydays.edit')|| Illuminate\Support\Facades\Route::is('holydays.create')) {?>active<?php } ?>"
                                                            href="{{ route('holydays.index') }}">
                                                            <span class="menu-icon">
                                                                <i class="ki-duotone ki-calendar-tick fs-2 ">
                                                                    <span class="path1"></span>
                                                                    <span class="path2"></span>
                                                                    <span class="path3"></span>
                                                                    <span class="path4"></span>
                                                                    <span class="path5"></span>
                                                                    <span class="path6"></span>
                                                                </i>
                                                            </span>
                                                            <span class="menu-title">{{ __('sidemenu.holly_day') }}</span>
                                                        </a>
                                                        <!--end:Menu link-->
                                                    </div>
                                                    <!--end:Menu item-->

                                                    <!--begin:Menu item-->
                                                    <div class="menu-item">
                                                        <!--begin:Menu link-->
                                                        <a class="menu-link show-loader  sidebar-menu-link <?php if (Illuminate\Support\Facades\Route::is('courses.index') || Illuminate\Support\Facades\Route::is('courses.edit')|| Illuminate\Support\Facades\Route::is('courses.create')) {?>active<?php } ?>"
                                                            href="{{ route('courses.index') }}">
                                                            <span class="menu-icon">
                                                                <i class="ki-duotone ki-some-files fs-2 ">
                                                                    <span class="path1"></span>
                                                                    <span class="path2"></span>
                                                                </i>
                                                            </span>
                                                            <span class="menu-title">{{ __('sidemenu.course') }}</span>
                                                        </a>
                                                        <!--end:Menu link-->
                                                    </div>
                                                    <!--end:Menu item-->
                                                    <!--begin:Menu item-->
                                                    <div class="menu-item">
                                                        <!--begin:Menu link-->
                                                        <a class="menu-link show-loader  sidebar-menu-link <?php if (Illuminate\Support\Facades\Route::is('') ) {?>active<?php } ?>"
                                                            href="{{ '' }}">
                                                            <span class="menu-icon">
                                                                <i class="ki-duotone ki-category fs-2                     ">
                                                                    <span class="path1"></span>
                                                                    <span class="path2"></span>
                                                                    <span class="path3"></span>
                                                                    <span class="path4"></span>
                                                                </i>
                                                            </span>
                                                            <span class="menu-title">{{ __('sidemenu.categorie') }}</span>
                                                        </a>
                                                        <!--end:Menu link-->
                                                    </div>
                                                    <!--end:Menu item-->
                                                    <!--begin:Menu item-->
                                                    <div class="menu-item">
                                                        <!--begin:Menu link-->
                                                        <a class="menu-link show-loader  sidebar-menu-link <?php if (Illuminate\Support\Facades\Route::is('') ) {?>active<?php } ?>"
                                                            href="{{ '' }}">
                                                            <span class="menu-icon">
                                                                <i class="ki-duotone ki-people  fs-2                      ">
                                                                    <span class="path1"></span>
                                                                    <span class="path2"></span>
                                                                    <span class="path3"></span>
                                                                    <span class="path4"></span>
                                                                    <span class="path5"></span>
                                                                </i>
                                                            </span>
                                                            <span class="menu-title">{{ __('sidemenu.partner_employee') }}</span>
                                                        </a>
                                                        <!--end:Menu link-->
                                                    </div>
                                                    <!--end:Menu item-->
                                                    <!--begin:Menu item-->
                                                    <div class="menu-item">
                                                        <!--begin:Menu link-->
                                                        <a class="menu-link show-loader  sidebar-menu-link <?php if (Illuminate\Support\Facades\Route::is('tms-phase.index') || Illuminate\Support\Facades\Route::is('tms-phase.link-batch') ) {?>active<?php } ?>"
                                                            href="{{ route('tms-phase.index') }}">
                                                            <span class="menu-icon">
                                                                <i class="ki-duotone ki-row-horizontal  fs-2">
                                                                    <span class="path1"></span>
                                                                    <span class="path2"></span>
                                                                </i>
                                                            </span>
                                                            <span class="menu-title">{{ __('sidemenu.phase_batch') }}</span>
                                                        </a>
                                                        <!--end:Menu link-->
                                                    </div>
                                                    <!--end:Menu item-->
                                                    <!--begin:Menu item-->
                                                    {{-- <div class="menu-item">
                                                        <!--begin:Menu link-->
                                                        <a class="menu-link show-loader  sidebar-menu-link <?php if (Illuminate\Support\Facades\Route::is('') ) {?>active<?php } ?>"
                                                            href="{{ '' }}">
                                                            <span class="menu-icon">
                                                                <i class="ki-duotone ki-element-6 fs-2">
                                                                    <span class="path1"></span>
                                                                    <span class="path2"></span>
                                                                </i>
                                                            </span>
                                                            <span class="menu-title">{{ __('sidemenu.phase_batch') }}</span>
                                                        </a>
                                                        <!--end:Menu link-->
                                                    </div> --}}
                                                    <!--end:Menu item-->

                                                </div>
                                                <!--end:Menu sub-->
                                            </div>
                                            <!--end:Menu sub-->

                                        </div>
                                        <!--end:Menu item-->
                                        <!--Start:Menu item-->
                                        <div data-kt-menu-trigger="click"
                                            class="menu-item here menu-accordion  <?php if (Illuminate\Support\Facades\Route::is('products.index')||Illuminate\Support\Facades\Route::is('products.create')||Illuminate\Support\Facades\Route::is('products.edit')||Illuminate\Support\Facades\Route::is('product-combos.index')||Illuminate\Support\Facades\Route::is('product-combos.create')||Illuminate\Support\Facades\Route::is('product-combos.edit')) {?>here show<?php } ?>">
                                            <!--begin:Menu link-->
                                            <span class="menu-link sidebar-menu-link <?php if (Illuminate\Support\Facades\Route::is('products.index')||Illuminate\Support\Facades\Route::is('products.create')||Illuminate\Support\Facades\Route::is('products.edit')||Illuminate\Support\Facades\Route::is('product-combos.index')||Illuminate\Support\Facades\Route::is('product-combos.create')||Illuminate\Support\Facades\Route::is('product-combos.edit')) {?>active<?php } ?>">
                                                <span class="menu-icon">
                                                    <i class="ki-duotone ki-lots-shopping  fs-2">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                        <span class="path3"></span>
                                                        <span class="path4"></span>
                                                        <span class="path5"></span>
                                                        <span class="path6"></span>
                                                        <span class="path7"></span>
                                                        <span class="path8"></span>
                                                    </i>
                                                </span>

                                                <span class="menu-title">{{ __('sidemenu.course_suplies') }}</span>
                                                <span class="menu-arrow"></span>
                                            </span>
                                            <!--end:Menu link-->
                                            <!--begin:Menu sub-->
                                            <div class="menu-sub menu-sub-accordion" kt-hidden-height="124" style="">
                                                <!--begin:Menu sub-->
                                                <div class="menu-sub menu-sub-accordion <?php if (Illuminate\Support\Facades\Route::is('products.index')||Illuminate\Support\Facades\Route::is('products.create')||Illuminate\Support\Facades\Route::is('products.edit')||Illuminate\Support\Facades\Route::is('product-combos.index')||Illuminate\Support\Facades\Route::is('product-combos.create')||Illuminate\Support\Facades\Route::is('product-combos.edit')) {?>here show<?php } ?>"
                                                    kt-hidden-height="81" style="">

                                                    <!--begin:Menu item-->
                                                    <div class="menu-item">
                                                        <!--begin:Menu link-->
                                                        <a class="menu-link show-loader  sidebar-menu-link <?php if (Illuminate\Support\Facades\Route::is('products.index')||Illuminate\Support\Facades\Route::is('products.create')||Illuminate\Support\Facades\Route::is('products.edit')) {?>active<?php } ?>"
                                                            href="{{ route('products.index') }}">
                                                            <span class="menu-bullet">
                                                                <span class="bullet bullet-dot"></span>


                                                            </span>
                                                            <span class="menu-title">{{ __('sidemenu.products') }}</span>
                                                        </a>
                                                        <!--end:Menu link-->
                                                    </div>
                                                    <!--end:Menu item-->
                                                    <!--begin:Menu item-->
                                                    <div class="menu-item">
                                                        <!--begin:Menu link-->
                                                        <a class="menu-link show-loader  sidebar-menu-link <?php if (Illuminate\Support\Facades\Route::is('product-combos.index')||Illuminate\Support\Facades\Route::is('product-combos.create')||Illuminate\Support\Facades\Route::is('product-combos.edit')) {?>active<?php } ?>"
                                                            href="{{ route('product-combos.index') }}">
                                                            <span class="menu-bullet">
                                                                <span class="bullet bullet-dot"></span>


                                                            </span>
                                                            <span class="menu-title">{{ __('sidemenu.product_combos') }}</span>
                                                        </a>
                                                        <!--end:Menu link-->
                                                    </div>
                                                    <!--end:Menu item-->
                                                </div>
                                                <!--end:Menu sub-->
                                            </div>
                                            <!--end:Menu sub-->

                                        </div>
                                        <!--end:Menu item-->
                                        <!--Start:Menu item-->
                                        <div data-kt-menu-trigger="click"
                                            class="menu-item here menu-accordion  <?php if (Illuminate\Support\Facades\Route::is('evaluation-head.index')||Illuminate\Support\Facades\Route::is('evaluation-head.create')||Illuminate\Support\Facades\Route::is('evaluation-head.edit')||Illuminate\Support\Facades\Route::is('trainer-schedule-details.lists')||Illuminate\Support\Facades\Route::is('trainer-schedule-details.students')||Illuminate\Support\Facades\Route::is('trainer-schedule-details.show-student-evaluation')) {?>here show<?php } ?>">
                                            <!--begin:Menu link-->
                                            <span class="menu-link sidebar-menu-link <?php if (Illuminate\Support\Facades\Route::is('evaluation-head.index')||Illuminate\Support\Facades\Route::is('evaluation-head.create')||Illuminate\Support\Facades\Route::is('evaluation-head.edit')||Illuminate\Support\Facades\Route::is('trainer-schedule-details.lists')||Illuminate\Support\Facades\Route::is('trainer-schedule-details.students')||Illuminate\Support\Facades\Route::is('trainer-schedule-details.show-student-evaluation')) {?>active<?php } ?>">
                                                <span class="menu-icon">
                                                    <i class="ki-duotone ki-double-check  fs-2">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                    </i>
                                                </span>

                                                <span class="menu-title">{{ __('sidemenu.evaluation') }}</span>
                                                <span class="menu-arrow"></span>
                                            </span>
                                            <!--end:Menu link-->
                                            <!--begin:Menu sub-->
                                            <div class="menu-sub menu-sub-accordion" kt-hidden-height="124" style="">
                                                <!--begin:Menu sub-->
                                                <div class="menu-sub menu-sub-accordion <?php if (Illuminate\Support\Facades\Route::is('evaluation-head.index')||Illuminate\Support\Facades\Route::is('evaluation-head.create')||Illuminate\Support\Facades\Route::is('evaluation-head.edit')||Illuminate\Support\Facades\Route::is('trainer-schedule-details.lists')||Illuminate\Support\Facades\Route::is('trainer-schedule-details.students')||Illuminate\Support\Facades\Route::is('trainer-schedule-details.show-student-evaluation')) {?>here show<?php } ?>"
                                                    kt-hidden-height="81" style="">
                                                    <!--begin:Menu item-->
                                                    <div class="menu-item">
                                                        <!--begin:Menu link-->
                                                        <a class="menu-link show-loader  sidebar-menu-link <?php if (Illuminate\Support\Facades\Route::is('evaluation-head.index')||Illuminate\Support\Facades\Route::is('evaluation-head.create')||Illuminate\Support\Facades\Route::is('evaluation-head.edit')) {?>active<?php } ?>"
                                                            href="{{ route('evaluation-head.index') }}">
                                                            <span class="menu-icon">
                                                                <i class="ki-duotone ki-tablet-text-up fs-2  ">
                                                                    <span class="path1"></span>
                                                                    <span class="path2"></span>
                                                                </i>
                                                            </span>
                                                            <span class="menu-title">{{ __('sidemenu.evaluation_head') }}</span>
                                                        </a>
                                                        <!--end:Menu link-->
                                                    </div>
                                                    <!--end:Menu item-->
                                                    <!--begin:Menu item-->
                                                    <div class="menu-item">
                                                        <!--begin:Menu link-->
                                                        <a class="menu-link show-loader  sidebar-menu-link <?php if (Illuminate\Support\Facades\Route::is('trainer-schedule-details.lists')||Illuminate\Support\Facades\Route::is('trainer-schedule-details.students')||Illuminate\Support\Facades\Route::is('trainer-schedule-details.show-student-evaluation')) {?>active<?php } ?>"
                                                            href="{{ route('trainer-schedule-details.lists') }}">
                                                            <span class="menu-icon">
                                                                <i
                                                                    class="ki-duotone ki-questionnaire-tablet  fs-2                       ">
                                                                    <span class="path1"></span>
                                                                    <span class="path2"></span>
                                                                </i>
                                                            </span>
                                                            <span class="menu-title">{{ __('sidemenu.evaluation_student') }}</span>
                                                        </a>
                                                        <!--end:Menu link-->
                                                    </div>
                                                    <!--end:Menu item-->
                                                    {{-- <!--begin:Menu item-->
                                                    <div class="menu-item">
                                                        <!--begin:Menu link-->
                                                        <a class="menu-link show-loader  sidebar-menu-link <?php if (Illuminate\Support\Facades\Route::is('product-combos.index')||Illuminate\Support\Facades\Route::is('product-combos.create')||Illuminate\Support\Facades\Route::is('product-combos.edit')) {?>active<?php } ?>"
                                                            href="{{ route('product-combos.index') }}">
                                                            <span class="menu-icon">
                                                                <i class="ki-duotone ki-tablet-ok fs-2 ">
                                                                    <span class="path1"></span>
                                                                    <span class="path2"></span>
                                                                    <span class="path3"></span>
                                                                </i>
                                                            </span>
                                                            <span class="menu-title">{{ __('sidemenu.evaluation_trainer') }}</span>
                                                        </a>
                                                        <!--end:Menu link-->
                                                    </div>
                                                    <!--end:Menu item--> --}}
                                                </div>
                                                <!--end:Menu sub-->
                                            </div>
                                            <!--end:Menu sub-->

                                        </div>
                                        <!--end:Menu item-->
                                        <div data-kt-menu-trigger="click" class="menu-item menu-accordion ">

                                            <!--start:Menu link-->
                                            <a href="{{ route('generate-pdf') }}" class="show-loader">
                                                <span
                                                    class="menu-link sidebar-menu-link dashboard-item <?php if (Illuminate\Support\Facades\Route::is('') ) {?>active<?php } ?>">
                                                    <span class="menu-icon">
                                                        <i class="ki-duotone ki-user-edit  fs-2                      ">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                            <span class="path3"></span>
                                                        </i>
                                                    </span>
                                                    <span class="menu-title">{{ __('sidemenu.class_attendence') }}</span>
                                                </span>
                                            </a>
                                            <!--end:Menu link-->

                                        </div>
                                        <div data-kt-menu-trigger="click" class="menu-item menu-accordion ">

                                            <!--start:Menu link-->
                                            <a href="" class="show-loader">
                                                <span
                                                    class="menu-link sidebar-menu-link dashboard-item <?php if (Illuminate\Support\Facades\Route::is('') ) {?>active<?php } ?>">
                                                    <span class="menu-icon">
                                                        <i class="ki-duotone ki-document fs-2   ">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>
                                                    </span>
                                                    <span class="menu-title">{{ __('sidemenu.class_document') }}</span>
                                                </span>
                                            </a>
                                            <!--end:Menu link-->

                                        </div>
                                        <div data-kt-menu-trigger="click" class="menu-item menu-accordion ">

                                            <!--start:Menu link-->
                                            <a href="" class="show-loader">
                                                <span
                                                    class="menu-link sidebar-menu-link dashboard-item <?php if (Illuminate\Support\Facades\Route::is('') ) {?>active<?php } ?>">
                                                    <span class="menu-icon">
                                                        <i class="ki-duotone ki-questionnaire-tablet  fs-2                       ">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>
                                                    </span>
                                                    <span class="menu-title">{{ __('sidemenu.evaluation_student') }}</span>
                                                </span>
                                            </a>
                                            <!--end:Menu link-->

                                        </div>
                                        <div data-kt-menu-trigger="click" class="menu-item menu-accordion ">

                                            <!--start:Menu link-->
                                            <a href="" class="show-loader">
                                                <span
                                                    class="menu-link sidebar-menu-link dashboard-item <?php if (Illuminate\Support\Facades\Route::is('') ) {?>active<?php } ?>">
                                                    <span class="menu-icon">
                                                        <i class="ki-duotone ki-tablet-ok fs-2 ">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                            <span class="path3"></span>
                                                        </i>
                                                    </span>
                                                    <span class="menu-title">{{ __('sidemenu.evaluation_trainer') }}</span>
                                                </span>
                                            </a>
                                            <!--end:Menu link-->

                                        </div>
                                        {{-- <div data-kt-menu-trigger="click" class="menu-item menu-accordion ">

                                            <!--start:Menu link-->
                                            <a href="{{ route('holydays.index') }}" class="show-loader">
                                                <span
                                                    class="menu-link sidebar-menu-link dashboard-item <?php if (Illuminate\Support\Facades\Route::is('holydays.index')||Illuminate\Support\Facades\Route::is('holydays.edit')|| Illuminate\Support\Facades\Route::is('holydays.create')) {?>active<?php } ?>">
                                                    <span class="menu-icon">
                                                        <i class="ki-duotone ki-calendar-tick fs-2 ">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                            <span class="path3"></span>
                                                            <span class="path4"></span>
                                                            <span class="path5"></span>
                                                            <span class="path6"></span>
                                                        </i>
                                                    </span>
                                                    <span class="menu-title">{{ __('sidemenu.holly_day') }}</span>
                                                </span>
                                            </a>
                                            <!--end:Menu link-->

                                        </div> --}}
                                        {{-- <div data-kt-menu-trigger="click" class="menu-item menu-accordion ">

                                            <!--start:Menu link-->
                                            <a href="" class="show-loader">
                                                <span
                                                    class="menu-link sidebar-menu-link dashboard-item <?php if (Illuminate\Support\Facades\Route::is('') ) {?>active<?php } ?>">
                                                    <span class="menu-icon">
                                                        <i class="ki-duotone ki-subtitle fs-2                    ">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                            <span class="path3"></span>
                                                            <span class="path4"></span>
                                                            <span class="path5"></span>
                                                        </i>
                                                    </span>
                                                    <span class="menu-title">{{ __('sidemenu.training_title') }}</span>
                                                </span>
                                            </a>
                                            <!--end:Menu link-->

                                        </div> --}}
                                        {{-- <div data-kt-menu-trigger="click" class="menu-item menu-accordion ">

                                            <!--start:Menu link-->
                                            <a href="{{ route('lots.index') }}" class="show-loader">
                                                <span
                                                    class="menu-link sidebar-menu-link dashboard-item <?php if (Illuminate\Support\Facades\Route::is('lots.index') || Illuminate\Support\Facades\Route::is('lots.create') || Illuminate\Support\Facades\Route::is('lots.edit') || Illuminate\Support\Facades\Route::is('lots.show')|| Illuminate\Support\Facades\Route::is('lots.link-batch')) {?>active<?php } ?>">
                                                    <span class="menu-icon">
                                                        <i class="ki-duotone ki-element-2  fs-2                   ">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>
                                                    </span>
                                                    <span class="menu-title">{{ __('sidemenu.training_group') }}</span>
                                                </span>
                                            </a>
                                            <!--end:Menu link-->

                                        </div> --}}
                                    @endif
                                @endempty
                            @endisset
                        @endif
                    @endempty
                @endisset
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
