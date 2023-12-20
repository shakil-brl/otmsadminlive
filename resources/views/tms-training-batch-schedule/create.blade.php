@extends('front.layouts.app')

@section('title')
    <h1 class="title">Create Tms Training Batch Schedule</h1>
@endsection

@section('content')
    @includeif('component.alert')
    <div class="card card-default">
        <div class="card-body">
            <form method="POST" action="{{ route('batch-schedule.store') }}"  role="form" enctype="multipart/form-data">
                @csrf

                @include('tms-training-batch-schedule.form')

            </form>
        </div>
    </div>
@endsection
