@extends('front.layouts.app')

@section('title')
    <h1 class="title">Update Tms Class Document</h1>
@endsection

@section('content')
    @includeif('component.alert')
    <div class="card card-default">
        <div class="card-body">
            <form method="POST" action="{{ route('class-document.update', $tmsClassDocument->id) }}"  role="form" enctype="multipart/form-data">
                {{ method_field('PATCH') }}
                @csrf

                @include('tms-class-document.form')

            </form>
        </div>
    </div>
@endsection
