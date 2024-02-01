@extends('layouts.auth-master')
{{-- @dump($total_batches) --}}
@section('content')
    <!--begin::Content -->
    <div class="m-5">
        <x-alert />
        {{-- @dump($from_edit) --}}

        {{-- @dd($lot) --}}
        <div class="card p-5">
            <div id="">
                <h2 class="text-center">Inspaction</h2>
            </div>
            <div class="mt-5">
                <h4>Inspection (Find Batch)</h4>
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
                    <div id="add-batch-form" class="border rounded p-3" style="background-color: #faf5ff;">
                        <div class="row row-cols-3 g-3" id="batch-checkbox">

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            let divisionSelectElement = $("#gioLocation-form #division_id");
            let districtSelectElement = $("#gioLocation-form #district_id");
            let upazilaSelectElement = $("#gioLocation-form #upazila_id");
            let batchLinkForm = $("#add-batch-form");
            let batchLinkCheck = $("#add-batch-form #batch-checkbox");
            let app_url = "{{ url('') }}";
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
                $("#checkAll").prop('checked', '');
                batchLinkCheck.html("");
                if (1) {
                    const link = api_baseurl + "batch/link/get-batches";
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
                            console.log(results.data);
                            let allData = results.data;
                            batchLinkCheck.html("");

                            if (allData.length > 0) {
                                $("#selectAllCheckbox").prop('checked', '');
                                $.each(allData, function(index, data) {
                                    let batchTitle = '';
                                    if (data.training) {
                                        batchTitle = data.training.title.Name ?? "";
                                        scheduleId = data.schedule ? data.schedule.id :
                                            "";
                                    }
                                    providerName = data.provider ? data.provider
                                        .name :
                                        "";
                                    if (scheduleId) {
                                        let checkbox = `
                                        <div class="col mt-5">
                                            <div class="mb-1 me-1 d-inline-flex bg-success text-white rounded overflow-hidden border border-secondary view-item batch-item" style="cursor: pointer;">                                                
                                                <input type="hidden" name="batch_id" value="${data.id}">
                                                <input type="hidden" name="schedule_id" value="${scheduleId}">
                                                <div class="px-4 py-1 text-center" style="user-select: none;">
                                                    ${data.batchCode} (${batchTitle ?? ""})
                                                    Provider: ${providerName}
                                                </div>
                                            </div>
                                        </div>
                                    `;

                                        batchLinkCheck.append(checkbox);
                                    }
                                });
                            } else {
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

            batchLinkCheck.on('click', '.batch-item', function() {
                var batchId = $(this).find('input[name="batch_id"]').val();
                var scheduleId = $(this).find('input[name="schedule_id"]').val();
                console.log("Batch ID: " + batchId);
                console.log("Schedule ID: " + scheduleId);
                if (batchId && scheduleId) {
                    let finalUrl =
                        `${app_url}/tms-inspections/create?batch_id=${batchId}&schedule_detail_id=${scheduleId}`;

                    window.open(finalUrl);
                }
            });
        });
    </script>
@endsection
