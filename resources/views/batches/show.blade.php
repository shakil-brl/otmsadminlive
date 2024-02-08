@extends('layouts.auth-master')
@push('css')
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined:opsz,wght,FILL,GRAD@48,700,0,0"
        rel="stylesheet">
@endpush
@section('content')
    <div class="card m-5">
        @isset($batch_details)
            <div class="card-header border-0 pt-6">
                <div class="card-title">
                    Batch Details: {{ $batch_details['batchCode'] }}
                </div>
                <div class="card-toolbar">
                </div>
            </div>
            <div class="card-body py-4">
                @if ($batch_details['trainees'])
                    <h3>Trainee List</h3>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>S.N.</th>
                                <th>Name</th>
                                <th>Email-NID</th>
                                <th>Phone</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (collect($batch_details['trainees']) as $trainee)
                                <tr>
                                    <td>{{ $loop->iteration }}.</td>
                                    <td>
                                        <div>
                                            English: {{ $trainee['profile']['KnownAs'] ?? '' }}
                                        </div>
                                        <div>
                                            Bangla: {{ $trainee['profile']['KnownAsBangla'] ?? '' }}
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            Email: {{ $trainee['profile']['Email'] ?? '' }}
                                        </div>
                                        <div>
                                            NID: {{ $trainee['profile']['NID'] ?? '' }}
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            Phone: {{ $trainee['profile']['Phone'] ?? '' }}
                                        </div>
                                        <div>
                                            Phone-2: {{ $trainee['profile']['Phone2'] ?? '' }}
                                        </div>
                                    </td>
                                    <td></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        @endisset
    </div>
@endsection
