@extends('layouts.auth-master')
{{-- @dd($providers); --}}
{{-- @dd($providers[0]) --}}
@section('content')
    <!--begin::Content-->
    <div class="m-5">
        <h3>Head Evaluation List</h3>
        <x-alert />
        @isset($evaluation)
            <div class="my-3 d-flex">
                <div class="w-100">
                    <form action="">
                        <div class="d-flex gap-3">
                            <input type="search" name="search" value="{{ request('search') }}" class="form-control w-75"
                                placeholder="{{ 'search' }}">
                            <input type="submit" class="form-control btn btn-primary w-25" value="{{ 'Search' }}">
                        </div>
                    </form>
                </div>
                <div class="w-100 text-end">
                    <div class="d-flex justify-content-end align-items-center">
                        <a class="btn btn-lg btn-success" href="{{ route('evaluations.create') }}">Create Head Evaluations</a>
                    </div>
                </div>
            </div>
            <table class="table table-bordered bg-white">
                <thead>
                    <th>{{ __('batch-list.sl') }}</th>
                    <th>Title</th>
                    <th>Question Type</th>
                    <th>Used For</th>
                    <th>Max Value</th>
                    <th>Mark</th>
                    <th>Status</th>
                    <th>{{ __('batch-list.action') }}</th>
                </thead>
                <tbody>                    
                    @foreach (collect($evaluation) as $item)
                        <tr>
                            <td>
                                {{ $loop->iteration }}
                            </td>
                            <td>
                                {{ $item['title'] ?? '' }}
                            </td>
                            <td>
                                {{ $item['is_bool'] == 1 ? 'yes no question' : 'others' }}
                            </td>
                            <td>
                                {{ $item['used_for'] == 1 ? 'Student' : 'Teacher' }}

                            </td>
                            <td>
                                {{ $item['max_value'] ?? 0 }}
                            </td>
                            <td>
                                {{ $item['mark'] ?? 0 }}
                            </td>
                            <td>
                                {{ $item['status'] == 1 ? 'Active' : 'Inactive' }}
                            </td>
                            <td class="me-0 d-flex gap-1">
                                
                                    <a href="{{ route('evaluations.edit', $item['id']) }}" class="btn btn-sm btn-info" title="Evaludation Edit">
                                        Edit
                                    </a>
                                    <form action="{{ route('evaluations.destroy', $item['id']) }}" method="post">
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
