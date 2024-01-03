@extends('layouts.auth-master')
@push('css')
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined:opsz,wght,FILL,GRAD@48,700,0,0"
        rel="stylesheet">
@endpush

@section('content')
    <div class="m-5">
        <h3>
            Update Batch Group
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

        @isset($group)
            <div class="card p-5 mt-3">
                <div class="card p-5 mt-3">
                    <form action="{{ route('lots.update', $group['id']) }}" method="post">
                        @csrf
                        @method('PUT')
                        @include('lot.form')
                    </form>
                </div>
            </div>
        @endisset
    </div>
@section('scripts')
    <script></script>
@endsection
@endsection
