@extends('verify.master')

@section('content')
    <div class="text-center">
        <div class="mt-5">
            <div class="text-center mb-3">
                <div class="badge-warning">
                    <img src="{{ asset('img/icon/warning.png') }}" alt="" class="text-center badge-img">
                    Unvarified Certificate
                </div>
            </div>
            <div>
                <div style="font-size: 20px;" class="text-danger">
                    ID <b>{{ $id ?? '' }}</b> not found. <br>
                </div>
                <a href="{{ url($url ?? '') }}" style="background: #2c004e;" class="btn btn-primary rounded-pill mt-3">Search
                    Again</a>
            </div>
        </div>
    </div>
@endsection
