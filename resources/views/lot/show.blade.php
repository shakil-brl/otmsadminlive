@extends('layouts.auth-master')
@section('content')
    <div class="m-5">
        <x-alert />
        <div class="card p-5">
            @isset($lot)
                <div id="">
                    <h3>Batch Group Details({{ $lot['name_en'] ?? '' }}):</h3>
                </div>

                <div class="row">
                    <div class="col-md-9">
                        <div>
                            <div>Name(Bangla): {{ $lot['name_bn'] ?? '' }}</div>
                            <div>Code: {{ $lot['code'] ?? '' }}</div>
                            <div>Remark: {{ $lot['remark'] ?? '' }}</div>
                        </div>


                    </div>
                    <div class="col-md-3">
                        @if ($lot['training_batches'])
                            <div class="text-center">
                                <a href="{{ route('lots.link-batch', $lot['id']) }}"
                                    class="btn btn-lg btn-success w-100 show-action" title="lot Details">
                                    Edit Link Batch
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="mt-5">
                    <h4>All Batches</h4>
                    <div class="my-3">
                        <table class="table table-bordered bg-white">
                            <thead>
                                <th>{{ __('batch-list.sl') }}</th>
                                <th>Batch Code</th>
                                <th>Course Title</th>
                                <th>Location</th>
                                <th>Start Date</th>
                                {{-- <th>{{ __('batch-list.action') }}</th> --}}
                            </thead>
                            <tbody>
                                @foreach (collect($lot['training_batches']) as $batch)
                                    {{-- @dump($batch) --}}
                                    <tr>
                                        <td>
                                            {{ $loop->iteration }}
                                        </td>
                                        <td>
                                            {{ $batch['batchCode'] ?? '' }}
                                        </td>
                                        <td>
                                            {{ $batch['training']['title']['Name'] ?? '' }}
                                        </td>
                                        <td>
                                            {{ $batch['GEOLocation'] ?? '' }}
                                        </td>
                                        <td>
                                            {{ $batch['startDate'] ?? '' }}
                                        </td>
                                        {{-- <td>
                                <a href="" class="btn btn-sm btn-primary" title="lot Details">
                                    view
                                </a>
                            </td> --}}
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            @endisset
        </div>
    </div>
@section('scripts')
    <script></script>
@endsection
@endsection
