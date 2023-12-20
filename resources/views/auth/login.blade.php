<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('login') }}/img/favicon.png" type="image/png">
    <link
        href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp"
        rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('login') }}/css/bootstrap.css">
    <link rel="stylesheet" href="{{ asset('login') }}/scss/main.css">
    <title>BRL Tarining</title>
</head>

<body>
    <div id="body" style="background-image: url('{{ asset('login') }}/img/placeholder.jpg');">
        <div id="login-page">
            <header id="navbar">
                <nav class="navbar navbar-expand-md navbar-light ">
                    <a class="navbar-brand" href="#">
                        <div class="d-flex align-items-center">
                            <div class="logo">
                                <img class="" src="{{ asset('login') }}/img/logo.svg" alt="">
                            </div>
                            <div class="govt-logo">
                                <img class="" src="{{ asset('login') }}/img/govt-logo.png" alt="">

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
                                    <img class="flag" src="{{ asset('login') }}/img/bd.svg" alt=""> <span
                                        class="label">EN</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="item">
                                        <a class="dropdown-item" href="#">
                                            <img class="flag" src="{{ asset('login') }}/img/bd.svg" alt="">
                                            <span class="label">BD</span>
                                        </a>
                                    </li>
                                    <li class="item">
                                        <a class="dropdown-item" href="#">
                                            <img class="flag" src="{{ asset('login') }}/img/us.svg" alt="">
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
                                        <a class="login btn active" href="https://training.gov.bd">
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

                    @csrf
                    <legend class="title">অ্যাকাউন্ট লগইন করুন</legend>
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
                            <label for="emailid">ইমেইল</label>
                            <input name="email" id="emailid" type="text" class="form-control" placeholder="Enter Emeil">
                        </div>
                        <div class="form-input">
                            <div class="d-flex justify-content-between">
                                <label for="">পাসওয়ার্ড</label>
                                <label for="">
                                    <a href="https://training.gov.bd/reset-password" class="forget">পাসওয়ার্ড ভুলে
                                        গেছেন ?</a>
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
                        <button class="btn btn-submit">লগইন করুন</button>

                        <div class="account-create">হার পাওয়ারে অ্যাকাউন্ট নাই ? <a
                                href="https://training.gov.bd/signup">সাইন আপ</a></div>
                    </form>
                </div>
            </div>
            <footer id="footer">
                <div class="text-md-start left">
                    &copy;২০২৩ হার পাওয়ার প্রজেক্ট
                </div>
                <div class="text-center center">
                    <img class="govt-logo" src="{{ asset('login') }}/img/footer-logo.png" alt="">
                </div>
                <div class="text-md-end right">
                    তথ্য ও যোগাযোগ প্রযুক্তি বিভাগ
                </div>
            </footer>
        </div>
    </div>


    <script type="text/javascript" src="{{ asset('login') }}/js/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="{{ asset('login') }}/js/bootstrap.bundle.min.js"></script>
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
</body>

</html>