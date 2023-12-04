@extends('layouts.auth-master')
@section('template_title')
    {{ $audittask->name ?? "{{ __('Show') Audittask" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12 m-5">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Audittask</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('audittasks.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="form-group">
                            <strong>Training Title Id:</strong>
                            {{ $audittask->training_title_id }}
                        </div>
                        <div class="form-group">
                            <strong>Batchcode Id:</strong>
                            {{ $audittask->batchCode_id }}
                        </div>
                        <div class="form-group">
                            <strong>Subject:</strong>
                            {{ $audittask->subject }}
                        </div>
                        <div class="form-group">
                            <strong>Instruction:</strong>
                            {{ $audittask->instruction }}
                        </div>
                        <div class="form-group">
                            <strong>Status:</strong>
                            {{ $audittask->status }}
                        </div>
                        <div class="form-group">
                            <strong>Updated At:</strong>
                            {{ $audittask->Updated_at }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
