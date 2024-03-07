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
        <x-alert />
        @if (session('error_message'))
            <div class="alert alert-danger">
                <ul class="m-0 text-danger">
                    @foreach (session('error_message') ?? [] as $neme => $err)
                        @foreach ($err as $e)
                            <li>
                                {{ $e }}
                            </li>
                        @endforeach
                    @endforeach
                </ul>
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @isset($class_details)
            @php
                $students = $class_details['students'];
            @endphp
            <div class="card">
                <div class="h3 p-5 d-flex justify-content-between align-items-center card-header">
                    <div>Total Class: {{ $class_details['total_class'] }}</div>
                    <div>Trainee List</div>
                    @if (isset($laptop))
                        <div>Distribute Date: {{ \Carbon\Carbon::parse($laptop['distribution_date'])->format('d-m-Y') }}</div>
                    @else
                        <div>Today: {{ date('d-m-Y') }}</div>
                    @endif

                </div>
                <div class="">
                    <div class="m-3">
                        <table class="table table-bordered bg-white">
                            <thead>
                                <tr>
                                    <th>Serial</th>
                                    <th>Trainee Name</th>
                                    <th>Class Attended</th>
                                    <th>Serial No.</th>
                                    <th>Agreement No.</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($students) > 0)
                                    @foreach ($students as $index => $student)
                                        @php
                                            $found_entry = null;
                                        @endphp
                                        @isset($laptop)
                                            @php
                                                foreach ($laptop['laptop_details'] as $entry) {
                                                    if ($entry['applicant_id'] == $student['ProfileId']) {
                                                        $found_entry = $entry;
                                                        break;
                                                    }
                                                }
                                            @endphp
                                        @endisset
                                        <tr id="students">
                                            <td>
                                                <div class="form-check">
                                                    <input name="applicant_id[]" class="form-check-input toggle-checkbox"
                                                        type="checkbox" role="switch" id="student{{ $loop->iteration }}"
                                                        value="{{ $student['ProfileId'] }}"
                                                        {{ $found_entry ? 'checked' : '' }} disabled>

                                                    <label class="form-check-label" for="student{{ $loop->iteration }}">
                                                        {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}
                                                    </label>
                                                </div>
                                            </td>
                                            <td>{{ $student['profile']['KnownAs'] }}</td>
                                            <td>
                                                {{ $student['total'] }}
                                                ({{ number_format(($student['total'] * 100) / $class_details['total_class'], 2) }}%)
                                            </td>
                                            <td>
                                                <input type="text" name="laptop_serial[]" class="form-control"
                                                    {{ $found_entry ? '' : 'disabled' }}
                                                    value="{{ $found_entry['laptop_serial'] ?? '' }}" readonly>
                                            </td>
                                            <td>
                                                <input type="text" name="agr_num[]" class="form-control"
                                                    {{ $found_entry ? '' : 'disabled' }}
                                                    value="{{ $found_entry['agr_num'] ?? '' }}" readonly>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr class="student">
                                        <td colspan="5">No Trainee Found</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                        <div class="w-50">
                            <label for="remark" class="form-label">Remark:</label>
                            <input type="text" class="form-control" name="remark" id="remark"
                                value="{{ $laptop['remark'] ?? old('remark') }}" placeholder="Remark">
                            </input>
                            @error('remark')
                                <small class="text-danger d-block">{{ $message }}</small>
                            @enderror
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
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            // Enable/disable inputs based on checkbox state
            // $('.toggle-checkbox').change(function() {
            //     var isChecked = $(this).is(':checked');
            //     $(this).closest('tr').find('input[name="laptop_serial[]"], input[name="agr_num[]"]').prop(
            //         'disabled', !isChecked);
            // });

            var totalStudent = {{ count($students) }};

            function countDistribute() {
                let att = 0;
                $('#students .form-check-input.toggle-checkbox').each(function(index, element) {
                    if ($(this).prop('checked')) {
                        att++;
                    }
                });
                let percentage = att * 100 / totalStudent;
                $('#totalDistribute').text(att);
                $('#success-progress').css('width', percentage + '%');
            }

            countDistribute();

            $('.toggle-checkbox').change(function() {
                countDistribute();
            });
        });
    </script>
@endpush
