@extends('layouts.auth-master')

@section('content')
    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <div class="mx-5 mb-2">
        <h1 class="page-heading d-flex mb-4 text-dark fw-bold fs-3 flex-column justify-content-center my-0">
            {{ __('trainee-enrollment-list.trainee_enrollment') }}
        </h1>
        {{-- <form id="searchForm" style="max-width: 400px;">
            <div class="input-group mb-4">
                <input type="search" name="search" id="searchInput" value="{{ request('search') }}" class="form-control w-75"
                    placeholder="{{ __('batch-list.search_here') }}">
                <button type="button" class="btn btn-primary input-group-text">
                    {{ __('batch-list.search') }}
                </button>
            </div>
        </form> --}}
        <div class="card">
            <div class="card-body">
                <table id="traineeTable" class="table table-bordered">
                    <thead class="bg-secondary">
                        <tr>
                            <th>সিরিয়াল নং</th>
                            <th>নাম</th>  
                            <th>নাম (En)</th>  
                            <th>isActive</th>                           
                            <th>Review</th>
                            <th>Action</th> <!-- Added Action column -->
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
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>

    <script>
        $(document).ready(function() {
            var dataTable = $('#traineeTable').DataTable({
                serverSide: true,
                processing: true,
                ajax: {
                    url: '{{ config('app.api_url') }}tms-phases',
                    type: 'GET',
                    headers: {
                        Authorization: authToken, // Replace with your actual token
                    },
                },
                columns: [
                    { data: 'id' },
                    { data: 'name_en' },
                    { data: 'name_bn' },
                    { data: 'isActive' },
                    { data: 'remark' },
                    {
                        data: null,
                        render: function(data, type, row) {
                            // Assuming 'id' is the unique identifier for your records
                            return '<button onclick="viewAction(' + data.id + ')" class="btn btn-info btn-sm">View</button>' +
                                '<button onclick="editAction(' + data.id + ')" class="btn btn-warning btn-sm">Edit</button>';
                        }
                    }
                ],
            });

            // Example functions for view and edit actions
            function viewAction(id) {
                // Implement your view action logic here
                console.log('View action for ID: ' + id);
            }

            function editAction(id) {
                // Implement your edit action logic here
                console.log('Edit action for ID: ' + id);
            }

            // Add event listener to the search button
            $('#searchForm button').on('click', function() {
                // Use the DataTables search API to set the search value
                dataTable.search($('#searchInput').val()).draw();
            });
        });
    </script>
@endsection
