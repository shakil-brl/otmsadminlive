$(function () {
    $(document).ready(function () {
        // let authToken = authToken;
        $("#kt_modal_store_batch_schedule_form").submit(function (e) {
            e.preventDefault();
            Swal.fire({
                title: areYouSure,
                text: wantCreateSchedule,
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: yesCreate,
                cancelButtonText: noCancel,
            }).then((result) => {
                if (result.isConfirmed) {
                    let fd = new FormData();
                    let CSRF_TOKEN = $('meta[name="csrf-token"]').attr(
                        "content"
                    );
                    let link = api_baseurl + "batch-schedule/create";

                    let training_id = $(
                        "#kt_modal_store_batch_schedule_form [name=training_id]"
                    ).val();
                    let training_batch_id = $(
                        "#kt_modal_store_batch_schedule_form [name=training_batch_id]"
                    ).val();
                    let provider_id = $(
                        "#kt_modal_store_batch_schedule_form [name=provider_id]"
                    ).val();
                    let class_time = $(
                        "#kt_modal_store_batch_schedule_form [name=class_time]"
                    ).val();
                    let class_duration = $(
                        "#kt_modal_store_batch_schedule_form [name=class_duration]"
                    ).val();

                    let week = "";
                    let saturday = $(
                        "#kt_modal_store_batch_schedule_form [name='saturday']"
                    );
                    $(
                        "#kt_modal_store_batch_schedule_form [name='saturday']:checked"
                    ).each(function () {
                        week += $(this).val() + ",";
                    });

                    let sunday = $(
                        "#kt_modal_store_batch_schedule_form [name='sunday']"
                    );
                    $(
                        "#kt_modal_store_batch_schedule_form [name='sunday']:checked"
                    ).each(function () {
                        week += $(this).val() + ",";
                    });

                    let monday = $(
                        "#kt_modal_store_batch_schedule_form [name='monday']"
                    );
                    $(
                        "#kt_modal_store_batch_schedule_form [name='monday']:checked"
                    ).each(function () {
                        week += $(this).val() + ",";
                    });

                    let tuesday = $(
                        "#kt_modal_store_batch_schedule_form [name='tuesday']"
                    );
                    $(
                        "#kt_modal_store_batch_schedule_form [name='tuesday']:checked"
                    ).each(function () {
                        week += $(this).val() + ",";
                    });

                    let wednesday = $(
                        "#kt_modal_store_batch_schedule_form [name='wednesday']"
                    );
                    $(
                        "#kt_modal_store_batch_schedule_form [name='wednesday']:checked"
                    ).each(function () {
                        week += $(this).val() + ",";
                    });

                    let thusday = $(
                        "#kt_modal_store_batch_schedule_form [name='thursday']"
                    );
                    $(
                        "#kt_modal_store_batch_schedule_form [name='thursday']:checked"
                    ).each(function () {
                        week += $(this).val() + ",";
                    });

                    let friday = $(
                        "#kt_modal_store_batch_schedule_form [name='friday']"
                    );
                    $(
                        "#kt_modal_store_batch_schedule_form [name='friday']:checked"
                    ).each(function () {
                        week += $(this).val() + ",";
                    });
                    if (week != "") {
                        week = week.slice(0, -1);
                    }

                    fd.append("training_id", training_id);
                    fd.append("training_batch_id", training_batch_id);
                    fd.append("provider_id", provider_id);
                    fd.append("class_time", class_time);
                    fd.append("class_duration", class_duration);
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
                        headers: {
                            Authorization: authToken,
                            "X-localization": language,
                        },
                        success: function (results) {
                            if (results.success === true) {
                                swal.fire(successfullyCreate, results.data);
                                // refresh page after 2 seconds
                                setTimeout(function () {
                                    location.reload();
                                }, 2000);
                            } else {
                                if (results.error === true) {
                                    var errors =  ValidationError;
                                    swal.fire("", errors);
                                }

                                if (results.error === true) {
                                    if (results.message.class_duration) {
                                        $(
                                            "#kt_modal_store_batch_schedule_form .form-message-error-class_duration"
                                        )
                                            .html(
                                                results.message
                                                    .class_duration[0]
                                            )
                                            .addClass("text-danger")
                                            .fadeIn(5000);
                                        setTimeout(() => {
                                            $(
                                                "#kt_modal_store_batch_schedule_form .form-message-error-class_duration"
                                            )
                                                .html("")
                                                .removeClass("text-danger")
                                                .fadeOut();
                                        }, 5000);
                                    }
                                    if (results.message.class_time) {
                                        $(
                                            "#kt_modal_store_batch_schedule_form .form-message-error-class_time"
                                        )
                                            .html(results.message.class_time[0])
                                            .addClass("text-danger")
                                            .fadeIn(5000);
                                        setTimeout(() => {
                                            $(
                                                "#kt_modal_store_batch_schedule_form .form-message-error-class_time"
                                            )
                                                .html("")
                                                .removeClass("text-danger")
                                                .fadeOut();
                                        }, 5000);
                                    }
                                    if (results.message.class_days) {
                                        $(
                                            "#kt_modal_store_batch_schedule_form .form-message-error-class_days"
                                        )
                                            .html(results.message.class_days[0])
                                            .addClass("text-danger")
                                            .fadeIn(5000);
                                        setTimeout(() => {
                                            $(
                                                "#kt_modal_store_batch_schedule_form .form-message-error-class_days"
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
});
