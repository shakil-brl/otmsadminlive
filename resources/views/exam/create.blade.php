@extends('layouts.auth-master')

@section('content')
    @isset($result)
        <div class="m-5">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between border p-5">
                        <p class="fw-semibold fs-6">Batch Code: {{ $result['batchCode'] ?? '' }}</p>
                        <p class="fw-semibold fs-6">Location: {{ $result['GEOLocation'] ?? '' }}</p>
                        <p class="fw-semibold fs-6">Training Title:
                            {{ $result['get_training']['title']['Name'] ?? '' }}</p>
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
                        $default_date = '';
                        if (isset($exam_config['exam_date'])) {
                            if ($exam_config['exam_date']) {
                                $default_date = \Carbon\Carbon::createFromFormat(
                                    'Y-m-d',
                                    $exam_config['exam_date'],
                                )->format('d/m/Y');
                            }
                        }
                    @endphp

                    <div class="mt-5 border p-5">
                        @if (count($result['trainees']) > 0)
                            <form action="{{ route('exam.store') }}" method="POST">
                                @csrf
                                <div class="mb-5">
                                    <div class="d-flex justify-content-between mb-3 fw-semibold">
                                        <p>Exam Title: {{ $exam_config['exam_title'] }}</p>
                                        <p>Total Mark: {{ $exam_config['total_mark'] }}</p>
                                        <p>Pass Mark: {{ $exam_config['pass_mark'] }}</p>
                                    </div>

                                    <label for="exact_exam_date">Exact Exam Date:</label>
                                    <input type="date" class="form-control" name="exact_exam_date" id="exact_exam_date"
                                        placeholder="Select exam taken date">
                                </div>
                                <div>
                                    <p class="text-danger">*** প্রশিক্ষনার্থীর নম্বর প্রদান না করিলে অনুপস্থিত হিসেবে গৃহীত হইবে</p>
                                </div>
                                <h6>Trainee List:</h6>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="max-width: 35px">S.N.</th>
                                            <th>Name</th>
                                            <th class="text-center">Marks</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($result['trainees'] as $trainee)
                                            <tr>
                                                <td style="max-width: 35px">{{ $loop->iteration }}.</td>
                                                <td>{{ $trainee['profile']['KnownAs'] }}</td>
                                                <td class="d-flex align-items-center gap-5">
                                                    <input type="number" name="obtained_marks[]"
                                                        class="form-control w-50 mx-auto" id="input-{{ $trainee['id'] }}"
                                                        max="{{ $exam_config['total_mark'] }}" min="0">
                                                    <div>
                                                        <input type="hidden" name="training_batch_id"
                                                            value="{{ $result['id'] }}">
                                                        <input type="hidden" name="exam_config_id"
                                                            value="{{ $exam_config['id'] }}">
                                                        <input type="hidden" name="trainees[]" value="{{ $trainee['id'] }}">
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="text-center mt-5">
                                    <button class="btn btn-md btn-success d-none submit-btn" id="submit-btn">Submit</button>
                                </div>
                            </form>
                        @else
                            <p class="text-danger">No Trainee Found</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endisset
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            $("input[name='obtained_marks[]']").on('input', function() {
                toggleSubmitButtonVisibility();
            });

            let starDate = "{{ $default_date ?? '' }}";
            let dateFromatJson = {
                dateFormat: "d/m/Y",
                onChange: function(selectedDates, dateStr, instance) {
                    toggleSubmitButtonVisibility();
                }
            };

            @if (isset($default_date))
                @if ($default_date != '')
                    dateFromatJson['defaultDate'] = starDate;
                @endif
            @endif

            $("#exact_exam_date").flatpickr(dateFromatJson);

            function toggleSubmitButtonVisibility() {
                let hasInputValue = false;

                $("input[name='obtained_marks[]']").each(function() {
                    if ($(this).val() !== '') {
                        hasInputValue = true;
                        return false; // Exit the loop early since we found at least one input with a value
                    }
                });

                let hasExamDate = $("#exact_exam_date").val();

                if (hasInputValue && hasExamDate) {
                    $("#submit-btn").removeClass("d-none");
                } else {
                    $("#submit-btn").addClass("d-none");
                }
            }

            $(document).on("click", ".submit-btn", function(e) {
                e.preventDefault();
                const form = $(this).closest('form');

                Swal.fire({
                    title: "Are you sure?",
                    text: "Do you want to submit the form?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, submit!",
                    cancelButtonText: "No, cancel!",
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
@endpush
