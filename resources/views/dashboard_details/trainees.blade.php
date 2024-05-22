@extends('layouts.auth-master')
@section('content')
    <div class="m-5">
        <div id="batch-header" class="mb-1">
            @php
                $first_trainee = collect($trainees)->first() ?? [];
                $batch = $first_trainee['training_batch'] ?? [];
            @endphp
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
                    <div class="title">
                        {{ $batch['training']['title']['Name'] ?? '' }}
                    </div>
                    <div class="tag">{{ __('batch-schedule.course_name') }}</div>
                </div>
                <div class="item">
                    <div class="title">{{ $batch['GEOLocation'] ?? '' }}</div>
                    <div class="tag">{{ __('batch-schedule.address') }}</div>
                </div>
                <div class="item">
                    <div class="title">{{ $batch['duration'] ?? '' }}
                        {{ __('batch-schedule.days') }}</div>
                    <div class="tag">{{ __('batch-schedule.total_class_days') }}</div>
                </div>
            </div>
        </div>

        <form action="" class="mt-4">
            <div class="d-flex flex-wrap justify-content-between">
                <h1 class="page-heading d-flex mb-4 text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                    {{ __('trainee-enrollment-list.trainee_enrollment') }}
                </h1>
                <div class="input-group mb-4" style="max-width: 400px;">
                    <input type="search" name="search" value="{{ request('search') }}" class="form-control"
                        placeholder="{{ __('batch-list.search_here') }}">
                    <button type="submit" class="btn btn-primary input-group-text">
                        {{ __('batch-list.search') }}</button>
                </div>
            </div>
        </form>
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered">
                    <thead class="bg-secondary">
                        <tr>
                            <th>সিরিয়াল নং</th>
                            <th>নাম</th>
                            <th>ইমেইল</th>
                            <th>জাতীয় পরিচয়পত্র</th>
                            <th>মোবাইল নং</th>
                            <th>পিতার নাম</th>
                            <th>মাতার নাম</th>
                            <th>বর্তমান ঠিকানা</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($trainees as $trainee)
                            <tr>
                                <td>
                                    {{ $page_from + $loop->index }}
                                </td>
                                <td>{{ $trainee['profile']['KnownAs'] ?? '' }}</td>
                                <td>{{ $trainee['profile']['Email'] ?? '' }}</td>
                                <td>{{ $trainee['profile']['NID'] ?? '' }}</td>
                                <td>{{ $trainee['profile']['Phone'] ?? '' }}</td>
                                <td>{{ $trainee['profile']['FatherNameBangla'] ?? '' }}</td>
                                <td>{{ $trainee['profile']['MotherNameBangla'] ?? '' }}</td>
                                <td>{{ $trainee['profile']['address_present'] ?? '' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{ $paginator->links() }}
            </div>
        </div>
    </div>
@endsection
