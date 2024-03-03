@extends('layouts.auth-master')
{{-- @dd($providers); --}}
{{-- @dd($providers[0]) --}}
@section('content')
    <!--begin::Content-->
    <div class="m-5">
        <h3>Head Evaluation List</h3>
        <x-alert />
        @isset($evaluations)
            <div class="my-3 ">
                <form action="">
                    <div class="row row-cols-5">
                        <div>
                            <select name="status" class="form-select">
                                <option value="">Select</option>
                                <option @if ($request->status === '1') selected @endif value="1">Active</option>
                                <option @if ($request->status === '0') selected @endif value="0">Inactive</option>
                            </select>
                            <input type="search" name="search" value="{{ request('search') }}" class="form-control"
                                placeholder="{{ 'search' }}">
                        </div>
                        <div>
                            <input type="search" name="search" value="{{ request('search') }}" class="form-control"
                                placeholder="{{ 'search' }}">
                        </div>
                        <div>
                            <input type="submit" class="btn btn-primary" value="{{ 'Search' }}">
                        </div>
                    </div>
                </form>
                <div class="d-flex justify-content-end align-items-center">
                    <a class="btn btn-lg btn-success" href="{{ route('evaluation-head.create') }}">Create Head
                        Evaluations</a>

                </div>
            </div>
            <table class="table table-bordered bg-white">
                <thead>
                    <th>Sl. No.</th>
                    <th>Evaluation Question</th>
                    <th>Question Type</th>
                    <th>Question For</th>
                    <th>Mark</th>
                    <th>Status</th>
                    <th>{{ __('batch-list.action') }}</th>
                </thead>
                <tbody>
                    @foreach ($evaluations as $evaluation)
                        <tr>
                            <td>
                                {{ $from + $loop->index }}
                            </td>
                            <td>
                                {{ $evaluation['title'] ?? '' }}
                            </td>
                            <td>
                                @isset($evaluation['is_bool'])
                                    @if ($evaluation['is_bool'])
                                        Yes No Question
                                    @else
                                        Start Marked Question
                                    @endif
                                @endisset
                            </td>
                            <td>
                                @isset($evaluation['type'])
                                    @if ($evaluation['type'] == 1)
                                        Student
                                    @elseif ($evaluation['type'] == 2)
                                        Teacher
                                    @elseif ($evaluation['type'] == 3)
                                        Vendor
                                    @endif
                                @endisset

                            </td>
                            <td>
                                {{ $evaluation['mark'] ?? 0 }}
                            </td>
                            <td>
                                @isset($evaluation['status'])
                                    @if ($evaluation['status'] == 1)
                                        <span class="badge badge-primary">Active</span>
                                    @else
                                        <span class="badge badge-danger">Inactive</span>
                                    @endif
                                @endisset
                            </td>
                            <td class="me-0 d-flex gap-1">
                                <a href="{{ route('evaluation-head.edit', $evaluation['id']) }}" class="btn btn-sm btn-info"
                                    title="Evaludation Edit">
                                    Edit
                                </a>
                                <form action="{{ route('evaluation-head.destroy', $evaluation['id']) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {!! $paginator->links() !!}
        @endisset
    </div>
    <!--end::Content-->

@section('script')
    <script></script>
@endsection

@endsection
