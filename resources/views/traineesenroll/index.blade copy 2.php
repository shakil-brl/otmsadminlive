@extends('layouts.auth-master')

@section('content')
    <div class="mx-5 mb-2">
        <h1 class="page-heading d-flex mb-4 text-dark fw-bold fs-3 flex-column justify-content-center my-0">
            {{ __('trainee-enrollment-list.trainee_enrollment') }}
        </h1>
        <form action="" style="max-width: 400px;">
            <div class="input-group mb-4">
                <input type="search" name="search" id="searchInput" value="{{ request('search') }}" class="form-control w-75"
                    placeholder="{{ __('batch-list.search_here') }}">
                <button type="button" onclick="fetchTraineeData(1)" class="btn btn-primary input-group-text">
                    {{ __('batch-list.search') }}
                </button>
            </div>
        </form>
        <div class="card">
            <div class="card-body">
                <table id="traineeTable" class="table table-bordered">
                    <thead class="bg-secondary">
                        <tr>
                            <th>সিরিয়াল নং</th>
                            <th>নাম</th>
                            <th>ইমেইল</th>
                            <th>জাতীয় পরিচয়পত্র</th>
                            <th>মোবাইল নং</th>
                            <th>পিতার নাম</th>
                            <th>মাতার নাম</th>
                            <th>বর্তমান ঠিকানা</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- DataTable rows will be appended here -->
                    </tbody>
                </table>
                <div id="traineeTable_paginate" class="dataTables_paginate paging_simple_numbers">
                    <!-- Pagination links will be appended here -->
                </div>
            </div>
        </div>
    </div>

  <!-- Include DataTables and Bootstrap JS and CSS -->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <script>
        function fetchTraineeData(page = 1) {
            var search = $('#searchInput').val();

            $.ajax({
                url: '{{ config('app.api_url') }}detail/trainee-total',
                type: 'GET',
                headers: {
                    Authorization: authToken,
                },
                data: {
                    search: search,
                    page: page
                },
                success: function (data) {
                    // Clear existing rows
                    $('#traineeTable tbody').empty();

                    // Append new rows
                    $.each(data.data.data, function(index, trainee) {
                        var row = '<tr>' +
                            '<td>' + (index + 1 + (page - 1) * data.data.per_page) + '</td>' +
                            '<td>' + (trainee.profile.KnownAs || '') + '</td>' +
                            '<td>' + (trainee.profile.Email || '') + '</td>' +
                            '<td>' + (trainee.profile.NID || '') + '</td>' +
                            '<td>' + (trainee.profile.Phone || '') + '</td>' +
                            '<td>' + (trainee.profile.FatherNameBangla || '') + '</td>' +
                            '<td>' + (trainee.profile.MotherNameBangla || '') + '</td>' +
                            '<td>' + (trainee.profile.address_present || '') + '</td>' +
                            '</tr>';
                        $('#traineeTable tbody').append(row);
                    });

                    // Render pagination links
                    renderTraineeTablePaginate(data);

                    // Initialize DataTable
                    // if (!$.fn.DataTable.isDataTable('#traineeTable')) {
                    //     $('#traineeTable').DataTable();
                    // }
                },
                error: function (error) {
                    console.error('Error fetching trainee data:', error);
                }
            });
        }

        function renderTraineeTablePaginate(data) {
            // Clear existing pagination links
            $('#traineeTable_paginate').empty();

            // Calculate total pages based on total count and items per page
            var totalPages = Math.ceil(data.data.total / data.data.per_page);

            // Append new pagination links
            $.each(data.data.links, function(index, link) {
                var pageLink = '<a class="paginate_button page-item" href="#" onclick="fetchTraineeData(' + link.label + ')">' + link.label + '</a>';
                $('#traineeTable_paginate').append(pageLink);
            });

            // Optionally, you can also display the total count and current page
            var pageInfo = 'Page ' + data.data.current_page + ' of ' + totalPages + ' | Total: ' + data.data.total + ' items';
            $('#traineeTable_paginate').append('<p>' + pageInfo + '</p>');
        }

        // Updated pagination link click handler
        $(document).on('click', '#traineeTable_paginate a', function(event) {
            event.preventDefault();
            var page = $(this).text(); // Get the page number from the clicked link
            fetchTraineeData(page); // Fetch data for the clicked page
        });

        // Call the function after defining it
        fetchTraineeData();
    </script>
@endsection
