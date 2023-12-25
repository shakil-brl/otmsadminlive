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
        /* styles.css */

        #preloader {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #000000b0;
            /* Set the background color of your preloader */
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
            /* Set a high z-index to make sure it's on top of other elements */
        }


        #body {
            display: none;
            /* Hide the page content by default */
        }

        .hiddenDiv {
            display: none;
            /* Add any additional styling for the hidden div */
        }


        /* HTML: <div class="loadernew"></div> */
        .loadernew {
            width: 50px;
            aspect-ratio: 1;
            display: grid;
            border: 4px solid #0000;
            border-radius: 50%;
            border-color: #ccc #0000;
            animation: l16 1s infinite linear;
        }

        .loadernew::before,
        .loadernew::after {
            content: "";
            grid-area: 1/1;
            margin: 2px;
            border: inherit;
            border-radius: 50%;
        }

        .loadernew::before {
            border-color: #f03355 #0000;
            animation: inherit;
            animation-duration: .5s;
            animation-direction: reverse;
        }

        .loadernew::after {
            margin: 8px;
        }

        @keyframes l16 {
            100% {
                transform: rotate(1turn)
            }
        }
    </style>
</head>

<body>

    <div id="preloader" class="hiddenDiv">
        <div class="loadernew"></div>
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
                                            Sign Up
                                        </a>
                                        <a class="login btn active" href="#">
                                            Login
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
                    <legend class="title">@lang('login.login')</legend>
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
                    &copy;২০২৩ হার পাওয়ার প্রজেক্ট
                </div>
                <div class="text-center center">
                    <img class="govt-logo" src="{{ asset('img/login') }}/footer-logo.png" alt="">
                </div>
                <div class="text-md-end right">
                    তথ্য ও যোগাযোগ প্রযুক্তি বিভাগ
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