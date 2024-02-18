<div class="form-check form-switch mb-4">
    <input class="form-check-input" type="checkbox" id="is_active" name="is_active"
        {{ (isset($product_combo['is_active']) && $product_combo['is_active'] == 1) || old('is_active') == 'on' ? 'checked' : '' }}>
    <label class="form-check-label" for="is_active">Status(Inactive/Active)</label>
</div>

<div class="row row-cols-2 g-4">
    <div class="">
        <label for="name" class="form-label">Name:</label>
        <input type="text" class="form-control" name="name" id="name"
            value="{{ $product_combo['name'] ?? old('name') }}">
        @error('name')
            <small class="text-danger d-block">{{ $message }}</small>
        @enderror
    </div>
    @isset($phases)
        <div class="">
            <label for="phase_id" class="form-label">Phase:</label>
            <select name="phase_id" id="" class="form-select">
                <option value="">{{ __('config.select_partner') }}</option>
                @foreach ($phases as $phase)
                    <option value="{{ $phase['id'] }}"
                        {{ ($product_combo['phase_id'] ?? old('phase_id')) == $phase['id'] ? 'selected' : '' }}>
                        {{ $phase['name_en'] }}</option>
                @endforeach
            </select>
            @error('phase_id')
                <small class="text-danger d-block">{{ $message }}</small>
            @enderror
        </div>
    @endisset
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

<div style="max-width: 800px;" class="mt-3">
    <h4 class="">Products:</h4>
    <table id="" class="table table-sm">
        <thead class="thead-light">
            <tr>
                <th><b>S.N.</b></th>
                <th style="width: 65%;"><b>Name</b></th>
                <th><b>Quantity</b></th>
            </tr>
        </thead>
        <tbody id="detail-table-body">

        </tbody>
    </table>
    @error('products')
        <small class="text-danger d-block">{{ $message }}</small>
    @enderror
    @error('quantities')
        <small class="text-danger d-block">{{ $message }}</small>
    @enderror
    <div class="text-center mt-2">
        <button id="add-item" class="btn btn-sm btn-info">Add Product</button>
    </div>
</div>

<div class="mt-3 d-flex justify-content-center gap-2">
    <x-go-back />
    <button type="submit" class="btn btn-md btn-success">Submit</button>
</div>
