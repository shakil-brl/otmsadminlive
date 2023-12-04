$(function () {
    // user register api call
    $("#register_form").submit(function (e) {
        e.preventDefault();
        Swal.fire({
            title: title,
            text: text,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: confirmButtonText,
            cancelButtonText: cancelButtonText,
        }).then((result) => {
            if (result.isConfirmed) {
                let fd = new FormData();
                let CSRF_TOKEN = $('meta[name="csrf-token"]').attr("content");
                let link = api_baseurl + "register";

                let fname = $("#register_form [name=fname]").val();
                let lname = $("#register_form [name=lname]").val();
                let email = $("#register_form [name=email]").val();
                let username = $("#register_form [name=username]").val();
                let password = $("#register_form [name=password]").val();
                let confirm_password = $(
                    "#register_form [name=confirm_password]"
                ).val();

                fd.append("fname", fname);
                fd.append("lname", lname);
                fd.append("email", email);
                fd.append("username", username);
                fd.append("password", password);
                fd.append("confirm_password", confirm_password);
                fd.append("_token", CSRF_TOKEN);
                alert(language);
                $.ajax({
                    type: "post",
                    data: fd,
                    dataType: "JSON",
                    cache: false,
                    contentType: false,
                    processData: false,
                    url: link,
                    headers: {
                        "X-localization": language,
                    },
                    success: function (results) {
                        console.log(results.error);
                        if (results.success === true) {
                            swal.fire("Sucessfully added!", results.data);
                            // refresh page after 2 seconds message
                            if (results.message) {
                                $("#register_form .form-message-error-success")
                                    .html(results.message)
                                    .addClass("text-info")
                                    .fadeIn(5000);
                            }
                        } else {
                            console.log(results.message);
                            if (results.error === true) {
                                var errors = results.msg;
                                swal.fire("", errors);
                            }

                            if (results.error === true) {
                                if (results.message.fname) {
                                    $(
                                        "#register_form .form-message-error-fname"
                                    )
                                        .html(results.message.fname[0])
                                        .addClass("text-danger")
                                        .fadeIn(5000);
                                    setTimeout(() => {
                                        $(
                                            "#register_form .form-message-error-fname"
                                        )
                                            .html("")
                                            .removeClass("text-danger")
                                            .fadeOut();
                                    }, 5000);
                                }
                                if (results.message.lname) {
                                    $(
                                        "#register_form .form-message-error-lname"
                                    )
                                        .html(results.message.lname[0])
                                        .addClass("text-danger")
                                        .fadeIn(5000);
                                    setTimeout(() => {
                                        $(
                                            "#register_form .form-message-error-lname"
                                        )
                                            .html("")
                                            .removeClass("text-danger")
                                            .fadeOut();
                                    }, 5000);
                                }
                                if (results.message.email) {
                                    $(
                                        "#register_form .form-message-error-email"
                                    )
                                        .html(results.message.email[0])
                                        .addClass("text-danger")
                                        .fadeIn(5000);
                                    setTimeout(() => {
                                        $(
                                            "#register_form .form-message-error-email"
                                        )
                                            .html("")
                                            .removeClass("text-danger")
                                            .fadeOut();
                                    }, 5000);
                                }
                                if (results.message.username) {
                                    $(
                                        "#register_form .form-message-error-username"
                                    )
                                        .html(results.message.username[0])
                                        .addClass("text-danger")
                                        .fadeIn(5000);
                                    setTimeout(() => {
                                        $(
                                            "#register_form .form-message-error-username"
                                        )
                                            .html("")
                                            .removeClass("text-danger")
                                            .fadeOut();
                                    }, 5000);
                                }
                                if (results.message.password) {
                                    $(
                                        "#register_form .form-message-error-password"
                                    )
                                        .html(results.message.password[0])
                                        .addClass("text-danger")
                                        .fadeIn(5000);
                                    setTimeout(() => {
                                        $(
                                            "#register_form .form-message-error-password"
                                        )
                                            .html("")
                                            .removeClass("text-danger")
                                            .fadeOut();
                                    }, 5000);
                                }
                                if (results.message.confirm_password) {
                                    $(
                                        "#register_form .form-message-error-confirm_password"
                                    )
                                        .html(
                                            results.message.confirm_password[0]
                                        )
                                        .addClass("text-danger")
                                        .fadeIn(5000);
                                    setTimeout(() => {
                                        $(
                                            "#register_form .form-message-error-confirm_password"
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

    // user login api call

    $("#kt_sign_in_form").submit(function (e) {
        e.preventDefault();

        let fd = new FormData();
        let CSRF_TOKEN = $('meta[name="csrf-token"]').attr("content");
        let link = api_baseurl + "login";

        let username = $("#kt_sign_in_form [name=username]").val();
        let password = $("#kt_sign_in_form [name=password]").val();

        fd.append("username", username);
        fd.append("password", password);
        fd.append("_token", CSRF_TOKEN);

        localStorage.removeItem("authToken");
        localStorage.removeItem("authUser");
        localStorage.removeItem("rolePermission");
        localStorage.removeItem("token");

        $.ajax({
            type: "post",
            data: fd,
            processData: false,
            contentType: false,
            url: link,
            headers: {
                "X-localization": language,
            },
            success: function (results) {

                if (results.success === true) {
                    const user = {
                        userId: results.user.id,
                        fullName: results.user.fname + " " + results.user.lname,
                        username: results.user.username,
                        userEmail: results.user.email,
                        profileId: results.userType.ProfileId,
                        userRole: results.userType.role.name,
                        expireTime: results.expires_in,
                    };
                    localStorage.setItem(
                        "authToken",
                        results.token_type + " " + results.access_token
                    );
                    localStorage.setItem(
                        "token",
                        results.access_token
                    );
                    localStorage.setItem("authUser", JSON.stringify(user));
                    localStorage.setItem("rolePermission", JSON.stringify(results.accessPermissions));
                    let authUserInfo = JSON.parse(localStorage.getItem('authUser'));
                    console.log(authUserInfo.profileId);
                    let rolePermissionInfo = JSON.parse(localStorage.getItem('rolePermission'));
                    let CSRF_TOKEN = $('meta[name="csrf-token"]').attr("content");
                    let authStatus = 'login';

                    $.ajax({
                        type: 'POST',
                        url: "/set-token",
                        data: { '_token': CSRF_TOKEN, "accessToken": results.access_token, "tokenType": results.token_type },
                        success: function (res) {
                        }
                    });


                    $.ajax({
                        type: 'post',
                        url: "/store-auth-user",
                        data: { authUser: authUserInfo, authStatus: authStatus, rolePermission: rolePermissionInfo, '_token': CSRF_TOKEN },
                        success: function (response) {
                            if (response.user.userRole == 'Trainee' || response.user.userRole == 'trainee') {
                                window.open("/profile", "_self");
                            } else {
                                window.open("/admins/dashboard", "_self");
                            }
                        }
                    });

                } else {
                    if (results.success === false && results.error === true) {
                        if (results.errorType == "validation") {
                            var errors = results.msg;
                            swal.fire("", errors);
                        }

                    }

                    if (results.error === true) {
                        if (results.message.username) {
                            $("#kt_sign_in_form .form-message-error-username")
                                .html(results.message.username[0])
                                .addClass("text-danger")
                                .fadeIn(5000);
                            setTimeout(() => {
                                $(
                                    "#kt_sign_in_form .form-message-error-username"
                                )
                                    .html("")
                                    .removeClass("text-danger")
                                    .fadeOut();
                                Logo;
                            }, 5000);
                        }
                        if (results.message.password) {
                            $("#kt_sign_in_form .form-message-error-password")
                                .html(results.message.password[0])
                                .addClass("text-danger")
                                .fadeIn(5000);
                            setTimeout(() => {
                                $(
                                    "#kt_sign_in_form .form-message-error-password"
                                )
                                    .html("")
                                    .removeClass("text-danger")
                                    .fadeOut();
                            }, 5000);
                        }
                    }
                }
            },
            error: function (response) {
                console.log(response);
                if (response.responseJSON.errorType == "Authentication") {
                    var errors = response.responseJSON.message;
                    swal.fire("", errors);
                    $("#kt_sign_in_form .form-message-error-error")
                        .html(response.responseJSON.message)
                        .addClass("text-danger")
                        .fadeIn(5000);
                }
                if (response.responseJSON.errorType == "notVerified") {
                    var errors = response.responseJSON.message;
                    swal.fire("", errors);
                    $("#kt_sign_in_form .form-message-error-error")
                        .html(response.responseJSON.message)
                        .addClass("text-danger")
                        .fadeIn(5000);
                }
            },
        });
    });

    // user logout api call
    $(document).on("click", ".logout", function (e) {
        e.preventDefault();

        Swal.fire({
            title: areYouSure,
            text: wantLogout,
            icon: "question",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: yesLogout,
            cancelButtonText: cancelLogout,
        }).then((result) => {
            if (result.isConfirmed) {
                let url_link = api_baseurl + "logout";
                $.ajax({
                    type: "get",
                    url: url_link,
                    headers: {
                        Authorization: localStorage.getItem("authToken"),
                        "X-localization": language,
                    },
                    data: {},
                    dataType: "JSON",
                    success: function (results) {
                        if (results.success === true) {
                            swal.fire("!", results.message);
                            localStorage.removeItem("authToken");
                            localStorage.removeItem("authUser");
                            localStorage.removeItem("rolePermission");
                            localStorage.removeItem("token");
                            let CSRF_TOKEN = $('meta[name="csrf-token"]').attr("content");
                            let authStatus = 'logout';
                            $.ajax({
                                type: 'post',
                                url: "/store-auth-user",
                                data: { authStatus: authStatus, '_token': CSRF_TOKEN },
                                success: function (response) {
                                    console.log(response);
                                }
                            });
                            window.open("/login", "_self");
                        } else {
                            swal.fire("Error!", results.message, "error");
                        }
                    },
                    error: function (response) {
                        // console.log(response);
                        alert(response.responseJSON.message);
                    },
                });
            }
        });
    });
});
