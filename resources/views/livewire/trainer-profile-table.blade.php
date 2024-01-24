<div>

    <div>
        <div class="row row-cols-md-3 row-cols-lg-4 row-cols-xxl-5">
            <div>
                <label for="">Distrcits</label>
                <select name="" class="form-select">
                    <option value="">Select Distrci</option>
                    <option value="">Barisal</option>
                    <option value="">Bhola</option>
                    <option value="">Jhalokathi</option>
                    <option value="">Pirojpur</option>
                    <option value="">Patuakhali</option>
                    <option value="">Barguna</option>
                </select>
            </div>
            <div>
                <label for="">Upazila</label>
                <select name="" class="form-select">
                    <option value="">Select Distrci</option>
                    <option value="">Barishal Sadar</option>
                    <option value="">Agailjhara</option>
                    <option value="">Bhola</option>
                    <option value="">Jhalokathi</option>
                    <option value="">Pirojpur</option>
                    <option value="">Patuakhali</option>
                    <option value="">Barguna</option>
                </select>
            </div>
            <div>
                <label for="">Training Courses</label>
                <select name="" class="form-select">
                    <option value="">Select Distrci</option>
                    <option value="">Digital Marketing</option>
                    <option value="">Graphics Design</option>
                    <option value="">Web Development</option>
                    <option value="">IT Service Provider</option>
                    <option value="">Women Call Centre Agent</option>
                    <option value="">Women E-Commerce Professional</option>
                </select>
            </div>
            <div class="mb-3">
                <label for=""></label>
                <input wire:model="search" type="text" class="form-control" placeholder="Search...">
            </div>
        </div>
        <div wire:loading>
            Processing ...
        </div>
    </div>
    <table class="table table-bordered bg-white" id="dataTable">
        <thead>
            <th>{{ __('batch-list.sl') }}</th>
            <th>{{ __('Name') }}</th>
            <th>{{ __('Phone') }}</th>
            <th>{{ __('Email') }}</th>
            <th>{{ __('Gender') }}</th>
        </thead>
        <tbody>
            <!-- Table headers go here -->

            @php
                $dataobj = (object) $data;
            @endphp

            @foreach ($dataobj->data as $item)
                <tr>
                    <!-- Display data columns for the main profile -->
                    <td>{{ $item['id'] }}</td>
                    <td>{{ $item['profile']['KnownAs'] }}</td>
                    <td>{{ $item['profile']['Phone'] }}</td>
                    <td><a href="mailto:{{ $item['profile']['Email'] }}">{{ $item['profile']['Email'] }}</a></td>
                    <td>{{ $item['profile']['Gender'] }}</td>

                    {{-- @dump($item) --}}
                    <!-- Add more fields from the nested "profile" array as needed -->
                </tr>
            @endforeach
        </tbody>
    </table>


    @push('js')
        <script>
            document.addEventListener('livewire:load', function() {
                Livewire.on('refreshDataTable', function() {
                    $('#dataTable').DataTable().destroy(); // Destroy existing DataTable instance
                    $('#dataTable').DataTable(); // Reinitialize DataTable
                });

                $('#dataTable').DataTable();
            });
        </script>
    @endpush
</div>
