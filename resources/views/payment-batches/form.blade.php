<div class="border border-secondary p-3 rounded">
    <p class="fw-bold">Filter Batch:</p>
    <div id="gioLocation-form">
        <div class="row row-cols-4 g-3">
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
            <div class="col">
                <select class="form-select api-call" name="training_title_id" id="training_title_id">
                </select>
            </div>
        </div>
    </div>
</div>

<div class="my-5">
    <h6>Payment Form:</h6>
    <div class="form-check form-switch my-3">
        <input class="form-check-input" type="checkbox" id="status" name="status"
            {{ (isset($payment_batch['status']) && $payment_batch['status'] != 1) || old('status') == 'off' ? '' : 'checked' }}>
        <label class="form-check-label" for="status">Status(Inactive/Active)</label>
    </div>

    <div class="row row-cols-2 g-4">
        @isset($payment_batch)
            @php
                $paymentStartDate = \Carbon\Carbon::createFromFormat('Y-m-d', $payment_batch['start_date'])->format('d/m/Y');
                $paymentEndDate = \Carbon\Carbon::createFromFormat('Y-m-d', $payment_batch['end_date'])->format('d/m/Y');
            @endphp
        @endisset

        <div class="">
            <label for="batch_id" class="form-label">Batches: <span class="text-danger">*</span></label>
            <select name="batch_id" id="batch_id" class="form-select">

            </select>
            @error('batch_id')
                <small class="text-danger d-block">{{ $message }}</small>
            @enderror
        </div>
        <div class="">
            <label for="daily_allowance" class="form-label">Daily Allowance: <span class="text-danger">*</span></label>
            <input type="number" step="0.50" class="form-control" name="daily_allowance" id="daily_allowance"
                value="{{ $payment_batch['daily_allowance'] ?? old('daily_allowance') }}" placeholder="Daily allowance">
            @error('daily_allowance')
                <small class="text-danger d-block">{{ $message }}</small>
            @enderror
        </div>
        <div class="">
            <label for="start_date" class="form-label">Start Date: <span class="text-danger">*</span></label>
            <div class="input-group">
                <span class="input-group-text">
                    <span class="material-icons-outlined">
                        calendar_month
                    </span>
                </span>
                <input type="text" class="form-control" id="start_date" name="start_date"
                    placeholder="Select start date">
            </div>
            @error('start_date')
                <small class="text-danger d-block">{{ $message }}</small>
            @enderror
        </div>
        <div class="">
            <label for="end_date" class="form-label">End Date: <span class="text-danger">*</span></label>
            <div class="input-group">
                <span class="input-group-text">
                    <span class="material-icons-outlined">
                        calendar_month
                    </span>
                </span>
                <input type="text" class="form-control" id="end_date" name="end_date" placeholder="Select end date">
            </div>
            @error('end_date')
                <small class="text-danger d-block">{{ $message }}</small>
            @enderror
        </div>

        <div class="">
            <label for="total_payment_amount" class="form-label">Payment Amount: <span
                    class="text-danger">*</span></label>
            <input type="number" step="0.50" class="form-control" name="total_payment_amount"
                id="total_payment_amount"
                value="{{ $payment_batch['total_payment_amount'] ?? old('total_payment_amount') }}"
                placeholder="Total payment amount">
            @error('total_payment_amount')
                <small class="text-danger d-block">{{ $message }}</small>
            @enderror
        </div>
    </div>
    <div class="mt-4">
        <label for="remark" class="form-label">Remark:</label>
        <textarea class="form-control" name="remark" id="remark" rows="3">
            {{ $payment_batch['remark'] ?? old('remark') }}
        </textarea>
        @error('remark')
            <small class="text-danger d-block">{{ $message }}</small>
        @enderror
    </div>
    <div class="mt-5 text-center">
        <button type="submit" class="btn btn-md btn-success">{{ __('config.submit') }}</button>
    </div>
</div>

@push('js')
    <script>
        $(document).ready(function() {
            const getBatchLink = api_baseurl + "batch/vendor/get-batches";
            let divisionSelectElement = $("#gioLocation-form #division_id");
            let districtSelectElement = $("#gioLocation-form #district_id");
            let upazilaSelectElement = $("#gioLocation-form #upazila_id");
            let batchLinkForm = $("#add-batch-form");
            let batchSelector = $("#batch_id");
            batchSelector.select2({
                placeholder: 'Select Batch',
            });
            let selectedId = @json($payment_batch['batch_id'] ?? old('batch_id'));
            loadBatch(selectedId);

            // populate division options
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
                let districtSelectElement = $("#gioLocation-form #district_id");
                districtSelectElement.html("");
                upazilaSelectElement.html("");
                batchSelector.html("");

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
                if (district_id) {
                    batchSelector.html("");

                    upazila_api_link = api_baseurl + "upazilas/" + district_id;
                    populateLocationOption(
                        optionFor,
                        upazila_api_link,
                        authToken,
                        upazilaSelectElement
                    );
                } else {
                    upazilaSelectElement.html("");
                    batchSelector.html("");
                }
            });

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

            // get the batches on filter

            $('.api-call').change(function() {
                batchSelector.html("");
                if (1) {
                    let filterBy = {
                        division_id: $('select[name=division_id]').val(),
                        district_id: $('select[name=district_id]').val(),
                        upazila_id: $('select[name=upazila_id]').val(),
                        search: $('input[name=search]').val(),
                        per_page: $('select[name=per_page]').val(),
                        training_title_id: $('select[name=training_title_id]').val(),
                    }
                    loadBatch(null, filterBy);
                } else {
                    batchSelector.html("");
                }
            });

            function loadBatch(selectedId = null, filterBy = null) {
                $.ajax({
                    type: "GET",
                    url: getBatchLink,
                    data: filterBy,
                    headers: {
                        Authorization: authToken,
                    },
                    success: function(results) {
                        // console.log(results);
                        batchSelector.html("");

                        if (results) {
                            // console.log(results.data);
                            let batches = results.data;
                            let htmlSelect;
                            // console.log(batches);
                            if (selectedId !== null) {
                                $.each(batches, function(index, result) {
                                    if (result.id == selectedId) {
                                        htmlSelect +=
                                            '<option value="' +
                                            result.id +
                                            '" selected>' +
                                            result.batchCode +
                                            "</option>";
                                    } else {
                                        htmlSelect +=
                                            '<option value="' +
                                            result.id +
                                            '">' +
                                            result.batchCode +
                                            "</option>";
                                    }
                                });
                            } else {
                                $.each(batches, function(index, result) {
                                    htmlSelect +=
                                        '<option value="' +
                                        result.id +
                                        '">' +
                                        result.batchCode +
                                        "</option>";
                                });
                            }
                            batchSelector.html(htmlSelect);
                        }

                    },
                    error: function(xhr, status, error) {
                        // Handle errors here
                        console.error(xhr, status, error);
                    },
                });
            }

            // date
            let oldpaymentStartDate = @json($paymentStartDate ?? old('start_date'));
            $("#start_date").flatpickr({
                dateFormat: "d/m/Y",
                defaultDate: [oldpaymentStartDate]
            });

            let oldpaymentEndDate = @json($paymentEndDate ?? old('end_date'));
            $("#end_date").flatpickr({
                dateFormat: "d/m/Y",
                defaultDate: [oldpaymentEndDate]
            });

        })
    </script>
@endpush
