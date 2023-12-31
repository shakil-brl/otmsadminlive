@extends('layouts.auth-master')

@section('content')
    <!--begin::Content-->
    <div class="m-5">
        <div class="d-flex justify-content-end align-items-center">
            <a class="btn btn-lg btn-success" href="{{ route('lots.create') }}">Create Batch Group</a>
        </div>
        <h3>Batch Group List</h3>
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
                        <th>{{ __('batch-list.sl') }}</th>
                        <th>Name (English)</th>
                        <th>Name (Bangla)</th>
                        <th>Code</th>
                        <th>Remark</th>
                        <th>Actions</th>
                    </thead>
                    <tbody>
                        @if (count($results['data']) > 0)
                            @foreach ($results['data'] ?? [] as $index => $lot)
                                @php
                                    $from = $results['from'];
                                @endphp
                                <tr>
                                    <td>
                                        {{ $from + $loop->iteration - 1 }}
                                    </td>
                                    <td>
                                        {{ $lot['name_en'] ?? '' }}
                                    </td>
                                    <td>
                                        {{ $lot['name_bn'] ?? '' }}
                                    </td>
                                    <td>
                                        {{ $lot['code'] ?? '' }}
                                    </td>
                                    <td>
                                        {{ $lot['remark'] ?? '' }}
                                    </td>
                                    <td class="me-0 d-flex gap-1">
                                        {{-- <a href="{{ route('lots.show', $lot['id']) }}" class="btn btn-sm btn-success">View</a> --}}
                                        <a href="{{ route('lots.edit', $lot['id']) }}" class="btn btn-sm btn-info">
                                            Edit
                                        </a>
                                        <form action="{{ route('lots.destroy', $lot['id']) }}" method="post" id="deleteForm">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger delete-action">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <td colspan="6" class="text-danger">Data Not Fount</td>
                        @endif
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
                    text: "You won't be able to revert this!",
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
