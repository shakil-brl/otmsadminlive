@extends('layouts.auth-master')
@push('css')
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined:opsz,wght,FILL,GRAD@48,700,0,0"
        rel="stylesheet">
@endpush

@section('content')
    <div class="m-5">
        @livewire('list.attendance-report', ['batch' => $batch])
    </div>
@endsection

@section('scripts')
    <script></script>
@endsection
