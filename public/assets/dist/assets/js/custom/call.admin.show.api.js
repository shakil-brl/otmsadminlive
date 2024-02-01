$(function () {
    if (typeof accessToken !== "undefined") {
        // Use the access token in your JavaScript code
        // console.log("Access Token:", accessToken);
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
                // console.log(results.data);

                let fullName = data.profile.KnownAs ?? "";
                let regId = data.ProfileId ?? "";
                let email = data.profile.Email ?? "";
                let roleName = data.role.name ?? "";
                let phoneNumber = data.profile.Phone ?? "";
                let userImage = localUserAvatar;
                let gender = data.profile.Gender ?? "";
                let address = data.profile.address ?? "";
                let addressPresent = data.profile.address_present ?? "";
                let NID = data.profile.NID ?? "";
                // let districtName = data.profile.district_code ?? "";
                // let upazilaName = data.profile.upazila_id ?? "";
                providerName = "";
                if (data.provider) {
                    let providerName = data.provider.name ?? "";
                }

                $("#user-avatar").attr(
                    "src",
                    "/assets/dist/assets/media/svg/avatars/blank.svg"
                );
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
                                                        <td>Full Name</td>
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
                                                        <td>NID</td>
                                                        <td>${NID}</td>
                                                    </tr>
                                                    ${
                                                        providerName ??
                                                        `<tr>
                                                            <td>Provider</td>
                                                            <td>${providerName}</td>
                                                        </tr>`
                                                    }
                                                    <tr>
                                                        <td>Permanent Address</td>
                                                        <td>${address}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Present Address</td>
                                                        <td>${addressPresent}</td>
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
    });
});
