$(function () {
    // profile data get api call
    let authToken = localStorage.getItem("authToken");
    let link = api_baseurl + "profile";
    $.ajax({
        type: "get",
        url: link,
        headers: {
            Authorization: localStorage.getItem("authToken"),
        },
        data: {},
        dataType: "JSON",
        success: function (results) {
            // console.log(results);
            const userInfo = results.data.userInfo[0];
            const userDetails = results.data.userDetails;
            const userLog = results.data.userLog;
            const localUserAvatarUrl =
                api_assets_baseurl +
                "assets/dist/assets/media/svg/avatars/blank.svg";

            const profileImage = document.querySelector("#profile-image");
            const profileName = document.querySelector("#user-name");
            const roleName = document.querySelector("#role-name");

            // use avatar
            profileImage.setAttribute("src", localUserAvatarUrl);

            if (userInfo !== null) {
                let userFullName = userInfo.fname + " " + userInfo.lname;
                profileName.textContent = userFullName;
                roleName.textContent = userInfo.role.name;
                document.querySelector("#reg-id").textContent = userInfo.reg_id;
                document.querySelector("#user-full-name").textContent =
                    userFullName;
                document.querySelector("#username").textContent =
                    userInfo.username;
                document.querySelector("#email").textContent = userInfo.email;
                $("#user_profile_update_form [name=fname]").val(userInfo.fname);
                $("#user_profile_update_form [name=lname]").val(userInfo.lname);
                $("#user_profile_update_form [name=phone_number]").val(
                    userInfo.phone_number
                );
            }

            if (userDetails !== null) {
                let userDetailsGender = userDetails.gender;
                let userPastTraining = userDetails.past_training ?? "";
                let profileImageUrl =
                    api_assets_baseurl +
                    "uploads/images/" +
                    (userDetails.image_url ?? "assets/avatars/blank.svg");

                if (userDetails.hsc_certificate) {
                    $("#existing-hsc a").html(userDetails.hsc_certificate);
                }
                if (userDetails.ssc_certificate) {
                    $("#existing-ssc a").html(userDetails.ssc_certificate);
                }
                if (userDetails.signature) {
                    $("#existing-signature a").html(userDetails.signature);
                }

                // console.log(profileImageUrl);
                profileImage.setAttribute("src", profileImageUrl);
                let gender = $(
                    "#user_profile_update_form [name=gender][value =" +
                        userDetailsGender +
                        "]"
                );
                gender.prop("checked", true);
                $("#user_profile_update_form [name=father_name]").val(
                    userDetails.father_name
                );
                $("#user_profile_update_form [name=mother_name]").val(
                    userDetails.mother_name
                );

                $("#user_profile_update_form [name=nid]").val(userDetails.nid);
                $("#user_profile_update_form [name=dob]").val(userDetails.dob);
                $("#user_profile_update_form [name=b_certificate]").val(
                    userDetails.b_certificate
                );
                $("#user_profile_update_form [name=address]").html(
                    userDetails.address
                );
                let pastTraining = $(
                    "#user_profile_update_form [name=past_training][value =" +
                        userPastTraining +
                        "]"
                );
                pastTraining.prop("checked", true);
                
                $("#user_profile_update_form [name=bank_id]").val(
                    userDetails.bank_id
                );
                $("#user_profile_update_form [name=bkash_id]").val(
                    userDetails.bkash_id
                );

                let pastTrainingValue = $(
                    "#user_profile_update_form [name=past_training]:checked"
                ).val();

                if (pastTrainingValue == 0) {
                    $(
                        "#user_profile_update_form #past_course_name_row"
                    ).addClass("d-none");
                    $(
                        "#user_profile_update_form #past_course_duration_row"
                    ).addClass("d-none");
                    $("#user_profile_update_form #past_provider_row").addClass(
                        "d-none"
                    );
                } else {
                    $("#user_profile_update_form [name=past_course_name]").val(
                        userDetails.past_course_name
                    );
                    $(
                        "#user_profile_update_form [name=past_course_duration]"
                    ).val(userDetails.past_course_duration);
                    $("#user_profile_update_form [name=past_provider_id]").val(
                        userDetails.past_provider_id
                    );
                }
                $("#existing-photo").css(
                    "background-image",
                    "url('" + profileImageUrl + "')"
                );
            }

            // for district

            let district_api_link = api_baseurl + "districts";
            let htmlDistrict = "<option value=''></option>";
            $.ajax({
                type: "get",
                url: district_api_link,
                headers: {
                    Authorization: localStorage.getItem("authToken"),
                },
                data: {},
                dataType: "JSON",
                success: function (results) {
                    let districts = results.data;
                    // console.log(userDetails.district_id);

                    if (userDetails && userDetails.district_id !== null) {
                        $.each(districts, function (index, district) {
                            if (district.id == userDetails.district_id) {
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

                    $("#district_id").html(htmlDistrict);
                },
                error: function (response) {
                    console.log(response);
                },
            });

            // get upazilas

            let upazila_api_link = api_baseurl + "upazilas";

            if (userDetails !== null && userDetails.upazila_id !== null) {
                let storedDistrictId = userDetails.district_id;
                let storedUpazilaId = userDetails.upazila_id;
                upazila_api_link = api_baseurl + "upazilas/" + storedDistrictId;

                populateUpazilaSelect(
                    upazila_api_link,
                    authToken,
                    storedUpazilaId
                );
            }

            // employment_status
            const employmentStatus = [
                "Employed",
                "Self Employed",
                "In Education",
                "House Wife",
                "Unemployed",
                "Others",
            ];
            // select options
            let htmlEmploymentStatus = "<option value=''></option>";
            if (userDetails && userDetails.employment_status !== null) {
                $.each(employmentStatus, function (index, employmentSt) {
                    if (userDetails.employment_status == employmentSt) {
                        htmlEmploymentStatus +=
                            '<option value="' +
                            employmentSt +
                            '" selected>' +
                            employmentSt +
                            "</option>";
                    } else {
                        htmlEmploymentStatus +=
                            '<option value="' +
                            employmentSt +
                            '">' +
                            employmentSt +
                            "</option>";
                    }
                });
            } else {
                $.each(employmentStatus, function (index, employmentSt) {
                    htmlEmploymentStatus +=
                        '<option value="' +
                        employmentSt +
                        '">' +
                        employmentSt +
                        "</option>";
                });
            }
            // append options in select
            $("#employment_status").html(htmlEmploymentStatus);

            // financial_status
            const financialStatus = [
                "Highly Solvent",
                "Solvent",
                "Mid Level Solvent",
                "Not Solvent",
            ];
            // select options
            let htmlFinancialStatus = "<option value=''></option>";
            if (userDetails && userDetails.financial_status !== null) {
                $.each(financialStatus, function (index, financialSt) {
                    if (userDetails.financial_status == financialSt) {
                        htmlFinancialStatus +=
                            '<option value="' +
                            financialSt +
                            '" selected>' +
                            financialSt +
                            "</option>";
                    } else {
                        htmlFinancialStatus +=
                            '<option value="' +
                            financialSt +
                            '">' +
                            financialSt +
                            "</option>";
                    }
                });
            } else {
                $.each(financialStatus, function (index, financialSt) {
                    htmlFinancialStatus +=
                        '<option value="' +
                        financialSt +
                        '">' +
                        financialSt +
                        "</option>";
                });
            }
            // append options in select
            $("#financial_status").html(htmlFinancialStatus);

            // For category_id
            let category_api_link = api_baseurl + "categories";
            let htmlCategory = "<option value=''></option>";
            $.ajax({
                type: "get",
                url: category_api_link,
                headers: {
                    Authorization: localStorage.getItem("authToken"),
                },
                data: {},
                dataType: "JSON",
                success: function (results) {
                    let categories = results.data;
                    // console.log(categories);

                    if (userDetails && userDetails.category_id !== null) {
                        $.each(categories, function (index, category) {
                            if (category.id == userDetails.category_id) {
                                htmlCategory +=
                                    '<option value="' +
                                    category.id +
                                    '" selected>' +
                                    category.name +
                                    "</option>";
                            } else {
                                htmlCategory +=
                                    '<option value="' +
                                    category.id +
                                    '">' +
                                    category.name +
                                    "</option>";
                            }
                        });
                    } else {
                        $.each(categories, function (index, category) {
                            htmlCategory +=
                                '<option value="' +
                                category.id +
                                '">' +
                                category.name +
                                "</option>";
                        });
                    }

                    $("#category_id").html(htmlCategory);
                },
                error: function (response) {
                    console.log(response);
                },
            });

            // For sub_category_id
            let subCategory_api_link = api_baseurl + "subcategories";

            if (userDetails !== null && userDetails.sub_category_id !== null) {
                let storedSubCategoryId = userDetails.sub_category_id;
                subCategory_api_link =
                    api_baseurl + "subcategories/" + userDetails.category_id;
                populateSubCategorySelect(
                    subCategory_api_link,
                    authToken,
                    storedSubCategoryId
                );
            }
        },
        error: function (response) {
            console.log(response);
        },
    });

    // load upazila on district change
    let selectDistrictElement = $("#district_id");
    selectDistrictElement.change(function () {
        let district_id = selectDistrictElement.val();
        upazila_api_link = api_baseurl + "upazilas/" + district_id;

        populateUpazilaSelect(upazila_api_link, authToken);
    });

    // load sub-category on category change
    let selectCategoryElement = $("#category_id");
    selectCategoryElement.change(function () {
        let category_id = selectCategoryElement.val();
        subCategory_api_link = api_baseurl + "subcategories/" + category_id;

        populateSubCategorySelect(subCategory_api_link, authToken);
    });

    // function to get upazilas

    function populateUpazilaSelect(apiLink, authToken, storedUpazilaId = null) {
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
                if (storedUpazilaId !== null) {
                    $.each(upazilas, function (index, upazila) {
                        if (upazila.id == storedUpazilaId) {
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

                $("#upazila_id").html(htmlUpazila);
            },
            error: function (response) {
                console.log(response);
            },
        });
    }

    function populateSubCategorySelect(
        apiLink,
        authToken,
        storedSubCategoryId = null
    ) {
        let htmlSubCategory = "<option value=''></option>";

        $.ajax({
            type: "get",
            url: apiLink,
            headers: {
                Authorization: authToken,
            },
            data: {},
            dataType: "JSON",
            success: function (results) {
                let subCategories = results.data;
                // console.log(subCategories);
                if (storedSubCategoryId !== null) {
                    $.each(subCategories, function (index, subCategory) {
                        if (subCategory.id == storedSubCategoryId) {
                            htmlSubCategory +=
                                '<option value="' +
                                subCategory.id +
                                '" selected>' +
                                subCategory.name +
                                "</option>";
                        } else {
                            htmlSubCategory +=
                                '<option value="' +
                                subCategory.id +
                                '">' +
                                subCategory.name +
                                "</option>";
                        }
                    });
                } else {
                    $.each(subCategories, function (index, subCategory) {
                        htmlSubCategory +=
                            '<option value="' +
                            subCategory.id +
                            '">' +
                            subCategory.name +
                            "</option>";
                    });
                }

                $("#sub_category_id").html(htmlSubCategory);
            },
            error: function (response) {
                console.log(response);
            },
        });
    }

    // update profile form submit
    $("#user_profile_update_form").submit(function (e) {
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
                let api_link = api_baseurl + "profile/" + userId + "/update";

                let image_url = document.getElementById("photo_url");
                let attached_image_url = image_url.files[0];

                // console.log(attached_image_url);
                let hsc_certificate =
                    document.getElementById("hsc_certificate");
                let attached_hsc_certificate = hsc_certificate.files[0];

                let ssc_certificate =
                    document.getElementById("ssc_certificate");
                let attached_ssc_certificate = ssc_certificate.files[0];

                let signature = document.getElementById("signature");
                let attached_signature = signature.files[0];
                //let photo_remove = $("#user_profile_update_form [name=photo_remove]").val();

                let fname = $("#user_profile_update_form [name=fname]").val();
                let lname = $("#user_profile_update_form [name=lname]").val();
                let gender = $("#user_profile_update_form [name=gender]").val();
                let father_name = $(
                    "#user_profile_update_form [name=father_name]"
                ).val();
                let mother_name = $(
                    "#user_profile_update_form [name=mother_name]"
                ).val();
                let phone_number = $(
                    "#user_profile_update_form [name=phone_number]"
                ).val();
                let nid = $("#user_profile_update_form [name=nid]").val();
                let dob = $("#user_profile_update_form [name=dob]").val();
                let bd_certificate = $(
                    "#user_profile_update_form [name=b_certificate]"
                ).val();
                let district_id = $(
                    "#user_profile_update_form [name=district_id]"
                ).val();
                let upazila_id = $(
                    "#user_profile_update_form [name=upazila_id]"
                ).val();
                let address = $(
                    "#user_profile_update_form [name=address]"
                ).val();
                let employment_status = $(
                    "#user_profile_update_form [name=employment_status]"
                ).val();
                let financial_status = $(
                    "#user_profile_update_form [name=financial_status]"
                ).val();
                let past_training = $(
                    "#user_profile_update_form [name=past_training]:checked"
                ).val();
                let past_course_name = $(
                    "#user_profile_update_form [name=past_course_name]"
                ).val();
                let past_course_duration = $(
                    "#user_profile_update_form [name=past_course_duration]"
                ).val();
                let past_provider_id = $(
                    "#user_profile_update_form [name=past_provider_id]"
                ).val();
                let bank_id = $(
                    "#user_profile_update_form [name=bank_id]"
                ).val();
                let bkash_id = $(
                    "#user_profile_update_form [name=bkash_id]"
                ).val();
                let category_id = $(
                    "#user_profile_update_form [name=category_id]"
                ).val();
                let sub_category_id = $(
                    "#user_profile_update_form [name=sub_category_id]"
                ).val();

                if (attached_image_url != undefined) {
                    fd.append("image_url", attached_image_url);
                }

                if (sub_category_id == null) {
                    sub_category_id = 0;
                }

                fd.append("fname", fname);
                fd.append("lname", lname);
                fd.append("gender", gender);
                fd.append("user_id", userId);
                fd.append("father_name", father_name);
                fd.append("mother_name", mother_name);
                fd.append("phone_number", phone_number);
                fd.append("nid", nid);
                fd.append("dob", dob);
                fd.append("b_certificate", bd_certificate);
                fd.append("district_id", district_id);
                fd.append("upazila_id", upazila_id);
                fd.append("address", address);
                fd.append("employment_status", employment_status);
                fd.append("financial_status", financial_status);
                fd.append("past_training", past_training);
                fd.append("past_course_name", past_course_name);
                fd.append("past_course_duration", past_course_duration);
                fd.append("past_provider_id", past_provider_id);
                fd.append("bank_id", bank_id);
                fd.append("bkash_id", bkash_id);
                fd.append("category_id", category_id);
                fd.append("sub_category_id", sub_category_id);

                if (attached_hsc_certificate != undefined) {
                    fd.append("hsc_certificate", attached_hsc_certificate);
                }
                if (attached_ssc_certificate != undefined) {
                    fd.append("ssc_certificate", attached_ssc_certificate);
                }
                if (attached_signature != undefined) {
                    fd.append("signature", attached_signature);
                }

                fd.append("_token", CSRF_TOKEN);
                fd.append("_method", "patch");
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
                                swal.fire("", errors);

                                // function display error message
                                function displayErrorMessage(
                                    fieldName,
                                    errorMessage
                                ) {
                                    const errorMessageSelector = `#user_profile_update_form .form-message-error-${fieldName}`;
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
                                    "gender",
                                    "father_name",
                                    "mother_name",
                                    "phone_number",
                                    "nid",
                                    "bd_certificate",
                                    "district_id",
                                    "upazila_id",
                                    "address",
                                    "employment_status",
                                    "financial_status",
                                    "past_training",
                                    "past_course_name",
                                    "past_course_duration",
                                    "past_provider_id",
                                    "bank_id",
                                    "bkash_id",
                                    "category_id",
                                    "sub_category_id",
                                    "hsc_certificate",
                                    "ssc_certificate",
                                    "signature",
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
    // Get references to the radio buttons
    let yesRadio = document.getElementById("yesRadio");
    let noRadio = document.getElementById("noRadio");

    // Add an onchange event listener
    yesRadio.addEventListener("change", function () {
        if (yesRadio.checked) {
            onPastTraining();
        }
    });

    noRadio.addEventListener("change", function () {
        if (noRadio.checked) {
            offPastTraining();
        }
    });

    function offPastTraining() {
        $("#user_profile_update_form #past_course_name_row").addClass("d-none");
        $("#user_profile_update_form #past_course_duration_row").addClass(
            "d-none"
        );
        $("#user_profile_update_form #past_provider_row").addClass("d-none");
    }

    function onPastTraining() {
        $("#user_profile_update_form #past_course_name_row").removeClass(
            "d-none"
        );
        $("#user_profile_update_form #past_course_duration_row").removeClass(
            "d-none"
        );
        $("#user_profile_update_form #past_provider_row").removeClass("d-none");
    }
});
