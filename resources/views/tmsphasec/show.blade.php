@extends('layouts.auth-master')
@section('content')
    <div class="m-5">
        <x-alert />
        <div class="card p-5">
            @isset($phase)
                @php
                    $trainingBatchesArray = [];

                    $item = $phase;
                    if (isset($item['batch_phase']) && is_array($item['batch_phase'])) {
                        foreach ($item['batch_phase'] as $batch) {
                            if (isset($batch['training_batches']) && is_array($batch['training_batches'])) {
                                $trainingBatchesArray[] = $batch['training_batches'];
                            }
                        }
                    }
                    // dd($trainingBatchesArray);
                @endphp
                <div id="">
                    <h1 class="text-center">Phase Batches</h1>
                    <h3>Phase:</h3>
                </div>

                <div class="row">
                    <div class="col-md-9">
                        <div>
                            <div>Name: {{ $phase['name_en'] ?? '' }}</div>
                            <div>Remark: {{ $phase['remark'] ?? '' }}</div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        @if ($phase)
                            <div class="text-center">
                                @if (count($trainingBatchesArray) > 0)
                                    <a href="{{ route('tms-phase.link-batch', $phase['id']) }}"
                                        class="btn btn-lg btn-success w-100 show-action" title="Provider Details">
                                        Update Link Batch
                                    </a>
                                @else
                                    <a href="{{ route('tms-phase.link-batch', $phase['id']) }}"
                                        class="btn btn-lg btn-success w-100 show-action" title="Provider Details">
                                        Link With Batch
                                    </a>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
                <div class="mt-5">
                    <h4>Batch List</h4>
                    <div class="my-3">
                        <table class="table table-bordered bg-white">
                            <thead>
                                <th>{{ __('batch-list.sl') }}</th>
                                <th>Code</th>
                                <th>Name</th>
                                <th>location</th>
                                <th>Start Date</th>
                            </thead>
                            <tbody>
                                @if (count($trainingBatchesArray) > 0)
                                    @foreach (collect($trainingBatchesArray) as $batch)
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
                                                {{ \Carbon\Carbon::parse($batch['startDate'])->format('d-m-y') ?? '' }}
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5" class="text-danger">No Data Found</td>
                                    </tr>
                                @endif
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
