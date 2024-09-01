@extends('layouts.auth-master')
{{-- @dump($total_batches) --}}
@section('content')
    <!--begin::Content -->
    <div class="m-5">

        <x-alert />
        @isset($students)
            <div>
                @php
                    $batch = collect($students)->first()['training_batch'] ?? [];
                @endphp

                <div id="batch-header">
                    <div>
                        <div class="icon">
                            <img src="{{ asset('img') }}/new_icon/batch_head.png" alt="">
                        </div>
                    </div>
                    <div class="row row-cols-4">
                        <div class="item">
                            <div class="title">{{ $batch['batchCode'] ?? '' }}
                            </div>
                            <div class="tag">{{ __('batch-schedule.batch_code') }} #</div>
                        </div>
                        <div class="item">
                            <div class="title">
                                {{ $batch['GEOLocation'] ?? '' }}</div>
                            <div class="tag">Location #</div>
                        </div>
                        <div class="item">
                            <div class="title">
                                {{ collect($students)->filter(function ($student) {
                                        if ($student['evaluation'] == null) {
                                            return false;
                                        }
                                        return true;
                                    })->count() }}
                            </div>
                            <div class="tag">Evaluated #</div>
                        </div>
                        <div class="item">
                            <div class="title">
                                {{ collect($students)->filter(function ($student) {
                                        if ($student['evaluation'] == null) {
                                            return true;
                                        }
                                        return false;
                                    })->count() }}
                            </div>
                            <div class="tag">Evaluated Pending #</div>
                        </div>
                    </div>
                </div>
            </div>

            <h3 class="mt-5 mb-3">Trainee List</h3>

            <table class="table  table-bordered bg-white" id="dataTable">
                <thead>
                    <th>{{ __('batch-list.sl') }}</th>
                    <th>Student Name</th>
                    <th>Fathers Name</th>
                    <th>Mothers Name</th>
                    <th>Evaluation</th>
                    <th>{{ __('batch-list.action') }}</th>
                </thead>
                <tbody>
                    @foreach ($students as $student)
                        <tr>
                            <td>
                                {{ $loop->iteration }}
                            </td>
                            <td>
                                {{ $student['profile']['KnownAsBangla'] ?? '' }}
                            </td>
                            <td>
                                {{ $student['profile']['FatherNameBangla'] ?? '' }}
                            </td>
                            <td>
                                {{ $student['profile']['MotherNameBangla'] ?? '' }}
                            </td>
                            <td>
                                @if ($student['evaluation'])
                                    {{ $student['evaluation']['total_mark'] }} / {{ $student['evaluation']['obtained_mark'] }}
                                @endif
                            </td>
                            <td>
                                @if ($student['evaluation'])
                                    <span class="badge badge-success">Evaluated</span>
                                @else
                                    @if (strtolower($role) == 'trainer')
                                        @if (in_array('evaluate.trainee.form', $roleRoutePermissions))
                                            <a href="{{ route('evaluate.trainee.form', $student['id']) }}"
                                                class="btn btn-sm btn-info">
                                                Evaluate
                                            </a>
                                        @endif
                                    @endif
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endisset
    </div>
    <div>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#dataTable').DataTable({
                    "pageLength": 100,
                    "searching": true
                });
            });
        </script>
    </div>
@endsection
