@extends('verify.master')

@section('content')
    <div class="text-center">
        <div class="mt-5">
            <div class="text-center mb-3">
                <div class="badge-warning">
                    <img src="{{ asset('img/icon/warning.png') }}" alt="" class="text-center badge-img">
                    Certificate Not Found
                </div>
            </div>
            <div>
                <a href="{{ url($url ?? '') }}" style="background-color: #2c004e; color:white" class="btn rounded-pill mt-3">Search
                    Again</a>
            </div>
        </div>
    </div>
@endsection
