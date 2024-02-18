<div class="row row-cols-4 g-4">
    <div class="">
        <label for="day_name_en" class="form-label">{{__('config.name_english')}}:</label>
        <input type="text" class="form-control" name="day_name_en" id="day_name_en"
            value="{{ $holyday['day_name_en'] ?? old('day_name_en') }}" placeholder="{{__('config.name_english_ph')}}">
        @error('day_name_en')
            <small class="text-danger d-block">{{ $message }}</small>
        @enderror
    </div>
    <div class="">
        <label for="day_name_bn" class="form-label">{{__('config.name_bangla')}}:</label>
        <input type="text" class="form-control" name="day_name_bn" id="day_name_bn"
            value="{{ $holyday['day_name_en'] ?? old('day_name_bn') }}" placeholder="{{__('config.name_bangla_ph')}}">
        @error('day_name_bn')
            <small class="text-danger d-block">{{ $message }}</small>
        @enderror
    </div>
    <div class="">
        <label for="holly_bay" class="form-label">{{__('config.date')}}:</label>
        <div class="input-group">
            <span class="input-group-text">
                <span class="material-icons-outlined">
                    calendar_month
                </span>
            </span>
            <input type="text" class="form-control" id="holly_bay" name="holly_bay" placeholder="{{__('config.date_ph')}}">
        </div>
        @error('holly_bay')
            <small class="text-danger d-block">{{ $message }}</small>
        @enderror
    </div>
</div>
<div class="mt-3">
    <button type="submit" class="btn btn-md btn-success">{{__('config.submit')}}</button>
</div>
