<div class="border-0 text-center">
    {{-- <h4>গণপ্রজাতন্ত্রী বাংলাদেশ সরকার</h4>
    প্রকল্প পরিচালকের কার্যালয়<br>
    হার পাওয়ার প্রকল্প (Her Power Project) : প্রযুক্তির সহায়তায় নারীর ক্ষমতায়ন<br>
    তথ্য ও যোগাযোগ প্রযুক্তি অধিদপ্তর<br>
    তথ্য ও যোগাযোগ প্রযুক্তি বিভাগ<br>
    জাতীয় বিজ্ঞান ও প্রযুক্তি কমপ্লেক্স (এনএসটিএসসি) (১১ তলা), ই-১৩/ডি, ই, আগারগাঁও, ঢাকা-১২০৭<br> --}}


</div>
<div class="box box-info  ">
    <div class="box-body">
        @php
            $yesNo = ['না', 'হ্যাঁ'];
        @endphp
        {{ Form::hidden('batch_id', $batch['id']) }}

        <table class="table table-bordered">
            <tr>
                <td>
                    ল্যাব কক্ষ এর সাইজ ঠিক আছে কিনা?
                    <x-error name="lab_size" />
                </td>

                <td width="150">
                    {{ Form::select('lab_size', $yesNo, 'null', [
                        'class' => 'form-select' . ($errors->has('lab_size') ? ' is-invalid' : ''),
                        'placeholder' => '',
                    ]) }}
                </td>
            </tr>

            <tr>
                <td>
                    সার্বক্ষণিক বিদ্যুৎ সংযোগ আছে কিনা?
                    <x-error name="electricity" />
                </td>

                <td>
                    {{ Form::select('electricity', $yesNo, 'null', [
                        'class' => 'form-select' . ($errors->has('electricity') ? ' is-invalid' : ''),
                        'placeholder' => '',
                    ]) }}
                </td>
            </tr>

            <tr>
                <td>
                    ল্যাবে সার্বক্ষনিক ইন্টারনেট সংযোগ নিশ্চিত করা হয়েছে কিনা?
                    <x-error name="internet" />
                </td>

                <td>
                    {{ Form::select('internet', $yesNo, 'null', [
                        'class' => 'form-select' . ($errors->has('internet') ? ' is-invalid' : ''),
                        'placeholder' => '',
                    ]) }}
                </td>
            </tr>

            <tr>
                <td>
                    ল্যাবের ভাড়া নিয়মিত পরিশোধ করা হয় কিনা?
                    <x-error name="lab_bill" />
                </td>

                <td>
                    {{ Form::select('lab_bill', $yesNo, 'null', [
                        'class' => 'form-select' . ($errors->has('lab_bill') ? '  is-invalid' : ''),
                        'placeholder' => '',
                    ]) }}
                </td>
            </tr>

            <tr>
                <td>
                    ল্যাবের জন্য সার্বক্ষণিক ল্যাব রক্ষণাবেক্ষণ সহকারী আছে কিনা?
                    <x-error name="lab_attendance" />
                </td>

                <td>
                    {{ Form::select('lab_attendance', $yesNo, 'null', [
                        'class' => 'form-select' . ($errors->has('lab_attendance') ? ' is-invalid' : ''),
                        'placeholder' => '',
                    ]) }}
                </td>
            </tr>
            <tr>
                <td>
                    কম্পিউটার সচল আছে কিনা?
                    <x-error name="computer" />
                </td>

                <td>
                    {{ Form::select('computer', $yesNo, 'null', [
                        'class' => 'form-select' . ($errors->has('computer') ? ' is-invalid' : ''),
                        'placeholder' => '',
                    ]) }}
                </td>
            </tr>
            <tr>
                <td>
                    রাউটার সচল আছে কিনা?
                    <x-error name="router" />
                </td>

                <td>
                    {{ Form::select('router', $yesNo, 'null', [
                        'class' => 'form-select' . ($errors->has('router') ? ' is-invalid' : ''),
                        'placeholder' => '',
                    ]) }}
                </td>
            </tr>

            <tr>
                <td>
                    প্রজেক্টর/টিভি সচল আছে কিনা?
                    @php
                        $name = 'projector';
                    @endphp
                    <x-error :name="$name" />
                </td>

                <td>
                    {{ Form::select($name, $yesNo, 'null', [
                        'class' => 'form-select' . ($errors->has($name) ? ' is-invalid' : ''),
                        'placeholder' => '',
                    ]) }}
                </td>
            </tr>
            <tr>
                <td>
                    ল্যাবের ল্যাপটপ প্রশিক্ষনার্থীগণ ব্যবহার করেছে এ বিষয়ে পর্যবেক্ষণ।
                    @php
                        $name = 'student_laptop';
                    @endphp
                    <x-error :name="$name" />
                </td>

                <td>
                    {{ Form::select($name, $yesNo, 'null', [
                        'class' => 'form-select' . ($errors->has($name) ? ' is-invalid' : ''),
                        'placeholder' => '',
                    ]) }}
                </td>
            </tr>

            <tr>
                <td>
                    ল্যাবের নিরাপত্তা, পরিস্কার পরিচ্ছন্ন ও সার্বিক পরিবেশ সম্পর্কিত বিষয়গুলো সম্পর্কিত পযবেক্ষণ।
                    @php
                        $name = 'lab_security';
                    @endphp
                    <x-error :name="$name" />
                </td>

                <td>
                    {{ Form::select($name, $yesNo, 'null', [
                        'class' => 'form-select' . ($errors->has($name) ? ' is-invalid' : ''),
                        'placeholder' => '',
                    ]) }}
                </td>
            </tr>
            <tr>
                <td>
                    পরিদর্শন রেজিষ্টার, প্রশিক্ষক হাজিরা রেজিষ্টার, প্রশিক্ষণার্থী হাজিরা রেজিষ্টার আছে কিনা? রেজিষ্টার
                    নিয়মিত হালনাগাদ করা হয় কিনা?
                    @php
                        $name = 'lab_register';
                    @endphp
                    <x-error :name="$name" />
                </td>

                <td>
                    {{ Form::select($name, $yesNo, 'null', [
                        'class' => 'form-select' . ($errors->has($name) ? ' is-invalid' : ''),
                        'placeholder' => '',
                    ]) }}
                </td>
            </tr>
            <tr>
                <td>
                    প্রশিক্ষক নিয়মিত ক্লাস পরিচালনা করেন কিনা?
                    @php
                        $name = 'class_regularity';
                    @endphp
                    <x-error :name="$name" />
                </td>

                <td>
                    {{ Form::select($name, $yesNo, 'null', [
                        'class' => 'form-select' . ($errors->has($name) ? ' is-invalid' : ''),
                        'placeholder' => '',
                    ]) }}
                </td>
            </tr>
            <tr>
                <td>
                    প্রশিক্ষকের ব্যবহার কেমন?
                    @php
                        $name = 'trainer_attituted';
                    @endphp
                    <x-error :name="$name" />
                </td>

                <td>
                    {{ Form::select($name, $yesNo, 'null', [
                        'class' => 'form-select' . ($errors->has($name) ? ' is-invalid' : ''),
                        'placeholder' => '',
                    ]) }}
                </td>
            </tr>

            <tr>
                <td>
                    প্রশিক্ষক ও ল্যাব প্রদানকারী প্রতিষ্ঠানের সাথে সমন্বয় আছে কিনা?
                    @php
                        $name = 'trainer_tab_attendance';
                    @endphp
                    <x-error :name="$name" />
                </td>

                <td>
                    {{ Form::select($name, $yesNo, 'null', [
                        'class' => 'form-select' . ($errors->has($name) ? ' is-invalid' : ''),
                        'placeholder' => '',
                    ]) }}
                </td>
            </tr>

            <tr>
                <td>
                    উপজেলা মনিটরিং কমিটি কর্তৃক নিয়মিত প্রশিক্ষণ কার্যক্রম পরিদর্শন করা হয় কিনা?
                    @php
                        $name = 'upazila_audit';
                    @endphp
                    <x-error :name="$name" />
                </td>

                <td>
                    {{ Form::select($name, $yesNo, 'null', [
                        'class' => 'form-select' . ($errors->has($name) ? ' is-invalid' : ''),
                        'placeholder' => '',
                    ]) }}
                </td>
            </tr>

            <tr>
                <td>
                    উপজেলা মনিটরিং কমিটি কর্তৃক ইতোপূর্বে কোন নির্দেশনা প্রদান করা হয়েছিল কিনা? হয়ে থাকলে সেই অনুযায়ী
                    গৃহীত পদক্ষেপ কি ছিল?
                    @php
                        $name = 'upazila_monitoring';
                    @endphp
                    <x-error :name="$name" />
                </td>

                <td>
                    {{ Form::select($name, $yesNo, 'null', [
                        'class' => 'form-select' . ($errors->has($name) ? ' is-invalid' : ''),
                        'placeholder' => '',
                    ]) }}
                </td>
            </tr>
        </table>

        <div class="row">
            <div class="col">
                <label for="">ক্লাস নং</label>
                <input type="number" class="form-control @err('class_no')" value="{{ old('class_no') }}"
                    name="class_no">
                <x-error name='class_no' />
            </div>
            <div class="col">
                <label for="">পরিদর্শনের তারিখ</label>
                <input type="date" class="form-control @err('visit_date')" value="{{ old('visit_date') }}"
                    name="visit_date">
                <x-error name='visit_date' />
            </div>
        </div>
        <div class="mt-5">
            {{ Form::label('remark', 'পরিদর্শনকারী কর্মকর্তার নিকট লক্ষনীয় অন্যান্য বিষয় সার্বিক মন্তব্য ও নির্দেশনা।') }}
            <textarea name="remark" id="remark" class="form-control w-100 {{ $errors->has('remark') ? 'is-invalid' : '' }}"
                placeholder="">{{ old('remark') }}</textarea>
            <x-error name="remark" />
        </div>
    </div>
    <div class="box-footer mt-5">
        <button type="submit" class="btn btn-primary show-loader ">{{ __('Submit') }}</button>
    </div>
</div>
