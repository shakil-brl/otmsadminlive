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
                    <h1 class="text-center"> {{__('provider-list.edit_linked_batch')}}</h1>
                    <h3>{{__('provider-list.vendor_names')}}:{{ $provider['name'] ?? '' }}</h3>
                    <div>
                        <div>{{__('provider-list.phone_number')}}: {{ $provider['phone'] ?? '' }}</div>
                        <div>{{__('provider-list.email')}}: {{ $provider['email'] ?? '' }}</div>
                        <div>{{__('provider-list.address')}}:{{ $provider['address'] ?? '' }}</div>
                    </div>
                </div>
                <div class="mt-5">
                    <h4>{{__('provider-list.batch_link_vendor')}}</h4>
                    <div class="my-3">
                        <div id="gioLocation-form">
                            <div class="d-flex justify-content-between gap-3">
                                <div class="w-25">
                                    <select class="mb-3 api-call form-select" name="per_page">
                                        <option value="50">{{__('provider-list.per_page')}}</option>
                                        @foreach (range(25, 525, 25) as $val)
                                            <option value="{{ $val }}">{{ $val }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="w-75">
                                    <div class="input-group">
                                        <input type="text" class="form-control api-call" name="search"
                                            placeholder="{{__('provider-list.search_batch_code')}}">
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
                                        {{__('provider-list.check_all')}}
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
                        <div class="fw-bold fs-5">{{__('provider-list.selected_batch')}}</div>
                        <div class="d-flex flex-wrap gap-1 border rounded p-3" id="link-batch-show"
                            style="background-color: #faf5ff;">

                        </div>
                        <button class="btn btn-danger mt-3" id="clear-selected">{{__('provider-list.clear_all')}}</button>
                    </div>
                    <form action="" id="link-batch-form" class="">
                        <input type="hidden" type="text" name="link-batches" value="">
                        <div class="text-center mt-3">
                            <button class="btn btn-success" type="submit">{{__('provider-list.submit')}}</button>
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
            let storedDBBatches = @json($provider['training_batches']);
            // console.log(storedDBBatches);
            // Initialize an empty object for selectedBatches
            var selectedBatches = {};

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

            // Convert selectedBatches to JSON
            var selectedBatchesJSON = JSON.stringify(selectedBatches);

            localStorage.setItem('selectedBatches', selectedBatchesJSON);

            // link-batch-form input value set adn view
            generateSelectedList();

            // remove item form view
            $("#link-batch-show").on('click', '.remove-batch-buton', function() {
                // Find the #batchCodeHidden within the clicked .bg-white element
                let removeBatchId = $(this).find('#batchCodeHidden').val();
                // alert(removeBatchId);
                let selectedBatches = JSON.parse(localStorage.getItem('selectedBatches'));
                if (selectedBatches && selectedBatches.hasOwnProperty(removeBatchId)) {
                    let checkboxId = `#${removeBatchId}`;

                    // Check or uncheck the checkbox
                    $(checkboxId).prop('checked', false);
                    // Remove the property from the object
                    delete selectedBatches[removeBatchId];

                    // Save the updated object back to localStorage
                    localStorage.setItem('selectedBatches', JSON.stringify(selectedBatches));
                }
                generateSelectedList();
            });

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

                            // Assuming you have already retrieved selectedBatches from local storage
                            let selectedBatches = JSON.parse(localStorage.getItem(
                                'selectedBatches')) || {};

                            if (allData.length > 0) {
                                selectAllBox.removeClass("d-none");
                                $("#selectAllCheckbox").prop('checked', '');
                                $.each(allData, function(index, data) {
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
                                                    GEOLocation="${data.GEOLocation}" ${isChecked ? 'checked' : ''} ${data.provider_id && data.provider_id != providerId ? 'disabled' : ''}>
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
                                        } else {
                                            delete selectedBatches[batchId];
                                        }

                                        // Store the updated selectedBatches in local storage
                                        localStorage.setItem('selectedBatches', JSON
                                            .stringify(selectedBatches));

                                        let storedBatches = JSON.parse(localStorage.getItem(
                                            'selectedBatches')) || {};
                                        // console.log(storedBatches);
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
                    title: "Are you sure?",
                    text: "Do you want to submit the form?",
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
                    // linkBatchSection.addClass('d-none');
                    $("#clear-selected").addClass("d-none");
                    $("#link-batch-form [name='link-batches']").val('');
                }
            }
        });
    </script>
@endsection
