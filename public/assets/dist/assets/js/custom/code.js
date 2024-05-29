
$(function () {
    $(document).on("click", "#delete", function (e) {
        e.preventDefault();
        var link = $(this).attr("href");
        Swal.fire({
            title: "Are you sure?",
            text: "Do you want to Delete This Data?",
            icon: "question",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!",
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire("Deleted!", "Your file has been deleted.", "success");
                setTimeout(function () {
                    window.location.href = link;
                }, 2000);
            }
        });
    });

    $(document).on("click", "#delete-form", function (e) {
        e.preventDefault();
        Swal.fire({
            title: "Are you sure?",
            text: "Do you want to Delete This Data?",
            icon: "question",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!",
        }).then((result) => {
            if (result.isConfirmed) {
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr("content");
                var link = $(this).attr("href");
                $.ajax({
                    type: "post",
                    url: link,
                    data: { _token: CSRF_TOKEN, _method: "delete" },
                    dataType: "JSON",
                    success: function (results) {
                        if (results.success === true) {
                            swal.fire("Deleted!", results.data);
                            // refresh page after 2 seconds
                            setTimeout(function () {
                                location.reload();
                            }, 2000);
                        } else {
                            swal.fire("Error!", results.msg);
                        }
                    },
                    error: function () {
                        swal.fire("You have no access permission");
                    },
                });
            }
        });
    });

    $("#kt_modal_new_target_form").submit(function (e) {
        e.preventDefault();
        Swal.fire({
            title: "Are you sure?",
            text: "Do you want to submit the form?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, Submitted",
        }).then((result) => {
            if (result.isConfirmed) {
                let fd = new FormData();
                let CSRF_TOKEN = $('meta[name="csrf-token"]').attr("content");
                let link = $(this).attr("action");
                let doc_title = $(
                    "#kt_modal_new_target_course_files [name=doc_title]"
                ).val();
                let doc_type = $(
                    "#kt_modal_new_target_course_files [name=doc_type]"
                ).val();
                let course_id = $(
                    "#kt_modal_new_target_course_files [name=course_id]"
                ).val();
                let fileInputElement = document.getElementById("attached_url");
                let attached_url = fileInputElement.files[0];

                fd.append("attached_url", attached_url);
                fd.append("doc_title", doc_title);
                fd.append("doc_type", doc_type);
                fd.append("course_id", course_id);
                fd.append("_token", CSRF_TOKEN);

                $.ajax({
                    type: "post",
                    data: fd,
                    dataType: "JSON",
                    cache: false,
                    contentType: false,
                    processData: false,
                    url: link,
                    success: function (results) {
                        if (results.success === true) {
                            swal.fire("Sucessfully added!", results.data);
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
                                if (results.message.doc_title) {
                                    $(
                                        "#kt_modal_new_target_course_files .form-message-error-doc_title"
                                    )
                                        .html(results.message.doc_title[0])
                                        .addClass("text-danger")
                                        .fadeIn(5000);
                                    setTimeout(() => {
                                        $(
                                            "#kt_modal_new_target_course_files .form-message-error-doc_title"
                                        )
                                            .html("")
                                            .removeClass("text-danger")
                                            .fadeOut();
                                    }, 5000);
                                }
                                if (results.message.doc_type) {
                                    $(
                                        "#kt_modal_new_target_course_files .form-message-error-doc_type"
                                    )
                                        .html(results.message.doc_type[0])
                                        .addClass("text-danger")
                                        .fadeIn(5000);
                                    setTimeout(() => {
                                        $(
                                            "#kt_modal_new_target_course_files .form-message-error-doc_type"
                                        )
                                            .html("")
                                            .removeClass("text-danger")
                                            .fadeOut();
                                    }, 5000);
                                }
                                if (results.message.attached_url) {
                                    $(
                                        "#kt_modal_new_target_course_files .form-message-error-attached_url"
                                    )
                                        .html(results.message.attached_url[0])
                                        .addClass("text-danger")
                                        .fadeIn(5000);
                                    setTimeout(() => {
                                        $(
                                            "#kt_modal_new_target_course_files .form-message-error-attached_url"
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

    $(".locations").on("change", function (e) {
        var dist_id = $(this).val();
        let url_link = baseurl + "/ajax/locations/" + dist_id;
        $.ajax({
            url: url_link,
            type: "GET",
            data: {},
            success: function (data) {
                if (data.data.length === 0) {
                    $(
                        "#kt_modal_course_schedule #create_location_id option"
                    ).remove();
                } else {
                    $(
                        "#kt_modal_course_schedule #create_location_id option"
                    ).remove();
                    $.each(data.data, function (index, value) {
                        $(
                            "#kt_modal_course_schedule #create_location_id"
                        ).append(
                            $("<option/>", {
                                value: value.id,
                                text:
                                    "Venue: " +
                                    value.location_name +
                                    " - " +
                                    "Location: " +
                                    value.location_address,
                            })
                        );
                    });
                }
            },
        });
    });

    $(".locationEdit").on("change", function (e) {
        var dist_id = $(this).val();
        let url_link = baseurl + "/ajax/locations/" + dist_id;
        $.ajax({
            url: url_link,
            type: "GET",
            data: {},
            success: function (data) {
                if (data.data.length === 0) {
                    $(
                        "#kt_modal_store_course_schedule_update_form #location_id option"
                    ).remove();
                } else {
                    $(
                        "#kt_modal_course_schedule_update #location_id option"
                    ).remove();
                    $.each(data.data, function (index, value) {
                        $(
                            "#kt_modal_store_course_schedule_update_form #location_id"
                        ).append(
                            $("<option/>", {
                                value: value.id,
                                text:
                                    "Venue: " +
                                    value.location_name +
                                    " - " +
                                    "Location: " +
                                    value.location_address,
                            })
                        );
                    });
                }
            },
        });
    });

    $(".locationSearch").on("change", function (e) {
        var dist_id = $(this).val();
        let url_link = baseurl + "/ajax/locations/" + dist_id;
        $.ajax({
            url: url_link,
            type: "GET",
            data: {},
            success: function (data) {
                console.log(data);
                if (data.data.length === 0) {
                    $(
                        "#course_batch_search #location_search option"
                    ).remove();
                } else {
                    $(
                        "#course_batch_search #location_search option"
                    ).remove();
                    $(
                        "#course_batch_search #location_search"
                    ).append(
                        $("<option value=''>Select a Locations</option>"));
                    $.each(data.data, function (index, value) {
                        $(
                            "#course_batch_search #location_search"
                        ).append(
                            $("<option/>", {
                                value: value.id,
                                text:
                                    "Venue: " +
                                    value.location_name +
                                    " - " +
                                    "Location: " +
                                    value.location_address,
                            })
                        );
                    });
                }
            },
        });
    });

    $(".batchSearch").on("change", function (e) {
        var course_id = $(this).val();
        let url_link = baseurl + "/ajax/batches/" + course_id;
        $.ajax({
            url: url_link,
            type: "GET",
            data: {},
            success: function (data) {
                if (data.data.length === 0) {
                    $(
                        "#course_batch_search #batch_search option"
                    ).remove();
                } else {
                    $(
                        "#course_batch_search #batch_search option"
                    ).remove();
                    $(
                        "#course_batch_search #batch_search"
                    ).append(
                        $("<option value=''>Select a Batches</option>"));
                    $.each(data.data, function (index, value) {
                        $(
                            "#course_batch_search #batch_search"
                        ).append(
                            $("<option/>", {
                                value: value.batch.id,
                                text:
                                    "Name: " +
                                    value.batch.batch_name +
                                    " - " +
                                    "Code: " +
                                    value.batch.batch_code,
                            })
                        );
                    });
                }
            },
        });
    });

    $(".locationNotifications").on("change", function (e) {
        var dist_id = $(this).val();
        let url_link = baseurl + "/ajax/locations/" + dist_id;
        $.ajax({
            url: url_link,
            type: "GET",
            data: {},
            success: function (data) {
                if (data.data.length === 0) {
                    $(
                        "#notifications_form #notifications_location_id option"
                    ).remove();
                } else {
                    $(
                        "#notifications_form #notifications_location_id option"
                    ).remove();
                    $(
                        "#notifications_form #notifications_location_id"
                    ).append(
                        $("<option value=''>Select a Locations</option>"));
                    $.each(data.data, function (index, value) {
                        $(
                            "#notifications_form #notifications_location_id"
                        ).append(
                            $("<option/>", {
                                value: value.id,
                                text:
                                    "Venue: " +
                                    value.location_name +
                                    " - " +
                                    "Location: " +
                                    value.location_address,
                            })
                        );
                    });
                }
            },
        });
    });

    $(".batchNotifications").on("change", function (e) {
        var course_id = $(this).val();
        let url_link = baseurl + "/ajax/batches/" + course_id;
        $.ajax({
            url: url_link,
            type: "GET",
            data: {},
            success: function (data) {
                console.log(data);
                if (data.data.length === 0) {
                    $(
                        "#notifications_form #notifications_batch_id option"
                    ).remove();
                } else {
                    $(
                        "#notifications_form #notifications_batch_id option"
                    ).remove();
                    $(
                        "#notifications_form #notifications_batch_id"
                    ).append(
                        $("<option value=''>Select a Batches</option>"));
                    $.each(data.data, function (index, value) {
                        $(
                            "#notifications_form #notifications_batch_id"
                        ).append(
                            $("<option/>", {
                                value: value.batch.id,
                                text:
                                    "Name: " +
                                    value.batch.batch_name +
                                    " - " +
                                    "Code: " +
                                    value.batch.batch_code,
                            })
                        );
                    });
                }
            },
        });
    });

    $("#kt_modal_store_course_schedule_form").submit(function (e) {
        e.preventDefault();
        Swal.fire({
            title: "Are you sure?",
            text: "Do you want to submit the form?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, Submitted",
        }).then((result) => {
            if (result.isConfirmed) {
                let fd = new FormData();
                let CSRF_TOKEN = $('meta[name="csrf-token"]').attr("content");
                let link = $(this).attr("action");
                let start_date = $(
                    "#kt_modal_store_course_schedule_form [name=start_date]"
                ).val();
                let class_time = $(
                    "#kt_modal_store_course_schedule_form [name=class_time]"
                ).val();
                let class_duration = $(
                    "#kt_modal_store_course_schedule_form [name=class_duration]"
                ).val();
                let end_date = $(
                    "#kt_modal_store_course_schedule_form [name=end_date]"
                ).val();
                let course_id = $(
                    "#kt_modal_store_course_schedule_form [name=course_id]"
                ).val();
                let batch_id = $(
                    "#kt_modal_store_course_schedule_form [name=batch_id]"
                ).val();
                let company_id = $(
                    "#kt_modal_store_course_schedule_form [name=company_id]"
                ).val();
                let district_id = $(
                    "#kt_modal_store_course_schedule_form [name=district_id]"
                ).val();
                let location_id = $(
                    "#kt_modal_store_course_schedule_form [name=location_id]"
                ).val();
                let week = "";
                let saturday = $(
                    "#kt_modal_store_course_schedule_form [name='saturday']"
                );
                $(
                    "#kt_modal_store_course_schedule_form [name='saturday']:checked"
                ).each(function () {
                    week += $(this).val() + ",";
                });

                let sunday = $(
                    "#kt_modal_store_course_schedule_form [name='sunday']"
                );
                $(
                    "#kt_modal_store_course_schedule_form [name='sunday']:checked"
                ).each(function () {
                    week += $(this).val() + ",";
                });

                let monday = $(
                    "#kt_modal_store_course_schedule_form [name='monday']"
                );
                $(
                    "#kt_modal_store_course_schedule_form [name='monday']:checked"
                ).each(function () {
                    week += $(this).val() + ",";
                });

                let tuesday = $(
                    "#kt_modal_store_course_schedule_form [name='tuesday']"
                );
                $(
                    "#kt_modal_store_course_schedule_form [name='tuesday']:checked"
                ).each(function () {
                    week += $(this).val() + ",";
                });

                let wednesday = $(
                    "#kt_modal_store_course_schedule_form [name='wednesday']"
                );
                $(
                    "#kt_modal_store_course_schedule_form [name='wednesday']:checked"
                ).each(function () {
                    week += $(this).val() + ",";
                });

                let thusday = $(
                    "#kt_modal_store_course_schedule_form [name='thursday']"
                );
                $(
                    "#kt_modal_store_course_schedule_form [name='thursday']:checked"
                ).each(function () {
                    week += $(this).val() + ",";
                });

                let friday = $(
                    "#kt_modal_store_course_schedule_form [name='friday']"
                );
                $(
                    "#kt_modal_store_course_schedule_form [name='friday']:checked"
                ).each(function () {
                    week += $(this).val() + ",";
                });
                if (week != "") {
                    week = week.slice(0, -1);
                }

                fd.append("start_date", start_date);
                fd.append("class_time", class_time);
                fd.append("class_duration", class_duration);
                fd.append("end_date", end_date);
                fd.append("course_id", course_id);
                fd.append("batch_id", batch_id);
                fd.append("company_id", company_id);
                fd.append("batch_id", batch_id);
                fd.append("district_id", district_id);
                fd.append("location_id", location_id);
                fd.append("class_days", week);
                fd.append("_token", CSRF_TOKEN);

                $.ajax({
                    type: "post",
                    data: fd,
                    dataType: "JSON",
                    cache: false,
                    contentType: false,
                    processData: false,
                    url: link,
                    success: function (results) {
                        if (results.success === true) {
                            swal.fire("Sucessfully added!", results.data);
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
                                if (results.message.start_date) {
                                    $(
                                        "#kt_modal_store_course_schedule_form .form-message-error-start_date"
                                    )
                                        .html(results.message.start_date[0])
                                        .addClass("text-danger")
                                        .fadeIn(5000);
                                    setTimeout(() => {
                                        $(
                                            "#kt_modal_store_course_schedule_form .form-message-error-start_date"
                                        )
                                            .html("")
                                            .removeClass("text-danger")
                                            .fadeOut();
                                    }, 5000);
                                }
                                if (results.message.class_duration) {
                                    $(
                                        "#kt_modal_store_course_schedule_form .form-message-error-class_duration"
                                    )
                                        .html(results.message.class_duration[0])
                                        .addClass("text-danger")
                                        .fadeIn(5000);
                                    setTimeout(() => {
                                        $(
                                            "#kt_modal_store_course_schedule_form .form-message-error-class_duration"
                                        )
                                            .html("")
                                            .removeClass("text-danger")
                                            .fadeOut();
                                    }, 5000);
                                }
                                if (results.message.class_time) {
                                    $(
                                        "#kt_modal_store_course_schedule_form .form-message-error-class_time"
                                    )
                                        .html(results.message.class_time[0])
                                        .addClass("text-danger")
                                        .fadeIn(5000);
                                    setTimeout(() => {
                                        $(
                                            "#kt_modal_store_course_schedule_form .form-message-error-class_time"
                                        )
                                            .html("")
                                            .removeClass("text-danger")
                                            .fadeOut();
                                    }, 5000);
                                }
                                if (results.message.end_date) {
                                    $(
                                        "#kt_modal_store_course_schedule_form .form-message-error-end_date"
                                    )
                                        .html(results.message.end_date[0])
                                        .addClass("text-danger")
                                        .fadeIn(5000);
                                    setTimeout(() => {
                                        $(
                                            "#kt_modal_store_course_schedule_form .form-message-error-end_date"
                                        )
                                            .html("")
                                            .removeClass("text-danger")
                                            .fadeOut();
                                    }, 5000);
                                }
                                if (results.message.class_days) {
                                    $(
                                        "#kt_modal_store_course_schedule_form .form-message-error-class_days"
                                    )
                                        .html(results.message.class_days[0])
                                        .addClass("text-danger")
                                        .fadeIn(5000);
                                    setTimeout(() => {
                                        $(
                                            "#kt_modal_store_course_schedule_form .form-message-error-class_days"
                                        )
                                            .html("")
                                            .removeClass("text-danger")
                                            .fadeOut();
                                    }, 5000);
                                }
                                if (results.message.batch_id) {
                                    $(
                                        "#kt_modal_store_course_schedule_form .form-message-error-batch_id"
                                    )
                                        .html(results.message.batch_id[0])
                                        .addClass("text-danger")
                                        .fadeIn(5000);
                                    setTimeout(() => {
                                        $(
                                            "#kt_modal_store_course_schedule_form .form-message-error-batch_id"
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

    $("#kt_modal_store_course_schedule_update_form").submit(function (e) {
        e.preventDefault();
        Swal.fire({
            title: "Are you sure?",
            text: "Do you want to submit the form?",
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
                    "#kt_modal_course_schedule_update #schedule_id"
                ).val();

                let baseUrl = $(
                    "#kt_modal_course_schedule_update #baseUrl"
                ).val();

                $("#kt_modal_store_course_schedule_update_form").attr(
                    "action",
                    baseUrl + "/" + id + "/update"
                );
                let link = $(this).attr("action");

                let schedule_id = $(
                    "#kt_modal_store_course_schedule_update_form [name=schedule_id]"
                ).val();

                let start_date = $(
                    "#kt_modal_store_course_schedule_update_form [name=start_date]"
                ).val();
                let end_date = $(
                    "#kt_modal_store_course_schedule_update_form [name=end_date]"
                ).val();
                let class_time = $(
                    "#kt_modal_store_course_schedule_update_form [name=class_time]"
                ).val();
                let class_duration = $(
                    "#kt_modal_store_course_schedule_update_form [name=class_duration]"
                ).val();
                let course_id = $(
                    "#kt_modal_store_course_schedule_update_form [name=course_id]"
                ).val();
                let batch_id = $(
                    "#kt_modal_store_course_schedule_update_form [name=batch_id]"
                ).val();
                let company_id = $(
                    "#kt_modal_store_course_schedule_update_form [name=company_id]"
                ).val();
                let district_id = $(
                    "#kt_modal_store_course_schedule_update_form [name=district_id]"
                ).val();
                let location_id = $(
                    "#kt_modal_store_course_schedule_update_form [name=location_id]"
                ).val();
                let week = "";
                let saturday = $(
                    "#kt_modal_store_course_schedule_update_form [name='saturday']"
                );
                $(
                    "#kt_modal_store_course_schedule_update_form [name='saturday']:checked"
                ).each(function () {
                    week += $(this).val() + ",";
                });

                let sunday = $(
                    "#kt_modal_store_course_schedule_update_form [name='sunday']"
                );
                $(
                    "#kt_modal_store_course_schedule_update_form [name='sunday']:checked"
                ).each(function () {
                    week += $(this).val() + ",";
                });

                let monday = $(
                    "#kt_modal_store_course_schedule_update_form [name='monday']"
                );
                $(
                    "#kt_modal_store_course_schedule_update_form [name='monday']:checked"
                ).each(function () {
                    week += $(this).val() + ",";
                });

                let tuesday = $(
                    "#kt_modal_store_course_schedule_update_form [name='tuesday']"
                );
                $(
                    "#kt_modal_store_course_schedule_update_form [name='tuesday']:checked"
                ).each(function () {
                    week += $(this).val() + ",";
                });

                let wednesday = $(
                    "#kt_modal_store_course_schedule_update_form [name='wednesday']"
                );
                $(
                    "#kt_modal_store_course_schedule_update_form [name='wednesday']:checked"
                ).each(function () {
                    week += $(this).val() + ",";
                });

                let thusday = $(
                    "#kt_modal_store_course_schedule_update_form [name='thursday']"
                );
                $(
                    "#kt_modal_store_course_schedule_update_form [name='thursday']:checked"
                ).each(function () {
                    week += $(this).val() + ",";
                });

                let friday = $(
                    "#kt_modal_store_course_schedule_update_form [name='friday']"
                );
                $(
                    "#kt_modal_store_course_schedule_update_form [name='friday']:checked"
                ).each(function () {
                    week += $(this).val() + ",";
                });
                if (week != "") {
                    week = week.slice(0, -1);
                }
                fd.append("start_date", start_date);
                fd.append("class_time", class_time);
                fd.append("class_duration", class_duration);
                fd.append("end_date", end_date);
                fd.append("course_id", course_id);
                fd.append("batch_id", batch_id);
                fd.append("company_id", company_id);
                fd.append("batch_id", batch_id);
                fd.append("district_id", district_id);
                fd.append("location_id", location_id);
                fd.append("class_days", week);
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
                    success: function (results) {
                        if (results.success === true) {
                            swal.fire("Sucessfully added!", results.data);
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
                                if (results.message.start_date) {
                                    $(
                                        "#kt_modal_store_course_schedule_update_form .form-message-error-start_date"
                                    )
                                        .html(results.message.start_date[0])
                                        .addClass("text-danger")
                                        .fadeIn(5000);
                                    setTimeout(() => {
                                        $(
                                            "#kt_modal_store_course_schedule_update_form .form-message-error-start_date"
                                        )
                                            .html("")
                                            .removeClass("text-danger")
                                            .fadeOut();
                                    }, 5000);
                                }

                                if (results.message.class_duration) {
                                    $(
                                        "#kt_modal_store_course_schedule_form .form-message-error-class_duration"
                                    )
                                        .html(results.message.class_duration[0])
                                        .addClass("text-danger")
                                        .fadeIn(5000);
                                    setTimeout(() => {
                                        $(
                                            "#kt_modal_store_course_schedule_form .form-message-error-class_duration"
                                        )
                                            .html("")
                                            .removeClass("text-danger")
                                            .fadeOut();
                                    }, 5000);
                                }

                                if (results.message.class_time) {
                                    $(
                                        "#kt_modal_store_course_schedule_form .form-message-error-class_time"
                                    )
                                        .html(results.message.class_time[0])
                                        .addClass("text-danger")
                                        .fadeIn(5000);
                                    setTimeout(() => {
                                        $(
                                            "#kt_modal_store_course_schedule_form .form-message-error-class_time"
                                        )
                                            .html("")
                                            .removeClass("text-danger")
                                            .fadeOut();
                                    }, 5000);
                                }

                                if (results.message.class_days) {
                                    $(
                                        "#kt_modal_store_course_schedule_form .form-message-error-class_days"
                                    )
                                        .html(results.message.class_days[0])
                                        .addClass("text-danger")
                                        .fadeIn(5000);
                                    setTimeout(() => {
                                        $(
                                            "#kt_modal_store_course_schedule_form .form-message-error-class_days"
                                        )
                                            .html("")
                                            .removeClass("text-danger")
                                            .fadeOut();
                                    }, 5000);
                                }

                                if (results.message.end_date) {
                                    $(
                                        "#kt_modal_store_course_schedule_update_form .form-message-error-end_date"
                                    )
                                        .html(results.message.end_date[0])
                                        .addClass("text-danger")
                                        .fadeIn(5000);
                                    setTimeout(() => {
                                        $(
                                            "#kt_modal_store_course_schedule_update_form .form-message-error-end_date"
                                        )
                                            .html("")
                                            .removeClass("text-danger")
                                            .fadeOut();
                                    }, 5000);
                                }
                                if (results.message.batch_id) {
                                    $(
                                        "#kt_modal_store_course_schedule_update_form .form-message-error-batch_id"
                                    )
                                        .html(results.message.batch_id[0])
                                        .addClass("text-danger")
                                        .fadeIn(5000);
                                    setTimeout(() => {
                                        $(
                                            "#kt_modal_store_course_schedule_update_form .form-message-error-batch_id"
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

    $("#kt_modal_course_exam_form").submit(function (e) {
        e.preventDefault();
        Swal.fire({
            title: "Are you sure?",
            text: "Do you want to submit the form?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, Submitted",
        }).then((result) => {
            if (result.isConfirmed) {
                let fd = new FormData();
                let CSRF_TOKEN = $('meta[name="csrf-token"]').attr("content");
                let link = $(this).attr("action");
                let exam_date = $(
                    "#kt_modal_course_exam_form [name=exam_date]"
                ).val();
                let exam_time = $(
                    "#kt_modal_course_exam_form [name=exam_time]"
                ).val();
                let title = $("#kt_modal_course_exam_form [name=title]").val();
                let course_id = $(
                    "#kt_modal_course_exam_form [name=course_id]"
                ).val();
                let batch_id = $(
                    "#kt_modal_course_exam_form [name=batch_id]"
                ).val();
                let exam_type = $(
                    "#kt_modal_course_exam_form [name=exam_type]"
                ).val();
                let exam_duration = $(
                    "#kt_modal_course_exam_form [name=exam_duration]"
                ).val();
                let marks = $("#kt_modal_course_exam_form [name=marks]").val();
                let description = $(
                    "#kt_modal_course_exam_form [name=description]"
                ).val();

                fd.append("exam_date", exam_date);
                fd.append("exam_time", exam_time);
                fd.append("title", title);
                fd.append("course_id", course_id);
                fd.append("batch_id", batch_id);
                fd.append("exam_type", exam_type);
                fd.append("exam_duration", exam_duration);
                fd.append("marks", marks);
                fd.append("description", description);
                fd.append("_token", CSRF_TOKEN);

                $.ajax({
                    type: "post",
                    data: fd,
                    dataType: "JSON",
                    cache: false,
                    contentType: false,
                    processData: false,
                    url: link,
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
                            }

                            if (results.error === true) {
                                if (results.message.title) {
                                    $(
                                        "#kt_modal_course_exam_form .form-message-error-title"
                                    )
                                        .html(results.message.title[0])
                                        .addClass("text-danger")
                                        .fadeIn(5000);
                                    setTimeout(() => {
                                        $(
                                            "#kt_modal_course_exam_form .form-message-error-title"
                                        )
                                            .html("")
                                            .removeClass("text-danger")
                                            .fadeOut();
                                    }, 5000);
                                }
                                if (results.message.exam_date) {
                                    $(
                                        "#kt_modal_course_exam_form .form-message-error-exam_date"
                                    )
                                        .html(results.message.exam_date[0])
                                        .addClass("text-danger")
                                        .fadeIn(5000);
                                    setTimeout(() => {
                                        $(
                                            "#kt_modal_course_exam_form .form-message-error-exam_date"
                                        )
                                            .html("")
                                            .removeClass("text-danger")
                                            .fadeOut();
                                    }, 5000);
                                }
                                if (results.message.exam_time) {
                                    $(
                                        "#kt_modal_course_exam_form .form-message-error-exam_time"
                                    )
                                        .html(results.message.exam_time[0])
                                        .addClass("text-danger")
                                        .fadeIn(5000);
                                    setTimeout(() => {
                                        $(
                                            "#kt_modal_course_exam_form .form-message-error-exam_time"
                                        )
                                            .html("")
                                            .removeClass("text-danger")
                                            .fadeOut();
                                    }, 5000);
                                }
                                if (results.message.batch_id) {
                                    $(
                                        "#kt_modal_course_exam_form .form-message-error-batch_id"
                                    )
                                        .html(results.message.batch_id[0])
                                        .addClass("text-danger")
                                        .fadeIn(5000);
                                    setTimeout(() => {
                                        $(
                                            "#kt_modal_course_exam_form .form-message-error-batch_id"
                                        )
                                            .html("")
                                            .removeClass("text-danger")
                                            .fadeOut();
                                    }, 5000);
                                }
                                if (results.message.course_id) {
                                    $(
                                        "#kt_modal_course_exam_form .form-message-error-course_id"
                                    )
                                        .html(results.message.course_id[0])
                                        .addClass("text-danger")
                                        .fadeIn(5000);
                                    setTimeout(() => {
                                        $(
                                            "#kt_modal_course_exam_form .form-message-error-course_id"
                                        )
                                            .html("")
                                            .removeClass("text-danger")
                                            .fadeOut();
                                    }, 5000);
                                }
                                if (results.message.exam_type) {
                                    $(
                                        "#kt_modal_course_exam_form .form-message-error-exam_type"
                                    )
                                        .html(results.message.exam_type[0])
                                        .addClass("text-danger")
                                        .fadeIn(5000);
                                    setTimeout(() => {
                                        $(
                                            "#kt_modal_course_exam_form .form-message-error-exam_type"
                                        )
                                            .html("")
                                            .removeClass("text-danger")
                                            .fadeOut();
                                    }, 5000);
                                }
                                if (results.message.exam_duration) {
                                    $(
                                        "#kt_modal_course_exam_form .form-message-error-exam_duration"
                                    )
                                        .html(results.message.exam_duration[0])
                                        .addClass("text-danger")
                                        .fadeIn(5000);
                                    setTimeout(() => {
                                        $(
                                            "#kt_modal_course_exam_form .form-message-error-exam_duration"
                                        )
                                            .html("")
                                            .removeClass("text-danger")
                                            .fadeOut();
                                    }, 5000);
                                }
                                if (results.message.marks) {
                                    $(
                                        "#kt_modal_course_exam_form .form-message-error-marks"
                                    )
                                        .html(results.message.marks[0])
                                        .addClass("text-danger")
                                        .fadeIn(5000);
                                    setTimeout(() => {
                                        $(
                                            "#kt_modal_course_exam_form .form-message-error-marks"
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

    $("#kt_modal_course_exam_update_form").submit(function (e) {
        e.preventDefault();
        Swal.fire({
            title: "Are you sure?",
            text: "Do you want to submit the form?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, Submitted",
        }).then((result) => {
            if (result.isConfirmed) {
                let fd = new FormData();
                let CSRF_TOKEN = $('meta[name="csrf-token"]').attr("content");

                let id = $("#kt_modal_course_exam_update #class_exam_id").val();

                let url = baseurl;

                $("#kt_modal_course_exam_update_form").attr(
                    "action",
                    url + "/course-classes-exam/" + id + "/update"
                );
                let link = $(this).attr("action");

                let title = $(
                    "#kt_modal_course_exam_update_form [name=title]"
                ).val();

                let exam_date = $(
                    "#kt_modal_course_exam_update_form [name=exam_date]"
                ).val();
                let exam_time = $(
                    "#kt_modal_course_exam_update_form [name=exam_time]"
                ).val();
                let exam_type = $(
                    "#kt_modal_course_exam_update_form [name=exam_type]"
                ).val();
                let exam_duration = $(
                    "#kt_modal_course_exam_update_form [name=exam_duration]"
                ).val();
                let marks = $(
                    "#kt_modal_course_exam_update_form [name=marks]"
                ).val();
                let description = $(
                    "#kt_modal_course_exam_update_form [name=description]"
                ).val();

                fd.append("title", title);
                fd.append("description", description);
                fd.append("exam_date", exam_date);
                fd.append("exam_time", exam_time);
                fd.append("exam_type", exam_type);
                fd.append("exam_duration", exam_duration);
                fd.append("marks", marks);
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
                    success: function (results) {
                        if (results.success === true) {
                            swal.fire("Sucessfully added!", results.data);
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
                                if (results.message.title) {
                                    $(
                                        "#kt_modal_course_exam_update_form .form-message-error-title"
                                    )
                                        .html(results.message.title[0])
                                        .addClass("text-danger")
                                        .fadeIn(5000);
                                    setTimeout(() => {
                                        $(
                                            "#kt_modal_course_exam_update_form .form-message-error-title"
                                        )
                                            .html("")
                                            .removeClass("text-danger")
                                            .fadeOut();
                                    }, 5000);
                                }
                                if (results.message.exam_date) {
                                    $(
                                        "#kt_modal_course_exam_update_form .form-message-error-exam_date"
                                    )
                                        .html(results.message.exam_date[0])
                                        .addClass("text-danger")
                                        .fadeIn(5000);
                                    setTimeout(() => {
                                        $(
                                            "#kt_modal_course_exam_update_form .form-message-error-exam_date"
                                        )
                                            .html("")
                                            .removeClass("text-danger")
                                            .fadeOut();
                                    }, 5000);
                                }
                                if (results.message.exam_time) {
                                    $(
                                        "#kt_modal_course_exam_update_form .form-message-error-exam_time"
                                    )
                                        .html(results.message.exam_time[0])
                                        .addClass("text-danger")
                                        .fadeIn(5000);
                                    setTimeout(() => {
                                        $(
                                            "#kt_modal_course_exam_update_form .form-message-error-exam_time"
                                        )
                                            .html("")
                                            .removeClass("text-danger")
                                            .fadeOut();
                                    }, 5000);
                                }
                                if (results.message.exam_type) {
                                    $(
                                        "#kt_modal_course_exam_update_form .form-message-error-exam_type"
                                    )
                                        .html(results.message.exam_type[0])
                                        .addClass("text-danger")
                                        .fadeIn(5000);
                                    setTimeout(() => {
                                        $(
                                            "#kt_modal_course_exam_update_form .form-message-error-exam_type"
                                        )
                                            .html("")
                                            .removeClass("text-danger")
                                            .fadeOut();
                                    }, 5000);
                                }
                                if (results.message.exam_duration) {
                                    $(
                                        "#kt_modal_course_exam_update_form .form-message-error-exam_duration"
                                    )
                                        .html(results.message.exam_duration[0])
                                        .addClass("text-danger")
                                        .fadeIn(5000);
                                    setTimeout(() => {
                                        $(
                                            "#kt_modal_course_exam_update_form .form-message-error-exam_duration"
                                        )
                                            .html("")
                                            .removeClass("text-danger")
                                            .fadeOut();
                                    }, 5000);
                                }
                                if (results.message.marks) {
                                    $(
                                        "#kt_modal_course_exam_update_form .form-message-error-marks"
                                    )
                                        .html(results.message.marks[0])
                                        .addClass("text-danger")
                                        .fadeIn(5000);
                                    setTimeout(() => {
                                        $(
                                            "#kt_modal_course_exam_update_form .form-message-error-marks"
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

    $("#kt_modal_course_exam_question_form").submit(function (e) {
        e.preventDefault();
        Swal.fire({
            title: "Are you sure?",
            text: "Do you want to submit the form?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, Submitted",
        }).then((result) => {
            if (result.isConfirmed) {
                let fd = new FormData();
                let CSRF_TOKEN = $('meta[name="csrf-token"]').attr("content");
                let link = $(this).attr("action");
                var text = new Array();
                let course_exam_id = $(
                    "#kt_modal_course_exam_question_form [name=course_exam_id]"
                ).val();
                let question_type = $(
                    "#kt_modal_course_exam_question_form [name=question_type]"
                ).val();

                let exam_date = $(
                    "#kt_modal_course_exam_question_form [name=exam_date]"
                ).val();

                let marks = $(
                    "#kt_modal_course_exam_question_form [name=marks]"
                ).val();
                let question_ans_checked = null;
                question_ans_checked = $(
                    "#kt_modal_course_exam_question_form [name='question_ans_checked']"
                );
                $(
                    "#kt_modal_course_exam_question_form [name='question_ans_checked']:checked"
                ).each(function () {
                    question_ans_checked = $(this).val();
                });

                let question = $(
                    "#kt_modal_course_exam_question_form [name=question]"
                ).val();

                let question_ans_one = $(
                    "#kt_modal_course_exam_question_form [name=question_ans_1]"
                ).val();

                let question_ans_two = $(
                    "#kt_modal_course_exam_question_form [name=question_ans_2]"
                ).val();

                let question_ans_three = $(
                    "#kt_modal_course_exam_question_form [name=question_ans_3]"
                ).val();

                let question_ans_four = $(
                    "#kt_modal_course_exam_question_form [name=question_ans_4]"
                ).val();

                fd.append("course_exam_id", course_exam_id);
                fd.append("question_type", question_type);
                fd.append("exam_date", exam_date);
                fd.append("marks", marks);
                fd.append("question_ans_checked", question_ans_checked);
                fd.append("question", question);
                fd.append("question_ans_1", question_ans_one);
                fd.append("question_ans_2", question_ans_two);
                fd.append("question_ans_3", question_ans_three);
                fd.append("question_ans_4", question_ans_four);
                fd.append("_token", CSRF_TOKEN);

                $.ajax({
                    type: "post",
                    data: fd,
                    dataType: "JSON",
                    cache: false,
                    contentType: false,
                    processData: false,
                    url: link,
                    success: function (results) {
                        if (results.success === true) {
                            swal.fire("Sucessfully added!", results.data);
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
                                console.log(results.message);
                                if (results.expired) {
                                    $(
                                        "#kt_modal_course_exam_question_form .form-message-error-expired"
                                    )
                                        .html(results.expired)
                                        .addClass("text-danger")
                                        .fadeIn(5000);
                                    setTimeout(() => {
                                        $(
                                            "#kt_modal_course_exam_question_form .form-message-error-expired"
                                        )
                                            .html("")
                                            .removeClass("text-danger")
                                            .fadeOut();
                                    }, 5000);
                                }
                                if (results.selectAns) {
                                    $(
                                        "#kt_modal_course_exam_question_form .form-message-error-selectAns"
                                    )
                                        .html(results.selectAns)
                                        .addClass("text-danger")
                                        .fadeIn(5000);
                                    setTimeout(() => {
                                        $(
                                            "#kt_modal_course_exam_question_form .form-message-error-selectAns"
                                        )
                                            .html("")
                                            .removeClass("text-danger")
                                            .fadeOut();
                                    }, 5000);
                                }

                                if (results.message.question) {
                                    $(
                                        "#kt_modal_course_exam_question_form .form-message-error-question"
                                    )
                                        .html(results.message.question[0])
                                        .addClass("text-danger")
                                        .fadeIn(5000);
                                    setTimeout(() => {
                                        $(
                                            "#kt_modal_course_exam_question_form .form-message-error-question"
                                        )
                                            .html("")
                                            .removeClass("text-danger")
                                            .fadeOut();
                                    }, 5000);
                                }
                                if (results.message.question_ans_checked) {
                                    $(
                                        "#kt_modal_course_exam_question_form .form-message-error-question_ans_checked"
                                    )
                                        .html(
                                            results.message
                                                .question_ans_checked[0]
                                        )
                                        .addClass("text-danger")
                                        .fadeIn(5000);
                                    setTimeout(() => {
                                        $(
                                            "#kt_modal_course_exam_question_form .form-message-error-question_ans_checked"
                                        )
                                            .html("")
                                            .removeClass("text-danger")
                                            .fadeOut();
                                    }, 5000);
                                }
                                if (results.message.question_ans_1) {
                                    $(
                                        "#kt_modal_course_exam_question_form .form-message-error-question_ans_1"
                                    )
                                        .html(results.message.question_ans_1[0])
                                        .addClass("text-danger")
                                        .fadeIn(5000);
                                    setTimeout(() => {
                                        $(
                                            "#kt_modal_course_exam_question_form .form-message-error-question_ans_1"
                                        )
                                            .html("")
                                            .removeClass("text-danger")
                                            .fadeOut();
                                    }, 5000);
                                }
                                if (results.message.question_ans_2) {
                                    $(
                                        "#kt_modal_course_exam_question_form .form-message-error-question_ans_2"
                                    )
                                        .html(results.message.question_ans_2[0])
                                        .addClass("text-danger")
                                        .fadeIn(5000);
                                    setTimeout(() => {
                                        $(
                                            "#kt_modal_course_exam_question_form .form-message-error-question_ans_2"
                                        )
                                            .html("")
                                            .removeClass("text-danger")
                                            .fadeOut();
                                    }, 5000);
                                }
                                if (results.message.question_ans_3) {
                                    $(
                                        "#kt_modal_course_exam_question_form .form-message-error-question_ans_3"
                                    )
                                        .html(results.message.question_ans_3[0])
                                        .addClass("text-danger")
                                        .fadeIn(5000);
                                    setTimeout(() => {
                                        $(
                                            "#kt_modal_course_exam_question_form .form-message-error-question_ans_3"
                                        )
                                            .html("")
                                            .removeClass("text-danger")
                                            .fadeOut();
                                    }, 5000);
                                }
                                if (results.message.question_ans_4) {
                                    $(
                                        "#kt_modal_course_exam_question_form .form-message-error-question_ans_4"
                                    )
                                        .html(results.message.question_ans_4[0])
                                        .addClass("text-danger")
                                        .fadeIn(5000);
                                    setTimeout(() => {
                                        $(
                                            "#kt_modal_course_exam_question_form .form-message-error-question_ans_4"
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

    $("#kt_modal_course_exam_question_update_form").submit(function (e) {
        e.preventDefault();
        Swal.fire({
            title: "Are you sure?",
            text: "Do you want to submit the form?",
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
                    "#kt_modal_course_exam_question_update #exam_question_id"
                ).val();

                let questionType = $(
                    "#kt_modal_course_exam_question_update #exam_question_type"
                ).val();

                let url = baseurl;

                $("#kt_modal_course_exam_question_update_form").attr(
                    "action",
                    url + "/exam-questions/" + id + "/update"
                );
                let link = $(this).attr("action");

                let question = $(
                    "#kt_modal_course_exam_question_update_form [name=question]"
                ).val();

                let question_ans_one = $(
                    "#kt_modal_course_exam_question_update_form [name=question_ans_1]"
                ).val();

                let question_ans_two = $(
                    "#kt_modal_course_exam_question_update_form [name=question_ans_2]"
                ).val();

                let question_ans_three = $(
                    "#kt_modal_course_exam_question_update_form [name=question_ans_3]"
                ).val();

                let question_ans_four = $(
                    "#kt_modal_course_exam_question_update_form [name=question_ans_4]"
                ).val();

                let question_ans_checked = null;
                question_ans_checked = $(
                    "#kt_modal_course_exam_question_update_form [name='question_ans_checked']"
                );
                $(
                    "#kt_modal_course_exam_question_update_form [name='question_ans_checked']:checked"
                ).each(function () {
                    question_ans_checked = $(this).val();
                });

                fd.append("question", question);
                fd.append("question_type", questionType);
                fd.append("question_ans_1", question_ans_one);
                fd.append("question_ans_2", question_ans_two);
                fd.append("question_ans_3", question_ans_three);
                fd.append("question_ans_4", question_ans_four);
                fd.append("question_ans_checked", question_ans_checked);
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
                    success: function (results) {
                        if (results.success === true) {
                            swal.fire("Sucessfully added!", results.data);
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
                                if (results.message.question) {
                                    $(
                                        "#kt_modal_course_exam_question_update_form .form-message-error-question"
                                    )
                                        .html(results.message.question[0])
                                        .addClass("text-danger")
                                        .fadeIn(5000);
                                    setTimeout(() => {
                                        $(
                                            "#kt_modal_course_exam_question_update_form .form-message-error-question"
                                        )
                                            .html("")
                                            .removeClass("text-danger")
                                            .fadeOut();
                                    }, 5000);
                                }
                                if (results.message.question_ans_1) {
                                    $(
                                        "#kt_modal_course_exam_question_update_form .form-message-error-question_ans_1"
                                    )
                                        .html(results.message.question_ans_1)
                                        .addClass("text-danger")
                                        .fadeIn(5000);
                                    setTimeout(() => {
                                        $(
                                            "#kt_modal_course_exam_question_update_form .form-message-error-question_ans_1"
                                        )
                                            .html("")
                                            .removeClass("text-danger")
                                            .fadeOut();
                                    }, 5000);
                                }
                                if (results.message.question_ans_2) {
                                    $(
                                        "#kt_modal_course_exam_question_update_form .form-message-error-question_ans_2"
                                    )
                                        .html(results.message.question_ans_2)
                                        .addClass("text-danger")
                                        .fadeIn(5000);
                                    setTimeout(() => {
                                        $(
                                            "#kt_modal_course_exam_question_update_form .form-message-error-question_ans_2"
                                        )
                                            .html("")
                                            .removeClass("text-danger")
                                            .fadeOut();
                                    }, 5000);
                                }
                                if (results.message.question_ans_3) {
                                    $(
                                        "#kt_modal_course_exam_question_update_form .form-message-error-question_ans_3"
                                    )
                                        .html(results.message.question_ans_3)
                                        .addClass("text-danger")
                                        .fadeIn(5000);
                                    setTimeout(() => {
                                        $(
                                            "#kt_modal_course_exam_question_update_form .form-message-error-question_ans_3"
                                        )
                                            .html("")
                                            .removeClass("text-danger")
                                            .fadeOut();
                                    }, 5000);
                                }
                                if (results.message.question_ans_4) {
                                    $(
                                        "#kt_modal_course_exam_question_update_form .form-message-error-question_ans_4"
                                    )
                                        .html(results.message.question_ans_4)
                                        .addClass("text-danger")
                                        .fadeIn(5000);
                                    setTimeout(() => {
                                        $(
                                            "#kt_modal_course_exam_question_update_form .form-message-error-question_ans_4"
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

    $("#kt_class_message_form").submit(function (e) {
        e.preventDefault();
        let fd = new FormData();
        let CSRF_TOKEN = $('meta[name="csrf-token"]').attr("content");
        let link = $(this).attr("action");
        let course_id = $("#kt_class_message_form [name=course_id]").val();
        let batch_id = $("#kt_class_message_form [name=batch_id]").val();
        let class_group_id = $(
            "#kt_class_message_form [name=class_group_id]"
        ).val();
        let class_message = $(
            "#kt_class_message_form [name=class_message]"
        ).val();
        let video_file = $("#kt_class_message_form [name=video_file]").val();
        let fileInputElement = document.getElementById("attached_file");
        let attached_file = fileInputElement.files[0];

        fd.append("attached_file", attached_file);
        fd.append("video_file", video_file);
        fd.append("course_id", course_id);
        fd.append("batch_id", batch_id);
        fd.append("messages", class_message);
        fd.append("class_group_id", class_group_id);
        fd.append("user_id", sender_id);
        fd.append("_token", CSRF_TOKEN);

        $.ajax({
            type: "post",
            data: fd,
            dataType: "JSON",
            cache: false,
            contentType: false,
            processData: false,
            url: link,
            success: function (results) {
                if (results.success === true) {
                    global_class_group_id = results.data.class_group_id;
                    $("#kt_class_message_form #attached_file").val("");
                    $("#kt_class_message_form #class_message").val("");
                    $("#kt_class_message_form #video_file").val("");

                    //loadGroupFeed();
                }
                if (results.error === true) {
                    if (results.message.attached_file) {
                        $("#kt_class_message_form #attached_file").val("");
                        var errors = "file validation Error Occurs!!";
                        swal.fire("", errors);
                    }
                }
            },
        });
    });

    $(document).on("click", ".userList", function () {
        let id = $(this).data("id");
        receiver_id = id;
        $("#kt_class_single_chat_form [name=sender_id]").val(sender_id);
        $("#kt_class_single_chat_form [name=receiver_id]").val(id);
        let batch_single_chat_id = $(
            "#kt_class_single_chat_form [name=batch_single_chat_id]"
        ).val();
        chat_group_id = batch_single_chat_id;
        $("#class_single_chat_image").html("");
        $("#kt_class_single_chat").html("");
        let url = baseurl;
        let url_link = url + "/users/" + id + "/find";
        $.ajax({
            type: "GET",
            url: url_link,
            data: {},
            success: function (results) {
                if (results.success === true) {
                    let user = results.data;
                    let html = "";
                    html =
                        `
                            <img class="mw-50px mw-lg-75px"
                                                src="` +
                        assetBaseUrl +
                        "upload/user_images/" +
                        user.photo_url +
                        `"alt="image" />
                                                <a href="#"class="fs-4 fw-bold text-gray-900 text-hover-primary me-1 mb-2 lh-1">` +
                        user.fname +
                        " " +
                        user.lname +
                        `</a>
                            `;

                    $("#class_single_chat_image").append(html);
                }
                if (results.success === false) {
                    let html = "Select Chat Person";
                    $("#class_single_chat_image").append(html);
                }
            },
        });

        loadOldChats();
    });

    $("#kt_class_single_chat_form").submit(function (e) {
        e.preventDefault();
        let fd = new FormData();
        let CSRF_TOKEN = $('meta[name="csrf-token"]').attr("content");
        let link = $(this).attr("action");
        let course_id = $("#kt_class_single_chat_form [name=course_id]").val();
        let batch_id = $("#kt_class_single_chat_form [name=batch_id]").val();
        let batch_single_chat_id = $(
            "#kt_class_single_chat_form [name=batch_single_chat_id]"
        ).val();
        let chat_message = $(
            "#kt_class_single_chat_form [name=chat_message]"
        ).val();
        let chat_sender_id = $(
            "#kt_class_single_chat_form [name=sender_id]"
        ).val();
        let chat_receiver_id = $(
            "#kt_class_single_chat_form [name=receiver_id]"
        ).val();

        fd.append("course_id", course_id);
        fd.append("batch_id", batch_id);
        fd.append("messages", chat_message);
        fd.append("batch_single_chat_id", batch_single_chat_id);
        fd.append("sender_id", chat_sender_id);
        fd.append("receiver_id", chat_receiver_id);
        fd.append("_token", CSRF_TOKEN);

        $.ajax({
            type: "post",
            data: fd,
            dataType: "JSON",
            cache: false,
            contentType: false,
            processData: false,
            url: link,
            success: function (results) {
                if (results.success === true) {
                    $("#kt_class_single_chat_form #chat_message").val("");
                    let chat = results.data;
                    if (
                        sender_id == chat.sender_id &&
                        receiver_id == chat.receiver_id &&
                        chat_group_id == chat.batch_single_chat_id
                    ) {
                        let html =
                            `
                        <!--begin::Message(out)-->
                                        <div class="d-flex justify-content-end mb-10" id="`+ chat.id + `-chat">
                                            <!--begin::Wrapper-->
                                            <div class="d-flex flex-column align-items-end">
                                                <!--begin::User-->
                                                <div class="d-flex align-items-center mb-2">
                                                    <!--begin::Details-->
                                                    <div class="me-3">
                                                        <span class="text-muted fs-7 mb-1">` +
                            chat.created_at +
                            `</span>
                                                        <a href="#"
                                                            class="fs-5 fw-bold text-gray-900 text-hover-primary ms-1">` +
                            chat.userName +
                            `</a>
                                                    </div>
                                                    <!--end::Details-->
                                                    <!--begin::Avatar-->
                                                    <div class="symbol symbol-35px symbol-circle">
                            <img alt="Pic" src="` +
                            assetBaseUrl +
                            "upload/user_images/" +
                            chat.userImage +
                            `" />
                        </div>
                                                    <!--end::Avatar-->
                                                </div>
                                                <!--end::User-->
                                                <!--begin::Text-->
                                                <div class="p-5 rounded bg-light-primary text-dark fw-semibold mw-lg-400px text-end"
                                                    data-kt-element="message-text">`+ chat.messages + `
                                                    <a href="#" class="btn btn-sm btn-icon btn-active-light-primary" data-id="`+ chat.id + `" id="delete-chat">
                                                        <i class="ki-duotone ki-dots-square fs-2">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                            <span class="path3"></span>
                                                            <span class="path4"></span>
                                                        </i>
                                                    </a>                                                   
                                                    
                                                </div>
                                                <!--end::Text-->
                                            </div>
                                            <!--end::Wrapper-->
                                        </div>
                        <!--end::Message(out)-->
                    `;

                        $("#kt_class_single_chat").append(html);
                    }
                } else {
                    if (results.error === true) {
                        var errors = "Validation Error Occurs!!";
                        swal.fire("", errors);
                    }

                    if (results.error === true) {
                        if (results.message.messages) {
                            $(
                                "#kt_class_single_chat_form .form-message-error-messages"
                            )
                                .html(results.message.messages[0])
                                .addClass("text-danger")
                                .fadeIn(5000);
                            setTimeout(() => {
                                $(
                                    "#kt_class_single_chat_form .form-message-error-messages"
                                )
                                    .html("")
                                    .removeClass("text-danger")
                                    .fadeOut();
                            }, 5000);
                        }
                        if (results.message.sender_id) {
                            $(
                                "#kt_class_single_chat_form .form-message-error-sender_id"
                            )
                                .html("Sender ID and Receiver ID is missing")
                                .addClass("text-danger")
                                .fadeIn(5000);
                            setTimeout(() => {
                                $(
                                    "#kt_class_single_chat_form .form-message-error-sender_id"
                                )
                                    .html("")
                                    .removeClass("text-danger")
                                    .fadeOut();
                            }, 5000);
                        }
                        if (results.message.receiver_id) {
                            $(
                                "#kt_class_single_chat_form .form-message-error-receiver_id"
                            )
                                .html("You have to select any person to chat")
                                .addClass("text-danger")
                                .fadeIn(5000);
                            setTimeout(() => {
                                $(
                                    "#kt_class_single_chat_form .form-message-error-receiver_id"
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
    });

    function loadOldChats() {
        let fd = new FormData();
        let CSRF_TOKEN = $('meta[name="csrf-token"]').attr("content");
        let url = baseurl;
        let url_link = url + "/course-classes/load-chat-message";
        fd.append("sender_id", sender_id);
        fd.append("receiver_id", receiver_id);
        fd.append("chat_group_id", chat_group_id);
        fd.append("_token", CSRF_TOKEN);
        $.ajax({
            url: url_link,
            type: "POST",
            data: {
                sender_id: sender_id,
                receiver_id: receiver_id,
                chat_group_id: chat_group_id,
                _token: CSRF_TOKEN,
            },
            success: function (res) {
                if (res.success) {
                    let chats = res.data;
                    let html = "";
                    for (let i = 0; i < chats.length; i++) {
                        let addClassJustifyContent = "";
                        let addClassAlignItems = "";
                        let addClassText = "";
                        let userImage = "";
                        let userName = "";
                        let headSection = ``;
                        let deleteSection = ``;

                        if (chats[i].sender_id == sender_id) {
                            addClassJustifyContent = "justify-content-end";
                            addClassAlignItems = "align-items-end";
                            addClassText = "text-end";
                            userImage = chats[i].senderImage;
                            userName = chats[i].senderName;
                            headSection =
                                `
                            <!--begin::User-->
                            <div class="d-flex align-items-center mb-2">
                                <!--begin::Details-->
                                <div class="me-3">
                                    <span class="text-muted fs-7 mb-1">` +
                                chats[i].created_at +
                                `</span>
                                    <a href="#"
                                        class="fs-5 fw-bold text-gray-900 text-hover-primary ms-1">` +
                                userName +
                                `</a>
                                </div>
                                <!--end::Details-->
                                <!--begin::Avatar-->
                                <div class="symbol symbol-35px symbol-circle">
                                    <img alt="Pic" src="` +
                                assetBaseUrl +
                                "upload/user_images/" +
                                userImage +
                                `" />
                                </div>
                                <!--end::Avatar-->
                            </div>
                            <!--end::User-->
                            `;
                            deleteSection =
                                `
                            <a href="#" class="btn btn-sm btn-icon btn-active-light-primary"
                                                        data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-id="`+ chats[i].id + `" id="delete-chat">
                                                        <i class="ki-duotone ki-dots-square fs-2">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                            <span class="path3"></span>
                                                            <span class="path4"></span>
                                                        </i>
                                                    </a>
                            `;
                        } else {
                            addClassJustifyContent = "justify-content-start";
                            addClassAlignItems = "align-items-start";
                            addClassText = "text-start";
                            userImage = chats[i].senderImage;
                            userName = chats[i].senderName;
                            headSection =
                                `
                            <!--begin::User-->
                            <div class="d-flex align-items-center mb-2">

                                <!--begin::Avatar-->
                                <div class="symbol symbol-35px symbol-circle">
                                    <img alt="Pic" src="` +
                                assetBaseUrl +
                                "upload/user_images/" +
                                userImage +
                                `" />
                                </div>
                                <!--end::Avatar-->
                                <!--begin::Details-->
                                <div class="me-3">
                                    <a href="#"
                                            class="fs-5 fw-bold text-gray-900 text-hover-primary ms-1">` +
                                userName +
                                `</a>
                                    <span class="text-muted fs-7 mb-1">` +
                                chats[i].created_at +
                                `</span>                                    
                                </div>
                                <!--end::Details-->
                            </div>
                            <!--end::User-->
                            `;
                        }

                        html +=
                            `
                        <!--begin::Message(Out)-->
                                        <div class="d-flex `+ addClassJustifyContent + ` mb-10" id="` + chats[i].id + `-chat">
                                            <!--begin::Wrapper-->
                                            <div class="d-flex flex-column ` +
                            addClassAlignItems +
                            `">
                                            ` +
                            headSection +
                            `
                                                <!--begin::Text-->
                                                <div class="p-5 rounded bg-light-primary text-dark fw-semibold mw-lg-400px ` +
                            addClassText +
                            `" 
                                                    data-kt-element="message-text">` +
                            chats[i].messages +
                            deleteSection +
                            `   
                                                </div>
                                                <!--end::Text-->                                                
                                            </div>
                                            <!--end::Wrapper-->
                                        </div>
                        <!--end::Message(In-Out)-->
                    `;
                    }

                    $("#kt_class_single_chat").append(html);
                }
            },
        });
    }

    $(document).on("click", "#delete-chat", function (e) {
        e.preventDefault();question_ans_checked = $(
            "#kt_modal_course_exam_question_update_form [name='question_ans_checked']"
        );
        let textMessage = $(this).parent().text();
        Swal.fire({
            title: "Are you sure? ",
            text: textMessage + " Delete This Data?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!",
        }).then((result) => {
            if (result.isConfirmed) {
                let id = $(this).attr("data-id");
                let url_link = baseurl + "/course-classes/" + id + "/delete";
                $.ajax({
                    type: "get",
                    url: url_link,
                    data: {},
                    dataType: "JSON",
                    success: function (results) {
                        if (results.success === true) {
                            $("#" + id + "-chat").remove();
                            swal.fire("Deleted!", results.msg);
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

    $("#kt_modal_course_class_evaluation_form").submit(function (e) {
        e.preventDefault();
        Swal.fire({
            title: "Are you sure?",
            text: "Do you want to submit the form?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, Submitted",
        }).then((result) => {
            if (result.isConfirmed) {
                let fd = new FormData();
                let CSRF_TOKEN = $('meta[name="csrf-token"]').attr("content");
                fd.append("_token", CSRF_TOKEN);

                let id = $(
                    "#kt_modal_course_class_evaluation_form #evalueation_id"
                ).val();

                if (id) {
                    $("#kt_modal_course_class_evaluation_form").attr(
                        "action",
                        baseurl + "/course-class-evaluetions/" + id + "/update"
                    );
                    fd.append("_method", "patch");
                } else {
                    $("#kt_modal_course_class_evaluation_form").attr(
                        "action",
                        baseurl + "/course-class-evaluetions/create"
                    );
                }

                let link = $(this).attr("action");

                let course_id = $(
                    "#kt_modal_course_class_evaluation_form [name=course_id]"
                ).val();
                let batch_id = $(
                    "#kt_modal_course_class_evaluation_form [name=batch_id]"
                ).val();
                let user_id = $(
                    "#kt_modal_course_class_evaluation_form [name=user_id]"
                ).val();
                let learning_goals = $(
                    "#kt_modal_course_class_evaluation_form [name='learning_goals']"
                ).val();

                let quality_of_instruction = $(
                    "#kt_modal_course_class_evaluation_form [name='quality_of_instruction']"
                ).val();question_ans_checked = $(
                    "#kt_modal_course_exam_question_update_form [name='question_ans_checked']"
                );

                let organized_course = $(
                    "#kt_modal_course_class_evaluation_form [name='organized_course']"
                ).val();

                let skills_knowledge_learn_improve = $(
                    "#kt_modal_course_class_evaluation_form [name='skills_knowledge_learn_improve']"
                ).val();

                let any_comments_about_course = $(
                    "#kt_modal_course_class_evaluation_form [name='any_comments_about_course']"
                ).val();

                fd.append("course_id", course_id);
                fd.append("batch_id", batch_id);
                fd.append("user_id", user_id);
                fd.append("batch_id", batch_id);
                fd.append(
                    "any_comments_about_course",
                    any_comments_about_course
                );
                fd.append(
                    "skills_knowledge_learn_improve",
                    skills_knowledge_learn_improve
                );
                fd.append("organized_course", organized_course);
                fd.append("quality_of_instruction", quality_of_instruction);
                fd.append("learning_goals", learning_goals);

                $.ajax({
                    type: "POST",
                    data: fd,
                    dataType: "JSON",
                    cache: false,
                    contentType: false,
                    processData: false,
                    url: link,
                    success: function (results) {
                        if (results.success === true) {
                            swal.fire("Sucessfully added!", results.data);
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
                                if (results.message.learning_goals) {
                                    $(
                                        "#kt_modal_course_class_evaluation_form .form-message-error-learning_goals"
                                    )
                                        .html(results.message.learning_goals[0])
                                        .addClass("text-danger")
                                        .fadeIn(5000);
                                    setTimeout(() => {
                                        $(
                                            "#kt_modal_course_class_evaluation_form .form-message-error-learning_goals"
                                        )
                                            .html("")
                                            .removeClass("text-danger")
                                            .fadeOut();
                                    }, 5000);
                                }
                                if (results.message.quality_of_instruction) {
                                    $(
                                        "#kt_modal_course_class_evaluation_form .form-message-error-quality_of_instruction"
                                    )
                                        .html(
                                            results.message
                                                .quality_of_instruction[0]
                                        )
                                        .addClass("text-danger")
                                        .fadeIn(5000);
                                    setTimeout(() => {
                                        $(
                                            "#kt_modal_course_class_evaluation_form .form-message-error-quality_of_instruction"
                                        )
                                            .html("")
                                            .removeClass("text-danger")
                                            .fadeOut();
                                    }, 5000);
                                }
                                if (results.message.organized_course) {
                                    $(
                                        "#kt_modal_course_class_evaluation_form .form-message-error-organized_course"
                                    )
                                        .html(
                                            results.message.organized_course[0]
                                        )
                                        .addClass("text-danger")
                                        .fadeIn(5000);
                                    setTimeout(() => {
                                        $(
                                            "#kt_modal_course_class_evaluation_form .form-message-error-organized_course"
                                        )
                                            .html("")
                                            .removeClass("text-danger")
                                            .fadeOut();
                                    }, 5000);
                                }
                                if (
                                    results.message
                                        .skills_knowledge_learn_improve
                                ) {
                                    $(
                                        "#kt_modal_course_class_evaluation_form .form-message-error-skills_knowledge_learn_improve"
                                    )
                                        .html(
                                            results.message
                                                .skills_knowledge_learn_improve[0]
                                        )
                                        .addClass("text-danger")
                                        .fadeIn(5000);
                                    setTimeout(() => {
                                        $(
                                            "#kt_modal_course_class_evaluation_form .form-message-error-skills_knowledge_learn_improve"
                                        )
                                            .html("")
                                            .removeClass("text-danger")
                                            .fadeOut();
                                    }, 5000);
                                }
                                if (results.message.any_comments_about_course) {
                                    $(
                                        "#kt_modal_course_class_evaluation_form .form-message-error-any_comments_about_course"
                                    )
                                        .html(
                                            results.message
                                                .any_comments_about_course[0]
                                        )
                                        .addClass("text-danger")
                                        .fadeIn(5000);
                                    setTimeout(() => {
                                        $(
                                            "#kt_modal_course_class_evaluation_form .form-message-error-any_comments_about_course"
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


    $(document).on("click", ".exam", function () {
        exam_exam_type = $(this).data('exam_type');
        exam_input_id = $(this).data('exam_id');
        $('#result-table').html('');
    });

    $(document).on("click", "#all-result", function (e) {
        e.preventDefault();
        let fd = new FormData();
        let CSRF_TOKEN = $('meta[name="csrf-token"]').attr("content");
        fd.append("_token", CSRF_TOKEN);
        let link = baseurl + "/course-classes-exam-result/";
        let key = $(this).data('key');
        fd.append("key", key);
        fd.append("exam_type", exam_exam_type);
        fd.append("exam_input_id", exam_input_id);

        $.ajax({
            type: "POST",
            data: fd,
            dataType: "JSON",
            cache: false,
            contentType: false,
            processData: false,
            url: link,
            success: function (results) {
                if (results.success === true) {
                    console.log(results.data);
                    $('#result-table').html();

                    let trHTML = '';
                    let tData = '';
                    $('#result-table').html('');
                    $.each(results.data, function (i, studentResult) {
                        i = i + 1;
                        tData +=
                            '<tr class="bg-gray-200 mt-5"><td class="pe-0 bg-gray-200 mt-5 "> <span class="ms-5">'
                            + i + ". " + studentResult.user['fname'] + " " + studentResult.user['lname']
                            + '</span> </td><td class="text-end fw-bold text-primary fs-4 ">'
                            + studentResult.answer_marks
                            + '</td><td> <a class="me-5 text-start" href="#"><i class="ki-duotone ki-eye fs-2"><i class="path1"></i><i class="path2"></i><i class="path3"></i></i> </a></td></tr>';

                    });

                    trHTML = `<!--begin::Table container-->
                        <div class="table-responsive mb-8">
                            <!--begin::Table-->
                            <table class="table align-middle gs-0 gy-4 my-0  " style=" border-radius: 10px;overflow: hidden;" >
                                <!--begin::Table head-->
                                <thead class="mb-7 bg-gray-400 p-5" >
                                    <tr class="" >
                                        <th class="min-w-175px "><b class="ms-5">Student Name </b></th>
                                        <th class="w-40px "><b class="ms-10">Marks</b></th>
                                        <th class="w-40px"><b></b></th>
                                    </tr>
                                </thead>
                                <!--end::Table head-->
                                <!--begin::Table body-->
                                <tbody>
                                    `+ tData + `
                                </tbody>
                                <!--end::Table body-->
                            </table>
                            <!--end::Table-->
                        </div>
                        <!--end::Table container-->
                        <!--begin::Summary-->
                        <div class="d-flex flex-stack bg-success rounded-3 p-6 mb-11">
                            <!--begin::Content-->
                            <div class="fs-6 fw-bold text-white">
                                <span class="d-block lh-1 mb-2">Pass</span>
                                <span class="d-block mb-2">Fail</span>
                                <span class="d-block fs-2qx lh-1">Total Student</span>
                            </div>
                            <!--end::Content-->
                            <!--begin::Content-->
                            <div class="fs-6 fw-bold text-white text-end">
                                <span class="d-block lh-1 mb-2" data-kt-pos-element="total">50%</span>
                                <span class="d-block mb-2" data-kt-pos-element="discount">50%</span>
                                <span class="d-block fs-2qx lh-1"
                                    data-kt-pos-element="grant-total">35</span>
                            </div>
                            <!--end::Content-->
                        </div>
                        <!--end::Summary-->`



                    $('#result-table').append(trHTML);

                } else {
                    if (results.error === true) {
                        var errors = " Error Occurs!!";
                        swal.fire("", errors);
                    }

                    if (results.error === true) {
                    }
                }
            },
        });
    });


    $(document).on("click", "#my-result", function (e) {
        e.preventDefault();
        let fd = new FormData();
        let CSRF_TOKEN = $('meta[name="csrf-token"]').attr("content");
        fd.append("_token", CSRF_TOKEN);
        let link = baseurl + "/course-classes-exam-result/";        
        let key = $(this).data('key');
        let user_id = $(this).data('user_id');
        let pdf_link = baseurl + "/course-classes-exam-result/pdfview/"+user_id+"/"+exam_exam_type+"/"+exam_input_id;
        fd.append("key", key);
        fd.append("user_id", user_id);
        fd.append("exam_type", exam_exam_type);
        fd.append("exam_input_id", exam_input_id);
        $.ajax({
            type: "POST",
            data: fd,
            dataType: "JSON",
            cache: false,
            contentType: false,
            processData: false,
            url: link,
            success: function (results) {
                if (results.success === true) {
                    console.log(results.data);
                    $('#result-table').html();

                    let trHTML = '';
                    let tData = '';
                    $('#result-table').html('');
                    $.each(results.data, function (i, studentResult) {
                        i = i + 1;
                        tData +=
                            '<tr class="bg-gray-200 mt-5" style="border-top: 2px solid #B5B5C3;"><td class="pe-0 bg-gray-200 mt-5 questionData ps-5"> <span class="">'
                            + i + ". " + studentResult.question['question']
                            + '</span></td><td id="markData" class="text-end fw-bold text-primary fs-4" style="text-align:right;"> <span class="me-5">'
                            + studentResult.answer_marks
                            + '</span></td></tr>';

                    });

                    trHTML = `<!--begin::Table container-->
                        <div class="table-responsive mb-8">
                           <div class="d-flex flex-row justify-content-between">
                
                                  <h3 id="userName">`+ results.data[0].user['fname'] + " " + results.data[0].user['lname'] + `</h3>
                               
                                <div class="d-flex flex-row" >
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3 passingPDF">
                                        <a id="kt_result_report_views_export_menu" href="`+pdf_link+`" class="menu-link px-3">PDF</a>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a  id="printButtonMarks" class="menu-link px-3">Print</a>

                                    </div>
                                    <!--end::Menu item-->
                                </div>
                            </div>
                    
                            <!--begin::Table-->
                            <table class="table align-middle gs-0 gy-4 my-0" style="border-radius:10px; width:100%; overflow: hidden;" id="myTableMarks">
                                <!--begin::Table head-->
                                <thead class="mb-7 bg-gray-400 p-5">
                                    <tr>
                                        <th class="min-w-175px questionName"><b class="ms-5">Question</b></th>
                                        <th class="w-60px pe-5" style="text-align:right;"><b>Marks</b></th>
                                    </tr>
                                </thead>
                                <!--end::Table head-->
                                <!--begin::Table body-->
                                <tbody>
                                    `+ tData + `
                                </tbody>
                                <!--end::Table body-->
                            </table>
                            <!--end::Table-->
                        </div>
                        <!--end::Table container-->
                        <!--begin::Summary-->
                        <div class="d-flex flex-stack bg-success rounded-3 p-6 mb-11">
                            <!--begin::Content-->
                            <div class="fs-6 fw-bold text-white">
                                <span class="d-block lh-1 mb-2">Pass</span>
                                <span class="d-block mb-2">Fail</span>
                                <span class="d-block fs-2qx lh-1">Total Student</span>
                            </div>
                            <!--end::Content-->
                            <!--begin::Content-->
                            <div class="fs-6 fw-bold text-white text-end">
                                <span class="d-block lh-1 mb-2" data-kt-pos-element="total">50%</span>
                                <span class="d-block mb-2" data-kt-pos-element="discount">50%</span>
                                <span class="d-block fs-2qx lh-1"
                                    data-kt-pos-element="grant-total">35</span>
                            </div>
                            <!--end::Content-->
                        </div>
                        <!--end::Summary-->`



                    $('#result-table').append(trHTML);

                } else {
                    if (results.error === true) {
                        var errors = " Error Occurs!!";
                        swal.fire("", errors);
                    }

                    if (results.error === true) {
                    }
                }
            },
        });
    });
    //Result Print 
    $(document).on("click", "#printButtonMarks", function (e) {
        e.preventDefault();
        printSelectedMarks();

    });

  

    function printSelectedMarks() {
        const myTableContent = $("#myTableMarks")[0].outerHTML;
        const userName = $("#userName").text();

        // Create a new window for printing
        const printWindow = window.open('', '');
        if (printWindow) {
            printWindow.document.write('<html><head><title>Training Management System</title>');

            // Add custom CSS for text alignment
            printWindow.document.write('<style> body { text-align:center!important; } #myTableMarks{ margin: 0 auto; font-size:25px; } .questionData{padding-right:80px !important;} .questionName{padding-right:120px !important; text-align:left;} </style>');
            printWindow.document.write('</head><body>');
            printWindow.document.write('<h1 class="">Exam Question With Marks </h1>');
            printWindow.document.write('<h2>Student Name: ' + userName + '</h1>');
            printWindow.document.write('<div class="separator separator-dashed" style="border: 1px dashed #EAEBF0; margin-top:5px;"></div>');
            printWindow.document.write('<h3>' + myTableContent + '</h3>');
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.focus();

            // Delay the window close after printing (adjust the time as needed)
            setTimeout(function () {
                printWindow.print();
                printWindow.close();
            }, 1000);
        }
    }



    $("#notifications_form").submit(function (e) {
        e.preventDefault();
        Swal.fire({
            title: "Are you sure?",
            text: "Do you want to submit the form?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, Submitted",
        }).then((result) => {
            if (result.isConfirmed) {
                let fd = new FormData();
                let CSRF_TOKEN = $('meta[name="csrf-token"]').attr("content");
                let link = $(this).attr("action");
                let course_id = $(
                    "#notifications_form [name=course_id]"
                ).val();
                let batch_id = $(
                    "#notifications_form [name=batch_id]"
                ).val();
                let district_id = $(
                    "#notifications_form [name=district_id]"
                ).val();
                let location_id = $(
                    "#notifications_form [name=location_id]"
                ).val();
                let notification_type = $("#notifications_form [name=notification_type]").val();
                let notification_message = $(
                    "#notifications_form [name=notification_message]"
                ).val();

                fd.append("district_id", district_id);
                fd.append("location_id", location_id);
                fd.append("course_id", course_id);
                fd.append("batch_id", batch_id);
                fd.append("notification_type", notification_type);
                fd.append("notification_message", notification_message);
                fd.append("_token", CSRF_TOKEN);

                $.ajax({
                    type: "post",
                    data: fd,
                    dataType: "JSON",
                    cache: false,
                    contentType: false,
                    processData: false,
                    url: link,
                    success: function (results) {
                        if (results.success === true) {
                            swal.fire("Sucessfully added!", results.data);
                        } else {
                            if (results.error === true) {
                                var errors = "Validation Error Occurs!!";
                                swal.fire("", errors);
                            }

                            if (results.error === true) {
                                if (results.message.notification_type) {
                                    $(
                                        "#notifications_form .form-message-error-notification_type"
                                    )
                                        .html(results.message.notification_type[0])
                                        .addClass("text-danger")
                                        .fadeIn(5000);
                                    setTimeout(() => {
                                        $(
                                            "#notifications_form .form-message-error-notification_type"
                                        )
                                            .html("")
                                            .removeClass("text-danger")
                                            .fadeOut();
                                    }, 5000);
                                }
                                if (results.message.notification_message) {
                                    $(
                                        "#notifications_form .form-message-error-notification_message"
                                    )
                                        .html(results.message.notification_message[0])
                                        .addClass("text-danger")
                                        .fadeIn(5000);
                                    setTimeout(() => {
                                        $(
                                            "#notifications_form .form-message-error-notification_message"
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





    // Function to toggle tab content visibility
    function toggleTabContent(tab) {
        $(".activeTab, .inactiveTab").hide();
        $("#" + tab + "Content").show();
    }

    // Handle tab clicks
    $("#onlineBtn, #offlineBtn").on("click", function (e) {
        e.preventDefault();
        var tab = $(this).attr("id").replace("Btn", "");
        toggleTabContent(tab);

        // Toggle active class on buttons
        $(".nav-group .btn").removeClass("active");
        $(this).addClass("active");
    });

    $("#kt_datepicker_8").flatpickr({
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
    });

    $("#kt_datepicker_exam_time").flatpickr({
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
    });

    $("#kt_datepicker_time").flatpickr({
        enableTime: true,
        noCalendar: true,
        formatTime: "H:i",
    });

    // This sample still does not showcase all CKEditor 5 features (!)
    // Visit https://ckeditor.com/docs/ckeditor5/latest/features/index.html to browse all the features.
    ClassicEditor.create(document.getElementById("body"), {
        // https://ckeditor.com/docs/ckeditor5/latest/features/toolbar/toolbar.html#extended-toolbar-configuration-format
        toolbar: {
            items: [
                "exportPDF",
                "exportWord",
                "|",
                "findAndReplace",
                "selectAll",
                "|",
                "heading",
                "|",
                "bold",
                "italic",
                "strikethrough",
                "underline",
                "code",
                "subscript",
                "superscript",
                "removeFormat",
                "|",
                "bulletedList",
                "numberedList",
                "todoList",
                "|",
                "outdent",
                "indent",
                "|",
                "undo",
                "redo",
                "-",
                "fontSize",
                "fontFamily",
                "fontColor",
                "fontBackgroundColor",
                "highlight",
                "|",
                "alignment",
                "|",
                "link",
                "insertImage",
                "blockQuote",
                "insertTable",
                "mediaEmbed",
                "codeBlock",
                "htmlEmbed",
                "|",
                "specialCharacters",
                "horizontalLine",
                "pageBreak",
                "|",
                "textPartLanguage",
                "|",
                "sourceEditing",
            ],
            shouldNotGroupWhenFull: true,
        },
        // Changing the language of the interface requires loading the language file using the <script> tag.
        // language: 'es',
        list: {
            properties: {
                styles: true,
                startIndex: true,
                reversed: true,
            },
        },
        // https://ckeditor.com/docs/ckeditor5/latest/features/headings.html#configuration
        heading: {
            options: [
                {
                    model: "paragraph",
                    title: "Paragraph",
                    class: "ck-heading_paragraph",
                },
                {
                    model: "heading1",
                    view: "h1",
                    title: "Heading 1",
                    class: "ck-heading_heading1",
                },
                {
                    model: "heading2",
                    view: "h2",
                    title: "Heading 2",
                    class: "ck-heading_heading2",
                },
                {
                    model: "heading3",
                    view: "h3",
                    title: "Heading 3",
                    class: "ck-heading_heading3",
                },
                {
                    model: "heading4",
                    view: "h4",
                    title: "Heading 4",
                    class: "ck-heading_heading4",
                },
                {
                    model: "heading5",
                    view: "h5",
                    title: "Heading 5",
                    class: "ck-heading_heading5",
                },
                {
                    model: "heading6",
                    view: "h6",
                    title: "Heading 6",
                    class: "ck-heading_heading6",
                },
            ],
        },
        // https://ckeditor.com/docs/ckeditor5/latest/features/editor-placeholder.html#using-the-editor-configuration
        placeholder: "",
        // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-family-feature
        fontFamily: {
            options: [
                "default",
                "Arial, Helvetica, sans-serif",
                "Courier New, Courier, monospace",
                "Georgia, serif",
                "Lucida Sans Unicode, Lucida Grande, sans-serif",
                "Tahoma, Geneva, sans-serif",
                "Times New Roman, Times, serif",
                "Trebuchet MS, Helvetica, sans-serif",
                "Verdana, Geneva, sans-serif",
            ],
            supportAllValues: true,
        },
        // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-size-feature
        fontSize: {
            options: [10, 12, 14, "default", 18, 20, 22],
            supportAllValues: true,
        },
        // Be careful with the setting below. It instructs CKEditor to accept ALL HTML markup.
        // https://ckeditor.com/docs/ckeditor5/latest/features/general-html-support.html#enabling-all-html-features
        htmlSupport: {
            allow: [
                {
                    name: /.*/,
                    attributes: true,
                    classes: true,
                    styles: true,
                },
            ],
        },
        // Be careful with enabling previews
        // https://ckeditor.com/docs/ckeditor5/latest/features/html-embed.html#content-previews
        htmlEmbed: {
            showPreviews: true,
        },
        // https://ckeditor.com/docs/ckeditor5/latest/features/link.html#custom-link-attributes-decorators
        link: {
            decorators: {
                addTargetToExternalLinks: true,
                defaultProtocol: "https://",
                toggleDownloadable: {
                    mode: "manual",
                    label: "Downloadable",
                    attributes: {
                        download: "file",
                    },
                },
            },
        },
        // https://ckeditor.com/docs/ckeditor5/latest/features/mentions.html#configuration
        mention: {
            feeds: [
                {
                    marker: "@",
                    feed: [
                        "@apple",
                        "@bears",
                        "@brownie",
                        "@cake",
                        "@cake",
                        "@candy",
                        "@canes",
                        "@chocolate",
                        "@cookie",
                        "@cotton",
                        "@cream",
                        "@cupcake",
                        "@danish",
                        "@donut",
                        "@dragée",
                        "@fruitcake",
                        "@gingerbread",
                        "@gummi",
                        "@ice",
                        "@jelly-o",
                        "@liquorice",
                        "@macaroon",
                        "@marzipan",
                        "@oat",
                        "@pie",
                        "@plum",
                        "@pudding",
                        "@sesame",
                        "@snaps",
                        "@soufflé",
                        "@sugar",
                        "@sweet",
                        "@topping",
                        "@wafer",
                    ],
                    minimumCharacters: 1,
                },
            ],
        },
        // The "super-build" contains more premium features that require additional configuration, disable them below.
        // Do not turn them on unless you read the documentation and know how to configure them and setup the editor.
        removePlugins: [
            // These two are commercial, but you can try them out without registering to a trial.
            // 'ExportPdf',
            // 'ExportWord',
            "CKBox",
            "CKFinder",
            "EasyImage",
            // This sample uses the Base64UploadAdapter to handle image uploads as it requires no configuration.
            // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/base64-upload-adapter.html
            // Storing images as Base64 is usually a very bad idea.
            // Replace it on production website with other solutions:
            // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/image-upload.html
            // 'Base64UploadAdapter',
            "RealTimeCollaborativeComments",
            "RealTimeCollaborativeTrackChanges",
            "RealTimeCollaborativeRevisionHistory",
            "PresenceList",
            "Comments",
            "TrackChanges",
            "TrackChangesData",
            "RevisionHistory",
            "Pagination",
            "WProofreader",
            // Careful, with the Mathtype plugin CKEditor will not load when loading this sample
            // from a local file system (file://) - load this site via HTTP server if you enable MathType.
            "MathType",
            // The following features are part of the Productivity Pack and require additional license.
            "SlashCommand",
            "Template",
            "DocumentOutline",
            "FormatPainter",
            "TableOfContents",
        ],
    });

    ClassicEditor.create(document.getElementById("edit_body"), {
        // https://ckeditor.com/docs/ckeditor5/latest/features/toolbar/toolbar.html#extended-toolbar-configuration-format
        toolbar: {
            items: [
                "exportPDF",
                "exportWord",
                "|",
                "findAndReplace",
                "selectAll",
                "|",
                "heading",
                "|",
                "bold",
                "italic",
                "strikethrough",
                "underline",
                "code",
                "subscript",
                "superscript",
                "removeFormat",
                "|",
                "bulletedList",
                "numberedList",
                "todoList",
                "|",
                "outdent",
                "indent",
                "|",
                "undo",
                "redo",
                "-",
                "fontSize",
                "fontFamily",
                "fontColor",
                "fontBackgroundColor",
                "highlight",
                "|",
                "alignment",
                "|",
                "link",
                "insertImage",
                "blockQuote",
                "insertTable",
                "mediaEmbed",
                "codeBlock",
                "htmlEmbed",
                "|",
                "specialCharacters",
                "horizontalLine",
                "pageBreak",
                "|",
                "textPartLanguage",
                "|",
                "sourceEditing",
            ],
            shouldNotGroupWhenFull: true,
        },
        // Changing the language of the interface requires loading the language file using the <script> tag.
        // language: 'es',
        list: {
            properties: {
                styles: true,
                startIndex: true,
                reversed: true,
            },
        },
        // https://ckeditor.com/docs/ckeditor5/latest/features/headings.html#configuration
        heading: {
            options: [
                {
                    model: "paragraph",
                    title: "Paragraph",
                    class: "ck-heading_paragraph",
                },
                {
                    model: "heading1",
                    view: "h1",
                    title: "Heading 1",
                    class: "ck-heading_heading1",
                },
                {
                    model: "heading2",
                    view: "h2",
                    title: "Heading 2",
                    class: "ck-heading_heading2",
                },
                {
                    model: "heading3",
                    view: "h3",
                    title: "Heading 3",
                    class: "ck-heading_heading3",
                },
                {
                    model: "heading4",
                    view: "h4",
                    title: "Heading 4",
                    class: "ck-heading_heading4",
                },
                {
                    model: "heading5",
                    view: "h5",
                    title: "Heading 5",
                    class: "ck-heading_heading5",
                },
                {
                    model: "heading6",
                    view: "h6",
                    title: "Heading 6",
                    class: "ck-heading_heading6",
                },
            ],
        },
        // https://ckeditor.com/docs/ckeditor5/latest/features/editor-placeholder.html#using-the-editor-configuration
        placeholder: "",
        // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-family-feature
        fontFamily: {
            options: [
                "default",
                "Arial, Helvetica, sans-serif",
                "Courier New, Courier, monospace",
                "Georgia, serif",
                "Lucida Sans Unicode, Lucida Grande, sans-serif",
                "Tahoma, Geneva, sans-serif",
                "Times New Roman, Times, serif",
                "Trebuchet MS, Helvetica, sans-serif",
                "Verdana, Geneva, sans-serif",
            ],
            supportAllValues: true,
        },
        // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-size-feature
        fontSize: {
            options: [10, 12, 14, "default", 18, 20, 22],
            supportAllValues: true,
        },
        // Be careful with the setting below. It instructs CKEditor to accept ALL HTML markup.
        // https://ckeditor.com/docs/ckeditor5/latest/features/general-html-support.html#enabling-all-html-features
        htmlSupport: {
            allow: [
                {
                    name: /.*/,
                    attributes: true,
                    classes: true,
                    styles: true,
                },
            ],
        },
        // Be careful with enabling previews
        // https://ckeditor.com/docs/ckeditor5/latest/features/html-embed.html#content-previews
        htmlEmbed: {
            showPreviews: true,
        },
        // https://ckeditor.com/docs/ckeditor5/latest/features/link.html#custom-link-attributes-decorators
        link: {
            decorators: {
                addTargetToExternalLinks: true,
                defaultProtocol: "https://",
                toggleDownloadable: {
                    mode: "manual",
                    label: "Downloadable",
                    attributes: {
                        download: "file",
                    },
                },
            },
        },
        // https://ckeditor.com/docs/ckeditor5/latest/features/mentions.html#configuration
        mention: {
            feeds: [
                {
                    marker: "@",
                    feed: [
                        "@apple",
                        "@bears",
                        "@brownie",
                        "@cake",
                        "@cake",
                        "@candy",
                        "@canes",
                        "@chocolate",
                        "@cookie",
                        "@cotton",
                        "@cream",
                        "@cupcake",
                        "@danish",
                        "@donut",
                        "@dragée",
                        "@fruitcake",
                        "@gingerbread",
                        "@gummi",
                        "@ice",
                        "@jelly-o",
                        "@liquorice",
                        "@macaroon",
                        "@marzipan",
                        "@oat",
                        "@pie",
                        "@plum",
                        "@pudding",
                        "@sesame",
                        "@snaps",
                        "@soufflé",
                        "@sugar",
                        "@sweet",
                        "@topping",
                        "@wafer",
                    ],
                    minimumCharacters: 1,
                },
            ],
        },
        // The "super-build" contains more premium features that require additional configuration, disable them below.
        // Do not turn them on unless you read the documentation and know how to configure them and setup the editor.
        removePlugins: [
            // These two are commercial, but you can try them out without registering to a trial.
            // 'ExportPdf',
            // 'ExportWord',
            "CKBox",
            "CKFinder",
            "EasyImage",
            // This sample uses the Base64UploadAdapter to handle image uploads as it requires no configuration.
            // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/base64-upload-adapter.html
            // Storing images as Base64 is usually a very bad idea.
            // Replace it on production website with other solutions:
            // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/image-upload.html
            // 'Base64UploadAdapter',
            "RealTimeCollaborativeComments",
            "RealTimeCollaborativeTrackChanges",
            "RealTimeCollaborativeRevisionHistory",
            "PresenceList",
            "Comments",
            "TrackChanges",
            "TrackChangesData",
            "RevisionHistory",
            "Pagination",
            "WProofreader",
            // Careful, with the Mathtype plugin CKEditor will not load when loading this sample
            // from a local file system (file://) - load this site via HTTP server if you enable MathType.
            "MathType",
            // The following features are part of the Productivity Pack and require additional license.
            "SlashCommand",
            "Template",
            "DocumentOutline",
            "FormatPainter",
            "TableOfContents",
        ],
    });
});

