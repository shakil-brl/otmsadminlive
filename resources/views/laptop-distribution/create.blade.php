@extends('layouts.auth-master')
@push('css')
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined:opsz,wght,FILL,GRAD@48,700,0,0"
        rel="stylesheet">
@endpush
@section('content')
    <div class="m-4">
        @isset($batch)
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
        @endisset

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

        @isset($class_details)
            @dump($class_details)
            @php
                $students = $class_details['students'];
            @endphp
            <div>
                <div class="mb-2 bg-white h3 rounded-2 p-5 d-flex justify-content-between">
                    <div>Total Class: {{ $class_details['total_class'] }}</div>
                    <div>Trainee List</div>
                    <div>Today: {{ date('d-m-Y') }}</div>
                </div>
                <form method="POST" action="" class="" id="distributeForm">
                    @csrf
                    <input type="hidden" name="batch_id" value="{{ $batch['id'] }}">
                    <input type="hidden" name="total_student" value="{{ count($students) }}">
                    <div class="m-3">
                        <div id="students">
                            @if (count($students))
                                @foreach ($students as $index => $student)
                                    <div class="student">
                                        <div class="row row-cols-4 align-items-center">
                                            <div>
                                                <div class="label"> {{ __('batch-list.serial') }}#</div>
                                                <div class="text">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</div>
                                            </div>
                                            <div>
                                                <label for="student{{ $loop->iteration }}" class="">
                                                    <div class="label"> {{ __('batch-list.trainee_name') }}</div>
                                                    <div class="text">{{ $student['profile']['KnownAs'] }}</div>
                                                </label>
                                            </div>
                                            <div>
                                                <label for="student{{ $loop->iteration }}" class="">
                                                    <div class="label">Class Attended</div>
                                                    <div class="text">
                                                        {{ $student['total'] }}
                                                        ({{ number_format(($student['total'] * 100) / $class_details['total_class'], 2) }}%)
                                                    </div>
                                                </label>
                                            </div>
                                            <div class="d-flex jusitfy-content-between align-items-center gap-2">
                                                <div class="d-flex flex-column align-items-center gap-2 form-check distribute">
                                                    <label for="student{{ $loop->iteration }}" class="label">
                                                        Distribute
                                                    </label>
                                                    <input name="all_trainee[]" class="form-check-input toggle-checkbox"
                                                        type="checkbox" role="switch" id="student{{ $loop->iteration }}"
                                                        value="{{ $student['ProfileId'] }}">
                                                </div>
                                                <div class="upload-container" style="display: none;">
                                                    <input type="file" name="documents[]" class="form-control"
                                                        accept=".pdf,.doc,.docx">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="student">
                                    No Trainee Found
                                </div>
                            @endif

                        </div>

                        <div id="attendance-bottom">
                            <div class="left">
                                <div class="label">
                                    Trainee (Laptop Given)
                                    <span id="totalDistribute"></span>/<span>{{ count($students) }}</span>
                                </div>
                                <div class="attendance-progress">
                                    <div class="success" id="success-progress" style=""></div>
                                </div>
                            </div>
                            <div class="right">
                                <button class="btn btn-success" type="submit">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        @endisset
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            $(".toggle-checkbox").change(function() {
                var $container = $(this).closest('div').next('.upload-container');
                if ($(this).is(":checked")) {
                    $container.show();
                } else {
                    $container.hide();
                }
            });

            var totalStudent = {{ count($students) }};

            function countDistribute() {
                let att = 0;
                $('#students .form-check.distribute').each(function(index, element) {
                    if ($(this).children('input').prop('checked')) {
                        att++;
                    }
                });
                let percentage = att * 100 / totalStudent;
                $('#totalDistribute').html(att);
                $('#success-progress').css('width', percentage + '%');
            }
            countDistribute();
            $('.form-check.distribute').change(function() {
                countDistribute();
            });
        });
    </script>
@endpush
