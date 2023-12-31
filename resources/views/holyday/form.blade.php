<div class="row row-cols-4 g-4">
    <div class="">
        <label for="day_name_en" class="form-label">Name (English):</label>
        <input type="text" class="form-control" name="day_name_en" id="day_name_en"
            value="{{ $holyday['day_name_en'] ?? old('day_name_en') }}">
        @error('day_name_en')
            <small class="text-danger d-block">{{ $message }}</small>
        @enderror
    </div>
    <div class="">
        <label for="day_name_bn" class="form-label">Name (Bangla):</label>
        <input type="text" class="form-control" name="day_name_bn" id="day_name_bn"
            value="{{ $holyday['day_name_en'] ?? old('day_name_bn') }}">
        @error('day_name_bn')
            <small class="text-danger d-block">{{ $message }}</small>
        @enderror
    </div>
    <div class="">
        <label for="holly_bay" class="form-label">Date:</label>
        <div class="input-group">
            <span class="input-group-text">
                <span class="material-icons-outlined">
                    calendar_month
                </span>
            </span>
            <input type="text" class="form-control" id="holly_bay" name="holly_bay">
        </div>
        @error('holly_bay')
            <small class="text-danger d-block">{{ $message }}</small>
        @enderror
    </div>
</div>
<div class="mt-3">
    <button type="submit" class="btn btn-md btn-success">Submit</button>
</div>
