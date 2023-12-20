@extends('front.layouts.app')

@section('title')
    <h1 class="title">Update Training Applicant</h1>
@endsection

@section('content')
    @includeif('component.alert')
    <div class="card card-default">
        <div class="card-body">
            <form method="POST" action="{{ route('training-applicant.update', $trainingApplicant->id) }}"  role="form" enctype="multipart/form-data">
                {{ method_field('PATCH') }}
                @csrf

                @include('training-applicant.form')

            </form>
        </div>
    </div>
@endsection
