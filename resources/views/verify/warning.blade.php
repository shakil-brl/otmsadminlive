@extends('verify.master')

@section('content')
    <div class="text-center">
        <div class="mt-5">
            <img src="{{ asset('front') }}/img/warning.svg" class="" width="100" alt="">
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
