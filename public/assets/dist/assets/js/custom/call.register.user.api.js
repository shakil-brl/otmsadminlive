$(function () {
    // let authToken = authToken;
    let localUserAvatarUrl =
        api_assets_baseurl + "assets/dist/assets/media/svg/avatars/blank.svg";
    let userTbody = $("#user-tbody");
    let api_link = "";
    $(document).ready(function () {
        // load all users
        const link = api_baseurl + "users";
        $.ajax({
            type: "GET",
            url: link,
            headers: {
                Authorization: authToken,
            },
            success: function (results) {
                // Handle the successful response here
                // console.log(results.data);
                let allUserDetails = results.data;
                sessionStorage.removeItem("message");
                usersTableCreate(allUserDetails);
            },
            error: function (xhr, status, error) {
                // Handle errors here
                console.error(xhr, status, error);
            },
        });

        // search load data
        api_link = api_baseurl + "divisions";

        let divisionSelector = $("#targeted_search_form #division_search");
        let districtSelector = $("#targeted_search_form #district_search");
        let upazilaSelector = $("#targeted_search_form #upazila_search");
        populateOption(api_link, authToken, divisionSelector);

        // load districts based on division change
        divisionSelector.change(function () {
            let selectedParentId = divisionSelector.val();

            api_link = api_baseurl + "districts/" + selectedParentId;
            populateOption(api_link, authToken, districtSelector);
            upazilaSelector.html("<option value=''></option>");
        });

        // load upazilas based on district change
        districtSelector.change(function () {
            let selectedParentId = districtSelector.val();

            api_link = api_baseurl + "upazilas/" + selectedParentId;
            populateOption(api_link, authToken, upazilaSelector);
        });

        // clear search form
        const myForm = document.getElementById("targeted_search_form");
        const clearButton = document.getElementById("clear-search-form");
        // Add a click event listener to the clear button
        clearButton.addEventListener("click", function () {
            // Reset the form to clear all fields
            myForm.reset();
        });

        // reload page
        const reloadButton = document.getElementById("refresh-page");
        // Add a click event listener to the refresh button
        reloadButton.addEventListener("click", function () {
            location.reload();
        });

        // add register user form submit
        $("#targeted_search_form").submit(function (e) {
            e.preventDefault();

            if (e) {
                let fd = new FormData();
                let CSRF_TOKEN = $('meta[name="csrf-token"]').attr("content");
                api_link = api_baseurl + "users";

                // console.log(attached_image_url);
                let regId = $("#targeted_search_form [name=reg_id]").val();
                let name = $("#targeted_search_form [name=name]").val();
                let phone_number = $(
                    "#targeted_search_form [name=phone_number]"
                ).val();
                let email = $("#targeted_search_form [name=email]").val();

                let division_id = $(
                    "#targeted_search_form [name=division_id]"
                ).val();
                let district_id = $(
                    "#targeted_search_form [name=district_id]"
                ).val();
                let upazila_id = $(
                    "#targeted_search_form [name=upazila_id]"
                ).val();

                fd.append("reg_id", regId);
                fd.append("name", name);
                fd.append("phone_number", phone_number);
                fd.append("email", email);
                fd.append("division_id", division_id);
                fd.append("district_id", district_id);
                fd.append("upazila_id", upazila_id);

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
                            // console.log(results.data);
                            let allUserDetails = results.data;
                            $("#user-tbody").empty();
                            // $("#user-tbody").append(userTr);
                            usersTableCreate(allUserDetails);
                        }
                    },
                    error: function (response) {
                        console.log(response);
                    },
                });
            }
        });

        // draw users table function
        function usersTableCreate(allUserDetails) {
            // console.log(allUserDetails.length);
            if (allUserDetails.length > 0) {
                $.each(allUserDetails, function (index, userDetail) {
                    let userTr = `
                    <tr>
                        <td>
                            <div class="form-check form-check-sm form-check-custom form-check-solid">
                                <input class="form-check-input user-item" type="checkbox" name="select-user"
                                    value="" data-user-id="${
                                        userDetail.user.id
                                    }" />
                            </div>
                        </td>
                        <td class="d-flex align-items-center">
                            <!--begin:: Avatar -->
                            <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                <a href="">
                                    <div class="symbol-label">
                                            <img src="${
                                                userDetail.image_url
                                                    ? api_assets_baseurl +
                                                      "uploads/images/" +
                                                      userDetail.image_url
                                                    : localUserAvatarUrl
                                            }" alt="image" class="w-100" />
                                    </div>
                                </a>
                            </div>
                            <!--end::Avatar-->
                            <!--begin::User details-->
                            <div class="d-flex flex-column">
                                <a href="#" class="text-gray-800 text-hover-primary mb-1">
                                    ${
                                        userDetail.user.fname +
                                        " " +
                                        userDetail.user.lname
                                    }
                                </a>
                                <span></span>
                            </div>
                            <!--begin::User details-->
                        </td>
                        <td>
                            <div class="d-flex align-items-center py-2">
                                <span class="bullet bg-primary me-3"></span>
                                ${
                                    userDetail.district
                                        ? userDetail.district.name
                                        : ""
                                }
                            </div>                                    
                        </td>
                        <td>
                            ${userDetail.upazila ? userDetail.upazila.name : ""}
                        </td>
                        <td>
                            <div class="badge badge-light fw-bold">
                                ${
                                    userDetail.category
                                        ? userDetail.category.name
                                        : ""
                                }
                            </div>
                        </td>
                        <td>
                            ${
                                userDetail.sub_category
                                    ? userDetail.sub_category.name
                                    : ""
                            }
                        </td>
                        <td class="text-success text-center">
                        <div class="badge ${
                            userDetail.selection_status == "final"
                                ? "badge-light-success"
                                : userDetail.selection_status == "preliminary"
                                ? "badge-light-info"
                                : "badge-light-warning"
                        }  fw-bold">${
                        userDetail.selection_status.toUpperCase() ??
                        "REGISTERED"
                    }</div>
                        </td>
                        <td class="text-end">
                            <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 show-action"
                            data-user-id="${userDetail.user.id}">
                                <i class="ki-duotone ki-switch fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </a>
                            <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 edit-action"
                            data-user-id="${userDetail.user.id}">
                                <i class="ki-duotone ki-pencil fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </a>
                            <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm delete-action"
                            data-user-id="${userDetail.user.id}">
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

                    userTbody.append(userTr);
                });
            } else {
                let userTr = `
                        <tr>
                            <td colspan="5" class="w-100">No User Found</td>
                        </tr>
                    `;
                userTbody.append(userTr);
            }
        }

        // trainee selection
        let selectedUserIds = [];

        function setSelectedUserIds() {
            selectedUserIds = [];
            $(".user-item").each(function () {
                var userId = $(this).data("user-id");
                if (userId) {
                    selectedUserIds.push(userId);
                }
            });

            console.log(selectedUserIds);
        }

        function setSelectedUserId(userElement) {
            var userId = $(userElement).data("user-id");

            if (userId) {
                selectedUserIds.push(userId);
            }
            // console.log(selectedUserIds);
        }

        function removeSelectedUserId(userElement) {
            var userId = $(userElement).data("user-id");
            var index = selectedUserIds.indexOf(userId);
            if (index !== -1) {
                selectedUserIds.splice(index, 1);
            }
            // console.log(selectedUserIds);
        }

        // Add a click event handler to individual user checkboxes
        $(document).on("click", ".user-item", function () {
            if ($(this).is(":checked")) {
                setSelectedUserId(this);
            } else {
                removeSelectedUserId(this);
            }
        });

        // select users
        $('[name="all-users"]').on("click", function () {
            if ($(this).is(":checked")) {
                $.each($(".user-item"), function () {
                    $(this).prop("checked", true);
                });
                setSelectedUserIds();
            } else {
                $.each($(".user-item"), function () {
                    $(this).prop("checked", false);
                });
                selectedUserIds = [];
                // console.log(selectedUserIds);
            }
        });

        let preSelectButton = $("#preliminary-select-button");
        preSelectButton.click(function () {
            if (selectedUserIds.length == 0) {
                alert("No Trainee Selected! Select At Least One");
            } else {
                Swal.fire({
                    title: "Are you sure",
                    text: "Add selected Trainee as preliminary selected?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, Submit",
                }).then((result) => {
                    if (result.isConfirmed) {
                        // console.log(selectedUserIds);
                        api_link = api_baseurl + "users/preliminary/select";
                        $.ajax({
                            method: "POST",
                            url: api_link,
                            headers: {
                                Authorization: authToken,
                            },
                            data: JSON.stringify({
                                selectedUserIds: selectedUserIds,
                            }),
                            contentType: "application/json",
                            success: function (results) {
                                console.log(results);

                                if (results.success === true) {
                                    swal.fire(
                                        "Success:",
                                        "Preliminary Selected Successfully!"
                                    );
                                    // refresh page after 2 seconds
                                    setTimeout(function () {
                                        location.reload();
                                    }, 2000);
                                } else {
                                    if (results.error === true) {
                                        var errors = results.message;
                                        swal.fire("Error: ", errors);
                                    }
                                    // refresh page after 2 seconds
                                    setTimeout(function () {
                                        location.reload();
                                    }, 2000);
                                }
                            },
                            error: function (xhr, status, error) {
                                console.error(xhr, status, error);
                            },
                        });
                    }
                });
            }
        });
    });
});
