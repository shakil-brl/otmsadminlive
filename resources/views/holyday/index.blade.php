@extends('layouts.auth-master')

@section('content')
    <!--begin::Content-->
    <div class="m-5">
        <div class="d-flex justify-content-end align-items-center">
            <a class="btn btn-lg btn-success" href="{{ route('holydays.create') }}">Create Holyday</a>
        </div>
        <h3>Holydays List</h3>
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
                        <th>Date</th>
                        <th>{{ __('batch-list.action') }}</th>
                    </thead>
                    <tbody>
                        @foreach ($results['data'] ?? [] as $index => $holyday)
                            @php
                                $from = $results['from'];
                            @endphp
                            <tr>
                                <td>
                                    {{ $from + $loop->iteration - 1 }}
                                </td>
                                <td>
                                    {{ $holyday['day_name_en'] ?? '' }}
                                </td>
                                <td>
                                    {{ $holyday['day_name_bn'] ?? '' }}
                                </td>
                                <td>
                                    {{ isset($holyday['holly_bay']) ? \Carbon\Carbon::parse($holyday['holly_bay'])->format('d-m-Y') : '' }}
                                </td>
                                <td class="me-0 d-flex gap-1">
                                    <a href="{{ route('holydays.edit', $holyday['id']) }}" class="btn btn-sm btn-info">
                                        Edit
                                    </a>
                                    <form action="{{ route('holydays.destroy', $holyday['id']) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger delete-action">Delete</button>
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
