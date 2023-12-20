@extends('front.layouts.app')

@section('title')
    <h1 class="title">Create Development Partner Empoly</h1>
@endsection

@section('content')
    @includeif('component.alert')
    <div class="card card-default">
        <div class="card-body">
            <form method="POST" action="{{ route('development-partner-empoly.store') }}"  role="form" enctype="multipart/form-data">
                @csrf

                @include('development-partner-empoly.form')

            </form>
        </div>
    </div>
@endsection
