<div class="row row-cols-3 g-4">
    <div class="">
        <label for="training_id" class="form-label">Training title</label>
        <select name="training_id" id="" class="form-select">
            <option value="">
                Select training title
            </option>
            @foreach ($trainings as $training)
                <option value="{{ $training['id'] }}"
                    {{ ($exam_config['training_id'] ?? old('training_id')) == $training['id'] ? 'selected' : '' }}>
                    {{ $training['title']['NameEn'] . '(' . $training['title']['Name'] . ')' }}
                </option>
            @endforeach
        </select>
        @error('training_id')
            <small class="text-danger d-block">{{ $message }}</small>
        @enderror
    </div>

    <div class="">
        <label for="exam_title" class="form-label">Exam title:</label>
        <input type="text" class="form-control" name="exam_title" id="exam_title"
            value="{{ $exam_config['exam_title'] ?? old('exam_title') }}" placeholder="Enter exam title">
        @error('exam_title')
            <small class="text-danger d-block">{{ $message }}</small>
        @enderror
    </div>
    <div class="">
        <label for="exam_date" class="form-label">Exam date:</label>
        <div class="input-group">
            <span class="input-group-text">
                <span class="material-icons-outlined">
                    calendar_month
                </span>
            </span>
            <input type="text" class="form-control" id="exam_date" name="exam_date" placeholder="Select a date">
        </div>
        @error('exam_date')
            <small class="text-danger d-block">{{ $message }}</small>
        @enderror
    </div>

    <div class="">
        <label for="total_mark" class="form-label">Total mark:</label>
        <input type="text" class="form-control" name="total_mark" id="total_mark"
            value="{{ $exam_config['total_mark'] ?? old('total_mark') }}" placeholder="Enter total mark">
        @error('total_mark')
            <small class="text-danger d-block">{{ $message }}</small>
        @enderror
    </div>
    <div class="">
        <label for="pass_mark" class="form-label">Pass mark:</label>
        <input type="text" class="form-control" name="pass_mark" id="pass_mark"
            value="{{ $exam_config['pass_mark'] ?? old('pass_mark') }}" placeholder="Enter total mark">
        @error('pass_mark')
            <small class="text-danger d-block">{{ $message }}</small>
        @enderror
    </div>
</div>
<div class="mt-5">
    <button type="submit" class="btn btn-md btn-success">{{ __('config.submit') }}</button>
</div>
