@extends('front.layouts.app')

@section('title')
    <h1 class="title">Update Profile</h1>
@endsection

@section('content')
    @includeif('component.alert')
    <div class="card card-default">
        <div class="card-body">
            <form method="POST" action="{{ route('profile.update', $profile->id) }}"  role="form" enctype="multipart/form-data">
                {{ method_field('PATCH') }}
                @csrf

                @include('profile.form')

            </form>
        </div>
    </div>
@endsection
