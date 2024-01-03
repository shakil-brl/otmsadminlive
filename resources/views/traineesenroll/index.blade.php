@extends('layouts.auth-master')
@section('content')
    <div class="mx-5 mb-2">
        <h1 class="page-heading d-flex mb-4 text-dark fw-bold fs-3 flex-column justify-content-center my-0">
            {{ __('trainee-enrollment-list.trainee_enrollment') }}
        </h1>
        <form action="" style="max-width: 400px;">
            <div class="input-group mb-4">
                <input type="search" name="search" value="{{ request('search') }}" class="form-control w-75"
                    placeholder="{{ __('batch-list.search_here') }}">
                <button type="submit" class="btn btn-primary input-group-text">
                    {{ __('batch-list.search') }}</button>
            </div>
        </form>
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered">
                    <thead class="bg-secondary">
                        <tr>
                            <th>সিরিয়াল নং</th>
                            <th>নাম</th>
                            <th>ইমেইল</th>
                            <th>জাতীয় পরিচয়পত্র</th>
                            <th>মোবাইল নং</th>
                            <th>পিতার নাম</th>
                            <th>মাতার নাম</th>
                            <th>বর্তমান ঠিকানা</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($trainees as $trainee)
                            @php
                                $profile = $trainee['profile'] ?? [];
                            @endphp
                            <tr>
                                <td>
                                    {{ $page_from + $loop->index }}
                                </td>
                                <td>{{ $profile['KnownAs'] ?? '' }}</td>
                                <td>{{ $profile['Email'] ?? '' }}</td>
                                <td>{{ $profile['NID'] ?? '' }}</td>
                                <td>{{ $profile['Phone'] ?? '' }}</td>
                                <td>{{ $profile['FatherNameBangla'] ?? '' }}</td>
                                <td>{{ $profile['MotherNameBangla'] ?? '' }}</td>
                                <td>{{ $profile['address_present'] ?? '' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{ $paginator->links() }}
            </div>
        </div>
    </div>
@endsection
