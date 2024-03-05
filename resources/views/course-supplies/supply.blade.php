@extends('layouts.auth-master')

@section('content')
    <div class="m-5">
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

        @isset($combos['data'])
            <div class="card my-3 p-5">
                <h3>Available Combo List:</h3>
                <div class="mb-3">
                    <form action="">
                        <div class="w-50 d-flex gap-3">
                            <input type="search" name="search" value="{{ request('search') }}" class="form-control w-75"
                                placeholder="Search combo">
                            <input type="submit" class="form-control btn btn-primary w-25" value="Search">
                        </div>
                    </form>
                </div>
                <table class="table table-bordered">
                    <thead>
                        <th>S.N.</th>
                        <th>Name</th>
                        <th>Phase</th>
                        <th class="text-center">Actions</th>
                    </thead>
                    <tbody>
                        @if (count($combos['data']) > 0)
                            @foreach ($combos['data'] ?? [] as $index => $combo)
                                @php
                                    $from = $combos['from'];
                                @endphp
                                <tr>
                                    <td>
                                        {{ $from + $loop->iteration - 1 }}
                                    </td>
                                    <td>
                                        {{ $combo['name'] ?? '' }}
                                    </td>
                                    <td>
                                        {{ $combo['phase']['name_en'] ?? '' }}
                                    </td>

                                    <td class="text-center">
                                        @if (in_array('course-supplies.distribute', $roleRoutePermissions))
                                            <a href="{{ route('course-supplies.distribute', [encrypt($batch['id']), $combo['id']]) }}"
                                                class="btn btn-sm btn-info">
                                                Distibute
                                            </a>
                                        @elseif(in_array('course-supplies.distributed-list', $roleRoutePermissions))
                                            <a href="{{ route('course-supplies.distributed-list', [encrypt($batch['id']), $combo['id']]) }}"
                                                class="btn btn-sm btn-info">
                                                Distibuted List
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="4" class="text-danger">No data found</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                {!! $paginator->links() !!}
            </div>
        @endisset
    </div>
@section('scripts')
    <script>
        $(document).ready(function() {});
    </script>
@endsection
@endsection
