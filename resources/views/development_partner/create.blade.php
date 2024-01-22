@extends('layouts.auth-master')
@push('css')
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined:opsz,wght,FILL,GRAD@48,700,0,0"
        rel="stylesheet">
@endpush

@section('content')
    <div class="m-5">
        <h3>
            Create Development Partner
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

        <div class="card p-5 mt-3">
            <form action="{{ route('training-provider-partners.store') }}" method="post">
                @csrf
                <input type="hidden" name="trainingProviderOrgId" value="13">
                @include('development_partner.form')
            </form>
        </div>
    </div>
@section('scripts')
    <script>
        $(document).ready(function() {
            $("#onBoardDate").flatpickr({
                dateFormat: "d/m/Y",
            });
        });
    </script>
@endsection
@endsection
