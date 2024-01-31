$(function () {
    // let authToken = authToken;
    $(document).ready(function () {
        // Permission Create api call
        $("#create_permission").submit(function (e) {
            e.preventDefault();

            let fd = new FormData();
            let CSRF_TOKEN = $('meta[name="csrf-token"]').attr("content");
            let link = api_baseurl + "permissions/create";

            let name = $("#permission_add_form [name=name]").val();
            let route_name = $("#permission_add_form [name=route_name]").val();
            let guard_name = $("#permission_add_form [name=guard_name]").val();

            fd.append("name", name);
            fd.append("route_name", route_name);
            fd.append("guard_name", guard_name);
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
                                $(
                                    "#permission_add_form .form-message-error-name"
                                )
                                    .html(results.message.name[0])
                                    .addClass("text-danger")
                                    .fadeIn(5000);
                                setTimeout(() => {
                                    $(
                                        "#permission_add_form .form-message-error-name"
                                    )
                                        .html("")
                                        .removeClass("text-danger")
                                        .fadeOut();
                                    Logo;
                                }, 5000);
                            }
                            if (results.message.route_name) {
                                $(
                                    "#permission_add_form .form-message-error-mobile"
                                )
                                    .html(results.message.route_name[0])
                                    .addClass("text-danger")
                                    .fadeIn(5000);
                                setTimeout(() => {
                                    $(
                                        "#permission_add_form .form-message-error-route_name"
                                    )
                                        .html("")
                                        .removeClass("text-danger")
                                        .fadeOut();
                                    Logo;
                                }, 5000);
                            }
                            if (results.message.guard_name) {
                                $(
                                    "#provider_add_form .form-message-error-guard_name"
                                )
                                    .html(results.message.guard_name[0])
                                    .addClass("text-danger")
                                    .fadeIn(5000);
                                setTimeout(() => {
                                    $(
                                        "#provider_add_form .form-message-error-guard_name"
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

        // edit permission
        $(document).on("click", ".editPermission", function () {
            let id = $(this).attr("data-permission-id");
            let url_link = api_baseurl + "permissions/edit-permission/" + id;
            $.ajax({
                url: url_link,
                type: "GET",
                data: {},
                headers: {
                    Authorization: authToken,
                    "X-localization": language,
                },
                success: function (item) {
                    let permission = item.data;
                    // console.log(permission);
                    $("#permission_edit_form #name").val(permission["name"]);
                    $("#permission_edit_form #route_name").val(
                        permission["route_name"]
                    );
                    $("#permission_edit_form #guard_name").val(
                        permission["guard_name"]
                    );

                    $("#permission_edit_form #permission_id").val(
                        permission["id"]
                    );
                },
            });
        });

        // update permission
        $("#permission_edit_form").submit(function (e) {
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

                    let id = $("#permission_edit_form #permission_id").val();

                    let link = api_baseurl + "permissions/" + id + "/update";
                    // console.log(link);
                    let name = $("#permission_edit_form [name=name]").val();
                    let route_name = $(
                        "#permission_edit_form [name=route_name]"
                    ).val();
                    let guard_name = $(
                        "#permission_edit_form [name=guard_name]"
                    ).val();

                    fd.append("name", name);
                    fd.append("route_name", route_name);
                    fd.append("guard_name", guard_name);
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
                                swal.fire(
                                    "Success",
                                    results.data + " " + results.message
                                );
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
    });
});
