@extends('layouts.auth-master')

@section('content')
    <!--begin::Content-->
    <div class="m-5">
        @if (in_array('payment-batches.create', $roleRoutePermissions))
            <div class="d-flex justify-content-end align-items-center">
                <a class="btn btn-lg btn-success" href="{{ route('payment-batches.create') }}">
                    Make Payment
                </a>
            </div>
        @endif
        <h3>Payment Batch List</h3>
        <x-alert />

        @isset($results['data'])
            {{-- @dump($results['data']) --}}
            <div class="my-3">
                <div class="my-3">
                    <form action="">
                        <div class="w-50 d-flex gap-3">
                            <input type="search" name="search" value="{{ request('search') }}" class="form-control w-75"
                                placeholder="Search batch">
                            <input type="submit" class="form-control btn btn-primary w-25" value="Search">
                        </div>
                    </form>
                </div>
                <table class="table table-bordered bg-white">
                    <thead>
                        <th>{{ __('batch-list.sl') }}</th>
                        <th>Batch Code</th>
                        <th>Training</th>
                        <th>Vendor</th>
                        <th>Date</th>
                        <th>
                            Total Trainee (D. Allowance)
                        </th>
                        <th>Payment</th>
                        <th>Status</th>
                    </thead>
                    <tbody>
                        @if (count($results['data']) > 0)
                            @foreach ($results['data'] ?? [] as $index => $payment)
                                @php
                                    $from = $results['from'];
                                @endphp
                                <tr>
                                    <td>
                                        {{ $from + $loop->iteration - 1 }}
                                    </td>
                                    <td>
                                        {{-- @dump($payment) --}}
                                        {{ $payment['training_batch']['batchCode'] ?? '' }}
                                        <br>
                                        ({{ $payment['training_batch']['batch_phase']['phase']['name_en'] ?? '' }})
                                    </td>
                                    <td>
                                        {{ $payment['training_batch']['training']['title']['NameEn'] ?? '' }}
                                    </td>
                                    <td>
                                        {{ $payment['training_batch']['provider']['name'] ?? '' }}
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
                                    <td class="me-0 d-flex gap-1">
                                        <a href="{{ route('payment-batches.show', encrypt($payment['id'])) }}"
                                            class="btn btn-sm btn-info">
                                            View
                                        </a>
                                        @if (in_array('payment-batches.destroy', $roleRoutePermissions))
                                            <form action="{{ route('payment-batches.destroy', $payment['id']) }}"
                                                method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="btn btn-sm btn-danger delete-action">{{ __('config.delete') }}</button>
                                            </form>
                                        @endif
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
