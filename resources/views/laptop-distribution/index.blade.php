@extends('layouts.auth-master')

@section('content')
    <!--begin::Content-->
    <div class="m-5">
        <div class="d-flex justify-content-end align-items-center">
            <a class="btn btn-lg btn-success" href="{{ route('dashboard_details.running_batches') }}">
                Manage Laptop Distribution
            </a>
        </div>
        <h3>Laptop Distribute List</h3>
        <x-alert />

        @isset($results['data'])
            <div class="my-3">
                <div class="d-none">
                    <form action="">
                        <div class="w-50 d-flex gap-3">
                            <input type="search" name="search" value="{{ request('search') }}" class="form-control w-75"
                                placeholder="Search Holyday">
                            <input type="submit" class="form-control btn btn-primary w-25" value="Search">
                        </div>
                    </form>
                </div>
                <table class="table table-bordered bg-white">
                    <thead>
                        <th>S.N.</th>
                        <th>Batch Code</th>
                        <th>Training Title</th>
                        <th>Date</th>
                        <th>Total Trainee</th>
                        <th>Total Laptop</th>
                        <th>{{ __('batch-list.action') }}</th>
                    </thead>
                    <tbody>
                        @foreach ($results['data'] ?? [] as $index => $data)
                            @php
                                $from = $results['from'];
                            @endphp
                            <tr>
                                <td>
                                    {{ $from + $loop->iteration - 1 }}
                                </td>
                                <td>
                                    {{ $data['training_batch']['batchCode'] ?? '' }}
                                </td>
                                <td>
                                    {{ $data['training_batch']['get_training']['title']['Name'] ?? '' }}
                                </td>
                                <td>
                                    {{ isset($data['distribution_date']) ? \Carbon\Carbon::parse($data['distribution_date'])->format('d-m-Y') : '' }}
                                </td>
                                <td>
                                    {{ $data['total_students'] }}
                                </td>
                                <td>
                                    {{ $data['total_laptop'] }}
                                </td>
                                <td class="me-0 d-flex gap-1">
                                    <a href="{{ route('laptop-distribution.edit', [$data['id'], encrypt($data['batch_id'])]) }}"
                                        class="btn btn-sm btn-info">
                                        {{ __('config.edit') }}
                                    </a>
                                    <form action="{{ route('laptop-distribution.destroy', [$data['id']]) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="btn btn-sm btn-danger delete-action">{{ __('config.delete') }}</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $paginator->links() !!}
            </div>
        @endisset
    </div>
@section('scripts')
    <script>
        $(document).ready(function() {
            $(document).on("click", ".delete-action", function(e) {
                e.preventDefault();
                const form = $(this).closest('form');

                Swal.fire({
                    title: "Are you sure?",
                    text: "Do you want to delete this data?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!",
                    cancelButtonText: "No, cancel!",
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
@endsection
@endsection
