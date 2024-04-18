@extends('layouts.auth-master')

@section('content')
    @isset($result)
        <div class="m-5">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between border p-5">
                        <p class="fw-semibold fs-6">Batch Code: {{ old('batchCode', $result['batchCode'] ?? '') }}</p>
                        <p class="fw-semibold fs-6">Location: {{ old('GEOLocation', $result['GEOLocation'] ?? '') }}</p>
                        <p class="fw-semibold fs-6">Training Title:
                            {{ old('training_title', $result['get_training']['title']['Name'] ?? '') }}</p>
                    </div>

                    <div class="mt-5">

                        @if (count($result['trainees']) > 0)
                            <form action="{{ route('exam.store') }}" method="POST">
                                @csrf
                                <div class="mb-5">
                                    <label for="exact_exam_date">Exact Exam Date:</label>
                                    <input type="date" class="form-control" name="exact_exam_date" id="exact_exam_date"
                                        placeholder="Select exam taken date">
                                </div>
                                <h6>Trainee List:</h6>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="max-width: 35px">S.N.</th>
                                            <th>Name</th>
                                            <th>Mark</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($result['trainees'] as $trainee)
                                            <tr>
                                                <td style="max-width: 35px">{{ $loop->iteration }}.</td>
                                                <td>{{ $trainee['profile']['KnownAs'] }}</td>
                                                <td class="d-flex align-items-center gap-5">
                                                    <input type="number" name="obtained_mark[]" class="form-control w-50"
                                                        id="input-{{ $trainee['id'] }}">
                                                    <div>
                                                        <input type="hidden" name="training_batch_id"
                                                            value="{{ $result['id'] }}">
                                                        <input type="hidden" name="exam_config_id"
                                                            value="{{ $exam_config_id }}">
                                                        <input type="hidden" name="trainees[]" value="{{ $trainee['id'] }}">
                                                        <input type="checkbox" name="exam_absent[]"
                                                            class="form-check-input exam-absent"
                                                            traineeId="{{ $trainee['id'] }}">
                                                        <label for="exam-absent" class="form-check-label text-danger">Mark as
                                                            absent</label>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="text-center mt-5">
                                    <button class="btn btn-md btn-success d-none" id="submit-btn">Submit</button>
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
            $(".exam-absent").click(function(e) {
                let eValue = $(this).attr('traineeId');
                let inputId = `input-${eValue}`;
                let targetInput = $("#" + inputId);

                if ($(this).is(":checked")) {
                    targetInput.prop('disabled', true);
                    targetInput.val('');
                } else {
                    targetInput.prop('disabled', false);
                    targetInput.val('');
                }

                toggleSubmitButtonVisibility();
            });

            $("input[name='obtained_mark[]']").on('input', function() {
                toggleSubmitButtonVisibility();
            });

            $("#exact_exam_date").flatpickr({
                dateFormat: "d/m/Y",
                onChange: function(selectedDates, dateStr, instance) {
                    toggleSubmitButtonVisibility();
                }
            });

            function toggleSubmitButtonVisibility() {
                let hasInputValue = false;

                $("input[name='obtained_mark[]']").each(function() {
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
        });
    </script>
@endpush
