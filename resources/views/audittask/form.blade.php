<div class="box box-info padding-1">
    <div class="box-body">
        <div class="container">
            <div class="row row-cols-2 g-5">
                <div class="form-group">
                    {{ Form::label('training_title_id') }}
                    {{ Form::select('training_title_id', $trainingtitles, 'null', ['class' => 'form-select' . ($errors->has('training_title_id') ? ' is-invalid' : ''), 'placeholder' => 'Training Title Id']) }}
                    {!! $errors->first('training_title_id', '<div class="invalid-feedback">:message</div>') !!}
                </div>
                <div class="form-group">
                    {{ Form::label('batchCode_id') }}
                    {{ Form::select('batchCode_id', $batches, 'null', ['class' => 'form-select' . ($errors->has('batchCode_id') ? ' is-invalid' : ''), 'placeholder' => 'Batchcode Id']) }}
                    {!! $errors->first('batchCode_id', '<div class="invalid-feedback">:message</div>') !!}
                </div>
                <div class="form-group">
                    {{ Form::label('subject') }}
                    {{ Form::text('subject', $audittask->subject, ['class' => 'form-control' . ($errors->has('subject') ? ' is-invalid' : ''), 'placeholder' => 'Subject']) }}
                    {!! $errors->first('subject', '<div class="invalid-feedback">:message</div>') !!}
                </div>
                <div class="form-group">
                    {{ Form::label('instruction') }}
                    {{ Form::text('instruction', $audittask->instruction, ['class' => 'form-control' . ($errors->has('instruction') ? ' is-invalid' : ''), 'placeholder' => 'Instruction']) }}
                    {!! $errors->first('instruction', '<div class="invalid-feedback">:message</div>') !!}
                </div>
                <div class="form-group">
                    {{ Form::label('status') }}
                    {{ Form::hidden('status', 1, ['class' => 'form-control' . ($errors->has('status') ? ' is-invalid' : ''), 'placeholder' => 'Status']) }}
                    {!! $errors->first('status', '<div class="invalid-feedback">:message</div>') !!}
                </div>

            </div>
        </div>
    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary  show-loader ">{{ __('Submit') }}</button>
    </div>
</div>
