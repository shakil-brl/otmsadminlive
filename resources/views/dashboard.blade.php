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
</head>

<body>
    <div id="body" style="background-image: url('{{ asset('img/login/placeholder.jpg') }}');">
        <div id="login-page">
            <header id="navbar">
                <nav class="navbar navbar-expand-md navbar-light ">
                    <a class="navbar-brand" href="#">
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
                                <a class="nav-link  dropdown-toggle" role="button" data-bs-toggle="dropdown">
                                    <img class="flag" src="{{ asset('img/login') }}/bd.svg" alt=""> <span
                                        class="label">EN</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="item">
                                        <a class="dropdown-item" href="#">
                                            <img class="flag" src="{{ asset('img/login') }}/bd.svg" alt="">
                                            <span class="label">BD</span>
                                        </a>
                                    </li>
                                    <li class="item">
                                        <a class="dropdown-item" href="#">
                                            <img class="flag" src="{{ asset('img/login') }}/us.svg" alt="">
                                            <span class="label">EN</span>
                                        </a>
                                    </li>
                                </ul>
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


                    <h1>Apologies, but you currently lack the necessary access.</h1>

                    @if(session('access_token.access_token'))
                    <!-- User is authenticated -->
                    <form action="{{ url('/logout') }}" method="POST" class="logout-btn">
                        @csrf
                        <button type="submit" class="show-loader">Logout</button>
                    </form>
                    @else
                    <!-- User is not authenticated -->
                    <a class="btn btn-submit" href="https://otms.herpower.gov.bd/">Login</a>
                    @endif

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
</body>

</html>