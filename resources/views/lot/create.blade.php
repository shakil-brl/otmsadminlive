@extends('layouts.auth-master')
@push('css')
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined:opsz,wght,FILL,GRAD@48,700,0,0"
        rel="stylesheet">
@endpush

@section('content')
    <div class="m-5">
        <h3>
            Create Holyday
        </h3>
        <x-alert />
        @isset($error)
            @if ($error)
                @if (is_string($error))
                    <span class="text-danger">
                        <div class="alert close alert-danger alert-dismissible fade show" role="alert">
                            <strong>Error : </strong>
                            {{ $error ?? '' }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </span>
                @else
                    <ul class="m-0 text-danger">
                        @foreach ($error ?? [] as $err)
                            @foreach ($err as $e)
                                <li>
                                    {{ $e }}
                                </li>
                            @endforeach
                        @endforeach
                    </ul>
                @endif
            @endif
        @endisset

        <div class="card p-5 mt-3">
            <form action="{{ route('holydays.store') }}" method="post">
                @csrf
                @include('holyday.form')
            </form>
        </div>
    </div>
@section('scripts')
    <script>
        $(document).ready(function() {
            $("#holly_bay").flatpickr({
                dateFormat: "d/m/Y",
            });
        });
    </script>
@endsection
@endsection
