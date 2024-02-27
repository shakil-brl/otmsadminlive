@extends('layouts.auth-master')
@push('css')
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined:opsz,wght,FILL,GRAD@48,700,0,0"
        rel="stylesheet">
@endpush

@section('content')
    <div class="m-5">
        <h3>
            Edit Payment Batch
        </h3>
        <x-alert />

        @if (session('error_message'))
            <ul class="m-0 text-danger">
                @foreach (session('error_message') ?? [] as $neme => $err)
                    @foreach ($err as $e)
                        <li>
                            {{ $e }}
                        </li>
                    @endforeach
                @endforeach
            </ul>
        @endif

        @isset($payment_batch)
            {{-- @php
                if ($payment_batch['start_date']) {
                    $start_date = \Carbon\Carbon::createFromFormat('Y-m-d', $payment_batch['start_date'])->format('d/m/Y');
                }
                if ($payment_batch['end_date']) {
                    $end_date = \Carbon\Carbon::createFromFormat('Y-m-d', $payment_batch['end_date'])->format('d/m/Y');
                }
            @endphp --}}
            <div class="card p-5 mt-3">
                <div class="card p-5 mt-3">
                    <form action="{{ route('payment-batches.update', $payment_batch['id']) }}" method="post">
                        @csrf
                        @method('PUT')
                        @include('payment-batches.form')
                    </form>
                </div>
            </div>
        @endisset
    </div>
@section('scripts')
    <script>
        
    </script>
@endsection
@endsection
