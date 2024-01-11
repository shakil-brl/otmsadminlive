@extends('layouts.auth-master')
@push('css')
    <style>
        .form-check-input:disabled {
            opacity: 1;
        }

        .rating {
            display: inline-block;
        }

        .rating label {
            font-size: 30px;
            color: #ddd;
            cursor: pointer;
        }

        .rating label:hover,
        .rating label:hover~label,
        .rating input:checked~label {
            color: #f8d301;
        }
    </style>
@endpush
@section('content')
    <div class="m-4">
        <div id="batch-header">
            <div>
                <div class="icon">
                    <img src="{{ asset('img') }}/new_icon/batch_head.png" alt="">
                </div>
            </div>
            <div class="row row-cols-4">
                <div class="item">
                    <div class="title"> {{ $students['schedule_detail']['schedule']['training_batch']['batchCode'] ?? '' }}
                    </div>
                    <div class="tag">{{ __('batch-schedule.batch_code') }} #</div>
                </div>
                <div class="item">
                    <div class="title">{{ $students['profile']['KnownAsBangla'] ?? '' }}</div>
                    <div class="tag">{{ 'Student Name' }}</div>
                </div>
                <div class="item">
                    <div class="title">
                        {{ $students['schedule_detail']['schedule']['training_batch']['GEOLocation'] ?? '' }}</div>
                    <div class="tag">{{ __('batch-schedule.address') }}</div>
                </div>
                <div class="item">
                    <div class="title">{{ $students['schedule_detail']['date'] ?? '' }} </div>
                    <div class="tag">{{ 'Date' }}</div>
                </div>
            </div>
        </div>
        <!--begin::Content-->
        <div id="class-days">

            <form method="POST" action="{{ route('trainer-schedule-details.store-student-evaluation', $class_att_id) }}"
                class="m-5">
                @csrf
                <input type="hidden" name="schedule_detail_id" value="">
                <div class="m-3">
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
                    <div id="students">

                        @foreach ($head as $index => $question)
                            <div class="student">
                                <div class="row row-cols-3 align-items-center">
                                    <div>
                                        <div class="label">সিরিয়াল #</div>
                                        <div class="text">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</div>
                                    </div>
                                    <div>
                                        <label for="student{{ $loop->iteration }}" class="">
                                            <div class="label">মূল্যায়ন প্রশ্ন</div>
                                            <div class="text">{{ $question['title'] }}</div>
                                        </label>
                                    </div>
                                    <div>
                                        @if ($question['is_bool'] == 1)
                                            <div class="form-check form-switch">
                                                <div class="label" style="padding: 0px;margin:0px;">হ্যাঁ/না</div>

                                                <div class="text mx-13"><input name="heads[{{ $question['id'] }}]"
                                                        class="form-check-input" type="checkbox" role="switch"
                                                        id="student{{ $loop->iteration }}"
                                                        value="{{ $question['mark'] }}">
                                                </div>
                                            </div>
                                        @else
                                            <div class="rating">
                                                @foreach (range(1, $question['max_value']) as $max_val)
                                                    <input hidden type="radio" name="heads[{{ $question['id'] }}]"
                                                        value="{{ $max_val }}"
                                                        id="star{{ $question['id'] . $loop->iteration }}">
                                                    <label
                                                        for="star{{ $question['id'] . $loop->iteration }}">&#9733;</label>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>

                            </div>
                        @endforeach
                    </div>
                    <div class="row">
                        <div class="col-sm-2 mt-10 m-auto">
                            <div id="attendance-bottom">
                                <div class="right">
                                    <button class="btn btn-attendance" name="submit" value="attendance">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
            </form>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {


        });
    </script>
@endpush
