<section id="sidebar">
    <div class="top">
        <div class="logo">
            <a href="#">
                <img src="{{ asset('front') }}/img/logo.svg" alt="">
            </a>
        </div>
    </div>
    <ul class="list-unstyled m-0 menu accordion" id="sidebar-menu">
        <li class="nav-item">
            <a href="#" class="nav-link">
                <span class="material-icons-outlined">
                    grid_view
                </span>
                Dashboard
            </a>
        </li>
        @php
        $routeNames = [
        'development-partner',
        'development-partner-empoly',
        'geodistrict',
        'geodivision',
        'geoupazilas',
        'profile',
        'tms-batch-schedule-detail',
        'tms-categorie',
        'class-attendance',
        'class-document',
        'tms-course',
        'evaluation-student',
        'evaluation-for-trainer',
        'tms-holly-day',
        'tms-inspections',
        'role-permision',
        'provider',
        'providers-batche',
        'providers-trainer',
        'role',
        'batch-schedule',
        'user-type',
        'trainer-profile',
        'training-applicant',
        'training-batche',
        'training-title',
        'batch-group',
        ];
        @endphp
        //@php
        // $routeIcons = [
        // 'development-partner' => 'building',
        // 'development-partner-empoly' => 'users',
        // 'geodistrict' => 'map-marker',
        // 'geodivision' => 'map',
        // 'geoupazilas' => 'map-signs',
        // 'profile' => 'user',
        // 'tms-batch-schedule-detail' => 'calendar-alt',
        // 'tms-categorie' => 'folder',
        // 'class-attendance' => 'clipboard-list',
        // 'class-document' => 'file-alt',
        // 'tms-course' => 'book',
        // 'evaluation-student' => 'user-check',
        // 'evaluation-for-trainer' => 'user-tie',
        // 'tms-holly-day' => 'glass-cheers',
        // 'tms-inspections' => 'clipboard-check',
        // 'role-permision' => 'shield-alt',
        // 'provider' => 'industry',
        // 'providers-batche' => 'users-cog',
        // 'providers-trainer' => 'user-cog',
        // 'role' => 'user-lock',
        // 'batch-schedule' => 'calendar-week',
        // 'user-type' => 'users',
        // 'trainer-profile' => 'user-tie',
        // 'training-applicant' => 'user-clock',
        // 'training-batche' => 'users',
        // 'training-title' => 'certificate',
        // 'batch-group' => 'users-class',
        // ];
        // @endphp
        @foreach ($routeNames as $routeName)
        <li class="nav-item">
            <a href="{{ route($routeName . '.index') }}"
                class="nav-link {{ request()->routeIs($routeName . '*') ? 'active' : '' }}">
                <span class="material-icons-outlined">
                    dynamic_form
                </span>
                {{ ucfirst(str_replace('-', ' ', $routeName)) }}
            </a>
        </li>
        @endforeach

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
        <!-- End collapse menu -->

    </ul>
</section>