@row
    
        <div class="form-group">
            {{ Form::label('batch_id') }}
            {{ Form::text('batch_id', $tmsInspection->batch_id, ['class' => 'form-control' . ($errors->has('batch_id') ? ' is-invalid' : '')]) }}
            {!! $errors->first('batch_id', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('class_no') }}
            {{ Form::text('class_no', $tmsInspection->class_no, ['class' => 'form-control' . ($errors->has('class_no') ? ' is-invalid' : '')]) }}
            {!! $errors->first('class_no', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('lab_size') }}
            {{ Form::text('lab_size', $tmsInspection->lab_size, ['class' => 'form-control' . ($errors->has('lab_size') ? ' is-invalid' : '')]) }}
            {!! $errors->first('lab_size', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('electricity') }}
            {{ Form::text('electricity', $tmsInspection->electricity, ['class' => 'form-control' . ($errors->has('electricity') ? ' is-invalid' : '')]) }}
            {!! $errors->first('electricity', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('internet') }}
            {{ Form::text('internet', $tmsInspection->internet, ['class' => 'form-control' . ($errors->has('internet') ? ' is-invalid' : '')]) }}
            {!! $errors->first('internet', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('lab_bill') }}
            {{ Form::text('lab_bill', $tmsInspection->lab_bill, ['class' => 'form-control' . ($errors->has('lab_bill') ? ' is-invalid' : '')]) }}
            {!! $errors->first('lab_bill', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('lab_attendance') }}
            {{ Form::text('lab_attendance', $tmsInspection->lab_attendance, ['class' => 'form-control' . ($errors->has('lab_attendance') ? ' is-invalid' : '')]) }}
            {!! $errors->first('lab_attendance', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('computer') }}
            {{ Form::text('computer', $tmsInspection->computer, ['class' => 'form-control' . ($errors->has('computer') ? ' is-invalid' : '')]) }}
            {!! $errors->first('computer', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('router') }}
            {{ Form::text('router', $tmsInspection->router, ['class' => 'form-control' . ($errors->has('router') ? ' is-invalid' : '')]) }}
            {!! $errors->first('router', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('projector') }}
            {{ Form::text('projector', $tmsInspection->projector, ['class' => 'form-control' . ($errors->has('projector') ? ' is-invalid' : '')]) }}
            {!! $errors->first('projector', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('student_laptop') }}
            {{ Form::text('student_laptop', $tmsInspection->student_laptop, ['class' => 'form-control' . ($errors->has('student_laptop') ? ' is-invalid' : '')]) }}
            {!! $errors->first('student_laptop', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('lab_security') }}
            {{ Form::text('lab_security', $tmsInspection->lab_security, ['class' => 'form-control' . ($errors->has('lab_security') ? ' is-invalid' : '')]) }}
            {!! $errors->first('lab_security', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('lab_register') }}
            {{ Form::text('lab_register', $tmsInspection->lab_register, ['class' => 'form-control' . ($errors->has('lab_register') ? ' is-invalid' : '')]) }}
            {!! $errors->first('lab_register', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('class_regularity') }}
            {{ Form::text('class_regularity', $tmsInspection->class_regularity, ['class' => 'form-control' . ($errors->has('class_regularity') ? ' is-invalid' : '')]) }}
            {!! $errors->first('class_regularity', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('trainer_attituted') }}
            {{ Form::text('trainer_attituted', $tmsInspection->trainer_attituted, ['class' => 'form-control' . ($errors->has('trainer_attituted') ? ' is-invalid' : '')]) }}
            {!! $errors->first('trainer_attituted', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('trainer_tab_attendance') }}
            {{ Form::text('trainer_tab_attendance', $tmsInspection->trainer_tab_attendance, ['class' => 'form-control' . ($errors->has('trainer_tab_attendance') ? ' is-invalid' : '')]) }}
            {!! $errors->first('trainer_tab_attendance', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('upazila_audit') }}
            {{ Form::text('upazila_audit', $tmsInspection->upazila_audit, ['class' => 'form-control' . ($errors->has('upazila_audit') ? ' is-invalid' : '')]) }}
            {!! $errors->first('upazila_audit', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('upazila_monitoring') }}
            {{ Form::text('upazila_monitoring', $tmsInspection->upazila_monitoring, ['class' => 'form-control' . ($errors->has('upazila_monitoring') ? ' is-invalid' : '')]) }}
            {!! $errors->first('upazila_monitoring', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('remark') }}
            {{ Form::text('remark', $tmsInspection->remark, ['class' => 'form-control' . ($errors->has('remark') ? ' is-invalid' : '')]) }}
            {!! $errors->first('remark', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('asset_list') }}
            {{ Form::text('asset_list', $tmsInspection->asset_list, ['class' => 'form-control' . ($errors->has('asset_list') ? ' is-invalid' : '')]) }}
            {!! $errors->first('asset_list', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('created_by') }}
            {{ Form::text('created_by', $tmsInspection->created_by, ['class' => 'form-control' . ($errors->has('created_by') ? ' is-invalid' : '')]) }}
            {!! $errors->first('created_by', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('updated_by') }}
            {{ Form::text('updated_by', $tmsInspection->updated_by, ['class' => 'form-control' . ($errors->has('updated_by') ? ' is-invalid' : '')]) }}
            {!! $errors->first('updated_by', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Updated_at') }}
            {{ Form::text('Updated_at', $tmsInspection->Updated_at, ['class' => 'form-control' . ($errors->has('Updated_at') ? ' is-invalid' : '')]) }}
            {!! $errors->first('Updated_at', '<small class="text-danger danger d-block">:message</small>') !!}
        </div>

@endrow
<div class="mt-3">
    <button type="submit" class="btn btn-primary">Submit</button>
</div>