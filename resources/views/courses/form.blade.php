<div class="row row-cols-2 g-4">
    <div class="">
        <label for="name_en" class="form-label">Name (English):</label>
        <input type="text" class="form-control" name="name_en" id="name_en"
            value="{{ $course['name_en'] ?? old('name_en') }}">
        @error('name_en')
            <small class="text-danger d-block">{{ $message }}</small>
        @enderror
    </div>
    <div class="">
        <label for="name_bn" class="form-label">Name (Bangla):</label>
        <input type="text" class="form-control" name="name_bn" id="name_bn"
            value="{{ $course['name_en'] ?? old('name_bn') }}">
        @error('name_bn')
            <small class="text-danger d-block">{{ $message }}</small>
        @enderror
    </div>
</div>
<div class="mt-3">
    <button type="submit" class="btn btn-md btn-success">Submit</button>
</div>
