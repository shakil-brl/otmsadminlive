<div class="row">
    <div class="col">
        <div class="form-group row">
            <label for="title" class="col-sm-2 offset-sm-2 col-form-label g-4 text-right">Title:</label>
            <div class="col-sm-6 g-4">
                <input type="text" class="form-control" name="title" id="title" placeholder="Create Title"
                    value="{{ $evaluation['title'] ?? old('title') }}">
                
                @error('title')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>


        <div class="form-group row">
            <label for="type" class="col-sm-2 offset-sm-2 col-form-label g-4">Question Type:</label>
            <div class="col-sm-6 g-4">
                <select name="is_bool" class="form-select" id="others">
                    <option value="1" @isset($evaluation) {{ $evaluation['is_bool'] == 1 ? 'selected' : '' }} @endisset >Yes No Question</option>
                    <option value="0" @isset($evaluation) {{ $evaluation['is_bool'] == 0 ? 'selected' : '' }} @endisset >Others</option>
                </select>
                @error('is_bool')
                    <small class="text-danger d-block">{{ $message }}</small>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="max-value" class="col-sm-2 offset-sm-2 col-form-label g-4">Maximum value:</label>
            <div class="col-sm-6 g-4">
                <input type="text" class="form-control" name="max_value" id="max-value" disabled
                    placeholder="Input maximum value" value="{{ $evaluation['max_value'] ?? old('max_value') }}">
                @error('max_value')
                    <small class="text-danger d-block">{{ $message }}</small>
                @enderror
            </div>

        </div>

        <div class="form-group row">
            <label for="type" class="col-sm-2 offset-sm-2 col-form-label g-4">Evaluation For:</label>
            <div class="col-sm-6 g-4">
                <select name="type" class="form-select">
                    <option value="1" @isset($evaluation) {{ $evaluation['type'] == 1 ? 'selected' : '' }} @endisset >Student</option>
                    <option value="2" @isset($evaluation) {{ $evaluation['type'] == 2 ? 'selected' : '' }} @endisset >Teacher</option>
                </select>
                @error('type')
                    <small class="text-danger d-block">{{ $message }}</small>
                @enderror
            </div>

        </div>
        <div class="form-group row">
            <label for="mark" class="col-sm-2 offset-sm-2 col-form-label g-4">Mark:</label>
            <div class="col-sm-6 g-4">
                <input type="text" class="form-control" name="mark" id="mark" placeholder="Give the marks"
                    value="{{ $evaluation['mark'] ?? old('mark') }}">
                @error('mark')
                    <small class="text-danger d-block">{{ $message }}</small>
                @enderror
            </div>

        </div>

        <div class="form-group row">
            <label for="type" class="col-sm-2 offset-sm-2 col-form-label g-4">Status:</label>
            <div class="col-sm-6 g-4">
                <select name="status" class="form-select">
                    <option value="1" @isset($evaluation) {{ $evaluation['status'] == 1 ? 'selected' : '' }} @endisset >Active</option>
                    <option value="0" @isset($evaluation) {{ $evaluation['status'] == 0 ? 'selected' : '' }} @endisset >Inactive</option>
                </select>
                @error('status')
                    <small class="text-danger d-block">{{ $message }}</small>
                @enderror
            </div>

        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-2 mt-10 m-auto">
        <button type="submit" class="btn btn-md btn-success">Submit</button>
    </div>
</div>
