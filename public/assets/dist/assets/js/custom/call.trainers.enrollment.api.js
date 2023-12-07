$(function () {
    let authToken = localStorage.getItem("authToken");
    $(document).ready(function () {
        let trainerEnrollTbody = $("#trainers-enroll-tbody");
        let selectedValues;

        const link = api_baseurl + "trainer-enroll";
        $.ajax({
            type: "GET",
            url: link,
            headers: {
                Authorization: localStorage.getItem("authToken"),
            },
            success: function (results) {
                // Handle the successful response here
                console.log(results.data);
                let allTrainersEnrollment = results.data;
                sessionStorage.removeItem("message");
                if (allTrainersEnrollment.length > 0) {
                    $.each(
                        allTrainersEnrollment,
                        function (index, trainerEnroll) {
                            let trainerEnrollTr = `
                                <tr>
                                    <td>
                                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                                            <input class="form-check-input trainerEnroll-item" type="checkbox" name="trainerEnrollId"
                                                value="${trainerEnroll.id}" />
                                        </div>
                                    </td>
                                    <td>                                        
                                        ${trainerEnroll.id}
                                    </td>
                                    <td >
                                        <!--begin::provider details-->
                                        <div class="d-flex flex-column">
                                            <a href="#" class="text-gray-800 text-hover-primary mb-1">
                                                ${
                                                    trainerEnroll.profile
                                                        ? trainerEnroll.profile
                                                              .KnownAsBangla
                                                        : ""
                                                } 
                                            </a>
                                            <span></span>
                                        </div>
                                        <!--begin::provider details-->
                                    </td>

                                    <td>
                                        <!--begin::provider details-->
                                        <div class="d-flex flex-column">
                                            <a href="#" class="text-gray-800 text-hover-primary mb-1">
                                                ${
                                                    trainerEnroll.profile
                                                        ? trainerEnroll.profile.Email
                                                        : ""
                                                    
                                                    }
                                            </a>
                                            <span></span>
                                        </div>
                                        <!--begin::provider details-->
                                    </td>

                                    <td>
                                        <!--begin::provider details-->
                                        <div class="d-flex flex-column">
                                            <a href="#" class="text-gray-800 text-hover-primary mb-1">
                                                ${
                                                    trainerEnroll.provider
                                                        ? trainerEnroll.provider.name
                                                        : ""
                                                    }
                                            </a>
                                            <span></span>
                                        </div>
                                        <!--begin::provider details-->
                                    </td>

                                    <td>
                                        <!--begin::provider details-->
                                        <div class="d-flex flex-column">
                                            <a href="#" class="text-gray-800 text-hover-primary mb-1">
                                                ${
                                                    trainerEnroll.training_batch
                                                        ? trainerEnroll.training_batch
                                                        .batchCode
                                                        : ""
                                                    
                                                }
                                            </a>
                                            <span></span>
                                        </div>
                                        <!--begin::provider details-->
                                    </td>
                                    
                                    <td class="text-end">
                                        <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 show-action" 
                                        data-trainer-enroll-id="${
                                            trainerEnroll.id
                                        }" data-bs-toggle="modal" id="view_trainer_enroll-modal" data-bs-target="#view_trainer_enroll">
                                            <i class="ki-duotone ki-switch fs-2">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </a>
                                    </td>
                                </tr>
                            `;

                            trainerEnrollTbody.append(trainerEnrollTr);
                        }
                    );
                } else {
                    trainerEnrollTbody.innerHTML = `
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

        $('[name="all-trainers-enroll"]').on("click", function () {
            if ($(this).is(":checked")) {
                $.each($(".trainerEnroll-item"), function () {
                    $(this).prop("checked", true);
                });
            } else {
                $.each($(".trainerEnroll-item"), function () {
                    $(this).prop("checked", false);
                });
            }
        });

        // show provider batches
        $(document).on("click", "#view_trainer_enroll-modal", function (e) {
            e.preventDefault();
            let trainerBatchesList = $("#trainer-batches-list");
            trainerBatchesList.empty();
            let id = $(this).attr("data-trainer-enroll-id");
            let link = api_baseurl + "trainer-enroll/" + id + "/show";

            $.ajax({
                type: "get",
                dataType: "JSON",
                url: link,
                headers: {
                    Authorization: authToken,
                },
                success: function (results) {
                    let enrollData = results.data;
                    console.log(enrollData);
                    $("#view_trainer_enroll #trainer-name").html(enrollData.profile.KnownAsBangla ?? "");
                    $("#view_trainer_enroll #trainer-email").html(enrollData.profile.Email ?? "");
                    $("#view_trainer_enroll #trainer-phone").html(enrollData.profile.Phone ?? "");
                    $("#view_trainer_enroll #trainer-address").html(
                        enrollData.profile.address ?? ""
                    );
                    $("#view_trainer_enroll #title").html(enrollData.provider.name ?? "");
                    let trainingBatches = enrollData.training_batch;
                    console.log(trainingBatches);
                    sessionStorage.removeItem("message");

                    if (trainingBatches) {
                        let batchListItem1 = `
                                <!--begin::Batch-->
                                <div class="d-flex flex-stack py-2 border-bottom border-gray-300 border-bottom-dashed">
                                    <h3 class="mt-3">${enrollBatchCode}: ${
                                        trainingBatches.batchCode ?? ""
                                    }</h3>
                                </div>
                                <div class="d-flex flex-stack py-2 border-bottom border-gray-300 border-bottom-dashed">
                                    <!--begin::Details-->
                                    <div class="d-flex align-items-center">                                    
                                        <!--begin::Details-->
                                        <div class="ms-6">
                                            <!--begin::Name-->
                                               
                                                <div class="text-muted fw-semibold fs-5">${geoCode}:
                                                    <span class="badge badge-light fs-8 fw-semibold ms-2">
                                                    ${
                                                        trainingBatches.GEOCode ??
                                                        ""
                                                    }
                                                    </span>
                                                </div>
                                                <div class="text-muted fw-semibold fs-5">${locations}:
                                                    <span class="badge badge-light fs-8 fw-semibold ms-2">
                                                    ${
                                                        trainingBatches.GEOLocation ??
                                                        ""
                                                    }
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
                                            <div class="text-muted fw-semibold fs-5">${vanue }:
                                                <span class="badge badge-light fs-8 fw-semibold ms-2">
                                                    ${
                                                        trainingBatches.TrainingVenue ??
                                                        ""
                                                    }
                                                </span>
                                            </div>
                                            <div class="text-muted fw-semibold fs-5">${totalTrainee}:
                                                <span class="badge badge-light fs-8 fw-semibold ms-2">
                                                  ${
                                                      trainingBatches.totalTrainees ??
                                                      0
                                                  }
                                                </span>
                                            </div>
                                            <div class="text-muted fw-semibold fs-5">${totalDuration}:
                                                <span class="badge badge-light fs-8 fw-semibold ms-2">
                                                  ${
                                                      trainingBatches.duration ??
                                                      0
                                                  }
                                                </span>
                                            </div>
                                        </div>
                                        <!--end::Sales-->
                                    </div>
                                    <!--end::Stats-->
                                </div>
                                <!--end::Batch-->
                            `;

                            trainerBatchesList.append(batchListItem1);
                    } else {
                        trainerBatchesList.html(`
                            <div class="d-flex flex-stack py-5 border-bottom border-gray-300 border-bottom-dashed text-warning">
                                No Batch Found
                            </div>
                        `);
                    }
                },
                error: function (xhr, status, error) {
                    // Handle errors here details
                    console.error(xhr, status, error);
                },
            });
        });
    });
});
