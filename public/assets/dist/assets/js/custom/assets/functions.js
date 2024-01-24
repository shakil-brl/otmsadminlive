// format date
function extractDatePart(dateTimeString) {
    const dateTime = new Date(dateTimeString);
    const day = dateTime.getDate().toString().padStart(2, "0");
    const month = (dateTime.getMonth() + 1).toString().padStart(2, "0");
    const year = dateTime.getFullYear();
    return `${day}-${month}-${year}`;
}

// function for load options in select
function populateOption(api_link, authToken, selector, selectedId = null) {
    let htmlOption = "<option value=''></option>";
    $.ajax({
        type: "get",
        url: api_link,
        headers: {
            Authorization: authToken,
        },
        data: {},
        dataType: "JSON",
        success: function (results) {
            let allData = results.data;
            // console.log(allData);

            if (allData) {
                if (selectedId !== null) {
                    $.each(allData, function (index, data) {
                        if (data.id == selectedId) {
                            htmlOption +=
                                '<option value="' +
                                data.id +
                                '" selected>' +
                                data.name +
                                "</option>";
                        } else {
                            htmlOption +=
                                '<option value="' +
                                data.id +
                                '">' +
                                data.name +
                                "</option>";
                        }
                    });
                } else {
                    $.each(allData, function (index, data) {
                        htmlOption +=
                            '<option value="' +
                            data.id +
                            '">' +
                            data.name +
                            "</option>";
                    });
                }
            }

            selector.html(htmlOption);
        },
        error: function (response) {
            console.log(response);
        },
    });
}

// function populateProviderOption(
//     api_link,
//     authToken,
//     selector,
//     selectedId = null
// ) {
//     let htmlOption = "<option value=''></option>";
//     $.ajax({
//         type: "get",
//         url: api_link,
//         headers: {
//             Authorization: authToken,
//         },
//         data: {},
//         dataType: "JSON",
//         success: function (results) {
//             let allData = results.data;
//             console.log(allData);

//             if (allData) {
//                 if (selectedId !== null) {
//                     $.each(allData, function (index, data) {
//                         if (data.id == selectedId) {
//                             htmlOption +=
//                                 '<option value="' +
//                                 data.id +
//                                 '" selected>' +
//                                 data.batchCode +
//                                 " (" +
//                                 data.GEOLocation +
//                                 ")" +
//                                 "</option>";
//                         } else {
//                             htmlOption +=
//                                 '<option value="' +
//                                 data.id +
//                                 '">' +
//                                 data.batchCode +
//                                 " (" +
//                                 data.GEOLocation +
//                                 ")" +
//                                 "</option>";
//                         }
//                     });
//                 } else {
//                     $.each(allData, function (index, data) {
//                         htmlOption +=
//                             '<option value="' +
//                             data.id +
//                             '">' +
//                             data.batchCode +
//                             " (" +
//                             data.GEOLocation +
//                             ")" +
//                             "</option>";
//                     });
//                 }
//             }

//             selector.html(htmlOption);
//         },
//         error: function (response) {
//             console.log(response);
//         },
//     });
// }

function populateTrainerOption(
    api_link,
    authToken,
    selector,
    selectedId = null
) {
    let htmlOption = "<option value=''></option>";
    $.ajax({
        type: "get",
        url: api_link,
        headers: {
            Authorization: authToken,
        },
        data: {},
        dataType: "JSON",
        success: function (results) {
            let allData = results.data;
            // console.log(allData);

            if (allData) {
                if (selectedId !== null) {
                    $.each(allData, function (index, data) {
                        if (data.ProfileId == selectedId) {
                            htmlOption +=
                                '<option value="' +
                                data.ProfileId +
                                '" selected>' +
                                data.profile.KnownAsBangla +
                                " (" +
                                data.profile.Email +
                                ") (" +
                                data.profile.NID +
                                ") " +
                                "</option>";
                        } else {
                            htmlOption +=
                                '<option value="' +
                                data.ProfileId +
                                '">' +
                                data.profile.KnownAsBangla +
                                " (" +
                                data.profile.Email +
                                ") (" +
                                data.profile.NID +
                                ") " +
                                "</option>";
                        }
                    });
                } else {
                    $.each(allData, function (index, data) {
                        let name = data.profile ? data.profile.KnownAs : "";
                        htmlOption +=
                            '<option value="' +
                            data.ProfileId +
                            '">' +
                            data.profile.KnownAsBangla +
                            " (" +
                            data.profile.Email +
                            ") (" +
                            data.profile.NID +
                            ") " +
                            "</option>";
                    });
                }
            }

            selector.html(htmlOption);
        },
        error: function (response) {
            console.log(response);
        },
    });
}

function populateCoordinatorOption(
    api_link,
    authToken,
    selector,
    selectedId = null
) {
    let htmlOption = "<option value=''></option>";
    $.ajax({
        type: "get",
        url: api_link,
        headers: {
            Authorization: authToken,
        },
        data: {},
        dataType: "JSON",
        success: function (results) {
            let allData = results.data;
            // console.log(allData);

            if (allData) {
                if (selectedId !== null) {
                    $.each(allData, function (index, data) {
                        if (data.ProfileId == selectedId) {
                            htmlOption +=
                                '<option value="' +
                                data.ProfileId +
                                '" selected>' +
                                data.profile.KnownAsBangla +
                                " (" +
                                data.profile.Email +
                                ") (" +
                                data.profile.NID +
                                ") " +
                                "</option>";
                        } else {
                            htmlOption +=
                                '<option value="' +
                                data.ProfileId +
                                '">' +
                                data.profile.KnownAsBangla +
                                " (" +
                                data.profile.Email +
                                ") (" +
                                data.profile.NID +
                                ") " +
                                "</option>";
                        }
                    });
                } else {
                    $.each(allData, function (index, data) {
                        let name = data.profile ? data.profile.KnownAs : "";
                        htmlOption +=
                            '<option value="' +
                            data.ProfileId +
                            '">' +
                            data.profile.KnownAsBangla +
                            " (" +
                            data.profile.Email +
                            ") (" +
                            data.profile.NID +
                            ") " +
                            "</option>";
                    });
                }
            }

            selector.html(htmlOption);
        },
        error: function (response) {
            console.log(response);
        },
    });
}

function populateTrainerEnrollOption(
    api_link,
    authToken,
    selector,
    selectedId = null
) {
    $.ajax({
        type: "get",
        url: api_link,
        headers: {
            Authorization: authToken,
        },
        data: {},
        dataType: "JSON",
        success: function (results) {
            let allData = results.data;
            let htmlOption = "<option value=''></option>";
            let selectedIds = selectedId.split(",").map((id) => id.trim());

            if (allData) {
                $.each(allData, function (index, data) {
                    let isSelected = selectedIds.includes(
                        data.ProfileId.toString()
                    );
                    htmlOption +=
                        '<option value="' +
                        data.ProfileId +
                        '" ' +
                        (isSelected ? "selected" : "") +
                        ">" +
                        data.profile.KnownAsBangla +
                        " (" +
                        data.profile.Email +
                        ") (" +
                        data.profile.NID +
                        ") " +
                        "</option>";
                });
            }

            selector.html(htmlOption);
        },
        error: function (response) {
            console.log(response);
        },
    });
}

// function for geoLocation
function populateLocationOption(
    optionFor,
    api_link,
    authToken,
    selectElement,
    selectedId = null
) {
    let htmlSelect = "<option value=''>Select " + optionFor + "</option>";
    $.ajax({
        type: "get",
        url: api_link,
        headers: {
            Authorization: authToken,
        },
        data: {},
        dataType: "JSON",
        success: function (result) {
            let results = result.data;
            // console.log(results);
            if (results) {
                if (selectedId !== null) {
                    $.each(results, function (index, result) {
                        if (result.id == selectedId) {
                            htmlSelect +=
                                '<option value="' +
                                result.id +
                                '" selected>' +
                                result.NameEng +
                                " (" +
                                result.Name +
                                " - " +
                                result.Code +
                                ") </option>";
                        } else {
                            htmlSelect +=
                                '<option value="' +
                                result.id +
                                '">' +
                                result.NameEng +
                                " (" +
                                result.Name +
                                " - " +
                                result.Code +
                                ") </option>";
                        }
                    });
                } else {
                    $.each(results, function (index, result) {
                        htmlSelect +=
                            '<option value="' +
                            result.id +
                            '">' +
                            result.NameEng +
                            " (" +
                            result.Name +
                            " - " +
                            result.Code +
                            ") </option>";
                    });
                }
            }

            selectElement.html(htmlSelect);
        },
        error: function (response) {
            console.log(response);
        },
    });
}

// function for providers
function populateProviderOption(
    authToken,
    api_link,
    providerSelector,
    selectProviderId = null
) {
    let htmlProvider = "<option value=''>Select Provider</option>";

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
