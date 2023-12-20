@extends('front.layouts.app')

@section('title')
    <h1 class="title">Update Tms Training Batch Schedule</h1>
@endsection

@section('content')
    @includeif('component.alert')
    <div class="card card-default">
        <div class="card-body">
            <form method="POST" action="{{ route('batch-schedule.update', $tmsTrainingBatchSchedule->id) }}"  role="form" enctype="multipart/form-data">
                {{ method_field('PATCH') }}
                @csrf

                @include('tms-training-batch-schedule.form')

            </form>
        </div>
    </div>
@endsection
