@extends('layouts.auth-master')
{{-- @dump($total_batches) --}}
@section('content')
    <!--begin::Content -->
    <div class="m-5">
        <x-alert />
        {{-- @dump($from_edit) --}}
        @isset($provider)
            {{-- @dd($provider) --}}
            <div class="card p-5">
                <div id="">
                    <h3>{{ $provider['name'] ?? '' }} Details:</h3>
                    <div>
                        <div>Phone: {{ $provider['phone'] ?? '' }}</div>
                        <div>Email: {{ $provider['email'] ?? '' }}</div>
                        <div>Address: {{ $provider['address'] ?? '' }}</div>
                    </div>
                </div>
                <div class="mt-5">
                    <h4>Link Batches With Provider</h4>
                    <div class="my-3">
                        <form action="" id="gioLocation-form">
                            <div class="row row-cols-3 g-3">
                                <div class="col">
                                    <select class="form-select" name="division_id" id="division_id">
                                    </select>
                                </div>
                                <div class="col">
                                    <select class="col form-select" name="district_id" id="district_id">
                                    </select>
                                </div>
                                <div class="col">
                                    <select class="col form-select" name="upazila_id" id="upazila_id">
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="my-5">
                        <form action="" id="add-batch-form">
                            <div class="d-none mb-3 border border-primary rounded p-3" id="select-all">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="selectAllCheckbox" name=""
                                        value="">
                                    <label class="form-check-label text-dark fw-bold" for="selectAllCheckbox">
                                        Check All
                                    </label>
                                </div>
                            </div>
                            <input type="hidden" name="GEOCode">
                            <div class="row row-cols-3 g-3" id="batch-checkbox">

                            </div>
                        </form>
                    </div>
                    <div class="my-5" id="link-batch-section">
                        <div class="fw-bold fs-5">Selected Batch:</div>
                        <div class="d-flex flex-wrap gap-2 border rounded p-3" id="link-batch-show">

                        </div>
                        <button class="btn btn-danger mt-3" id="clear-selected">Clear</button>
                    </div>
                    <form action="" id="link-batch-form" class="">
                        <input type="hidden" type="text" name="link-batches" value="">
                        <div class="text-center mt-3">
                            <button class="btn btn-success" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        @endisset
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            localStorage.removeItem('selectedBatches');
            let providerId = @json($provider['id']);
            let fromEdit = @json($from_edit);
            // alert(fromEdit);
            let storedDBBatches = @json($provider['training_batches']);
            console.log(storedDBBatches);
            // Initialize an empty object for selectedBatches
            var selectedBatches = {};

            // Loop through storedBatches and create the selectedBatches object
            storedDBBatches.forEach(function(batch) {
                let batchId = batch.id ?? "";
                let batchCode = batch.batchCode ?? "";
                let batchTitle = batch.training.title.Name ?? "";
                let GEOLocation = batch.GEOLocation ?? "";

                // Add the batch to selectedBatches
                selectedBatches[batchId] = {
                    batchCode: batchCode,
                    title: batchTitle,
                    GEOLocation: GEOLocation
                };
            });

            // Convert selectedBatches to JSON
            var selectedBatchesJSON = JSON.stringify(selectedBatches);

            localStorage.setItem('selectedBatches', selectedBatchesJSON);

            // link-batch-form input value set adn view
            generateSelectedList();

            let divisionSelectElement = $("#gioLocation-form #division_id");
            let districtSelectElement = $("#gioLocation-form #district_id");
            let upazilaSelectElement = $("#gioLocation-form #upazila_id");
            let batchLinkForm = $("#add-batch-form");
            let batchLinkCheck = $("#add-batch-form #batch-checkbox");
            let selectAllBox = $("#add-batch-form #select-all");

            // remove stored localstoreage selectedBatches
            $("#clear-selected").on('click', function(event) {
                event.preventDefault();
                localStorage.removeItem('selectedBatches');
                // location.reload();
                batchLinkCheck.html("");
                selectAllBox.addClass("d-none");
                generateSelectedList();
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
            })
            // link-batch-form input value set
            generateSelectedList();

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

            // get the upazila id
            upazilaSelectElement.change(function() {
                selectAllBox.addClass("d-none");
                $("#checkAll").prop('checked', '');
                batchLinkCheck.html("");
                let upazila_id = upazilaSelectElement.val();
                if (upazila_id) {
                    const link = api_baseurl + "batch/geo-code/" + upazila_id;
                    $.ajax({
                        type: "GET",
                        url: link,
                        headers: {
                            Authorization: authToken,
                        },
                        success: function(results) {
                            // Handle the successful response here
                            // console.log(results.data);
                            let allData = results.data;
                            let GEOCode = results.GEOCode
                            // console.log(results);
                            batchLinkCheck.html("");

                            // Assuming you have already retrieved selectedBatches from local storage
                            let selectedBatches = JSON.parse(localStorage.getItem(
                                'selectedBatches')) || {};

                            if (allData.length > 0) {
                                selectAllBox.removeClass("d-none");
                                $("#selectAllCheckbox").prop('checked', '');
                                $.each(allData, function(index, data) {
                                    let isChecked = selectedBatches[data.id];

                                    let checkbox = `
                                        <div class="col mt-5">
                                            <div class="form-check">
                                                <input class="form-check-input batch-checkbox" type="checkbox" id="${data.id}" name="batches[]"
                                                    value="${data.id}" batchCode="${data.batchCode ?? ''}" batchTitle="${data.training.title.Name ?? ''}"
                                                    GEOLocation="${data.GEOLocation}" ${isChecked ? 'checked' : ''} ${!fromEdit ? (data.provider_id ? 'disabled' : '') : ''}>
                                                <label class="form-check-label text-dark" for="${data.id}">
                                                    ${data.batchCode} (${data.training.title.Name ?? ""})
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
                                        } else {
                                            delete selectedBatches[batchId];
                                        }

                                        // Store the updated selectedBatches in local storage
                                        localStorage.setItem('selectedBatches', JSON
                                            .stringify(selectedBatches));

                                        let storedBatches = JSON.parse(localStorage.getItem(
                                            'selectedBatches')) || {};
                                        console.log(storedBatches);
                                        // link-batch-form input vlue set
                                        generateSelectedList()
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

            // Provider link batches form submit
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
                        let link = api_baseurl + "provider-batches/create";

                        let batchIds = $("#link-batch-form [name=link-batches]").val();

                        // console.log(batchIds);

                        fd.append("batch_ids", batchIds);
                        fd.append("provider_id", providerId);
                        fd.append("_token", CSRF_TOKEN);
                        if (fromEdit || (batchIds == '' && storedDBBatches) || storedDBBatches) {
                            fd.append("edit", true);
                        }
                        $.ajax({
                            type: "post",
                            data: fd,
                            processData: false,
                            contentType: false,
                            dataType: "JSON",
                            url: link,
                            headers: {
                                Authorization: authToken,
                                "X-localization": language,
                            },
                            success: function(results) {
                                console.log(results);
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
                                        swal.fire(ValidationError, errors);
                                    }
                                }
                            },
                        });
                    }
                });
            });

            // function 
            function generateSelectedList() {
                let linkBatchSection = $("#link-batch-section");
                let linkBatchShowDiv = $("#link-batch-show");
                linkBatchShowDiv.empty(); // Clear previous content
                let storedBatches = JSON.parse(localStorage.getItem('selectedBatches')) || {};
                if (Object.keys(storedBatches).length > 0) {
                    // linkBatchSection.removeClass('d-none');
                    let batchKeysArray = Object.keys(storedBatches);

                    // Set the value of the input to the array of batch keys
                    $("#link-batch-form [name='link-batches']").val(batchKeysArray);

                    // Append array object items to the div with ID link-batch-show  

                    batchKeysArray.forEach(batchId => {
                        // Access the batch information from storedBatches using the batchId
                        let batchInfo = storedBatches[batchId];

                        // Create a pill-like element with batchCode and title and append it to the div
                        let pillElement =
                            `<div class="badge badge-pill badge-info p-2 d-flex flex-column gap-2">
                                <div>${batchInfo.batchCode} - ${batchInfo.title}</div>
                                <div>(${batchInfo.GEOLocation})</div>
                            </div>`;
                        linkBatchShowDiv.append(pillElement);
                    });
                    $("#clear-selected").removeClass("d-none");
                } else {
                    // linkBatchSection.addClass('d-none');
                    $("#clear-selected").addClass("d-none");
                    $("#link-batch-form [name='link-batches']").val('');
                }
            }
        });
    </script>
@endsection