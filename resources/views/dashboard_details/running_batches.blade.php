@extends('layouts.auth-master')
{{-- @dd($running_batches); --}}
@section('content')
<!--begin::Content-->
<div class="m-5">
    <h3>Running Batches</h3>
    <br>
    <x-alert />
    @isset($running_batches)
    <div class="my-3">
        <form action="">
            <div class="w-50 d-flex gap-3">
                <input type="search" name="search" value="{{ request('search') }}" class="form-control w-75"
                    placeholder="search here">
                <input type="submit" class="form-control btn btn-primary w-25" value="Search">
            </div>
        </form>
    </div>
    <table class="table table-bordered bg-white">
        <thead>
            <th>SL</th>
            <th>Batch Code</th>
            <th>Start Time</th>
            <th>Training Title</th>
            <th>Location</th>
            <th>Vendor Name</th>
        </thead>
        <tbody>
            @foreach (collect($running_batches) as $batch)
            <tr>
                <td>
                    {{ $loop->iteration }}
                </td>
                <td>
                    {{ $batch['training_batch'] ? $batch['training_batch']['batchCode'] : '' }}
                </td>
                <td>
                    {{ $batch['class_time'] ?? '' }}
                </td>
                <td>
                    {{ $batch['training_batch'] ?
                    $batch['training_batch']['training']['title']['Name'] : '' }}
                </td>
                <td>
                    {{ $batch['training_batch'] ? $batch['training_batch']['GEOLocation'] : ''
                    }}
                </td>
                <td>
                    {{ $batch['training_batch'] ? $batch['training_batch']['provider']['name'] :
                    '' }}
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