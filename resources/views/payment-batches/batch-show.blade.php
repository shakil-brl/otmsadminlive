@extends('layouts.auth-master')

@section('content')
    <!--begin::Content-->
    <div class="m-5">
        <h3>Payment List</h3>
        <x-alert />

        @isset($payments)
            <div class="my-3">
                <table class="table table-bordered bg-white">
                    <thead>
                        <th>{{ __('batch-list.sl') }}</th>
                        <th>Date</th>
                        <th>
                            Total Trainee (D. Allowance)
                        </th>
                        <th>Payment</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </thead>
                    <tbody>
                        @if (count($payments) > 0)
                            @foreach ($payments ?? [] as $index => $payment)
                                <tr>
                                    <td>
                                        {{ $loop->iteration }}
                                    </td>
                                    <td>
                                        <div>
                                            Start:
                                            {{ isset($payment['start_date']) ? \Carbon\Carbon::parse($payment['start_date'])->format('d-m-Y') : '' }}
                                        </div>
                                        End:
                                        {{ isset($payment['end_date']) ? \Carbon\Carbon::parse($payment['end_date'])->format('d-m-Y') : '' }}
                                    </td>
                                    <td>
                                        <div>
                                            {{ $payment['total_students'] ?? '' }}
                                        </div>
                                        {{ $payment['daily_allowance'] ?? '' }} Tk
                                    </td>
                                    <td>
                                        {{ $payment['total_payment_amount'] ?? '' }} Tk
                                    </td>
                                    <td>
                                        {{ $payment['status'] ? ($payment['status'] == 1 ? 'Active' : 'Inactive') : '' }}
                                    </td>
                                    <td class="me-0 d-flex gap-1">
                                        <a href="{{ route('payment-batches.show', encrypt($payment['id'])) }}"
                                            class="btn btn-sm btn-info">
                                            View
                                        </a>
                                        {{-- <form action="{{ route('payment-batches.destroy', $payment['id']) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="btn btn-sm btn-danger delete-action">{{ __('config.delete') }}</button>
                                        </form> --}}
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
    {{-- <script>
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
    </script> --}}
@endsection
@endsection
