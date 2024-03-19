<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Training Management System</title>
    {{--
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined:opsz,wght,FILL,GRAD@48,700,0,0" /> --}}
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20,400,0,0" />
    <link rel="shortcut icon" href="{{ asset('img/logo-icon.svg') }}" type="image/x-icon">
    <link rel="preload" href="{{ asset('/newstyle/css/bootstrap.min.css') }}" as="style"
        onload="this.onload=null;this.rel='stylesheet'">
    <link rel="preload" href="{{ asset('/newstyle/scss/main.css') }}" as="style"
        onload="this.onload=null;this.rel='stylesheet'">
    <link rel="stylesheet" href="{{ asset('css/new_dashboard/dashboard.css?v=1') }}" as="style"
        onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link title="No scr" rel="stylesheet" href="{{ asset('/newstyle/css/bootstrap.min.css') }}">
        <link title="No scr" rel="stylesheet" href="{{ asset('/newstyle/scss/main.css') }}">
        <link title="No scr" rel="stylesheet" href="{{ asset('css/new_dashboard/dashboard.css?v=1') }}">
    </noscript>

</head>

<body>
    <section id="admin">
        <section id="sidebar">
            <div class="top">
                <div class="logo">
                    <a href="{{ url('/') }}">
                        <img load="lazy" src="{{ asset('newstyle/img/logo.svg') }}" alt="">
                    </a>
                </div>
            </div>
            @include('auth.partials.sidebar-new')
        </section>
        <section id="right">
            <div class="backdrop overlay"></div>
            <div class="topnav" id="top-nav">
                <div class="d-flex justify-content-between align-items-center h-100">
                    <div class="left">
                        <img load="lazy" class="govt-logo menu-click" type="button"
                            src="{{ asset('newstyle/img/govt-logo.png') }}" alt="">
                    </div>
                    <div class="right">
                        <div class="nav-item lang" id="lang-menu">
                            <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown">
                                @if (session()->get('locale') == 'en')
                                <img load="lazy" class="flag" src="{{ asset('img/icon/us.svg') }}" alt="">
                                <span class="label dropdown-toggle">English</span>
                                @elseif(session()->get('locale') == 'bn')
                                <img load="lazy" class="flag" src="{{ asset('img/icon/bd.svg') }}" alt="">
                                <span class="label dropdown-toggle">বাংলা</span>
                                @else
                                <img load="lazy" class="flag" src="{{ asset('img/icon/us.svg') }}" alt="">
                                <span class="label dropdown-toggle">English</span>
                                @endif
                            </a>
                            <ul class="dropdown-menu">
                                <li class="item">
                                    <a class="dropdown-item" id="lang-bd">
                                        <img load="lazy" class="flag" src="{{ asset('img/icon/bd.svg') }}" alt="">
                                        <span class="label">বাংলা</span>
                                    </a>
                                </li>
                                <li class="item">
                                    <a class="dropdown-item" id="lang-us">
                                        <img load="lazy" class="flag" src="{{ asset('img/icon/us.svg') }}" alt="">
                                        <span class="label">English</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="userinfo" id="logout-panel">
                            <div class="dropdown">
                                <div class="" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <div class="d-inline-flex align-items-center">
                                        <div class="avatar">
                                            <img load="lazy" class="photo d-none"
                                                src="{{ asset('assets/dist/assets/media/svg/avatars/blank.svg') }}"
                                                alt="">
                                        </div>
                                        <div class="name">{{ $authProfile['KnownAs'] ?? '' }}</div>
                                        <span class="material-symbols-rounded">
                                            expand_more
                                        </span>
                                    </div>
                                </div>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <div class="identity">
                                        <div>
                                            <img load="lazy" class="photo user-face d-none"
                                                src="{{ asset('assets/dist/assets/media/svg/avatars/blank.svg') }}"
                                                alt="{{ $role }}" title="{{ $role }}">
                                            <div class="avatar user-face">M</div>
                                        </div>
                                        <div>
                                            <div class="name" title="{{ $userRole }}">
                                                {{ $authProfile['KnownAs'] ?? '' }}</div>
                                            <div class="email">{{ $authProfile['Email'] ?? '' }}</div>
                                        </div>
                                    </div>
                                    {{-- <div class="links">
                                        <a href="" class="link">
                                            <span class="material-icons-outlined">person</span>
                                            My Profile
                                        </a>
                                        <a href="" class="link">
                                            <span class="material-icons-outlined">translate</span>
                                            Language: English(US)
                                        </a>
                                        <a href="" class="link">
                                            <span class="material-icons-outlined">settings</span>
                                            Settings
                                        </a>
                                        <a href="" class="link">
                                            <span class="material-icons-outlined">help_outline</span>
                                            Help
                                        </a>
                                        <a href="" class="link">
                                            <span class="material-icons-outlined">feedback</span>
                                            Send Feedback
                                        </a>
                                    </div> --}}
                                    <div class="logout">
                                        <form action="{{ url('/logout') }}" method="POST">
                                            @csrf
                                            <button class="btn logout-btn">
                                                <span class="material-symbols-rounded">
                                                    logout
                                                </span>
                                                {{ __('dashboard-header.sign_out') }}
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="main-content">
                <div class="page-content">
                    <div class="row g-4 row-cols-3 cards" id="dashboard-card">


                        @if (in_array('dashboard_details.total_batches', $roleRoutePermissions))
                        <div>
                            <a href="{{ route('dashboard_details.total_batches') }}"
                                class="card-item purple text-decoration-none show-loader">
                                <div class="icon">
                                    <img load="lazy" src="{{ asset('img/new_icon/total_batch.png') }}" alt="">
                                </div>
                                <div>
                                    <div class="digit total_batches_100">
                                        {{-- <div class="spinner-grow spinner-grow-sm" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div> --}}

                                        1213

                                    </div>
                                    <div class="label">{{ __('dashboard.total_batch') }}</div>
                                </div>
                            </a>
                        </div>
                        @endif
                        @if (in_array('dashboard_details.running_batches', $roleRoutePermissions))
                        <div>
                            <a href="{{ route('dashboard_details.running_batches') }}"
                                class="card-item yellow text-decoration-none show-loader">
                                <div class="icon">
                                    <img load="lazy" src="{{ asset('img/new_icon/current_batch.png') }}" alt="">
                                </div>
                                <div>
                                    <div class="digit running_batches">
                                        <div class="spinner-grow spinner-grow-sm" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </div>
                                    <div class="label">{{ __('dashboard.running_batch') }}</div>
                                </div>
                            </a>
                        </div>
                        @endif

                        @if (in_array('dashboard_details.complete_batches', $roleRoutePermissions))
                        <div>
                            <a href="{{ route('dashboard_details.complete_batches') }}"
                                class="card-item green text-decoration-none show-loader">
                                <div class="icon">
                                    <img load="lazy" src="{{ asset('img/new_icon/completed_batch.png') }}" alt="">
                                </div>
                                <div>
                                    <div class="digit completed_batch">
                                        <div class="spinner-grow spinner-grow-sm" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </div>
                                    <div class="label">{{ __('dashboard.complete_batch') }}</div>
                                </div>
                            </a>
                        </div>
                        @endif



                        @if (in_array('dashboard_details.ongoing_classes', $roleRoutePermissions))
                        <div><a href="{{ route('dashboard_details.ongoing_classes', ['status' => 2]) }}"
                                class="card-item red text-decoration-none show-loader">
                                <div class="icon">
                                    <img load="lazy" src="{{ asset('img/new_icon/livestrem.gif') }}" alt="">
                                </div>
                                <div>
                                    <div class="digit ongoing_class">
                                        <div class="spinner-grow spinner-grow-sm" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </div>
                                    <div class="label">{{ __('dashboard.ongoing_class') }}</div>
                                </div>
                            </a>
                        </div>
                        @endif
                        @if (in_array('dashboard_details.complete_classes', $roleRoutePermissions))
                        <div>
                            <a href="{{ route('dashboard_details.ongoing_classes', ['status' => 3]) }}"
                                class="card-item green text-decoration-none show-loader">
                                <div class="icon">
                                    <img load="lazy" src="{{ asset('img/new_icon/completedclass.png') }}" alt="">
                                </div>
                                <div>
                                    <div class="digit complete_class">
                                        <div class="spinner-grow spinner-grow-sm" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </div>
                                    <div class="label">{{ __('dashboard.complete_class') }}</div>
                                </div>
                            </a>
                        </div>
                        @endif


                        @if (in_array('dashboard_details.districts', $roleRoutePermissions))
                        <div>
                            <a href="{{ route('dashboard_details.districts') }}"
                                class="card-item green-white text-decoration-none show-loader">
                                <div class="icon">
                                    <img load="lazy" src="{{ asset('img/new_icon/district.png') }}" alt="">
                                </div>
                                <div>
                                    <div class="digit total_district_100">
                                        {{-- <div class="spinner-grow spinner-grow-sm" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div> --}}
                                        44
                                    </div>
                                    <div class="label">{{ __('dashboard.district') }}</div>
                                </div>
                            </a>
                        </div>
                        @endif

                        @if (in_array('dashboard_details.upazilas', $roleRoutePermissions))
                        <div>
                            <a href="{{ route('dashboard_details.upazilas') }}"
                                class="card-item info text-decoration-none show-loader">
                                <div class="icon">
                                    <img load="lazy" src="{{ asset('img/new_icon/upazila.png') }}" alt="">
                                </div>
                                <div>
                                    <div class="digit total_upazila_100">
                                        {{-- <div class="spinner-grow spinner-grow-sm" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div> --}}
                                        130
                                    </div>
                                    <div class="label">{{ __('dashboard.upazila') }}</div>
                                </div>
                            </a>
                        </div>
                        @endif
                        @if (in_array('dashboard_details.partners', $roleRoutePermissions))
                        <div>
                            <a href="{{ route('dashboard_details.partners') }}"
                                class="card-item red text-decoration-none show-loader">
                                <div class="icon">
                                    <img load="lazy" src="{{ asset('img/new_icon/developmentpartner.png') }}" alt="">
                                </div>
                                <div>
                                    <div class="digit total_vendor">
                                        <div class="spinner-grow spinner-grow-sm" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </div>
                                    <div class="label">{{ __('dashboard.partner') }}</div>
                                </div>
                            </a>
                        </div>
                        @endif

                        @if (in_array('dashboard_details.partners', $roleRoutePermissions))
                        <div>
                            <a href="{{ route('dashboard_details.ongoing_classes', ['status' => '']) }}"
                                class="card-item red text-decoration-none show-loader">
                                <div class="icon">
                                    <img load="lazy" src="{{ asset('img/new_icon/developmentpartner.png') }}" alt="">
                                </div>
                                <div>
                                    <div class="digit todays_total_schedule">
                                        <div class="spinner-grow spinner-grow-sm" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </div>
                                    <div class="label">{{ __('dashboard.todays_class') }}</div>
                                </div>
                            </a>
                        </div>
                        @endif


                    </div>

                    @php
                    $permissionsToCheck = ['dashboard.total_present', 'dashboard.average_attendance',
                    'dashboard.dropout_trainee'];
                    $commonPermissions = array_intersect($permissionsToCheck, $roleRoutePermissions);
                    @endphp
                    @if (!empty($commonPermissions))
                    <div id="dashboard-attendance">
                        <div class="row align-items-stretch">
                            <div class="col-7">
                                <div id="attendance-summery">
                                    <div class="header">
                                        <div class="left menu">
                                            <a class="link active" href="#">{{ __('dashboard.todays') }}</a>
                                            <a class="link" href="#">{{ __('dashboard.weekly') }}</a>
                                            <a class="link" href="#">{{ __('dashboard.monthly') }}</a>
                                        </div>
                                        <div class="right menu">
                                            <a class="link" href="#">{{ __('dashboard.details') }}</a>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="content">
                                            <div class="icon">
                                                <img src="{{ asset('img/new_icon') }}/attendance.png" alt="">
                                            </div>
                                            <div class="attendance">
                                                <div class="items">
                                                    @if (in_array('dashboard.total_present', $roleRoutePermissions))
                                                    <div class="item">
                                                        <div class="digit">
                                                            {{ isset($data['total_attend_today']) ?
                                                            digitLocale($data['total_attend_today']) : digitLocale(0) }}
                                                        </div>
                                                        <div class="label">
                                                            {{ __('dashboard.total_present') }}
                                                        </div>
                                                    </div>
                                                    @endif
                                                    <div class="item">
                                                        {{-- <div class="digit">66%</div>
                                                        <div class="label">{{ __('dashboard.percentage_attendance') }}
                                                        </div> --}}
                                                    </div>
                                                </div>
                                                <div class="items">
                                                    @if (in_array('dashboard.average_attendance',
                                                    $roleRoutePermissions))
                                                    <div class="item">
                                                        <div class="digit total_trainee">

                                                        </div>
                                                        <div class="label">
                                                            {{ __('dashboard.average_attendance') }}
                                                        </div>
                                                    </div>
                                                    @endif
                                                    @if (in_array('dashboard.dropout_trainee', $roleRoutePermissions))
                                                    <div class="item">
                                                        <div class="digit total_dropout">

                                                        </div>
                                                        <div class="label">
                                                            {{ __('dashboard.dropout_trainee') }}
                                                        </div>
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-5">
                                <div id="attendance-chart" class="h-100 d-none">
                                    <div class="chart-item">
                                        <div class="bar" style="height: 70%;">
                                            {{-- <span class="bar-text">75%</span> --}}
                                        </div>
                                        <div class="label">{{ __('dashboard.class_day_sat') }}</div>
                                    </div>
                                    <div class="chart-item">
                                        <div class="bar danger" style="height: 0%;">
                                            {{-- <span class="bar-text">25%</span> --}}
                                        </div>
                                        {{-- <div class="label">{{ __('dashboard.class_day_sun') }}</div> --}}
                                    </div>
                                    <div class="chart-item">
                                        <div class="bar" style="height: 95%;">
                                            <span class="bar-text">100%</span>
                                        </div>
                                        <div class="label">{{ __('dashboard.class_day_mon') }}</div>
                                    </div>
                                    <div class="chart-item">
                                        <div class="bar" style="height: 35%;">
                                            <span class="bar-text">35%</span>
                                        </div>
                                        <div class="label">{{ __('dashboard.class_day_tue') }}</div>
                                    </div>
                                    <div class="chart-item">
                                        <div class="bar" style="height: 90%;">
                                            <span class="bar-text">100%</span>
                                        </div>
                                        <div class="label">{{ __('dashboard.class_day_wed') }}</div>
                                    </div>
                                    <div class="chart-item">
                                        <div class="bar" style="height: 50%;">
                                            <span class="bar-text">55%</span>
                                        </div>
                                        <div class="label">{{ __('dashboard.class_day_thu') }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    <div id="allownce">
                        <div class="row  align-items-stretch">
                            @php
                            $permissionsToCheck = ['dashboard_details.trainers', 'traineeEnroll.index'];

                            $commonPermissions = array_intersect($permissionsToCheck, $roleRoutePermissions);
                            @endphp
                            @if (!empty($commonPermissions))
                            <div class="col-7">
                                @if (in_array('dashboard_details.trainers', $roleRoutePermissions))
                                <a href="{{ route('dashboard_details.trainers') }}" class="text-decoration-none">
                                    <div class="trainer-info">
                                        <div id="attendance-summery">
                                            <div>
                                                <div class="content">
                                                    <div class="icon">
                                                        <img src="{{ asset('img/new_icon') }}/trainer.png" alt="">
                                                    </div>
                                                    <div class="attendance">
                                                        <div class="items">
                                                            <div class="item">
                                                                <div class="digit total_trainer">

                                                                </div>
                                                                <div class="label">
                                                                    {{ __('dashboard.total_trainer') }}
                                                                </div>
                                                            </div>
                                                            <div class="item">
                                                                <div class="digit " title="total_attend_month"></div>
                                                                <div class="label">

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="items">
                                                            {{-- <div class="item">
                                                                <div class="digit">20000</div>
                                                                <div class="label">
                                                                    {{ __('dashboard.reserve_trainer') }}
                                                                </div>
                                                            </div> --}}
                                                            {{-- <div class="item">
                                                                <div class="digit">7</div>
                                                                <div class="label">{{ __('dashboard.lack_trainer') }}
                                                                </div>
                                                            </div> --}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                @endif
                                @if (in_array('traineeEnroll.index', $roleRoutePermissions))
                                <a href="{{ route('traineeEnroll.index') }}" class="text-decoration-none">
                                    <div class="student-info">
                                        <div id="attendance-summery">
                                            <div>
                                                <div class="content">
                                                    <div class="icon">
                                                        <img src="{{ asset('img/new_icon') }}/student_info.png" alt="">
                                                    </div>
                                                    <div class="attendance">
                                                        <div class="items">
                                                            <div class="item">
                                                                <div class="digit total_trainee">

                                                                </div>
                                                                <div class="label">
                                                                    {{ __('dashboard.total_trainee') }}
                                                                </div>
                                                            </div>

                                                            <div class="item">
                                                                <div class="digit ">

                                                                </div>
                                                                <div class="label">

                                                                    {{-- {{ __('dashboard.dropout_trainee') }} --}}
                                                                </div>
                                                                {{-- <div class="digit">66%</div>
                                                                <div class="label">
                                                                    {{ __('dashboard.successful_freelancer') }}</div>
                                                                --}}
                                                            </div>
                                                        </div>

                                                        {{-- <div class="items">
                                                            <div class="item">
                                                                <div class="digit">{{ $data['total_dropout']}}</div>
                                                                <div class="label">
                                                                    {{ __('dashboard.dropout_trainee') }}
                                                                </div>
                                                            </div>
                                                        </div> --}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                @endif
                            </div>
                            @endif

                            @php
                            $permissionsToCheck = ['traineeEnroll.index'];
                            $commonPermissions = array_intersect($permissionsToCheck, $roleRoutePermissions);
                            @endphp
                            @if (!empty($commonPermissions))
                            <div class="col-5">
                                <div id="py-chart" class="">
                                    <div id="attendance-summery">
                                        <div>
                                            <div class="content">
                                                <div class="icon">
                                                    <img src="{{ asset('img/new_icon') }}/alownce.png" alt="">
                                                </div>
                                                <div class="attendance">
                                                    <div class="items d-block">
                                                        <div class="item">
                                                            <div class="digit total_allownce_paid"></div>
                                                            <div class="digit total_allownce_remaining"></div>
                                                            <div class="label">Alownce
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div>
                                                <canvas id="allownceChart"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>


                </div>
            </div>
            <footer id="footer">
                <div class="left">©২০২৩ হার পাওয়ার প্রজেক্ট</div>
                <div class="center"><img load="lazy" src="{{ asset('newstyle/img/footer-logo.png') }}" alt=""></div>
                <div class="right">তথ্য ও যোগাযোগ প্রযুক্তি বিভাগ</div>
            </footer>
        </section>
    </section>
    <script defer src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script defer src="{{ asset('/newstyle/js/bootstrap.bundle.min.js') }}"></script>
    <script defer src="{{ asset('/newstyle/js/admin.js') }}"></script>
    <script defer>
        if (sessionStorage.getItem('message')) {
            var type = sessionStorage.getItem('alert-type');
            switch (type) {
                case 'info':
                    toastr.info(sessionStorage.getItem('message'));
                    break;
            }
        }
        let admin_baseurl = '{{ route('home.index') }}';
        let api_baseurl = '{{ config('app.api_url') }}';
        let api_assets_baseurl = '{{ config('app.api_asset_url') }}';
        let url = "{{ route('changeLang') }}";
        let language = "{{ session()->get('locale') }}";
        let selectDivision = "{{ __('district-list.select_division') }}";
        let selectCourseCategory = "{{ __('sub-categorie-list.select_category') }}";
        let selectDistrict = "{{ __('upazila-list.select_district') }}";

        function changeLocale(lang) {
            sessionStorage.setItem('locale', lang);
            window.location.href = "{{ route('changeLang') }}?lang=" + lang;
        }

        // Event listeners for language change
        document.getElementById('lang-bd').addEventListener('click', function() {
            changeLocale('bn');
        });
        document.getElementById('lang-us').addEventListener('click', function() {
            changeLocale('en');
        });



        // Define your Bearer token
        const bearerToken = `{{ Session::get('access_token.access_token') }}`;
        // Make API request for dashboard total
        fetch(api_baseurl + 'dashboardtotal/superadmin', {
                headers: {
                    'Authorization': `Bearer ${bearerToken}`
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                // Check if the response indicates success
                if (data.success !== true) {
                    throw new Error('Unauthorized');
                }
                // Render the dashboard with the retrieved data
                renderDashboard(data);
            })
            .catch(error => {
                console.error('Error:', error);
                // Handle errors (e.g., unauthorized, network errors)
                handleError(error);
            });
        // Function to render the dashboard
        function renderDashboard(data) {
            // Render the dashboard with the retrieved data
             //console.log('Data:', data.data);
        $('.total_batches').text(data.data.total_batch ?? 0);
        $('.running_batches').text(data.data.running_batch ?? 0);
        $('.completed_batch').text(data.data.completed_batch ?? 0);
        $('.complete_class').text(data.data.complete_class ?? 0);
        $('.total_district').text(data.data.total_district ?? 0);
        $('.total_division').text(data.data.total_division ?? 0);
        $('.total_upazila').text(data.data.total_upazila ?? 0);
        $('.total_vendor').text(data.data.total_vendor ?? 0);
        $('.todays_total_schedule').text(data.data.todays_total_schedule ?? 0);
        $('.total_attend_today').text(data.data.total_attend_today ?? 0);
        $('.total_trainee').text(data.data.total_trainee ?? 0);
        $('.total_trainer').text(data.data.total_trainer ?? 0);
        $('.total_attend_month').text(data.data.total_attend_month ?? 0);
        $('.total_allownce_paid').text(data.data.total_allownce_paid ?? 0);

            // $('.todays_total_schedule').text(data.data.todays_total_schedule);
            // $('.todays_total_schedule').text(data.data.todays_total_schedule);


            const ongoing_classes = data.data.running_class.filter(classObj => classObj.status === 2);

if (ongoing_classes.length > 0) {
    $('.ongoing_class').text(ongoing_classes[0].total ?? 0);
} else {
    $('.ongoing_class').text(0);
}
            
        }
        // Function to handle errors
        function handleError(error) {
            // Handle errors (e.g., display error message to user)
            console.error('Error:', error);
        }
    </script>
</body>

</html>