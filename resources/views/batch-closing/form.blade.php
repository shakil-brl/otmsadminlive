<div>
    <input type="hidden" name="training_batch_id" value="{{ $batch['id'] }}">

    @if ($batch_closing)
        <input type="hidden" name="action" value="update">
        <input type="hidden" name="batch_closing_id" value="{{ $batch_closing['id'] }}">
    @endif
</div>
<div class="row row-cols-2 g-4 border p-5">
    <div class="d-flex">
        <div class="form-check mb-4">
            <input class="form-check-input" type="checkbox" id="is_class_completed" name="is_class_completed"
                {{ (isset($batch_closing['is_class_completed']) && $batch_closing['is_class_completed'] == 1) || old('is_class_completed') == 'on' ? 'checked' : '' }}>
        </div>
        <label class="form-label" for="is_class_completed">Is class completed?</label>
    </div>
    <div class="d-flex">
        <div class="form-check mb-4">
            <input class="form-check-input" type="checkbox" id="is_material_distributed" name="is_material_distributed"
                {{ (isset($batch_closing['is_material_distributed']) && $batch_closing['is_material_distributed'] == 1) || old('is_material_distributed') == 'on' ? 'checked' : '' }}>
        </div>
        <label class="form-label" for="is_material_distributed">Is material distributed?</label>
    </div>
    <div class="d-flex">
        <div class="form-check mb-4">
            <input class="form-check-input" type="checkbox" id="is_laptop_distributed" name="is_laptop_distributed"
                {{ (isset($batch_closing['is_laptop_distributed']) && $batch_closing['is_laptop_distributed'] == 1) || old('is_laptop_distributed') == 'on' ? 'checked' : '' }}>
        </div>
        <label class="form-label" for="is_laptop_distributed">Is laptop distributed?</label>
    </div>
    <div class="d-flex">
        <div class="form-check mb-4">
            <input class="form-check-input" type="checkbox" id="is_payment_completed" name="is_payment_completed"
                {{ (isset($batch_closing['is_payment_completed']) && $batch_closing['is_payment_completed'] == 1) || old('is_payment_completed') == 'on' ? 'checked' : '' }}>
        </div>
        <label class="form-label" for="is_payment_completed">Is payment completed?</label>
    </div>
</div>
<div class="mt-5 text-center">
    <button type="submit" class="btn btn-md btn-success submit-action">{{ __('config.submit') }}</button>
</div>
@php
    $completed_at = '';
    if ($batch['completed_at']) {
        $completed_at = \Carbon\Carbon::createFromFormat('Y-m-d', $batch['completed_at'])->format('d/m/Y');
    }
@endphp


@push('js')
    <script>
        $(document).ready(function() {
            const checkboxes = $('.form-check-input');
            const submitButton = $('.submit-action').closest('div');
            let storedCompletedAt = @json($completed_at) ?? '';
            // Initial check on page load
            handleCheckboxChange();

            // Event listener for checkbox change
            checkboxes.on('change', function() {
                handleCheckboxChange();
            });

            function handleCheckboxChange() {
                if (checkboxes.filter(':checked').length === checkboxes.length) {
                    appendDateField();
                } else {
                    removeDateField();
                }
            }

            function appendDateField() {
                if (!$('#completed_at').length) {
                    const dateFieldWrapper = `
                    <div class="mt-4">
                        <label for="completed_at" class="form-label">Completion Date</label>
                        <input type="text" id="completed_at" name="completed_at" class="form-control">
                    </div>`;
                    submitButton.before(dateFieldWrapper);

                    // Initialize Flatpickr
                    flatpickr("#completed_at", {
                        enableTime: false,
                        dateFormat: "d/m/Y",
                        defaultDate: [storedCompletedAt]
                    });
                }
            }

            function removeDateField() {
                $('#completed_at').closest('div').remove();
            }
        });
    </script>
@endpush
