<div class="border-0 mt-5 pt-6 text-center">
    <h4>গণপ্রজাতন্ত্রী বাংলাদেশ সরকার</h4>
    প্রকল্প পরিচালকের কার্যালয়<br>
    হার পাওয়ার প্রকল্প (Her Power Project) : প্রযুক্তির সহায়তায় নারীর ক্ষমতায়ন<br>
    তথ্য ও যোগাযোগ প্রযুক্তি অধিদপ্তর<br>
    তথ্য ও যোগাযোগ প্রযুক্তি বিভাগ<br>
    জাতীয় বিজ্ঞান ও প্রযুক্তি কমপ্লেক্স (এনএসটিএসসি) (১১ তলা), ই-১৩/ডি, ই, আগারগাঁও, ঢাকা-১২০৭<br>
</div>
<div class="box box-info padding-1 mt-10">
    <div class="box-body">
        @php
        $yesNo = ['না', 'হ্যাঁ'];
        @endphp
        {{ Form::hidden('created_by', 51488) }}
        {{ Form::hidden('batch_id', $batch_id) }}
        {{ Form::hidden('user_id', 51488) }}
        {{ Form::hidden('class_no', $schedule_detail_id) }}
        <div class="row row-cols-md-3 g-5 ">

            <div class="col">
                {{ Form::label('lab_size', 'ল্যাব কক্ষ এর সাইজ ঠিক আছে কিনা?') }}
                {{ Form::select('lab_size', $yesNo, 'null', [
                'class' =>
                'form-select' .
                ($errors->has('lab_size')
                ? '
                is-invalid'
                : ''),
                'placeholder' => '',
                ]) }}
                {!! $errors->first('lab_size', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="col">
                {{ Form::label('electricity', 'সার্বক্ষণিক বিদ্যুৎ সংযোগ আছে কিনা?') }}
                {{ Form::select('electricity', $yesNo, 'null', [
                'class' => 'form-select' . ($errors->has('electricity') ? ' is-invalid' : ''),
                'placeholder' => '',
                ]) }}
                {!! $errors->first('electricity', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="col">
                {{ Form::label('internet', 'ল্যাবে সার্বক্ষনিক ইন্টারনেট সংযোগ নিশ্চিত করা হয়েছে কিনা?') }}
                {{ Form::select('internet', $yesNo, 'null', [
                'class' => 'form-select' . ($errors->has('internet') ? ' is-invalid' : ''),
                'placeholder' => '',
                ]) }}
                {!! $errors->first('internet', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="col">
                {{ Form::label('lab_bill', 'ল্যাবের ভাড়া নিয়মিত পরিশোধ করা হয় কিনা?') }}
                {{ Form::select('lab_bill', $yesNo, 'null', [
                'class' =>
                'form-select' .
                ($errors->has('lab_bill')
                ? '
                is-invalid'
                : ''),
                'placeholder' => '',
                ]) }}
                {!! $errors->first('lab_bill', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="col">
                {{ Form::label('lab_attendance', 'ল্যাবের জন্য সার্বক্ষণিক ল্যাব রক্ষণাবেক্ষণ সহকারী আছে কিনা?') }}
                {{ Form::select('lab_attendance', $yesNo, 'null', [
                'class' => 'form-select' . ($errors->has('lab_attendance') ? ' is-invalid' : ''),
                'placeholder' => '',
                ]) }}
                {!! $errors->first('lab_attendance', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="col">
                {{ Form::label('computer', 'কম্পিউটার সচল আছে কিনা? ') }}
                {{ Form::select('computer', $yesNo, 'null', [
                'class' => 'form-select' . ($errors->has('computer') ? ' is-invalid' : ''),
                'placeholder' => 'কম্পিউটার সচল আছে কিনা?',
                ]) }}
                {!! $errors->first('computer', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="col">
                {{ Form::label('router', 'রাউটার সচল আছে কিনা?') }}
                {{ Form::select('router', $yesNo, 'null', [
                'class' =>
                'form-select' .
                ($errors->has('router')
                ? '
                is-invalid'
                : ''),
                'placeholder' => 'রাউটার সচল আছে কিনা?',
                ]) }}
                {!! $errors->first('router', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="col">
                {{ Form::label('projector', 'প্রজেক্টর/টিভি সচল আছে কিনা?') }}
                {{ Form::select('projector', $yesNo, 'null', [
                'class' => 'form-select' . ($errors->has('projector') ? ' is-invalid' : ''),
                'placeholder' => '',
                ]) }}
                {!! $errors->first('projector', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="col">
                {{ Form::label('student_laptop', 'ল্যাবের ল্যাপটপ প্রশিক্ষনার্থীগণ ব্যবহার করেছে এ বিষয়ে পর্যবেক্ষণ।')
                }}
                {{ Form::select('student_laptop', $yesNo, 'null', [
                'class' => 'form-select' . ($errors->has('student_laptop') ? ' is-invalid' : ''),
                'placeholder' => 'ল্যাবের ল্যাপটপ
                প্রশিক্ষনার্থীগণ
                ব্যবহার করেছে এ বিষয়ে পর্যবেক্ষণ।',
                ]) }}
                {!! $errors->first('student_laptop', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="col">
                {{ Form::label(
                'lab_security',
                "ল্যাবের নিরাপত্তা, পরিস্কার পরিচ্ছন্ন ও সার্বিক পরিবেশ সম্পর্কিত বিষয়গুলো
                সম্পর্কিত পযবেক্ষণ।",
                ) }}
                {{ Form::select('lab_security', $yesNo, 'null', [
                'class' => 'form-select' . ($errors->has('lab_security') ? ' is-invalid' : ''),
                'placeholder' => '',
                ]) }}
                {!! $errors->first('lab_security', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="col">
                {{ Form::label(
                'lab_register',
                "পরিদর্শন রেজিষ্টার, প্রশিক্ষক হাজিরা রেজিষ্টার, প্রশিক্ষণার্থী হাজিরা
                রেজিষ্টার আছে কিনা? রেজিষ্টার নিয়মিত হালনাগাদ করা হয় কিনা?",
                ) }}
                {{ Form::select('lab_register', $yesNo, 'null', [
                'class' => 'form-select' . ($errors->has('lab_register') ? ' is-invalid' : ''),
                'placeholder' => '',
                ]) }}
                {!! $errors->first('lab_register', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="col">
                {{ Form::label('class_regularity', 'প্রশিক্ষক নিয়মিত ক্লাস পরিচালনা করেন কিনা?') }}
                {{ Form::select('class_regularity', $yesNo, 'null', [
                'class' => 'form-select' . ($errors->has('class_regularity') ? ' is-invalid' : ''),
                'placeholder' => '',
                ]) }}
                {!! $errors->first('class_regularity', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="col">
                {{ Form::label('trainer_attituted', 'প্রশিক্ষকের ব্যবহার কেমন?') }}
                {{ Form::select('trainer_attituted', $yesNo, 'null', [
                'class' => 'form-select' . ($errors->has('trainer_attituted') ? ' is-invalid' : ''),
                'placeholder' => '',
                ]) }}
                {!! $errors->first('trainer_attituted', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="col">
                {{ Form::label(
                'trainer_tab_attendance',
                "প্রশিক্ষক ও ল্যাব প্রদানকারী প্রতিষ্ঠানের সাথে সমন্বয় আছে
                কিনা?",
                ) }}
                {{ Form::select('trainer_tab_attendance', $yesNo, 'null', [
                'class' => 'form-select' . ($errors->has('trainer_tab_attendance') ? ' is-invalid' : ''),
                'placeholder' => '',
                ]) }}
                {!! $errors->first('trainer_tab_attendance', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="col">
                {{ Form::label(
                'upazila_audit',
                "উপজেলা মনিটরিং কমিটি কর্তৃক নিয়মিত প্রশিক্ষণ কার্যক্রম পরিদর্শন করা হয়
                কিনা? ",
                ) }}
                {{ Form::select('upazila_audit', $yesNo, 'null', [
                'class' => 'form-select' . ($errors->has('upazila_audit') ? ' is-invalid' : ''),
                'placeholder' => '',
                ]) }}
                {!! $errors->first('upazila_audit', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="col">
                {{ Form::label(
                'upazila_monitoring',
                "উপজেলা মনিটরিং কমিটি কর্তৃক ইতোপূর্বে কোন নির্দেশনা প্রদান করা
                হয়েছিল
                কিনা? হয়ে থাকলে সেই অনুযায়ী গৃহীত পদক্ষেপ কি ছিল?",
                ) }}
                {{ Form::select('upazila_monitoring', $yesNo, 'null', [
                'class' => 'form-select' . ($errors->has('upazila_monitoring') ? ' is-invalid' : ''),
                'placeholder' => '',
                ]) }}
                {!! $errors->first('upazila_monitoring', '<div class="invalid-feedback">:message</div>') !!}
            </div>

        </div>
        <div class="row row-cols-md-1 g-5 mt-3 ">
            {{ Form::label(
            'remark',
            "পরিদর্শনকারী কর্মকর্তার নিকট লক্ষনীয় অন্যান্য বিষয় সার্বিক মন্তব্য ও
            নির্দেশনা।",
            ) }}
            {{ Form::textarea('remark', $tmsInspection->remark, [
            'class' =>
            'form-control' .
            ($errors->has('remark')
            ? '
            is-invalid'
            : ''),
            'placeholder' => '',
            ]) }}
            {!! $errors->first('remark', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>
    <div class="box-footer mt-5">
        <button type="submit" class="btn btn-primary  show-loader ">{{ __('Submit') }}</button>
    </div>
</div>