@extends('front.layouts.app')

@section('title')
    <h1 class="title">Create Trainer Profile</h1>
@endsection

@section('content')
    @includeif('component.alert')
    <div class="card card-default">
        <div class="card-body">
            <form method="POST" action="{{ route('trainer-profile.store') }}"  role="form" enctype="multipart/form-data">
                @csrf

                @include('trainer-profile.form')

            </form>
        </div>
    </div>
@endsection
