<!--begin::Sidebar-->
<ul class="list-unstyled m-0 menu accordion" id="sidebar-menu">


    @isset($roleRoutePermissions)
    @empty(!$roleRoutePermissions)


    <li class="nav-item">
        <a href="{{ route('admins.dashboard') }}" class="nav-link">
            <span class="material-symbols-rounded">
                dashboard
            </span>
        
            Dashboard
        </a>
    </li>


    @if (in_array($userRole, ['SuperAdmin', 'superadmin', 'Admin', 'admin', 'DPD', 'dpd', 'provider', 'Provider',
    'Consultant', 'consultant']))
    <!-- collapse menu -->
    <li class="nav-item accordion-item">
        <a href="#" class="nav-link accordion-button collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#userCollapse">
            <span class="material-symbols-rounded">
                group
            </span>
            User
        </a>
        <div id="userCollapse" class="accordion-collapse collapse" data-bs-parent="#sidebar-menu">
            <div class="accordion-content">
                @if (in_array('admins.index', $roleRoutePermissions))
                <a href="{{ route('admins.index') }}"
                    class="nav-link {{ Illuminate\Support\Facades\Route::is('admins.*') ? 'active' : '' }}">
                    - {{ __('sidemenu.admin_user') }}
                </a>
                @endif
                @if (in_array('roles.index', $roleRoutePermissions))
                <a href="{{ route('roles.index') }}"
                    class="nav-link {{ Illuminate\Support\Facades\Route::is('roles.*') ? 'active' : '' }}">
                    - {{ __('sidemenu.roles') }}
                </a>
                @endif
                @if (in_array('role.index', $roleRoutePermissions))
                <a href="{{ route('role.index') }}"
                    class="nav-link {{ Illuminate\Support\Facades\Route::is('role.*') ? 'active' : '' }}">
                    - {{ __('sidemenu.role_list') }}
                </a>
                @endif
                @if (in_array('permission.index', $roleRoutePermissions))
                <a href="{{ route('permission.index') }}"
                    class="nav-link {{ Illuminate\Support\Facades\Route::is('permission.*') ? 'active' : '' }}">
                    - {{ __('sidemenu.permission_list') }}
                </a>
                @endif
                <!-- Add more menu items as needed -->
            </div>
        </div>
    </li>
    <li class="nav-item accordion-item here menu-accordion <?php if ( Illuminate\Support\Facades\Route::is('divisions.index') || Illuminate\Support\Facades\Route::is('divisions.show') || Illuminate\Support\Facades\Route::is('districts.index') || Illuminate\Support\Facades\Route::is('districts.show')|| Illuminate\Support\Facades\Route::is('upazilas.index') || Illuminate\Support\Facades\Route::is('upazilas.show') || Illuminate\Support\Facades\Route::is('providers.index') || Illuminate\Support\Facades\Route::is('providers.show')|| Illuminate\Support\Facades\Route::is('provider.link-batch')) {?>here show<?php } ?>">
        <a href="#" class="nav-link accordion-button <?php if (Illuminate\Support\Facades\Route::is('divisions.index') || Illuminate\Support\Facades\Route::is('divisions.show') || Illuminate\Support\Facades\Route::is('districts.index') || Illuminate\Support\Facades\Route::is('districts.show')|| Illuminate\Support\Facades\Route::is('upazilas.index') || Illuminate\Support\Facades\Route::is('upazilas.show') || Illuminate\Support\Facades\Route::is('providers.index') || Illuminate\Support\Facades\Route::is('providers.show')|| Illuminate\Support\Facades\Route::is('provider.link-batch')) {?>active<?php } ?>" type="button" data-bs-toggle="collapse" data-bs-target="#settingsManagementCollapse">
            <span class="material-symbols-rounded">
                settings
                </span>
            Settings
        </a>
        <div id="settingsManagementCollapse" class="accordion-collapse collapse <?php if ( Illuminate\Support\Facades\Route::is('divisions.index') || Illuminate\Support\Facades\Route::is('divisions.show') || Illuminate\Support\Facades\Route::is('districts.index') || Illuminate\Support\Facades\Route::is('districts.show')|| Illuminate\Support\Facades\Route::is('upazilas.index') || Illuminate\Support\Facades\Route::is('upazilas.show') || Illuminate\Support\Facades\Route::is('providers.index') || Illuminate\Support\Facades\Route::is('providers.show')|| Illuminate\Support\Facades\Route::is('provider.link-batch')) {?>show<?php } ?>" data-bs-parent="#sidebar-menu">
            <div class="accordion-content">
                <a href="{{ route('divisions.index') }}" class="nav-link sidebar-menu-link <?php if (Illuminate\Support\Facades\Route::is('divisions.index') || Illuminate\Support\Facades\Route::is('divisions.show')) { ?>active<?php } ?>">
                    - Division List
                </a>
                <a href="{{ route('districts.index') }}" class="nav-link sidebar-menu-link <?php if (Illuminate\Support\Facades\Route::is('districts.index') || Illuminate\Support\Facades\Route::is('districts.show')) { ?>active<?php } ?>">
                    - District List
                </a>
                <a href="{{ route('upazilas.index') }}" class="nav-link sidebar-menu-link <?php if (Illuminate\Support\Facades\Route::is('upazilas.index') || Illuminate\Support\Facades\Route::is('upazilas.show')) { ?>active<?php } ?>">
                    - Upazila List
                </a>
                <a href="{{ route('providers.index') }}" class="nav-link sidebar-menu-link <?php if (Illuminate\Support\Facades\Route::is('providers.index') || Illuminate\Support\Facades\Route::is('providers.show') || Illuminate\Support\Facades\Route::is('provider.link-batch')) { ?>active<?php } ?>">
                    - Vendor
                </a>
            </div>
        </div>
    </li>
    
    
    
    
    
    

    <li class="nav-item accordion-item">
        <a href="#" class="nav-link accordion-button collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#collapseRunningBatches">
            <span class="material-symbols-rounded">
                change_circle
                </span>
            Running Batches
        </a>
        <div id="collapseRunningBatches" class="accordion-collapse collapse" data-bs-parent="#sidebar-menu">
            <div class="accordion-content">
                <a href="{{ route('batch-schedule.runningBatches') }}"
                    class="nav-link{{ Illuminate\Support\Facades\Route::is('batch-schedule.runningBatches') ? ' active' : '' }}">
                    - Running Batch List
                </a>
            </div>
        </div>
    </li>



    <li class="nav-item accordion-item">
        <a href="#" class="nav-link accordion-button collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#collapseInspection">
            <span class="material-symbols-rounded">
                done_all
                </span>
            Inspection
        </a>
        <div id="collapseInspection" class="accordion-collapse collapse" data-bs-parent="#sidebar-menu">
            <div class="accordion-content">
                <a href="{{ route('batch-schedule.running-class-list') }}"
                    class="nav-link{{ Illuminate\Support\Facades\Route::is('batch-schedule.running-class-list') ? ' active' : '' }}">
                    - Add New Inspection
                </a>
            </div>
        </div>
    </li>



    <!-- End collapse menu -->
    @endif








    @if (in_array('traineeEnroll.index', $roleRoutePermissions))
    <!-- collapse menu -->
    <li class="nav-item accordion-item">
        <a href="#" class="nav-link accordion-button collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#enrollmentCollapse">
            <span class="material-symbols-rounded">
                supervisor_account
                </span>
            Enrollment
        </a>
        <div id="enrollmentCollapse" class="accordion-collapse collapse" data-bs-parent="#sidebar-menu">
            <div class="accordion-content">
                @if (in_array('batches.index', $roleRoutePermissions))
                <a href="{{ route('batches.index') }}"
                    class="nav-link {{ Illuminate\Support\Facades\Route::is('batches.index') ? 'active' : '' }}">
                    - {{ __('sidemenu.trainer_enrollment') }}
                </a>
                @endif
                @if ($userRole == 'provider' || $userRole == 'Provider')
                <a href="{{ route('traineeEnroll.index') }}"
                    class="nav-link {{ Illuminate\Support\Facades\Route::is('traineeEnroll.index') ? 'active' : '' }}">
                    - {{ __('sidemenu.trainee_enrollment_list') }}
                </a>
                <a href="{{ route('trainerEnroll.index') }}"
                    class="nav-link {{ Illuminate\Support\Facades\Route::is('trainerEnroll.index') ? 'active' : '' }}">
                    - {{ __('sidemenu.trainer_enrollment_list') }}
                </a>
                @endif

            </div>
        </div>
    </li>
   
    
    
    <!-- End collapse menu -->
    @endif





    @if ($userRole == 'trainer' || $userRole == 'Trainer' || $userRole == 'provider' || $userRole == 'Provider')
    @if (in_array('batches.index', $roleRoutePermissions) || in_array('attendance.batch-list', $roleRoutePermissions) ||
    in_array('attendance.batch-list', $roleRoutePermissions))
    <!-- collapse menu -->
    <li class="nav-item accordion-item">
        <a href="#" class="nav-link accordion-button collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#scheduleCollapse">
            <span class="material-icons-outlined">
                people
            </span>
            Schedule Management
        </a>
        <div id="scheduleCollapse" class="accordion-collapse collapse" data-bs-parent="#sidebar-menu">
            <div class="accordion-content">
                @if ($userRole == 'trainer' || $userRole == 'Trainer')
                <a href="{{ route('attendance.batch-list') }}"
                    class="nav-link {{ Illuminate\Support\Facades\Route::is('attendance.batch-list') ? 'active' : '' }}">
                    - {{ __('sidemenu.trainer_batch_list') }}
                </a>
                @endif
                @if ($userRole == 'provider' || $userRole == 'Provider')
                <a href="{{ route('batch-schedule.batches') }}"
                    class="nav-link {{ Illuminate\Support\Facades\Route::is('batch-schedule.batches') ? 'active' : '' }}">
                    - {{ __('sidemenu.provider_batch_list') }}
                </a>
                @endif
                <!-- Add more menu items as needed -->
                <a href="{{ route('batch-schedule.index') }}"
                    class="nav-link {{ Illuminate\Support\Facades\Route::is('batch-schedule.index') ? 'active' : '' }}">
                    - {{ __('sidemenu.batch_schedule') }}
                </a>
                <a href="{{ route('batch-schedule.create') }}"
                    class="nav-link {{ Illuminate\Support\Facades\Route::is('batch-schedule.create') ? 'active' : '' }}">
                    - {{ __('sidemenu.create_schedule') }}
                </a>
                <a href="{{ route('attendance.form') }}"
                    class="nav-link {{ Illuminate\Support\Facades\Route::is('attendance.form') ? 'active' : '' }}">
                    - {{ __('sidemenu.attendance_form') }}
                </a>
            </div>
        </div>
    </li>
    <!-- End collapse menu -->
    @endif
    @endif


    <!--=============Newadmon=================-->

    @if ($userRole == 'SuperAdmin' ||
    $userRole == 'superadmin' ||
    $userRole == 'Admin' ||
    $userRole == 'admin' ||
    $userRole == 'DPD' ||
    $userRole == 'dpd' ||
    $userRole == 'DG' ||
    $userRole == 'dg')
    <!-- collapse menu -->
    <li class="nav-item accordion-item">
        <a href="#" class="nav-link accordion-button collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#batchMonitoringCollapse">
            <span class="material-symbols-rounded">
                clinical_notes
                </span>
            Batch Monitoring
        </a>
        <div id="batchMonitoringCollapse" class="accordion-collapse collapse" data-bs-parent="#sidebar-menu">
            <a href="{{ route('dashboard_details.total_batches') }}"
                class="nav-link{{ Illuminate\Support\Facades\Route::is('dashboard_details.total_batches') ? ' active' : '' }}">-
                All Batch List</a>
        </div>
    </li>

    <li class="nav-item accordion-item">
        <a href="#" class="nav-link accordion-button collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#collapseConfig">
            <span class="material-symbols-rounded">
                manufacturing
                </span>
            {{ __('sidemenu.config') }}
        </a>
        <div id="collapseConfig" class="accordion-collapse collapse" data-bs-parent="#sidebar-menu">

            <a href="#" class="nav-link">- {{ __('sidemenu.training_title') }}</a>
            <a href="{{ route('training-provider-partners.index') }}"
                class="nav-link{{ Illuminate\Support\Facades\Route::is('training-provider-partners.index') || Illuminate\Support\Facades\Route::is('training-provider-partners.edit') ? ' active' : '' }}">-
                {{ __('sidemenu.org_provider') }}</a>
            <a href="{{ route('lots.index') }}"
                class="nav-link{{ Illuminate\Support\Facades\Route::is('lots.index') || Illuminate\Support\Facades\Route::is('lots.create') || Illuminate\Support\Facades\Route::is('lots.edit') || Illuminate\Support\Facades\Route::is('lots.show') || Illuminate\Support\Facades\Route::is('lots.link-batch') ? ' active' : '' }}">-
                {{ __('sidemenu.training_group') }}</a>
            <a href="{{ route('holydays.index') }}"
                class="nav-link{{ Illuminate\Support\Facades\Route::is('holydays.index') || Illuminate\Support\Facades\Route::is('holydays.edit') || Illuminate\Support\Facades\Route::is('holydays.create') ? ' active' : '' }}">-
                {{ __('sidemenu.holly_day') }}</a>
            <a href="{{ route('courses.index') }}"
                class="nav-link{{ Illuminate\Support\Facades\Route::is('courses.index') || Illuminate\Support\Facades\Route::is('courses.edit') || Illuminate\Support\Facades\Route::is('courses.create') ? ' active' : '' }}">-
                {{ __('sidemenu.course') }}</a>
            <a href="#" class="nav-link">- {{ __('sidemenu.categorie') }}</a>
            <a href="#" class="nav-link">- {{ __('sidemenu.partner_employee') }}</a>
            <a href="{{ route('tms-phase.index') }}"
                class="nav-link{{ Illuminate\Support\Facades\Route::is('tms-phase.index') || Illuminate\Support\Facades\Route::is('tms-phase.link-batch') ? ' active' : '' }}">-
                {{ __('sidemenu.phase_batch') }}</a>
        </div>
    </li>

    <li class="nav-item accordion-item">
        <a href="#" class="nav-link accordion-button collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#collapseCourseSupplies">
            <span class="material-symbols-rounded">
                inventory
                </span>
            {{ __('sidemenu.course_suplies') }}
        </a>
        <div id="collapseCourseSupplies" class="accordion-collapse collapse" data-bs-parent="#sidebar-menu">
            <div class="accordion-content">
                <a href="{{ route('products.index') }}"
                    class="nav-link{{ Illuminate\Support\Facades\Route::is('products.index') || Illuminate\Support\Facades\Route::is('products.create') || Illuminate\Support\Facades\Route::is('products.edit') ? ' active' : '' }}">-
                    {{ __('sidemenu.products') }}</a>
                <a href="{{ route('product-combos.index') }}"
                    class="nav-link{{ Illuminate\Support\Facades\Route::is('product-combos.index') || Illuminate\Support\Facades\Route::is('product-combos.create') || Illuminate\Support\Facades\Route::is('product-combos.edit') ? ' active' : '' }}">-
                    {{ __('sidemenu.product_combos') }}</a>
            </div>
        </div>
    </li>

    <li class="nav-item accordion-item">
        <a href="#" class="nav-link accordion-button collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#collapseEvaluation">
            <span class="material-symbols-rounded">
                user_attributes
                </span>
            {{ __('sidemenu.evaluation') }}
        </a>
        <div id="collapseEvaluation" class="accordion-collapse collapse" data-bs-parent="#sidebar-menu">
            <div class="accordion-content">
                <a href="{{ route('evaluation-head.index') }}"
                    class="nav-link{{ Illuminate\Support\Facades\Route::is('evaluation-head.index') || Illuminate\Support\Facades\Route::is('evaluation-head.create') || Illuminate\Support\Facades\Route::is('evaluation-head.edit') ? ' active' : '' }}">-
                    {{ __('sidemenu.evaluation_head') }}</a>
                <a href="{{ route('trainer-schedule-details.lists') }}"
                    class="nav-link{{ Illuminate\Support\Facades\Route::is('trainer-schedule-details.lists') || Illuminate\Support\Facades\Route::is('trainer-schedule-details.students') || Illuminate\Support\Facades\Route::is('trainer-schedule-details.show-student-evaluation') ? ' active' : '' }}">-
                    {{ __('sidemenu.evaluation_student') }}</a>
            </div>
        </div>
    </li>

    <li class="nav-item accordion-item">
        <a href="{{ route('generate-pdf') }}"
            class="nav-link show-loader{{ Illuminate\Support\Facades\Route::is('') ? ' active' : '' }}">
            <span class="material-symbols-rounded">
                person_check
                </span>
            {{ __('sidemenu.class_attendence') }}
        </a>
    </li>

    <li class="nav-item accordion-item">
        <a href="#" class="nav-link show-loader{{ Illuminate\Support\Facades\Route::is('') ? ' active' : '' }}">
            <span class="material-symbols-rounded">
                assignment
                </span>
            {{ __('sidemenu.class_document') }}
        </a>
    </li>


    @endif
    @endempty
    @endisset

    {{--
    <li class="nav-item">
        <a href="#" class="nav-link active">
            <span class="material-icons-outlined">
                dynamic_form
            </span>
            Batch
        </a>
    </li>
    <!-- collapse menu -->
    <li class="nav-item accordion-item">
        <a href="#" class="nav-link accordion-button collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#collapseOne">
            <span class="material-icons-outlined">
                people
            </span>
            User
        </a>
        <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#sidebar-menu">
            <div class="accordion-content">
                <a href="" class="nav-link">
                    - List
                </a>
                <a href="" class="nav-link active">
                    - Add New
                </a>
                <a href="" class="nav-link">
                    - Reset
                </a>
                </a>

            </div>
        </div>
    </li>
    <!-- End collapse menu --> --}}

</ul>