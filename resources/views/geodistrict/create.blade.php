@extends('front.layouts.app')

@section('title')
    <h1 class="title">Create Geodistrict</h1>
@endsection

@section('content')
    @includeif('component.alert')
    <div class="card card-default">
        <div class="card-body">
            <form method="POST" action="{{ route('geodistrict.store') }}"  role="form" enctype="multipart/form-data">
                @csrf

                @include('geodistrict.form')

            </form>
        </div>
    </div>
@endsection
