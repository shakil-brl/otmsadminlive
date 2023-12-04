@extends('layouts.auth-master')

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
        <a href="{{ route('batch-schedule.batches') }}"class="text-muted text-hover-primary">{{ __('batch-schedule.provider_batch_list') }}</a>
    </li>
    <!--end::Item-->
     <!--begin::Item-->
     <li class="breadcrumb-item">
        <span class="bullet bg-gray-400 w-5px h-2px"></span>
    </li>
    <!--end::Item-->
    <!--begin::Item-->
    <li class="breadcrumb-item text-muted">{{ __('batch-schedule.batch_schedule_create') }}</li>
    <!--end::Item-->
</ul>
<!--end::Breadcrumb-->
    <div class="m-5">
        <h3>{{ __('batch-schedule.create_schedule') }}</h3>
        <x-alert />



        @isset($batch)
            <div>
                <h4>{{ __('batch-schedule.batch_code') }}: {{ $batch['batchCode'] }}</h4>
                <div>{{ __('batch-schedule.course_name') }}:
                    {{ $batch['get_training'] ? ($batch['get_training']['title'] ? $batch['get_training']['title']['Name'] : '') : '' }}
                </div>
                <div>
                    {{ __('batch-schedule.start_date') }}: {{ \Carbon\Carbon::parse($batch['startDate'])->format('d-m-Y') }}
                </div>
                <div>
                    {{ __('batch-schedule.total_class') }}: {{ $batch['totalTrainees'] ?? '' }}
                </div>
                <div>
                    {{ __('batch-schedule.location') }}: {{ $batch['GEOLocation'] ?? '' }}
                </div>
            </div>
            <br>

            @if ($error)
                @if (is_string($error))
                    <span class="text-danger">
                        <div class="alert close alert-danger alert-dismissible fade show" role="alert">
                            <strong>Error : </strong>
                            {{ $error ?? '' }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </span>
                @else
                    <ul class="m-0 text-danger">
                        @foreach ($error ?? [] as $err)
                            @foreach ($err as $e)
                                <li>
                                    {{ $e }}
                                </li>
                            @endforeach
                        @endforeach
                    </ul>
                @endif
            @endif

            @isset($error['training_batch_id'])
                <span class="text-danger">
                    <div class="alert close alert-danger alert-dismissible fade show" role="alert">
                        <strong>Error : </strong>
                        {{ $error['training_batch_id'][0] }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </span>
            @endisset
            <div class="bg-white p-5 rounded">
                <form action="{{ route('batch-schedule.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="training_batch_id" value="{{ $batch['id'] }}">

                    <div class="row row-cols-4 g-3">
                        <div>
                            <label for="">{{ __('batch-schedule.pick_class_time') }}</label>
                            <input type="time" value="{{ old('class_time') }}" class="form-control" name="class_time">
                            @isset($error['class_time'])
                                <span class="text-danger">
                                    {{ $error['class_time'][0] }}
                                </span>
                            @endisset
                        </div>
                        <div>
                            <label for="">{{ __('batch-schedule.class_duration') }}</label>
                            <div class="input-group">
                                <input value="{{ old('class_duration') }}" type="text" class="form-control"
                                    name="class_duration">
                                <span class="input-group-text">{{ __('batch-schedule.hours') }}</span>
                            </div>

                            @isset($error['class_duration'])
                                <span class="text-danger">
                                    {{ $error['class_duration'][0] }}
                                </span>
                            @endisset
                        </div>
                        <div class="w-100">
                            <label for="">{{ __('batch-schedule.select_days') }}</label>
                            <div class="row row-cols-4 g-3">
                                <div>
                                    <input type="checkbox" name="class_days[]" value="Saturday"
                                        {{ in_array('Saturday', old('class_days', [])) ? 'checked' : '' }}> {{ __('batch-schedule.weekly_day_sat') }}
                                </div>
                                <div>
                                    <input type="checkbox" name="class_days[]" value="Sunday"
                                        {{ in_array('Sunday', old('class_days', [])) ? 'checked' : '' }}> {{ __('batch-schedule.weekly_day_sun') }}
                                </div>
                                <div>
                                    <input type="checkbox" name="class_days[]" value="Monday"
                                        {{ in_array('Monday', old('class_days', [])) ? 'checked' : '' }}> {{ __('batch-schedule.weekly_day_mon') }}
                                </div>
                                <div>
                                    <input type="checkbox" name="class_days[]" value="Tuesday"
                                        {{ in_array('Tuesday', old('class_days', [])) ? 'checked' : '' }}> {{ __('batch-schedule.weekly_day_tue') }}
                                </div>
                                <div>
                                    <input type="checkbox" name="class_days[]" value="Wednesday"
                                        {{ in_array('Wednesday', old('class_days', [])) ? 'checked' : '' }}> {{ __('batch-schedule.weekly_day_wed') }}
                                </div>
                                <div>
                                    <input type="checkbox" name="class_days[]" value="Thursday"
                                        {{ in_array('Thursday', old('class_days', [])) ? 'checked' : '' }}> {{ __('batch-schedule.weekly_day_thu') }}
                                </div>
                                <div>
                                    <input type="checkbox" name="class_days[]" value="Friday"
                                        {{ in_array('Friday', old('class_days', [])) ? 'checked' : '' }}> {{ __('batch-schedule.weekly_day_fri') }}
                                </div>
                            </div>
                            @isset($error['class_days'])
                                <span class="text-danger">
                                    {{ $error['class_days'][0] }}
                                </span>
                            @endisset
                        </div>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">{{ __('batch-schedule.create_schedule') }}</button>
                    </div>
                </form>
            </div>
        @endisset

    </div>
@endsection
