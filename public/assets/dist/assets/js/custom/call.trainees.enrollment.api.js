$(function () {
    // let authToken = authToken;
    $(document).ready(function () {
        let traineeEnrollTbody = $("#trainees-enroll-tbody");
        let selectedValues;

        const link = api_baseurl + "trainee-enroll";
        $.ajax({
            type: "GET",
            url: link,
            headers: {
                Authorization: authToken,
            },
            success: function (results) {
                // Handle the successful response here
                console.log(results.data);
                let allTraineesEnrollment = results.data;
                let bcode = ' ';
                sessionStorage.removeItem("message");
                if (allTraineesEnrollment.length > 0) {
                    $.each(allTraineesEnrollment, function (index, traineeEnroll) {
                      

                        let traineeEnrollTr = `
                                <tr>
                                    <td>
                                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                                            <input class="form-check-input traineeEnroll-item" type="checkbox" name="traineeEnrollId"
                                                value="${traineeEnroll.id}" />
                                        </div>
                                    </td>
                                    <td>                                        
                                        ${traineeEnroll.id}
                                    </td>
                                    <td >
                                        <!--begin::provider details-->
                                        <div class="d-flex flex-column">
                                            <a href="#" class="text-gray-800 text-hover-primary mb-1">
                                                ${traineeEnroll.profile.KnownAs}
                                            </a>
                                            <span></span>
                                        </div>
                                        <!--begin::provider details-->
                                    </td>

                                    <td>
                                        <!--begin::provider details-->
                                        <div class="d-flex flex-column">
                                            <a href="#" class="text-gray-800 text-hover-primary mb-1">
                                                ${traineeEnroll.profile.address}
                                            </a>
                                            <span></span>
                                        </div>
                                        <!--begin::provider details-->
                                    </td>
                                    <td>
                                        <!--begin::provider details-->
                                        <div class="d-flex flex-column">
                                            <a href="#" class="text-gray-800 text-hover-primary mb-1">
                                                ${traineeEnroll.training_batch.batchCode}
                                            </a>
                                            <span></span>
                                        </div>
                                        <!--begin::provider details-->
                                    </td>
                                    
                                    <td class="text-end">
                                        <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 show-action" 
                                        data-trainee-enroll-id="${traineeEnroll.id}" data-bs-toggle="modal" id="view_trainee_enroll-modal" data-bs-target="#view_trainee_enroll">
                                            <i class="ki-duotone ki-switch fs-2">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </a>
                                    </td>
                                </tr>
                            `;

                        traineeEnrollTbody.append(traineeEnrollTr);
                    });
                } else {
                    traineeEnrollTbody.innerHTML = `
                            <tr>
                                <td class="w-100">No Provider Found</td>
                            </tr>                            
                        `;
                }
            },
            error: function (xhr, status, error) {
                // Handle errors here
                console.error(xhr, status, error);
            },
        });

        $('[name="all-trainees-enroll"]').on("click", function () {
            if ($(this).is(":checked")) {
                $.each($(".traineeEnroll-item"), function () {
                    $(this).prop("checked", true);
                });
            } else {
                $.each($(".traineeEnroll-item"), function () {
                    $(this).prop("checked", false);
                });
            }
        });

        // show provider batches
        $(document).on("click", "#view_trainee_enroll-modal", function (e) {
            e.preventDefault();
            let trainingBatchesList = $("#training-batches-list");
            trainingBatchesList.empty();
            let id = $(this).attr("data-trainee-enroll-id");
            let link = api_baseurl + "trainee-enroll/" + id + "/show";

            $.ajax({
                type: "get",
                dataType: "JSON",
                url: link,
                headers: {
                    Authorization: authToken,
                },
                success: function (results) {
                    let enrollData = results.data;
                    $("#trainee-name").html(enrollData.profile.KnownAs ?? "");
                    $("#trainee-email").html(enrollData.profile.Email ?? "");
                    $("#trainee-phone").html(enrollData.profile.Phone ?? "");
                    $("#trainee-address").html(enrollData.profile.address ?? "");
                    $("#title").html(enrollData.training_title.Name ?? "");
                    console.log(enrollData);
                    let trainingBatches = enrollData.training_batch;
                    console.log(trainingBatches);
                    sessionStorage.removeItem("message");

                    if (trainingBatches) {
                        let batchListItem = `
                                <!--begin::Batch-->
                                <div class="d-flex flex-stack py-2 border-bottom border-gray-300 border-bottom-dashed">
                                    <h3 class="mt-3">${enrollBatchCode}: ${trainingBatches.batchCode ?? ""}</h3>
                                </div>
                                <div class="d-flex flex-stack py-2 border-bottom border-gray-300 border-bottom-dashed">
                                    <!--begin::Details-->
                                    <div class="d-flex align-items-center">                                    
                                        <!--begin::Details-->
                                        <div class="ms-6">
                                            <!--begin::Name-->
                                                <div class="text-muted fw-semibold fs-5">${startDate}:
                                                    <span class="badge badge-light fs-8 fw-semibold ms-2">
                                                    ${new Date(trainingBatches.startDate) ?? ""}
                                                    </span>
                                                </div>  
                                                <div class="text-muted fw-semibold fs-5">${geoCode}:
                                                    <span class="badge badge-light fs-8 fw-semibold ms-2">
                                                    ${trainingBatches.GEOCode ?? ""}
                                                    </span>
                                                </div>
                                                <div class="text-muted fw-semibold fs-5">${locations}:
                                                    <span class="badge badge-light fs-8 fw-semibold ms-2">
                                                    ${trainingBatches.GEOLocation ?? ""}
                                                    </span>
                                                </div>
                                                    
                                                
                                            <!--end::Name-->
                                        </div>
                                        <!--end::Details-->
                                    </div>
                                    <!--end::Details-->
                                    <!--begin::Stats-->
                                    <div class="d-flex align-items-center"">
                                        <!--begin::Sales-->
                                        <div class="ms-6">
                                            <div class="text-muted fw-semibold fs-5">${vanue}:
                                                <span class="badge badge-light fs-8 fw-semibold ms-2">
                                                    ${trainingBatches.TrainingVenue ?? ""}
                                                </span>
                                            </div>
                                            <div class="text-muted fw-semibold fs-5">${totalTrainee}:
                                                <span class="badge badge-light fs-8 fw-semibold ms-2">
                                                  ${trainingBatches.totalTrainees ?? 0}
                                                </span>
                                            </div>
                                            <div class="text-muted fw-semibold fs-5">${totalDuration}:
                                                <span class="badge badge-light fs-8 fw-semibold ms-2">
                                                  ${trainingBatches.duration ?? 0}
                                                </span>
                                            </div>
                                        </div>
                                        <!--end::Sales-->
                                    </div>
                                    <!--end::Stats-->
                                </div>
                                <!--end::Batch-->
                            `;

                        trainingBatchesList.append(batchListItem);
                    } else {
                        trainingBatchesList.html(`
                            <div class="d-flex flex-stack py-5 border-bottom border-gray-300 border-bottom-dashed text-warning">
                                No Batch Found
                            </div>
                        `);
                    }
                },
                error: function (xhr, status, error) {
                    // Handle errors here
                    console.error(xhr, status, error);
                },
            });
        });

    });
});
