@extends('layouts.auth-master')

@section('content')

    <div class="m-5">
        <h3>{{ __('dashboard.all_trainer') }}</h3>
        <x-alert />
        @isset($total_trainers)
            <div class="my-3">
                <form action="">
                    <div class="w-50 d-flex gap-3">
                        <input type="search" name="search" value="{{ request('search') }}" class="form-control w-75"
                            placeholder="{{ __('dashboard.search_here') }}">
                        <input type="submit" class="form-control btn btn-primary w-25" value="{{ __('dashboard.search') }}">
                    </div>
                </form>
            </div>
            <table class="table table-bordered bg-white">
                <thead>
                    <th>{{ __('dashboard.sl') }}</th>
                    <th>ID-Name</th>
                    <th>Email-NID</th>
                    <th>Phone</th>
                    @if (strtolower($userRole) !== 'provider')
                        <th>Provider</th>
                    @endif
                    <th>Batch</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                    @if (count($total_trainers) > 0)
                        @foreach (collect($total_trainers) as $trainers)
                            <tr>
                                <td>
                                    {{ digitLocale($from + $loop->index) }}
                                </td>
                                <td class="">
                                    <div>
                                        Trainer ID: {{ $trainers['id'] }}
                                    </div>
                                    <div>
                                        Name: {{ $trainers['profile']['KnownAs'] }}
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        Email: {{ $trainers['profile']['Email'] }}
                                    </div>
                                    <div>
                                        NID: {{ $trainers['profile']['NID'] }}
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        {{ $trainers['profile']['Phone'] }}
                                    </div>
                                    <div>
                                        {{ $trainers['profile']['Phone2'] ?? '' }}
                                    </div>
                                </td>
                                @if (strtolower($userRole) !== 'provider')
                                    <td>
                                        {{ $trainers['provider_trainers'][0]['provider']['name'] }}
                                    </td>
                                @endif
                                <td>
                                    @foreach ($trainers['provider_trainers'] as $batch)
                                        <div>
                                            {{ $batch['training_batch']['batchCode'] }}
                                        </div>
                                    @endforeach
                                </td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-info show-action"
                                        data-trainer-enroll-id="{{ $trainers['id'] }}" data-bs-toggle="modal"
                                        id="view_trainer_modal_btn" data-bs-target="#view_trainer_modal">
                                        {{ __('upazila-list.view') }}
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="7">No data found</td>
                        </tr>
                    @endif
                </tbody>
            </table>

            {!! $paginator->links() !!}
        @endisset
    </div>

    <!--Start::Trainer Details Modal-->
    <div class="modal fade" id="view_trainer_modal" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-950px">
            <div class="modal-content">
                <div class="modal-header" id="kt_modal_update_provider_header">
                    <!--begin::Modal title-->
                    <h2 class="fw-bold" id="">Trainer Details</h2>
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
                <div class="modal-body scroll-y mx-5 mx-xl-18 pt-0 pb-15">
                    <!--begin::Heading-->
                    <div class="text-center mb-5" id="trainer-modal-header">
                        <h3 class="mt-3" id="trainer-name"></h3>
                        <div class="fw-semibold fs-5">{{ __('trainer-enrollment-list.provider_name') }}:
                            <span class="mb-3" id="provider-name"></span>
                        </div>
                        <div class="fw-semibold fs-5">{{ __('trainer-enrollment-list.email') }}:
                            <span id="trainer-email"></span>
                        </div>
                        <div class="fw-semibold fs-5">{{ __('trainer-enrollment-list.phone') }}:
                            <span id="trainer-phone"></span>
                        </div>
                        <div class="fw-semibold fs-5">{{ __('trainer-enrollment-list.address') }}:
                            <span id="trainer-address"></span>
                        </div>
                    </div>
                    <!--end::Heading-->
                    <!--begin::Users-->
                    <div class="mb-5" id="trainer-batches-list">
                        <!--begin::List-->
                        <div>
                            <h4 class="">Batches:</h4>
                        </div>
                        <div class="mh-375px scroll-y me-n7 pe-7">

                        </div>
                        <!--end::List-->
                    </div>
                    <!--end::Users-->
                    <!--begin::Actions-->
                    <div class="text-center">
                        <a href="#" type="reset" data-bs-dismiss="modal" class="btn btn-light me-3"
                            data-kt-users-modal-action="cancel">{{ __('trainer-enrollment-list.discard') }}</a>
                    </div>
                    <!--end::Actions-->
                </div>
            </div>
        </div>
    </div>
    <!--End::Trainer Details Modal-->
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            // show provider batches
            $(document).on("click", "#view_trainer_modal_btn", function(e) {
                e.preventDefault();
                let trainerBatchesList = $("#trainer-batches-list");
                let trainerModalHeader = $("#trainer-modal-header");

                let id = $(this).attr("data-trainer-enroll-id");
                let link = api_baseurl + "trainer-enroll/" + id + "/show";

                $.ajax({
                    type: "get",
                    dataType: "JSON",
                    url: link,
                    headers: {
                        Authorization: authToken,
                    },
                    success: function(results) {
                        let enrollData = results.data;
                        $("#view_trainer_modal #trainer-name").html((enrollData.profile
                            .KnownAs ?? "") + " (" + (enrollData.profile
                            .KnownAsBangla ?? "") + ")");
                        $("#view_trainer_modal #provider-name").html(enrollData
                            .provider_trainers[0]
                            .provider.name ?? "");
                        $("#view_trainer_modal #trainer-email").html(enrollData.profile
                            .Email ?? "");
                        $("#view_trainer_modal #trainer-phone").html(enrollData.profile
                            .Phone ?? "");
                        $("#view_trainer_modal #trainer-address").html(
                            enrollData.profile.address ?? ""
                        );

                        let trainingBatches = enrollData.provider_trainers;
                        sessionStorage.removeItem("message");

                        if (trainingBatches && trainingBatches.length > 0) {
                            let tableContent = `
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Code</th>
                                            <th>Training Title</th>
                                            <th>${locations}</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                            `;

                            trainingBatches.forEach(batch => {
                                let detals_href = `/batches/${batch.id}`;

                                let tableRow = `
                                    <tr>
                                        <td>${batch.training_batch.batchCode ?? ""}</td>
                                        <td>${batch.training_batch.training.title.NameEn ?? ""}</td>
                                        <td>${batch.training_batch.GEOLocation ?? ""}</td>
                                        <td>
                                            <a href="${detals_href}" target="_blank" class="btn btn-sm btn-primary">Details</a>
                                        </td>
                                    </tr>
                                `;

                                tableContent += tableRow;
                            });

                            tableContent += `
                                    </tbody>
                                </table>
                            `;

                            trainerBatchesList.html(tableContent);
                        } else {
                            trainerBatchesList.html(`
                                <div class="d-flex flex-stack py-5 border-bottom border-gray-300 border-bottom-dashed text-warning">
                                    No Batch Found
                                </div>
                            `);
                        }

                    },
                    error: function(xhr, status, error) {
                        // Handle errors here details
                        console.error(xhr, status, error);
                    },
                });
            });
        });
    </script>
@endpush
