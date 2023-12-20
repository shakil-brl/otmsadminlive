@extends('front.layouts.app')

@section('title')
    <h1 class="title">Create Tms Class Document</h1>
@endsection

@section('content')
    @includeif('component.alert')
    <div class="card card-default">
        <div class="card-body">
            <form method="POST" action="{{ route('class-document.store') }}"  role="form" enctype="multipart/form-data">
                @csrf

                @include('tms-class-document.form')

            </form>
        </div>
    </div>
@endsection
