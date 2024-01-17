<div>
    <div class="mb-3">
        <div class="card p-3">
            <form action="">
                <div id="search-form">
                    <div class="row row-cols-3 g-3 mb-2">
                        <div class="col">
                            <div class="input-group">
                                <input type="text" class="form-control api-call" wire:model="search"
                                    placeholder="Search here">
                                <span class="input-group-text">
                                    <i class="fas fa-search"></i>
                                </span>
                            </div>
                        </div>
                        <div class="col">
                            <select class="form-select api-call" name="provider_id" id="provider_id"
                                wire:model="provider_id">

                            </select>
                        </div>
                        <div class="col">
                            <select class="form-select api-call" name="training_title_id" id="training_title_id"
                                wire:model="training_title_id">

                            </select>
                        </div>
                    </div>
                    <div class="row row-cols-3 g-3">
                        <div class="col">
                            <select class="form-select api-call" name="division_id" id="division_id">

                            </select>
                        </div>
                        <div class="col">
                            <select class="form-select api-call" name="district_id" id="district_id">

                            </select>
                        </div>
                        <div class="col">
                            <select class="form-select api-call" name="upazila_id" id="upazila_id">

                            </select>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div wire:loading>
            Processing ...
        </div>
    </div>
    @isset($ongoing_classes)
        <div>
            <table class="table table-bordered bg-white" id="dataTable">
                <thead>
                    <th>{{ __('batch-schedule.sl') }}</th>
                    <th>{{ __('batch-schedule.batch_code') }}</th>
                    <th>Date</th>
                    <th>{{ __('batch-schedule.start_time') }}</th>
                    <th>{{ __('batch-schedule.course_name') }}</th>
                    <th>{{ __('batch-schedule.location') }}</th>
                    <th>{{ __('batch-schedule.development_partner') }}</th>
                    <th>Trainer</th>
                    <th>{{ __('batch-schedule.action') }}</th>
                </thead>

                <tbody>
                    @if (count($ongoing_classes) > 0)
                        @foreach (collect($ongoing_classes) as $batch)
                            {{-- @dump($batch) --}}
                            <tr>
                                <td>
                                    {{ digitLocale($loop->index + 1) }}
                                </td>
                                <td>
                                    {{ $batch['schedule']['training_batch']['batchCode'] ?? '' }}
                                </td>
                                <td>
                                    {{ isset($batch['date']) ? \Carbon\Carbon::parse($batch['date'])->format('d-m-Y') : '' }}
                                </td>
                                <td>
                                    {{ isset($batch['start_time']) ? digitLocale(\Carbon\Carbon::createFromFormat('H:i:s', $batch['start_time'])->format('h:i A')) : '' }}
                                </td>
                                <td>
                                    {{ $batch['schedule']['training_batch']['training']['title']['Name'] ?? '' }}
                                </td>
                                <td>
                                    {{ $batch['schedule']['training_batch']['GEOLocation'] ?? '' }}
                                </td>
                                <td>
                                    <div>
                                        {{ $batch['schedule']['training_batch']['provider']['name'] ?? '' }}
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
                                            <a class="btn btn-sm btn-danger" href="{{ $batch['streaming_link'] }}"
                                                target="_blank">
                                                {{ __('batch-schedule.live_streaming') }}
                                            </a>
                                        @endif
                                        @if ($batch['static_link'])
                                            <a type="button" class="btn btn-sm btn-info"
                                                href="{{ $batch['static_link'] }}" target="_blank">
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
                                        @endisset
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="4" class="text-danger">
                                No data found
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>

            {!! $paginator->links() !!}
        </div>
    @endisset
</div>

@push('js')
    <script>
        document.addEventListener('livewire:load', function() {
            // Livewire.on('refreshDataTable', function() {
            //     $('#dataTable').DataTable().destroy(); // Destroy existing DataTable instance
            //     $('#dataTable').DataTable(); // Reinitialize DataTable
            // });

            // $('#dataTable').DataTable();

            let divisionSelectElement = $("#division_id");
            let districtSelectElement = $("#district_id");
            let upazilaSelectElement = $("#upazila_id");
            let optionFor = "Division";
            let division_api_link = api_baseurl + "divisions";

            populateLocationOption(
                optionFor,
                division_api_link,
                authToken,
                divisionSelectElement
            );

            // load district on district change
            divisionSelectElement.change(function() {
                optionFor = "District";
                let division_id = divisionSelectElement.val();
                districtSelectElement.html("");
                upazilaSelectElement.html("");

                if (division_id) {
                    district_api_link = api_baseurl + "districts/" + division_id;
                    populateLocationOption(
                        optionFor,
                        district_api_link,
                        authToken,
                        districtSelectElement
                    );
                }
            });

            // load upazila on district change            
            districtSelectElement.change(function() {
                optionFor = "Upazila";
                let district_id = districtSelectElement.val();
                upazilaSelectElement.html("");

                if (district_id) {
                    upazila_api_link = api_baseurl + "upazilas/" + district_id;
                    populateLocationOption(
                        optionFor,
                        upazila_api_link,
                        authToken,
                        upazilaSelectElement
                    );
                }
            });

            // provider option load
            let providerSelector = $("#provider_id");
            const provider_api_link = api_baseurl + "providers";
            populateProviderOption(
                authToken,
                provider_api_link,
                providerSelector,
            )

            // training title generate
            let trainingTitleSelector = $("#training_title_id");
            let trainingUrl = api_baseurl + "training_title";
            let htmlOption = "<option value=''>Select Training Title</option>";
            $.ajax({
                type: "get",
                url: trainingUrl,
                headers: {
                    Authorization: authToken,
                },
                data: {},
                dataType: "JSON",
                success: function(results) {
                    let allData = results.data;
                    // console.log(allData);

                    if (allData) {
                        $.each(allData, function(index, data) {
                            if (data.trainingProviderOrgId == 13) {
                                htmlOption +=
                                    '<option value="' +
                                    data.id +
                                    '">' +
                                    data.title.Name +
                                    "</option>";
                            }
                        });
                    }

                    trainingTitleSelector.html(htmlOption);
                },
                error: function(response) {
                    console.log(response);
                },
            });

        });

        $(document).ready(function() {

        });
    </script>
@endpush
