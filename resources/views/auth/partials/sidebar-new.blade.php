<!--begin::Sidebar-->
<ul class="list-unstyled m-0 menu accordion" id="sidebar-menu">


    @isset($roleRoutePermissions)
        @empty(!$roleRoutePermissions)


            <li class="nav-item">
                <a href="{{ route('admins.dashboard') }}" class="nav-link">
                    <span class="material-symbols-rounded">
                        dashboard
                    </span>

                    {{ __('sidemenu.dashboard') }}
                </a>
            </li>


            @if (in_array($userRole, [
                    'SuperAdmin',
                    'superadmin',
                    'Admin',
                    'admin',
                    'DG',
                    'dg',
                    'DPD',
                    'dpd',
                    'provider',
                    'Provider',
                    'trainer',
                    'Trainer',
                    'Consultant',
                    'consultant',
                    'Minister',
                    'minister',
                    'uno',
                    'UNO',
                    'Assistant Programmer',
                    'DC',
                    'dc',
                    'PD',
                    'pd',
                    'Programmer',
                    'programmer',
                    'Divisional Commissioner',
                    'divisional commissioner',
                    'Secretary',
                    'secretary',
                ]))
                <!-- collapse menu -->
                <li class="nav-item accordion-item">
                    <a href="#" class="nav-link accordion-button collapsed <?php echo $userRole == 'Trainer' ? 'd-none' : ''; ?> " type="button"
                        data-bs-toggle="collapse" data-bs-target="#userCollapse">
                        <span class="material-symbols-rounded">
                            group
                        </span>
                        {{ __('sidemenu.user_management') }}
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
                @if (in_array($userRole, [
                        'SuperAdmin',
                        'superadmin',
                        'Admin',
                        'admin',
                        'DPD',
                        'dpd',
                        'Consultant',
                        'consultant',
                        'Minister',
                        'minister',
                        'uno',
                        'UNO',
                    ]))
                    <li class="nav-item accordion-item here menu-accordion <?php if ( Illuminate\Support\Facades\Route::is('divisions.index') || Illuminate\Support\Facades\Route::is('divisions.show') || Illuminate\Support\Facades\Route::is('districts.index') || Illuminate\Support\Facades\Route::is('districts.show')|| Illuminate\Support\Facades\Route::is('upazilas.index') || Illuminate\Support\Facades\Route::is('upazilas.show') || Illuminate\Support\Facades\Route::is('providers.index') || Illuminate\Support\Facades\Route::is('providers.show')|| Illuminate\Support\Facades\Route::is('provider.link-batch')) {?>here show<?php } ?>">
                        <a href="#" class="nav-link accordion-button <?php if (Illuminate\Support\Facades\Route::is('divisions.index') || Illuminate\Support\Facades\Route::is('divisions.show') || Illuminate\Support\Facades\Route::is('districts.index') || Illuminate\Support\Facades\Route::is('districts.show')|| Illuminate\Support\Facades\Route::is('upazilas.index') || Illuminate\Support\Facades\Route::is('upazilas.show') || Illuminate\Support\Facades\Route::is('providers.index') || Illuminate\Support\Facades\Route::is('providers.show')|| Illuminate\Support\Facades\Route::is('provider.link-batch')) {?>active<?php } ?>"
                            type="button" data-bs-toggle="collapse" data-bs-target="#settingsManagementCollapse">
                            <span class="material-symbols-rounded">
                                settings
                            </span>
                            {{ __('sidemenu.settings_management') }}
                        </a>
                        <div id="settingsManagementCollapse"
                            class="accordion-collapse collapse <?php if ( Illuminate\Support\Facades\Route::is('divisions.index') || Illuminate\Support\Facades\Route::is('divisions.show') || Illuminate\Support\Facades\Route::is('districts.index') || Illuminate\Support\Facades\Route::is('districts.show')|| Illuminate\Support\Facades\Route::is('upazilas.index') || Illuminate\Support\Facades\Route::is('upazilas.show') || Illuminate\Support\Facades\Route::is('providers.index') || Illuminate\Support\Facades\Route::is('providers.show')|| Illuminate\Support\Facades\Route::is('provider.link-batch')) {?>show<?php } ?>"
                            data-bs-parent="#sidebar-menu">
                            <div class="accordion-content">
                                <a href="{{ route('divisions.index') }}"
                                    class="nav-link sidebar-menu-link <?php if (Illuminate\Support\Facades\Route::is('divisions.index') || Illuminate\Support\Facades\Route::is('divisions.show')) { ?>active<?php } ?>">
                                    - {{ __('sidemenu.division_list') }}
                                </a>
                                <a href="{{ route('districts.index') }}"
                                    class="nav-link sidebar-menu-link <?php if (Illuminate\Support\Facades\Route::is('districts.index') || Illuminate\Support\Facades\Route::is('districts.show')) { ?>active<?php } ?>">
                                    - {{ __('sidemenu.district_list') }}
                                </a>
                                <a href="{{ route('upazilas.index') }}"
                                    class="nav-link sidebar-menu-link <?php if (Illuminate\Support\Facades\Route::is('upazilas.index') || Illuminate\Support\Facades\Route::is('upazilas.show')) { ?>active<?php } ?>">
                                    - {{ __('sidemenu.upazila_list') }}
                                </a>
                                <a href="{{ route('providers.index') }}"
                                    class="nav-link sidebar-menu-link <?php if (Illuminate\Support\Facades\Route::is('providers.index') || Illuminate\Support\Facades\Route::is('providers.show') || Illuminate\Support\Facades\Route::is('provider.link-batch')) { ?>active<?php } ?>">
                                    - {{ __('sidemenu.vendor') }}
                                </a>
                            </div>
                        </div>
                    </li>
                @endif

                @if (in_array('traineeEnroll.index', $roleRoutePermissions))
                    <!-- collapse menu -->
                    <li class="nav-item accordion-item">
                        <a href="#" class="nav-link accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#enrollmentCollapse">
                            <span class="material-symbols-rounded">
                                supervisor_account
                            </span>
                            {{ __('sidemenu.enrollment_management') }}
                        </a>
                        <div id="enrollmentCollapse" class="accordion-collapse collapse" data-bs-parent="#sidebar-menu">
                            <div class="accordion-content">
                                @if ($userRole == 'provider' || $userRole == 'Provider')
                                    @if (in_array('batches.index', $roleRoutePermissions))
                                        <a href="{{ route('batches.index') }}"
                                            class="nav-link {{ Illuminate\Support\Facades\Route::is('batches.index') ? 'active' : '' }}">
                                            - {{ __('sidemenu.trainer_enrollment') }}
                                        </a>
                                    @endif
                                @endif
                                <a href="{{ route('traineeEnroll.index') }}"
                                    class="nav-link {{ Illuminate\Support\Facades\Route::is('traineeEnroll.index') ? 'active' : '' }}">
                                    - {{ __('sidemenu.trainee_enrollment_list') }}
                                </a>
                                <a href="{{ route('trainerEnroll.index') }}"
                                    class="nav-link {{ Illuminate\Support\Facades\Route::is('trainerEnroll.index') ? 'active' : '' }}">
                                    - {{ __('sidemenu.trainer_enrollment_list') }}
                                </a>


                            </div>
                        </div>
                    </li>
                    <!-- End collapse menu -->
                @endif

                @if ($userRole == 'trainer' || $userRole == 'Trainer' || $userRole == 'provider' || $userRole == 'Provider')
                    @if (in_array('batches.index', $roleRoutePermissions) ||
                            in_array('attendance.batch-list', $roleRoutePermissions) ||
                            in_array('attendance.batch-list', $roleRoutePermissions))
                        <!-- collapse menu -->
                        <li class="nav-item accordion-item">
                            <a href="#" class="nav-link accordion-button collapsed" type="button"
                                data-bs-toggle="collapse" data-bs-target="#scheduleCollapse">
                                <span class="material-symbols-rounded">
                                    calendar_month
                                </span>
                                {{ __('sidemenu.schedule_management') }}
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

                                </div>
                            </div>
                        </li>
                        <!-- End collapse menu -->
                    @endif
                @endif
                @if ($userRole == 'provider' || $userRole == 'Provider')
                    @if (in_array('payment-batches.index', $roleRoutePermissions) ||
                            in_array('payment-batches.create', $roleRoutePermissions) ||
                            in_array('payment-batches.show', $roleRoutePermissions))
                        <li class="nav-item accordion-item">
                            <a href="#" class="nav-link accordion-button collapsed" type="button"
                                data-bs-toggle="collapse" data-bs-target="#collapseTraineeAllowance">
                                <span class="material-symbols-rounded">
                                    payments
                                </span>
                                {{ __('sidemenu.trainee_allowance') }}
                            </a>
                            <div id="collapseTraineeAllowance" class="accordion-collapse collapse"
                                data-bs-parent="#sidebar-menu">
                                <div class="accordion-content">
                                    <a href="{{ route('payment-batches.index') }}"
                                        class="nav-link{{ Route::is('payment-batches.index') || Route::is('payment-batches.show') || Route::is('payment-batches.create') ? ' active' : '' }}">
                                        -{{ __('sidemenu.all_payment') }}
                                    </a>
                                    <a href="{{ route('payment-batches.create') }}"
                                        class="nav-link{{ Route::is('payment-batches.index') || Route::is('payment-batches.show') || Route::is('payment-batches.create') ? ' active' : '' }}">
                                        -{{ __('sidemenu.make_payment') }}
                                    </a>
                                </div>
                            </div>
                        </li>
                    @endif
                @endif





                <!-- End collapse menu -->
            @endif






            <!--=============Newadmon=================-->

            @if (
                $userRole == 'SuperAdmin' ||
                    $userRole == 'superadmin' ||
                    $userRole == 'Admin' ||
                    $userRole == 'admin' ||
                    $userRole == 'DPD' ||
                    $userRole == 'dpd' ||
                    $userRole == 'DG' ||
                    $userRole == 'dg' ||
                    $userRole == 'Minister' ||
                    $userRole == 'minister' ||
                    $userRole == 'UNO' ||
                    $userRole == 'uno' ||
                    $userRole == 'Assistant Programmer' ||
                    $userRole == 'assistant programmer' ||
                    $userRole == 'DC' ||
                    $userRole == 'dc' ||
                    $userRole == 'PD' ||
                    $userRole == 'pd' ||
                    $userRole == 'Consultant' ||
                    $userRole == 'consultant' ||
                    $userRole == 'Programmer' ||
                    $userRole == 'programmer' ||
                    $userRole == 'Secretary' ||
                    $userRole == 'secretary' ||
                    $userRole == 'Divisional Commissioner' ||
                    $userRole == 'divisional commissioner')
                <li class="nav-item accordion-item">
                    <a href="#" class="nav-link accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#batchMonitoringCollapse">
                        <span class="material-symbols-rounded">
                            clinical_notes
                        </span>
                        {{ __('sidemenu.batch_monitoring') }}
                    </a>
                    <div id="batchMonitoringCollapse" class="accordion-collapse collapse" data-bs-parent="#sidebar-menu">
                        <a href="{{ route('dashboard_details.total_batches') }}"
                            class="nav-link{{ Illuminate\Support\Facades\Route::is('dashboard_details.total_batches') ? ' active' : '' }}">-
                            {{ __('sidemenu.all_batch_list') }}</a>
                    </div>
                </li>

                <li class="nav-item accordion-item">
                    <a href="#" class="nav-link accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseRunningBatches">
                        <span class="material-symbols-rounded">
                            change_circle
                        </span>
                        {{ __('sidemenu.running_batch') }}
                    </a>
                    <div id="collapseRunningBatches" class="accordion-collapse collapse" data-bs-parent="#sidebar-menu">
                        <div class="accordion-content">
                            <a href="{{ route('batch-schedule.runningBatches') }}"
                                class="nav-link{{ Illuminate\Support\Facades\Route::is('batch-schedule.runningBatches') ? ' active' : '' }}">
                                - {{ __('sidemenu.running_batch_list') }}
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
                        {{ __('sidemenu.inspection') }}
                    </a>
                    <div id="collapseInspection" class="accordion-collapse collapse" data-bs-parent="#sidebar-menu">
                        <div class="accordion-content">
                            <a href="{{ route('batch-schedule.running-class-list') }}"
                                class="nav-link{{ Illuminate\Support\Facades\Route::is('batch-schedule.running-class-list') ? ' active' : '' }}">
                                - {{ __('sidemenu.add_new_inspection') }}
                            </a>
                        </div>
                    </div>
                </li>


                <li class="nav-item accordion-item">
                    <a href="#" class="nav-link accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseReport">
                        <span class="material-symbols-rounded">
                            task
                        </span>
                        {{ __('sidemenu.report') }}
                    </a>
                    <div id="collapseReport" class="accordion-collapse collapse" data-bs-parent="#sidebar-menu">
                        <div class="accordion-content">
                            <a href="{{ route('inspaction.index') }}"
                                class="nav-link{{ Route::is('inspaction.index') || Route::is('tms-inspections.show') ? ' active' : '' }}">
                                - {{ __('sidemenu.inspection_report') }}
                            </a>
                        </div>
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
                        data-bs-target="#collapseTraineeAllowance">
                        <span class="material-symbols-rounded">
                            payments
                        </span>
                        {{ __('sidemenu.trainee_allowance') }}
                    </a>
                    <div id="collapseTraineeAllowance" class="accordion-collapse collapse" data-bs-parent="#sidebar-menu">
                        <div class="accordion-content">
                            <a href="{{ route('payment-batches.index') }}"
                                class="nav-link{{ Route::is('products.index') || Illuminate\Support\Facades\Route::is('products.create') || Illuminate\Support\Facades\Route::is('products.edit') ? ' active' : '' }}">-
                                {{ __('sidemenu.all_payment') }}</a>

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
                            <a href="{{ route('evaluate.trainee.batch-list') }}"
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
                    <a href="#"
                        class="nav-link show-loader{{ Illuminate\Support\Facades\Route::is('') ? ' active' : '' }}">
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
