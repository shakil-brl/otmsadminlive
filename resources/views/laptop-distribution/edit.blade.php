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
                    <form method="POST" action="{{ route('laptop-distribution.update', $laptop['id']) }}" class=""
                        id="distributeForm">
                        @csrf
                        @method('PUT')
                        @include('laptop-distribution.form')
                    </form>
                </div>

            </div>
        @endisset
    </div>
@endsection
