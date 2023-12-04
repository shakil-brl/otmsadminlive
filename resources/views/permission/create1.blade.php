@extends('layouts.auth-master')

@section('content')

<div class="d-flex flex-column flex-column-fluid">
    <!--begin::Toolbar-->
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <!--begin::Toolbar container-->
        <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
            <!--begin::Page title-->
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <!--begin::Title-->
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Permission Create
                </h1>
                <!--end::Title-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        <a href="{{route('home.index')}}" class="text-muted text-hover-primary">Home</a>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">User Management</li>
                    <!--end::Item-->
                      <!--begin::Item-->
                      <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        <a href="{{route('permissions.index')}}" class="text-muted text-hover-primary">Permission List</a>
                    </li>
                    <!--end::Item-->
                     <!--begin::Item-->
                     <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        <a href="" class="text-muted text-hover-primary">Permission Create</a>
                    </li>
                    <!--end::Item-->
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
        </div>
        <!--end::Toolbar container-->
    </div>
    <!--end::Toolbar-->
    <!--begin::Content-->
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div id="success_message"></div>
            <!--begin::Row-->
            <div class="row g-5 g-xl-9">

                <!--begin::Col-->
                <div class="col-md-12">
                    <!--begin::Card-->
                    <div class="card card-flush h-md-100">
                        <!--begin::Card header-->
                        <div class="card-header">
                            <!--begin::Card title-->
                            <div class="card-title">

                            </div>
                            <!--end::Card title-->
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body pt-1">
                            <div class="modal-body mx-5 my-1">
                                <!--begin::Form-->
                                <form  class="form" method="post" action="{{ route('permissions.store') }}">
                                    @csrf
                                    <!--begin::Input group-->
                                    <div class="fv-row mb-7">
                                        <!--begin::Label-->
                                        <label class="fs-6 fw-semibold form-label mb-2">
                                            <span class="required">Permission Name</span>
                                            <span class="ms-2" data-bs-toggle="popover" data-bs-trigger="hover"
                                                data-bs-html="true"
                                                data-bs-content="Permission names is required to be unique.">
                                                <i class="ki-duotone ki-information fs-7">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                    <span class="path3"></span>
                                                </i>
                                            </span>
                                        </label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input class="form-control form-control-solid"
                                            placeholder="Enter a permission name" name="name" value="{{ old('name') }}" />                                            
                        
                                            @if ($errors->has('name'))
                                                <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                                            @endif
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="fv-row mb-7">
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Actions-->
                                    <div class="text-center pt-15">
                                        <a href="{{ route('permissions.index') }}" type="reset" class="btn btn-light me-3"
                                            data-kt-permissions-modal-action="cancel">Discard</a>
                                        <button type="submit" class="btn btn-primary"
                                            data-kt-permissions-modal-action="submit">
                                            <span class="indicator-label">Submit</span>
                                            <span class="indicator-progress">Please wait...
                                                <span
                                                    class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                        </button>
                                    </div>
                                    <!--end::Actions-->
                                </form>
                                <!--end::Form-->
                            </div>
                        </div>

                    </div>
                    <!--end::Card-->
                </div>
                <!--end::Col-->


            </div>

        </div>
        <!--end::Content container-->
    </div>
    <!--end::Content-->
</div>
    
@endsection


