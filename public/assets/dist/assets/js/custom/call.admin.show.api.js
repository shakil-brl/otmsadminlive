$(function () {
    if (typeof accessToken !== "undefined") {
        // Use the access token in your JavaScript code
        console.log("Access Token:", accessToken);
    } else {
        console.error("Access Token is not defined.");
    }
    // alert();

    // let authToken = authToken;
    let localUserAvatar =
        api_assets_baseurl + "assets/dist/assets/media/svg/avatars/blank.svg";
    $(document).ready(function () {
        const link = api_baseurl + "admins/admin/" + profileId;
        // console.log(link);
        $.ajax({
            method: "GET",
            url: link,
            headers: {
                Authorization: authToken,
            },
            success: function (results) {
                let data = results.data;
                console.log(results.data);

                let fullName = data.profile.KnownAs ?? "";
                let regId = data.ProfileId ?? "";
                let email = data.profile.Email ?? "";
                let roleName = data.role.name ?? "";
                let phoneNumber = data.profile.Phone ?? "";
                let userImage = localUserAvatar;
                let gender = data.profile.Gender ?? "";
                let address = data.profile.address ?? "";
                let districtName = data.profile.district_code ?? "";
                let upazilaName = data.profile.upazila_id ?? "";
                let providerName = data.provider ?? "";

                $("#user-avatar").attr("src", userImage);
                $("#user-name").html(fullName);
                $("#user-role").html(roleName);
                $("#user-regId").html(regId);
                $("#user-email").attr("href", "mailto:" + email);
                $("#user-email").html(email);
                $("#user-phone").html(phoneNumber);
                $("#user-email-signin").html(email);

                let userDetailsHtml = `
                                        <!--begin::Table wrapper-->
                                        <div class="table-responsive">
                                            <!--begin::Table-->
                                            <table class="table align-middle table-row-dashed gy-5"
                                                id="kt_table_users_login_session">
                                                <tbody class="fs-6 fw-semibold text-gray-600">
                                                    <tr>
                                                        <td>First Name</td>
                                                        <td>${fullName}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Email</td>
                                                        <td>${email}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Role</td>
                                                        <td>${roleName}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Gender</td>
                                                        <td>${gender}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>District</td>
                                                        <td>${districtName}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Upazila</td>
                                                        <td>${upazilaName}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Provider</td>
                                                        <td>${providerName}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Address</td>
                                                        <td>${address}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <!--end::Table-->
                                        </div>
                                        <!--end::Table wrapper-->
                                    `;
                $("#overview-tab-body").append(userDetailsHtml);
            },
            error: function (xhr, status, error) {
                // Handle errors here
                console.error(xhr, status, error);
            },
        });

        $("#edit-user-action").click(function () {
            let api_link = api_baseurl + "admins/" + uId + "/edit";

            $.ajax({
                type: "GET",
                url: api_link,
                headers: {
                    Authorization: authToken,
                },
                success: function (results) {
                    let userData = results.data;
                    console.log(userData);
                    $('#kt_modal_update_admin_form [name="user_id"]').val(
                        userData.id ?? ""
                    );
                    $("#kt_modal_update_admin_form #update-user-image").css(
                        "background-image",
                        "url(" +
                            (userData.user_type.image_url
                                ? api_assets_baseurl +
                                  "uploads/admin/images/" +
                                  userData.user_type.image_url
                                : localUserAvatarUrl) +
                            ")"
                    );
                    $('#kt_modal_update_admin_form [name="fname"]').val(
                        userData.fname ?? ""
                    );
                    $('#kt_modal_update_admin_form [name="lname"]').val(
                        userData.lname ?? ""
                    );
                    $('#kt_modal_update_admin_form [name="email"]').val(
                        userData.email ?? ""
                    );
                    // $('#kt_modal_update_admin_form [name="username"]').val(
                    //     userData.username ?? ""
                    // );
                    $('#kt_modal_update_admin_form [name="phone_number"]').val(
                        userData.phone_number ?? ""
                    );
                    $('#kt_modal_update_admin_form [name="name"]').val(
                        userData.user_type.name ?? ""
                    );
                    $('#kt_modal_update_admin_form [name="designation"]').val(
                        userData.user_type.designation ?? ""
                    );
                    $('#kt_modal_update_admin_form [name="address"]').val(
                        userData.user_type.address ?? ""
                    );

                    let roleSelector = $(
                        '#kt_modal_update_admin_form [name="role_id"]'
                    );
                    if (userData.role_id) {
                        let role_api_link = api_baseurl + "role";
                        // let authToken = authToken;
                        let selectedOptionId = userData.role_id;

                        populateRoleOptions(
                            authToken,
                            role_api_link,
                            roleSelector,
                            selectedOptionId
                        );

                        if (userData.role_id == 9 || userData.role_id == 11) {
                            $(
                                "#kt_modal_update_admin_form #provider-row"
                            ).removeClass("d-none");

                            let providerSelector = $(
                                '#kt_modal_update_admin_form [name="provider_id"]'
                            );
                            let api_link = api_baseurl + "providers";
                            if (userData.user_type.provider_id) {
                                // console.log(0);
                                selectProviderId =
                                    userData.user_type.provider_id;
                                populateProviderOptions(
                                    authToken,
                                    api_link,
                                    providerSelector,
                                    selectProviderId
                                );
                            } else {
                                populateProviderOptions(
                                    authToken,
                                    api_link,
                                    providerSelector
                                );
                            }
                        } else {
                            $(
                                "#kt_modal_update_admin_form #provider-row"
                            ).addClass("d-none");
                        }
                    } else {
                        let role_api_link = api_baseurl + "role";
                        // let authToken = authToken;

                        populateRoleOptions(
                            authToken,
                            role_api_link,
                            roleSelector
                        );
                    }

                    roleSelector.on("change", function (e) {
                        let selectedOptionText = roleSelector
                            .find(":selected")
                            .html();
                        if (
                            selectedOptionText == "Trainer" ||
                            selectedOptionText == "Provider"
                        ) {
                            $(
                                "#kt_modal_update_admin_form #provider-row"
                            ).removeClass("d-none");

                            let providerSelector = $(
                                '#kt_modal_update_admin_form [name="provider_id"]'
                            );
                            let api_link = api_baseurl + "providers";

                            populateProviderOptions(
                                authToken,
                                api_link,
                                providerSelector
                            );
                        } else {
                            $(
                                "#kt_modal_update_admin_form #provider-row"
                            ).addClass("d-none");
                        }
                    });

                    // load districts
                    let district_api_link = api_baseurl + "districts";
                    let districtSelector = $(
                        '#kt_modal_update_admin_form [name="district_id"]'
                    );
                    if (userData.user_type && userData.user_type.district_id) {
                        let selectedDistrictId = userData.user_type.district_id;

                        populateDistrictOption(
                            district_api_link,
                            authToken,
                            districtSelector,
                            selectedDistrictId
                        );
                    } else {
                        populateDistrictOption(
                            district_api_link,
                            authToken,
                            districtSelector
                        );
                    }

                    let selectedDistrictId = userData.user_type.district_id;
                    if (userData.user_type && selectedDistrictId) {
                        let upazila_api_link =
                            api_baseurl + "upazilas/" + selectedDistrictId;
                        let upazilaSelector = $(
                            '#kt_modal_update_admin_form [name="upazila_id"]'
                        );
                        let selectedUpazilaId = userData.user_type.upazila_id;

                        if (selectedUpazilaId) {
                            populateUpazilaSelect(
                                upazila_api_link,
                                authToken,
                                upazilaSelector,
                                selectedUpazilaId
                            );
                        } else {
                            populateUpazilaSelect(
                                upazila_api_link,
                                authToken,
                                upazilaSelector
                            );
                        }
                    }

                    // load upazila on district change
                    let selectDistrictElement = $(
                        '#kt_modal_update_admin_form [name="district_id"]'
                    );
                    selectDistrictElement.change(function () {
                        let district_id = selectDistrictElement.val();
                        upazila_api_link =
                            api_baseurl + "upazilas/" + district_id;

                        upazilaSelector = $(
                            '#kt_modal_update_admin_form [name="upazila_id"]'
                        );

                        populateUpazilaSelect(
                            upazila_api_link,
                            authToken,
                            upazilaSelector
                        );
                    });

                    let userTypeGender = userData.user_type.gender ?? "";
                    let gender = $(
                        '#kt_modal_update_admin_form [name="gender"][value="' +
                            userTypeGender +
                            '"]'
                    );
                    gender.prop("checked", true);
                },
                error: function (response) {
                    console.log(response);
                },
            });
        });

        // function for district
        function populateDistrictOption(
            api_link,
            authToken,
            districtSelector,
            selectedDistrictId = null
        ) {
            let htmlDistrict = "<option value=''></option>";
            $.ajax({
                type: "get",
                url: api_link,
                headers: {
                    Authorization: authToken,
                },
                data: {},
                dataType: "JSON",
                success: function (results) {
                    let districts = results.data;
                    // console.log(districts);

                    if (districts) {
                        if (selectedDistrictId !== null) {
                            $.each(districts, function (index, district) {
                                if (district.id == selectedDistrictId) {
                                    htmlDistrict +=
                                        '<option value="' +
                                        district.id +
                                        '" selected>' +
                                        district.name +
                                        "</option>";
                                } else {
                                    htmlDistrict +=
                                        '<option value="' +
                                        district.id +
                                        '">' +
                                        district.name +
                                        "</option>";
                                }
                            });
                        } else {
                            $.each(districts, function (index, district) {
                                htmlDistrict +=
                                    '<option value="' +
                                    district.id +
                                    '">' +
                                    district.name +
                                    "</option>";
                            });
                        }
                    }

                    districtSelector.html(htmlDistrict);
                },
                error: function (response) {
                    console.log(response);
                },
            });
        }

        // function for load upazila
        function populateUpazilaSelect(
            apiLink,
            authToken,
            upazilaSelector,
            selectedUpazilaId
        ) {
            let htmlUpazila = "<option value=''></option>";

            $.ajax({
                type: "get",
                url: apiLink,
                headers: {
                    Authorization: authToken,
                },
                data: {},
                dataType: "JSON",
                success: function (results) {
                    let upazilas = results.data;
                    // console.log(upazilas);

                    if (upazilas) {
                        if (selectedUpazilaId !== null) {
                            $.each(upazilas, function (index, upazila) {
                                if (upazila.id == selectedUpazilaId) {
                                    htmlUpazila +=
                                        '<option value="' +
                                        upazila.id +
                                        '" selected>' +
                                        upazila.name +
                                        "</option>";
                                } else {
                                    htmlUpazila +=
                                        '<option value="' +
                                        upazila.id +
                                        '">' +
                                        upazila.name +
                                        "</option>";
                                }
                            });
                        } else {
                            $.each(upazilas, function (index, upazila) {
                                htmlUpazila +=
                                    '<option value="' +
                                    upazila.id +
                                    '">' +
                                    upazila.name +
                                    "</option>";
                            });
                        }
                    }

                    upazilaSelector.html(htmlUpazila);
                },
                error: function (response) {
                    console.log(response);
                },
            });
        }

        // function for load Role
        function populateRoleOptions(
            authToken,
            role_api_link,
            roleSelector,
            selectedOptionId = null
        ) {
            const api_link = role_api_link;
            let htmlRole = "<option value=''></option>";
            $.ajax({
                type: "get",
                url: api_link,
                headers: {
                    Authorization: authToken,
                },
                data: {},
                dataType: "JSON",
                success: function (results) {
                    let roles = results.data;
                    // console.log(roles);
                    if (roles) {
                        if (selectedOptionId !== null) {
                            $.each(roles, function (index, role) {
                                if (role.id == selectedOptionId) {
                                    htmlRole +=
                                        '<option value="' +
                                        role.id +
                                        '" selected>' +
                                        role.name +
                                        "</option>";
                                } else {
                                    htmlRole +=
                                        '<option value="' +
                                        role.id +
                                        '">' +
                                        role.name +
                                        "</option>";
                                }
                            });
                        } else {
                            $.each(roles, function (index, role) {
                                htmlRole +=
                                    '<option value="' +
                                    role.id +
                                    '">' +
                                    role.name +
                                    "</option>";
                            });
                        }
                    }

                    roleSelector.html(htmlRole);
                },
                error: function (response) {
                    console.log(response);
                },
            });
        }

        // function for providers
        function populateProviderOptions(
            authToken,
            api_link,
            providerSelector,
            selectProviderId = null
        ) {
            let htmlProvider = "<option value=''></option>";

            $.ajax({
                type: "get",
                url: api_link,
                headers: {
                    Authorization: authToken,
                },
                data: {},
                dataType: "JSON",
                success: function (results) {
                    let providers = results.data;
                    // console.log(providers);
                    if (providers) {
                        if (selectProviderId !== null) {
                            $.each(providers, function (index, provider) {
                                if (provider.id == selectProviderId) {
                                    htmlProvider +=
                                        '<option value="' +
                                        provider.id +
                                        '" selected>' +
                                        provider.name +
                                        "</option>";
                                } else {
                                    htmlProvider +=
                                        '<option value="' +
                                        provider.id +
                                        '">' +
                                        provider.name +
                                        "</option>";
                                }
                            });
                        } else {
                            $.each(providers, function (index, provider) {
                                htmlProvider +=
                                    '<option value="' +
                                    provider.id +
                                    '">' +
                                    provider.name +
                                    "</option>";
                            });
                        }
                    }

                    providerSelector.html(htmlProvider);
                },
                error: function (response) {
                    console.log(response);
                },
            });
        }
    });

    // update admin user form submit
    $("#kt_modal_update_admin_form").submit(function (e) {
        e.preventDefault();

        Swal.fire({
            title: "Are you sure",
            text: "You want to submit the form?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, Submit",
        }).then((result) => {
            if (result.isConfirmed) {
                let fd = new FormData();
                let CSRF_TOKEN = $('meta[name="csrf-token"]').attr("content");
                const adminUserId = $(
                    "#kt_modal_update_admin_form [name=user_id]"
                ).val();
                let api_link =
                    api_baseurl + "admins/" + adminUserId + "/update";

                let image_url = document.getElementById("update_photo_url");
                let attached_image_url = image_url.files[0];

                // console.log(attached_image_url);
                let fname = $("#kt_modal_update_admin_form [name=fname]").val();
                let lname = $("#kt_modal_update_admin_form [name=lname]").val();
                let email = $("#kt_modal_update_admin_form [name=email]").val();
                // let username = $(
                //     "#kt_modal_update_admin_form [name=username]"
                // ).val();
                let phone_number = $(
                    "#kt_modal_update_admin_form [name=phone_number]"
                ).val();
                let role_id = $(
                    "#kt_modal_update_admin_form [name=role_id]"
                ).val();
                let provider_id =
                    $("#kt_modal_update_admin_form [name=provider_id]").val() ??
                    "";
                let name = $("#kt_modal_update_admin_form [name=name]").val();
                let designation = $(
                    "#kt_modal_update_admin_form [name=designation]"
                ).val();
                let gender = $(
                    "#kt_modal_update_admin_form [name=gender]"
                ).val();
                let district_id = $(
                    "#kt_modal_update_admin_form [name=district_id]"
                ).val();
                let upazila_id =
                    $("#kt_modal_update_admin_form [name=upazila_id]").val() ??
                    "";
                let address = $(
                    "#kt_modal_update_admin_form [name=address]"
                ).val();

                if (attached_image_url != undefined) {
                    fd.append("image_url", attached_image_url);
                }

                fd.append("fname", fname);
                fd.append("lname", lname);
                fd.append("email", email);
                // fd.append("username", username);
                fd.append("phone_number", phone_number);
                fd.append("role_id", role_id);
                fd.append("provider_id", provider_id);
                fd.append("name", name);
                fd.append("designation", designation);
                fd.append("gender", gender);
                fd.append("district_id", district_id);
                fd.append("upazila_id", upazila_id);
                fd.append("address", address);

                fd.append("_token", CSRF_TOKEN);
                fd.append("_method", "patch");
                // console.log(fd);
                $.ajax({
                    type: "post",
                    url: api_link,
                    data: fd,
                    dataType: "JSON",
                    cache: false,
                    contentType: false,
                    processData: false,
                    headers: {
                        Authorization: authToken,
                    },
                    success: function (results) {
                        if (results.success === true) {
                            swal.fire("Successfully updated!", results.data);
                            // refresh page after 2 seconds
                            setTimeout(function () {
                                location.reload();
                            }, 2000);
                        } else {
                            if (results.error === true) {
                                var errors = "Validation Error Occurs!!";
                                swal.fire("", errors);

                                // function display error message
                                function displayErrorMessage(
                                    fieldName,
                                    errorMessage
                                ) {
                                    const errorMessageSelector = `#kt_modal_update_admin_form .form-message-error-${fieldName}`;
                                    $(errorMessageSelector)
                                        .html(errorMessage)
                                        .addClass("text-danger")
                                        .fadeIn(5000);
                                    setTimeout(() => {
                                        $(errorMessageSelector)
                                            .html("")
                                            .removeClass("text-danger")
                                            .fadeOut();
                                    }, 50000);
                                }

                                // Define an array of field names you want to handle
                                const fieldsToHandle = [
                                    "image_url",
                                    "fname",
                                    "lname",
                                    "email",
                                    "username",
                                    "phone_number",
                                    "role_id",
                                    "provider_id",
                                    "name",
                                    "designation",
                                    "gender",
                                    "district_id",
                                    "upazila_id",
                                    "address",
                                ];

                                // Usage example for multiple fields
                                fieldsToHandle.forEach((fieldName) => {
                                    if (results.message[fieldName]) {
                                        displayErrorMessage(
                                            fieldName,
                                            results.message[fieldName][0]
                                        );
                                    }
                                });
                            }
                        }
                    },
                    error: function (response) {
                        console.log(response);
                    },
                });
            }
        });
    });
});
