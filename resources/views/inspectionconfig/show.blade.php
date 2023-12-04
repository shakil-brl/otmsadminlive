@extends('layouts.auth-master')

@section('template_title')
    {{ $inspectionconfig->name ?? "{{ __('Show') Inspectionconfig" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Inspectionconfig</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('inspectionconfigs.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="form-group">
                            <strong>Batche Id:</strong>
                            {{ $inspectionconfig->batche_id }}
                        </div>
                        <div class="form-group">
                            <strong>User Id:</strong>
                            @dump($inspectionconfig->batch)
                        </div>
                        <div class="form-group">
                            <strong>Classnum:</strong>
                            {{ $inspectionconfig->classnum }}
                        </div>
                        <div class="form-group">
                            <strong>Labsize:</strong>
                            {{ $inspectionconfig->labsize }}
                        </div>
                        <div class="form-group">
                            <strong>Electricity:</strong>
                            {{ $inspectionconfig->electricity }}
                        </div>
                        <div class="form-group">
                            <strong>Internet:</strong>
                            {{ $inspectionconfig->internet }}
                        </div>
                        <div class="form-group">
                            <strong>Labbill:</strong>
                            {{ $inspectionconfig->labbill }}
                        </div>
                        <div class="form-group">
                            <strong>Labattandance:</strong>
                            {{ $inspectionconfig->labattandance }}
                        </div>
                        <div class="form-group">
                            <strong>Computer:</strong>
                            {{ $inspectionconfig->computer }}
                        </div>
                        <div class="form-group">
                            <strong>Router:</strong>
                            {{ $inspectionconfig->router }}
                        </div>
                        <div class="form-group">
                            <strong>Projectortv:</strong>
                            {{ $inspectionconfig->projectortv }}
                        </div>
                        <div class="form-group">
                            <strong>Usinglaptop:</strong>
                            {{ $inspectionconfig->usinglaptop }}
                        </div>
                        <div class="form-group">
                            <strong>Labsecurity:</strong>
                            {{ $inspectionconfig->labsecurity }}
                        </div>
                        <div class="form-group">
                            <strong>Labreagister:</strong>
                            {{ $inspectionconfig->labreagister }}
                        </div>
                        <div class="form-group">
                            <strong>Classreagulrity:</strong>
                            {{ $inspectionconfig->classreagulrity }}
                        </div>
                        <div class="form-group">
                            <strong>Teacattituted:</strong>
                            {{ $inspectionconfig->teacattituted }}
                        </div>
                        <div class="form-group">
                            <strong>Teaclabatten:</strong>
                            {{ $inspectionconfig->teaclabatten }}
                        </div>
                        <div class="form-group">
                            <strong>Upojelaodit:</strong>
                            {{ $inspectionconfig->upojelaodit }}
                        </div>
                        <div class="form-group">
                            <strong>Upozelamonotring:</strong>
                            {{ $inspectionconfig->upozelamonotring }}
                        </div>
                        <div class="form-group">
                            <strong>Remark:</strong>
                            {{ $inspectionconfig->remark }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
