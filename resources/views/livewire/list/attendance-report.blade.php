<div>
    <div id="preloader" wire:loading.class="d-flex">
        <div class="loader"></div>
    </div>

    <div id="batch-header" class="mb-2 d-flex py-2">
        <table class="table mb-0">
            <tr>
                <td>Batch Code : <b>{{ $batch['batchCode'] ?? '' }}</b></td>
                <td>Address : <b>{{ $batch['GEOLocation'] ?? '' }}</b></td>
                <td>Vendor : <b>{{ $batch['provider']['name'] ?? '' }}</b></td>
            </tr>
        </table>
    </div>

    <form wire:submit.prevent="search">
        <div class="row row-cols-4 gx-2">
            <div>
                <label for="">From Date</label>
                <input type="date" class="form-control" wire:model.defer="from_date">
            </div>
            <div>
                <label for="">To Date</label>
                <input type="date" class="form-control" wire:model.defer="to_date">
            </div>
            <div>
                <label for="">With Date</label>
                <select wire:model.defer="with_date" class="form-select" id="">
                    <option value="0">Only Summery</option>
                    <option value="1">Details with Date Column</option>
                </select>
            </div>
            {{-- <div>
                <label for="">Batch Code</label>
                <input type="text" class="form-control" placeholder="Batch Code" wire:model.defer="batch_code">
            </div> --}}
            <div>
                <label for="" style="color: transparent;">s</label> <br>
                <button class="btn btn-primary">Search</button>
                <button type="button" wire:click="export" class="btn btn-success">Download Excel</button>
            </div>
        </div>
    </form>

    <div class="">
        <div class="">
            @php
                $class_dates = $class_attendances?->pluck('class_date')?->unique();
                $total_class = $class_dates?->count();
            @endphp
            <table class="table table-bordered table-sm mt-3 bg-white">
                <thead>
                    <tr>
                        <th style="white-space: nowrap;">Sl. NO.</th>
                        <th style="white-space: nowrap;">Student Name</th>
                        <th style="white-space: nowrap;">Student Name Bangla</th>
                        @if ($with_date)
                            @foreach ($class_dates as $class_date)
                                <th style="white-space: nowrap;">{{ $class_date }}</th>
                            @endforeach
                        @endif
                        <th style="white-space: nowrap;">Total Class</th>
                        <th style="white-space: nowrap;">Total Present</th>
                        <th style="white-space: nowrap;">Attendance Rate (%)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($class_attendances->pluck('profile_id')->unique() as $profile_id)
                        @php
                            $profile = $class_attendances->where('profile_id', $profile_id)->first();
                            $total_student_present = 0;
                        @endphp
                        <tr>
                            <td style="white-space: nowrap;">{{ $loop->iteration }}</td>
                            <td style="white-space: nowrap;">{{ $profile['student_name'] }}</td>
                            <td style="white-space: nowrap;">{{ $profile['student_name_bn'] }}</td>
                            @foreach ($class_dates as $class_date)
                                @php
                                    $class = $class_attendances
                                        ->where('profile_id', $profile_id)
                                        ->where('class_date', $class_date)
                                        ->first();
                                    if ($class['is_present']) {
                                        $total_student_present++;
                                    }
                                @endphp
                                @if ($with_date)
                                    @if ($class['is_present'] == 1)
                                        <td style="white-space: nowrap;">P</td>
                                    @else
                                        <td style="white-space: nowrap; color: red;">A</td>
                                    @endif
                                @endif
                            @endforeach
                            <td style="white-space: nowrap;">
                                {{ $total_class }}
                            </td>
                            <td style="white-space: nowrap;">{{ $total_student_present }}</td>
                            <td style="white-space: nowrap;">
                                {{ round(($total_student_present * 100) / $total_class, 2) }}%
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


</div>
