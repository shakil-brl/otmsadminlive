@extends('layouts.auth-master')
@push('css')
    <style>
        .form-check-input:disabled {
            opacity: 1;
        }
    </style>
@endpush
@section('content')
    <!--begin::Content-->
    @php
        $status = $students[0]['schedule_detail']['status'] ?? -1;
    @endphp

    <form method="POST" action="{{ route('attendance.take-attendance', $detail_id) }}" class="m-5">
        @csrf
        <input type="hidden" name="schedule_detail_id" value="{{ $detail_id }}">
        <div class="m-3">
            {{-- <div id="batch-header">
                <div>
                    <div class="icon">
                        <img src="{{ asset('img') }}/new_icon/batch_head.png" alt="">
                    </div>
                </div>
                <div class="row row-cols-4">
                    <div class="item">
                        <div class="title">
                            {{ $students[0]['schedule_detail']['schedule']['training_batch']['batchCode'] ?? '' }}</div>
                        <div class="tag">ব্যাচ কোড #</div>
                    </div>
                    <div class="item">
                        <div class="title">
                            {{ $students[0]['schedule_detail']['schedule']['training_batch']['training']['title']['Name'] ?? '' }}
                        </div>
                        <div class="tag">কোর্সের নাম</div>
                    </div>
                    <div class="item">
                        <div class="title">
                            {{ $students[0]['schedule_detail']['schedule']['training_batch']['GEOLocation'] ?? '' }}</div>
                        <div class="tag">ঠিকানা</div>
                    </div>
                    <div class="item">
                        <div class="title">
                            {{ $students[0]['schedule_detail']['schedule']['training_batch']['duration'] ?? '' }} দিন</div>
                        <div class="tag">মোট ক্লাস সময়কাল</div>
                    </div>
                </div>
            </div> --}}
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
                                    <input @if ($status == 3) disabled @endif name="attendance[]"
                                        @checked($student['is_present'] == 1) class="form-check-input" type="checkbox" role="switch"
                                        id="student{{ $loop->iteration }}" value="{{ $student['ProfileId'] }}">
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>

            <div id="attendance-bottom">
                <div class="left">
                    <div class="label">
                        উপস্থিত প্রশিক্ষণার্থী
                        <span id="totalAttendance"></span>/<span>{{ count($students) }}</span>
                    </div>
                    <div class="attendance-progress">
                        <div class="success" id="success-progress" style=""></div>
                    </div>
                </div>
                <div class="right">
                    @if ($status == 2)
                        <button class="btn btn-attendance" name="submit" value="attendance">সাবমিট অ্যাটেনডেন্স</button>
                        <button class="btn btn-end" name="submit" value="end">শেষ ক্লাস</button>
                    @endif
                </div>
            </div>
        </div>

    </form>
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
