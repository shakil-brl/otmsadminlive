@extends('front.layouts.app')

@section('title')
    <h1 class="title">Create Tms Inspection</h1>
@endsection

@section('content')
    @includeif('component.alert')
    <div class="card card-default">
        <div class="card-body">
            <form method="POST" action="{{ route('tms-inspections.store') }}"  role="form" enctype="multipart/form-data">
                @csrf

                @include('tms-inspection.form')

            </form>
        </div>
    </div>
@endsection
