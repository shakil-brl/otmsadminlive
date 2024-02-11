<div class="form-check form-switch mb-4">
    <input class="form-check-input" type="checkbox" id="is_active" name="is_active"
        {{ (isset($product['is_active']) && $product['is_active'] == 1) || old('is_active') == 'on' ? 'checked' : '' }}>
    <label class="form-check-label" for="is_active">Status(Inactive/Active)</label>
</div>

<div class="row row-cols-2 g-4">
    <div class="">
        <label for="name" class="form-label">Name (English):</label>
        <input type="text" class="form-control" name="name" id="name"
            value="{{ $product['name'] ?? old('name') }}">
        @error('name')
            <small class="text-danger d-block">{{ $message }}</small>
        @enderror
    </div>
    <div class="">
        <label for="org_id" class="form-label">Organization</label>
        <select name="org_id" id="" class="form-select" disabled>
            <option value="">Select organization</option>
            <option value="13" selected>
                Her Power
            </option>
        </select>
        @error('org_id')
            <small class="text-danger d-block">{{ $message }}</small>
        @enderror
    </div>
</div>
<div class="mt-3 d-flex gap-2">
    <x-go-back />
    <button type="submit" class="btn btn-md btn-success">Submit</button>
</div>
