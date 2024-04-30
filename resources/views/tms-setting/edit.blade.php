@extends('layouts.auth-master')

@section('content')
    <div class="m-5">
        <div class="card p-5">
            <h3 class="text-center">Update File</h3>
            @if (session('error_message'))
                <ul class="text-danger">
                    @foreach (session('error_message') ?? [] as $neme => $err)
                        @foreach ($err as $e)
                            <li>
                                {{ $e }}
                            </li>
                        @endforeach
                    @endforeach
                </ul>
            @endif

            <div class="border rounded p-5 mt-5">
                <form class="" action="{{ route('tms-settings.update', $setting['id']) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('patch')
                    <div class="text-center">
                        @if ($setting['type'] != 'text')
                            <figure>
                                <img src="{{ asset('storage/' . $setting['value']) }}" alt="" width="250px">
                                <figcaption>Img: Existing Image</figcaption>
                            </figure>
                        @endif
                    </div>
                    @include('tms-setting.form')

                    <div class="mb-3 text-center">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
