@extends('layouts.auth-master')
{{-- @dd($running_batches); --}}
@section('content')
    <!--begin::Content-->
    <div class="m-5">
        <h3>{{ __('batch-schedule.ongoing_class') }}</h3>
        <br>
        <x-alert />
        <livewire:ongoing-class>
            {{-- <x-go-back /> --}}
    </div>
    <!--end::Content-->
    @push('js')
        <script>
            
        </script>
    @endpush
@endsection
