@extends('layouts.auth-master')

@section('content')
    <div class="m-5">
        <h3>
            Create Head Evaluation
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
            <form action="{{ route('evaluations.store') }}" method="post">
              
                @csrf
                @include('head-evaluation.form',['error'=>$errors])
            </form>
        </div>
    </div>
@section('scripts')
    <script>
        $(document).ready(function() {
            $("#others").change(function() {
                if ($(this).val() == 0) {
                    $("#max-value").removeAttr("disabled");
                }else{
                    $("#max-value").prop("disabled",true);
                }
            });
        });
    </script>
@endsection
@endsection
