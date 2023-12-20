@extends('front.layouts.app')

@section('title')
    <h1 class="title">Create Geodivision</h1>
@endsection

@section('content')
    @includeif('component.alert')
    <div class="card card-default">
        <div class="card-body">
            <form method="POST" action="{{ route('geodivision.store') }}"  role="form" enctype="multipart/form-data">
                @csrf

                @include('geodivision.form')

            </form>
        </div>
    </div>
@endsection
