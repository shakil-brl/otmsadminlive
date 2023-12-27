<div class="box box-info padding-1">
    <div class="box-body">
        <div class="container">
            <div class="row row-cols-2 g-5">

                <div class="form-group">
                    {{ Form::label('Audit_Officer') }}
                    {{ Form::select('user_id', $users, '', ['class' => 'form-select' . ($errors->has('user_id') ? ' is-invalid' : ''), 'placeholder' => '']) }}
                    {!! $errors->first('user_id', '<div class="invalid-feedback">:message</div>') !!}
                </div>
                <div class="form-group">
                    {{ Form::label('batche') }}
                    {{ Form::select('batche_id', $batches, '', ['class' => 'form-select' . ($errors->has('batche_id') ? ' is-invalid' : ''), 'placeholder' => '']) }}
                    {!! $errors->first('batche_id', '<div class="invalid-feedback">:message</div>') !!}
                </div>
                <div class="form-group">
                    {{-- {{ Form::label('status') }} --}}
                    {{ Form::hidden('status', 1, ['class' => 'form-control' . ($errors->has('status') ? ' is-invalid' : ''), 'placeholder' => 'Status']) }}
                    {!! $errors->first('status', '<div class="invalid-feedback">:message</div>') !!}
                </div>

            </div>
            <div class="box-footer mt20 text-end">
                <button type="submit" class="btn btn-primary  show-loader ">{{ __('Submit') }}</button>
            </div>
        </div>
    </div>

</div>
