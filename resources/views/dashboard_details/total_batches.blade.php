@extends('layouts.auth-master')
@section('content')
    <!--begin::Content -->
    <div class="m-5">
        <h3>{{ __('batch-list.total_batches') }}</h3>
        <x-alert />
        @isset($total_batches)
            <div class="my-3">
                <form action="">
                    <div class="w-50 d-flex gap-3">
                        <input type="search" name="search" value="{{ request('search') }}" class="form-control w-75"
                            placeholder="{{ __('batch-list.search_here') }}">
                        <input type="submit" class="form-control btn btn-primary w-25" value="{{ __('batch-list.search') }}">
                    </div>
                </form>
            </div>

            <table class="table table-bordered bg-white">
                <thead>
                    <th>{{ __('batch-list.sl') }}</th>
                    <th>{{ __('batch-list.batch_code') }}</th>
                    <th>{{ __('batch-list.location') }}</th>
                    <th>{{ __('batch-list.start_date') }}</th>
                    <th>{{ __('batch-list.total_class') }}</th>
                    <th>{{ __('batch-list.action') }}</th>
                </thead>
                <tbody>
                   
                    @foreach (collect($total_batches) as $batch)
                    
                        <tr>
                            <td>
                                {{ digitLocale($from_no + $loop->iteration - 1) }}
                            </td>
                            <td>
                                {{ $batch['batchCode'] }}
                            </td>
                            <td>
                                {{ $batch['GEOLocation'] }}
                            </td>
                            <td>
                                {{ isset($batch['startDate']) ? digitLocale(\Carbon\Carbon::parse($batch['startDate'])->format('d-m-Y')) : digitLocale(null) }}
                            </td>
                            <td>
                                {{ isset($batch['duration']) ? digitLocale($batch['duration']) : digitLocale(0) }}
                                {{ __('batch-list.days') }}
                            </td>
                            <td>
                                @if ($batch['schedule'] == null)
                                    @if (strtolower(Session::get('access_token')['role']) == 'provider')
                                        <a href="{{ route('batch-schedule.create', encrypt($batch['id'])) }}"
                                            class="btn btn-sm btn-primary"> {{ __('batch-list.create_schedule') }}</a>
                                    @else
                                        <span class="badge text-black badge-warning">{{__('batch-list.not_created-schedule')}}</span>
                                    @endif
                                @else
                                    <a href="{{ route('batch-schedule.index', [encrypt($batch['schedule']['id']), encrypt($batch['id'])]) }}"
                                        class="btn btn-sm btn-info"> {{ __('batch-list.view_schedule') }}</a>

                                        <div class="progress m-1">
                                            <div class="progress-bar" role="progressbar" style="width: {{$batch['schedule']['total_complete']}}%" aria-valuenow="{{$batch['schedule']['total_complete']}}" aria-valuemin="{{$batch['schedule']['total_complete']}}" aria-valuemax="{{$batch['duration']}}"></div>
                                          </div>

                                          <small>{{__('batch-list.complete_class')}}: {{ digitLocale($batch['schedule']['total_complete']) }}</small>/
                                          <small>{{__('batch-list.pending_class')}}: {{ digitLocale($batch['schedule']['total_pending']) }}</small>/
                                          <small>{{__('batch-list.running_class')}}: {{ digitLocale($batch['schedule']['total_running']) }}</small>
                                          
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {!! $paginator->links() !!}
        @endisset
    </div>
@endsection
