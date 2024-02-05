@extends('layouts.auth-master')

@section('content')
    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <div class="mx-5 mb-2">
        <div class="d-flex align-items-center justify-content-between my-3">
            <h1 class="page-heading">
                All Phases
            </h1>
            <x-alert />
            <div class="d-flex justify-content-end align-items-center">
                <a class="btn btn-lg btn-success" href="{{ route('tms-phase.create') }}">Create Phase</a>
            </div>
        </div>

        <form id="searchForm" style="max-width: 400px;">
            <div class="input-group mb-4">
                <input type="search" name="search" id="searchInput" value="{{ request('search') }}"
                    class="form-control w-75" placeholder="{{ __('batch-list.search_here') }}">
                <button type="button" class="btn btn-primary input-group-text">
                    {{ __('batch-list.search') }}
                </button>
            </div>
        </form>
        <div class="card">
            <div class="card-body">
                <table id="phase-table" class="table table-bordered data-table">
                    <thead class="bg-secondary">
                        <tr>
                            <th>S.N.</th>
                            <th>Name</th>
                            <th>Name (Bangla)</th>
                            <th>Active</th>
                            <th>Remark</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- DataTable rows will be appended here -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Include DataTables and Bootstrap JS and CSS -->
    {{-- <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script> --}}
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(function() {
            let app_url = "{{ url('') }}";

            let table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                // ajax: "{{ route('tms-phase.index') }}",
                ajax: {
                    url: "{{ route('tms-phase.index') }}",
                    type: 'get',
                    data: function(d) {
                        d.perPage = $('#perPage').val();
                        d.searchTerm = $('#searchInput').val();
                    }
                },
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name_en',
                        name: 'name_en'
                    },
                    {
                        data: 'name_bn',
                        name: 'name_bn'
                    },
                    {
                        data: 'isActive',
                        name: 'isActive'
                    },
                    {
                        data: 'remark',
                        name: 'remark'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
            });
            //search
            $('#searchInput').on('keyup', function() {
                table.search(this.value).draw();
            });
            // view
            $(document).on("click", ".view", function(e) {
                let id = $(this).data('id');

                let finalUrl =
                    `${app_url}/tms-phase/${id}`;

                window.location.href = finalUrl;
            });
            // edit
            $(document).on("click", ".edit-action", function(e) {
                let id = $(this).data('id');

                let finalUrl =
                    `${app_url}/tms-phase/${id}/edit`;

                window.location.href = finalUrl;
            });
            // delete
            $(document).on("click", ".delete-action", function(e) {
                let id = $(this).data('id');
                let csrfToken = $('meta[name="csrf-token"]').attr('content');
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!",
                    cancelButtonText: "No, cancel!",
                }).then((result) => {
                    if (result.isConfirmed) {
                        let url_link = api_baseurl + "tms-phases/" + id;
                        $.ajax({
                            type: "delete",
                            url: url_link,
                            headers: {
                                Authorization: authToken,
                                'X-CSRF-TOKEN': csrfToken,
                            },
                            success: function(results) {
                                if (results.success === true) {
                                    swal.fire("Deleted!", results.message);
                                    sessionStorage.setItem('message', results.message);
                                    sessionStorage.setItem('alert-type', 'info');

                                    // refresh page after 2 seconds
                                    setTimeout(function() {
                                        location.reload();
                                    }, 2000);
                                } else {
                                    swal.fire("Error!", results.message, "error");
                                }
                            },
                            error: function(response) {
                                alert(response);
                            },
                        });
                    }
                });
            });

            // link batch
            $(document).on("click", ".link-batch", function(e) {
                let id = $(this).data('id');

                let finalUrl =
                    `${app_url}/tms-phase/${id}/link-batch`;

                window.location.href = finalUrl;
            });
        });
    </script>
@endsection
