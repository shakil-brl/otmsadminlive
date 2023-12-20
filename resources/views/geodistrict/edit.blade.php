@extends('front.layouts.app')

@section('title')
    <h1 class="title">Update Geodistrict</h1>
@endsection

@section('content')
    @includeif('component.alert')
    <div class="card card-default">
        <div class="card-body">
            <form method="POST" action="{{ route('geodistrict.update', $geodistrict->id) }}"  role="form" enctype="multipart/form-data">
                {{ method_field('PATCH') }}
                @csrf

                @include('geodistrict.form')

            </form>
        </div>
    </div>
@endsection
