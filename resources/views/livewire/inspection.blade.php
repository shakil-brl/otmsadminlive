<div>
    <a href="{{  route('tms-inspections.create')}}"> Add</a>
    <x-search-form />

    <table class="table table-responsive align-middle table-row-dashed fs-6 gy-5" id="dataTable">
        <thead>
            <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                <th class="min-w-200px">ব্যাচ আইডি</th>
                <th class="min-w-200px">Provider</th>
                <th style="width: 200">পরিদর্শক</th>
                <th class="min-w-100px">রেটিং</th>
                <th class="min-w-125px">মন্তব্য</th>

                <th class="text-end min-w-100px">বিস্তারিত</th>
            </tr>
        </thead>

        <tbody class="text-gray-600 fw-semibold" id="user-tbody">
            @foreach ($data['data'] as $item)
            @php
            $inspection = (object) $item;
            $totalRating = [
            'class_no', 'electricity', 'internet', 'lab_bill', 'lab_attendance', 'computer', 'router',
            'projector',
            'student_laptop', 'lab_security', 'lab_register', 'class_regularity', 'trainer_attituted',
            'trainer_tab_attendance', 'upazila_audit', 'upazila_monitoring',
            ];
            $totalRatingSum = collect($totalRating)->sum(fn($attr) => $inspection->{$attr});
            @endphp

            <tr>
                <td>{{ $inspection->batch['training']['training_title']['Name'] }}<br />
                    {{ $inspection->batch['batchCode'] }}
                </td>
                <td> {{ @$inspection->batch['provider']['name']}}<br>
                    {{ @$inspection->batch['provider']['phone']}}
                </td>
                <td style="width: 200px">
                    {{ @$inspection->created_by['KnownAsBangla'] }} <br>
                    {{ @$inspection->created_by['phone'] }}
                </td>
                <td class="d-flex align-items-center">
                    <div class="d-flex flex-column">
                        <span
                            class="badge rounded-pill text-white {{ $totalRatingSum > 8 ? 'bg-success' : 'bg-danger' }}">
                            {{ $totalRatingSum }}/16
                        </span>

                    </div>
                </td>

                <td>
                    <div class="d-flex align-items-center py-2">
                        {{ $inspection->remark}}
                    </div>
                </td>

                <td class="text-end">
                    <a href="{{ route('tms-inspections.show', ['id' => $inspection->id]) }}"
                        class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 view-user-action"
                        data-user-id="5">
                        <i class="ki-duotone ki-switch fs-2">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <!--end::Table-->
    <x-go-back />


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