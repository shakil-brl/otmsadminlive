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
            <div class="row row-cols-5">
                <div>
                    <select name="" class="form-select" wire:model='per_page'>
                        @foreach (range(15, 100, 15) as $j)
                            <option>{{ digitLocale($j) }}</option>
                        @endforeach
                    </select>
                </div>
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
                        <option value="2">Trainer Assigned</option>
                        <option value="3">One Trainer</option>
                        <option value="4">Multiple Trainer</option>
                    </select>
                </div>
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
                <th>Training Info</th>
                <th>Provider</th>
                <th>Trainer</th>
                <th>Start Date & Duration</th>
                <th>{{ __('batch-list.action') }}</th>
            </thead>
            <tbody>
                @foreach (collect($total_batches) as $batch)
                    <tr>
                        <td>
                            {{ digitLocale($from + $loop->index) }}
                        </td>
                        <td>
                            {{ $batch['batchCode'] }}
                        </td>
                        <td>
                            {{ $batch['get_training']['title']['Name'] ?? '' }}
                            <div>
                                {{ $batch['GEOLocation'] }}
                            </div>
                        </td>
                        <td>
                            {{ $batch['provider']['name'] ?? '' }}
                            <div>
                                <a
                                    href="callto:{{ $batch['provider']['phone'] ?? '' }}">{{ $batch['provider']['phone'] ?? '' }}</a>
                            </div>
                        </td>
                        <td>
                            @forelse ($batch['provider_trainers'] as $trainer)
                                {{ $trainer['profile']['KnownAsBangla'] ?? '' }}
                                <div>
                                    <a
                                        href="callto:{{ $batch['provider']['phone'] ?? '' }}">{{ $batch['provider']['phone'] ?? '' }}</a>
                                </div>
                            @empty
                                <small class="text-danger">Not Assigned</small>
                            @endforelse
                        </td>
                        <td>
                            {{ isset($batch['startDate']) ? digitLocale(\Carbon\Carbon::parse($batch['startDate'])->format('d/m/Y')) : digitLocale(null) }}
                            <div>
                                {{ isset($batch['duration']) ? digitLocale($batch['duration']) : digitLocale(0) }}
                                {{ __('batch-list.days') }}
                            </div>
                        </td>
                        <td>
                            @if ($batch['schedule'] == null)
                                @if (strtolower(Session::get('access_token')['role']) == 'provider')
                                    <a href="{{ route('batch-schedule.create', encrypt($batch['id'])) }}"
                                        class="btn btn-sm btn-primary"> {{ __('batch-list.create_schedule') }}</a>
                                @else
                                    <span
                                        class="badge text-black badge-warning">{{ __('batch-list.not_created-schedule') }}</span>
                                @endif
                            @else
                                <div class="d-flex gap-2">
                                    <a href="{{ route('batch-schedule.index', [encrypt($batch['schedule']['id']), encrypt($batch['id'])]) }}"
                                        class="btn btn-sm btn-info"> {{ __('batch-list.view_schedule') }}
                                    </a>
                                    <a href="{{ route('course-supplies.show', encrypt($batch['id'])) }}"
                                        class="btn btn-sm btn-success">
                                        Supplies
                                    </a>
                                </div>
                                <small class="fw-bold">Class Progress:</small>
                                <div class="progress m-1">
                                    <div class="progress-bar" role="progressbar"
                                        style="width: {{ $batch['schedule']['total_complete'] }}%"
                                        aria-valuenow="{{ $batch['schedule']['total_complete'] }}"
                                        aria-valuemin="{{ $batch['schedule']['total_complete'] }}"
                                        aria-valuemax="{{ $batch['duration'] }}"></div>
                                </div>

                                <small>{{ __('batch-list.complete_class') }}:
                                    {{ digitLocale($batch['schedule']['total_complete']) }}</small>/
                                <small>{{ __('batch-list.pending_class') }}:
                                    {{ digitLocale($batch['schedule']['total_pending']) }}</small>/
                                <small>{{ __('batch-list.running_class') }}:
                                    {{ digitLocale($batch['schedule']['total_running']) }}</small>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>


        {!! $paginator->links() !!}
    @endisset
</div>
