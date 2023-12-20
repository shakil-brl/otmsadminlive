@extends('front.layouts.app')

@section('title')
    <h1 class="title">Update Tms User Type</h1>
@endsection

@section('content')
    @includeif('component.alert')
    <div class="card card-default">
        <div class="card-body">
            <form method="POST" action="{{ route('user-type.update', $tmsUserType->id) }}"  role="form" enctype="multipart/form-data">
                {{ method_field('PATCH') }}
                @csrf

                @include('tms-user-type.form')

            </form>
        </div>
    </div>
@endsection
