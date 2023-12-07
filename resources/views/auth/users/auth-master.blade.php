<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('img/logo-icon.svg') }}" type="image/x-icon">
    <link
        href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/dist/assets/plugins/global/plugins.bundle.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/login') }}/css/bootstrap.css">
    <link rel="stylesheet" href="{{ asset('assets/login') }}/css/main.css">
    <style>
        #lang:hover .dropdown-menu {
            display: block;
        }
    </style>
    <title>OTMS Login</title>
</head>

<body>
    <div class="d-flex flex-column justify-content-between min-vh-100">
        <header id="navbar">
            <div class="container">
                <nav class="navbar navbar-expand-lg navbar-light ">
                    <a class="navbar-brand" href="#">
                        <img class="logo" src="{{ asset('img/logo.svg') }}" alt="">
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav menu align-items-md-center ms-auto mb-2 mb-md-0">
                            <li class="nav-item lang dropdown" id="lang">
                                <a class="nav-link  dropdown-toggle" role="button" data-bs-toggle="dropdown">
                                    @if (session()->get('locale') == 'en')
                                    <img class="flag" src="{{ asset('img/icon/us.svg') }}" alt=""> <span
                                        class="label">English</span>
                                    @elseif(session()->get('locale') == 'bn')
                                    <img class="flag" src="{{ asset('img/icon/bd.svg') }}" alt=""> <span
                                        class="label">বাংলা</span>
                                    @else
                                    <img class="flag" src="{{ asset('img/icon/us.svg') }}" alt=""> <span
                                        class="label">English</span>
                                    @endif
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="item">
                                        <a class="dropdown-item" href="#" id="lang-bd">
                                            <img class="flag" src="{{ asset('img/icon/bd.svg') }}" alt="">
                                            <span class="label">বাংলা</span>
                                        </a>
                                    </li>
                                    <li class="item">
                                        <a class="dropdown-item" href="#" id="lang-us">
                                            <img class="flag" src="{{ asset('img/icon/us.svg') }}" alt="">
                                            <span class="label">English</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="nav-item auth">
                                <div class="nav-link">
                                    <div class="auth-panel d-md-block d-inline-block ">
                                        <a class="signup btn" href="https://training.gov.bd/signup">
                                            {{ __('login.sign_up') }}
                                        </a>
                                        <a class="login btn active" href="{{ url('login') }}">
                                            {{ __('login.sign_in') }}
                                        </a>
                                    </div>
                                </div>
                            </li>
                        </ul>

                    </div>
                </nav>
            </div>
        </header>

        <section id="login-panel">
            <div class="container">
                <div class="content">
                    @yield('content')
                </div>
            </div>
        </section>

        <footer id="footer">
            <div class="container">
                <div class="content">
                    <div class="copyright">
                        &copy; 2023 Her Power.
                    </div>

                    <div class="social">
                        <a href="" class="social-link">
                            <img src="{{ asset('assets/login') }}/img/linkedin.svg" alt="">
                        </a>
                        <a href="" class="social-link">
                            <img src="{{ asset('assets/login') }}/img/x.svg" alt="">
                        </a>
                        <a href="" class="social-link">
                            <img src="{{ asset('assets/login') }}/img/facebook.svg" alt="">
                        </a>
                        <a href="" class="social-link">
                            <img src="{{ asset('assets/login') }}/img/youtube.svg" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </footer>
    </div>


    <script src="{{ asset('assets/dist/assets/plugins/global/plugins.bundle.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/login') }}/js/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="{{ asset('assets/login') }}/js/bootstrap.bundle.min.js"></script>

    <script type="text/javascript" src="{{ asset('assets/dist/assets/js/custom/call.api.js') }}"></script>
    <script>
        let title = "{{ __('register.are_you') }}";
        let text = "{{ __('register.submit_form') }}";
        let confirmButtonText = "{{ __('register.yes_submitted') }}";
        let cancelButtonText = "{{ __('register.cancel_button') }}";
        let admin_baseurl = '{{ route('home.index') }}';
        let api_baseurl = '{{ config('app.api_url') }}';
        let authToken = localStorage.getItem('authToken');
        let language = "{{ session()->get('locale') }}";

        if (window.location.pathname == '/login' || window.location.pathname == '/register') {

            if (authToken != null) {
                window.open('/dashboard', '_self')
            }
        }

        let url = "{{ route('changeLang') }}";

        function changeLocale(lang) {
            let url_link = api_baseurl + "language";
            $.ajax({
                type: "get",
                url: url_link,
                headers: {
                    'X-localization': lang
                },
                data: {},
                dataType: "JSON",
                success: function(results) {
                    if (results.success === true) {
                        console.log(results.message);
                    } else {
                        // swal.fire("Error!", results.message, "error");
                    }
                },
                error: function(response) {
                    // alert(response);
                },
            });
            window.location.href = url + "?lang=" + lang;
        }
        $("#lang-bd").click(function() {
            changeLocale('bn');
        });
        $("#lang-us").click(function() {
            changeLocale('en');
        });
    </script>
</body>

</html>