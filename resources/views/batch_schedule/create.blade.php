@extends('layouts.auth-master')
@push('css')
<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined:opsz,wght,FILL,GRAD@48,700,0,0"
    rel="stylesheet">
@endpush

@section('content')
@isset($batch)
@php
// if ($batch['startDate']) {
// $start_date = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $batch['startDate'])->format('d/m/Y');
// }

$start_date = empty($batch['startDate']) ? '' : date('d/m/Y', strtotime($batch['startDate']));
$default_date = null;
if (isset($batch['startDate'])) {
if ($batch['startDate']) {
$default_date = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$batch['startDate'] )->format('d/m/Y');
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
                <h2 class="main-title">সময়সূচী তৈরি করুন ( ক্লাস শুরু ০২ নভেম্বর ২০২৩)</h2>
                <x-alert />
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
                                <input type="text" class="form-control" name="start_date" id="start_date" value=""
                                    placeholder="Select Start Date">

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
            let starDate = "{{$default_date}}";
            $("#start_date").flatpickr({
                dateFormat: "d/m/Y",
                defaultDate: starDate
            });

            $("#class_time").flatpickr({
                dateFormat: "H:i",
                enableTime: true,
                noCalendar: true
            });
        });
</script>
@endsection
@endsection