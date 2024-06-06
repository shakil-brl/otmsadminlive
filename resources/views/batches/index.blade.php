@extends('layouts.auth-master')

@push('css')
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined:opsz,wght,FILL,GRAD@48,700,0,0"
        rel="stylesheet">
@endpush

@section('content')
    <div class="">
        @if (session('message'))
            <div class="alert alert-{{ session('type') }}">
                {{ session('message') }}
            </div>
        @endif

        <!-- Breadcrumb -->
        <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1 m-5">
            <li class="breadcrumb-item text-muted">
                <a href="{{ route('home.index') }}" class="text-muted text-hover-primary">{{ __('categorie-list.home') }}</a>
            </li>
            <li class="breadcrumb-item">
                <span class="bullet bg-gray-400 w-5px h-2px"></span>
            </li>
            <li class="breadcrumb-item text-muted">{{ __('batch-schedule.enroll_management') }}</li>
            <li class="breadcrumb-item">
                <span class="bullet bg-gray-400 w-5px h-2px"></span>
            </li>
            <li class="breadcrumb-item text-muted">
                <a href="{{ route('batch-schedule.batches') }}"
                    class="text-muted text-hover-primary">{{ __('batch-schedule.provider_batch_list') }}</a>
            </li>
        </ul>

        <!-- Content -->
        <div class="m-5">
            @isset($results)
                <div id="preloader">
                    <div class="loader"></div>
                </div>
                <div class="mb-3 p-5">
                    <form action="" method="POST">
                        @csrf
                        <div class="d-flex justify-content-between">
                            <div>
                                <select name="per_page" class="form-select" id="per_page">
                                    @foreach (range(15, 100, 15) as $j)
                                        <option value="{{ $j }}" {{ request('per_page') == $j ? 'selected' : '' }}>
                                            {{ digitLocale($j) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row row-cols-5 mt-5">
                            <div>
                                <select name="batch_status" class="form-select" id="batch_status">
                                    <option value="">Batch Status</option>
                                    <option value="1" {{ request('batch_status') == 1 ? 'selected' : '' }}>Running Batch
                                    </option>
                                    <option value="2" {{ request('batch_status') == 2 ? 'selected' : '' }}>Completed Batch
                                    </option>
                                </select>
                            </div>
                            <div>
                                <select name="schedule_status" class="form-select" id="schedule_status">
                                    <option value="">Schedule Status</option>
                                    {{-- <option value="1" {{ request('schedule_status') == 1 ? 'selected' : '' }}>Schedule Not
                                        Created</option>
                                    <option value="2" {{ request('schedule_status') == 2 ? 'selected' : '' }}>Schedule
                                        Created</option> --}}
                                    <option value="3" {{ request('schedule_status') == 3 ? 'selected' : '' }}>Schedule
                                        Created But Class Not Started</option>
                                </select>
                            </div>
                            <div>
                                <select name="trainer_count" class="form-select" id="trainer_count">
                                    <option value="">Trainer Status</option>
                                    <option value="1" {{ request('trainer_count') == 1 ? 'selected' : '' }}>No Trainer
                                    </option>
                                    <option value="2" {{ request('trainer_count') == 2 ? 'selected' : '' }}>Minimum One
                                        Trainer Assigned</option>
                                    <option value="3" {{ request('trainer_count') == 3 ? 'selected' : '' }}>One Trainer
                                    </option>
                                    <option value="4" {{ request('trainer_count') == 4 ? 'selected' : '' }}>Multiple
                                        Trainer</option>
                                </select>
                            </div>
                            <div>
                                <select name="phase_status" class="form-select" id="phase_status">
                                    <option value="">Phase Status</option>
                                    <option value="1" {{ request('phase_status') == 1 ? 'selected' : '' }}>Have Phase
                                    </option>
                                    <option value="2" {{ request('phase_status') == 2 ? 'selected' : '' }}>Doesn't Have
                                    </option>
                                </select>
                            </div>
                            <div id="phase_id_container" style="{{ request('phase_status') != 2 ? '' : 'display: none;' }}">
                                <select name="phase_id" class="form-select" id="phase_id">
                                    <option value="">Select Phase</option>
                                    @foreach ($data['phases'] as $phase)
                                        <option value="{{ $phase['id'] }}"
                                            {{ request('phase_id') == $phase['id'] ? 'selected' : '' }}>
                                            {{ $phase['name_en'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row row-cols-4 mt-2 row-cols-xxl-5 g-2 mb-2">
                            <div>
                                <label for="division_code">{{ __('batch-list.division') }}</label>
                                <select name="division_code" class="form-select" id="division_code">
                                    <option value="">{{ __('batch-list.select_division') }}</option>
                                    @foreach ($data['divisions']['data'] as $division)
                                        <option value="{{ $division['Code'] }}"
                                            {{ request('division_code') == $division['Code'] ? 'selected' : '' }}>
                                            {{ $division['Name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="district_code">{{ __('batch-list.district') }}</label>
                                <select name="district_code" class="form-select" id="district_code">
                                    <option value="">{{ __('batch-list.select_district') }}</option>
                                    <!-- Districts will be dynamically loaded here -->
                                </select>
                            </div>
                            <div>
                                <label for="upazila_code">{{ __('batch-list.upazila') }}</label>
                                <select name="upazila_code" class="form-select" id="upazila_code">
                                    <option value="">{{ __('batch-list.select_upazila') }}</option>
                                    <!-- Upazilas will be dynamically loaded here -->
                                </select>
                            </div>
                            <div>
                                <label for="provider_id">{{ __('batch-list.vendor_name') }}</label>
                                <select name="provider_id" class="form-select" id="provider_id">
                                    <option value="">{{ __('batch-list.select_vendor') }}</option>
                                    @foreach ($data['providers']['data'] as $provider)
                                        <option value="{{ $provider['id'] }}"
                                            {{ request('provider_id') == $provider['id'] ? 'selected' : '' }}>
                                            {{ $provider['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="training_id">{{ __('batch-schedule.course_name') }}</label>
                                <select name="training_id" class="form-select" id="training_id">
                                    <option value="">{{ __('batch-list.select_course') }}</option>
                                    @foreach ($data['trainings'] as $training)
                                        <option value="{{ $training['id'] }}"
                                            {{ request('training_id') == $training['id'] ? 'selected' : '' }}>
                                            {{ $training['title']['Name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="">
                                <label for="search">{{ __('batch-list.batch_code') }}</label>
                                <input type="search" name="search" id="search" value="{{ request('search') }}"
                                    class="form-control" placeholder="{{ __('batch-list.search_with_batch') }}">
                            </div>
                            <div>
                                <div>
                                    <label for=""></label>
                                </div>
                                <button type="submit" id="search_button" class="btn btn-primary">Search</button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="m-4">
                    <div id="schedule-header">
                        <div>
                            <div class="icon">
                                <img src="{{ asset('img') }}/new_icon/schedule_header.png" alt="">
                            </div>
                        </div>
                        <div class="row row-cols-3">
                            <div class="item">
                                <div class="title">{{ __('batch-list.schedule') }}</div>
                                <div class="tag">{{ __('batch-list.management') }}</div>
                            </div>
                            <div class="item">
                                <div class="title">{{ $results['total'] ?? 0 }}</div>
                                <div class="tag">{{ __('batch-list.total_batch') }}</div>
                            </div>
                        </div>
                    </div>

                    <x-alert />

                    <div id="schedule-batches">
                        <div>
                            @foreach ($results['data'] as $batch)
                                @php
                                    $schedule = $batch['schedule'] ?? null;
                                @endphp
                                <div class="batch">
                                    <div class="info">
                                        <div class="row row-cols-6">
                                            <div>
                                                <div class="label">{{ __('batch-list.batch_code') }} #</div>
                                                <div class="title">{{ $batch['batchCode'] ?? '' }}</div>
                                            </div>
                                            <div>
                                                <div class="label">{{ __('batch-list.course_name') }}</div>
                                                <div class="title">{{ $batch['get_training']['title']['Name'] ?? '' }}</div>
                                            </div>
                                            <div>
                                                <div class="label">{{ __('batch-list.address') }}</div>
                                                <div class="title">{{ $batch['GEOLocation'] ?? '' }}</div>
                                            </div>
                                            <div>
                                                <div class="label">{{ __('batch-list.total_duration') }}</div>
                                                <div class="title">{{ $batch['duration'] ?? 0 }}{{ __('batch-list.days') }}
                                                </div>
                                            </div>
                                            <div>
                                                <div class="label">{{ __('batch-list.class_start') }}</div>
                                                <div class="title">
                                                    @if ($batch['startDate'])
                                                        {{ \Carbon\Carbon::parse($batch['startDate'])->format('d-m-Y') }}
                                                    @else
                                                        Not Defined
                                                    @endif
                                                </div>
                                            </div>
                                            <div>
                                                @if (in_array('batch-schedule.index', $routePermissions))
                                                    <div class="buttons">
                                                        @if ($schedule == null)
                                                            <a href="{{ route('batch-schedule.create', encrypt($batch['id'])) }}"
                                                                class="btn schedule-btn btn-create">
                                                                {{ __('batch-list.create_schedule') }}
                                                            </a>
                                                        @else
                                                            <a href="{{ route('batch-schedule.index', [encrypt($schedule['id']), encrypt($batch['id'])]) }}"
                                                                class="btn schedule-btn btn-view">
                                                                {{ __('batch-list.view_schedule') }}
                                                            </a>
                                                        @endif
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    @if ($schedule != null)
                                        <div class="schedule">
                                            <div class="row row-cols-2">
                                                <div class="col-10">
                                                    <div class="d-flex">
                                                        <div class="class-days-area">
                                                            <div class="left-title">
                                                                <div class="icon">
                                                                    <span class="material-icons-outlined">calendar_month</span>
                                                                </div>
                                                                <div>
                                                                    <div class="tag">{{ __('batch-list.class') }}</div>
                                                                    <div class="title">{{ __('batch-list.class_days') }}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @php
                                                                $days = explode(',', $schedule['class_days']);
                                                            @endphp
                                                            <div class="week-days">
                                                                @if (in_array('Saturday', $days))
                                                                    <div class="day sat">{{ __('batch-list.class_day_sat') }}
                                                                    </div>
                                                                @endif
                                                                @if (in_array('Sunday', $days))
                                                                    <div class="day sun">{{ __('batch-list.class_day_sun') }}
                                                                    </div>
                                                                @endif
                                                                @if (in_array('Monday', $days))
                                                                    <div class="day mon">{{ __('batch-list.class_day_mon') }}
                                                                    </div>
                                                                @endif
                                                                @if (in_array('Tuesday', $days))
                                                                    <div class="day tue">{{ __('batch-list.class_day_tue') }}
                                                                    </div>
                                                                @endif
                                                                @if (in_array('Wednesday', $days))
                                                                    <div class="day wed">{{ __('batch-list.class_day_wed') }}
                                                                    </div>
                                                                @endif
                                                                @if (in_array('Thursday', $days))
                                                                    <div class="day thu">{{ __('batch-list.class_day_thu') }}
                                                                    </div>
                                                                @endif
                                                                @if (in_array('Friday', $days))
                                                                    <div class="day fri">{{ __('batch-list.class_day_fri') }}
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <div class="class-days-area class-time">
                                                            <div class="left-title">
                                                                <div class="icon">
                                                                    <span class="material-icons-outlined">schedule</span>
                                                                </div>
                                                                <div>
                                                                    <div class="tag">
                                                                        {{ __('batch-list.class_start_time') }}</div>
                                                                    <div class="title">{{ __('batch-list.time') }}</div>
                                                                </div>
                                                            </div>
                                                            <div class="week-days">
                                                                <div class="day sat">
                                                                    {{ \Carbon\Carbon::createFromFormat('H:i:s', $schedule['class_time'])->format('h:i A') }}{{ __('batch-schedule.time_ta') }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-2">
                                                    {{-- Update button can go here --}}
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                {{ $paginator->links() }}
            @endisset
        </div>
    </div>


@endsection

@push('js')
    <script>
        $(document).ready(function() {
            $('#phase_status').change(function() {
                if ($(this).val() != 2) {
                    $('#phase_id_container').show();
                } else {
                    $('#phase_id_container').hide();
                    $('#phase_id').val('');
                }
            });

            $('#division_code').change(function() {
                let division_id = $(this).val();
                if (division_id) {
                    let encodedDivisionId = encodeURIComponent(division_id);
                    let url = `${api_baseurl}detail/district?division_code=${encodedDivisionId}`;
                    $.ajax({
                        url: url,
                        method: 'GET',
                        headers: {
                            Authorization: authToken,
                        },
                        success: function(data) {
                            var district_select = $('#district_code');
                            district_select.empty();
                            district_select.append(
                                '<option value="">{{ __('batch-list.select_district') }}</option>'
                            );
                            $.each(data.data.data, function(index, district) {
                                district_select.append('<option value="' + district
                                    .Code +
                                    '">' + district.Name + '</option>');
                            });
                        },
                        error: function() {
                            alert('Failed to load districts.');
                        }
                    });
                } else {
                    $('#district_code').empty().append(
                        '<option value="">{{ __('batch-list.select_district') }}</option>');
                    $('#upazila_code').empty().append(
                        '<option value="">{{ __('batch-list.select_upazila') }}</option>');
                }
            });

            $('#district_code').change(function() {
                let district_id = $(this).val();
                if (district_id) {
                    let encodedDistrictId = encodeURIComponent(district_id);
                    let url = `${api_baseurl}detail/upazila?district_code=${encodedDistrictId}`;
                    $.ajax({
                        url: url,
                        method: 'GET',
                        headers: {
                            Authorization: authToken,
                            'district_code': district_id
                        },
                        success: function(data) {
                            var upazila_select = $('#upazila_code');
                            upazila_select.empty();
                            upazila_select.append(
                                '<option value="">{{ __('batch-list.select_upazila') }}</option>'
                            );
                            $.each(data.data.data, function(index, upazila) {
                                upazila_select.append('<option value="' + upazila.Code +
                                    '">' + upazila.Name + '</option>');
                            });
                        },
                        error: function() {
                            alert('Failed to load upazilas.');
                        }
                    });
                } else {
                    $('#upazila_code').empty().append(
                        '<option value="">{{ __('batch-list.select_upazila') }}</option>');
                }
            });

            // Load the districts if division is already selected
            if ($('#division_code').val()) {
                $('#division_code').trigger('change');
            }

            // Load the upazilas if district is already selected
            if ($('#district_code').val()) {
                $('#district_code').trigger('change');
            }
        });
    </script>
@endpush
