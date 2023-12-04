@extends('layouts.auth-master')

@section('template_title')
    {{ __('Update') }} Audit Master Detail
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12 m-5">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Update') }} Audit Master Detail</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('audit-master-details.update', $auditMasterDetail->id) }}"
                            role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('audit-master-detail.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
