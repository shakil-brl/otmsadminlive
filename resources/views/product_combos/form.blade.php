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
            <label for="phase_id" class="form-label">{{ __('config.development_partner') }}</label>
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
<div class="detail-area mt-5 rounded p-5">
    <table id="" class="table table-responsive">
        <thead class="thead-light">
            <tr>
                <th>Name</th>
                <th>Quantity</th>
            </tr>
        </thead>
        <tbody id="detail-table-body">
            <tr>
                <td class="products default">

                </td>
                <td>
                    <input type="text" class="form-control" name="quantity[]">
                </td>
                <td>
                    <button type="button"
                        class="btn close-detail btn-danger d-flex justify-content-center align-items-center">
                        <span class="material-symbols-outlined">
                            close
                        </span>
                    </button>
                </td>
            </tr>
        </tbody>
    </table>
</div>
<div class="text-end mt-3">
    <button id="add-item" class="btn btn-sm btn-info">Add Product</button>
</div>
<div class="mt-3 d-flex gap-2">
    <x-go-back />
    <button type="submit" class="btn btn-md btn-success">Submit</button>
</div>
