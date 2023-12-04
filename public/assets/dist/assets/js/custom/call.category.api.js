$(function () {

    // Category Create api call
    $("#create_category").submit(function (e) {
        e.preventDefault();

        let fd = new FormData();
        let CSRF_TOKEN = $('meta[name="csrf-token"]').attr("content");
        let link = api_baseurl + "categories/create";

        let name = $("#category_add_form [name=name]").val();

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
                "X-localization": language,
            },
            success: function (results) {
                if (results.success === true) {
                    swal.fire(yes, results.message);

                    sessionStorage.setItem('message', results.message);
                    sessionStorage.setItem('alert-type', 'info');

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
                            $("#category_add_form .form-message-error-name")
                                .html(results.message.name[0])
                                .addClass("text-danger")
                                .fadeIn(5000);
                            setTimeout(() => {
                                $(
                                    "#category_add_form .form-message-error-name"
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



    $(document).on('click', '.editCategory', function () {
        let id = $(this).attr('data-category-id');
        let url_link = api_baseurl + "categories/" + id + "/edit";
        $.ajax({
            url: url_link,
            type: "GET",
            data: {},
            headers: {
                Authorization: localStorage.getItem("authToken"),
            },
            success: function (item) {
                console.log(item);
                let categories = item.data;

                $("#category_edit_form #name").val(categories['name']);
                $("#category_edit_form #categrory_id").val(categories['id']);

            }
        });
    });

    $("#category_edit_form").submit(function (e) {
        e.preventDefault();
        Swal.fire({
            title: areYou,
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
                let CSRF_TOKEN = $('meta[name="csrf-token"]').attr("content");

                let id = $(
                    "#category_edit_form #categrory_id"
                ).val();

                let link = api_baseurl + "categories/" + id + "/update";

                let name = $(
                    "#category_edit_form #name"
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
                        "X-localization": language,
                    },
                    success: function (results) {
                        if (results.success === true) {
                            swal.fire(sucessfullyUpdated, results.data);
                            sessionStorage.setItem('message', results.message);
                            sessionStorage.setItem('alert-type', 'info');
                            // refresh page after 2 seconds
                            setTimeout(function () {
                                location.reload();
                            }, 2000);
                        } else {
                            if (results.error === true) {
                                var errors =ValidationError;
                                swal.fire("", errors);
                            }

                            if (results.error === true) {
                                if (results.message.name) {
                                    $(
                                        "#category_edit_form .form-message-error-name"
                                    )
                                        .html(results.message.name[0])
                                        .addClass("text-danger")
                                        .fadeIn(5000);
                                    setTimeout(() => {
                                        $(
                                            "#category_edit_form .form-message-error-name"
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

    // category delete api call
    $(document).on("click", ".delete-category", function (e) {
        e.preventDefault();
        let category_name = $(this).attr("data-category-name");
        Swal.fire({
            title: areYou,
            text: "'" + category_name + "'" + deleteData,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: yesDelete,
            cancelButtonText: noDelete,
        }).then((result) => {
            if (result.isConfirmed) {
                let id = $(this).attr("data-category-id");
                let url_link = api_baseurl + "categories/" + id + "/delete";
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


    /*  All Sub Category apis */

    /* Select category list api */
    $(document).on("click", ".select-category", function (e) {
        e.preventDefault();
        let url_link = api_baseurl + "categories";
        $.ajax({
            url: url_link,
            type: "GET",
            data: {},
            headers: {
                Authorization: localStorage.getItem("authToken"),
                "X-localization": language,
            },
            success: function (results) {
                if (results.success === true) {
                    let allCategories = results.data;
                    $(
                        "#subcategory_add_form #category_id"
                    ).append($("<option value=''>"+ selectCourseCategory +"</option>"));
                    $.each(allCategories, function (index, value) {
                        $(
                            "#subcategory_add_form #category_id"
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

    // Sub Category Create api call
    $("#create_subcategory").submit(function (e) {
        e.preventDefault();

        let fd = new FormData();
        let CSRF_TOKEN = $('meta[name="csrf-token"]').attr("content");
        let link = api_baseurl + "subcategories/create";

        let name = $("#subcategory_add_form [name=name]").val();
        let category_id = $("#subcategory_add_form [name=category_id]").val();

        fd.append("name", name);
        fd.append("category_id", category_id);
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

                    sessionStorage.setItem('message', results.message);
                    sessionStorage.setItem('alert-type', 'info');

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
                            $("#subcategory_add_form .form-message-error-name")
                                .html(results.message.name[0])
                                .addClass("text-danger")
                                .fadeIn(5000);
                            setTimeout(() => {
                                $(
                                    "#subcategory_add_form .form-message-error-name"
                                )
                                    .html("")
                                    .removeClass("text-danger")
                                    .fadeOut();
                                Logo;
                            }, 5000);
                        }
                        if (results.message.category_id) {
                            $("#subcategory_add_form .form-message-error-category_id")
                                .html(results.message.category_id[0])
                                .addClass("text-danger")
                                .fadeIn(5000);
                            setTimeout(() => {
                                $(
                                    "#subcategory_add_form .form-message-error-category_id"
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

    $(document).on('click', '.editSubCategory', function () {
        let id = $(this).attr('data-subcategory-id');
        let url_link = api_baseurl + "subcategories/" + id + "/edit";
        $.ajax({
            url: url_link,
            type: "GET",
            data: {},
            headers: {
                Authorization: localStorage.getItem("authToken"),
                "X-localization": language,
            },
            success: function (item) {
                let allCategories = item.data.categories;
                let subcategory = item.data.subcategory;

                $("#subcategory_edit_form #name").val(subcategory['name']);
                $("#subcategory_edit_form #subcategrory_id").val(subcategory['id']);

                let htmlCategory = `<option value=''>Select Course Category</option>`;               

                $.each(allCategories, function(index, value) {
                    if (value['id'] == subcategory['category_id']) {
                        htmlCategory += `<option value="` + value['id'] +
                            `" selected>` + value['name'] + `</option>`;
                    } else {

                        htmlCategory += `<option value="` + value['id'] + `">` +
                        value['name'] + `</option>`;

                    }
                });

                $("#subcategory_edit_form #category_id").append(htmlCategory);

            }
        });
    });

    // sub category edit form
    $("#subcategory_edit_form").submit(function (e) {
        e.preventDefault();
        Swal.fire({
            title: areYou,
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
                let CSRF_TOKEN = $('meta[name="csrf-token"]').attr("content");

                let id = $(
                    "#subcategory_edit_form #subcategrory_id"
                ).val();

                let link = api_baseurl + "subcategories/" + id + "/update";

                let name = $(
                    "#subcategory_edit_form #name"
                ).val();
                let category_id = $(
                    "#subcategory_edit_form [name=category_id]"
                ).val();


                fd.append("name", name);
                fd.append("category_id", category_id);
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
                            sessionStorage.setItem('message', results.message);
                            sessionStorage.setItem('alert-type', 'info');
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
                                        "#subcategory_edit_form .form-message-error-name"
                                    )
                                        .html(results.message.name[0])
                                        .addClass("text-danger")
                                        .fadeIn(5000);
                                    setTimeout(() => {
                                        $(
                                            "#subcategory_edit_form .form-message-error-name"
                                        )
                                            .html("")
                                            .removeClass("text-danger")
                                            .fadeOut();
                                    }, 5000);
                                }
                                if (results.message.category_id) {
                                    $(
                                        "#subcategory_edit_form .form-message-error-category_id"
                                    )
                                        .html(results.message.category_id[0])
                                        .addClass("text-danger")
                                        .fadeIn(5000);
                                    setTimeout(() => {
                                        $(
                                            "#subcategory_edit_form .form-message-error-category_id"
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

     // Sub category delete api call
     $(document).on("click", ".delete-subcategory", function (e) {
        e.preventDefault();
        let subcategory_name = $(this).attr("data-subcategory-name");
        Swal.fire({
            title: areYou,
            text: "'" + subcategory_name + "'" + deleteData,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: yesDelete,
            cancelButtonText: noDelete,
        }).then((result) => {
            if (result.isConfirmed) {
                let id = $(this).attr("data-subcategory-id");
                let url_link = api_baseurl + "subcategories/" + id + "/delete";
                $.ajax({
                    type: "get",
                    url: url_link,
                    headers: {
                        Authorization: localStorage.getItem("authToken"),
                        "X-localization": language,
                    },
                    success: function (results) {
                        if (results.success === true) {
                            swal.fire(deletedData , results.message);
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
