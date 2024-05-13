<!DOCTYPE html>
<html>

<head>
    <title>Verification Panel</title>
    <link rel="icon" href="{{ asset('front') }}/img/favicon.png" type="image/png" sizes="16x16">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    @include('verify.css')
</head>

<body style="background: url('{{ asset('img/certificate/verification.jpg') }}') no-repeat; background-size:cover;">
    <div
        style="position: fixed; background: rgba(44, 0,78, 0.7); height: 100%; width: 100%; z-index: -1; top: 0; left: 0; backdrop-filter: blur(10px);">
    </div>
    <section id="search-panel" class="mt-5">
        <div class="container">
            <div class="shadow-lg  mb-5" style="border-radius: 15px; overflow: hidden;">
                <div class="card top" style="background-color: rgba(255,255,255,.7); backdrop-filter: blur(10px);">
                    <div class="card-body pl-0 pl-sm-5">
                        <div class="">
                            <div class="text-center text-sm-left">
                                <a href="{{ url('/verify') }}"> <img width="280"
                                        src="{{ asset('newstyle/img/logo.svg') }}">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="navb text-center text-sm-left pl-0 pl-sm-5 text-uppercase">
                        Certificate Verification Panel
                    </div>

                    <!--Start Body-->
                    <div style="min-height: 400px;">
                        @yield('content')
                    </div>
                    <!--Start Body-->
                </div>
                <div class="footer">
                    <div class="d-flex justify-content-between align-items-center  flex-wrap">
                        <div>
                            &copy; {{ date('Y') }} Herpower Project
                        </div>
                        <img width="132" src="{{ asset('img/login/footer-logo.png') }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>

</body>

</html>
