@extends('layouts.auth-master')
@section('content')
    <div class="m-5">
        <x-alert />
        @if (isset($phase) && isset($batch_phases))
            @php
                $trainingBatchesArray = [];
                $trainingBatchIdsArray = [];

                $item = $phase;
                if (isset($item['batch_phase']) && is_array($item['batch_phase'])) {
                    foreach ($item['batch_phase'] as $batch) {
                        if (isset($batch['training_batches']) && is_array($batch['training_batches'])) {
                            $trainingBatchesArray[] = $batch['training_batches'];

                            if (isset($batch['id'])) {
                                array_push($trainingBatchIdsArray, $batch['training_batches']['id']);
                            }
                        }
                    }
                }

                $storedBptIds = [];
                foreach ($batch_phases as $bp) {
                    if (isset($bp['training_batch_id'])) {
                        array_push($storedBptIds, $bp['training_batch_id']);
                    }
                }
            @endphp
            <div class="card p-5">
                <div id="">
                    <h3>Batch Group Details({{ $phase['name_en'] ?? '' }} ):</h3>
                    <div>
                        <div>Name(Bangla): {{ $phase['name_bn'] ?? '' }}</div>
                        <div>Code: {{ $phase['code'] ?? '' }}</div>
                        <div>Remark: {{ $phase['remark'] ?? '' }}</div>
                    </div>
                </div>
                <div class="mt-5">
                    <h4>Link Batches With Batch Group</h4>
                    <div class="my-3">
                        <div id="gioLocation-form">
                            <div class="d-flex justify-content-between gap-3">
                                <div class="w-25">
                                    <select class="mb-3 api-call form-select" name="per_page">
                                        <option value="50">Per Page</option>
                                        @foreach (range(25, 525, 25) as $val)
                                            <option value="{{ $val }}">{{ $val }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="w-75">
                                    <div class="input-group">
                                        <input type="text" class="form-control api-call" name="search"
                                            placeholder="Search here (Batch Code)">
                                        <span class="input-group-text">
                                            <i class="fas fa-search"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
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
                        <form action="" id="add-batch-form">
                            <div class="d-none mb-3 border border-primary rounded p-3 d-flex justify-content-between"
                                id="select-all">
                                <div class="form-check d-flex align-items-center gap-2">
                                    <input class="form-check-input" type="checkbox" id="selectAllCheckbox" name=""
                                        value="">
                                    <label class="form-check-label text-dark fw-bold" for="selectAllCheckbox">
                                        Check All
                                    </label>
                                </div>
                                <div class="d-flex align-items-center gap-2">
                                    {{-- <label class="form-label" for="">Search:</label>
                                    <input class="form-control" type="search" name="search" id="batchSearch"> --}}
                                </div>
                            </div>
                            <input type="hidden" name="GEOCode">
                            <div class="row row-cols-3 g-3" id="batch-checkbox">

                            </div>
                        </form>
                    </div>
                    <div class="my-5" id="link-batch-section">
                        <div class="fw-bold fs-5">Selected Batch:</div>
                        <div class="d-flex flex-wrap gap-1 border rounded p-3" id="link-batch-show"
                            style="background-color: #faf5ff;">

                        </div>
                        <button class="btn btn-danger mt-3 d-none" id="clear-selected">Clear</button>
                    </div>
                    <form action="" id="link-batch-form" class="">
                        <input type="hidden" type="text" name="link-batches" value="">
                        <div class="text-center mt-3">
                            <button class="btn btn-success" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        @endif
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            // Initialize an empty object for selectedBatches
            var selectedBatches = {};

            let phaseId = @json($phase['id']);
            let storedDBBatches = @json($trainingBatchesArray);
            let storedBatchIdsArray = @json($trainingBatchIdsArray);
            let storedBptIds = @json($storedBptIds);

            // Loop through storedBatches and create the selectedBatches object
            storedDBBatches.forEach(function(batch) {
                let batchId = batch.id ?? "";
                let batchCode = batch.batchCode ?? "";
                let batchTitle = '';
                if (batch.training) {
                    batchTitle = batch.training.title.Name ?? "";
                }
                let GEOLocation = batch.GEOLocation ?? "";

                // Add the batch to selectedBatches
                selectedBatches[batchId] = {
                    batchCode: batchCode,
                    title: batchTitle,
                    GEOLocation: GEOLocation
                };
            });

            // link-batch-form input value set adn view
            generateSelectedList(selectedBatches);

            // remove item form view
            $("#link-batch-show").on('click', '.remove-batch-buton', function() {
                let removeBatchId = $(this).find('#batchCodeHidden').val();
                if (selectedBatches && selectedBatches.hasOwnProperty(removeBatchId)) {
                    let checkboxId = `#${removeBatchId}`;
                    $(checkboxId).prop('checked', false);
                    delete selectedBatches[removeBatchId];
                }
                generateSelectedList(selectedBatches);
            });

            // Clear selected batches
            $("#clear-selected").on('click', function(event) {
                event.preventDefault();
                selectedBatches = {};
                generateSelectedList(selectedBatches);
                batchLinkCheck.html("");
                selectAllBox.addClass("d-none");
                districtSelectElement.html("");
                upazilaSelectElement.html("");

                // populate division options
                let optionFor = "Division";
                let division_api_link = api_baseurl + "divisions";
                populateLocationOption(
                    optionFor,
                    division_api_link,
                    authToken,
                    divisionSelectElement
                );
            });

            let divisionSelectElement = $("#gioLocation-form #division_id");
            let districtSelectElement = $("#gioLocation-form #district_id");
            let upazilaSelectElement = $("#gioLocation-form #upazila_id");
            let batchLinkForm = $("#add-batch-form");
            let batchLinkCheck = $("#add-batch-form #batch-checkbox");
            let selectAllBox = $("#add-batch-form #select-all");

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
                batchLinkCheck.html("");
                selectAllBox.addClass("d-none");
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
                    batchLinkCheck.html("");
                    selectAllBox.addClass("d-none");
                    upazila_api_link = api_baseurl + "upazilas/" + district_id;
                    populateLocationOption(
                        optionFor,
                        upazila_api_link,
                        authToken,
                        upazilaSelectElement
                    );
                } else {
                    upazilaSelectElement.html("");
                    batchLinkCheck.html("");
                    selectAllBox.addClass("d-none");
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

            // get the checkbox value
            $('.api-call').change(function() {
                let val =
                    selectAllBox.addClass("d-none");
                $("#checkAll").prop('checked', '');
                batchLinkCheck.html("");
                if (1) {
                    const link = api_baseurl + "batch/batch-link/get-batches";
                    $.ajax({
                        type: "GET",
                        url: link,
                        data: {
                            division_id: $('select[name=division_id]').val(),
                            district_id: $('select[name=district_id]').val(),
                            upazila_id: $('select[name=upazila_id]').val(),
                            search: $('input[name=search]').val(),
                            per_page: $('select[name=per_page]').val(),
                            training_title_id: $('select[name=training_title_id]').val(),
                        },
                        headers: {
                            Authorization: authToken,
                        },
                        success: function(results) {
                            // Handle the successful response here
                            // console.log(results.data);
                            let allData = results.data;
                            let GEOCode = results.GEOCode;
                            // console.log(results);
                            batchLinkCheck.html("");

                            if (allData.length > 0) {
                                selectAllBox.removeClass("d-none");
                                $("#selectAllCheckbox").prop('checked', '');
                                $.each(allData, function(index, data) {
                                    // console.log(data);
                                    let isChecked = selectedBatches[data.id];
                                    let batchTitle = '';
                                    if (data.training) {
                                        batchTitle = data.training.title.Name ?? "";
                                    }
                                    let checkbox = `
                                        <div class="col mt-5">
                                            <div class="form-check">
                                                <input class="form-check-input batch-checkbox" type="checkbox" id="${data.id}" name="batches[]"
                                                    value="${data.id}" batchCode="${data.batchCode ?? ''}" batchTitle="${batchTitle ?? ''}"
                                                    GEOLocation="${data.GEOLocation}" ${isChecked ? 'checked' : ''} ${(storedBptIds.includes(data.id) && !storedBatchIdsArray.includes(data.id))  ? 'disabled' : ''} >
                                                <label class="form-check-label text-dark" for="${data.id}">
                                                    ${data.batchCode} (${batchTitle ?? ""})
                                                </label>
                                            </div>
                                        </div>
                                    `;

                                    batchLinkCheck.append(checkbox);
                                });

                                // Event listener for checkbox changes
                                batchLinkCheck.on('change', 'input[name="batches[]"]',
                                    function() {
                                        let batchId = this.value;
                                        let batchCode = this.getAttribute('batchCode') ||
                                            '';
                                        let batchTitle = this.getAttribute('batchTitle') ||
                                            '';
                                        let GEOLocation = this.getAttribute(
                                                'GEOLocation') ||
                                            '';

                                        // Update the selectedBatches object
                                        if (this.checked) {
                                            selectedBatches[batchId] = {
                                                batchCode: batchCode,
                                                title: batchTitle,
                                                GEOLocation: GEOLocation
                                            };
                                            // console.log(selectedBatches);
                                        } else {
                                            delete selectedBatches[batchId];
                                        }

                                        generateSelectedList(selectedBatches)
                                    });

                                // all select
                                $("#selectAllCheckbox").on('change', function() {
                                    let isChecked = this.checked;

                                    // Update all individual checkboxes
                                    $(('.batch-checkbox:not(:disabled)')).each(
                                        function() {
                                            this.checked = isChecked;

                                            // Trigger the change event for each individual checkbox
                                            $(this).change();
                                        });
                                });
                            } else {
                                selectAllBox.addClass("d-none");
                                batchLinkCheck.append(`
                                    <div class="text-danger">No Batch Found</div>
                                `);
                            }
                        },
                        error: function(xhr, status, error) {
                            // Handle errors here
                            console.error(xhr, status, error);
                        },
                    });


                } else {
                    batchLinkCheck.html("");
                    selectAllBox.addClass("d-none");
                    addBtn.addClass("d-none");
                }
            });

            // lot link batches form submit
            $("#link-batch-form").submit(function(e) {
                e.preventDefault();
                Swal.fire({
                    title: "Are you sure",
                    text: "You want to submit the form?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, Submitted",
                }).then((result) => {
                    if (result.isConfirmed) {
                        let fd = new FormData();
                        let CSRF_TOKEN = $('meta[name="csrf-token"]').attr("content");
                        let link = api_baseurl + "tms-phases/link-batch";
                        let batchIds = Object.keys(selectedBatches) ?? '';
                        // console.log(batchIds);
                        $.ajax({
                            type: "POST",
                            url: link,
                            data: {
                                batch_ids: batchIds,
                                phase_id: phaseId,
                                _token: CSRF_TOKEN
                            },
                            dataType: "json",
                            headers: {
                                Authorization: authToken,
                                "X-localization": language,
                            },
                            success: function(results) {
                                // console.log(results);
                                if (results.success === true) {
                                    swal.fire(yes, results.message);

                                    sessionStorage.setItem("message", results.message);
                                    sessionStorage.setItem("alert-type", "info");

                                    // refresh page after 2 seconds
                                    setTimeout(function() {
                                        // location.reload();
                                        history.back();
                                    }, 2000);
                                } else {
                                    if (results.error === true) {
                                        var errors = results.message;
                                        console.log(errors);
                                        let errMsg = '';
                                        for (let key in errors) {
                                            errors[key].map((e) => {
                                                errMsg += (e + "<br>");
                                            })
                                        }

                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Validation Error',
                                            html: '<span style="color: red;">' +
                                                errMsg + '</span>'
                                        });
                                        // swal.fire(ValidationError, errMsg);
                                    }
                                }
                            },
                        });
                    }
                });
            });

            // Function to generate selected list
            function generateSelectedList(selectedBatches) {
                let linkBatchShowDiv = $("#link-batch-show");
                linkBatchShowDiv.empty(); // Clear previous content
                if (Object.keys(selectedBatches).length > 0) {
                    let batchKeysArray = Object.keys(selectedBatches);
                    batchKeysArray.forEach(batchId => {
                        let batchInfo = selectedBatches[batchId];
                        let pillElement =
                            `<div class="mb-1 me-1 d-inline-flex bg-white rounded overflow-hidden border border-secondary view-item">
                            <div class="px-4 py-1">
                                <div>${batchInfo.batchCode} - ${batchInfo.title}</div>
                                <div>(${batchInfo.GEOLocation})</div>                                    
                            </div>
                            <div type="button" class="bg-danger lead text-light d-flex align-items-center justify-content-center px-2 remove-batch-buton">
                                &times;
                                <input type="hidden" id="batchCodeHidden" value="${batchId}">
                            </div>
                        </div>`;
                        linkBatchShowDiv.append(pillElement);
                    });
                    $("#clear-selected").removeClass("d-none");
                } else {
                    $("#clear-selected").addClass("d-none");
                }
            }
        });
    </script>
@endsection
