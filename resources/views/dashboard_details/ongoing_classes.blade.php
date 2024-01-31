@extends('layouts.auth-master')
{{-- @dd($running_batches); --}}
@section('content')
    <!--begin::Content-->
    <div class="m-5">
        <h3>
            @if ($status == 1)
                Pending Class
            @elseif ($status == 3)
                Complete Class
            @else
                {{ __('batch-schedule.ongoing_class') }}
            @endif
        </h3>
        <br>
        <x-alert />
        @livewire('detail.ongoing-class')
    </div>
    <!--end::Content-->
@endsection
