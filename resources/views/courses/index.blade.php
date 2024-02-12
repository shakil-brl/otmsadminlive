@extends('layouts.auth-master')

@section('content')
    <!--begin::Content-->
    <div class="m-5">
        <div class="d-flex justify-content-end align-items-center">
            <a class="btn btn-lg btn-success" href="{{ route('courses.create') }}">{{__('config.course_create')}}</a>
        </div>
        <h3>{{__('config.course_list')}}</h3>
        <x-alert />
        @isset($results['data'])
            <div class="my-3">
                <div class="d-none">
                    <form action="">
                        <div class="w-50 d-flex gap-3">
                            <input type="search" name="search" value="{{ request('search') }}" class="form-control w-75"
                                placeholder="Search Course">
                            <input type="submit" class="form-control btn btn-primary w-25" value="Search">
                        </div>
                    </form>
                </div>
                <table class="table table-bordered bg-white">
                    <thead>
                        <th>{{__('batch-list.sl')}}</th>
                        <th>{{__('config.name_english')}}</th>
                        <th>{{__('config.name_bangla')}}</th>
                        <th>{{__('config.action')}}</th>
                    </thead>
                    <tbody>
                        @if (count($results['data']) > 0)
                            @foreach ($results['data'] ?? [] as $index => $course)
                                <tr>
                                    <td>
                                        {{ $page_from + $loop->iteration - 1 }}
                                    </td>
                                    <td>
                                        {{ $course['name_en'] ?? '' }}
                                    </td>
                                    <td>
                                        {{ $course['name_bn'] ?? '' }}
                                    </td>
                                    <td class="me-0 d-flex gap-1">
                                        <a href="{{ route('courses.edit', $course['id']) }}" class="btn btn-sm btn-info">
                                            {{__('config.edit')}}
                                        </a>
                                        <form action="{{ route('courses.destroy', $course['id']) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger delete-action">{{__('config.delete')}}</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <td colspan="6" class="text-danger">{{__('config.data_not_found')}}</td>
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
