<div class="mb-3">
    <label for="key" class="form-label">Title:</label>
    <input type="text" name="key" class="form-control" id="key" value="{{ $file['key'] ?? old('key') }}"
        placeholder="File title"></input>
    @error('key')
        <small class="text-danger d-block">{{ $message }}</small>
    @enderror
</div>
<div class="mb-3">
    <label for="upload_type" class="form-label">Choose Upload Type:</label>
    <select class="form-control" id="upload_type" name="upload_type">
        <option value="file">File</option>
        <option value="text">Text</option>
    </select>
</div>

<div id="file_input" class="mb-3">
    <label for="file" class="form-label">File:</label>
    <input class="form-control" type="file" name="file" id="file">
    @error('file')
        <small class="text-danger d-block">{{ $message }}</small>
    @enderror
</div>

<div id="text_input" class="mb-3" style="display: none;">
    <label for="text" class="form-label">Text:</label>
    <textarea class="form-control" name="text" id="text"></textarea>
    @error('text')
        <small class="text-danger d-block">{{ $message }}</small>
    @enderror
</div>
