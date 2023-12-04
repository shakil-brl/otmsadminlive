@extends('layouts.auth-master')

@section('template_title')
    {{ $auditMaster->name ?? "{{ __('Show') Audit Master" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12 m-5">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Audit Master</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('audit-masters.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="form-group">
                            <strong>User Id:</strong>
                            {{ $auditMaster->user_id }}
                        </div>
                        <div class="form-group">
                            <strong>Batche Id:</strong>
                            {{ $auditMaster->batche_id }}
                        </div>
                        <div class="form-group">
                            <strong>Status:</strong>
                            {{ $auditMaster->status }}
                        </div>
                        <div class="form-group">
                            <strong>Updated At:</strong>
                            {{ $auditMaster->Updated_at }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
