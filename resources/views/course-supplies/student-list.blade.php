@extends('layouts.auth-master')
@push('css')
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined:opsz,wght,FILL,GRAD@48,700,0,0"
        rel="stylesheet">
@endpush
@section('content')
    <div class="card m-5">
        @if (isset($batch_details) && isset($combo))
            <div class="card-header border-0 pt-6">
                <div class="card-title w-100">
                    <div class="fw-bold">
                        Batch Code: {{ $batch_details['batchCode'] }}
                    </div>
                </div>
            </div>
            <x-alert />
            @if (session('error_message'))
                <ul class="m-0 text-danger">
                    @foreach (session('error_message') ?? [] as $neme => $err)
                        @foreach ($err as $e)
                            <li>
                                {{ $e }}
                            </li>
                        @endforeach
                    @endforeach
                </ul>
            @endif
            @php
                $hasDistributeId = false;

                foreach ($batch_details['trainees'] as $trainee) {
                    if (isset($trainee['material_allocations']) && is_array($trainee['material_allocations'])) {
                        foreach ($trainee['material_allocations'] as $allocation) {
                            if ($allocation['combo_id'] == $combo['id']) {
                                $distributedDate = \Carbon\Carbon::createFromFormat(
                                    'Y-m-d',
                                    $allocation['distribution_date'],
                                )->format('d/m/Y');
                                $hasDistributeId = true;
                                break 2;
                            }
                        }
                    }
                }
            @endphp

            <div class="card-body py-4">
                @if (!$hasDistributeId)
                    <div>
                        <p class="text-danger fw-bold">
                            *** এখনও বিতরণ করা হয়নি।
                        </p>
                    </div>
                @endif
                @if ($batch_details['trainees'])
                    <form action="{{ route('course-supplies.allocation') }}" method="POST">
                        @csrf
                        <div class="row row-cols-2">
                            <div class="col">
                                <label for="distribution_date" class="form-label">Date:</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <span class="material-icons-outlined">
                                            calendar_month
                                        </span>
                                    </span>
                                    @if (in_array('course-supplies.allocation', $roleRoutePermissions))
                                        <input type="text" class="form-control" id="distribution_date"
                                            name="distribution_date">
                                    @else
                                        <input type="text" class="form-control" id="distribution_date"
                                            name="distribution_date" disabled>
                                    @endif
                                </div>
                                @error('distribution_date')
                                    <small class="text-danger d-block">{{ $message }}</small>
                                @enderror
                            </div>
                            <input type="hidden" name="batch_id" value="{{ $batch_details['id'] }}">
                            <div class="col">
                                <label for="combo_id" class="form-label">Combo:</label>
                                @if (in_array('course-supplies.allocation', $roleRoutePermissions))
                                    <select name="combo_id" id="combo_id" class="form-control">
                                        <option value="{{ $combo['id'] }}" selected>{{ $combo['name'] }}</option>
                                    </select>
                                @else
                                    <select name="combo_id" id="combo_id" class="form-control" disabled>
                                        <option value="{{ $combo['id'] }}" selected>{{ $combo['name'] }}</option>
                                    </select>
                                @endif
                                @error('combo_id')
                                    <small class="text-danger d-block">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <h3 class="mt-5">Trainee List</h3>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>S.N.</th>
                                    <th>Name</th>
                                    <th>Email-NID</th>
                                    <th>Phone</th>
                                    <th class="d-flex align-item-center gap-2 justify-content-center">
                                        <label for="selectAll">Distribute</label>
                                        @if (!$hasDistributeId && in_array('course-supplies.allocation', $roleRoutePermissions))
                                            @if (in_array('course-supplies.supply', $roleRoutePermissions))
                                                <input type="checkbox" id="selectAll" class="form-check-input">
                                            @endif
                                        @endif
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (collect($batch_details['trainees']) as $trainee)
                                    <tr>
                                        <td>{{ $loop->iteration }}.</td>
                                        <td>
                                            <div>
                                                English: {{ $trainee['profile']['KnownAs'] ?? '' }}
                                            </div>
                                            <div>
                                                Bangla: {{ $trainee['profile']['KnownAsBangla'] ?? '' }}
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                Email: {{ $trainee['profile']['Email'] ?? '' }}
                                            </div>
                                            <div>
                                                NID: {{ $trainee['profile']['NID'] ?? '' }}
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                Phone: {{ $trainee['profile']['Phone'] ?? '' }}
                                            </div>
                                            <div>
                                                Phone-2: {{ $trainee['profile']['Phone2'] ?? '' }}
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            @php
                                                $materialIds = [];
                                                if (count($trainee['material_allocations']) > 0) {
                                                    foreach ($trainee['material_allocations'] as $key => $value) {
                                                        array_push($materialIds, $value['combo_id']);
                                                    }
                                                }
                                            @endphp

                                            @if (count($materialIds) > 0 &&
                                                    in_array($combo['id'], $materialIds) &&
                                                    !in_array('course-supplies.distributed-list', $roleRoutePermissions))
                                                <input class="trainee form-check-input" name="training_applicant_ids[]"
                                                    value="{{ $trainee['id'] }}" id="att{{ $loop->iteration }}"
                                                    type="checkbox" checked>
                                            @else
                                                @if (in_array('course-supplies.distributed-list', $roleRoutePermissions))
                                                    <input class="trainee form-check-input" name="training_applicant_ids[]"
                                                        value="{{ $trainee['id'] }}" id="att{{ $loop->iteration }}"
                                                        type="checkbox" disabled>
                                                @else
                                                    <input class="trainee form-check-input" name="training_applicant_ids[]"
                                                        value="{{ $trainee['id'] }}" id="att{{ $loop->iteration }}"
                                                        type="checkbox">
                                                @endif
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @error('training_applicant_ids')
                            <small class="text-danger d-block">{{ $message }}</small>
                        @enderror
                        @if (in_array('course-supplies.allocation', $roleRoutePermissions))
                            <div class="text-center">
                                <button class="btn btn-success btn-lg sumbit-form" type="submit">
                                    Sumbit
                                </button>
                            </div>
                        @endif
                    </form>
                @endif
            </div>
        @endif
    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            $("#selectAll").click(function() {
                if ($(this).prop('checked')) {
                    $('.trainee').prop('checked', true);
                } else {
                    $('.trainee').prop('checked', false);
                }
            });
        });

        // $("#distribution_date").flatpickr({
        //     dateFormat: "d/m/Y",
        // });

        let oldDistributionDate = @json($distributedDate ?? old('distribution_date'));
        $("#distribution_date").flatpickr({
            dateFormat: "d/m/Y",
            defaultDate: [oldDistributionDate]
        });

        $(document).on("click", ".sumbit-form", function(e) {
            e.preventDefault();
            const form = $(this).closest('form');

            Swal.fire({
                title: "Are you sure?",
                text: "This will submit the form!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, sumbit!",
                cancelButtonText: "No, cancel!",
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    </script>
@endpush
