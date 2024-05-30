@extends('layouts.auth-master')
{{-- @dump($total_batches) --}}
@section('content')
    <!--begin::Content -->
    <div class="m-5">
        <h3>{{ __('batch-list.total_batches') }}</h3>
        <x-alert />
        @isset($total_batches)
            <div class="my-3">
                <form action="">
                    <div class="w-50 d-flex gap-3">
                        <input type="search" name="search" value="{{ request('search') }}" class="form-control w-75"
                            placeholder="{{ __('batch-list.search_here') }}">
                        <input type="submit" class="form-control btn btn-primary w-25" value="{{ __('batch-list.search') }}">
                    </div>
                </form>
            </div>

            <table class="table table-bordered bg-white">
                <thead>
                    <th>{{ __('batch-list.sl') }}</th>
                    <th>{{ __('batch-list.batch_code') }}</th>
                    <th>{{ __('batch-list.course_name') }}</th>
                    <th>{{ __('batch-list.location') }}</th>
                    <th>{{ __('batch-list.start_date') }}</th>
                    <th>{{ __('batch-list.total_class') }}</th>
                    <th>Trainer List</th>
                    <th>{{ __('batch-list.action') }}</th>
                </thead>
                <tbody>
                    @foreach (collect($total_batches) as $batch)
                        <tr>
                            <td>
                                {{ $page_from + $loop->iteration - 1 }}
                            </td>
                            <td>
                                {{ $batch['batchCode'] }}
                            </td>
                            <td>
                                {{ $batch['get_training'] ? $batch['get_training']['title']['Name'] : '' }}
                            </td>
                            <td>
                                {{ $batch['GEOLocation'] }}
                            </td>
                            <td>
                                {{ $batch['startDate'] }}
                            </td>
                            <td>
                                {{ $batch['duration'] }} {{ __('batch-list.days') }}
                            </td>
                            <td>
                                @if (count($batch['provider_trainers']) > 0)
                                    <ol>
                                        @foreach ($batch['provider_trainers'] as $batchTraineer)
                                            <li>{{ $batchTraineer['profile'] ? $batchTraineer['profile']['KnownAs'] : '' }}
                                            </li>
                                        @endforeach
                                    </ol>
                                @endif
                            </td>
                            <td>
                                @php
                                    $trainersIds = [];

                                    if (count($batch['provider_trainers']) > 0) {
                                        foreach ($batch['provider_trainers'] as $trainer) {
                                            if (isset($trainer['profile']['id'])) {
                                                $trainersIds[] = $trainer['profile']['id'];
                                            }
                                        }
                                    }

                                    $trainersIdsString = implode(',', $trainersIds);
                                @endphp
                                <a id="link-trainer-with-batches-modal" data-batch-id="{{ $batch['id'] }}"
                                    data-provider-id="{{ $batch['provider_id'] }}"
                                    data-batch-trainers="{{ $trainersIdsString ?? '' }}" class="btn btn-sm fw-bold btn-success"
                                    data-bs-toggle="modal" data-bs-target="#link_trainers_batches">
                                    Enroll Trainer
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {!! $paginator->links() !!}
        @endisset
    </div>

    <!--begin::Modal - link trainers-->
    <div class="modal fade" id="link_trainers_batches" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-950px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <div class="modal-header" id="kt_modal_update_trainer_header">
                    <!--begin::Modal title-->
                    <h2 class="fw-bold">{{ __('batch-schedule.tariner_link_batch') }}</h2>
                    <!--end::Modal title-->
                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                        <i class="ki-duotone ki-cross fs-1">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                    </div>
                    <!--end::Close-->
                </div>
                <!--begin::Provider added Form-->
                <form id="link_trainers_form" method="post" class="form m-7" action="">
                    @csrf
                    <!--begin::Scroll-->
                    <div class="d-flex flex-column scroll-y me-n7 pe-7">
                        <input type="hidden" name="batch-id">
                        <input type="hidden" name="provider-id">
                        <!--start::Input group-->
                        <div class="fv-row mb-7">
                            <label
                                class="col-form-label text-right col-lg-3 col-sm-12">{{ __('batch-schedule.triner_list') }}</label>
                            <div class="col">
                                <select class="form-control select2" id="kt_select2_3" multiple="multiple">

                                </select>
                                <span class="form-message-error-trainer_ids">

                                </span>
                            </div>
                        </div>
                        <!--end::Input group-->
                        <div class='separator separator-dashed my-2'></div>
                    </div>
                    <!--end::Scroll-->
                    <!--begin::Actions-->
                    <div class="text-center pt-15">
                        <a href="#" type="reset" data-bs-dismiss="modal" class="btn btn-light me-3"
                            data-kt-users-modal-action="cancel">{{ __('provider-list.discard') }}</a>
                        <button type="submit" class="btn btn-primary">
                            <span class="indicator-label">{{ __('provider-list.submit') }}</span>
                            <span class="indicator-progress">Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                    </div>
                    <!--end::Actions-->
                </form>
                <!--Provider added end::Form-->
            </div>
        </div>
    </div>
    <!--end::Modal - link trainers-->
@endsection
@section('scripts')
    <script>
        $(function() {
            $(document).ready(function() {
                // link trainer with batches modal open
                let selectValues = [];
                $(document).on(
                    "click",
                    "#link-trainer-with-batches-modal",
                    function(e) {
                        // search load data aa
                        let api_link = api_baseurl + "trainers";
                        let id = $(this).attr("data-batch-id");
                        let provider_id = $(this).attr("data-provider-id");
                        let batch_trainers = $(this).attr("data-batch-trainers");
                        trainersSelector = $("#link_trainers_form #kt_select2_3");
                        trainersSelector.empty();
                        $("#link_trainers_form [name=batch-id]").val(id);
                        $("#link_trainers_form [name=provider-id]").val(provider_id);
                        let selectedIdsStored = populateTrainerEnrollOption(api_link, authToken,
                            trainersSelector,
                            batch_trainers);

                        const $select = $("#link_trainers_form #kt_select2_3");
                        selectValues = batch_trainers.split(',');
                        $select.on("change", function() {
                            selectValues = $select.val();
                            // console.log(selectValues);
                        });
                        console.log(selectValues);
                        // Class definition
                        var KTSelect3 = (function() {
                            // Private functions
                            var demos = function() {
                                // multi select
                                $("#kt_select2_3").select2({
                                    placeholder: 'Select Trainer'
                                });
                            };

                            // Public functions
                            return {
                                init: function() {
                                    demos();
                                },
                            };
                        })();

                        // Initialization
                        jQuery(document).ready(function() {
                            KTSelect3.init();
                        });
                    }
                );

                // Trainer link batches form submit
                $("#link_trainers_form").submit(function(e) {
                    e.preventDefault();

                    let fd = new FormData();
                    let CSRF_TOKEN = $('meta[name="csrf-token"]').attr("content");
                    let link = api_baseurl + "trainer-enroll/store";

                    let batchId = $("#link_trainers_form [name=batch-id]").val();
                    let trainerIds = selectValues;

                    fd.append("trainer_ids", trainerIds);
                    fd.append("batch_id", batchId);
                    fd.append("_token", CSRF_TOKEN);

                    $.ajax({
                        type: "post",
                        data: fd,
                        processData: false,
                        contentType: false,
                        dataType: "JSON",
                        url: link,
                        headers: {
                            Authorization: authToken,
                            "X-localization": language,
                        },
                        success: function(results) {
                            console.log(results);
                            if (results.success === true) {
                                swal.fire(yes, results.message);

                                sessionStorage.setItem("message", results.message);
                                sessionStorage.setItem("alert-type", "info");

                                // refresh page after 2 seconds
                                setTimeout(function() {
                                    location.reload();
                                }, 2000);
                            } else {
                                if (results.error === true) {
                                    var errors = results.message;
                                    swal.fire(ValidationError, errors);
                                }

                                if (results.error === true) {
                                    if (results.message) {
                                        $(
                                                "#link_trainers_form .form-message-error-trainer_ids"
                                            )
                                            .html(results.message)
                                            .addClass("text-danger")
                                            .fadeIn(5000);
                                        setTimeout(() => {
                                            $(
                                                    "#link_trainers_form .form-message-error-trainer_ids"
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
            });
        });
    </script>
@endsection
