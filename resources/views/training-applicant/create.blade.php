@extends('front.layouts.app')

@section('title')
    <h1 class="title">Create Training Applicant</h1>
@endsection

@section('content')
    @includeif('component.alert')
    <div class="card card-default">
        <div class="card-body">
            <form method="POST" action="{{ route('training-applicant.store') }}"  role="form" enctype="multipart/form-data">
                @csrf

                @include('training-applicant.form')

            </form>
        </div>
    </div>
@endsection
