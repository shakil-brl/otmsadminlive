@extends('layouts.auth-master')

@section('content')
    <!--begin::Content wrapper-->
    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <!--begin::Toolbar container-->
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                <!--begin::Page title-->
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <!--begin::Title-->
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                        {{ __('admin-user-list.user_details') }}
                    </h1>
                    <!--end::Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('home.index') }}"
                                class="text-muted text-hover-primary">{{ __('admin-user-list.home') }}</a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('admins.index') }}"
                                class="text-muted text-hover-primary">{{ __('admin-user-list.user_management') }}</a>
                        </li>

                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a
                                href=""class="text-muted text-hover-primary">{{ __('admin-user-list.user_details') }}</a>
                        </li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page title-->
                <!--begin::Actions-->
                <div class="d-flex align-items-center gap-2 gap-lg-3">

                </div>
                <!--end::Actions-->
            </div>
            <!--end::Toolbar container-->
        </div>
        <!--end::Toolbar-->
        <!--begin::Content-->
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <!--begin::Content container-->
            <div id="kt_app_content_container" class="app-container container-xxl">
                <!--begin::Layout-->
                <div class="d-flex flex-column flex-lg-row">
                    <!--begin::Sidebar-->
                    <div class="flex-column flex-lg-row-auto w-lg-250px w-xl-350px mb-10">
                        <!--begin::Card-->
                        <div class="card mb-5 mb-xl-8 h-100">
                            <!--begin::Card body-->
                            <div class="card-body">
                                <!--begin::Summary-->
                                <!--begin::User Info-->
                                <div class="d-flex flex-center flex-column py-5">
                                    <!--begin::Avatar-->
                                    <div class="symbol symbol-100px symbol-circle mb-7">
                                        <img src="" alt="image" id="user-avatar" />
                                    </div>
                                    <!--end::Avatar-->
                                    <!--begin::Name-->
                                    <a href="#" class="fs-3 text-gray-800 text-hover-primary fw-bold mb-3"
                                        id="user-name">
                                        User Name
                                    </a>
                                    <!--end::Name-->
                                    <!--begin::Position-->
                                    <div class="mb-9">
                                        <!--begin::Badge-->
                                        <div class="badge badge-lg badge-light-primary d-inline" id="user-role">
                                            User Role
                                        </div>
                                        <!--begin::Badge-->
                                    </div>
                                    <!--end::Position-->
                                </div>
                                <!--end::User Info-->
                                <!--end::Summary-->
                                <!--begin::Details toggle-->
                                <div class="d-flex flex-stack fs-4 py-3">
                                    <div class="fw-bold rotate collapsible" data-bs-toggle="collapse"
                                        href="#kt_user_view_details" role="button" aria-expanded="false"
                                        aria-controls="kt_user_view_details">{{ __('admin-user-list.primary_info') }}
                                        <span class="ms-2 rotate-180">
                                            <i class="ki-duotone ki-down fs-3"></i>
                                        </span>
                                    </div>
                                </div>
                                <!--end::Details toggle-->
                                <div class="separator"></div>
                                <!--begin::Details content-->
                                <div id="kt_user_view_details" class="collapse show">
                                    <div class="pb-5 fs-6">
                                        <!--begin::Details item-->
                                        <div class="fw-bold mt-5">{{ __('admin-user-list.profiles_id') }}</div>
                                        <div class="text-gray-600" id="user-regId"></div>
                                        <!--begin::Details item-->
                                        <!--begin::Details item-->
                                        <div class="fw-bold mt-5">{{ __('admin-user-list.emails') }}</div>
                                        <div class="text-gray-600">
                                            <a href="#" class="text-gray-600 text-hover-primary" id="user-email"></a>
                                        </div>
                                        <!--begin::Details item-->
                                        <!--begin::Details item-->
                                        <div class="fw-bold mt-5">{{ __('admin-user-list.phone_number') }}</div>
                                        <div class="text-gray-600" id="user-phone"></div>
                                        <!--begin::Details item-->
                                    </div>
                                </div>
                                <!--end::Details content-->
                            </div>
                            <!--end::Card body-->
                        </div>
                        <!--end::Card-->
                    </div>
                    <!--end::Sidebar-->
                    <!--begin::Content-->
                    <div class="flex-lg-row-fluid ms-lg-15">
                        <!--begin:::Tabs-->
                        <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-semibold mb-8">
                            <!--begin:::Tab item-->
                            <li class="nav-item">
                                <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab"
                                    href="#kt_user_view_overview_tab">{{ __('admin-user-list.details_info') }}</a>
                            </li>
                            <!--end:::Tab item-->
                        </ul>
                        <!--end:::Tabs-->
                        <!--begin:::Tab content-->
                        <div class="tab-content" id="myTabContent">
                            <!--begin:::Tab pane-->
                            <div class="tab-pane fade show active" id="kt_user_view_overview_tab" role="tabpanel">
                                <!--begin::Card-->
                                <div class="card pt-4 mb-6 mb-xl-9">
                                    <!--begin::Card header-->

                                    <!--begin::Card body-->
                                    <div class="card-body pt-0 pb-5" id="overview-tab-body">

                                    </div>
                                    <!--end::Card body-->
                                </div>
                                <!--end::Card-->
                            </div>
                            <!--end:::Tab pane-->
                        </div>
                        <!--end:::Tab content-->
                    </div>
                    <!--end::Content-->
                </div>
                <!--end::Layout-->
            </div>
            <!--end::Content container-->
        </div>
        <!--end::Content-->
    </div>
    <!--End::Content wrapper-->
@section('scripts')
    {{-- <script src="{{ asset('assets/dist/assets/js/custom/call.admin.show.api.js') }}"></script> --}}
    <script src="{{ asset('assets/dist/assets/js/custom/account/settings/signin-methods.js') }}"></script>

    <script>
        const profileId = @json($userProfileId);
        $(document).ready(function() {
            let localUserAvatar =
                api_assets_baseurl + "assets/dist/assets/media/svg/avatars/blank.svg";
            const link = api_baseurl + "admins/admin/" + profileId;

            $.ajax({
                method: "GET",
                url: link,
                headers: {
                    Authorization: authToken,
                },
                success: function(results) {
                    let data = results.data;
                    // console.log(results.data);

                    let fullName = data.profile.KnownAs ?? "";
                    let regId = data.ProfileId ?? "";
                    let email = data.profile.Email ?? "";
                    let roleName = data.role.name ?? "";
                    let phoneNumber = data.profile.Phone ?? "";
                    let userImage = localUserAvatar;
                    let gender = data.profile.Gender ?? "";
                    let address = data.profile.address ?? "";
                    let addressPresent = data.profile.address_present ?? "";
                    let NID = data.profile.NID ?? "";
                    // let districtName = data.profile.district_code ?? "";
                    // let upazilaName = data.profile.upazila_id ?? "";
                    providerName = "";
                    if (data.provider) {
                        let providerName = data.provider.name ?? "";
                    }

                    $("#user-avatar").attr(
                        "src",
                        "/assets/dist/assets/media/svg/avatars/blank.svg"
                    );
                    $("#user-name").html(fullName);
                    $("#user-role").html(roleName);
                    $("#user-regId").html(regId);
                    $("#user-email").attr("href", "mailto:" + email);
                    $("#user-email").html(email);
                    $("#user-phone").html(phoneNumber);
                    $("#user-email-signin").html(email);

                    let userDetailsHtml = `
                                        <!--begin::Table wrapper-->
                                        <div class="table-responsive">
                                            <!--begin::Table-->
                                            <table class="table align-middle table-row-dashed gy-5"
                                                id="kt_table_users_login_session">
                                                <tbody class="fs-6 fw-semibold text-gray-600">
                                                    <tr>
                                                        <td>Full Name</td>
                                                        <td>${fullName}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Email</td>
                                                        <td>${email}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Role</td>
                                                        <td>${roleName}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Gender</td>
                                                        <td>${gender}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>NID</td>
                                                        <td>${NID}</td>
                                                    </tr>
                                                    ${
                                                        providerName ??
                                                        `<tr>
                                                                <td>Provider</td>
                                                                <td>${providerName}</td>
                                                            </tr>`
                                                    }
                                                    <tr>
                                                        <td>Permanent Address</td>
                                                        <td>${address}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Present Address</td>
                                                        <td>${addressPresent}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <!--end::Table-->
                                        </div>
                                        <!--end::Table wrapper-->
                                    `;
                    $("#overview-tab-body").append(userDetailsHtml);
                },
                error: function(xhr, status, error) {
                    // Handle errors here
                    console.error(xhr, status, error);
                },
            });
        });
    </script>
@endsection
@endsection
