@extends('layouts.auth-master')
@push('css')
    <style>
        .form-check-input:disabled {
            opacity: 1;
        }

        .rating {
            display: inline-block;
        }

        .rating input {
            display: none;
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

            <form method="POST" action="" class="m-5">
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
                                                <div class="text mx-13"><input name="attendance[]" class="form-check-input"
                                                        type="checkbox" role="switch" id="student{{ $loop->iteration }}"
                                                        value="{{ $question['id'] }}"></div>
                                            </div>
                                        @else
                                            <div class="rating">
                                                <input type="radio" name="rating" value="5" id="star5">
                                                <label for="star5">&#9733;</label>
                                                <input type="radio" name="rating" value="4" id="star4">
                                                <label for="star4">&#9733;</label>
                                                <input type="radio" name="rating" value="3" id="star3">
                                                <label for="star3">&#9733;</label>
                                                <input type="radio" name="rating" value="2" id="star2">
                                                <label for="star2">&#9733;</label>
                                                <input type="radio" name="rating" value="1" id="star1">
                                                <label for="star1">&#9733;</label>
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
            var totalStudent = '';

            function countAttendance() {
                let att = 0;
                $('#students .form-switch.attendance').each(function(index, element) {
                    if ($(this).children('input').prop('checked')) {
                        att++;
                    }
                });
                let percentage = att * 100 / totalStudent;
                $('#totalAttendance').html(att);
                $('#success-progress').css('width', percentage + '%');
            }
            countAttendance();
            $('.form-switch.attendance').change(function() {
                countAttendance();
            });

            $("#selectAll").click(function() {
                if ($(this).prop('checked')) {
                    $('.attendance').prop('checked', true);
                } else {
                    $('.attendance').prop('checked', false);
                }
            });

            // Check Radio-box
            $(".rating input:radio").attr("checked", false);

            $('.rating input').click(function() {
                $(".rating span").removeClass('checked');
                $(this).parent().addClass('checked');
            });

            $('input:radio').change(
                function() {
                    var userRating = this.value;
                    alert(userRating);
                });


        });
    </script>
@endpush
