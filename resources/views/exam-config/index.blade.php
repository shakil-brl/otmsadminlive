@extends('layouts.auth-master')

@section('content')
    <!--begin::Content-->
    <div class="m-5">
        <div class="d-flex justify-content-end align-items-center">
            <a class="btn btn-lg btn-success" href="{{ route('exam-config.create') }}">Create Exam Config</a>
        </div>
        <h3>Exam Config List</h3>
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
                        <th>Training Title</th>
                        <th>Exam Title</th>
                        <th>Date</th>
                        <th>Total Mark</th>
                        <th>Pass Mark</th>
                    </thead>
                    <tbody>
                        @foreach ($results['data'] ?? [] as $index => $e_config)
                            @php
                                $from = $results['from'];
                            @endphp
                            <tr>
                                <td>
                                    {{ $from + $loop->iteration - 1 }}
                                </td>
                                <td>
                                    {{ $e_config['training']['title']['NameEn'] ?? '' }}
                                </td>
                                <td>
                                    {{ $e_config['exam_title'] ?? '' }}
                                </td>
                                <td>
                                    {{ isset($e_config['exam_date']) ? \Carbon\Carbon::parse($e_config['exam_date'])->format('d-m-Y') : '' }}
                                </td>
                                <td>
                                    {{ $e_config['total_mark'] ?? '' }}
                                </td>
                                <td>
                                    {{ $e_config['pass_mark'] ?? '' }}
                                </td>
                                <td class="me-0 d-flex gap-1">
                                    <a href="{{ route('exam-config.edit', $e_config['id']) }}" class="btn btn-sm btn-info">
                                        {{ __('config.edit') }}
                                    </a>
                                    <form action="{{ route('exam-config.destroy', $e_config['id']) }}" method="post">
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
                    text: "Do you want to delete the data?",
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
