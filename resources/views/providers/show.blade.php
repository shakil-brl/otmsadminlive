@extends('layouts.auth-master')
@section('content')
    <div class="m-5">
        <x-alert />
        <div class="card p-5">
            @isset($provider)
                <div id="">
                    <h3>{{ $provider['name'] ?? '' }} Details:</h3>
                    <div>
                        <div>Phone: {{ $provider['phone'] ?? '' }}</div>
                        <div>Email: {{ $provider['email'] ?? '' }}</div>
                        <div>Address: {{ $provider['address'] ?? '' }}</div>
                    </div>
                </div>
                <div class="mt-5">
                    <h4>All Batches</h4>
                    <div class="my-3">
                        <table class="table table-bordered bg-white">
                            <thead>
                                <th>{{ __('batch-list.sl') }}</th>
                                <th>Batch Code</th>
                                <th>Course Title</th>
                                <th>Location</th>
                                <th>Total Trainee</th>
                                <th>{{ __('batch-list.action') }}</th>
                            </thead>
                            <tbody>
                                @foreach (collect($provider['training_batches']) as $batch)
                                    {{-- @dump($batch) --}}
                                    <tr>
                                        <td>
                                            {{ $loop->iteration }}
                                        </td>
                                        <td>
                                            {{ $batch['batchCode'] ?? '' }}
                                        </td>
                                        <td>
                                            {{ $batch['training']['title']['Name'] ?? '' }}
                                        </td>
                                        <td>
                                            {{ $batch['GEOLocation'] ?? '' }}
                                        </td>
                                        <td>
                                            {{ $batch['startDate'] ?? '' }}
                                        </td>
                                        <td>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endisset
        </div>
    </div>
@section('script')
    <script></script>
@endsection
@endsection
