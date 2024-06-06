@extends('layouts.auth-master')
@push('css')
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined:opsz,wght,FILL,GRAD@48,700,0,0"
        rel="stylesheet">
@endpush
@section('content')
    <div class="m-5">
        <x-alert />

        <div class="card">
            <div class="card-header">
                <h1 class="card-title">
                    Certificate Configeration
                </h1>
            </div>

            <div class="card-body">
                <form action="{{ route('certificate.config-store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row row-cols-1 g-2">
                        <div class="row g-2 align-items-center">
                            @php
                                $name = 'certificate_bg';
                            @endphp
                            <div class="col-md-4 text-end">
                                <label for="" class="">Certificate Background</label>
                            </div>
                            <div class="col-md-8 d-flex align-items-center">
                                <div class="me-3 w-100">
                                    <input value="{{ $data[$name] ?? old($name) }}" name="{{ $name }}"
                                        type="file" class="form-control @err($name)">
                                    <x-error :name="$name" />
                                </div>
                                <div class="text-end">
                                    <a href="{{ asset('img/uploads/certificate-bg.png') }}" target="_blank">
                                        <img height="100" width="100"
                                            src="{{ asset('img/uploads/certificate-bg.png') }}" alt="">
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="row g-2 align-items-center">

                            <div class="col-md-4 text-end">
                            </div>
                            <div class="col-md-8">
                                <div class="">
                                    Use <span class="text-danger">#name#</span> for fullname,
                                    <span class="text-danger"> #father# </span> for fathers name <br>
                                    <span class="text-danger"> #mother# </span> for mothers name,
                                    <span class="text-danger"> #vendor# </span> for vendor name
                                </div>
                            </div>
                        </div>
                        <div class="row g-2 align-items-center">
                            @php
                                $name = 'certificate_title';
                            @endphp
                            <div class="col-md-4 text-end">
                                <label for="" class="">Certificate Title</label>
                            </div>
                            <div class="col-md-8">
                                <input value="{{ $data[$name] ?? old($name) }}" name="{{ $name }}" type="text"
                                    class="form-control @err($name)">
                                <x-error :name="$name" />
                            </div>
                        </div>

                        <div class="row g-2 align-items-center">
                            @php
                                $name = 'certificate_sub_title';
                            @endphp
                            <div class="col-md-4 text-end">
                                <label for="" class="">Certificate Sub Title</label>
                            </div>
                            <div class="col-md-8">
                                <input value="{{ $data[$name] ?? old($name) }}" name="{{ $name }}" type="text"
                                    class="form-control @err($name)">
                                <x-error :name="$name" />
                            </div>
                        </div>

                        <div class="row g-2 align-items-center">
                            @php
                                $name = 'description_line_1';
                            @endphp
                            <div class="col-md-4 text-end">
                                <label for="" class="">Description Line 1</label>
                            </div>
                            <div class="col-md-8">
                                <input value="{{ $data[$name] ?? old($name) }}" type="text" name="{{ $name }}"
                                    class="form-control  @err($name)">
                                <x-error :name="$name" />
                            </div>
                        </div>

                        <div class="row g-2 align-items-center">
                            @php
                                $name = 'description_line_2';
                            @endphp
                            <div class="col-md-4 text-end">
                                <label for="" class="">Description Line 2</label>
                            </div>
                            <div class="col-md-8">
                                <input value="{{ $data[$name] ?? old($name) }}" type="text" name="{{ $name }}"
                                    class="form-control  @err($name)">
                                <x-error :name="$name" />
                            </div>
                        </div>
                        <div class="row g-2 align-items-center">
                            @php
                                $name = 'description_line_3';
                            @endphp
                            <div class="col-md-4 text-end">
                                <label for="" class="">Description Line 2</label>
                            </div>
                            <div class="col-md-8">
                                <input value="{{ $data[$name] ?? old($name) }}" type="text" name="{{ $name }}"
                                    class="form-control @err($name)">
                                <x-error :name="$name" />
                            </div>
                        </div>


                        <div class="row g-2 align-items-center">
                            <div class="col-md-4 text-end">
                                <label for="" class="">Signature Section</label>
                            </div>
                            <div class="col-md-8 align-items-center">
                                <div class="row row-cols-1 row-cols-md-2 g-4">
                                    <div>
                                        @php
                                            $name = 'sign_left';
                                        @endphp
                                        <label for="">Left Side</label>
                                        <div class="d-flex">
                                            <div class="w-100 me-3">
                                                <input name="{{ $name }}" type="file"
                                                    class="me-3 form-control @err($name)">
                                                <x-error :name="$name" />
                                            </div>
                                            <a c href="{{ asset('img/uploads/sign1.png') }}" target="_blank">
                                                <img width="80" src="{{ asset('img/uploads/sign1.png') }}"
                                                    alt="">
                                            </a>
                                        </div>
                                        @php
                                            $name = 'sign_description_left';
                                        @endphp
                                        <textarea rows="3" name="{{ $name }}" class="form-control mt-3 @err($name)">{{ str_replace('<br />', "\n", htmlspecialchars_decode($data[$name] ?? old($name))) }}</textarea>
                                    </div>
                                    <div>
                                        @php
                                            $name = 'sign_right';
                                        @endphp
                                        <label for="">Right Side</label>
                                        <div class="d-flex">
                                            <div class="w-100 me-3">
                                                <input name="{{ $name }}" type="file"
                                                    class="me-3 form-control @err($name)">
                                                <x-error :name="$name" />
                                            </div>
                                            <a c href="{{ asset('img/uploads/sign2.png') }}" target="_blank">
                                                <img width="80" src="{{ asset('img/uploads/sign2.png') }}"
                                                    alt="">
                                            </a>
                                        </div>
                                        @php
                                            $name = 'sign_description_right';
                                        @endphp
                                        <textarea rows="3" name="{{ $name }}" class="form-control mt-3 @err($name)">{{ str_replace('<br />', "\n", htmlspecialchars_decode($data[$name] ?? old($name))) }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row g-2 align-items-center">
                            <div class="col-md-4 text-end">
                            </div>
                            <div class="col-md-8 align-items-center">
                                <button class="btn btn-primary mt-3 w-100">Submit</button>
                            </div>
                        </div>
                    </div>
            </div>
            </form>
        </div>
    </div>

    </div>
@endsection
