<div class="form-check form-switch mb-4">
    <input class="form-check-input" type="checkbox" id="isActive" name="isActive"
        {{ (isset($phase['isActive']) && $phase['isActive'] == 1) || old('isActive') == 'on' ? 'checked' : '' }}>
    <label class="form-check-label" for="isActive">Status(Inactive/Active)</label>
</div>
<div class="row row-cols-2 g-4">
    <div class="">
        <label for="name_en" class="form-label">Name (English):</label>
        <input type="text" class="form-control" name="name_en" id="name_en"
            value="{{ $phase['name_en'] ?? old('name_en') }}">
        @error('name_en')
            <small class="text-danger d-block">{{ $message }}</small>
        @enderror
    </div>
    <div class="">
        <label for="name_bn" class="form-label">Name (Bangla):</label>
        <input type="text" class="form-control" name="name_bn" id="name_bn"
            value="{{ $phase['name_bn'] ?? old('name_bn') }}">
        @error('name_bn')
            <small class="text-danger d-block">{{ $message }}</small>
        @enderror
    </div>
    <div class="">
        <label for="remark" class="form-label">Remark:</label>
        <input type="text" class="form-control" name="remark" id="remark"
            value="{{ $phase['remark'] ?? old('remark') }}">
        @error('remark')
            <small class="text-danger d-block">{{ $message }}</small>
        @enderror
    </div>
</div>
<div class="mt-5 d-flex gap-2 justify-content-center">
    <x-go-back />
    <button type="submit" class="btn btn-md btn-success ">Submit</button>
</div>
