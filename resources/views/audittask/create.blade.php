@extends('layouts.auth-master')

@section('template_title')
    {{ __('Create') }} Audittask
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12 m-5">

                @includeif('partials.errors')


                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Create') }} Audittask</span>
                    </div>
                    <div class="card-body">


                        <form method="POST" action="{{ route('audittasks.store') }}" role="form"
                            enctype="multipart/form-data">
                            @csrf

                            @include('audittask.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
