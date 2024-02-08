@extends('layouts.auth-master')
@push('css')
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined:opsz,wght,FILL,GRAD@48,700,0,0"
        rel="stylesheet">

        <style>

#schedule-create {
  margin-top: 16px;
  padding: 28px 24px;
  border-radius: 6px;
  background-color: #fff;
}
#schedule-create .clock {
  width: 100%;
}
#schedule-create .main-title {
  color: #3b0764;
  font-size: 24px;
  font-weight: 700;
  text-align: center;
  margin-bottom: 40px;
  padding: 24px 0;
}
#schedule-create .form .label {
  color: #0a0a0a;
  font-size: 16px;
  margin-bottom: 8px;
}
#schedule-create .form .input-group {
  border-radius: 16px;
  border: 2px solid #d8b4fe;
  overflow: hidden;
}
#schedule-create .form .input-group .input-group-text {
  background-color: transparent;
}
#schedule-create .form .input-group .input-group-text .material-icons-outlined {
  font-size: 18px;
}
#schedule-create .form .form-control {
  padding: 13px;
  color: #3b0764;
  border: 0;
  font-size: 16px;
}
#schedule-create .form .form-control:focus {
  box-shadow: none;
}
#schedule-create .form .class-days-area {
  margin-top: 24px;
  border-radius: 16px;
  display: flex;
  align-items: flex-start;
}
#schedule-create .form .class-days-area .left-title {
  display: flex;
  align-items: center;
  padding-right: 16px;
}
#schedule-create .form .class-days-area .left-title .icon {
  height: 45px;
  width: 45px;
  background-color: #3b0764;
  border-radius: 12px;
  font-size: 21px;
  color: #fff;
  display: flex;
  align-items: center;
  justify-content: center;
  margin-right: 8px;
}
#schedule-create .form .class-days-area .left-title .tag {
  color: #525252;
  font-size: 12px;
  font-weight: 500;
}
#schedule-create .form .class-days-area .left-title .title {
  color: #052e16;
  font-size: 12px;
  font-weight: 700;
  min-width: 80px;
}
#schedule-create .form .class-days-area .week-days {
  display: flex;
  flex-wrap: wrap;
}
#schedule-create .form .class-days-area .week-days .day {
  margin-bottom: 16px;
}
#schedule-create .form .class-days-area .week-days .day:not(:last-child) {
  margin-right: 16px;
}
#schedule-create .form .class-days-area .week-days .day .schedule-btn {
  padding: 15px 24px;
  background-color: #fff;
  border-radius: 12px;
  border: 1px solid #e9d5ff;
  color: #451a03;
  font-size: 14px;
  font-weight: 700;
  line-height: 1;
}
#schedule-create .form .class-days-area .week-days .day .schedule-btn:focus {
  box-shadow: none;
}
#schedule-create .form .class-days-area .week-days .day .btn-check:checked + .schedule-btn {
  color: #fff;
  background-color: #3b0764;
  border-color: #3b0764;
}
#schedule-create .form .submit-btn {
  margin-top: 11px;
  width: 100%;
  border-radius: 16px;
  background: #22c55e;
  box-shadow: 0px 5px 10px 0px rgba(34, 197, 94, 0.2);
  padding: 13px 15px;
  color: #f0fdf4;
  font-size: 14px;
  font-weight: 700;
}/*# sourceMappingURL=main.css.map */
        </style>
@endpush

@section('content')

    {{-- @dump($batch) --}}
    @isset($batch)
        @php
            // if ($batch['startDate']) {
            // $start_date = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $batch['startDate'])->format('d/m/Y');
            // }

            $default_date = '';
            if (isset($batch['startDate'])) {
                if ($batch['startDate']) {
                    $default_date = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $batch['startDate'])->format('d/m/Y');
                }
            }

        @endphp
        {{-- @dump($batch) --}}
        <div class="mx-4 my-4">
            <div id="batch-header">
                <div>
                    <div class="icon">
                        <img src="{{ asset('img/new_icon') }}/batch_head.png" alt="">
                    </div>
                </div>
                <div class="row row-cols-4">
                    <div class="item">
                        <div class="title">Batch{{ $batch['id'] }}</div>
                        <div class="tag">ব্যাচ কোড #{{ $batch['batchCode'] ?? '' }}</div>
                    </div>
                    <div class="item">
                        <div class="title">{{ $batch['get_training']['title']['Name'] ?? '' }}</div>
                        <div class="tag">কোর্সের নাম</div>
                    </div>
                    <div class="item">
                        <div class="title">{{ $batch['GEOLocation'] ?? '' }}</div>
                        <div class="tag">ঠিকানা</div>
                    </div>
                    <div class="item">
                        <div class="title">{{ $batch['duration'] ?? '' }} দিন</div>
                        <div class="tag">মোট ক্লাস সময়কাল</div>
                    </div>
                </div>
            </div>

            <div id="schedule-create">
                <div class="row">
                    <div class="col-8">
                        <h2 class="main-title">সময়সূচী তৈরি করুন</h2>
                        <x-alert />
                        @if ($error)
                            @if (is_string($error))
                                <span class="text-danger">
                                    <div class="alert close alert-danger alert-dismissible fade show" role="alert">
                                        <strong>Error : </strong>
                                        {{ $error ?? '' }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
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

                        <form class="form" method="POST" action="{{ route('batch-schedule.store') }}">
                            @csrf
                            <input type="hidden" name="training_batch_id" value="{{ $batch['id'] }}">
                            <div class="row row-cols-2 g-4">
                                <div class="w-100">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" role="switch" name="include_holyday"
                                            id="include_holyday" value="1">
                                        <label class="label" for="include_holyday">
                                            হলিডে বিবেচনা করুন
                                        </label>
                                    </div>
                                </div>
                                <div>
                                    <label class="label" for="">ক্লাসের সময়</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <span class="material-icons-outlined">
                                                schedule
                                            </span>
                                        </span>
                                        <input type="text" class="form-control" name="class_time" id="class_time"
                                            placeholder="Select Class Time">

                                    </div>
                                    @error('class_time')
                                        <small class="text-danger d-block">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div>
                                    <label class="label" for="">সময়কাল</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <span class="material-icons-outlined">
                                                schedule
                                            </span>
                                        </span>
                                        <input type="text" class="form-control" name="class_duration"
                                            placeholder="Select Class Duration">

                                    </div>
                                    @error('class_duration')
                                        <small class="text-danger d-block">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div>
                                    <label class="label" for="">ক্লাস শুরুর তারিখ</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <span class="material-icons-outlined">
                                                calendar_month
                                            </span>
                                        </span>
                                        <input type="text" class="form-control" name="start_date" id="start_date"
                                            value="" placeholder="Select Start Date">

                                    </div>
                                    @error('start_date')
                                        <small class="text-danger d-block">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div>
                                    <label class="label" for="">সর্বমোট ক্লাসের সংখ্যা</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <span class="material-icons-outlined">
                                                calendar_today
                                            </span>
                                        </span>
                                        <input type="text" class="form-control" name="total_days"
                                            value="{{ $batch['duration'] ?? '' }}" placeholder="Select Total Days">

                                    </div>
                                    @error('total_days')
                                        <small class="text-danger d-block">{{ $message }}</small>
                                    @enderror
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
                                        <input type="checkbox" name="class_days[]" class="btn-check" id="day-sat"
                                            value="Saturday">
                                        <label class="btn schedule-btn" for="day-sat">শনি</label>
                                    </div>
                                    <div class="day">
                                        <input type="checkbox" name="class_days[]" class="btn-check" id="day-sun"
                                            value="Sunday">
                                        <label class="btn schedule-btn" for="day-sun">রবি</label>
                                    </div>
                                    <div class="day">
                                        <input type="checkbox" name="class_days[]" class="btn-check" id="day-mon"
                                            value="Monday">
                                        <label class="btn schedule-btn" for="day-mon">সোম</label>
                                    </div>
                                    <div class="day">
                                        <input type="checkbox" name="class_days[]" class="btn-check" id="day-tue"
                                            value="Tuesday">
                                        <label class="btn schedule-btn" for="day-tue">মঙ্গল</label>
                                    </div>
                                    <div class="day">
                                        <input type="checkbox" name="class_days[]" class="btn-check" id="day-wed"
                                            value="Wednesday">
                                        <label class="btn schedule-btn" for="day-wed">বুধ</label>
                                    </div>
                                    <div class="day">
                                        <input type="checkbox" name="class_days[]" class="btn-check" id="day-thu"
                                            value="Thursday">
                                        <label class="btn schedule-btn" for="day-thu">বৃহঃ</label>
                                    </div>
                                    <div class="day">
                                        <input type="checkbox" name="class_days[]" class="btn-check" id="day-fri"
                                            value="Friday">
                                        <label class="btn schedule-btn" for="day-fri">শুক্র</label>
                                    </div>

                                    <div class="w-100">
                                        @error('class_days')
                                            <small class="text-danger d-block">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <button class="btn submit-btn">সময়সূচী তৈরি করুন</button>
                        </form>

                    </div>
                    <div class="col-4">
                        <img class="clock" src="{{ asset('img') }}/clock.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    @endisset

@section('scripts')
    <script>
        $(document).ready(function() {
            let starDate = "{{ $default_date ?? '' }}";
            let dateFromatJson = {
                dateFormat: "d/m/Y"
            };

            @if (isset($default_date))
                @if ($default_date != '')
                    dateFromatJson['defaultDate'] = starDate;
                @endif
            @endif

            $("#start_date").flatpickr(dateFromatJson);

            $("#class_time").flatpickr({
                dateFormat: "H:i",
                enableTime: true,
                noCalendar: true
            });
        });
    </script>
@endsection
@endsection
