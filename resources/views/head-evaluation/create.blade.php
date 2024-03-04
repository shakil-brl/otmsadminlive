@extends('layouts.auth-master')

@section('content')
    <div class="m-5">
        <h3>
            Create Evaluation Head
        </h3>
        <x-alert />
        @if (isset($error))
            <ul class="text-danger">
                @foreach ($error as $errors)
                    @foreach ($errors as $message)
                        <li>{{ $message }}</li>
                    @endforeach
                @endforeach
            </ul>
        @endif

        <div class="card p-5 mt-3">
            <form action="{{ route('evaluation-head.store') }}" method="post">

                @csrf
                @include('head-evaluation.form', ['error' => $errors])
            </form>
        </div>
    </div>
@endsection
