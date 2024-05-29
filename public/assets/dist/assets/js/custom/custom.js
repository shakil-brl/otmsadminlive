$(function () {
    $(".LocationSearch").on("change", function (e) {
        var dist_id = $(this).val();
        let url_link = baseurl + "/ajax/locations/" + dist_id;
        $.ajax({
            url: url_link,
            type: "GET",
            data: {},
            success: function (data) {
                if (data.data.length === 0) {
                    $(
                        "#district_location_course_batch_search #location_search option"
                    ).remove();
                } else {
                    $(
                        "#district_location_course_batch_search #location_search option"
                    ).remove();
                    $(
                        "#district_location_course_batch_search #location_search"
                    ).append($("<option value=''>Select a Locations</option>"));
                    $.each(data.data, function (index, value) {
                        $(
                            "#district_location_course_batch_search #location_search"
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

    $(".courseSearch").on("change", function (e) {
        var dist_id = $(this).val();
        let url_link = baseurl + "/ajax/get-courses/" + dist_id;
        $(
            "#district_location_course_batch_search #batch_search option"
        ).remove();
        $.ajax({
            url: url_link,
            type: "GET",
            data: {},
            success: function (data) {
                console.log(data);
                if (data.data.length === 0) {
                    $(
                        "#district_location_course_batch_search #course_search option"
                    ).remove();
                } else {
                    $(
                        "#district_location_course_batch_search #course_search option"
                    ).remove();
                    $(
                        "#district_location_course_batch_search #course_search"
                    ).append($("<option value=''>Select a Locations</option>"));
                    $.each(data.data, function (index, value) {
                        $(
                            "#district_location_course_batch_search #course_search"
                        ).append(
                            $("<option/>", {
                                value: value.course.id,
                                text:
                                    "Name: " +
                                    value.course.course_name +
                                    " - " +
                                    "Code: " +
                                    value.course.course_code,
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
                console.log(data);
                if (data.data.length === 0) {
                    $(
                        "#district_location_course_batch_search #batch_search option"
                    ).remove();
                } else {
                    $(
                        "#district_location_course_batch_search #batch_search option"
                    ).remove();
                    $(
                        "#district_location_course_batch_search #batch_search"
                    ).append($("<option value=''>Select a Batches</option>"));
                    $.each(data.data, function (index, value) {
                        $(
                            "#district_location_course_batch_search #batch_search"
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

    $("#kt_modal_course_student_evaluation_form").submit(function (e) {
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
                //alert(link);
                
                let course_id = $(
                    "#kt_modal_course_student_evaluation_form [name=course_id]"
                ).val();
                let batch_id = $(
                    "#kt_modal_course_student_evaluation_form [name=batch_id]"
                ).val();

                let performance = $(
                    "#kt_modal_course_student_evaluation_form [name=performance]"
                ).val();

                let skills_knowledge_learn_improve = $(
                    "#kt_modal_course_student_evaluation_form [name=skills_knowledge_learn_improve]"
                ).val();

                let any_comments_about_student = $(
                    "#kt_modal_course_student_evaluation_form [name=any_comments_about_student]"
                ).val();
                
                let user_id = $("#kt_modal_course_student_evaluation_form [name='user_id[]']:checked").map(function(){return $(this).val();}).get();

             

                fd.append("course_id", course_id);
                fd.append("batch_id", batch_id);
                fd.append("performance", performance);
                fd.append("skills_knowledge_learn_improve", skills_knowledge_learn_improve);
                fd.append("any_comments_about_student", any_comments_about_student);
                fd.append("user_id", user_id);
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
                                if (results.message.user_id) {
                                    $(
                                        "#kt_modal_course_student_evaluation_form .form-message-error-user_id"
                                    )
                                        .html(results.message.user_id[0])
                                        .addClass("text-danger")
                                        .fadeIn(5000);
                                    setTimeout(() => {
                                        $(
                                            "#kt_modal_course_student_evaluation_form .form-message-error-user_id"
                                        )
                                            .html("")
                                            .removeClass("text-danger")
                                            .fadeOut();
                                    }, 5000);
                                }
                                if (results.message.performance) {
                                    $(
                                        "#kt_modal_course_student_evaluation_form .form-message-error-performance"
                                    )
                                        .html(results.message.performance[0])
                                        .addClass("text-danger")
                                        .fadeIn(5000);
                                    setTimeout(() => {
                                        $(
                                            "#kt_modal_course_student_evaluation_form .form-message-error-performance"
                                        )
                                            .html("")
                                            .removeClass("text-danger")
                                            .fadeOut();
                                    }, 5000);
                                }
                                if (results.message.skills_knowledge_learn_improve) {
                                    $(
                                        "#kt_modal_course_student_evaluation_form .form-message-error-skills_knowledge_learn_improve"
                                    )
                                        .html(results.message.skills_knowledge_learn_improve[0])
                                        .addClass("text-danger")
                                        .fadeIn(5000);
                                    setTimeout(() => {
                                        $(
                                            "#kt_modal_course_student_evaluation_form .form-message-error-skills_knowledge_learn_improve"
                                        )
                                            .html("")
                                            .removeClass("text-danger")
                                            .fadeOut();
                                    }, 5000);
                                }
                                if (results.message.any_comments_about_student) {
                                    $(
                                        "#kt_modal_course_student_evaluation_form .form-message-error-any_comments_about_student"
                                    )
                                        .html(results.message.any_comments_about_student[0])
                                        .addClass("text-danger")
                                        .fadeIn(5000);
                                    setTimeout(() => {
                                        $(
                                            "#kt_modal_course_student_evaluation_form .form-message-error-any_comments_about_student"
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
});
