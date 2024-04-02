@extends('layouts.auth-master')
@push('css')
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined:opsz,wght,FILL,GRAD@48,700,0,0"
        rel="stylesheet">
@endpush

@section('content')
    <div class="m-5">
        <h3>
            Edit Exam Config
        </h3>
        <x-alert />

        @if (session('error_message'))
            {{-- @dump(session('error_message')) --}}
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
        
        @isset($exam_config)
            @php
                if ($exam_config['exam_date']) {
                    $exam_date = \Carbon\Carbon::createFromFormat('Y-m-d', $exam_config['exam_date'])->format('d/m/Y');
                }
            @endphp
            <div class="card p-5 mt-3">
                <div class="card p-5 mt-3">
                    <form action="{{ route('exam-config.update', $exam_config['id']) }}" method="post">
                        @csrf
                        @method('PUT')
                        @include('exam-config.form')
                    </form>
                </div>
            </div>
        @endisset
    </div>
@section('scripts')
    <script>
        $(document).ready(function() {
            let storedExamDate = @json($exam_date) ?? '';
            $("#exam_date").flatpickr({
                dateFormat: "d/m/Y",
                defaultDate: [storedExamDate]
            });
        });
    </script>
@endsection
@endsection
