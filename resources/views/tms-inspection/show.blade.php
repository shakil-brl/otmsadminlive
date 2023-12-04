@extends('layouts.auth-master')

@section('template_title')
Tms Inspection
@endsection

@push('css')
<style>
    .table tr td:last-child {
        text-align: right;
    }
</style>
@endpush

@section('content')

<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="mx-auto my-4 p-4" style="max-width: 8.27in; background-color: #fff; border-radius: 0;">
                <div class=" m-6 p-6">

                    <div class="border-0 mt-5 pt-6 text-center">
                        <h4>গণপ্রজাতন্ত্রী বাংলাদেশ সরকার</h4>
                        প্রকল্প পরিচালকের কার্যালয়<br>
                        হার পাওয়ার প্রকল্প (Her Power Project) : প্রযুক্তির সহায়তায় নারীর ক্ষমতায়ন<br>
                        তথ্য ও যোগাযোগ প্রযুক্তি অধিদপ্তর<br>
                        তথ্য ও যোগাযোগ প্রযুক্তি বিভাগ<br>
                        জাতীয় বিজ্ঞান ও প্রযুক্তি কমপ্লেক্স (এনএসটিএসসি) (১১ তলা), ই-১৩/ডি, ই, আগারগাঁও, ঢাকা-১২০৭<br>
                    </div>
                    <table class="table table-responsive align-middle table-row-dashed fs-6 gy-5">

                        @php
                        $tmsInspection= (object) $tmsInspection;
                        $batch= (object) $tmsInspection->batch;
                        $training= (object) $batch->training;
                        $primaryTrainer= (object) $batch->primary_trainer;
                        $profile= (object) @$primaryTrainer->profile;
                        $trainingTitle=(object)$training->training_title;
                        $createdby= (object) $tmsInspection->created_by;
                        @endphp

                        <tbody class="text-gray-600 fw-semibold" id="user-tbody">
                            <tr>
                                <td>1.</td>
                                <td width="500">পরিদর্শকৃত প্রশিক্ষণ কেন্দ্রের নাম ও ঠিকানা: </td>
                                <td>
                                    {{$batch->batchCode}}<br>
                                    {{-- {{$batch->GEOLocation}}<br>
                                    {{$batch->GEOCode}}<br> --}}
                                    {{$batch->TrainingVenue}}<br>



                                </td>
                            </tr>
                            <tr>
                                <td>2.</td>
                                <td>বর্তমান পরিদর্শনের তারিখ:</td>
                                <td>{{ $tmsInspection->created_at }}</td>
                            </tr>
                            <tr>
                                <td>3.</td>
                                <td>পরিদর্শকৃত প্রশিক্ষণ কেন্দ্রের প্রশিক্ষকের নাম: </td>
                                <td>{{ @$profile->KnownAsBangla}}

                                </td>
                            </tr>
                            <tr>
                                <td>4.</td>
                                <td>প্রশিক্ষণ ক্যাটাগরি:</td>
                                <td>{{$trainingTitle->Name}}</td>
                            </tr>
                            <tr>
                                <td>5.</td>
                                <td>কত তম ক্লাস:</td>
                                <td>
                                    <x-inspection-result :value="$tmsInspection->class_no" :design="1" :lang="1" />
                                </td>
                            </tr>
                            <tr>
                                <td>6.</td>
                                <td>ল্যাব কক্ষ এর সাইজ ঠিক আছে কিনা:</td>
                                <td>
                                    <x-inspection-result :value="$tmsInspection->lab_size" :design="1" :lang="1" />
                                </td>
                            </tr>
                            <tr>
                                <td>7.</td>
                                <td>সার্বক্ষণিক বিদ্যুৎ সংযোগ আছে কিনা:</td>
                                <td>
                                    <x-inspection-result :value="$tmsInspection->electricity" :design="1" :lang="1" />
                                </td>
                            </tr>
                            <tr>
                                <td>8.</td>
                                <td>ল্যাবে সার্বক্ষনিক ইন্টারনেট সংযোগ নিশ্চিত করা হয়েছে কিনা:</td>
                                <td>
                                    <x-inspection-result :value="$tmsInspection->internet" :design="1" :lang="1" />
                                </td>
                            </tr>
                            <tr>
                                <td>9.</td>
                                <td>ল্যাবের ভাড়া নিয়মিত পরিশোধ করা হয় কিনা:</td>
                                <td>
                                    <x-inspection-result :value="$tmsInspection->lab_bill" :design="1" :lang="1" />

                                </td>
                            </tr>
                            <tr>
                                <td>10</td>
                                <td>ল্যাবের জন্য সার্বক্ষণিক ল্যাব রক্ষণাবেক্ষণ সহকারী আছে কিনা:</td>
                                <td>
                                    <x-inspection-result :value="$tmsInspection->lab_attendance" :design="1"
                                        :lang="1" />
                                </td>
                            </tr>
                            <tr>
                                <td>11.</td>
                                <td>কম্পিউটার সচল আছে কিনা?</td>
                                <td>
                                    <x-inspection-result :value="$tmsInspection->computer" :design="1" :lang="1" />

                                </td>
                            </tr>
                            <tr>
                                <td>12.</td>
                                <td>রাউটারসচল আছে কিনা?:</td>
                                <td>
                                    <x-inspection-result :value="$tmsInspection->router" :design="1" :lang="1" />
                                </td>
                            </tr>
                            <tr>
                                <td>13.</td>
                                <td>প্রজেক্টর/টিভি সচল আছে কিনা:</td>
                                <td>
                                    <x-inspection-result :value="$tmsInspection->projector" :design="1" :lang="1" />
                                </td>
                            </tr>
                            <tr>
                                <td>14.</td>
                                <td>ল্যাবের ল্যাপটপ প্রশিক্ষনার্থীগণ ব্যবহার করেছে এ বিষয়ে পর্যবেক্ষণ:</td>
                                <td>
                                    <x-inspection-result :value="$tmsInspection->student_laptop" :design="1"
                                        :lang="1" />

                                </td>
                            </tr>
                            <tr>
                                <td>15.</td>
                                <td>ল্যাবের নিরাপত্তা, পরিস্কার পরিচ্ছন্ন ও সার্বিক পরিবেশ সম্পর্কিত বিষয়গুলো সম্পর্কিত
                                    পযবেক্ষণ।:
                                </td>
                                <td>
                                    <x-inspection-result :value="$tmsInspection->lab_security" :design="1" :lang="1" />

                                </td>
                            </tr>
                            <tr>
                                <td>16.</td>
                                <td>পরিদর্শন রেজিষ্টার, প্রশিক্ষক হাজিরা রেজিষ্টার, প্রশিক্ষণার্থী হাজিরা রেজিষ্টার আছে
                                    কিনা?
                                    রেজিষ্টার নিয়মিত হালনাগাদ করা হয় কিনা:</td>
                                <td>
                                    <x-inspection-result :value="$tmsInspection->lab_register" :design="1" :lang="1" />

                                </td>
                            </tr>
                            <tr>
                                <td>17.</td>
                                <td>প্রশিক্ষক নিয়মিত ক্লাস পরিচালনা করেন কিনা:</td>
                                <td>
                                    <x-inspection-result :value="$tmsInspection->class_regularity" :design="1"
                                        :lang="1" />

                                </td>
                            </tr>
                            <tr>
                                <td>18.</td>
                                <td>প্রশিক্ষকের ব্যবহার কেমন:</td>
                                <td>
                                    <x-inspection-result :value="$tmsInspection->trainer_attituted" :design="1"
                                        :lang="1" />

                                </td>
                            </tr>
                            <tr>
                                <td>19.</td>
                                <td>প্রশিক্ষক ও ল্যাব প্রদানকারী প্রতিষ্ঠানের সাথে সমন্বয় আছে কিনা:</td>
                                <td>
                                    <x-inspection-result :value="$tmsInspection->trainer_tab_attendance" :design="1"
                                        :lang="1" />
                                </td>
                            </tr>
                            <tr>
                                <td>20.</td>
                                <td>উপজেলা মনিটরিং কমিটি কর্তৃক নিয়মিত প্রশিক্ষণ কার্যক্রম পরিদর্শন করা হয় কিনা:</td>
                                <td>
                                    <x-inspection-result :value="$tmsInspection->upazila_audit" :design="1" :lang="1" />

                                </td>
                            </tr>
                            <tr>
                                <td>21.</td>
                                <td>উপজেলা মনিটরিং কমিটি কর্তৃক ইতোপূর্বে কোন নির্দেশনা প্রদান করা হয়েছিল কিনা? হয়ে
                                    থাকলে
                                    সেই
                                    অনুযায়ী গৃহীত পদক্ষেপ কি ছিল:</td>
                                <td>
                                    <x-inspection-result :value="$tmsInspection->upazila_monitoring" :design="1"
                                        :lang="1" />

                                </td>
                            </tr>
                            <tr>
                                <td colspan="3" class="text-start">
                                    <span class="text-muted">পরিদর্শনকারী কর্মকর্তার নিকট লক্ষনীয় অন্যান্য বিষয় সার্বিক
                                        মন্তব্য ও
                                        নির্দেশনা।:</span>
                                    <div>
                                        {{ $tmsInspection->remark}}
                                    </div>
                                </td>

                            </tr>



                        </tbody>
                    </table>

                    <div class="border-0 mt-5 pt-6 text-end">
                        <h4>পরিদর্শনকারী কর্মকর্তার<br>
                            নামঃ {{ $createdby->KnownAsBangla}}<br>
                            পদবীঃ {{ $createdby->postname}}
                        </h4>
                    </div>

                    <x-go-back />
                </div>
            </div>
        </div>
    </div>

    <go-back>
</section>
@endsection