<div>
    <h3>
        @if ($batch_status == 1)
            Running Batch List
        @elseif ($batch_status == 2)
            Completed Batch List
        @else
            Batch List
        @endif
    </h3>
    <br>
    @isset($total_batches)
        <div id="preloader" wire:loading.class="d-flex">
            <div class="loader"></div>
        </div>
        <div class="mb-3">
            <div class="d-flex justify-content-between">
                <div>
                    <select name="" class="form-select" wire:model='per_page'>
                        @foreach (range(15, 100, 15) as $j)
                            <option>{{ digitLocale($j) }}</option>
                        @endforeach
                    </select>
                </div>
                <h4 class="text-end text-info">Total : {{ $total_count }}</h4>
            </div>
            <div class="row row-cols-5 mt-5">
                <div>
                    <select name="" class="form-select" wire:model='batch_status'>
                        <option value="">Batch Status</option>
                        <option value="1">Running Batch</option>
                        <option value="2">Completed Batch</option>
                    </select>
                </div>
                <div>
                    <select name="" class="form-select" wire:model='schedule_status'>
                        <option value="">Schedule Status</option>
                        <option value="1">Schedule Not Created</option>
                        <option value="2">Schedule Created</option>
                        <option value="3">Schedule Created But Class Not Started</option>
                    </select>
                </div>
                <div>
                    <select name="" class="form-select" wire:model='trainer_count'>
                        <option value="">Trainer Status</option>
                        <option value="1">No Trainer</option>
                        <option value="2">Minimum One Trainer Assigned</option>
                        <option value="3">One Trainer</option>
                        <option value="4">Multiple Trainer</option>
                    </select>
                </div>
                <div>
                    <select name="" class="form-select" wire:model='phase_status' id="phase_status">
                        <option value="">Phase Status</option>
                        <option value="1">Have Phase</option>
                        <option value="2">Doesn't Have</option>
                    </select>
                </div>
                <div>
                    @if ($phase_status != 2)
                        <select wire:model='phase_id' name="" class="form-select" id="">
                            <option value="">Select Phase</option>
                            @foreach ($phases as $phase)
                                <option value="{{ $phase['id'] }}">{{ $phase['name_en'] }}</option>
                            @endforeach
                        </select>
                    @endif
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
                    <label for="">{{ __('batch-list.batch_code') }}</label>
                    <input wire:model='search' type="search" name="search" value="{{ request('search') }}"
                        class="form-control" placeholder="{{ __('batch-list.search_with_batch') }}">
                </div>
            </div>

        </div>


        <table class="table table-bordered bg-white">
            <thead>
                <th>{{ __('batch-list.sl') }}</th>
                <th>{{ __('batch-list.batch_code') }}</th>
                <th>Phase</th>
                <th>Training Title</th>
                <th>Training Location</th>
                <th>Provider Name</th>
                <th>Provider Contact</th>
                <th>Trainer Name</th>
                <th>Trainer Contact</th>
                <th>Total Trainee</th>
                <th>Start Date</th>
                <th>Total Class Days</th>
                <th>Total Completed Class</th>
                <th>Total Running Class</th>
                <th>Total Remaining Class</th>
            </thead>
            <tbody>
                @foreach (collect($total_batches) as $batch)
                    <tr>
                        <td>
                            {{ $loop->iteration }}
                        </td>
                        <td>
                            {{ $batch['batchCode'] }}
                        </td>
                        <td>
                            {{ $batch['batch_phase']['phase']['name_en'] ?? '' }}
                        </td>
                        <td>
                            {{ $batch['get_training']['title']['Name'] ?? '' }}
                        </td>
                        <td>
                            {{ $batch['GEOLocation'] ?? '' }}
                        </td>
                        <td>
                            {{ $batch['provider']['name'] ?? '' }}
                        </td>
                        <td>
                            {{ $batch['provider']['phone'] ?? '' }}
                        </td>
                        <td>
                            @forelse ($batch['provider_trainers'] as $trainer)
                                {{ $trainer['profile']['KnownAsBangla'] ?? '' }}
                                @if (!$loop->last)
                                    ,
                                @endif
                            @empty
                            @endforelse
                        </td>

                        <td>
                            @forelse ($batch['provider_trainers'] as $trainer)
                                {{ $trainer['profile']['Phone'] ?? '' }}
                                @if (!$loop->last)
                                    ,
                                @endif
                            @empty
                            @endforelse
                        </td>

                        <td>
                            @isset($batch['trainees'])
                                @if ($batch['trainees'] == null)
                                    0
                                @else
                                    {{ count($batch['trainees']) }}
                                @endif
                            @endisset
                        </td>
                        <td>
                            @if (isset($batch['startDate']))
                                {{ \Carbon\Carbon::parse($batch['startDate'])->format('d/m/Y') }}
                            @endif
                        </td>
                        <td>
                            {{ isset($batch['duration']) ? $batch['duration'] : 0 }}
                        </td>
                        <td>
                            {{ $batch['schedule']['total_complete'] ?? '' }}
                        </td>
                        <td>
                            {{ $batch['schedule']['total_running'] ?? '' }}
                        </td>
                        <td>
                            {{ $batch['schedule']['total_pending'] ?? '' }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>


        {!! $paginator->links() !!}
    @endisset
</div>
