@extends('layouts.auth-master')
@push('css')
    <style>
        .form-check-input:disabled {
            opacity: 1;
        }
    </style>
@endpush
@section('content')
    @empty(!$students)
        <div id="batch-header">
            <div>
                <div class="icon">
                    <img src="{{ asset('img') }}/new_icon/batch_head.png" alt="">
                </div>
            </div>
            <div class="row row-cols-4">
                <div class="item">
                    <div class="title"> {{ $students[0]['schedule_detail']['schedule']['training_batch']['batchCode'] ?? '' }}
                    </div>
                    <div class="tag">{{ __('batch-schedule.batch_code') }} #</div>
                </div>
                <div class="item">
                    <div class="title">
                        {{ $students[0]['schedule_detail']['schedule']['training_batch']['GEOLocation'] ?? '' }}</div>
                    <div class="tag">{{ __('batch-schedule.address') }}</div>
                </div>
                <div class="item">
                    <div class="title">{{ $students[0]['schedule_detail']['date'] ?? '' }} </div>
                    <div class="tag">{{ 'Date' }}</div>
                </div>
            </div>
        </div>
    @endempty
    <!--begin::Content-->
    <div id="students">
        @foreach ($students as $index => $student)
            <div class="student">
                <div class="row row-cols-3 align-items-center">
                    <div>
                        <div class="label">সিরিয়াল #</div>
                        <div class="text">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</div>
                    </div>
                    <div>
                        <label for="student{{ $loop->iteration }}" class="">
                            <div class="label">প্রশিক্ষণার্থীর নাম</div>
                            <div class="text">{{ $student['profile']['KnownAs'] }}</div>
                        </label>
                    </div>
                    <div>
                        <div class="form-check form-switch attendance">
                            <a href="{{ route('trainer-schedule-details.show-student-evaluation', [$student['id']]) }}"
                                class="btn btn-primary">
                                {{ 'Evaluations' }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    </div>

    <div class="row">
        @empty($students)
            <div class="m-4 col-12">
                <div id="batch-header" class="d-block text-center">
                        <h3>{{ 'এই ব্যাচের কোনো শিক্ষার্থী নেই' }}</h3>
                </div>
            </div>
        @endempty

    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            var totalStudent = {{ count($students) }};

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
        });
    </script>
@endpush
