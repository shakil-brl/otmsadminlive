<div class="box box-info padding-1">
    <div class="box-body">
        <div class="container">
            <div class="row row-cols-2">
                <div class="form-group">
                    {{ Form::label('auditmaster_id') }}
                    {{ Form::text('auditmaster_id', $auditMasterDetail->auditmaster_id, ['class' => 'form-control' . ($errors->has('auditmaster_id') ? ' is-invalid' : ''), 'placeholder' => 'Auditmaster Id']) }}
                    {!! $errors->first('auditmaster_id', '<div class="invalid-feedback">:message</div>') !!}
                </div>
                <div class="form-group">
                    {{ Form::label('audittasks_id') }}
                    {{ Form::text('audittasks_id', $auditMasterDetail->audittasks_id, ['class' => 'form-control' . ($errors->has('audittasks_id') ? ' is-invalid' : ''), 'placeholder' => 'Audittasks Id']) }}
                    {!! $errors->first('audittasks_id', '<div class="invalid-feedback">:message</div>') !!}
                </div>
                <div class="form-group">
                    {{ Form::label('remark') }}
                    {{ Form::text('remark', $auditMasterDetail->remark, ['class' => 'form-control' . ($errors->has('remark') ? ' is-invalid' : ''), 'placeholder' => 'Remark']) }}
                    {!! $errors->first('remark', '<div class="invalid-feedback">:message</div>') !!}
                </div>
                <div class="form-group">
                    {{ Form::label('document') }}
                    {{ Form::text('document', $auditMasterDetail->document, ['class' => 'form-control' . ($errors->has('document') ? ' is-invalid' : ''), 'placeholder' => 'Document']) }}
                    {!! $errors->first('document', '<div class="invalid-feedback">:message</div>') !!}
                </div>
                <div class="form-group">
                    {{ Form::label('Updated_at') }}
                    {{ Form::text('Updated_at', $auditMasterDetail->Updated_at, ['class' => 'form-control' . ($errors->has('Updated_at') ? ' is-invalid' : ''), 'placeholder' => 'Updated At']) }}
                    {!! $errors->first('Updated_at', '<div class="invalid-feedback">:message</div>') !!}
                </div>

            </div>
        </div>
    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>
