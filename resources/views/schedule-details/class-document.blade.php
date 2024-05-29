@extends('layouts.auth-master')

@section('content')
    <!--begin::Content-->
    <div class="m-5">
        <div class="d-flex justify-content-end align-items-center mb-2">
            <a class="btn btn-lg btn-success"
                href="{{ route('schedule-class-documents.create', $schedule_details_id) }}">Uploda Document</a>
        </div>

        <x-alert />

        <h3 class="mt-5">Documents List</h3>
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
                        <th>Title</th>
                        <th>Description</th>
                        <th>{{ __('batch-list.action') }}</th>
                    </thead>
                    <tbody>
                        @if (count($results['data']) > 0)
                            @foreach ($results['data'] ?? [] as $index => $document)
                                @php
                                    $from = $results['from'];
                                @endphp
                                <tr>
                                    <td>
                                        {{ $from + $loop->iteration - 1 }}
                                    </td>
                                    <td>
                                        {{ $document['document_title'] ?? '' }}
                                    </td>
                                    <td>
                                        {{ $document['description'] ?? '' }}
                                    </td>
                                    {{-- @dump($document['document_path']) --}}
                                    <td class="d-flex gap-1">
                                        <a href="{{ asset('storage/' . $document['document_path']) }}" target="_blank"
                                            class="btn btn-sm btn-success">
                                            View
                                        </a>
                                        <a href="{{ asset('storage/' . $document['document_path']) }}" download
                                            class="btn btn-sm btn-info">
                                            Download
                                        </a>
                                        <form action="{{ route('class-documents.destroy', $document['id']) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger delete-action">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <td colspan="4" class="text-danger">
                                No data found
                            </td>
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
