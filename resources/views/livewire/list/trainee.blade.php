<div>
    <h3>
        Trainee Information
    </h3>
    <br>
    @isset($total_trainee)
        <div id="preloader" wire:loading.class="d-flex">
            <div class="loader"></div>
        </div>
        <div class="mb-3">
            <div class="d-flex justify-content-between">
                <div>
                    <select name="" class="" wire:model='per_page'>
                        @foreach (range(15, 100, 15) as $j)
                            <option>{{ digitLocale($j) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="d-flex align-items-center">
                    <h4 class="text-end text-info m-0 me-3">Total : {{ $total_count }}</h4>
                    <button class="btn btn-success d-flex" wire:click='export' type="button">
                        Export
                    </button>
                </div>
            </div>
            <div class="row row-cols-5 mt-5">
                <div>
                    <label for="">Phase Status</label>
                    <select name="" class="form-select" wire:model='phase_status' id="phase_status">
                        <option value="">Phase Status</option>
                        <option value="1">Have Phase</option>
                        <option value="2">Doesn't Have</option>
                    </select>
                </div>
                @if ($phase_status != 2)
                    <div>
                        <label for="">Phase</label>
                        <select wire:model='phase_id' name="" class="form-select" id="">
                            <option value="">Select Phase</option>
                            @foreach ($phases as $phase)
                                <option value="{{ $phase['id'] }}">{{ $phase['name_en'] }}</option>
                            @endforeach
                        </select>
                    </div>
                @endif

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
                <tr>
                    <th>Sl. No.</th>
                    <th>Vendor</th>
                    <th>Division</th>
                    <th>District</th>
                    <th>Upazila</th>
                    <th>Batch Code</th>
                    <th>Training Title</th>
                    <th>Name of Trainee</th>
                    <th>Father</th>
                    <th>Mother</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $providers = collect($providers);
                @endphp
                @foreach (collect($total_trainee) as $trainee)
                    <tr>
                        <td>
                            {{ digitLocale($from + $loop->index) }}
                        </td>
                        <td>
                            {{ $providers?->where('id', $trainee['training_batch']['provider_id'])?->first()['name'] ?? null }}
                        </td>
                        @php
                            $location = explode(', ', @$trainee['training_batch']['GEOLocation']);
                        @endphp
                        <td>{{ @$location[2] }}</td>
                        <td>{{ @$location[1] }}</td>
                        <td>{{ @$location[0] }}</td>
                        <td>{{ @$trainee['training_batch']['batchCode'] }}</td>
                        <td>
                            {{-- @dd($trainee['training_batch']['training']) --}}
                            {{ @$trainee['training_batch']['training']['title']['Name'] }}
                        </td>
                        <td>{{ @$trainee['profile']['KnownAs'] }}</td>
                        <td>{{ @$trainee['profile']['FatherName'] }}</td>
                        <td>{{ @$trainee['profile']['MotherName'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        @if ($paginator)
            {!! $paginator->links() !!}
        @endif
    @endisset
</div>
