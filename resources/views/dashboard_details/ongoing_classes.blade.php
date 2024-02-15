@extends('layouts.auth-master')
@section('content')
    <div class="m-5">

        <x-alert />
        @livewire('detail.ongoing-class')
    </div>
@endsection
