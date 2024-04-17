@extends('layouts.auth-master')

@section('content')
    <!--begin::Content-->
    <div class="m-5">
        <h3>Exam List</h3>
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
                                    @if (in_array('exam.create', $roleRoutePermissions))
                                        <a href="{{ route('exam.create', [encrypt($batch_data['id']), $e_config['id']]) }}"
                                            class="btn btn-sm btn-success">
                                            Take
                                        </a>
                                    @endif
                                    @if (in_array('exam.result', $roleRoutePermissions))
                                        <a href="{{ route('exam.result', [encrypt($batch_data['id']), $e_config['id']]) }}"
                                            class="btn btn-sm btn-info">
                                            Result
                                        </a>
                                    @endif
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
