@extends('front.layouts.app')

@section('title')
    <h1 class="title">Update Tms Batch Schedule Detail</h1>
@endsection

@section('content')
    @includeif('component.alert')
    <div class="card card-default">
        <div class="card-body">
            <form method="POST" action="{{ route('tms-batch-schedule-detail.update', $tmsBatchScheduleDetail->id) }}"  role="form" enctype="multipart/form-data">
                {{ method_field('PATCH') }}
                @csrf

                @include('tms-batch-schedule-detail.form')

            </form>
        </div>
    </div>
@endsection
