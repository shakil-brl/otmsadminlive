@extends('front.layouts.app')

@section('title')
    <h1 class="title">Create Tms Batch Schedule Detail</h1>
@endsection

@section('content')
    @includeif('component.alert')
    <div class="card card-default">
        <div class="card-body">
            <form method="POST" action="{{ route('tms-batch-schedule-detail.store') }}"  role="form" enctype="multipart/form-data">
                @csrf

                @include('tms-batch-schedule-detail.form')

            </form>
        </div>
    </div>
@endsection
