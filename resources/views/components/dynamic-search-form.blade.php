<div>
    <div class="row justify-content-between">
        <form method="GET" action="{{ route('geodistrict.index') }}" role="form">
            <div class="row row-cols-5 g-2 mb-3">
                @foreach ($selectForms as $selectForm)
                <div class="">
                    @if ($selectForm['type'] == 'select')
                    <select name="{{ $selectForm['name'] }}" class="form-select form-select-sm select2"
                        id="{{ $selectForm['id'] }}">
                        <option value="">Select</option>
                        @foreach ($selectForm['values'] as $value => $label)
                        <option value="{{ $value }}" {{ old($selectForm['name'])==$value ? 'selected' : '' }}>
                            {{ $label }}
                        </option>
                        @endforeach
                    </select>
                    @elseif ($selectForm['type'] == 'text')
                    <input type="text" name="{{ $selectForm['name'] }}" placeholder="{{ $selectForm['placeholder'] }}"
                        class="form-control form-select-sm">
                    @endif
                </div>
                @endforeach
                <div class="">
                    <button type="submit" class="btn btn-primary filter">Filter</button>
                </div>
            </div>
        </form>
    </div>

</div>