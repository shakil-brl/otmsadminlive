@extends('layouts.auth-master')

@section('template_title')
    {{ __('Create') }} Tms Inspection
@endsection
@push('css')
    <style>
        .ck.ck-reset.ck-editor.ck-rounded-corners {
            width: 100%;
        }
    </style>
@endpush
@section('content')

    <section class="content container-fluid">
        <div class="mx-5 mt-5">
            <x-batch-header :batch="$batch" />
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="text-danger">{{ $error }}</div>
                @endforeach
            @endif
        </div>

        @includeif('partials.errors')

        <h3 class="text-center mt-5">প্রশিক্ষণ পরিদর্শনের রিপোর্ট</h3>

        <div class="card card-default m-5">
            <div class="card-body">
                <form method="POST" action="{{ route('tms-inspections.store') }}" role="form" enctype="multipart/form-data">
                    @csrf

                    @include('tms-inspection.form')

                </form>
            </div>
        </div>
    </section>
@endsection
@push('js')
    <script>
        ClassicEditor
            .create(document.querySelector('#remark'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endpush
