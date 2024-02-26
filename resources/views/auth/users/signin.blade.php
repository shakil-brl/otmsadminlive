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
        rel="stylesheet" defer>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" defer>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}" defer>
    <title>OTMS Login</title>
</head>

<body>
    <div id="body" class="">
        <div loading="lazy"
            style="background-image:url('{{ asset('img/login/placeholder.jpg') }}'); background-size: cover;  background-position: center; width: 100%;">
        </div>

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
                                <input id="password" name="password" type="password" class="form-control password"
                                    placeholder="Enter Password" autocomplete="current-password">
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
                    &copy; {{ digitLocale(date('Y')) }} @lang('login.herpower_project')
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
    <!-- JavaScript for toggling password visibility -->
    <script defer>
        document.addEventListener('DOMContentLoaded', function () {
        document.addEventListener('click', function (event) {
            const togglePassword = event.target.closest('.material-icons-outlined');
            if (togglePassword) {
                const passwordInput = togglePassword.closest('.password').querySelector('input');
                passwordInput.type = passwordInput.type === 'password' ? 'text' : 'password';
                togglePassword.textContent = passwordInput.type === 'password' ? 'visibility' : 'visibility_off';
            }
        });
    });
    </script>
</body>

</html>