@extends('layouts.auth-master')
{{-- @dd($running_batches); --}}
@section('content')
    <!--begin::Content-->
    <div class="m-5">
        <h3>{{ __('batch-schedule.ongoing_class') }}</h3>
        <br>
        <x-alert />

        @livewire('detail.ongoing-class')
    </div>
@endsection
