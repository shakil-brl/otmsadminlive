<div>
    <h3>
        @if ($status == 1)
            Pending Class
        @elseif ($status == 2)
            Ongoing Class
        @elseif ($status == 3)
            Complete Class
        @else
            All Class
        @endif
    </h3>
    <br>
    @isset($classes)
        <div id="preloader" wire:loading.class="d-flex">
            <div class="loader"></div>
        </div>
        <div class="mb-3">
            <div class="row row-cols-5">
                <div>
                    <select name="" class="form-select" wire:model='per_page'>
                        @foreach (range(15, 100, 15) as $j)
                            <option>{{ digitLocale($j) }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <select name="" class="form-select" wire:model='status'>
                        <option value="">Show All</option>
                        <option value="1">Class Not Started</option>
                        <option value="2">Class Running</option>
                        <option value="3">Class Completed</option>
                    </select>
                </div>
                <div>
                    <select name="" class="form-select" wire:model='current_schedule'>
                        <option value="">Select Status</option>
                        <option value="">All Schedule</option>
                        <option value="1">Current Schedule</option>
                    </select>
                </div>
                <div></div>
                <div>
                    <h4 class="text-end text-info">Total : {{ $total_count }}</h4>
                </div>
            </div>
            <div class="row row-cols-4 mt-2 row-cols-xxl-5 g-2 mb-2">
                <div>
                    <label for="">{{ __('batch-list.division') }}</label>
                    <select wire:model='division_code' name="" class="form-select" id="">
                        <option value="">{{ __('batch-list.select_division') }}</option>
                        @foreach ($divisions as $division)
                            <option value="{{ $division['Code'] }}">{{ $division['Name'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="">{{ __('batch-list.district') }}</label>
                    <select wire:model='district_code' name="" class="form-select" id="">
                        <option value="">{{ __('batch-list.select_district') }}</option>
                        @foreach ($districts as $district)
                            <option value="{{ $district['Code'] }}">{{ $district['Name'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="">{{ __('batch-list.upazila') }}</label>
                    <select wire:model='upazila_code' name="" class="form-select" id="">
                        <option value="">{{ __('batch-list.select_upazila') }}</option>
                        @foreach ($upazilas as $upazila)
                            <option value="{{ $upazila['Code'] }}">{{ $upazila['Name'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="">{{ __('batch-list.vendor_name') }}</label>
                    <select wire:model='provider_id' name="" class="form-select" id="">
                        <option value="">{{ __('batch-list.select_vendor') }}</option>
                        @foreach ($providers as $provider)
                            <option value="{{ $provider['id'] }}">{{ $provider['name'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="">{{ __('batch-schedule.course_name') }}</label>
                    <select wire:model='training_id' name="" class="form-select" id="">
                        <option value="">{{ __('batch-list.select_course') }}</option>
                        @foreach ($trainings as $training)
                            <option value="{{ $training['id'] }}">{{ $training['title']['Name'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="">
                    <label for="">{{ __('batch-list.from_date') }}</label>
                    <input wire:model='from_date' type="date" class="form-control">
                </div>
                <div class="">
                    <label for="">{{ __('batch-list.to_date') }}</label>
                    <input wire:model='to_date' type="date" class="form-control">
                </div>
                <div class="">
                    <label for="">{{ __('batch-list.batch_code') }}</label>
                    <input wire:model='search' type="search" name="search" value="{{ request('search') }}"
                        class="form-control" placeholder="{{ __('batch-list.search_with_batch') }}">
                </div>
            </div>

        </div>
        <table class="table table-bordered bg-white">
            <thead>
                <th>{{ __('batch-schedule.sl') }}</th>
                <th>{{ __('batch-schedule.batch_code') }}</th>
                <th>{{ __('batch-list.class_detail') }}</th>
                <th>{{ __('batch-list.course_location') }}</th>
                <th>{{ __('batch-list.vendor_info') }}</th>
                <th>{{ __('batch-list.trainer') }}</th>
                <th>Status</th>
                <th class="text-end" style="max-width: 280px;">{{ __('batch-schedule.action') }}</th>
            </thead>
            <tbody>
                @foreach (collect($classes) as $batch)
                    <tr>
                        <td>
                            {{ digitLocale($from + $loop->index) }}
                        </td>
                        <td>
                            {{ $batch['schedule']['training_batch'] ? $batch['schedule']['training_batch']['batchCode'] : '' }}<br>
                            {{-- <small class="text-danger">Total Trainees: {{$batch['schedule']['training_batch']['totalTrainees']}}</small>  --}}
                        </td>
                        <td>
                            {{ isset($batch['date']) ? digitLocale(\Carbon\Carbon::parse($batch['date'])->format('d-m-Y')) : digitLocale(null) }}
                            <div>
                                <small>
                                    {{ digitLocale(\Carbon\Carbon::createFromFormat('H:i:s', $batch['start_time'])->format('h:i A')) }}
                                    -
                                    {{ digitLocale(\Carbon\Carbon::createFromFormat('H:i:s', $batch['end_time'])->format('h:i A')) }}
                                </small>
                            </div>
                        </td>
                        <td>
                            {{ $batch['schedule']['training_batch'] ? $batch['schedule']['training_batch']['training']['title']['Name'] : '' }}<br />
                            <small>{{ $batch['schedule']['training_batch'] ? $batch['schedule']['training_batch']['GEOLocation'] : '' }}</small>
                        </td>
                        <td>
                            {{ $batch['schedule']['training_batch'] ? $batch['schedule']['training_batch']['provider']['name'] : '' }}
                            <br />
                            <a
                                href="tel:+{{ $trainer['profile']['Phone'] ?? '' }}">{{ $batch['schedule']['training_batch']['provider']['phone'] ?? '' }}</a>

                        </td>
                        <td>
                            @isset($batch['schedule']['training_batch']['provider_trainers'])
                                @foreach ($batch['schedule']['training_batch']['provider_trainers'] as $trainer)
                                    {{ $trainer['profile']['KnownAs'] ?? '' }}
                                    <br />

                                    <a href="tel:+{{ $trainer['profile']['Phone'] ?? '' }}">{{ $trainer['profile']['Phone'] ?? '' }}
                                    </a>
                                @endforeach
                            @endisset
                        </td>
                        <td>
                            @if ($batch['status'] == 1)
                                <span class="badge badge-secondary">Class Not Started</span>
                            @elseif ($batch['status'] == 2)
                                <div>
                                    <span class="badge badge-info">Class Running</span>
                                </div>
                                @php
                                    $class_end_time = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $batch['date'] . ' ' . $batch['end_time']);
                                    $now = \Carbon\Carbon::now();
                                @endphp

                                @if ($now > $class_end_time)
                                    <span class="badge badge-danger mt-1">Time Expired</span>
                                @endif
                            @elseif ($batch['status'] == 3)
                                <span class="badge badge-success">Class Completed</span>
                            @endif

                        </td>
                        <td>
                            <div class="d-flex flex-wrap gap-1 text-end">
                                @if ($batch['status'] == 2)
                                    @if ($batch['streaming_link'])
                                        <a class="btn btn-sm btn-danger" href="{{ $batch['streaming_link'] }}"
                                            target="_blank">
                                            {{ __('batch-schedule.live_streaming') }}
                                        </a>
                                    @endif
                                    @if ($batch['static_link'])
                                        <a type="button" class="btn btn-sm btn-info" href="{{ $batch['static_link'] }}"
                                            target="_blank">
                                            {{ __('batch-schedule.join_class') }}
                                        </a>
                                    @endif
                                @endif
                                @php
                                    $inspection_pm = [
                                        'batch_id' => $batch['schedule']['training_batch']['id'],
                                        'schedule_detail_id' => $batch['id'],
                                    ];
                                @endphp
                                @isset($inspection_pm)
                                    @if ($batch['status'] == 2)
                                        @if (in_array('tms-inspections.create', Session::get('access_token.rolePermission')))
                                            <a class="btn btn-sm btn-primary"
                                                href="{{ route('tms-inspections.create', $inspection_pm) }}" target="_blank">
                                                {{ __('batch-list.inspection') }}
                                            </a>
                                        @endif
                                    @endif
                                    @if ($batch['status'] >= 2)
                                        <a class="btn btn-sm btn-info"
                                            href="{{ route('attendance.form', encrypt($batch['id'])) }}"
                                            target="_blank">{{ __('batch-list.view_attendance') }}
                                        </a>
                                    @endif
                                @endisset
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {!! $paginator->links() !!}
    @endisset
</div>
