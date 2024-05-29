$(function () {
    // let authToken = authToken;
    let localUserAvatarUrl =
        api_assets_baseurl + "assets/dist/assets/media/svg/avatars/blank.svg";
    let rolesGroup = {
        project_office: [
            "superadmin",
            "pd",
            "dpd",
            "admin",
            "consultant",
            "dg",
            "minister",
            "secretary",
        ],
        division: ["divisional commissioner"],
        district: ["dc", "programmer"],
        upazila: ["uno", "assistant programmer"],
    };

    let userTbody = $("#user-tbody");
    $(document).ready(function () {
        const link = api_baseurl + "admins";
        $.ajax({
            type: "GET",
            url: link,
            headers: {
                Authorization: authToken,
            },
            success: function (results) {
                // Handle the successful response here
                // console.log(results.data);
                let allUser = results.data;
                sessionStorage.removeItem("message");
                if (allUser.length > 0) {
                    $.each(allUser, function (index, user) {
                        let userTr = `
                                <tr>
                                    <td>
                                        ${index + 1}.
                                    </td>
                                    <td>                                        
                                        ${user.ProfileId}
                                    </td>
                                    <td class="">
                                        <div class="d-flex flex-column gap-1">
                                            <div>
                                                ${user.profile.KnownAsBangla}
                                            </div>
                                            <div>${user.profile.Email}</div>
                                        </div>
                                    </td>
                                    <td class="">
                                        <div class="d-flex flex-column gap-1">
                                            <div class="">
                                                <span class="bullet bg-primary me-3"></span>
                                                ${user.role.name}
                                            </div>
                                            <div class="">
                                                ${
                                                    user.upazila ||
                                                    user.district ||
                                                    user.division
                                                        ? `(${
                                                              user.upazila
                                                                  ? user.upazila
                                                                        .NameEng +
                                                                    "-"
                                                                  : ""
                                                          } 
                                                    ${
                                                        user.district
                                                            ? user.district
                                                                  .NameEng + "-"
                                                            : ""
                                                    } 
                                                    ${
                                                        user.division
                                                            ? user.division
                                                                  .NameEng
                                                            : ""
                                                    })`
                                                        : `${
                                                              userRole.toLowerCase() !=
                                                              "provider"
                                                                  ? user.provider
                                                                      ? user
                                                                            .provider
                                                                            .name
                                                                      : "Project Office"
                                                                  : ""
                                                          }`
                                                }                                                                                                             
                                            </div>
                                        </div>                                        
                                    </td>
                                    <td class="">
                                        <div class="d-flex flex-column gap-1">
                                            <div>
                                                NID: ${user.profile.NID ?? ""}
                                            </div>
                                            <div>
                                                Phone: ${
                                                    user.profile.Phone ?? ""
                                                }
                                            </div>
                                        </div>                                        
                                    </td>                                    
                                    <td class="text-end">
                                        <div class="d-flex gap-1">
                                            <a href= "#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 view-user-action" 
                                            data-user-id="${user.ProfileId}">
                                                <i class="ki-duotone ki-switch fs-2">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </a>
                                            <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 edit-user-action" 
                                            data-user-id="${
                                                user.id
                                            }" data-bs-toggle="modal"
                                            data-bs-target="#kt_edit_user">
                                                <i class="ki-duotone ki-pencil fs-2">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </a>
                                            <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm delete-user-action" 
                                            data-user-name="${
                                                user.profile.KnownAsBangla
                                            }" data-user-id="${user.id}">
                                                <i class="ki-duotone ki-trash fs-2">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                    <span class="path3"></span>
                                                    <span class="path4"></span>
                                                    <span class="path5"></span>
                                                </i>
                                            </a>
                                        </div>                                        
                                    </td>
                                </tr>
                            `;

                        userTbody.append(userTr);
                    });
                    $("#dataTable").DataTable();
                } else {
                    userTbody.innerHTML = `
                            <tr>
                                <td class="w-100">No User Found</td>
                            </tr>                            
                        `;
                }
                let table = $("#kt-user-table").DataTable();
                $("#myInput").on("keyup", function () {
                    table.search(this.value).draw();
                });
            },
            error: function (xhr, status, error) {
                // Handle errors here
                console.error(xhr, status, error);
            },
        });

        $('[name="all-users"]').on("click", function () {
            if ($(this).is(":checked")) {
                $.each($(".user-item"), function () {
                    $(this).prop("checked", true);
                });
            } else {
                $.each($(".user-item"), function () {
                    $(this).prop("checked", false);
                });
            }
        });

        $("#open-create-user-modal").on("click", function () {
            let roleSelector = $("#kt_modal_add_admin_form #role_id");
            let role_api_link = api_baseurl + "role/get";
            let divisionSelector = $("#kt_modal_add_admin_form #division_id");
            let districtSelector = $("#kt_modal_add_admin_form #district_id");
            let upazilaSelector = $("#kt_modal_add_admin_form #upazila_id");
            // let authToken = authToken;
            let divisionSection = $(
                "#kt_modal_add_admin_form #division-section"
            );
            let districtSection = $(
                "#kt_modal_add_admin_form #district-section"
            );
            let upazilaSection = $("#kt_modal_add_admin_form #upazila-section");
            divisionSection.addClass("d-none");
            districtSection.addClass("d-none");
            upazilaSection.addClass("d-none");

            //console.log(roleSelector);
            populateRoleOptions(authToken, role_api_link, roleSelector);

            // load districts
            let optionFor = "Division";
            let district_api_link = api_baseurl + "divisions";

            populateLocationOption(
                optionFor,
                district_api_link,
                authToken,
                divisionSelector
            );

            // load districts on change division
            divisionSelector.change(function () {
                let division_id = divisionSelector.val();
                districtSelector.html("");
                upazilaSelector.html("");
                optionFor = "District";
                district_api_link = api_baseurl + "districts/" + division_id;

                populateLocationOption(
                    optionFor,
                    district_api_link,
                    authToken,
                    districtSelector
                );
            });

            // load upazila on district change
            districtSelector.change(function () {
                upazilaSelector.html("");
                optionFor = "Upazila";
                let district_id = districtSelector.val();
                let upazila_api_link = api_baseurl + "upazilas/" + district_id;
                populateLocationOption(
                    optionFor,
                    upazila_api_link,
                    authToken,
                    upazilaSelector
                );
                // console.log(district_id);
            });

            let selectRole = $("#kt_modal_add_admin_form #role_id");
            selectRole.on("change", function (e) {
                let selectedOptionText = selectRole.find(":selected").html();
                let foundGroupName = null; // Initialize a variable to store the found group, initially set to null

                // Iterate through each group in rolesGroup
                for (let groupName in rolesGroup) {
                    // Check if the user role exists in the current group's array (case-insensitive)
                    if (
                        rolesGroup[groupName].some(
                            (role) =>
                                role.toLowerCase() ===
                                selectedOptionText.toLowerCase()
                        )
                    ) {
                        foundGroupName = groupName;
                    }
                }
                $("#kt_modal_add_admin_form #provider").addClass("d-none");
                if (foundGroupName === "upazila") {
                    divisionSection.removeClass("d-none");
                    districtSection.removeClass("d-none");
                    upazilaSection.removeClass("d-none");
                } else if (foundGroupName === "district") {
                    divisionSection.removeClass("d-none");
                    districtSection.removeClass("d-none");

                    upazilaSection.addClass("d-none");
                    $('#kt_modal_add_admin_form [name="upazila_id"]')
                        .val("")
                        .trigger("change");
                } else if (foundGroupName === "division") {
                    divisionSection.removeClass("d-none");

                    districtSection.addClass("d-none");
                    upazilaSection.addClass("d-none");
                    $('#kt_modal_add_admin_form [name="district_id"]')
                        .val("")
                        .trigger("change");
                    $('#kt_modal_add_admin_form [name="upazila_id"]')
                        .val("")
                        .trigger("change");
                } else {
                    divisionSection.addClass("d-none");
                    districtSection.addClass("d-none");
                    upazilaSection.addClass("d-none");
                    $('#kt_modal_add_admin_form [name="division_id"]')
                        .val("")
                        .trigger("change");
                    $('#kt_modal_add_admin_form [name="district_id"]')
                        .val("")
                        .trigger("change");
                    $('#kt_modal_add_admin_form [name="upazila_id"]')
                        .val("")
                        .trigger("change");

                    if (
                        selectedOptionText == "Trainer" ||
                        selectedOptionText == "Provider" ||
                        selectedOptionText == "Coordinator"
                    ) {
                        if (userRole != "Provider") {
                            $("#kt_modal_add_admin_form #provider").removeClass(
                                "d-none"
                            );

                            let providerSelector = $(
                                "#kt_modal_add_admin_form #provider_id"
                            );
                            let api_link = api_baseurl + "providers";

                            populateProviderOptions(
                                authToken,
                                api_link,
                                providerSelector
                            );
                        } else {
                            $("#kt_modal_add_admin_form #provider").addClass(
                                "d-none"
                            );
                        }
                    }
                }
            });
        });

        // view admin user
        userTbody.on("click", ".view-user-action", function (e) {
            e.preventDefault();
            const userProfileId = $(this).data("user-id");

            const viewRoute = `admins/${userProfileId}/show`;
            // console.log(viewRoute);
            window.location.href = viewRoute;
        });

        // edit admin user form
        userTbody.on("click", ".edit-user-action", function (e) {
            e.preventDefault();

            const userId = $(this).data("user-id");
            // console.log(userId);
            let api_link = api_baseurl + "admins/" + userId + "/edit";

            $.ajax({
                type: "GET",
                url: api_link,
                headers: {
                    Authorization: authToken,
                },
                success: function (results) {
                    let userData = results.data;
                    // console.log(userData);
                    $('#kt_modal_update_admin_form [name="user_id"]').val(
                        userData.id ?? ""
                    );
                    $('#kt_modal_update_admin_form [name="email"]').val(
                        userData.profile.Email ?? ""
                    );
                    // $('#kt_modal_update_admin_form [name="address"]').val(
                    //     userData.profile.address ?? ""
                    // );

                    let roleSelector = $(
                        '#kt_modal_update_admin_form [name="role_id"]'
                    );
                    if (userData.role_id) {
                        let role_api_link = api_baseurl + "role/get";
                        // let authToken = authToken;
                        let selectedOptionId = userData.role_id;

                        populateRoleOptions(
                            authToken,
                            role_api_link,
                            roleSelector,
                            selectedOptionId
                        );

                        // console.log(userData.role.name);
                        let divisionSection = $(
                            "#kt_modal_update_admin_form #division-section"
                        );
                        let districtSection = $(
                            "#kt_modal_update_admin_form #district-section"
                        );
                        let upazilaSection = $(
                            "#kt_modal_update_admin_form #upazila-section"
                        );
                        let selectedOptionText = userData.role.name;
                        let foundGroupName = null; // Initialize a variable to store the found group, initially set to null

                        // Iterate through each group in rolesGroup
                        for (let groupName in rolesGroup) {
                            // Check if the user role exists in the current group's array (case-insensitive)
                            if (
                                rolesGroup[groupName].some(
                                    (role) =>
                                        role.toLowerCase() ===
                                        selectedOptionText.toLowerCase()
                                )
                            ) {
                                foundGroupName = groupName;
                            }
                        }
                        $("#kt_modal_update_admin_form #provider").addClass(
                            "d-none"
                        );
                        if (foundGroupName === "upazila") {
                            divisionSection.removeClass("d-none");
                            districtSection.removeClass("d-none");
                            upazilaSection.removeClass("d-none");
                        } else if (foundGroupName === "district") {
                            divisionSection.removeClass("d-none");
                            districtSection.removeClass("d-none");

                            upazilaSection.addClass("d-none");
                            $('#kt_modal_update_admin_form [name="upazila_id"]')
                                .val("")
                                .trigger("change");
                        } else if (foundGroupName === "division") {
                            divisionSection.removeClass("d-none");

                            districtSection.addClass("d-none");
                            upazilaSection.addClass("d-none");
                            $(
                                '#kt_modal_update_admin_form [name="district_id"]'
                            )
                                .val("")
                                .trigger("change");
                            $('#kt_modal_update_admin_form [name="upazila_id"]')
                                .val("")
                                .trigger("change");
                        } else {
                            divisionSection.addClass("d-none");
                            districtSection.addClass("d-none");
                            upazilaSection.addClass("d-none");
                            $(
                                '#kt_modal_update_admin_form [name="division_id"]'
                            )
                                .val("")
                                .trigger("change");
                            $(
                                '#kt_modal_update_admin_form [name="district_id"]'
                            )
                                .val("")
                                .trigger("change");
                            $('#kt_modal_update_admin_form [name="upazila_id"]')
                                .val("")
                                .trigger("change");
                            if (
                                userData.role.name == "Trainer" ||
                                userData.role.name == "Coordinator" ||
                                userData.role.name == "Provider"
                            ) {
                                if (userData.provider) {
                                    if (userRole != "Provider") {
                                        $(
                                            "#kt_modal_update_admin_form #provider"
                                        ).removeClass("d-none");

                                        let providerSelector = $(
                                            '#kt_modal_update_admin_form [name="provider_id"]'
                                        );
                                        let api_link =
                                            api_baseurl + "providers";
                                        if (userData.provider_id) {
                                            // console.log(0);
                                            selectProviderId =
                                                userData.provider_id;
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
                                }
                            } else {
                            }
                        }
                    } else {
                        let role_api_link = api_baseurl + "role/get";
                        // let authToken = authToken;

                        populateRoleOptions(
                            authToken,
                            role_api_link,
                            roleSelector
                        );
                    }

                    let selectRole = $("#kt_modal_update_admin_form #role_id");
                    selectRole.on("change", function (e) {
                        $("#kt_modal_update_admin_form [name=provider_id]").val(
                            ""
                        );
                        let divisionSection = $(
                            "#kt_modal_update_admin_form #division-section"
                        );
                        let districtSection = $(
                            "#kt_modal_update_admin_form #district-section"
                        );
                        let upazilaSection = $(
                            "#kt_modal_update_admin_form #upazila-section"
                        );

                        let selectedOptionText = selectRole
                            .find(":selected")
                            .html();
                        let foundGroupName = null; // Initialize a variable to store the found group, initially set to null

                        // Iterate through each group in rolesGroup
                        for (let groupName in rolesGroup) {
                            // Check if the user role exists in the current group's array (case-insensitive)
                            if (
                                rolesGroup[groupName].some(
                                    (role) =>
                                        role.toLowerCase() ===
                                        selectedOptionText.toLowerCase()
                                )
                            ) {
                                foundGroupName = groupName;
                            }
                        }

                        $("#kt_modal_update_admin_form #provider").addClass(
                            "d-none"
                        );
                        if (foundGroupName === "upazila") {
                            divisionSection.removeClass("d-none");
                            districtSection.removeClass("d-none");
                            upazilaSection.removeClass("d-none");
                        } else if (foundGroupName === "district") {
                            divisionSection.removeClass("d-none");
                            districtSection.removeClass("d-none");

                            upazilaSection.addClass("d-none");
                            $('#kt_modal_update_admin_form [name="upazila_id"]')
                                .val("")
                                .trigger("change");
                        } else if (foundGroupName === "division") {
                            divisionSection.removeClass("d-none");

                            districtSection.addClass("d-none");
                            $(
                                '#kt_modal_update_admin_form [name="district_id"]'
                            )
                                .val("")
                                .trigger("change");
                            upazilaSection.addClass("d-none");
                            $('#kt_modal_update_admin_form [name="upazila_id"]')
                                .val("")
                                .trigger("change");
                        } else {
                            divisionSection.addClass("d-none");
                            districtSection.addClass("d-none");
                            upazilaSection.addClass("d-none");
                            $(
                                '#kt_modal_update_admin_form [name="division_id"]'
                            )
                                .val("")
                                .trigger("change");
                            $(
                                '#kt_modal_update_admin_form [name="district_id"]'
                            )
                                .val("")
                                .trigger("change");
                            $('#kt_modal_update_admin_form [name="upazila_id"]')
                                .val("")
                                .trigger("change");
                            if (
                                selectedOptionText == "Trainer" ||
                                selectedOptionText == "Provider" ||
                                selectedOptionText == "Coordinator"
                            ) {
                                if (userRole != "Provider") {
                                    $(
                                        "#kt_modal_update_admin_form #provider"
                                    ).removeClass("d-none");

                                    let providerSelector = $(
                                        "#kt_modal_update_admin_form [name=provider_id]"
                                    );
                                    let api_link = api_baseurl + "providers";

                                    populateProviderOptions(
                                        authToken,
                                        api_link,
                                        providerSelector
                                    );
                                } else {
                                    $(
                                        "#kt_modal_update_admin_form #provider"
                                    ).addClass("d-none");
                                }
                            }
                        }
                    });

                    // load division
                    optionFor = "Division";
                    let division_api_link = api_baseurl + "divisions";
                    let divisionSelector = $(
                        '#kt_modal_update_admin_form [name="division_id"]'
                    );
                    if (userData && userData.division_id) {
                        let selectedDivisionId = userData.division_id;
                        populateLocationOption(
                            optionFor,
                            division_api_link,
                            authToken,
                            divisionSelector,
                            selectedDivisionId
                        );
                    } else {
                        populateLocationOption(
                            optionFor,
                            division_api_link,
                            authToken,
                            divisionSelector
                        );
                    }

                    // load districts
                    optionFor = "District";
                    let district_api_link = api_baseurl + "districts";
                    if (userData && userData.division_id) {
                        district_api_link =
                            api_baseurl + "districts/" + userData.division_id;
                    }

                    let districtSelector = $(
                        '#kt_modal_update_admin_form [name="district_id"]'
                    );
                    if (userData && userData.district_id) {
                        let selectedDistrictId = userData.district_id;
                        populateLocationOption(
                            optionFor,
                            district_api_link,
                            authToken,
                            districtSelector,
                            selectedDistrictId
                        );
                    } else {
                        populateLocationOption(
                            optionFor,
                            district_api_link,
                            authToken,
                            districtSelector
                        );
                    }

                    let selectedDistrictId = userData.district_id;
                    let upazilaSelector = $(
                        '#kt_modal_update_admin_form [name="upazila_id"]'
                    );
                    if (userData && selectedDistrictId) {
                        optionFor = "Upazila";
                        let upazila_api_link =
                            api_baseurl + "upazilas/" + selectedDistrictId;

                        let selectedUpazilaId = userData.upazila_id;

                        if (selectedUpazilaId) {
                            populateLocationOption(
                                optionFor,
                                upazila_api_link,
                                authToken,
                                upazilaSelector,
                                selectedUpazilaId
                            );
                        } else {
                            populateLocationOption(
                                optionFor,
                                upazila_api_link,
                                authToken,
                                upazilaSelector
                            );
                        }
                    }

                    // load districts on change division
                    divisionSelector.change(function () {
                        let division_id = divisionSelector.val();
                        districtSelector.html("");
                        upazilaSelector.html("");
                        optionFor = "District";
                        district_api_link =
                            api_baseurl + "districts/" + division_id;

                        populateLocationOption(
                            optionFor,
                            district_api_link,
                            authToken,
                            districtSelector
                        );
                    });
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

                        populateLocationOption(
                            optionFor,
                            upazila_api_link,
                            authToken,
                            upazilaSelector
                        );
                    });
                },
                error: function (response) {
                    console.log(response);
                },
            });
        });

        // delete admin user
        userTbody.on("click", ".delete-user-action", function (e) {
            e.preventDefault();
            const userId = $(this).data("user-id");
            let userName = $(this).data("user-name");
            let api_link = api_baseurl + "admins/" + userId + "/delete";

            Swal.fire({
                title: "Are you sure? ",
                text: "'" + userName + "'" + " Delete This Data?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!",
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "GET",
                        url: api_link,
                        headers: {
                            Authorization: authToken,
                        },
                        success: function (results) {
                            if (results.success === true) {
                                swal.fire("Deleted!", results.message);
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
                            console.log(response);
                        },
                    });
                }
            });
        });

        /**
         *
         * Functions
         *
         */

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

    // add admin user form submit
    $("#kt_modal_add_admin_form").submit(function (e) {
        e.preventDefault();

        Swal.fire({
            title: "Are you sure?",
            text: "Do you want to submit this form?",
            icon: "info",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, Submit",
        }).then((result) => {
            if (result.isConfirmed) {
                let fd = new FormData();
                let CSRF_TOKEN = $('meta[name="csrf-token"]').attr("content");
                let api_link = api_baseurl + "admins/create";

                // console.log(attached_image_url);
                let email = $("#kt_modal_add_admin_form [name=email]").val();
                let role_id = $(
                    "#kt_modal_add_admin_form [name=role_id]"
                ).val();
                let provider_id =
                    $("#kt_modal_add_admin_form [name=provider_id]").val() ??
                    "";
                let division_id =
                    $("#kt_modal_add_admin_form [name=division_id]").val() ??
                    "";
                let district_id =
                    $("#kt_modal_add_admin_form [name=district_id]").val() ??
                    "";
                let upazila_id =
                    $("#kt_modal_add_admin_form [name=upazila_id]").val() ?? "";
                // let address = $(
                //     "#kt_modal_add_admin_form [name=address]"
                // ).val();

                fd.append("email", email);
                fd.append("role_id", role_id);
                fd.append("provider_id", provider_id);
                fd.append("division_id", division_id);
                fd.append("district_id", district_id);
                fd.append("upazila_id", upazila_id);
                // fd.append("address", address);

                fd.append("_token", CSRF_TOKEN);
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
                            swal.fire("Successfully added!", results.data);
                            // refresh page after 2 seconds
                            setTimeout(function () {
                                location.reload();
                            }, 2000);
                        } else {
                            if (results.error === true) {
                                var errors = "Validation Error Occurs!!";
                                if (results.type == "exits") {
                                    swal.fire("", results.message);
                                } else {
                                    swal.fire("", errors);

                                    // function display error message
                                    function displayErrorMessage(
                                        fieldName,
                                        errorMessage
                                    ) {
                                        const errorMessageSelector = `#kt_modal_add_admin_form .form-message-error-${fieldName}`;
                                        $(errorMessageSelector)
                                            .html(errorMessage)
                                            .addClass("text-danger")
                                            .fadeIn(2000);
                                        setTimeout(() => {
                                            $(errorMessageSelector)
                                                .html("")
                                                .removeClass("text-danger")
                                                .fadeOut();
                                        }, 5000);
                                    }

                                    // Define an array of field names you want to handle
                                    const fieldsToHandle = [
                                        "email",
                                        "role_id",
                                        "provider_id",
                                        "division_id",
                                        "district_id",
                                        "upazila_id",
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
                        }
                    },
                    error: function (response) {
                        console.log(response);
                    },
                });
            }
        });
    });

    // update admin user form submit
    $("#kt_modal_update_admin_form").submit(function (e) {
        e.preventDefault();

        Swal.fire({
            title: "Are you sure?",
            text: "Do you want to submit the form?",
            icon: "info",
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

                let email = $("#kt_modal_update_admin_form [name=email]").val();

                let role_id = $(
                    "#kt_modal_update_admin_form [name=role_id]"
                ).val();
                let provider_id =
                    $("#kt_modal_update_admin_form [name=provider_id]").val() ??
                    "";
                let division_id =
                    $("#kt_modal_update_admin_form [name=division_id]").val() ??
                    "";
                let district_id =
                    $("#kt_modal_update_admin_form [name=district_id]").val() ??
                    "";
                let upazila_id =
                    $("#kt_modal_update_admin_form [name=upazila_id]").val() ??
                    "";

                fd.append("email", email);
                fd.append("role_id", role_id);
                fd.append("provider_id", provider_id);
                fd.append("division_id", division_id);
                fd.append("district_id", district_id);
                fd.append("upazila_id", upazila_id);

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
                                    "email",
                                    "role_id",
                                    "provider_id",
                                    "division_id",
                                    "district_id",
                                    "upazila_id",
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
