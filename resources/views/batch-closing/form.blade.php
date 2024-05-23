<div>
    @if ($batch_closing)
        <input type="hidden" name="action" value="update">
        <input type="hidden" name="batch_closing_id" value="{{ $batch_closing['id'] }}">
    @else
        <input type="hidden" name="training_batch_id" value="{{ $batch['id'] }}">
    @endif
</div>
<div class="row row-cols-2 g-4 border p-5">
    <div class="d-flex gap-5">
        <label class="form-label" for="is_class_completed">1. Is class complete?(Inactive/Active):</label>

        <div class="form-check form-switch mb-4">
            <input class="form-check-input" type="checkbox" id="is_class_completed" name="is_class_completed"
                {{ (isset($batch_closing['is_class_completed']) && $batch_closing['is_class_completed'] == 1) || old('is_active') == 'on' ? 'checked' : '' }}>
        </div>
    </div>
    <div class="d-flex gap-5">
        <label class="form-label" for="is_material_distributed">2. Is material distributed?(Inactive/Active):</label>

        <div class="form-check form-switch mb-4">
            <input class="form-check-input" type="checkbox" id="is_material_distributed" name="is_material_distributed"
                {{ (isset($batch_closing['is_material_distributed']) && $batch_closing['is_material_distributed'] == 1) || old('is_active') == 'on' ? 'checked' : '' }}>
        </div>
    </div>
    <div class="d-flex gap-5">
        <label class="form-label" for="is_laptop_distributed">3. Is laptop distributed?(Inactive/Active):</label>

        <div class="form-check form-switch mb-4">
            <input class="form-check-input" type="checkbox" id="is_laptop_distributed" name="is_laptop_distributed"
                {{ (isset($batch_closing['is_laptop_distributed']) && $batch_closing['is_laptop_distributed'] == 1) || old('is_active') == 'on' ? 'checked' : '' }}>
        </div>
    </div>
    <div class="d-flex gap-5">
        <label class="form-label" for="is_payment_completed">4. Is payment completed?(Inactive/Active):</label>

        <div class="form-check form-switch mb-4">
            <input class="form-check-input" type="checkbox" id="is_payment_completed" name="is_payment_completed"
                {{ (isset($batch_closing['is_payment_completed']) && $batch_closing['is_payment_completed'] == 1) || old('is_active') == 'on' ? 'checked' : '' }}>
        </div>
    </div>
</div>
<div class="mt-5 text-center">
    <button type="submit" class="btn btn-md btn-success submit-action">{{ __('config.submit') }}</button>
</div>
