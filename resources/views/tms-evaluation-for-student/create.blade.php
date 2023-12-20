@extends('front.layouts.app')

@section('title')
    <h1 class="title">Create Tms Evaluation For Student</h1>
@endsection

@section('content')
    @includeif('component.alert')
    <div class="card card-default">
        <div class="card-body">
            <form method="POST" action="{{ route('evaluation-student.store') }}"  role="form" enctype="multipart/form-data">
                @csrf

                @include('tms-evaluation-for-student.form')

            </form>
        </div>
    </div>
@endsection
