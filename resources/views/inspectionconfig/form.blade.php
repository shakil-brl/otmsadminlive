<div class="box box-info padding-1">
    <div class="box-body">
        <div class="form-group hide">
            {{-- {{ Form::label('batche_id', 'প্রশিক্ষণ ক্যাটাগরি ') }} --}}
            {{ Form::hidden('batche_id', 7, ['class' => 'form-control' . ($errors->has('batche_id') ? ' is-invalid' : ''), 'placeholder' => '']) }}
            {!! $errors->first('batche_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group hide">
            {{ Form::label('classnum', 'কত তম ক্লাস?') }}
            {{ Form::hidden('classnum', 10, ['class' => 'form-control' . ($errors->has('classnum') ? ' is-invalid' : ''), 'placeholder' => '']) }}
            {!! $errors->first('classnum', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="row row-cols-sm-2 row-cols-md-3 g-5">
            @php
                $yesno = ['1' => 'হ্যাঁ', '0' => 'না'];
            @endphp

            <div class="form-group">
                {{ Form::label('labsize', 'ল্যাব কক্ষ এর সাইজ ঠিক আছে কিনা?') }}
                {{ Form::select('labsize', $yesno, 'null', ['class' => 'form-select' . ($errors->has('labsize') ? ' is-invalid' : '')]) }}
                {!! $errors->first('labsize', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="form-group">
                {{ Form::label('electricity', 'সার্বক্ষণিক বিদ্যুৎ সংযোগ আছে কিনা?') }}
                {{ Form::select('electricity', $yesno, 'null', ['class' => 'form-select' . ($errors->has('electricity') ? ' is-invalid' : ''), 'placeholder' => '']) }}
                {!! $errors->first('electricity', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="form-group">
                {{ Form::label('internet', 'ল্যাবে সার্বক্ষনিক ইন্টারনেট সংযোগ নিশ্চিত করা হয়েছে কিনা?') }}
                {{ Form::select('internet', $yesno, 'null', ['class' => 'form-select' . ($errors->has('internet') ? ' is-invalid' : ''), 'placeholder' => '']) }}
                {!! $errors->first('internet', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="form-group">
                {{ Form::label('labbill', 'ল্যাবের ভাড়া নিয়মিত পরিশোধ করা হয় কিনা?') }}
                {{ Form::select('labbill', $yesno, 'null', ['class' => 'form-select' . ($errors->has('labbill') ? ' is-invalid' : ''), 'placeholder' => '']) }}
                {!! $errors->first('labbill', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="form-group">
                {{ Form::label('labattandance', 'ল্যাবের জন্য সার্বক্ষণিক ল্যাব রক্ষণাবেক্ষণ সহকারী আছে কিনা?') }}
                {{ Form::select('labattandance', $yesno, 'null', ['class' => 'form-select' . ($errors->has('labattandance') ? ' is-invalid' : ''), 'placeholder' => '']) }}
                {!! $errors->first('labattandance', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="form-group">
                {{ Form::label('computer', 'কম্পিউটার সচল আছে কিনা') }}
                {{ Form::select('computer', $yesno, 'null', ['class' => 'form-select' . ($errors->has('computer') ? ' is-invalid' : ''), 'placeholder' => '']) }}
                {!! $errors->first('computer', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="form-group">
                {{ Form::label('router', 'রাউটার সচল আছে কিনা') }}
                {{ Form::select('router', $yesno, 'null', ['class' => 'form-select' . ($errors->has('router') ? ' is-invalid' : ''), 'placeholder' => '']) }}
                {!! $errors->first('router', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="form-group">
                {{ Form::label('projectortv', 'প্রজেক্টর/টিভি সচল আছে কিনা') }}
                {{ Form::select('projectortv', $yesno, 'null', ['class' => 'form-select' . ($errors->has('projectortv') ? ' is-invalid' : ''), 'placeholder' => '']) }}
                {!! $errors->first('projectortv', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="form-group">
                {{ Form::label('usinglaptop', 'ল্যাবের ল্যাপটপ প্রশিক্ষনার্থীগণ ব্যবহার করেছে এ বিষয়ে পর্যবেক্ষণ।') }}
                {{ Form::select('usinglaptop', $yesno, 'null', ['class' => 'form-select' . ($errors->has('usinglaptop') ? ' is-invalid' : ''), 'placeholder' => '']) }}
                {!! $errors->first('usinglaptop', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="form-group">
                {{ Form::label('labsecurity', 'ল্যাবের নিরাপত্তা,  পরিস্কার পরিচ্ছন্ন ও সার্বিক পরিবেশ সম্পর্কিত বিষয়গুলো সম্পর্কিত পযবেক্ষণ।') }}
                {{ Form::select('labsecurity', $yesno, 'null', ['class' => 'form-select' . ($errors->has('labsecurity') ? ' is-invalid' : ''), 'placeholder' => '']) }}
                {!! $errors->first('labsecurity', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="form-group">
                {{ Form::label('labreagister', 'পরিদর্শন রেজিষ্টার, প্রশিক্ষক হাজিরা রেজিষ্টার, প্রশিক্ষণার্থী হাজিরা রেজিষ্টার আছে কিনা? রেজিষ্টার নিয়মিত হালনাগাদ করা হয় কিনা?') }}
                {{ Form::select('labreagister', $yesno, 'null', ['class' => 'form-select' . ($errors->has('labreagister') ? ' is-invalid' : ''), 'placeholder' => '']) }}
                {!! $errors->first('labreagister', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="form-group">
                {{ Form::label('classreagulrity', 'প্রশিক্ষক নিয়মিত ক্লাস পরিচালনা করেন কিনা?') }}
                {{ Form::select('classreagulrity', $yesno, 'null', ['class' => 'form-select' . ($errors->has('classreagulrity') ? ' is-invalid' : ''), 'placeholder' => '']) }}
                {!! $errors->first('classreagulrity', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="form-group">
                {{ Form::label('teacattituted', 'প্রশিক্ষকের ব্যবহার কেমন?') }}
                {{ Form::select('teacattituted', $yesno, 'null', ['class' => 'form-select' . ($errors->has('teacattituted') ? ' is-invalid' : ''), 'placeholder' => '']) }}
                {!! $errors->first('teacattituted', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="form-group">
                {{ Form::label('teaclabatten', 'প্রশিক্ষক ও ল্যাব প্রদানকারী প্রতিষ্ঠানের সাথে সমন্বয় আছে কিনা?') }}
                {{ Form::select('teaclabatten', $yesno, 'null', ['class' => 'form-select' . ($errors->has('teaclabatten') ? ' is-invalid' : ''), 'placeholder' => '']) }}
                {!! $errors->first('teaclabatten', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="form-group">
                {{ Form::label('upojelaodit', 'উপজেলা মনিটরিং কমিটি কর্তৃক নিয়মিত প্রশিক্ষণ কার্যক্রম পরিদর্শন করা হয় কিনা? ') }}
                {{ Form::select('upojelaodit', $yesno, 'null', ['class' => 'form-select' . ($errors->has('upojelaodit') ? ' is-invalid' : ''), 'placeholder' => '']) }}
                {!! $errors->first('upojelaodit', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="form-group">
                {{ Form::label('upozelamonotring', 'উপজেলা মনিটরিং কমিটি কর্তৃক ইতোপূর্বে কোন নির্দেশনা প্রদান করা হয়েছিল কিনা? হয়ে থাকলে সেই অনুযায়ী গৃহীত পদক্ষেপ কি ছিল?') }}
                {{ Form::text('upozelamonotring', $inspectionconfig->upozelamonotring, ['class' => 'form-control' . ($errors->has('upozelamonotring') ? ' is-invalid' : ''), 'placeholder' => '']) }}
                {!! $errors->first('upozelamonotring', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="form-group">
                {{ Form::label('remark', 'পরিদর্শনকারী কর্মকর্তার নিকট লক্ষনীয় অন্যান্য বিষয় সার্বিক মন্তব্য ও নির্দেশনা।') }}
                {{ Form::text('remark', $inspectionconfig->remark, ['class' => 'form-control' . ($errors->has('remark') ? ' is-invalid' : ''), 'placeholder' => 'মন্তব্য']) }}
                {!! $errors->first('remark', '<div class="invalid-feedback">:message</div>') !!}
            </div>

        </div>
    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>
