<div>
    @isset($classes)
        <div id="preloader" wire:loading.class="d-flex">
            <div class="loader"></div>
        </div>
        <div class="mb-3">
            <select name="" wire:model='per_page'>
                @foreach (range(15, 100, 15) as $j)
                    <option>{{ $j }}</option>
                @endforeach
            </select>
            <div class="row row-cols-4 mt-2 row-cols-xxl-5 g-2 mb-2">
                <div>
                    <label for="">বিভাগ</label>
                    <select wire:model='division_code' name="" class="form-select" id="">
                        <option value="">Select</option>
                        @foreach ($divisions as $division)
                            <option value="{{ $division['Code'] }}">{{ $division['Name'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="">জেলা</label>
                    <select wire:model='district_code' name="" class="form-select" id="">
                        <option value="">Select</option>
                        @foreach ($districts as $district)
                            <option value="{{ $district['Code'] }}">{{ $district['Name'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="">উপজেলা</label>
                    <select wire:model='upazila_code' name="" class="form-select" id="">
                        <option value="">Select</option>
                        @foreach ($upazilas as $upazila)
                            <option value="{{ $upazila['Code'] }}">{{ $upazila['Name'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="">ভেন্ডরের নাম</label>
                    <select wire:model='provider_id' name="" class="form-select" id="">
                        <option value="">Select</option>
                        @foreach ($providers as $provider)
                            <option value="{{ $provider['id'] }}">{{ $provider['name'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="">প্রশিক্ষণের বিষয়</label>
                    <select wire:model='training_id' name="" class="form-select" id="">
                        <option value="">Select</option>
                        @foreach ($trainings as $training)
                            <option value="{{ $training['id'] }}">{{ $training['title']['Name'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="">
                    <label for="">From Date</label>
                    <input wire:model='from_date' type="date" class="form-control">
                </div>
                <div class="">
                    <label for="">To Date</label>
                    <input wire:model='to_date' type="date" class="form-control">
                </div>
                <div class="">
                    <label for="">Batch Code</label>
                    <input wire:model='search' type="search" name="search" value="{{ request('search') }}"
                        class="form-control" placeholder="{{ __('batch-schedule.search_here') }}">
                </div>
            </div>

        </div>
        <table class="table table-bordered bg-white">
            <thead>
                <th>{{ __('batch-schedule.sl') }}</th>
                <th>{{ __('batch-schedule.batch_code') }}</th>
                <th>{{ __('batch-schedule.start_time') }}</th>
                <th>{{ __('batch-schedule.course_name') }}</th>
                <th>{{ __('batch-schedule.location') }}</th>
                <th>{{ __('batch-schedule.development_partner') }}</th>
                <th>Trainer</th>
                <th>{{ __('batch-schedule.action') }}</th>
            </thead>
            <tbody>
                @foreach (collect($classes) as $batch)
                    <tr>
                        <td>
                            {{ digitLocale($from + $loop->index) }}
                        </td>
                        <td>
                            {{ $batch['schedule']['training_batch'] ? $batch['schedule']['training_batch']['batchCode'] : '' }}
                        </td>
                        <td>
                            {{ $batch['date'] ?? '' }}
                            <div>
                                {{ digitLocale(\Carbon\Carbon::createFromFormat('H:i:s', $batch['start_time'])->format('h:i A')) }}
                            </div>
                        </td>
                        <td>
                            {{ $batch['schedule']['training_batch'] ? $batch['schedule']['training_batch']['training']['title']['Name'] : '' }}
                        </td>
                        <td>
                            {{ $batch['schedule']['training_batch'] ? $batch['schedule']['training_batch']['GEOLocation'] : '' }}
                        </td>
                        <td>
                            <div>
                                {{ $batch['schedule']['training_batch'] ? $batch['schedule']['training_batch']['provider']['name'] : '' }}
                            </div>
                            <div>
                                Phone: {{ $batch['schedule']['training_batch']['provider']['phone'] ?? '' }}
                            </div>
                        </td>
                        <td>
                            @isset($batch['schedule']['training_batch']['provider_trainers'])
                                @foreach ($batch['schedule']['training_batch']['provider_trainers'] as $trainer)
                                    <div>
                                        {{ $trainer['profile']['KnownAs'] ?? '' }}
                                    </div>
                                    <div>
                                        Phone: {{ $trainer['profile']['Phone'] ?? '' }}
                                    </div>
                                @endforeach
                            @endisset
                        </td>
                        <td>
                            <div class="d-flex flex-wrap gap-1">
                                @if ($batch['streaming_link'])
                                    <a class="btn btn-sm btn-danger" href="{{ $batch['streaming_link'] }}" target="_blank">
                                        {{ __('batch-schedule.live_streaming') }}
                                    </a>
                                @endif
                                @if ($batch['static_link'])
                                    <a type="button" class="btn btn-sm btn-info" href="{{ $batch['static_link'] }}"
                                        target="_blank">
                                        {{ __('batch-schedule.join_class') }}
                                    </a>
                                @endif
                                @php
                                    $inspection_pm = [
                                        'batch_id' => $batch['schedule']['training_batch']['id'],
                                        'schedule_detail_id' => $batch['id'],
                                    ];
                                @endphp
                                @isset($inspection_pm)
                                    <a class="btn btn-sm btn-primary"
                                        href="{{ route('tms-inspections.create', $inspection_pm) }}" target="_blank">
                                        Inspection
                                    </a>
                                    <a class="btn btn-sm btn-danger" href="{{ route('attendance.form', $batch['id']) }}"
                                    target="_blank">Attendence
                                </a>
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
