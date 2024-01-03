@extends('layouts.auth-master')
{{-- @dd($running_batches); --}}
@section('content')
    <!--begin::Content-->
    <div class="m-5">
        <h3>{{__('batch-schedule.ongoing_class')}}</h3>
        <br>
        <x-alert />
        @isset($ongoing_classes)
            <div class="my-3">
                <form action="">
                    <div class="w-50 d-flex gap-3">
                        <input type="search" name="search" value="{{ request('search') }}" class="form-control w-75"
                            placeholder="{{__('batch-schedule.search_here')}}">
                        <input type="submit" class="form-control btn btn-primary w-25" value="{{__('batch-schedule.search')}}">
                    </div>
                </form>
            </div>
            <table class="table table-bordered bg-white">
                <thead>
                    <th>{{__('batch-schedule.sl')}}</th>
                    <th>{{__('batch-schedule.batch_code')}}</th>
                    <th>{{__('batch-schedule.start_time')}}</th>
                    <th>{{__('batch-schedule.course_name')}}</th>
                    <th>{{__('batch-schedule.location')}}</th>
                    <th>{{__('batch-schedule.development_partner')}}</th>
                    <th>{{__('batch-schedule.action')}}</th>
                </thead>
                <tbody>
                    @foreach (collect($ongoing_classes) as $batch)

                   
                        <tr>
                            <td>
                                {{ $loop->iteration }}
                            </td>
                            <td>
                                {{ $batch['schedule']['training_batch'] ? $batch['schedule']['training_batch']['batchCode'] : '' }}
                            </td>
                            <td>
                                {{ $batch['start_time'] ?? '' }}
                            </td>
                            <td>
                                {{ $batch['schedule']['training_batch'] ? $batch['schedule']['training_batch']['training']['title']['Name'] : '' }}
                            </td>
                            <td>
                                {{ $batch['schedule']['training_batch'] ? $batch['schedule']['training_batch']['GEOLocation'] : '' }}
                            </td>
                            <td>
                                {{ $batch['schedule']['training_batch'] ? $batch['schedule']['training_batch']['provider']['name'] : '' }}
                            </td>
                            <td>
                                @if ($batch['streaming_link'])
                                    <a class="btn btn-sm btn-danger" href="{{ $batch['streaming_link'] }}" target="_blank">
                                        {{__('batch-schedule.live_streaming')}}
                                    </a>
                                @endif
                                @if ($batch['static_link'])
                                    <a type="button" class="btn btn-sm btn-info" href="{{ $batch['static_link'] }}"
                                        target="_blank">
                                        {{__('batch-schedule.join_class')}}
                                    </a>
                                @endif
                               
                                 @php
                                $inspection_pm = [
                                'batch_id' => $batch['schedule']['training_batch']['id'],
                                'schedule_detail_id' => $batch['id'],
                                ];
                                @endphp
                                @isset($inspection_pm)
                                <a class="btn btn-sm btn-primary" href="{{ route('tms-inspections.create', $inspection_pm) }}"
                                target="_blank">
                                Inspection
                                </a>
                                @endisset


                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {!! $paginator->links() !!}
        @endisset
    </div>
    <!--end::Content-->
@section('script')
    <script></script>
@endsection
@endsection
