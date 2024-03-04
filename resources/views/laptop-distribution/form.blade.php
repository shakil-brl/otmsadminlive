<div>
    <input type="hidden" name="batch_id" value="{{ $batch['id'] }}">
    <input type="hidden" name="total_students" value="{{ $laptop['total_students'] ?? count($students) }}">
    <input type="hidden" name="distribution_date" value="{{ $laptop['distribution_date'] ?? date('Y-m-d') }}">
</div>

<div class="m-3">
    <table class="table table-bordered bg-white">
        <thead>
            <tr>
                <th>Serial</th>
                <th>Trainee Name</th>
                <th>Class Attended</th>
                <th>Serial No.</th>
                <th>Agreement No.</th>
            </tr>
        </thead>
        <tbody>
            @if (count($students) > 0)
                @foreach ($students as $index => $student)
                    @php
                        $found_entry = null;
                    @endphp
                    @isset($laptop)
                        @php
                            foreach ($laptop['laptop_details'] as $entry) {
                                if ($entry['applicant_id'] == $student['ProfileId']) {
                                    $found_entry = $entry;
                                    break;
                                }
                            }
                        @endphp
                    @endisset
                    <tr id="students">
                        <td>
                            <div class="form-check">
                                <input name="applicant_id[]" class="form-check-input toggle-checkbox" type="checkbox"
                                    role="switch" id="student{{ $loop->iteration }}"
                                    value="{{ $student['ProfileId'] }}" {{ $found_entry ? 'checked' : '' }}>

                                <label class="form-check-label" for="student{{ $loop->iteration }}">
                                    {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}
                                </label>
                            </div>
                        </td>
                        <td>{{ $student['profile']['KnownAs'] }}</td>
                        <td>
                            {{ $student['total'] }}
                            ({{ number_format(($student['total'] * 100) / $class_details['total_class'], 2) }}%)
                        </td>
                        <td>
                            <input type="text" name="laptop_serial[]" class="form-control"
                                {{ $found_entry ? '' : 'disabled' }}
                                value="{{ $found_entry['laptop_serial'] ?? '' }}">
                        </td>
                        <td>
                            <input type="text" name="agr_num[]" class="form-control"
                                {{ $found_entry ? '' : 'disabled' }} value="{{ $found_entry['agr_num'] ?? '' }}">
                        </td>
                    </tr>
                @endforeach
            @else
                <tr class="student">
                    <td colspan="5">No Trainee Found</td>
                </tr>
            @endif
        </tbody>
    </table>
    <div class="w-50">
        <label for="remark" class="form-label">Remark:</label>
        <input type="text" class="form-control" name="remark" id="remark"
            value="{{ $laptop['remark'] ?? old('remark') }}" placeholder="Remark">
        </input>
        @error('remark')
            <small class="text-danger d-block">{{ $message }}</small>
        @enderror
    </div>
    <div id="attendance-bottom">
        <div class="left">
            <div class="label">
                Trainee (Laptop Given)
                <span id="totalDistribute"></span>/<span>{{ count($students) }}</span>
            </div>
            <div class="attendance-progress">
                <div class="success" id="success-progress" style=""></div>
            </div>
        </div>

        <div class="right">
            <button class="btn btn-success" type="submit">Submit</button>
        </div>
    </div>
</div>

@push('js')
    <script>
        $(document).ready(function() {
            // Disable the inputs by default
            // $('input[name="laptop_serial[]"], input[name="agr_num[]"]').prop('disabled', true);

            // Enable/disable inputs based on checkbox state
            $('.toggle-checkbox').change(function() {
                var isChecked = $(this).is(':checked');
                $(this).closest('tr').find('input[name="laptop_serial[]"], input[name="agr_num[]"]').prop(
                    'disabled', !isChecked);
            });

            var totalStudent = {{ count($students) }};

            function countDistribute() {
                let att = 0;
                $('#students .form-check-input.toggle-checkbox').each(function(index, element) {
                    if ($(this).prop('checked')) {
                        att++;
                    }
                });
                let percentage = att * 100 / totalStudent;
                $('#totalDistribute').text(att);
                $('#success-progress').css('width', percentage + '%');
            }

            countDistribute();

            $('.toggle-checkbox').change(function() {
                countDistribute();
            });
        });
    </script>
@endpush
