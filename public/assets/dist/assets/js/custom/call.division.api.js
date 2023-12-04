$(function () {

    // Division Create api call
    $("#create_division").submit(function (e) {
        e.preventDefault();
        
        let fd = new FormData();
        let CSRF_TOKEN = $('meta[name="csrf-token"]').attr("content");
        let link = api_baseurl + "divisions/create";

        let name = $("#division_add_form [name=name]").val();

        fd.append("name", name);
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
            },
            success: function (results) {
                if (results.success === true) {
                    swal.fire("Yes! ", results.message);

                    sessionStorage.setItem('message', results.message);
                    sessionStorage.setItem('alert-type', 'info');

                    // refresh page after 2 seconds
                    setTimeout(function () {
                        location.reload();
                    }, 2000);
                } else {
                    if (results.error === true) {
                        var errors = "Validation Error Occurs!!";
                        swal.fire("", errors);
                    }

                    if (results.error === true) {
                        if (results.message.name) {
                            $("#division_add_form .form-message-error-name")
                                .html(results.message.name[0])
                                .addClass("text-danger")
                                .fadeIn(5000);
                            setTimeout(() => {
                                $(
                                    "#division_add_form .form-message-error-name"
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



    $(document).on('click', '.editDivision', function () {
        let id = $(this).attr('data-division-id');
        let url_link = api_baseurl + "divisions/" + id + "/edit";
        $.ajax({
            url: url_link,
            type: "GET",
            data: {},
            headers: {
                Authorization: localStorage.getItem("authToken"),
            },
            success: function (item) {
                console.log(item);
                let divisions = item.data;
                $("#division_edit_form #name").val(divisions['name']);
                $("#division_edit_form #division_id").val(divisions['id']);

            }
        });
    });

    $("#division_edit_form").submit(function (e) {
        e.preventDefault();
        Swal.fire({
            title: "Are you sure",
            text: "You want to submit the form?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, Submitted",
        }).then((result) => {
            if (result.isConfirmed) {
                let fd = new FormData();
                let CSRF_TOKEN = $('meta[name="csrf-token"]').attr("content");

                let id = $(
                    "#division_edit_form #division_id"
                ).val();

                let link = api_baseurl + "divisions/" + id + "/update";

                let name = $(
                    "#division_edit_form #name"
                ).val();


                fd.append("name", name);
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
                    },
                    success: function (results) {
                        if (results.success === true) {
                            swal.fire("Sucessfully Updated!", results.data);
                            sessionStorage.setItem('message', results.message);
                            sessionStorage.setItem('alert-type', 'info');
                            // refresh page after 2 seconds
                            setTimeout(function () {
                                location.reload();
                            }, 2000);
                        } else {
                            if (results.error === true) {
                                var errors = "Validation Error Occurs!!";
                                swal.fire("", errors);
                            }

                            if (results.error === true) {
                                if (results.message.name) {
                                    $(
                                        "#division_edit_form .form-message-error-name"
                                    )
                                        .html(results.message.name[0])
                                        .addClass("text-danger")
                                        .fadeIn(5000);
                                    setTimeout(() => {
                                        $(
                                            "#division_edit_form .form-message-error-name"
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

    // Division delete api call
    $(document).on("click", ".delete-division", function (e) {
        e.preventDefault();
        let division_name = $(this).attr("data-division-name");
        Swal.fire({
            title: areYou,
            text: "'" + division_name + "'" + deleteData,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: yesDelete,
            cancelButtonText: noDelete,
        }).then((result) => {
            if (result.isConfirmed) {
                let id = $(this).attr("data-division-id");
                let url_link = api_baseurl + "divisions/" + id + "/delete";
                $.ajax({
                    type: "get",
                    url: url_link,
                    headers: {
                        Authorization: localStorage.getItem("authToken"),
                    },
                    success: function (results) {
                        if (results.success === true) {
                            swal.fire("Deleted!", results.message);
                            sessionStorage.setItem('message', results.message);
                            sessionStorage.setItem('alert-type', 'info');

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


    /*  All District apis */

    /* Select Division list api */
    $(document).on("click", ".select-division", function (e) {
        e.preventDefault();
        let url_link = api_baseurl + "divisions";
        
        $.ajax({
            url: url_link,
            type: "GET",
            data: {},
            headers: {
                Authorization: localStorage.getItem("authToken"),
            },
            success: function (results) {
                if (results.success === true) {
                    let allDivisions = results.data;
                    
                    $(
                        "#district_add_form #division_id"
                    ).append($("<option value=''>"+ selectDivision +"</option>"));
                    $.each(allDivisions, function (index, value) {
                        $(
                            "#district_add_form #division_id"
                        ).append(
                            $("<option/>", {
                                value: value.id,
                                text: value.name,
                            })
                        );
                    });
                }
            },
        });
    });

    // Districts Create api call
    $("#create_district").submit(function (e) {
        e.preventDefault();

        let fd = new FormData();
        let CSRF_TOKEN = $('meta[name="csrf-token"]').attr("content");
        let link = api_baseurl + "districts/create";

        let name = $("#district_add_form [name=name]").val();
        let division_id = $("#district_add_form [name=division_id]").val();

        fd.append("name", name);
        fd.append("division_id", division_id);
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
            },
            success: function (results) {
                if (results.success === true) {
                    swal.fire("Yes! ", results.message);

                    sessionStorage.setItem('message', results.message);
                    sessionStorage.setItem('alert-type', 'info');

                    // refresh page after 2 seconds
                    setTimeout(function () {
                        location.reload();
                    }, 2000);
                } else {
                    if (results.error === true) {
                        var errors = "Validation Error Occurs!!";
                        swal.fire("", errors);
                    }

                    if (results.error === true) {
                        if (results.message.name) {
                            $("#district_add_form .form-message-error-name")
                                .html(results.message.name[0])
                                .addClass("text-danger")
                                .fadeIn(5000);
                            setTimeout(() => {
                                $(
                                    "#district_add_form .form-message-error-name"
                                )
                                    .html("")
                                    .removeClass("text-danger")
                                    .fadeOut();
                                Logo;
                            }, 5000);
                        }
                        if (results.message.division_id) {
                            $("#district_add_form .form-message-error-division_id")
                                .html(results.message.division_id[0])
                                .addClass("text-danger")
                                .fadeIn(5000);
                            setTimeout(() => {
                                $(
                                    "#district_add_form .form-message-error-division_id"
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

    // Districts edit api call
    $(document).on('click', '.editDistrict', function () {
        let id = $(this).attr('data-district-id');
        let url_link = api_baseurl + "districts/" + id + "/edit";
        $.ajax({
            url: url_link,
            type: "GET",
            data: {},
            headers: {
                Authorization: localStorage.getItem("authToken"),
            },
            success: function (item) {
                let allDivisions = item.data.divisions;
                let district = item.data.district;

                $("#district_edit_form #name").val(district['name']);
                $("#district_edit_form #district_id").val(district['id']);

                let htmlDivision = `<option value=''>Select Divisions</option>`;               

                $.each(allDivisions, function(index, value) {
                    if (value['id'] == district['division_id']) {
                        htmlDivision += `<option value="` + value['id'] +
                            `" selected>` + value['name'] + `</option>`;
                    } else {

                        htmlDivision += `<option value="` + value['id'] + `">` +
                        value['name'] + `</option>`;

                    }
                });

                $("#district_edit_form #division_id").append(htmlDivision);

            }
        });
    });

    // Districts update form
    $("#district_edit_form").submit(function (e) {
        e.preventDefault();
        Swal.fire({
            title: "Are you sure",
            text: "You want to submit the form?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, Submitted",
        }).then((result) => {
            if (result.isConfirmed) {
                let fd = new FormData();
                let CSRF_TOKEN = $('meta[name="csrf-token"]').attr("content");

                let id = $(
                    "#district_edit_form #district_id"
                ).val();

                let link = api_baseurl + "districts/" + id + "/update";

                let name = $(
                    "#district_edit_form #name"
                ).val();
                let division_id = $(
                    "#district_edit_form [name=division_id]"
                ).val();


                fd.append("name", name);
                fd.append("division_id", division_id);
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
                    },
                    success: function (results) {
                        if (results.success === true) {
                            swal.fire("Sucessfully Updated!", results.data);
                            sessionStorage.setItem('message', results.message);
                            sessionStorage.setItem('alert-type', 'info');
                            // refresh page after 2 seconds
                            setTimeout(function () {
                                location.reload();
                            }, 2000);
                        } else {
                            if (results.error === true) {
                                var errors = "Validation Error Occurs!!";
                                swal.fire("", errors);
                            }

                            if (results.error === true) {
                                if (results.message.name) {
                                    $(
                                        "#district_edit_form .form-message-error-name"
                                    )
                                        .html(results.message.name[0])
                                        .addClass("text-danger")
                                        .fadeIn(5000);
                                    setTimeout(() => {
                                        $(
                                            "#district_edit_form .form-message-error-name"
                                        )
                                            .html("")
                                            .removeClass("text-danger")
                                            .fadeOut();
                                    }, 5000);
                                }
                                if (results.message.division_id) {
                                    $(
                                        "#district_edit_form .form-message-error-division_id"
                                    )
                                        .html(results.message.division_id[0])
                                        .addClass("text-danger")
                                        .fadeIn(5000);
                                    setTimeout(() => {
                                        $(
                                            "#district_edit_form .form-message-error-division_id"
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

     // District delete api call
     $(document).on("click", ".delete-district", function (e) {
        e.preventDefault();
        let district_name = $(this).attr("data-district-name");
        Swal.fire({
            title: areYou,
            text: "'" + district_name + "'" + deleteData,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: yesDelete,
            cancelButtonText: noDelete,
        }).then((result) => {
            if (result.isConfirmed) {
                let id = $(this).attr("data-district-id");
                let url_link = api_baseurl + "districts/" + id + "/delete";
                $.ajax({
                    type: "get",
                    url: url_link,
                    headers: {
                        Authorization: localStorage.getItem("authToken"),
                    },
                    success: function (results) {
                        if (results.success === true) {
                            swal.fire("Deleted!", results.message);
                            sessionStorage.setItem('message', results.message);
                            sessionStorage.setItem('alert-type', 'info');

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




    /*  All Upazila apis */

    /* Select District list api */
    $(document).on("click", ".select-district", function (e) {
        e.preventDefault();
        let url_link = api_baseurl + "districts";
        $.ajax({
            url: url_link,
            type: "GET",
            data: {},
            headers: {
                Authorization: localStorage.getItem("authToken"),
            },
            success: function (results) {
                if (results.success === true) {
                    let allDistricts = results.data;
                    $(
                        "#upazila_add_form #district_id"
                    ).append($("<option value=''>"+ selectDistrict +"</option>"));
                    $.each(allDistricts, function (index, value) {
                        $(
                            "#upazila_add_form #district_id"
                        ).append(
                            $("<option/>", {
                                value: value.id,
                                text: value.name,
                            })
                        );
                    });
                }
            },
        });
    });

    // Upazila Create api call
    $("#create_upazila").submit(function (e) {
        e.preventDefault();

        let fd = new FormData();
        let CSRF_TOKEN = $('meta[name="csrf-token"]').attr("content");
        let link = api_baseurl + "upazilas/create";

        let name = $("#upazila_add_form [name=name]").val();
        let district_id = $("#upazila_add_form [name=district_id]").val();

        fd.append("name", name);
        fd.append("district_id", district_id);
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
            },
            success: function (results) {
                if (results.success === true) {
                    swal.fire("Yes! ", results.message);

                    sessionStorage.setItem('message', results.message);
                    sessionStorage.setItem('alert-type', 'info');

                    // refresh page after 2 seconds
                    setTimeout(function () {
                        location.reload();
                    }, 2000);
                } else {
                    if (results.error === true) {
                        var errors = "Validation Error Occurs!!";
                        swal.fire("", errors);
                    }

                    if (results.error === true) {
                        if (results.message.name) {
                            $("#upazila_add_form .form-message-error-name")
                                .html(results.message.name[0])
                                .addClass("text-danger")
                                .fadeIn(5000);
                            setTimeout(() => {
                                $(
                                    "#upazila_add_form .form-message-error-name"
                                )
                                    .html("")
                                    .removeClass("text-danger")
                                    .fadeOut();
                                Logo;
                            }, 5000);
                        }
                        if (results.message.district_id) {
                            $("#upazila_add_form .form-message-error-district_id")
                                .html(results.message.district_id[0])
                                .addClass("text-danger")
                                .fadeIn(5000);
                            setTimeout(() => {
                                $(
                                    "#upazila_add_form .form-message-error-district_id"
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

    // Upazila edit api call
    $(document).on('click', '.editUpazila', function () {
        let id = $(this).attr('data-upazila-id');
        let url_link = api_baseurl + "upazilas/" + id + "/edit";
        $.ajax({
            url: url_link,
            type: "GET",
            data: {},
            headers: {
                Authorization: localStorage.getItem("authToken"),
            },
            success: function (item) {
                let allDistricts = item.data.districts;
                let upazila = item.data.upazila;

                $("#upazila_edit_form #name").val(upazila['name']);
                $("#upazila_edit_form #upazila_id").val(upazila['id']);

                let htmlDistrict = `<option value=''>Select Districts</option>`;               

                $.each(allDistricts, function(index, value) {
                    if (value['id'] == upazila['district_id']) {
                        htmlDistrict += `<option value="` + value['id'] +
                            `" selected>` + value['name'] + `</option>`;
                    } else {

                        htmlDistrict += `<option value="` + value['id'] + `">` +
                        value['name'] + `</option>`;

                    }
                });

                $("#upazila_edit_form #district_id").append(htmlDistrict);

            }
        });
    });

    // Upazila update form
    $("#upazila_edit_form").submit(function (e) {
        e.preventDefault();
        Swal.fire({
            title: "Are you sure",
            text: "You want to submit the form?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, Submitted",
        }).then((result) => {
            if (result.isConfirmed) {
                let fd = new FormData();
                let CSRF_TOKEN = $('meta[name="csrf-token"]').attr("content");

                let id = $(
                    "#upazila_edit_form #upazila_id"
                ).val();

                let link = api_baseurl + "upazilas/" + id + "/update";

                let name = $(
                    "#upazila_edit_form #name"
                ).val();
                let district_id = $(
                    "#upazila_edit_form [name=district_id]"
                ).val();


                fd.append("name", name);
                fd.append("district_id", district_id);
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
                    },
                    success: function (results) {
                        if (results.success === true) {
                            swal.fire("Sucessfully Updated!", results.data);
                            sessionStorage.setItem('message', results.message);
                            sessionStorage.setItem('alert-type', 'info');
                            // refresh page after 2 seconds
                            setTimeout(function () {
                                location.reload();
                            }, 2000);
                        } else {
                            if (results.error === true) {
                                var errors = "Validation Error Occurs!!";
                                swal.fire("", errors);
                            }

                            if (results.error === true) {
                                if (results.message.name) {
                                    $(
                                        "#upazila_edit_form .form-message-error-name"
                                    )
                                        .html(results.message.name[0])
                                        .addClass("text-danger")
                                        .fadeIn(5000);
                                    setTimeout(() => {
                                        $(
                                            "#upazila_edit_form .form-message-error-name"
                                        )
                                            .html("")
                                            .removeClass("text-danger")
                                            .fadeOut();
                                    }, 5000);
                                }
                                if (results.message.district_id) {
                                    $(
                                        "#upazila_edit_form .form-message-error-district_id"
                                    )
                                        .html(results.message.district_id[0])
                                        .addClass("text-danger")
                                        .fadeIn(5000);
                                    setTimeout(() => {
                                        $(
                                            "#upazila_edit_form .form-message-error-district_id"
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

     // Upazila delete api call
     $(document).on("click", ".delete-upazila", function (e) {
        e.preventDefault();
        let upazila_name = $(this).attr("data-upazila-name");
        Swal.fire({
            title: areYou,
            text: "'" + upazila_name + "'" + deleteData,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: yesDelete,
            cancelButtonText: noDelete,
        }).then((result) => {
            if (result.isConfirmed) {
                let id = $(this).attr("data-upazila-id");
                let url_link = api_baseurl + "upazilas/" + id + "/delete";
                $.ajax({
                    type: "get",
                    url: url_link,
                    headers: {
                        Authorization: localStorage.getItem("authToken"),
                    },
                    success: function (results) {
                        if (results.success === true) {
                            swal.fire("Deleted!", results.message);
                            sessionStorage.setItem('message', results.message);
                            sessionStorage.setItem('alert-type', 'info');

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
