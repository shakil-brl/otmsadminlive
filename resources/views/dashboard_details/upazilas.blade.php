@extends('layouts.auth-master')

@section('content')
    <!--begin::Content-->
    <div class="m-5">
        <h3>Upazilas List</h3>
        <x-alert />
        @isset($total_upazilas)
            <div class="my-3">
                <form action="">
                    <div class="w-50 d-flex gap-3">
                        <input type="search" name="search" value="{{ request('search') }}" class="form-control w-75"
                            placeholder="search here">
                        <input type="submit" class="form-control btn btn-primary w-25" value="Search">
                    </div>
                </form>
            </div>
            <table class="table table-bordered bg-white">
                <thead>
                    <th>S/N</th>
                    <th>Code</th>
                    <th>Name</th>
                    <th>Name (Bangla)</th>
                    <th>District</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                    @foreach (collect($total_upazilas) as $upazilas)
                        <tr>
                            <td>
                                {{ $loop->iteration }}
                            </td>
                            <td>
                                {{ $upazilas['Code'] }}
                            </td>
                            <td>
                                {{ $upazilas['NameEng'] }}
                            </td>
                            <td>
                                {{ $upazilas['Name'] }}
                            </td>
                            <td>
                                {{ $upazilas['district']['NameEng'] }}
                            </td>
                            <td>
                                <a href="" class="btn btn-sm btn-info">
                                    View
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {!! $paginator->links() !!}
        @endisset
    </div>
@endsection
