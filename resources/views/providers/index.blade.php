@extends('layouts.auth-master')
{{-- @dd($providers); --}}
{{-- @dd($providers[0]) --}}
@section('content')
    <!--begin::Content-->
    <div class="m-5">
        <h3>All Providers</h3>
        <x-alert />
        @isset($providers)
            <div class="my-3 d-flex">
                <div class="w-100">
                    <form action="">
                        <div class="d-flex gap-3">
                            <input type="search" name="search" value="{{ request('search') }}" class="form-control w-75"
                                placeholder="{{ __('batch-list.search_here') }}">
                            <input type="submit" class="form-control btn btn-primary w-25"
                                value="{{ __('batch-list.search') }}">
                        </div>
                    </form>
                </div>
                <div class="w-100 text-end">
                    <a href="#" class="btn btn-lg btn-info me-1" data-bs-toggle="modal" data-bs-target="#create_provider"
                        data-bs-toggle="tooltip" data-bs-custom-class="tooltip-inverse" data-bs-placement="bottom"
                        title="Provider Create">
                        Crate Provider
                    </a>
                </div>
            </div>
            <table class="table table-bordered bg-white">
                <thead>
                    <th>{{ __('batch-list.sl') }}</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>{{ __('batch-list.action') }}</th>
                </thead>
                <tbody>
                    @foreach (collect($providers) as $provider)
                        {{-- @dump($provider) --}}
                        <tr>
                            <td>
                                {{ $page_from + $loop->iteration - 1 }}
                            </td>
                            <td>
                                {{ $provider['name'] ?? '' }}
                            </td>
                            <td>
                                {{ $provider['email'] ?? '' }}
                            </td>
                            <td>
                                {{ $provider['phone'] ?? '' }}
                            </td>
                            <td>
                                {{ $provider['address'] ?? '' }}
                            </td>
                            <td>
                                <a href="#" class="btn btn-sm btn-info me-1 editProvider"
                                    data-provider-id="{{ $provider['id'] }}" data-bs-toggle="modal"
                                    data-bs-target="#edit_provider" data-bs-toggle="tooltip"
                                    data-bs-custom-class="tooltip-inverse" data-bs-placement="bottom" title="Provider Edit">
                                    Edit
                                </a>
                                <a href="{{ route('providers.show', $provider['id']) }}"
                                    class="btn btn-sm btn-primary me-1 show-action" title="Provider Details">
                                    view
                                </a>
                                <a href="{{ route('provider.link-batch', $provider['id']) }}" class="btn btn-sm btn-success">
                                    Link Batch
                                </a>
                                <a href="#" class="btn btn-sm btn-danger delete-provider"
                                    data-provider-id="{{ $provider['id'] }}" data-provider-name="{{ $provider['name'] }}"
                                    data-bs-toggle="tooltip" data-bs-custom-class="tooltip-inverse" data-bs-placement="bottom"
                                    title="Provider Delete">
                                    Delete
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {!! $paginator->links() !!}
        @endisset
    </div>
    <!--end::Content-->
    <!--Begin::Provider Create Modal-->
    <div class="modal fade" id="create_provider" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-950px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <div class="modal-header" id="kt_modal_create_provider_header">
                    <!--begin::Modal title-->
                    <h2 class="fw-bold">{{ __('provider-list.add_provider') }}</h2>
                    <!--end::Modal title-->
                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                        <i class="ki-duotone ki-cross fs-1">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                    </div>
                    <!--end::Close-->
                </div>
                <!--begin::Provider added Form-->
                <form id="provider_add_form" method="post" class="form m-7" action="">
                    @csrf
                    <!--begin::Scroll-->
                    <div class="d-flex flex-column scroll-y me-n7 pe-7">
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-2">{{ __('provider-list.provider_name') }}</label>
                            <!--end::Label-->

                            <!--begin::First Name-->
                            <input type="text" placeholder="{{ __('provider-list.provider_name_ph') }}" type="text"
                                id="name" name="name" autocomplete="off"
                                class="form-control form-control-solid mb-3 mb-lg-0" value="" />
                            <span class="text-danger form-message-error-name">

                            </span>
                            <!--end::First Name-->
                        </div>
                        <!--end::Input group-->
                        <div class='separator separator-dashed my-2'></div>


                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="fw-semibold fs-6 mb-2">{{ __('provider-list.email') }}</label>
                            <!--end::Label-->
                            <!--begin::Email-->
                            <input type="text" placeholder="{{ __('provider-list.email_ph') }}" type="text"
                                id="email" name="email" autocomplete="off"
                                class="form-control form-control-solid mb-3 mb-lg-0" value="" />
                            <span class="text-danger form-message-error-email">

                            </span>
                            <!--end::Email-->
                        </div>
                        <!--end::Input group-->
                        <div class='separator separator-dashed my-2'></div>


                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-2">{{ __('provider-list.mobile_number') }}</label>
                            <!--end::Label-->
                            <input type="text" placeholder="{{ __('provider-list.mobile_number_ph') }}" type="text"
                                id="mobile" name="mobile" autocomplete="off"
                                class="form-control form-control-solid mb-3 mb-lg-0" value="" />
                            <span class="text-danger form-message-error-mobile">

                            </span>
                            <!--end::Mobile-->
                        </div>
                        <!--end::Input group-->
                        <div class='separator separator-dashed my-2'></div>



                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="fw-semibold fs-6 mb-2">{{ __('provider-list.address') }}</label>
                            <!--end::Label-->
                            <!--begin::Address-->
                            <textarea class="form-control form-control-solid" rows="4" name="address"
                                placeholder="{{ __('provider-list.address_ph') }}"></textarea>
                            <span class="text-danger form-message-error-address">

                            </span>
                            <!--end::Address-->
                        </div>
                        <!--end::Input group-->

                    </div>
                    <!--end::Scroll-->
                    <!--begin::Actions-->
                    <div class="text-center pt-15">
                        <a href="#" type="reset" class="btn btn-light me-3" data-bs-dismiss="modal"
                            data-kt-users-modal-action="cancel">{{ __('provider-list.discard') }}</a>
                        <button type="submit" class="btn btn-primary">
                            <span class="indicator-label">{{ __('provider-list.submit') }}</span>
                            <span class="indicator-progress">Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                    </div>
                    <!--end::Actions-->
                </form>
                <!--Provider added end::Form-->

            </div>
        </div>
    </div>
    <!--End::Provider Create Modal-->
    <!--Start::Provider Update Modal-Content-->
    <div class="modal fade" id="edit_provider" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-950px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <div class="modal-header" id="kt_modal_update_provider_header">
                    <!--begin::Modal title-->
                    <h2 class="fw-bold">{{ __('provider-list.provider-edit') }}</h2>
                    <!--end::Modal title-->
                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                        <i class="ki-duotone ki-cross fs-1">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                    </div>
                    <!--end::Close-->
                </div>
                <!--begin::Provider added Form-->
                <form id="provider_edit_form" method="post" class="form m-7" action="">
                    @csrf
                    @method('PATCH')
                    <!--begin::Scroll-->
                    <div class="d-flex flex-column scroll-y me-n7 pe-7">
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-2">{{ __('provider-list.provider_name') }}</label>
                            <!--end::Label-->
                            <input type="hidden" name="provider_id" id="provider_id" value="" />
                            <!--begin::First Name-->
                            <input type="text" placeholder="{{ __('provider-list.provider_name_ph') }}"
                                id="name" name="name" autocomplete="off"
                                class="form-control form-control-solid mb-3 mb-lg-0" value="" />
                            <span class="text-danger form-message-error-name">

                            </span>
                            <!--end::First Name-->
                        </div>
                        <!--end::Input group-->
                        <div class='separator separator-dashed my-2'></div>


                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="fw-semibold fs-6 mb-2">{{ __('provider-list.email') }}</label>
                            <!--end::Label-->
                            <!--begin::Email-->
                            <input type="text" placeholder="{{ __('provider-list.email_ph') }}" id="email"
                                name="email" autocomplete="off" class="form-control form-control-solid mb-3 mb-lg-0"
                                value="" />
                            <span class="text-danger form-message-error-email">

                            </span>
                            <!--end::Email-->
                        </div>
                        <!--end::Input group-->
                        <div class='separator separator-dashed my-2'></div>


                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-2">{{ __('provider-list.mobile_number') }}</label>
                            <!--end::Label-->
                            <!--begin::Mobile-->
                            <input type="text" placeholder="{{ __('provider-list.mobile_number_ph') }}"
                                id="phone" name="mobile" autocomplete="off"
                                class="form-control form-control-solid mb-3 mb-lg-0" value="" />
                            <span class="text-danger form-message-error-mobile">

                            </span>
                            <!--end::Mobile-->
                        </div>
                        <!--end::Input group-->
                        <div class='separator separator-dashed my-2'></div>


                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="fw-semibold fs-6 mb-2">{{ __('provider-list.address') }}</label>
                            <!--end::Label-->
                            <!--begin::Address-->
                            <textarea class="form-control form-control-solid" rows="4" name="address" id="address"
                                placeholder="{{ __('provider-list.address_ph') }}"></textarea>
                            <span class="text-danger form-message-error-address">

                            </span>
                            <!--end::Address-->
                        </div>
                        <!--end::Input group-->

                    </div>
                    <!--end::Scroll-->
                    <!--begin::Actions-->
                    <div class="text-center pt-15">
                        <a href="#" type="reset" data-bs-dismiss="modal" class="btn btn-light me-3"
                            data-kt-users-modal-action="cancel">{{ __('provider-list.discard') }}</a>
                        <button type="submit" class="btn btn-primary">
                            <span class="indicator-label">{{ __('provider-list.update') }}</span>
                            <span class="indicator-progress">Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                    </div>
                    <!--end::Actions-->
                </form>
                <!--Provider added end::Form-->

            </div>
        </div>
    </div>
    <!--End::Provider Update Modal-->
@section('script')
    <script></script>
@endsection

@section('scripts')
    <!--begin::Custom Javascript(used for this page only)-->
    <script src="{{ asset('assets/dist/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script src="{{ asset('assets/dist/assets/js/custom/assets/functions.js') }}"></script>

    <script></script>
@endsection
@endsection
