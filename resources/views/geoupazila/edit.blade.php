@extends('front.layouts.app')

@section('title')
    <h1 class="title">Update Geoupazila</h1>
@endsection

@section('content')
    @includeif('component.alert')
    <div class="card card-default">
        <div class="card-body">
            <form method="POST" action="{{ route('geoupazilas.update', $geoupazila->id) }}"  role="form" enctype="multipart/form-data">
                {{ method_field('PATCH') }}
                @csrf

                @include('geoupazila.form')

            </form>
        </div>
    </div>
@endsection
