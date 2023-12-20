@extends('front.layouts.app')

@section('title')
    <h1 class="title">Create Tms User Type</h1>
@endsection

@section('content')
    @includeif('component.alert')
    <div class="card card-default">
        <div class="card-body">
            <form method="POST" action="{{ route('user-type.store') }}"  role="form" enctype="multipart/form-data">
                @csrf

                @include('tms-user-type.form')

            </form>
        </div>
    </div>
@endsection
