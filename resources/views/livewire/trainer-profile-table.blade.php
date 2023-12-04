<div>

    <x-search-form />
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
            $dataobj= (object) $data;
            @endphp

            @foreach($dataobj->data as $item)
            <tr>
                <!-- Display data columns for the main profile -->
                <td>{{ $item['id'] }}</td>
                <td>{{ $item['profile']['KnownAs'] }}</td>
                <td>{{ $item['profile']['Phone'] }}</td>
                <td><a href="mailto:{{$item['profile']['Email'] }}">{{$item['profile']['Email'] }}</a></td>
                <td>{{ $item['profile']['Gender'] }}</td>

                {{-- @dump($item) --}}
                <!-- Add more fields from the nested "profile" array as needed -->
            </tr>

            @endforeach
        </tbody>
    </table>


    @push('js')
    <script>
        document.addEventListener('livewire:load', function () {
        Livewire.on('refreshDataTable', function () {
            $('#dataTable').DataTable().destroy(); // Destroy existing DataTable instance
            $('#dataTable').DataTable(); // Reinitialize DataTable
        });

        $('#dataTable').DataTable();
    });
    </script>
    @endpush
</div>