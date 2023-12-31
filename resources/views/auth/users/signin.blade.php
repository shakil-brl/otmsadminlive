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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <title>OTMS Login</title>
    <style>
        #preloader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #000000b0;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
            backdrop-filter: blur(4px);
        }

        #body {
            display: none;
        }

        .hiddenDiv {
            display: none;
        }

        /* HTML: <div class="loader"></div> */
        .loader {
            --d: 22px;
            width: 4px;
            height: 4px;
            border-radius: 50%;
            color: #c5c5c5;
            box-shadow:
                calc(1*var(--d)) calc(0*var(--d)) 0 0,
                calc(0.707*var(--d)) calc(0.707*var(--d)) 0 1px,
                calc(0*var(--d)) calc(1*var(--d)) 0 2px,
                calc(-0.707*var(--d)) calc(0.707*var(--d)) 0 3px,
                calc(-1*var(--d)) calc(0*var(--d)) 0 4px,
                calc(-0.707*var(--d)) calc(-0.707*var(--d))0 5px,
                calc(0*var(--d)) calc(-1*var(--d)) 0 6px;
            animation: l27 1s infinite steps(8);
        }

        @keyframes l27 {
            100% {
                transform: rotate(1turn)
            }
        }
    </style>
</head>

<body>

    <div id="preloader" class="hiddenDiv">
        <div class="loader"></div>
    </div>
    <div id="body" style="background-image: url('{{ asset('img/login/placeholder.jpg') }}');">
        <div id="login-page">
            <header id="navbar">
                <nav class="navbar navbar-expand-md navbar-light ">
                    <a class="navbar-brand" href="{{ URL('/')}}">
                        <div class="d-flex align-items-center">
                            <div class="logo">
                                <img class="" src="{{ asset('img/login') }}/logo.svg" alt="">
                            </div>
                            <div class="govt-logo">
                                <img class="" src="{{ asset('img/login') }}/govt-logo.png" alt="">

                            </div>
                        </div>
                    </a>



                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav menu align-items-md-center ms-auto mb-2 mb-md-0">
                            <li class="nav-item lang dropdown">



                                @if (session()->get('locale') == 'en'|| empty(session()->get('locale')))


                                <a class="nav-link " href="{{ route('changeLang', ['lang' => 'bn']) }}" role="button">
                                    <img class="flag" src="{{ asset('img/login') }}/bd.svg" alt=""> <span
                                        class="label">বাংলা</span>
                                </a>
                                @else

                                <a class="nav-link " href="{{ route('changeLang', ['lang' => 'en']) }}" role="button">
                                    <img class="flag" src="{{ asset('img/login') }}/us.svg" alt=""> <span
                                        class="label">English</span>
                                </a>
                                @endif

                            </li>
                            <li class="nav-item auth">
                                <div class="nav-link pe-0">
                                    <div class="auth-panel d-md-block d-inline-block ">
                                        <a class="signup btn" href="https://training.gov.bd/signup">
                                           @lang('login.sign_up')
                                        </a>
                                        <a class="login btn active" href="#">
                                            @lang('login.logins')
                                        </a>
                                    </div>
                                </div>
                            </li>
                        </ul>

                    </div>
                </nav>
            </header>
            <div id="login-form">
                <div class="content">
                    <legend class=" fs-5 text-center font-weight-bold">@lang('login.sign_in')</legend>

                    @if(session('error'))
                    <div style="color: red;">
                        {{ session('error') }}
                    </div>
                    @endif

                    @if($errors->any())
                    <div style="color: rgb(255, 255, 255); ">
                        <ul>
                            @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif



                    <form action="{{ url('/get-token') }}" method="post">
                        @csrf

                        <div class="form-input">
                            <label for="emailid">@lang('login.email')</label>
                            <input name="email" id="emailid" type="text" class="form-control" placeholder="Enter Email">
                        </div>
                        <div class="form-input">
                            <div class="d-flex justify-content-between">
                                <label for="">@lang('login.password')</label>
                                <label for="">
                                    <a href="https://training.gov.bd/reset-password"
                                        class="forget">@lang('login.forgot_password')</a>
                                </label>
                            </div>
                            <div class="password">
                                <input id="password" name="password" type="password" class="form-control"
                                    placeholder="Enter Password">
                                <div class="icon">
                                    <span type="button" class="material-icons-outlined">
                                        visibility
                                    </span>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-submit" onclick="toggleDivVisibility()">@lang('login.login')</button>

                        <div class="account-create"> @lang('login.do_not_account') <a
                                href="https://training.gov.bd/signup">@lang('login.sign_up')</a></div>
                    </form>
                </div>
            </div>
            <footer id="footer">
                <div class="text-md-start left">
                    &copy;@lang('login.herpower_project')
                </div>
                <div class="text-center center">
                    <img class="govt-logo" src="{{ asset('img/login') }}/footer-logo.png" alt="">
                </div>
                <div class="text-md-end right">
                    @lang('login.ict_division')
                </div>
            </footer>
        </div>
    </div>


    <script src="{{ asset('assets/dist/assets/plugins/global/plugins.bundle.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/login') }}/js/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="{{ asset('assets/login') }}/js/bootstrap.bundle.min.js"></script>

    <script>
        $(".password .material-icons-outlined").click(function() {
            let input = $(this).parent().parent().children('input');
            let type = input.attr('type');
            if (type == 'password') {
                input.attr('type', 'text');
                $(this).html('visibility_off');
            } else {
                input.attr('type', 'password');
                $(this).html('visibility');
            }
        });
    </script>

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

        // script.js

document.addEventListener("DOMContentLoaded", function () {
    // Hide the preloader
    document.getElementById("preloader").style.display = "none";

    // Show the page content
    document.getElementById("body").style.display = "flex";
});


function toggleDivVisibility() {
  var myDiv = document.getElementById("preloader");

  // Toggle the visibility of the div
  if (myDiv.style.display === "none" || myDiv.style.display === "") {
    myDiv.style.display = "flex";
  } else {
    myDiv.style.display = "none";
  }
}


    </script>

</body>

</html>