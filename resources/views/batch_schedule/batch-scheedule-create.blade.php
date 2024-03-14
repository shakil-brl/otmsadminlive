@extends('layouts.auth-master')
@push('css')
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined:opsz,wght,FILL,GRAD@48,700,0,0"
        rel="stylesheet">
@endpush
@section('content')
    <!--begin::Content-->
    <!--begin::Breadcrumb-->
    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1 m-5">
        <!--begin::Item-->
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('home.index') }}" class="text-muted text-hover-primary">{{ __('categorie-list.home') }}</a>
        </li>
        <!--end::Item-->
        <!--begin::Item-->
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-400 w-5px h-2px"></span>
        </li>
        <!--end::Item-->
        <!--begin::Item-->
        <li class="breadcrumb-item text-muted">{{ __('batch-schedule.enroll_management') }}</li>
        <!--end::Item-->
        <!--begin::Item-->
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-400 w-5px h-2px"></span>
        </li>
        <!--end::Item-->
        <!--begin::Item-->
        <li class="breadcrumb-item text-muted">
            <a href="{{ route('batch-schedule.batches') }}"
                class="text-muted text-hover-primary">{{ __('batch-schedule.provider_batch_list') }}</a>
        </li>
        <!--end::Item-->
        <!--begin::Item-->
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-400 w-5px h-2px"></span>
        </li>
        <!--end::Item-->
        <!--begin::Item-->
        <li class="breadcrumb-item text-muted">{{ __('batch-schedule.batch_schedule') }}</li>
        <!--end::Item-->
    </ul>
    <!--end::Breadcrumb-->
    <div class="m-4">
        <div id="batch-header" class="mb-2">
            <div>
                <div class="icon">
                    <img src="{{ asset('img') }}/new_icon/batch_head.png" alt="">
                </div>
            </div>
            <div class="row row-cols-4">
                <div class="item">
                    <div class="title"> {{ $batch['batchCode'] ?? '' }}</div>
                    <div class="tag">{{ __('batch-schedule.batch_code') }} #</div>
                </div>
                <div class="item">
                    <div class="title">{{ $batch['get_training']['title']['Name'] ?? '' }}</div>
                    <div class="tag">{{ __('batch-schedule.course_name') }}</div>
                </div>
                <div class="item">
                    <div class="title">{{ $batch['GEOLocation'] ?? '' }}</div>
                    <div class="tag">{{ __('batch-schedule.address') }}</div>
                </div>
                <div class="item">
                    <div class="title">{{ $batch['duration'] ?? '' }} {{ __('batch-schedule.days') }}</div>
                    <div class="tag">{{ __('batch-schedule.total_class_days') }}</div>
                </div>
            </div>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <x-alert />

        <form action="{{ route('batch-schedule-detail.store', $batch['id']) }}" method="POST">
            @csrf
            <div class="row row-cols-4 g-3">
                <div>
                    @php
                        $name = 'date';
                    @endphp
                    <label for="">Date</label>
                    <input type="date" name="{{ $name }}" value="{{ old($name) }}"
                        class="form-control @error($name) is-invalid @enderror">
                    @error($name)
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div>
                    @php
                        $name = 'start_time';
                    @endphp
                    <label for="">Start Time</label>
                    <input type="time" name="{{ $name }}" value="{{ old($name) }}"
                        class="form-control @error($name) is-invalid @enderror">
                    @error($name)
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div>
                    @php
                        $name = 'end_time';
                    @endphp
                    <label for="">End Time</label>
                    <input type="time" name="{{ $name }}" value="{{ old($name) }}"
                        class="form-control @error($name) is-invalid @enderror">
                    @error($name)
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div>
                    <label for=""></label>
                    <div><button class="btn btn-primary">Submit</button></div>
                </div>
            </div>
        </form>

    </div>
@endsection
