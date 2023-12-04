$(function () {
    let authToken = localStorage.getItem("authToken");
    $(document).ready(function () {
        let selectValues;
        // Class definition
        var KTSelect3 = (function () {
            // Private functions
            var demos = function () {
                // multi select
                $("#kt_select2_4").select2({
                    placeholder: selectTrainer,
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
            KTSelect3.init();
        });

        const $select = $("#link_trainers_form #kt_select2_3");

        $select.on("change", function () {
            selectValues = $select.val();
            // console.log(selectValues);
        });

        // link trainer with batches modal open
        $(document).on(
            "click",
            "#link-trainer-with-batches-modal",
            function (e) {
                // search load data aa
                const api_link = api_baseurl + "trainers";
                let id = $(this).attr("data-batch-id");
                let provider_id = $(this).attr("data-provider-id");
                trainersSelector = $("#link_trainers_form #kt_select2_3");
                $("#link_trainers_form [name=batch-id]").val(id);
                $("#link_trainers_form [name=provider-id]").val(provider_id);
                populateTrainerOption(api_link, authToken, trainersSelector);
            }
        );

        // Trainer link batches form submit
        $("#link_trainers_form").submit(function (e) {
            e.preventDefault();

            let fd = new FormData();
            let CSRF_TOKEN = $('meta[name="csrf-token"]').attr("content");
            let link = api_baseurl + "trainers/enroll";

            let batchId = $("#link_trainers_form [name=batch-id]").val();
            let providerId = $("#link_trainers_form [name=provider-id]").val();
            let trainerIds = selectValues;

            fd.append("trainer_ids", trainerIds);
            fd.append("batch_id", batchId);
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
                                    "#link_trainers_form .form-message-error-trainer_ids"
                                )
                                    .html(results.message.trainer_ids[0])
                                    .addClass("text-danger")
                                    .fadeIn(5000);
                                setTimeout(() => {
                                    $(
                                        "#link_trainers_form .form-message-error-trainer_ids"
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
            let web_url = $("#provider_add_form [name=web_url]").val();
            let address = $("#provider_add_form [name=address]").val();
            fd.append("name", name);
            fd.append("email", email);
            fd.append("mobile", mobile);
            fd.append("web_url", web_url);
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
                    Authorization: localStorage.getItem("authToken"),
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
                            if (results.message.web_url) {
                                $(
                                    "#provider_add_form .form-message-error-web_url"
                                )
                                    .html(results.message.web_url[0])
                                    .addClass("text-danger")
                                    .fadeIn(5000);
                                setTimeout(() => {
                                    $(
                                        "#provider_add_form .form-message-error-web_url"
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
                    Authorization: localStorage.getItem("authToken"),
                    "X-localization": language,
                },
                success: function (item) {
                    let providers = item.data;

                    $("#provider_edit_form #name").val(providers["name"]);
                    $("#provider_edit_form #email").val(providers["email"]);
                    $("#provider_edit_form #mobile").val(providers["mobile"]);
                    $("#provider_edit_form #web_url").val(providers["web_url"]);
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
                    let web_url = $("#provider_edit_form [name=web_url]").val();
                    let address = $("#provider_edit_form [name=address]").val();

                    fd.append("name", name);
                    fd.append("email", email);
                    fd.append("mobile", mobile);
                    fd.append("web_url", web_url);
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
                            Authorization: localStorage.getItem("authToken"),
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
                                    if (results.message.web_url) {
                                        $(
                                            "#provider_edit_form .form-message-error-web_url"
                                        )
                                            .html(results.message.web_url[0])
                                            .addClass("text-danger")
                                            .fadeIn(5000);
                                        setTimeout(() => {
                                            $(
                                                "#provider_edit_form .form-message-error-web_url"
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
                            Authorization: localStorage.getItem("authToken"),
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
