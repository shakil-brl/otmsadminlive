<div class="form-check form-switch mb-3">
    <input class="form-check-input" type="checkbox" id="isActive" name="isActive"
        {{ (isset($partner['isActive']) && $partner['isActive'] == 1) || old('isActive') == 'on' ? 'checked' : '' }}>
    <label class="form-check-label" for="isActive">{{ __('config.status_active') }}</label>
</div>

<div class="row row-cols-2 g-4">
    <div class="">
        <label for="developmentPartnerId" class="form-label">{{__('config.development_partner')}}</label>
        <select name="developmentPartnerId" id="" class="form-select">
            <option value="">{{__('config.select_partner')}}</option>
            @foreach ($providers as $provider)
                <option value="{{ $provider['id'] }}"
                    {{ ($partner['developmentPartnerId'] ?? old('developmentPartnerId')) == $provider['id'] ? 'selected' : '' }}>
                    {{ $provider['name'] }}</option>
            @endforeach
        </select>
        @error('developmentPartnerId')
            <small class="text-danger d-block">{{ $message }}</small>
        @enderror
    </div>
    <div class="">
        <label for="onBoardDate" class="form-label">{{__('config.date')}}</label>
        <div class="input-group">
            <span class="input-group-text">
                <span class="material-icons-outlined">
                    calendar_month
                </span>
            </span>
            <input type="text" class="form-control" id="onBoardDate" name="onBoardDate" placeholder="{{__('config.select_date')}}" value="{{ $holyday['onBoardDate'] ?? old('onBoardDate') }}">
        </div>
        @error('onBoardDate')
            <small class="text-danger d-block">{{ $message }}</small>
        @enderror
    </div>
    <div class="">
        <label for="refDocTitle" class="form-label">{{__('config.ref_doc_title')}}</label>
        <input type="text" class="form-control" name="refDocTitle" id="refDocTitle"
            value="{{ $partner['refDocTitle'] ?? old('refDocTitle') }}">
        @error('refDocTitle')
            <small class="text-danger d-block">{{ $message }}</small>
        @enderror
    </div>
    <div class="">
        <label for="refDocNo" class="form-label">{{__('config.ref_doc_no')}}</label>
        <input type="text" class="form-control" name="refDocNo" id="refDocNo"
            value="{{ $partner['refDocNo'] ?? old('refDocNo') }}">
        @error('refDocNo')
            <small class="text-danger d-block">{{ $message }}</small>
        @enderror
    </div>
</div>
<div class="mt-3">
    <button type="submit" class="btn btn-md btn-success">{{__('config.submit')}}</button>
</div>
