@extends('layouts.auth-master')

@section('content')
    <div class="m-5">
        <div class="card p-5">
            <h3 class="text-center">Create Setting</h3>

            <x-alert />

            <div class="border rounded p-5 mt-5">
                @if (session('error_message'))
                    <ul class="text-danger">
                        @foreach (session('error_message') ?? [] as $name => $err)
                            @foreach ($err as $e)
                                <li>
                                    {{ $e }}
                                </li>
                            @endforeach
                        @endforeach
                    </ul>
                @endif
                <form class="" action="{{ route('tms-settings.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    @include('tms-setting.form')

                    <div class="mb-3 text-center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


