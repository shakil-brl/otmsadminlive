@extends('layouts.auth-master')
@push('css')
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined:opsz,wght,FILL,GRAD@48,700,0,0"
        rel="stylesheet">
@endpush

@section('content')
    <div class="m-5">
        <h3>
            Create Exam Config
        </h3>
        <x-alert />

        @if (session('error_message'))
            <ul class="m-0 text-danger">
                @foreach (session('error_message') ?? [] as $neme => $err)
                    @foreach ($err as $e)
                        <li>
                            {{ $e }}
                        </li>
                    @endforeach
                @endforeach
            </ul>
        @endif

        <div class="card p-5 mt-3">
            <form action="{{ route('exam-config.store') }}" method="post">
                @csrf
                @include('exam-config.form')
            </form>
        </div>
    </div>
@section('scripts')
    <script>
        $(document).ready(function() {
            $("#exam_date").flatpickr({
                dateFormat: "d/m/Y",
            });
        });
    </script>
@endsection
@endsection
