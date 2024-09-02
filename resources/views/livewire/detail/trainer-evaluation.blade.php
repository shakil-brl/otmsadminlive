<div>
    <h3 class="mb-2">
        Trainer Evaluation Report
    </h3>
    @isset($total_evaluations)
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
                <h4 class="text-end text-info m-0 me-3">Total : {{ $total_count }}</h4>

                {{-- <div class="d-flex align-items-center">
                    <button class="btn btn-success d-flex" wire:click='export' type="button">
                        <span class="material-icons-outlined me-1">
                            download
                        </span>
                        Export
                    </button>
                </div> --}}
            </div>
            <div class="row row-cols-4 mt-2 row-cols-xxl-5 g-2 mb-2">

                <div>
                    <label>Select Phase</label>
                    <select wire:model='phase_id' name="" class="form-select" id="">
                        <option value="">Select Phase</option>
                        @foreach ($phases as $phase)
                            <option value="{{ $phase['id'] }}">{{ $phase['name_en'] }}</option>
                        @endforeach
                    </select>
                </div>
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
                <div>
                    <label>Sort By Obtained Mark</label>
                    <select wire:model='order_by' name="" class="form-select" id="">
                        <option value="DESC">Descending</option>
                        <option value="ASC">Ascending</option>
                    </select>
                </div>
                <div class="">
                    <label for="">{{ __('batch-list.batch_code') }}</label>
                    <input wire:model='search' type="search" name="search" value="{{ request('search') }}"
                        class="form-control" placeholder="{{ __('batch-list.search_with_batch') }}">
                </div>

                <div>
                    <div>
                        <label for=""></label>
                    </div>
                    <button type="button" wire:click='searchFilter' class="btn btn-primary">Search</button>
                </div>
            </div>

        </div>

        <table class="table table-bordered bg-white">
            <thead>
                <th>{{ __('batch-list.sl') }}</th>
                <th>Student Name</th>
                <th>{{ __('batch-list.batch_code') }}</th>
                <th>Training Info</th>
                <th>Provider</th>
                <th>Trainer</th>
                <th>Evaluated By</th>
                <th>Obtained Mark</th>
            </thead>
            <tbody>
                @foreach (collect($total_evaluations) as $evaluation)
                    @php($batch = $evaluation['training_batch'] ?? [])
                    <tr>
                        <td>
                            {{ digitLocale($from + $loop->index) }}
                        </td>
                        <td>
                            {{ $evaluation['trainee']['profile']['KnownAsBangla'] ?? '' }}
                            <div>
                                <a
                                    href="callto:{{ $evaluation['trainee']['profile']['Phone'] ?? '' }}">{{ $evaluation['trainee']['profile']['Phone'] ?? '' }}</a>
                            </div>
                        </td>
                        <td>
                            {{ $batch['batchCode'] }}
                            @isset($batch['batch_phase']['phase']['name_en'])
                                <div>
                                    ({{ $batch['batch_phase']['phase']['name_en'] ?? '' }})
                                </div>
                            @endisset

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
                                        href="callto:{{ $trainer['profile']['Phone'] ?? '' }}">{{ $trainer['profile']['Phone'] ?? '' }}</a>
                                </div>
                            @empty
                                <small class="text-danger">Not Assigned</small>
                            @endforelse
                        </td>
                        <td>
                            {{ $evaluation['evaluate_by']['KnownAsBangla'] ?? '' }}
                            <div>
                                <a
                                    href="callto:{{ $evaluation['evaluate_by']['Phone'] ?? '' }}">{{ $evaluation['evaluate_by']['Phone'] ?? '' }}</a>
                            </div>
                        </td>
                        <td>
                            {{ $evaluation['obtained_mark'] }}/{{ $evaluation['total_mark'] }}
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>

        @if ($paginator)
            {!! $paginator->links() !!}
        @endif
    @endisset
</div>
