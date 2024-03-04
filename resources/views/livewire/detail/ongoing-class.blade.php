@php
    use Carbon\Carbon;
@endphp
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
                <div>
                    <button class="btn btn-primary" wire:click='exportData'>
                        Export
                    </button>
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
        <x-on-going-class-component :classes="$classes" :from="$from" />

        {!! $paginator->links() !!}
    @endisset
</div>
