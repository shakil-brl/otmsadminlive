<!--begin::Footer Section-->
<div class="mb-0 mt-20">
    <!--begin::Wrapper-->
    <div class="landing-dark-bg">
        <!--begin::Container-->
        <div class="container">
            <!--begin::Wrapper-->
            <div class="d-flex flex-column flex-md-row flex-stack py-7 py-lg-10">
                <!--begin::Copyright-->
                <div class="d-flex align-items-center order-2 order-md-1">
                    <!--begin::Logo-->
                    <a href="{{ route('home.index') }}">
                        <img alt="Logo" src="{{ asset('assets/dist/assets/media/svg/logo/Logotext.svg') }}"
                            class="h-15px h-md-20px" />
                    </a>
                    <!--end::Logo image-->
                    <!--begin::Logo image-->
                    <span class="mx-5 fs-6 fw-semibold text-gray-600 pt-1" href="">
                        @if (app()->getLocale() === 'bn')
                            @php
                                $currentYear = date('Y');
                                $banglaYear = str_replace(range(0, 9), ['০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯'], $currentYear);
                            @endphp
                            &copy; {{ __('landing-footer.copyright_year', ['year' => $banglaYear]) }}
                        @else
                            &copy; {{ __('landing-footer.copyright_year', ['year' => date('Y')]) }}
                        @endif
                        <a class="text-light" href="https://newgen-bd.com/">{{ __('landing-footer.company_name') }}</a>
                    </span>
                    <!--end::Logo image-->
                </div>
                <!--end::Copyright-->
                <!--begin::Menu-->
                <ul class="menu menu-gray-600 menu-hover-primary fw-semibold fs-6 fs-md-5 order-1 mb-5 mb-md-0">
                    <li class="menu-item">
                        <a href="" target="_blank" class="menu-link px-2">{{ __('landing-footer.about_us') }}</a>
                    </li>

                </ul>
                <!--end::Menu-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Wrapper-->
</div>
<!--end::Footer Section-->
