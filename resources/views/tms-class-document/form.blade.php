@row
    
        <div class="form-group">
            {{ Form::label('tms_batch_schedule_detail_id') }}
            {{ Form::text('tms_batch_schedule_detail_id', $tmsClassDocument->tms_batch_schedule_detail_id, ['class' => 'form-control' . ($errors->has('tms_batch_schedule_detail_id') ? ' is-invalid' : '')]) }}
            {!! $errors->first('tms_batch_schedule_detail_id', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('document_title') }}
            {{ Form::text('document_title', $tmsClassDocument->document_title, ['class' => 'form-control' . ($errors->has('document_title') ? ' is-invalid' : '')]) }}
            {!! $errors->first('document_title', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('description') }}
            {{ Form::text('description', $tmsClassDocument->description, ['class' => 'form-control' . ($errors->has('description') ? ' is-invalid' : '')]) }}
            {!! $errors->first('description', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('document_path') }}
            {{ Form::text('document_path', $tmsClassDocument->document_path, ['class' => 'form-control' . ($errors->has('document_path') ? ' is-invalid' : '')]) }}
            {!! $errors->first('document_path', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('tms_course_id') }}
            {{ Form::text('tms_course_id', $tmsClassDocument->tms_course_id, ['class' => 'form-control' . ($errors->has('tms_course_id') ? ' is-invalid' : '')]) }}
            {!! $errors->first('tms_course_id', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('doc_type') }}
            {{ Form::text('doc_type', $tmsClassDocument->doc_type, ['class' => 'form-control' . ($errors->has('doc_type') ? ' is-invalid' : '')]) }}
            {!! $errors->first('doc_type', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>

@endrow
<div class="mt-3">
    <button type="submit" class="btn btn-primary">Submit</button>
</div>