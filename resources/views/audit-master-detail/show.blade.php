@extends('layouts.auth-master')

@section('template_title')
    {{ $auditMasterDetail->name ?? "{{ __('Show') Audit Master Detail" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12 m-5">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Audit Master Detail</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('audit-master-details.index') }}">
                                {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="form-group">
                            <strong>Auditmaster Id:</strong>
                            {{ $auditMasterDetail->auditmaster_id }}
                        </div>
                        <div class="form-group">
                            <strong>Audittasks Id:</strong>
                            {{ $auditMasterDetail->audittasks_id }}
                        </div>
                        <div class="form-group">
                            <strong>Remark:</strong>
                            {{ $auditMasterDetail->remark }}
                        </div>
                        <div class="form-group">
                            <strong>Document:</strong>
                            {{ $auditMasterDetail->document }}
                        </div>
                        <div class="form-group">
                            <strong>Updated At:</strong>
                            {{ $auditMasterDetail->Updated_at }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
