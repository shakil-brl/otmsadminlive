<div class="mb-3">
    <label for="key" class="form-label">Title:</label>
    <input type="text" name="key" class="form-control" id="key" value="{{ $setting['key'] ?? old('key') }}"
        placeholder="File title">
    @error('key')
        <small class="text-danger d-block">{{ $message }}</small>
    @enderror
</div>
<div class="mb-3">
    <label for="type" class="form-label">Choose Upload Type:</label>
    <select class="form-control" id="type" name="type">
        <option value="file"
            {{ isset($setting) && isset($setting['type']) && $setting['type'] === 'file' ? 'selected' : (old('type') === 'file' ? 'selected' : '') }}>
            File</option>
        <option value="text"
            {{ isset($setting) && isset($setting['type']) && $setting['type'] === 'text' ? 'selected' : (old('type') === 'text' ? 'selected' : '') }}>
            Text</option>
    </select>
</div>

<div id="file_input" class="mb-3"
    style="{{ isset($setting) && isset($setting['type']) && $setting['type'] === 'text' ? 'display: none;' : '' }}">
    <label for="file" class="form-label">
        File: <span class="text-danger">(***Image only)</span>
    </label>
    <input class="form-control" type="file" name="file" id="file" accept=".gif,.jpg,.jpeg,.png,.svg">
    @error('file')
        <small class="text-danger d-block">{{ $message }}</small>
    @enderror
</div>

<div id="text_input" class="mb-3"
    style="{{ isset($setting) && isset($setting['type']) && $setting['type'] === 'text' ? '' : 'display: none;' }}">
    <label for="text" class="form-label">Text:</label>
    <textarea class="form-control" name="text" id="text">{{ isset($setting) && isset($setting['type']) && $setting['type'] === 'text' ? $setting['value'] : old('text') }}</textarea>
    @error('text')
        <small class="text-danger d-block">{{ $message }}</small>
    @enderror
</div>

@push('js')
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var uploadTypeSelect = document.getElementById('type');
            var fileInputDiv = document.getElementById('file_input');
            var textInputDiv = document.getElementById('text_input');

            // Set initial visibility based on old type value
            if (uploadTypeSelect.value === 'file') {
                fileInputDiv.style.display = 'block';
                textInputDiv.style.display = 'none';
            } else if (uploadTypeSelect.value === 'text') {
                fileInputDiv.style.display = 'none';
                textInputDiv.style.display = 'block';
            }

            uploadTypeSelect.addEventListener('change', function() {
                if (this.value === 'file') {
                    fileInputDiv.style.display = 'block';
                    textInputDiv.style.display = 'none';
                } else if (this.value === 'text') {
                    fileInputDiv.style.display = 'none';
                    textInputDiv.style.display = 'block';
                }
            });
        });

        ClassicEditor
            .create(document.querySelector('#text'))
            .then(editor => {
                console.log(editor);
            })
            .catch(error => {
                console.error(error);
            });
    </script>
@endpush
