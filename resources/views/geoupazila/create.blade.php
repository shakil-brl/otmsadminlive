@extends('front.layouts.app')

@section('title')
    <h1 class="title">Create Geoupazila</h1>
@endsection

@section('content')
    @includeif('component.alert')
    <div class="card card-default">
        <div class="card-body">
            <form method="POST" action="{{ route('geoupazilas.store') }}"  role="form" enctype="multipart/form-data">
                @csrf

                @include('geoupazila.form')

            </form>
        </div>
    </div>
@endsection
