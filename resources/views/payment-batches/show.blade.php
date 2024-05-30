@extends('layouts.auth-master')

@section('content')
    <!--begin::Content-->
    <div class="m-5">
        <h3>Payment Details</h3>
        <x-alert />

        @isset($data)
            {{-- @dump($data) --}}
            <div class="my-3">
                <div class="fw-bold mb-3">
                    <div>
                        <div>
                            Batch Code: {{ $data['training_batch']['batchCode'] ?? '' }}
                        </div>
                        <div>
                            Course Title: {{ $data['training_batch']['get_training']['title']['Name'] }}
                        </div>
                    </div>
                    <div>
                        From Date:
                        {{ isset($data['start_date']) ? \Carbon\Carbon::parse($data['start_date'])->format('d-m-Y') : '' }}
                    </div>
                    <div>
                        To Date:
                        {{ isset($data['end_date']) ? \Carbon\Carbon::parse($data['end_date'])->format('d-m-Y') : '' }}
                    </div>
                    <div>
                        <div>Daily Allowance: {{ $data['daily_allowance'] }}</div>
                        <div>Total Trainee: {{ $data['total_students'] }}</div>
                        <div>Total Payment Amount: {{ $data['total_payment_amount'] }}</div>
                    </div>
                </div>
                <h5>Payment Received Trainee List</h5>
                <table class="table table-bordered bg-white">
                    <thead>
                        <th>{{ __('batch-list.sl') }}</th>
                        <th>Name</th>
                        <th>phone</th>
                        <th>Total Class</th>
                        <th>Payment Amount</th>
                    </thead>
                    <tbody>
                        @if (count($data['payment_details']) > 0)
                            @foreach ($data['payment_details'] ?? [] as $index => $item)
                                <tr>
                                    <td>
                                        {{ $loop->iteration }}
                                    </td>
                                    <td>
                                        {{ $item['profile']['KnownAs'] }}
                                    </td>
                                    <td>
                                        {{ $item['profile']['Phone'] }}
                                    </td>
                                    <td>
                                        {{ $item['number_of_class'] ?? '' }}
                                    </td>
                                    <td>
                                        {{ $item['payment_amount'] ?? '' }} Tk
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5" class="text-danger">No data found</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        @endisset
    </div>
@section('scripts')
@endsection
@endsection
