<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined:opsz,wght,FILL,GRAD@48,700,0,0"
        rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('front') }}/img/favicon.png" type="image/png">
    <link href="{{ asset('front') }}/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('front') }}/scss/main.css">
    @stack('css')
</head>

<body>
    <section id="admin">
        @include('front.layouts.inc.sidebar')
        <section id="right">
            @include('front.layouts.inc.topnav')
            <div id="main-content">
                <div class="page-title">
                    @yield('title')
                </div>
                <div class="page-content">
                    @yield('content')
                </div>
            </div>
            @include('front.layouts.inc.footer')
        </section>
    </section>



    <script src="{{ asset('front') }}/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('front') }}/js/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('front') }}/js/admin.js"></script>
    @stack('js')
</body>

</html>
