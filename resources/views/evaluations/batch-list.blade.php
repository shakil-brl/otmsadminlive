@extends('layouts.auth-master')
{{-- @dump($total_batches) --}}
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
                    <th>Training Info</th>
                    <th>Provider</th>
                    <th>Trainer</th>
                    <th>Start Date & Duration</th>
                    <th>{{ __('batch-list.action') }}</th>
                </thead>
                <tbody>
                    @foreach (collect($total_batches) as $batch)
                        <tr>
                            <td>
                                {{ digitLocale($page_from + $loop->index) }}
                            </td>
                            <td>
                                {{ $batch['batchCode'] }}
                            </td>
                            <td>
                                {{ $batch['get_training']['title']['Name'] ?? '' }}
                                <div>
                                    {{ $batch['GEOLocation'] }}
                                </div>
                            </td>
                            <td>
                                {{ $batch['provider']['name'] ?? '' }}
                                <div>
                                    <a
                                        href="callto:{{ $batch['provider']['phone'] ?? '' }}">{{ $batch['provider']['phone'] ?? '' }}</a>
                                </div>
                            </td>
                            <td>
                                @forelse ($batch['provider_trainers'] as $trainer)
                                    {{ $trainer['profile']['KnownAsBangla'] ?? '' }}
                                    <div>
                                        <a
                                            href="callto:{{ $batch['provider']['phone'] ?? '' }}">{{ $batch['provider']['phone'] ?? '' }}</a>
                                    </div>
                                @empty
                                    <small class="text-danger">Not Assigned</small>
                                @endforelse
                            </td>
                            <td>
                                {{ isset($batch['startDate']) ? digitLocale(\Carbon\Carbon::parse($batch['startDate'])->format('d/m/Y')) : digitLocale(null) }}
                                <div>
                                    {{ isset($batch['duration']) ? digitLocale($batch['duration']) : digitLocale(0) }}
                                    {{ __('batch-list.days') }}
                                </div>
                            </td>
                            <td>
                                <a href="{{ route('evaluate.trainee.trainee-list', $batch['id']) }}"
                                    class="btn btn-sm btn-info">
                                    Trainee List
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {!! $paginator->links() !!}
        @endisset
    </div>
@endsection
