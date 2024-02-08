@extends('layouts.auth-master')
@push('css')
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined:opsz,wght,FILL,GRAD@48,700,0,0"
        rel="stylesheet">
@endpush

@section('content')
    <div class="m-5">
        <h3>
            {{ __('config.edit_development_partner') }}
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

        @isset($partner)
            @php
                if ($partner['onBoardDate']) {
                    // dd($partner['onBoardDate']);
                    $onBoardDate = \Carbon\Carbon::createFromFormat('Y-m-d', $partner['onBoardDate'])->format('d/m/Y');
                }
            @endphp
            <div class="card p-5 mt-3">
                <div class="card p-5 mt-3">
                    <form action="{{ route('training-provider-partners.update', $partner['id']) }}" method="post">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="trainingProviderOrgId" value="13">
                        @include('development_partner.form')
                    </form>
                </div>
            </div>
        @endisset
    </div>
@section('scripts')
    <script>
        $(document).ready(function() {
            let storedonBoardDate = @json($onBoardDate) ?? '';
            $("#onBoardDate").flatpickr({
                dateFormat: "d/m/Y",
                defaultDate: [storedonBoardDate]
            });
        });
    </script>
@endsection
@endsection
