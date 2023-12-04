@extends('layouts.auth-master')

@section('template_title')
    {{ __('Create') }} Inspectionconfig
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                @if ($errors->any())
                    {{ implode('', $errors->all('<div>:message</div>')) }}
                @endif

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Create') }} Inspectionconfig</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('inspectionconfigs.store') }}" role="form"
                            enctype="multipart/form-data">
                            @csrf

                            @include('inspectionconfig.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
