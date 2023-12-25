@extends('layouts.auth-master')
@push('css')
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined:opsz,wght,FILL,GRAD@48,700,0,0"
        rel="stylesheet">
@endpush

@section('content')
    <div class="mx-4">
        <div id="batch-header">
            <div>
                <div class="icon">
                    <img src="{{ asset('img/new_icon') }}/batch_head.png" alt="">
                </div>
            </div>
            <div class="row row-cols-4">
                <div class="item">
                    <div class="title">Batch001</div>
                    <div class="tag">ব্যাচ কোড #</div>
                </div>
                <div class="item">
                    <div class="title">মহিলা ই-কমার্স প্রফেশনাল</div>
                    <div class="tag">কোর্সের নাম</div>
                </div>
                <div class="item">
                    <div class="title">মিঠামইন, কিশোরগঞ্জ</div>
                    <div class="tag">ঠিকানা</div>
                </div>
                <div class="item">
                    <div class="title">১১৫ দিন</div>
                    <div class="tag">মোট ক্লাস সময়কাল</div>
                </div>
            </div>
        </div>

        <div id="schedule-create">
            <div class="row">
                <div class="col-8">
                    <h2 class="main-title">সময়সূচী তৈরি করুন ( ক্লাস শুরু ০২ নভেম্বর ২০২৩)</h2>

                    <form class="form" method="" action="">
                        <div class="row row-cols-2 g-4">
                            <div>
                                <label class="label" for="">ক্লাসের সময়</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <span class="material-icons-outlined">
                                            schedule
                                        </span>
                                    </span>
                                    <input type="text" class="form-control">
                                </div>
                            </div>

                            <div>
                                <label class="label" for="">সময়কাল</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <span class="material-icons-outlined">
                                            schedule
                                        </span>
                                    </span>
                                    <input type="text" class="form-control">
                                </div>
                            </div>

                            <div>
                                <label class="label" for="">ক্লাস শুরুর তারিখ</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <span class="material-icons-outlined">
                                            calendar_month
                                        </span>
                                    </span>
                                    <input type="text" class="form-control">
                                </div>
                            </div>

                            <div>
                                <label class="label" for="">সর্বমোট ক্লাসের সংখ্যা</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <span class="material-icons-outlined">
                                            calendar_today
                                        </span>
                                    </span>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="class-days-area">
                            <div class="left-title">
                                <div class="icon">
                                    <span class="material-icons-outlined">
                                        calendar_month
                                    </span>
                                </div>
                                <div>
                                    <div class="tag">ক্লাস হবে</div>
                                    <div class="title">যে দিনগুলিতে</div>
                                </div>
                            </div>
                            <div class="week-days">
                                <div class="day">
                                    <input type="checkbox" class="btn-check" id="day-sat">
                                    <label class="btn schedule-btn" for="day-sat">শনি</label>
                                </div>
                                <div class="day">
                                    <input type="checkbox" class="btn-check" id="day-sun">
                                    <label class="btn schedule-btn" for="day-sun">রবি</label>
                                </div>
                                <div class="day">
                                    <input type="checkbox" class="btn-check" id="day-mon">
                                    <label class="btn schedule-btn" for="day-mon">সোম</label>
                                </div>
                                <div class="day">
                                    <input type="checkbox" class="btn-check" id="day-tue">
                                    <label class="btn schedule-btn" for="day-tue">মঙ্গল</label>
                                </div>
                                <div class="day">
                                    <input type="checkbox" class="btn-check" id="day-wed">
                                    <label class="btn schedule-btn" for="day-wed">বুধ</label>
                                </div>
                                <div class="day">
                                    <input type="checkbox" class="btn-check" id="day-thu">
                                    <label class="btn schedule-btn" for="day-thu">বৃহঃ</label>
                                </div>
                                <div class="day">
                                    <input type="checkbox" class="btn-check" id="day-fri">
                                    <label class="btn schedule-btn" for="day-fri">শুক্র</label>
                                </div>
                            </div>
                        </div>

                        <button class="btn submit-btn">সময়সূচী তৈরি করুন</button>
                    </form>

                </div>
                <div class="col-4">
                    <img class="clock" src="./img/clock.png" alt="">
                </div>
            </div>
        </div>
    </div>

    <div class="m-5 d-none">
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
                                        {{ in_array('Saturday', old('class_days', [])) ? 'checked' : '' }}>
                                    {{ __('batch-schedule.weekly_day_sat') }}
                                </div>
                                <div>
                                    <input type="checkbox" name="class_days[]" value="Sunday"
                                        {{ in_array('Sunday', old('class_days', [])) ? 'checked' : '' }}>
                                    {{ __('batch-schedule.weekly_day_sun') }}
                                </div>
                                <div>
                                    <input type="checkbox" name="class_days[]" value="Monday"
                                        {{ in_array('Monday', old('class_days', [])) ? 'checked' : '' }}>
                                    {{ __('batch-schedule.weekly_day_mon') }}
                                </div>
                                <div>
                                    <input type="checkbox" name="class_days[]" value="Tuesday"
                                        {{ in_array('Tuesday', old('class_days', [])) ? 'checked' : '' }}>
                                    {{ __('batch-schedule.weekly_day_tue') }}
                                </div>
                                <div>
                                    <input type="checkbox" name="class_days[]" value="Wednesday"
                                        {{ in_array('Wednesday', old('class_days', [])) ? 'checked' : '' }}>
                                    {{ __('batch-schedule.weekly_day_wed') }}
                                </div>
                                <div>
                                    <input type="checkbox" name="class_days[]" value="Thursday"
                                        {{ in_array('Thursday', old('class_days', [])) ? 'checked' : '' }}>
                                    {{ __('batch-schedule.weekly_day_thu') }}
                                </div>
                                <div>
                                    <input type="checkbox" name="class_days[]" value="Friday"
                                        {{ in_array('Friday', old('class_days', [])) ? 'checked' : '' }}>
                                    {{ __('batch-schedule.weekly_day_fri') }}
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
