<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Training Management System</title>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined:opsz,wght,FILL,GRAD@48,700,0,0" />
    <link rel="shortcut icon" href="img/favicon.png" type="image/png">
    <link rel="preload" href="{{ asset('/newstyle/css/bootstrap.min.css') }}" as="style"
        onload="this.onload=null;this.rel='stylesheet'">
    <link rel="preload" href="{{ asset('/newstyle/scss/main.css') }}" as="style"
        onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link rel="stylesheet" href="{{ asset('/newstyle/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('/newstyle/scss/main.css') }}">
    </noscript>
</head>

<body>
    <section id="admin">
        <section id="sidebar">
            <div class="top">
                <div class="logo">
                    <a href="{{ url('/') }}">
                        <img load="lazy" src="{{ asset('newstyle/img/logo.svg')}}" alt="">
                    </a>
                </div>
            </div>
            @include('auth.partials.sidebar')
        </section>
        <section id="right">
            <div class="backdrop overlay"></div>
            <div class="topnav" id="top-nav">
                <div class="d-flex justify-content-between align-items-center h-100">
                    <div class="left">
                        <img load="lazy" class="govt-logo menu-click" type="button"
                            src="{{ asset('newstyle/img/govt-logo.png')}}" alt="">
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
                                        <span class="material-icons-outlined">expand_more</span>
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
                                            <div class="name" title="{{ $userRole }}">{{ $authProfile['KnownAs'] ?? ''
                                                }}</div>
                                            <div class="email">{{ $authProfile['Email'] ?? '' }}</div>
                                        </div>
                                    </div>
                                    <div class="links">
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
                                    </div>
                                    <div class="logout">
                                        <form action="{{ url('/logout') }}" method="POST">
                                            @csrf
                                            <button class="btn logout-btn">
                                                <span class="material-icons-outlined">logout</span>
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
                        <div>
                            <a href="{{ route('dashboard_details.ongoing_classes', ['status' => 3])}}"
                                class="card-item green-white show-loader">
                                <div class="icon">
                                    <img load="lazy" src="{{asset('img/new_icon/completedclass.png')}}" alt="">
                                </div>
                                <div>
                                    <div class="digit complete_class"></div>
                                    <div class="label">{{ __('dashboard.complete_class') }}</div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <footer id="footer">
                <div class="left">©২০২৩ হার পাওয়ার প্রজেক্ট</div>
                <div class="center"><img load="lazy" src="{{ asset('newstyle/img/footer-logo.png')}}" alt=""></div>
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
            console.log('Data:', data.data);
            $('.complete_class').text(data.data.complete_class);
            // Implement rendering logic here (e.g., update DOM elements)
        }
        // Function to handle errors
        function handleError(error) {
            // Handle errors (e.g., display error message to user)
            console.error('Error:', error);
        }

       
  

    </script>
</body>

</html>