@extends('verify.master')

@section('content')
    <div class="text-center">
        <form method="POST" action="{{ url('verify') }}">
            @csrf
            <div style="max-width: 500px; margin: auto; margin-top: 50px;  margin-bottom: 20px;" class="input-group ss px-3">
                <input required="" style="border-color: #2c004e; border-radius:  100px 0 0 100px;" type="text"
                    name="certificate_no" placeholder="{{ $placeholder ?? '' }}" class="form-control pl-4">
                <div class="input-group-append">
                    <button style="background: #2c004e;border-color: #2c004e; border-radius: 0 100px 100px 0;"
                        type="submit" class="btn btn-danger">
                        Search</button>
                </div>
            </div>
        </form>
    </div>
@endsection
