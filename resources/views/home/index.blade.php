@extends('layouts.app-master-home')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Anton&display=swap');
  </style>
@section('content')
    <!--start::banner-->
    <div class="container  px-4 py-5 py-md-20 banner" id="banner">
      
        <div
            class="row flex-lg-row-reverse flex-column-reverse justify-content-md-start justify-content-center align-items-center g-md-10 gy-10 py-5">
            <div class="col-10 col-sm-8 col-lg-6 rounded-4">
                <img src="{{ asset('assets/dist/assets/media/banner/banner.jpg') }}"
                    class="d-block mx-lg-auto img-fluid rounded-4" alt="Bootstrap Themes" width="700" height="500"
                    loading="lazy">
            </div>
            <div class="col-lg-6">
                <h1 class="display-6 fw-bold lh-1 mb-3 ">{{ __('landing.para_heading') }}</h1>
                <p class="lead">{{ __('landing.para') }}
                </p>
                <div class="d-grid gap-2 d-md-flex justify-content-md-start buttons">
                    <a href="" type="button" class="btn btn-success btn-lg px-4 me-md-2">{{ __('landing.get_started') }}</a>
                    <a href="#courses" type="button" class="btn btn-primary btn-lg px-4">{{ __('landing.our_courses') }}</a>
                </div>
            </div>
        </div>
    </div>
    <!--end::banner-->
    <!--begin::Features Section-->
    <div class="container mb-md-10 py-20 px-4 rounded-4" style="background: #F8F8F8;">
        <!--begin::Container-->
        <div class="container">
            <!--begin::Row-->
            <div class="row w-100 gy-10" id="features" data-kt-scroll-offset="{default: 100, lg: 150}">
                <!--begin::Col-->
                <div class="col-md-4 px-5">
                    <!--begin::Story-->
                    <div class="text-center
                    mb-10 mb-md-0 feature feature-item-1 hover-scale">
                        <!--begin::Illustration-->
                        <div class="icon rounded-4 mb-10">
                            <img src="assets/dist/assets/media/illustrations/sketchy-1/8.png" class="mh-125px mb-9 "
                                alt="" />
                        </div>
                        <!--end::Illustration-->
                        <!--begin::Heading-->
                        <div class="d-flex flex-center mb-5">
                            <!--begin::Badge-->
                            <span class="badge badge-circle badge-light-success fw-bold p-5 me-3 fs-3">{{ __('landing.skill_number_one') }}</span>
                            <!--end::Badge-->
                            <!--begin::Title-->
                            <div class="fs-5 fs-lg-3 fw-bold text-dark">{{ __('landing.skill_heading_one') }}</div>
                            <!--end::Title-->
                        </div>
                        <!--end::Heading-->
                        <!--begin::Description-->
                        <div class="fw-semibold fs-6 fs-lg-4 text-muted">{{ __('landing.skill_para_one') }}
                        </div>
                        <!--end::Description-->
                    </div>
                    <!--end::Story-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-md-4 px-5">
                    <!--begin::Story-->
                    <div class="text-center mb-10 mb-md-0 feature feature-item-2 hover-scale">
                        <!--begin::Illustration-->
                        <div class="icon rounded-4 mb-10">
                            <img src="assets/dist/assets/media/illustrations/sketchy-1/2.png" class="mh-125px mb-9"
                                alt="" />
                        </div>
                        <!--end::Illustration-->
                        <!--begin::Heading-->
                        <div class="d-flex flex-center mb-5">
                            <!--begin::Badge-->
                            <span class="badge badge-circle badge-light-success fw-bold p-5 me-3 fs-3">{{ __('landing.skill_number_two') }}</span>
                            <!--end::Badge-->
                            <!--begin::Title-->
                            <div class="fs-5 fs-lg-3 fw-bold text-dark">{{ __('landing.skill_heading_two') }}</div>
                            <!--end::Title-->
                        </div>
                        <!--end::Heading-->
                        <!--begin::Description-->
                        <div class="fw-semibold fs-6 fs-lg-4 text-muted">{{ __('landing.skill_para_two') }}
                        </div>
                        <!--end::Description-->
                    </div>
                    <!--end::Story-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-md-4 px-5">
                    <!--begin::Story-->
                    <div class="text-center mb-10 mb-md-0 feature feature-item-3 hover-scale">
                        <!--begin::Illustration-->
                        <div class="icon icon rounded-4 mb-10">
                            <img src="assets/dist/assets/media/illustrations/sketchy-1/12.png" class="mh-125px mb-9"
                                alt="" />
                        </div>
                        <!--end::Illustration-->
                        <!--begin::Heading-->
                        <div class="d-flex flex-center mb-5">
                            <!--begin::Badge-->
                            <span class="badge badge-circle badge-light-success fw-bold p-5 me-3 fs-3">{{ __('landing.skill_number_three') }}</span>
                            <!--end::Badge-->
                            <!--begin::Title-->
                            <div class="fs-5 fs-lg-3 fw-bold text-dark">{{ __('landing.skill_heading_three') }}</div>
                            <!--end::Title-->
                        </div>
                        <!--end::Heading-->
                        <!--begin::Description-->
                        <div class="fw-semibold fs-6 fs-lg-4 text-muted">{{ __('landing.skill_para_three') }}
                        </div>
                        <!--end::Description-->
                    </div>
                    <!--end::Story-->
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Features Section-->


    <!--begin::Container-->
    <div class="container mt-20 mb-n40 ">
        <!--begin::Title-->
        <h3 class="fs-2hx text-dark text-center mb-5" id="blogs" data-kt-scroll-offset="{default: 125, lg: 150}">
            {{ __('landing.our_blog') }}</h3>
        <!--end::Title-->
        <!--begin::Description-->
        <div class="fs-5 text-muted text-center  fw-bold mb-17">{{ __('landing.blog_title') }}
        </div>
        <!--end::Description-->
        <!--begin::Row-->
        <div class="row g-10 ">
            <!--begin::Col-->
            <div class="col-md-4">
                <!--begin::Feature post-->
                <div class="card-xl-stretch me-md-6 ">
                    <!--begin::Image-->
                    <a class="d-block bgi-no-repeat bgi-size-cover bgi-position-center card-rounded position-relative min-h-175px mb-5"
                        style="background-image:url('assets/dist/assets/media/stock/600x400/img-73.jpg')"
                        data-fslightbox="lightbox-video-tutorials" href="https://www.youtube.com/embed/btornGtLwIo">
                        <img src="assets/dist/assets/media/svg/misc/video-play.svg"
                            class="position-absolute top-50 start-50 translate-middle" alt="" />
                    </a>
                    <!--end::Image-->
                    <!--begin::Body-->
                    <div class="m-0">
                        <!--begin::Title-->
                        <a href=""
                            class="fs-4 text-dark fw-bold text-hover-primary text-dark lh-base"> {{ __('landing.post_title_one') }}</a>
                        <!--end::Title-->
                        <!--begin::Text-->
                        <div class="fw-semibold fs-5 text-gray-600 text-dark my-4"> {{ __('landing.post_text_one') }}</div>
                        <!--end::Text-->
                        <!--begin::Content-->
                        <div class="fs-6 fw-bold">
                            <!--begin::Author-->
                            <a href="../../demo1/dist/pages/user-profile/overview.html"
                                class="text-gray-700 text-hover-primary"> {{ __('landing.post_author_one') }}</a>
                            <!--end::Author-->
                            <!--begin::Date-->
                            <span class="text-muted"> {{ __('landing.post_date_one') }}</span>
                            <!--end::Date-->
                        </div>
                        <!--end::Content-->
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Feature post-->
            </div>
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-md-4">
                <!--begin::Feature post-->
                <div class="card-xl-stretch mx-md-3">
                    <!--begin::Image-->
                    <a class="d-block bgi-no-repeat bgi-size-cover bgi-position-center card-rounded position-relative min-h-175px mb-5"
                        style="background-image:url('assets/dist/assets/media/stock/600x400/img-80.jpg')"
                        data-fslightbox="lightbox-video-tutorials" href="https://www.youtube.com/embed/btornGtLwIo">
                        <img src="assets/dist/assets/media/svg/misc/video-play.svg"
                            class="position-absolute top-50 start-50 translate-middle" alt="" />
                    </a>
                    <!--end::Image-->
                    <!--begin::Body-->
                    <div class="m-0">
                        <!--begin::Title-->
                        <a href=""
                            class="fs-4 text-dark fw-bold text-hover-primary text-dark lh-base">{{ __('landing.post_title_two') }}</a>
                        <!--end::Title-->
                        <!--begin::Text-->
                        <div class="fw-semibold fs-5 text-gray-600 text-dark my-4">{{ __('landing.post_text_two') }}</div>
                        <!--end::Text-->
                        <!--begin::Content-->
                        <div class="fs-6 fw-bold">
                            <!--begin::Author-->
                            <a href="../../demo1/dist/pages/user-profile/overview.html"
                                class="text-gray-700 text-hover-primary">{{ __('landing.post_author_two') }}</a>
                            <!--end::Author-->
                            <!--begin::Date-->
                            <span class="text-muted">{{ __('landing.post_date_two') }}</span>
                            <!--end::Date-->
                        </div>
                        <!--end::Content-->
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Feature post-->
            </div>
            <!--end::Col-->

            <!--begin::Col-->
            <div class="col-md-4">
                <!--begin::Feature post-->
                <div class="card-xl-stretch ms-md-6">
                    <!--begin::Image-->
                    <a class="d-block bgi-no-repeat bgi-size-cover bgi-position-center card-rounded position-relative min-h-175px mb-5"
                        style="background-image:url('assets/dist/assets/media/stock/600x400/img-77.jpg')"
                        data-fslightbox="lightbox-video-tutorials" href="https://www.youtube.com/embed/TWdDZYNqlg4">
                        <img src="assets/dist/assets/media/svg/misc/video-play.svg"
                            class="position-absolute top-50 start-50 translate-middle" alt="" />
                    </a>
                    <!--end::Image-->
                    <!--begin::Body-->
                    <div class="m-0">
                        <!--begin::Title-->
                        <a href=""
                            class="fs-4 text-dark fw-bold text-hover-primary text-dark lh-base">{{ __('landing.post_title_three') }}</a>
                        <!--end::Title-->
                        <!--begin::Text-->
                        <div class="fw-semibold fs-5 text-gray-600 text-dark my-4">{{ __('landing.post_text_three') }}</div>
                        <!--end::Text-->
                        <!--begin::Content-->
                        <div class="fs-6 fw-bold">
                            <!--begin::Author-->
                            <a href="../../demo1/dist/pages/user-profile/overview.html"
                                class="text-gray-700 text-hover-primary">{{ __('landing.post_author_three') }}</a>
                            <!--end::Author-->
                            <!--begin::Date-->
                            <span class="text-muted">{{ __('landing.post_date_three') }}</span>
                            <!--end::Date-->
                        </div>
                        <!--end::Content-->
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Feature post-->
            </div>
            <!--end::Col-->

        </div>
        <!--end::Row-->
       
    </div>
    <!--end::Container-->

    @include('layouts.partials.footer')
    <!--begin::Scrolltop-->
    <div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
        <i class="ki-duotone ki-arrow-up">
            <span class="path1"></span>
            <span class="path2"></span>
        </i>
    </div>
    <!--end::Scrolltop-->
    <!--begin::Modal - Upgrade plan-->
    <div class="modal fade" id="kt_modal_course_batches" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <!--begin::Modal content-->
            <div class="modal-content rounded">
                <!--begin::Modal header-->
                <div class="modal-header justify-content-end border-0 pb-0">
                    <!--begin::Close-->
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <i class="ki-duotone ki-cross fs-1">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                    </div>
                    <!--end::Close-->
                </div>
                <!--end::Modal header-->
                <!--begin::Modal body-->
                <div class="modal-body pt-0 pb-15 px-5 px-xl-20">
                    <!--begin::Heading-->
                    <div class="mb-13 text-center">
                        <h1 id="name_code" class="mb-3"></h1>
                        <div id="schedule_date" class="text-muted fw-semibold fs-5">
                        </div>
                    </div>
                    <!--end::Heading-->
                    <!--begin::Batch-->
                    <div>
                        <!--begin::Header-->
                        <div class="border-0 pt-5">
                            <h3 class="">
                                <div class="card-label fw-bold fs-3 mb-1">Batches:</div>
                            </h3>
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="pt-3">
                            <!--begin::Table container-->
                            <div class="table-responsive">
                                <!--begin::Table-->
                                <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                                    <!--begin::Table head-->
                                    <thead>
                                        <tr class="fw-bold text-muted bg-light">
                                            <th class="ps-4 min-w-125px rounded-start">Batch ID</th>
                                            <th class="min-w-125px text-end">Batch Name</th>
                                            <th class="min-w-125px text-center">Venue</th>
                                            <th class="min-w-125px text-center">Address</th>
                                            <th class="min-w-200px text-end">Avilable Seat</th>
                                            <th class="min-w-150px text-end rounded-end pe-4">Action</th>
                                        </tr>
                                    </thead>
                                    <!--end::Table head-->
                                    <!--begin::Table body-->
                                    <tbody id="course_batches">

                                    </tbody>
                                    <!--end::Table body-->
                                </table>
                                <!--end::Table-->
                            </div>
                            <!--end::Table container-->
                        </div>
                        <!--begin::Body-->
                    </div>
                    <!--end::Batch-->
                    <!--begin::Actions-->
                    <div class="d-flex flex-center flex-row-fluid pt-12">
                        <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">Cancel</button>
                    </div>
                    <!--end::Actions-->
                </div>
                <!--end::Modal body-->
            </div>
            <!--end::Modal content-->
        </div>
        <!--end::Modal dialog-->
    </div>
    <!--end::Modal - Upgrade plan-->
    </div>
    <!--end::Root-->
@section('scripts')
    <script src="{{ asset('assets/dist/assets/plugins/custom/vis-timeline/vis-timeline.bundle.js') }}"></script>
    <script src="{{ asset('assets/dist/assets/js/widgets.bundle.js') }}"></script>
    <script src="{{ asset('assets/dist/assets/js/custom/widgets.js') }}"></script>
    <script src="{{ asset('assets/dist/assets/js/custom/code.js') }}"></script>
@endsection
@endsection
