<div>
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
                        <select class="form-select api-call" name="training_title_id" id="training_title_id">

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
    @push('js')
        <script>
            $(document).ready(function() {
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

                // $('.api-call').change(function() {
                //     // let training_title_id = $('#training_title_id').val();
                //     // let division_code = $('#division_id').val();
                //     // let district_code = $('#district_id').val();
                //     // let upazila_code = $('#upazila_id').val();
                //     // let provider_id = $('#provider_id').val();
                //     // $(this).closest('form').submit();
                // });
            });
        </script>
    @endpush
</div>
