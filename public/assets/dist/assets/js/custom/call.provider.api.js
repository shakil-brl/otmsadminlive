$(function () {
    // let authToken = authToken;
    $(document).ready(function () {
        let providerTbody = $("#provider-tbody");
        let selectedValues;

        const link = api_baseurl + "providers";
        $.ajax({
            type: "GET",
            url: link,
            headers: {
                Authorization: authToken,
                "X-localization": language,
            },
            success: function (results) {
                // Handle the successful response here
                // console.log(results.data);
                let allProviders = results.data;
                sessionStorage.removeItem("message");
                if (allProviders.length > 0) {
                    $.each(allProviders, function (index, provider) {
                        let providerTr = `
                                <tr>
                                    <td>
                                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                                            <input class="form-check-input provider-item" type="checkbox" name="providerId"
                                                value="${provider.id}" />
                                        </div>
                                    </td>
                                    <td>                                        
                                        ${provider.id}
                                    </td>
                                    <td class="d-flex align-items-center">
                                        <!--begin::provider details-->
                                        <div class="d-flex flex-column">
                                            <a href="#" class="text-gray-800 text-hover-primary mb-1">
                                                ${provider.name}
                                            </a>
                                            <span></span>
                                        </div>
                                        <!--begin::provider details-->
                                    </td>

                                    <td>
                                        <!--begin::provider details-->
                                        <div class="d-flex flex-column">
                                            <a href="#" class="text-gray-800 text-hover-primary mb-1">
                                                ${provider.email}
                                            </a>
                                            <span></span>
                                        </div>
                                        <!--begin::provider details-->
                                    </td>

                                    <td>
                                        <!--begin::provider details-->
                                        <div class="d-flex flex-column">
                                            <a href="#" class="text-gray-800 text-hover-primary mb-1">
                                                ${provider.phone}
                                            </a>
                                            <span></span>
                                        </div>
                                        <!--begin::provider details-->
                                    </td>

                                    <td>
                                        <!--begin::provider details-->
                                        <div class="d-flex flex-column">
                                            <a href="#" class="text-gray-800 text-hover-primary mb-1">
                                                ${provider.address}
                                            </a>
                                            <span></span>
                                        </div>
                                        <!--begin::provider details-->
                                    </td>
                                    
                                    <td class="text-end">
                                        <a href="#" id="link-with-batches-modal" class="btn btn-bg-light btn-color-muted btn-active-color-primary btn-sm px-4 me-2" 
                                        data-provider-id="${provider.id}" data-bs-toggle="modal" data-bs-target="#link_batches" data-bs-toggle="tooltip" data-bs-custom-class="tooltip-inverse" data-bs-placement="bottom" title="Batch Link to Provider">
                                        ${linkBatch}
                                        </a>
                                        <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 show-action" 
                                        data-provider-id="${provider.id}" data-provider-name="${provider.name}" data-bs-toggle="modal" id="view_provider-modal" data-bs-target="#view_provider" data-bs-toggle="tooltip" data-bs-custom-class="tooltip-inverse" data-bs-placement="bottom" title="Provider Details" >
                                            <i class="ki-duotone ki-switch fs-2">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </a>
                                        <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 editProvider" 
                                        data-provider-id="${provider.id}" data-bs-toggle="modal" data-bs-target="#edit_provider" data-bs-toggle="tooltip" data-bs-custom-class="tooltip-inverse" data-bs-placement="bottom" title="Provider Edit">
                                            <i class="ki-duotone ki-pencil fs-2">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </a>
                                        <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm delete-provider" 
                                        data-provider-id="${provider.id}" data-provider-name="${provider.name}" data-bs-toggle="tooltip" data-bs-custom-class="tooltip-inverse" data-bs-placement="bottom" title="Provider Delete">
                                            <i class="ki-duotone ki-trash fs-2">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                                <span class="path4"></span>
                                                <span class="path5"></span>
                                            </i>
                                        </a>
                                    </td>
                                </tr>
                            `;

                        providerTbody.append(providerTr);
                    });
                } else {
                    providerTbody.innerHTML = `
                            <tr>
                                <td class="w-100"> No Provider Found</td>
                            </tr>                            
                        `;
                }
            },
            error: function (xhr, status, error) {
                // Handle errors here
                console.error(xhr, status, error);
            },
        });

        $('[name="all-provider"]').on("click", function () {
            if ($(this).is(":checked")) {
                $.each($(".provider-item"), function () {
                    $(this).prop("checked", true);
                });
            } else {
                $.each($(".provider-item"), function () {
                    $(this).prop("checked", false);
                });
            }
        });

        // Class definition
        var KTSelect2 = (function () {
            // Private functions
            var demos = function () {
                // multi select
                $("#kt_select2_3").select2({
                    placeholder: selectBatch,
                });
            };

            // Public functions
            return {
                init: function () {
                    demos();
                },
            };
        })();

        // Initialization
        jQuery(document).ready(function () {
            KTSelect2.init();
        });

        const $select = $("#link_batches_form #kt_select2_3");

        $select.on("change", function () {
            selectedValues = $select.val();
            // console.log(selectedValues);
        });

        // show provider batches
        $(document).on("click", "#view_provider-modal", function (e) {
            e.preventDefault();
            let trainingBatchesList = $("#training-batches-list");
            trainingBatchesList.empty();
            let id = $(this).attr("data-provider-id");
            let link = api_baseurl + "providers/" + id + "/show";

            $.ajax({
                type: "get",
                dataType: "JSON",
                url: link,
                headers: {
                    Authorization: authToken,
                    "X-localization": language,
                },
                success: function (results) {
                    // console.log(results);
                    let providerData = results.data;
                    $("#provider-email").html(providerData.email ?? "");
                    $("#provider-name").html(providerData.name ?? "");
                    $("#provider-address").html(providerData.address ?? "");
                    //$("#provider-web_url").html(providerData.web_url ?? "");
                    // console.log(results);
                    let trainingBatches = results.data.training_batches;
                    console.log(trainingBatches);
                    sessionStorage.removeItem("message");

                    if (trainingBatches.length > 0) {
                        $.each(trainingBatches, function (index, batch) {
                            let batchListItem = `
                                <!--begin::Batch-->
                                <div class="d-flex flex-stack py-2 border-bottom border-gray-300 border-bottom-dashed">
                                    <!--begin::Details-->
                                    <div class="d-flex align-items-center">                                    
                                        <!--begin::Details-->
                                        <div class="ms-6">
                                            <!--begin::Name-->
                                            <a href="#"
                                                class="d-flex align-items-center fs-5 fw-bold text-dark text-hover-primary">
                                                    ${batch.batchCode ?? ""}
                                                <span class="badge badge-light fs-8 fw-semibold ms-2">
                                                    ${batch.GEOLocation ?? ""}
                                                </span>
                                            </a>
                                            <!--end::Name-->
                                        </div>
                                        <!--end::Details-->
                                    </div>
                                    <!--end::Details-->
                                    <!--begin::Stats-->
                                    <div class="d-flex">
                                        <!--begin::Sales-->
                                        <div class="text-end d-flex align-item-center gap-2">
                                            <div class="fs-7 fw-bold text-dark">
                                                ${batch.TrainingVenue ?? ""}
                                            </div>
                                            <div class="fs-7 text-muted">
                                               (${totalTrainee}
                                               ${batch.totalTrainees ?? 0})
                                            </div>
                                        </div>
                                        <!--end::Sales-->
                                    </div>
                                    <!--end::Stats-->
                                </div>
                                <!--end::Batch-->
                            `;

                            trainingBatchesList.append(batchListItem);
                        });
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

        // link provider with batches modal open
        $(document).on("click", "#link-with-batches-modal", function (e) {
            // search load data
            const api_link = api_baseurl + "batches";
            let id = $(this).attr("data-provider-id");
            batchesSelector = $("#link_batches_form #kt_select2_3");
            $("#link_batches_form [name=provider-id]").val(id);
            populateProviderOption(api_link, authToken, batchesSelector);
        });

        // Provider link batches form submit
        $("#link_batches_form").submit(function (e) {
            e.preventDefault();

            let fd = new FormData();
            let CSRF_TOKEN = $('meta[name="csrf-token"]').attr("content");
            let link = api_baseurl + "provider-batches/create";

            let providerId = $("#link_batches_form [name=provider-id]").val();
            let batchIds = selectedValues;
            // console.log(providerId);
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
                success: function (results) {
                    console.log(results);
                    if (results.success === true) {
                        swal.fire(yes, results.message);

                        sessionStorage.setItem("message", results.message);
                        sessionStorage.setItem("alert-type", "info");

                        // refresh page after 2 seconds
                        setTimeout(function () {
                            location.reload();
                        }, 2000);
                    } else {
                        if (results.error === true) {
                            var errors = results.message;
                            swal.fire(ValidationError, errors);
                        }

                        if (results.error === true) {
                            if (results.message.batch_ids) {
                                $(
                                    "#link_batches_form .form-message-error-batch-ids"
                                )
                                    .html(results.message.batch_ids[0])
                                    .addClass("text-danger")
                                    .fadeIn(5000);
                                setTimeout(() => {
                                    $(
                                        "#link_batches_form .form-message-error-batch-ids"
                                    )
                                        .html("")
                                        .removeClass("text-danger")
                                        .fadeOut();
                                    Logo;
                                }, 5000);
                            }
                        }
                    }
                },
            });
        });

        // Provider Create api call
        $("#create_provider").submit(function (e) {
            e.preventDefault();

            let fd = new FormData();
            let CSRF_TOKEN = $('meta[name="csrf-token"]').attr("content");
            let link = api_baseurl + "providers/create";

            let name = $("#provider_add_form [name=name]").val();
            let email = $("#provider_add_form [name=email]").val();
            let mobile = $("#provider_add_form [name=mobile]").val();
            //let web_url = $("#provider_add_form [name=web_url]").val();
            let address = $("#provider_add_form [name=address]").val();
            fd.append("name", name);
            fd.append("email", email);
            fd.append("mobile", mobile);
            //fd.append("web_url", web_url);
            fd.append("address", address);
            fd.append("_token", CSRF_TOKEN);

            $.ajax({
                type: "post",
                data: fd,
                dataType: "JSON",
                cache: false,
                contentType: false,
                processData: false,
                url: link,
                headers: {
                    Authorization: authToken,
                    "X-localization": language,
                },
                success: function (results) {
                    if (results.success === true) {
                        swal.fire(yes, results.message);

                        sessionStorage.setItem("message", results.message);
                        sessionStorage.setItem("alert-type", "info");

                        // refresh page after 2 seconds
                        setTimeout(function () {
                            location.reload();
                        }, 2000);
                    } else {
                        if (results.error === true) {
                            var errors = ValidationError;
                            swal.fire("", errors);
                        }

                        if (results.error === true) {
                            if (results.message.name) {
                                $("#provider_add_form .form-message-error-name")
                                    .html(results.message.name[0])
                                    .addClass("text-danger")
                                    .fadeIn(5000);
                                setTimeout(() => {
                                    $(
                                        "#provider_add_form .form-message-error-name"
                                    )
                                        .html("")
                                        .removeClass("text-danger")
                                        .fadeOut();
                                    Logo;
                                }, 5000);
                            }
                            if (results.message.mobile) {
                                $(
                                    "#provider_add_form .form-message-error-mobile"
                                )
                                    .html(results.message.mobile[0])
                                    .addClass("text-danger")
                                    .fadeIn(5000);
                                setTimeout(() => {
                                    $(
                                        "#provider_add_form .form-message-error-mobile"
                                    )
                                        .html("")
                                        .removeClass("text-danger")
                                        .fadeOut();
                                    Logo;
                                }, 5000);
                            }
                            if (results.message.address) {
                                $(
                                    "#provider_add_form .form-message-error-address"
                                )
                                    .html(results.message.address[0])
                                    .addClass("text-danger")
                                    .fadeIn(5000);
                                setTimeout(() => {
                                    $(
                                        "#provider_add_form .form-message-error-address"
                                    )
                                        .html("")
                                        .removeClass("text-danger")
                                        .fadeOut();
                                    Logo;
                                }, 5000);
                            }
                        }
                    }
                },
            });
        });

        $(document).on("click", ".editProvider", function () {
            let id = $(this).attr("data-provider-id");
            let url_link = api_baseurl + "providers/" + id + "/edit";
            $.ajax({
                url: url_link,
                type: "GET",
                data: {},
                headers: {
                    Authorization: authToken,
                    "X-localization": language,
                },
                success: function (item) {
                    let providers = item.data;
                    console.log(item.data);
                    $("#provider_edit_form #name").val(providers["name"]);
                    $("#provider_edit_form #email").val(providers["email"]);
                    $("#provider_edit_form #phone").val(providers["phone"]);
                    //$("#provider_edit_form #web_url").val(providers["web_url"]);
                    $("#provider_edit_form #address").val(providers["address"]);
                    $("#provider_edit_form #provider_id").val(providers["id"]);
                },
            });
        });

        $("#provider_edit_form").submit(function (e) {
            e.preventDefault();
            Swal.fire({
                title: areYouSure,
                text: wantUpdate,
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: yesUpdate,
                cancelButtonText: noCancel,
            }).then((result) => {
                if (result.isConfirmed) {
                    let fd = new FormData();
                    let CSRF_TOKEN = $('meta[name="csrf-token"]').attr(
                        "content"
                    );

                    let id = $("#provider_edit_form #provider_id").val();

                    let link = api_baseurl + "providers/" + id + "/update";

                    let name = $("#provider_edit_form [name=name]").val();
                    let email = $("#provider_edit_form [name=email]").val();
                    let mobile = $("#provider_edit_form [name=mobile]").val();
                    //let web_url = $("#provider_edit_form [name=web_url]").val();
                    let address = $("#provider_edit_form [name=address]").val();

                    fd.append("name", name);
                    fd.append("email", email);
                    fd.append("phone", mobile);
                    //fd.append("web_url", web_url);
                    fd.append("address", address);
                    fd.append("_token", CSRF_TOKEN);
                    fd.append("_method", "patch");

                    $.ajax({
                        type: "post",
                        data: fd,
                        dataType: "JSON",
                        cache: false,
                        contentType: false,
                        processData: false,
                        url: link,
                        headers: {
                            Authorization: authToken,
                            "X-localization": language,
                        },
                        success: function (results) {
                            if (results.success === true) {
                                swal.fire(sucessfullyUpdated, results.data);
                                sessionStorage.setItem(
                                    "message",
                                    results.message
                                );
                                sessionStorage.setItem("alert-type", "info");
                                // refresh page after 2 seconds
                                setTimeout(function () {
                                    location.reload();
                                }, 2000);
                            } else {
                                if (results.error === true) {
                                    var errors = ValidationError;
                                    swal.fire("", errors);
                                }

                                if (results.error === true) {
                                    if (results.message.name) {
                                        $(
                                            "#provider_edit_form .form-message-error-name"
                                        )
                                            .html(results.message.name[0])
                                            .addClass("text-danger")
                                            .fadeIn(5000);
                                        setTimeout(() => {
                                            $(
                                                "#provider_edit_form .form-message-error-name"
                                            )
                                                .html("")
                                                .removeClass("text-danger")
                                                .fadeOut();
                                        }, 5000);
                                    }
                                    if (results.message.email) {
                                        $(
                                            "#provider_edit_form .form-message-error-email"
                                        )
                                            .html(results.message.email[0])
                                            .addClass("text-danger")
                                            .fadeIn(5000);
                                        setTimeout(() => {
                                            $(
                                                "#provider_edit_form .form-message-error-email"
                                            )
                                                .html("")
                                                .removeClass("text-danger")
                                                .fadeOut();
                                        }, 5000);
                                    }
                                    if (results.message.mobile) {
                                        $(
                                            "#provider_edit_form .form-message-error-mobile"
                                        )
                                            .html(results.message.mobile[0])
                                            .addClass("text-danger")
                                            .fadeIn(5000);
                                        setTimeout(() => {
                                            $(
                                                "#provider_edit_form .form-message-error-mobile"
                                            )
                                                .html("")
                                                .removeClass("text-danger")
                                                .fadeOut();
                                        }, 5000);
                                    }
                                    if (results.message.address) {
                                        $(
                                            "#provider_edit_form .form-message-error-address"
                                        )
                                            .html(results.message.address[0])
                                            .addClass("text-danger")
                                            .fadeIn(5000);
                                        setTimeout(() => {
                                            $(
                                                "#provider_edit_form .form-message-error-address"
                                            )
                                                .html("")
                                                .removeClass("text-danger")
                                                .fadeOut();
                                        }, 5000);
                                    }
                                }
                            }
                        },
                    });
                }
            });
        });

        // provider delete api call
        $(document).on("click", ".delete-provider", function (e) {
            e.preventDefault();
            let category_name = $(this).attr("data-provider-name");
            Swal.fire({
                title: areYouSure,
                text: "'" + category_name + "'" + deleteData,
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: yesDelete,
                cancelButtonText: noDelete,
            }).then((result) => {
                if (result.isConfirmed) {
                    let id = $(this).attr("data-provider-id");
                    let url_link = api_baseurl + "providers/" + id + "/delete";
                    $.ajax({
                        type: "get",
                        url: url_link,
                        headers: {
                            Authorization: authToken,
                            "X-localization": language,
                        },
                        success: function (results) {
                            if (results.success === true) {
                                swal.fire(deletedData, results.message);
                                sessionStorage.setItem(
                                    "message",
                                    results.message
                                );
                                sessionStorage.setItem("alert-type", "info");

                                // refresh page after 2 seconds
                                setTimeout(function () {
                                    location.reload();
                                }, 2000);
                            } else {
                                swal.fire("Error!", results.message, "error");
                            }
                        },
                        error: function (response) {
                            alert(response);
                        },
                    });
                }
            });
        });
    });
});
