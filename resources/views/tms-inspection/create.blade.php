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
    <div class="row">
        <div class="col-md-12">

            @includeif('partials.errors')

            <div class="card card-default m-5">
                <div class="card-body">
                    <form method="POST" action="{{ route('tms-inspections.store') }}" role="form"
                        enctype="multipart/form-data">
                        @csrf

                        @include('tms-inspection.form')

                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@push('js')
<script src="https://cdn.ckeditor.com/ckeditor5/40.2.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#remark'))
        .catch(error => {
            console.error(error);
        });
</script>
@endpush