@extends('layouts.auth-master')
@push('css')
<link
    href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp"
    rel="stylesheet">
@endpush
@section('content')
@php
$userAuth = Session::get('authUser');
$userRole = $userAuth['userRole'];
@endphp
<div class="m-5">
    <div id="main-content bg-warning">
        <div class="page-content" style="background-color: transparent;">
            <div class="m-4">

                <div class="row g-4 row-cols-3 cards" id="dashboard-card">

                    <div>
                        <x-dashboard-card :url="route('dashboard_details.total_batches')"
                            :totalBatch="$data['total_batch'] ?? 0" :icon="asset('img/new_icon/total_batch.png')"
                            :title="__('dashboard.total_batch')" :class="'card-item purple'" />
                    </div>


                    <div>
                        <x-dashboard-card :url="route('dashboard_details.running_batches')"
                            :totalBatch="$data['running_batch'] ?? 0" :icon="asset('img/new_icon/current_batch.png')"
                            :title="__('dashboard.running_batch')" :class="'card-item yellow'" />
                    </div>


                    <div>
                        <x-dashboard-card :url="route('dashboard_details.complete_batches')"
                            :totalBatch="$data['completed_batch']" :icon="asset('img/new_icon/completed_batch.png')"
                            :title="__('dashboard.complete_batch')" :class="'card-item green'" />
                    </div>

                    <div>
                        <x-dashboard-card :url="route('dashboard_details.districts')"
                            :totalBatch="$data['complete_class'] ?? 0" :icon="asset('img/new_icon/district.png')"
                            :title="__('Complete Class')" :class="'card-item purple'" />
                    </div>
                    <div>
                        <x-dashboard-card :url="route('batch-schedule.runningBatches')"
                            :totalBatch="$data['running_class'] ?? 0" :icon="asset('img/new_icon/partner.png')"
                            :title="__('Ongoing Class')" :class="'card-item red'" />
                    </div>
                    <div>
                        <x-dashboard-card :url="route('dashboard_details.districts')"
                            :totalBatch="$data['total_district'] ?? 0" :icon="asset('img/new_icon/district.png')"
                            :title="__('dashboard.district')" :class="'card-item green-white'" />
                    </div>

                    {{-- <div>
                        <x-dashboard-card :url="route('batch-schedule.runningBatches')"
                            :totalBatch="$data['total_district'] ?? 0" :icon="asset('img/new_icon/district.png')"
                            :title="__('Ongoing Class')" :class="'card-item purple'" />
                    </div> --}}


                    <div>
                        <x-dashboard-card :url="route('dashboard_details.upazilas')"
                            :totalBatch="$data['total_upazila'] ?? 0" :icon="asset('img/new_icon/upazila.png')"
                            :title="__('dashboard.upazila')" :class="'card-item info'" />
                    </div>
                    <div>
                        <x-dashboard-card :url="route('dashboard_details.partners')"
                            :totalBatch="$data['total_vendor'] ?? 0" :icon="asset('img/new_icon/partner.png')"
                            :title="__('dashboard.partner')" :class="'card-item red'" />
                    </div>
                </div>

                <div id="dashboard-attendance">
                    <div class="row align-items-stretch">
                        <div class="col-7">
                            <div id="attendance-summery">
                                <div class="header">
                                    <div class="left menu">
                                        <a class="link active" href="#">{{ __('dashboard.todays') }}</a>
                                        <a class="link" href="#">{{ __('dashboard.weekly') }}</a>
                                        <a class="link" href="#">{{ __('dashboard.monthly') }}</a>
                                    </div>
                                    <div class="right menu">
                                        <a class="link" href="#">{{ __('dashboard.details') }}</a>
                                    </div>
                                </div>
                                <div>
                                    <div class="content">
                                        <div class="icon">
                                            <img src="{{ asset('img/new_icon') }}/attendance.png" alt="">
                                        </div>
                                        <div class="attendance">
                                            <div class="items">
                                                <div class="item">
                                                    <div class="digit">{{ $data['total_attend_today'] ?? 0 }}</div>
                                                    <div class="label">{{ __('dashboard.total_present') }}</div>
                                                </div>
                                                <div class="item">
                                                    {{-- <div class="digit">66%</div>
                                                    <div class="label">{{ __('dashboard.percentage_attendance') }}
                                                    </div> --}}
                                                </div>
                                            </div>
                                            <div class="items">
                                                <div class="item">
                                                    <div class="digit">{{ $data['total_trainee'] }}</div>
                                                    <div class="label">{{ __('dashboard.average_attendance') }}
                                                    </div>
                                                </div>
                                                <div class="item">
                                                    <div class="digit">{{$data['total_dropout']}}</div>
                                                    <div class="label">{{ __('dashboard.dropout_trainee') }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-5">
                            <div id="attendance-chart d-none" class="h-100">
                                <div class="chart-item">
                                    <div class="bar" style="height: 70%;">
                                        {{-- <span class="bar-text">75%</span> --}}
                                    </div>
                                    <div class="label">{{ __('dashboard.class_day_sat') }}</div>
                                </div>

                                <div class="chart-item">
                                    <div class="bar danger" style="height: 0%;">
                                        {{-- <span class="bar-text">25%</span> --}}
                                    </div>
                                    {{-- <div class="label">{{ __('dashboard.class_day_sun') }}</div> --}}
                                </div>

                                <div class="chart-item">
                                    <div class="bar" style="height: 95%;">
                                        <span class="bar-text">100%</span>
                                    </div>
                                    <div class="label">{{ __('dashboard.class_day_mon') }}</div>
                                </div>

                                <div class="chart-item">
                                    <div class="bar" style="height: 35%;">
                                        <span class="bar-text">35%</span>
                                    </div>
                                    <div class="label">{{ __('dashboard.class_day_tue') }}</div>
                                </div>

                                <div class="chart-item">
                                    <div class="bar" style="height: 90%;">
                                        <span class="bar-text">100%</span>
                                    </div>
                                    <div class="label">{{ __('dashboard.class_day_wed') }}</div>
                                </div>

                                <div class="chart-item">
                                    <div class="bar" style="height: 50%;">
                                        <span class="bar-text">55%</span>
                                    </div>
                                    <div class="label">{{ __('dashboard.class_day_thu') }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="allownce">
                    <div class="row  align-items-stretch">

                        <div class="col-7">
                            <a href="{{ route('dashboard_details.trainers') }}">
                                <div class="trainer-info">
                                    <div id="attendance-summery">
                                        <div>
                                            <div class="content">
                                                <div class="icon">
                                                    <img src="{{ asset('img/new_icon') }}/trainer.png" alt="">
                                                </div>
                                                <div class="attendance">
                                                    <div class="items">
                                                        <div class="item">
                                                            <div class="digit">{{ $data['total_trainer'] ?? 0 }}
                                                            </div>
                                                            <div class="label">{{ __('dashboard.total_trainer') }}
                                                            </div>
                                                        </div>
                                                        <div class="item">
                                                            <div class="digit"></div>
                                                            <div class="label">
                                                                {{-- {{ __('dashboard.top_trainer') }} --}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="items">
                                                        {{-- <div class="item">
                                                            <div class="digit">20000</div>
                                                            <div class="label">
                                                                {{ __('dashboard.reserve_trainer') }}
                                                            </div>
                                                        </div> --}}
                                                        {{-- <div class="item">
                                                            <div class="digit">7</div>
                                                            <div class="label">{{ __('dashboard.lack_trainer') }}
                                                            </div>
                                                        </div> --}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <a href="{{ route('traineeEnroll.index') }}">
                                <div class="student-info">
                                    <div id="attendance-summery">
                                        <div>
                                            <div class="content">
                                                <div class="icon">
                                                    <img src="{{ asset('img/new_icon') }}/student_info.png" alt="">
                                                </div>
                                                <div class="attendance">
                                                    <div class="items">
                                                        <div class="item">
                                                            <div class="digit">{{ $data['total_trainee'] ?? 0 }}
                                                            </div>
                                                            <div class="label">
                                                                {{ __('dashboard.total_trainee') }}
                                                            </div>
                                                        </div>

                                                        <div class="item">
                                                            <div class="digit">{{ $data['total_dropout']}}</div>
                                                            <div class="label">
                                                                {{ __('dashboard.dropout_trainee') }}
                                                            </div>
                                                            {{-- <div class="digit">66%</div>
                                                            <div class="label">
                                                                {{ __('dashboard.successful_freelancer') }}</div> --}}
                                                        </div>
                                                    </div>

                                                    {{-- <div class="items">
                                                        <div class="item">
                                                            <div class="digit">{{ $data['total_dropout']}}</div>
                                                            <div class="label">
                                                                {{ __('dashboard.dropout_trainee') }}
                                                            </div>
                                                        </div>
                                                    </div> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>


                        <div class="col-5">
                            <div id="py-chart">
                                <div id="attendance-summery">
                                    <div>
                                        <div class="content">
                                            <div class="icon">
                                                <img src="{{ asset('img/new_icon') }}/alownce.png" alt="">
                                            </div>
                                            <div class="attendance">
                                                <div class="items d-block">
                                                    <div class="item">
                                                        <div class="digit">{{ $data['total_trainee'] ?? 0 }}
                                                        </div>
                                                        <div class="label">{{ __('dashboard.total_trainee') }}
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                        <div>
                                            <canvas id="allownceChart"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection